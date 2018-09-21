#!/usr/bin/env python
# -*- encoding=utf8 -*-

import sys
reload(sys)
import bson
import time
import gridfs
import logging
import hashlib
import datetime
import logging.handlers
from NovelBean import NovelBean
from pymongo import MongoClient

sys.setdefaultencoding('utf8')

class MongoDB:
    def __init__(self):
        self.__conn = None
        self.__collection = None
        
        self.log = logging.getLogger('MongoDB')
        sh = logging.StreamHandler(stream=None)
        fm = logging.Formatter('%(asctime)s  %(levelname)s   %(name)s - %(filename)s:%(lineno)s - %(message)s')
        self.log.setLevel(logging.INFO)
        sh.setFormatter(fm)
        self.log.addHandler(sh)
    
    def connect(self, ip, port=27017, user = None, pwd = None):
        try:
            auth = ''
            if ((None != user) and (None != pwd)):
                auth = str(user) + ':' + str(pwd) + '@'
            self.__conn = MongoClient("mongodb://%s%s:%d" % (auth, ip, port))
        except BaseException as e:
            self.log.error('MongoDB 连接失败!' + e.message)
        self.__collection = None
        return MongoDB
    
    
    def setCollection(self, dbName, collectionName):
        if None == self.__conn:
            return None
        db = self.__conn[dbName]
        try:
            self.__collection = db[collectionName]
        except BaseException as e:
            self.log.error('MongoDB 集合创建失败!' + e.message)
        return MongoDB
    
    def insertOneDocument(self, doc):
        if None == self.__collection:
            return None
        ret = None
        try:
            ret = self.__collection.insert_one(doc)
            ret = ret.inserted_id
        except BaseException as e:
            self.log.error('MongoDB 插入文档失败!' + e.message)
        return ret
    
    def insertManyDocument(self, docsList):
        if None == self.__collection or len(docsList) <= 0:
            return None
        ret = None
        try:
            ret = self.__collection.insert_many(docsList)
            ret = ret.inserted_ids
        except BaseException as e:
            self.log.error('MongoDB 插入文档失败!' + e.message) 
        return ret
    
    def selectOneDocument(self, js):
        if None == self.__collection or '' == js or None == js:
            return None
        ret = None
        try:
            ret = self.__collection.find_one(js)
        except BaseException as e:
            self.log.error('MongoDB 查询文档失败!' + e.message) 
        return ret
    
    def selectDocuments(self, js, field):
        if None == self.__collection or '' == js or None == js:
            return None
        ret = None
        try:
            ret = self.__collection.find(js, field)
        except BaseException as e:
            self.log.error('MongoDB 查询文档失败!' + e.message) 
        return ret
    
    def selectAllDocument(self):
        if None == self.__collection:
            return None
        ret = None
        try:
            ret = self.__collection.find()
        except BaseException as e:
            self.log.error('MongoDB 查询文档失败!' + e.message) 
        return ret
    
    def selectDocumentById(self, id):
        if None == self.__collection or None == id or '' == id:
            return None
        ret = None
        try:
            ret = self.__collection.find_one({'_id':id})
        except BaseException as e:
            self.log.error('MongoDB 查询文档失败!' + e.message)
        return ret
    
    def updateDocumentById(self, id, field, value):
        if None == self.__collection or '' == id or None == id\
           or '' == field or None == field\
           or '' == value or None == value:
            return None
        ret = None
        try:
            ret = self.__collection.update({'_id': id}, {'$set': {field: value}})
        except BaseException as e:
            self.log.error('MongoDB 更新文件失败!' + e.message)
        return ret
    
    def collectionAddFieldById(self, id, field, value):
        if None == self.__collection or '' == id or None == id\
           or '' == field or None == field\
           or '' == value or None == value:
            return None
        ret = None
        try:
            ret = self.__collection.update({'_id': id}, {'$set': {field: value}})
        except BaseException as e:
            self.log.error('MongoDB 添加字段错误!' + e.message)
        return ret
    
    def collectionCount(self):
        if None == self.__collection:
            return None
        ret = None
        try:
            ret = self.__collection.count()
        except BaseException as e:
            self.log.error('MongoDB 集合数量计算失败!' + e.message) 
        return ret
    
    
    def novelUnpackageAll(self, dbName, cinfo, cdata):
        self.setCollection(dbName, cinfo)
        ret = self.selectAllDocument()
        if not ret:
            yield None
        for info in ret:
            novel = NovelBean()
            novel.setId(info['_id'])
            novel.setCategory(info['category'])
            novel.setStatus(info['status'])
            novel.setUpdateTime(info['updateTime'])
            for name, url in info['rightChapterUrl'].items():
                novel.setRightChapter(name, url)
            novel.setName(info['name'])
            novel.setAuthor(info['author'])
            for name, url in info['errorChapterUrl'].items():
                novel.setErrorChapter(name, url)
            novel.setBlockIds(info['blockId'])
            for name, url in info['chapterUrl'].items():
                novel.setChapter(name, url)
            novel.setNovelUrl(info['novelUrl'])
            novel.setOnline(info['online'])
            novel.setImgType(info['imgType'])
            novel.setIntime(info['intime'])
            novel.setImgContent(info['imgCotent'])
            novel.setImgUrl(info['imgUrl'])
            novel.setDesc(info['desc'])
            
            for iid in novel.getBlockIds():
                self.setCollection(dbName, cdata)
                iret = self.selectDocumentById(iid)
                if not iret:
                    self.log.error('缺少数据块！！！')
                    continue
                for name, content in iret['chapterContent'].items():
                    novel.setChapterContent(name, content)
            self.setCollection(dbName, cinfo)
            yield novel

    @staticmethod
    def novelOnline(onlineIP, onlinePort, novel, user, pwd):
        # 线上
        onlineMongo = MongoDB()
        onlineMongo.connect(onlineIP, onlinePort, user, pwd)
        onlineMongo.setCollection('novel_online', 'online_info')
        # 保存
        size = None
        categoryMap = {}
        info = {}
        splitNum = 500
        blockNum = 1
        retToDB = []
        # 满足上线资格
        if (len(novel.getErrorChapter()) > 0) or (len(novel.getImgContent()) <= 1):
            return False
        ret = onlineMongo.selectDocumentById('detail')
        try:
            if int(ret['size']) >= 0:
                size = int(ret['size'])
            if len(ret['category']) > 0:
                categoryMap = dict(ret['category'])
        except BaseException as e:
            print '错误的数据库操作'
            return False
        blockIds = []
        blockIdIndex = 0
        chapterContents = {}
        if isinstance(novel, NovelBean):
            # 没有此条数据，执行插入操作
            info['_id'] = novel.getId()
            info['viewcount'] = 0
            info['jx'] = novel.getJX()
            info['name'] = novel.getName()
            info['author'] = novel.getAuthor()
            info['imgUrl'] = novel.getImgUrl()
            info['imgCotent'] = novel.getImgContent()
            info['imgType'] = novel.getImgType()
            info['status'] = novel.getStatus()
            info['desc'] = novel.getDesc()
            info['intime'] = novel.getIntime()
            info['updateTime'] = novel.getUpdateTime()
            info['online'] = '1'
            if categoryMap.has_key(novel.getCategory()):
                info['category'] = categoryMap[novel.getCategory()]
            else:
                info['category'] = '其他类型'
            blockIds = []
            chapterContent = novel.getChapterContent()

            # 分段存储, 优先使用 已有 的 blockid
            splitContent = {}                                                                                   # 切分的待写入数据字段
            splitChapterContent = {}                                                                            # 章节字段
            index = 1
            for ik, iv in chapterContent.items():
                splitChapterContent[ik] = iv
                index += 1
                if index > splitNum:
                    # 获取 bid
                    bid = hashlib.md5(novel.getName() + novel.getAuthor() + str(blockIdIndex)).hexdigest()
                    blockIds.append(bid)
                    splitContent['_id'] = bid
                    splitContent['name'] = novel.getName()
                    splitContent['author'] = novel.getAuthor()
                    splitContent['chapterContent'] = splitChapterContent
                    splitContent['chapterNum'] = str(index - 1)
                    retToDB.append(splitContent)
                    index = 1
                    splitContent = {}
                    splitChapterContent = {}
                    blockIdIndex += 1
            # 余数部分的章节信息
            if len(splitChapterContent) > 0:
                # 获取 bid
                bid = ''
                if len(blockIds) > blockIdIndex:
                    bid = blockIds[blockIdIndex]
                else:
                    bid = hashlib.md5(novel.getName() + novel.getAuthor() + str(blockIdIndex)).hexdigest()
                    blockIds.append(bid)
                splitContent['_id'] = bid
                splitContent['name'] = novel.getName()
                splitContent['author'] = novel.getAuthor()
                splitContent['chapterContent'] = splitChapterContent
                splitContent['chapterNum'] = str(index - 1)
                retToDB.append(splitContent)
            info['blockNum'] = str(blockIdIndex + 1)
            info['blockId'] = blockIds
            onlineMongo.setCollection('novel_online', 'online_index')
            if not onlineMongo.selectDocumentById(novel.getId()):
                # 没有此条数据
                onlineMongo.setCollection('novel_online', 'online_index')
                onlineMongo.insertOneDocument(info)
                onlineMongo.setCollection('novel_online', 'online_data')
                onlineMongo.insertManyDocument(retToDB)
                onlineMongo.setCollection('novel_online', 'online_info')
                onlineMongo.updateDocumentById('detail', 'size', str(size + 1))
            else:
                # 有此条数据, 执行更新操作 更新信息、更新章节
                # 更新信息
                onlineMongo.setCollection('novel_online', 'online_index')
                onlineMongo.updateDocumentById(info['_id'], 'name', info['name'])
                onlineMongo.updateDocumentById(info['_id'], 'author', info['author'])
                onlineMongo.updateDocumentById(info['_id'], 'imgUrl', info['imgUrl'])
                onlineMongo.updateDocumentById(info['_id'], 'imgCotent', info['imgCotent'])
                onlineMongo.updateDocumentById(info['_id'], 'imgType', info['imgType'])
                onlineMongo.updateDocumentById(info['_id'], 'status', info['status'])
                onlineMongo.updateDocumentById(info['_id'], 'desc', info['desc'])
                onlineMongo.updateDocumentById(info['_id'], 'intime', info['intime'])
                onlineMongo.updateDocumentById(info['_id'], 'updateTime', info['updateTime'])
                onlineMongo.updateDocumentById(info['_id'], 'online', info['online'])
                onlineMongo.updateDocumentById(info['_id'], 'category', info['category'])
                # 更新内容
                onlineMongo.setCollection('novel_online', 'online_data')
                for i in retToDB:
                    if onlineMongo.selectDocumentById(i['_id']):
                        onlineMongo.updateDocumentById(i['_id'], 'name', i['name'])
                        onlineMongo.updateDocumentById(i['_id'], 'author', i['author'])
                        onlineMongo.updateDocumentById(i['_id'], 'chapterContent', i['chapterContent'])
                        onlineMongo.updateDocumentById(i['_id'], 'chapterNum', i['chapterNum'])
                        continue
                    onlineMongo.insertOneDocument(i)
        return True

    ''' NovelBean 插入到数据库 '''
    @staticmethod
    def novelPackage(novel):
        info = {}
        splitNum = 100                                                                                          # 每个分块存储的章节数
        blockNum = 1                                                                                            # 第几个分块
        retToDB = []

        blockIds = []
        blockIdIndex = 0
        chapterContents = {}
        if isinstance(novel, NovelBean):
            info['_id'] = hashlib.md5(novel.getName() + novel.getAuthor()).hexdigest()
            if None != novel.getId() and '' != novel.getId():
                info['_id'] = novel.getId()
            info['name'] = novel.getName()
            info['author'] = novel.getAuthor()
            info['novelUrl'] = novel.getNovelUrl()
            info['imgUrl'] = novel.getImgUrl()
            info['imgCotent'] = novel.getImgContent()
            info['imgType'] = novel.getImgType()
            info['category'] = novel.getCategory()
            info['status'] = novel.getStatus()
            info['desc'] = novel.getDesc()
            info['intime'] = novel.getIntime()
            info['updateTime'] = novel.getUpdateTime()
            info['online'] = novel.getOnline()
            info['chapterUrl'] = novel.getChapter()
            info['errorChapterUrl'] = novel.getErrorChapter()
            info['rightChapterUrl'] = novel.getRightChapter()
            blockIds = novel.getBlockIds()
            chapterContent = novel.getChapterContent()

            # 分段存储, 优先使用 已有 的 blockid
            splitContent = {}                                                                                   # 切分的待写入数据字段
            splitChapterContent = {}                                                                            # 章节字段

            index = 1
            for ik, iv in chapterContent.items():
                splitChapterContent[ik] = iv
                index += 1
                if index > splitNum:
                    # 获取 bid
                    bid = ''
                    if len(blockIds) > blockIdIndex:
                        bid = blockIds[blockIdIndex]
                    else:
                        bid = hashlib.md5(novel.getName() + novel.getAuthor() + str(blockIdIndex)).hexdigest()
                        blockIds.append(bid)
                    splitContent['_id'] = bid
                    splitContent['name'] = novel.getName()
                    splitContent['author'] = novel.getAuthor()
                    splitContent['chapterContent'] = splitChapterContent
                    splitContent['chapterNum'] = str(index - 1)
                    
                    retToDB.append(splitContent)
                    index = 1
                    splitContent = {}
                    splitChapterContent = {}
                    blockIdIndex += 1
            # 余数部分的章节信息
            if len(splitChapterContent) > 0:
                # 获取 bid
                bid = ''
                if len(blockIds) > blockIdIndex:
                    bid = blockIds[blockIdIndex]
                else:
                    bid = hashlib.md5(novel.getName() + novel.getAuthor() + str(blockIdIndex)).hexdigest()
                    blockIds.append(bid)
                splitContent['_id'] = bid
                splitContent['name'] = novel.getName()
                splitContent['author'] = novel.getAuthor()
                splitContent['chapterContent'] = splitChapterContent
                splitContent['chapterNum'] = str(index - 1)
                retToDB.append(splitContent)
            info['blockNum'] = str(blockIdIndex + 1)
            info['blockId'] = blockIds
        if len(info) == 0:
            info = None
            retToDB = None
        return (info, retToDB)



