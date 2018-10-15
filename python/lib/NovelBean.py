#!/usr/bin/env python
# -*- encoding=utf8 -*-

import sys
reload(sys)
sys.setdefaultencoding("utf8")
import logging
import hashlib
import datetime
import logging.handlers

import time

class NovelBean:
    def __init__(self):
        self.__timeStr = time.strftime("%Y%m%d%H", time.localtime(time.time()))

        ''' 日志初始化 '''
        self.log = logging.getLogger('NovelBean')
        sh = logging.StreamHandler(stream=None)
        fm = logging.Formatter('%(asctime)s  %(levelname)s   %(name)s - %(filename)s:%(lineno)s - %(message)s')
        self.log.setLevel(logging.INFO)
        sh.setFormatter(fm)
        self.log.addHandler(sh)

        ''' 类属性 '''
        self.__id = ''                                      # 主键
        self.__name = ''                                    # 书名
        self.__author = ''                                  # 作者名
        self.__normName = ''                                # 归一书名
        self.__normAuthor = ''                              # 归一作者名
        self.__novelUrl = ''                                # 小说 url
        
        self.__imgUrl = ''                                  # 封面图片 url
        self.__imgContent = ''                              # 封面图片
        self.__imgType = ''                                 # 图片格式
        self.__category = ''                                # 分类
        self.__status = ''                                  # 连载/完结/精修完结 状态
        self.__desc = ''                                    # 书籍简介
        self.__chapterContent = {}                          # 章节内容
        self.__chapterUrl = {}                              # 书籍所有章节链接
        self.__errorChapter = {}                            # 错误的章节链接
        self.__intime = ''                                  # 入库时间
        self.__updateTime = ''                              # 最后更新时间
        self.__online = 0                                   # 0 表示未上线, 1表示上线
        self.__jx = 0                                       # 0 表示非精修，1表示精修
        self.__blockIds = []                                # 章节信息分块存储的 ID
        ''' 自动生成 '''
        self.__chapterNum = 0                               # 总的章节数
        self.__blockVolume = 900                            # 每个块的章节容量


    ''' 静态方法 '''
    @staticmethod
    def disposeName(name):
        if None != name:
            name = name.replace('/', '')
            name = name.replace('.', '')
        return name.strip()


    @staticmethod
    def setDictKV(key, mdict):
        if mdict.has_key(key):
            return mdict[key]
        return ''



    ''' 打包成 mongodb 格式 '''
    def packageToMongo(self):
        info = {}
        content = []

        if '' == self.getName() or '' == self.getImgContent() or\
           '' == self.getCategory or len(self.getChapterContent) <= 0:
            return info, content

        info['name'] = self.getName()
        info['author'] = self.getAuthor()
        info['norm_name'] = self.getNormName()
        info['norm_author'] = self.getNormAuthor()
        info['img_url'] = self.getImgUrl()
        info['img_content'] = self.getImgContent()
        info['img_type'] = self.getImgType()
        info['category'] = self.getCategory()
        info['status'] = self.getStatus()
        info['desc'] = self.getDesc()
        info['novel_url'] = self.getNovelUrl()
        info['chapter_url'] = self.getChapter()
        info['error_chapter'] = self.getErrorChapter()
        info['chapter_num'] = self.getChapterNum()
        info['online'] = self.getOnline()
        info['jx'] = self.getJX()
        info['block_volume'] = self.__blockVolume

        ''' 选择 '''
        if '' != self.getId():
            info['_id'] = self.getId()
        else:
            info['_id'] = hashlib.md5(self.getName() + self.getAuthor()).hexdigest()
        if '' != self.getIntime():
            info['intime'] = self.getIntime()
        else:
            info['intime'] = self.__timeStr
        if '' != self.getUpdateTime():
            info['update'] = self.getUpdateTime()
        else:
            info['update'] = self.__timeStr

        ''' 内容 '''
        blockIds = []
        chapterIndex = 0
        blockNum = 0
        ''' 先对章节进行排序 '''
        cnameList = []
        for ik, iv in self.getChapterContent():
            arr = ik.split('[}')
            if len(arr) < 2:
                self.log.error('章节名错误:' + str(ik))
                continue
            cnameList.append((int(arr[0]), arr[1]))
        cnameList.sort(key = lambda x: x[0])

        chapterTmp = {}
        for ik1,ik2 in cnameList:
            ik = str(ik1) + '{]' + ik2
            iv = self.__chapterContent[ik]
            if (0 == (chapterIndex % int(self.__blockVolume))) and\
               len(chapterTmp) > 0:
                blockInfoTemp = {}
                mid = hashlib.md5(self.getName() + self.getAuthor() + str(blockNum)).hexdigest()
                blockInfoTemp['_id'] = mid
                blockInfoTemp['name'] = self.getName()
                blockInfoTemp['author'] = self.getAuthor()
                blockInfoTemp['content'] = chapterTmp
                blockIds.append(mid)
                content.append(blockInfoTemp)
                blockNum += 1
                chapterTmp = {}
            chapterTmp[ik] = iv
        self.__blockIds = blockIds
        info['block_ids'] = self.__blockIds
        return info, content


    ''' 解包成 NovelBean 格式 '''
    def unpackageToMongo(self, info, content):
        self.__id = NovelBean.setDictKV('_id', info)
        self.__name = NovelBean.setDictKV('name', info)
        self.__author = NovelBean.setDictKV('author', info)
        self.__normName = NovelBean.setDictKV('norm_name', info)
        self.__normAuthor = NovelBean.setDictKV('norm_author', info)
        self.__imgUrl = NovelBean.setDictKV('img_url', info)
        self.__imgContent = NovelBean.setDictKV('img_content', info)
        self.__imgType = NovelBean.setDictKV('img_type', info)
        self.__category = NovelBean.setDictKV('category', info)
        self.__status = NovelBean.setDictKV('status', info)
        self.__desc = NovelBean.setDictKV('desc', info)
        self.__novelUrl = NovelBean.setDictKV('novel_url', info)
        self.__chapterUrl = NovelBean.setDictKV('chapter_url', info)
        self.__errorChapter = NovelBean.setDictKV('error_chapter', info)
        self.__intime = NovelBean.setDictKV('intime', info)
        self.__updateTime = NovelBean.setDictKV('update', info)
        self.__online = int(NovelBean.setDictKV('online', info))
        self.__jx = int(NovelBean.setDictKV('jx', info))

        content = {}
        for item in content:
            for ik, iv in item.items():
                content[ik] = iv
        self.__chapterContent = content
        return self


    ''' 类方法 '''
    def setId(self, id):
        if None != id and '' != id:
            self.__id = id
    def getId(self):
        return self.__id


    def setNovelUrl(self, url):
        if None != url and '' != url:
            self.__novelUrl = url
    def getNovelUrl(self):
        return self.__novelUrl


    def setName(self, name):
        if None != name and '' != name:
            self.__name = NovelBean.disposeName(name)
    def getName(self):
        return self.__name


    def setNormName(self, name):
        if None != name and '' != name:
            self.__normName = name.strip()
    def getNormName(self):
        return self.__normName


    def setAuthor(self, author):
        if author != None and author != '':
            self.__author = author.strip()
    def getAuthor(self):
        return self.__author
    

    def setNormAuthor(self, author):
        if author != None and author != '':
            self.__normAuthor = author.strip()
    def getNormAuthor(self):
        return self.__normAuthor


    def setImgUrl(self, imgUrl):
        if None != imgUrl and '' != imgUrl:
            self.__imgUrl = imgUrl
    def getImgUrl(self):
        return self.__imgUrl


    def setImgContent(self, img):
        if None != img and '' != img:
            self.__imgContent = img
    def getImgContent(self):
        return self.__imgContent


    def setImgType(self, itype):
        if None != itype and '' != itype:
            self.__imgType = itype
    def getImgType(self):
        return self.__imgType


    def setCategory(self, category):
        if category != None and '' != category:
            self.__category = category
    def getCategory(self):
        return self.__category


    def setStatus(self, status):
        if status != None and '' != status:
            self.__status = status
    def getStatus(self):
        return self.__status


    def setDesc(self, desc):
        if desc != None and '' != desc:
            self.__desc = desc
    def getDesc(self):
        return self.__desc


    def setChapter(self, cname, url):                       # 判定url是否合法
        cflag = False
        uflag = False
        if None != cname and '' != cname:
            cflag = True
            cname = NovelBean.disposeName(cname)
        if None != url and '' != url:
            uflag = True
        if cflag and uflag:
            if not self.__chapterUrl.has_key(url):
                self.__chapterUrl[url] = cname
    def getChapter(self):
        return self.__chapterUrl


    def setErrorChapter(self, name, url):
        cflag = False
        uflag = False
        if None != cname and '' != cname:
            cflag = True
            cname = NovelBean.disposeName(cname)
        if None != url and '' != url:
            uflag = True
        if cflag and uflag:
            if not self.__errorChapter.has_key(url):
                self.__errorChapter[url] = cname
    def getErrorChapter(self):
        return self.__errorChapter


    def setChapterContent(self, name, content):
        if (not self.__chapterContent.has_key(name)) or\
           (None == self.__chapterContent.has_key(name)) or\
           ('' == self.__chapterContent.has_key(name)):
            self.__chapterContent[name] = content.strip()
    def getChapterContent(self):
        return self.__chapterContent


    def setIntime(self, intime):
        self.__intime = intime
    def getIntime(self):
        return self.__intime


    def setUpdateTime(self, update):
        self.__updateTime = update
    def getUpdateTime(self):
        return self.__updateTime


    def setOnline(self, online):
        v = 1
        if (online != True) and (1 != int(online)):
            v = 0
        self.__online = v
    def getOnline(self):
        return self.__online


    def setBlockIds(self, bids):
        if len(bids) > 0:
            self.__blockIds = bids
    def getBlockIds(self):
        return self.__blockIds


    def setJX(self, jx):
        if int(jx) > 0 or True == jx:
            self.__jx = 1
    def getJX(self):
        return self.__jx


    def getChapterNum(self):
        return len(self.getChapterContent())



if __name__ == '__main__':
    novel = NovelBean()
    novel.setName('大主宰')
    #print novel.getName()
    
    exit(0)
