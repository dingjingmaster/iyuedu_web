#!/usr/bin/env python
# -*- encoding=utf8 -*-

import sys
reload(sys)

sys.setdefaultencoding("utf8")

import time

class NovelBean:
    def __init__(self):
        timeStr = time.strftime("%Y%m%d%H", time.localtime(time.time()))
        self.__id = ''                                      # 主键
        self.__name = ''                                    # 书名
        self.__author = ''                                  # 作者名
        self.__imgUrl = ''                                  # 封面图片 url
        self.__imgContent = ''                              # 封面图片 
        self.__imgType = ''                                 # 图片格式
        self.__category = ''                                # 分类
        self.__status = ''                                  # 连载/完结/精修完结 状态
        self.__desc = ''                                    # 书籍简介
        self.__novelUrl = ''                                # 小说 url
        self.__chapterUrl = {}                              # 书籍章节链接
        self.__chapterContent = {}                          # 章节内容
        self.__errorChapter = {}                            # 错误的章节链接
        self.__rightChapter = {}                            # 正确的章节链接
        self.__intime = timeStr                             # 入库时间
        self.__updateTime = timeStr                         # 最后更新时间
        self.__online = '0'                                 # 0 表示未上线
        self.__blockIds = []                                # 章节信息分块存储的 ID
        self.__jx = '0'                                     # 0 表示非精修，1表示精修

    def setId(self, id):
        if None != id and '' != id:
            self.__id = id
    def setNovelUrl(self, url):
        if None != url and '' != url:
            self.__novelUrl = url

    def setName(self, name):
        if None != name and '' != name:                     # 去除可能包含的 / (书名做路径一出现问题)
            self.__name = NovelBean.disposeName(name)

    def setAuthor(self, author):
        if author != None and author != '':
            self.__author = author.strip()

    def setImgUrl(self, imgUrl):
        if None != imgUrl and '' != imgUrl:
            self.__imgUrl = imgUrl

    def setImgContent(self, img):
        if None != img and '' != img:
            self.__imgContent = img

    def setImgType(self, itype):
        if None != itype and '' != itype:
            self.__imgType = itype

    def setCategory(self, category):
        if category != None and category != '':
            self.__category = category

    def setStatus(self, status):
        if status != None and status != '':
            self.__status = status

    def setDesc(self, desc):
        if desc != None and desc != '':
            self.__desc = desc

    def setChapter(self, cname, url):                       # 判定url是否合法
        cflag = False
        uflag = False
        if None != cname and '' != cname:
            cflag = True
            cname = NovelBean.disposeName(cname)
        if None != url and '' != url:
            uflag = True
        if cflag and uflag:
            if not self.__chapterUrl.has_key(cname):
                self.__chapterUrl[cname] = url

    def setErrorChapter(self, name, url):
        self.__errorChapter[name] = url

    def setRightChapter(self, name, url):
        self.__rightChapter[name] = url

    def setChapterContent(self, name, content):
        self.__chapterContent[name] = content.strip()

    def setIntime(self, intime):
        if len(intime) == 8:
            self.__intime = intime

    def setUpdateTime(self, update):
        if len(update) == 8:
            self.__updateTime = update

    def setOnline(self, online):
        v = '0'
        if online != True or online != '1':
            v = '0'
        else:
            v = '1'
        self.__online = v

    def setBlockIds(self, bids):
        if len(bids) > 0:
            self.__blockIds = bids

    def setJX(self, jx):
        if '1' == jx or jx > 0 or True == jx:
            self.__jx = '1'

    @ staticmethod
    def disposeName(name):
        if None != name:
            name = name.replace('/', '')
            name = name.replace('.', '')
        return name.strip()

    def getId(self):
        return self.__id

    def getNovelUrl(self):
        return self.__novelUrl

    def getName(self):
        return self.__name

    def getAuthor(self):
        return self.__author

    def getImgUrl(self):
        return self.__imgUrl

    def getImgContent(self):
        return self.__imgContent

    def getImgType(self):
        return self.__imgType

    def getCategory(self):
        return self.__category

    def getStatus(self):
        return self.__status

    def getChapter(self):
        return self.__chapterUrl

    def getErrorChapter(self):
        return self.__errorChapter

    def getRightChapter(self):
        return self.__rightChapter

    def getDesc(self):
        return self.__desc

    def getChapterContent(self):
        return self.__chapterContent

    def getIntime(self):
        return self.__intime

    def getUpdateTime(self):
        return self.__updateTime

    def getOnline(self):
        return self.__online

    def getBlockIds(self):
        return self.__blockIds
    
    def getJX(self):
        return self.__jx

if __name__ == '__main__':
    novel = NovelBean()
    novel.setName('大主宰')
    #print novel.getName()
    
    exit(0)
    