if __name__ == '__main__':
    testDB = MongoDB()
    testDB.connect('127.0.0.1')
    testDB.setCollection('test', 'test_c')
    
    ## 插入数据
    #testDB.insertOneDocument({'_id': '1', 'name':'test1', 'type':'local1'})
    #testDB.insertOneDocument({'_id': '2', 'name':'test2', 'type':'local2'})
    #testDB.insertOneDocument({'_id': '3', 'name':'test3', 'type':'local3'})
    
    ## 添加字段
    #for i in testDB.selectDocuments({}, {'name': 1, 'type': 1}):
        #testDB.collectionAddFieldById(i['_id'], 'timeStamp', '20180731')
        #testDB.collectionAddFieldById(i['_id'], 'updateTime', '20180731')
        #print i
        
    ## 更新数据
    #for i in testDB.selectDocuments({}, {'name': 1}):
        #testDB.updateDocumentById(i['_id'], 'name', '更新id')
        #print i
    
    ## 文档数
    #print testDB.collectionCount()
    
    ## 查询一个文档
    #print testDB.selectOneDocument({})
    
    ## 查询所有文档
    #for i in testDB.selectAllDocument():
        #print i
        
    ## 测试读取每本小说的所有信息
    #for info, datas in MongoDB.mongoNovelPackage('127.0.0.1', 27017, 'spiderNovel', 'mzhu8_info', 'mzhu8_data'):
        #print info
        #print datas
        #exit(1)
    print 'ok'