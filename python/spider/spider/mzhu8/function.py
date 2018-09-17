#!/usr/bin/env python
# -*- encoding=utf8 -*-

import sys
reload(sys)
sys.path.append('../../lib')
sys.setdefaultencoding('utf8')
import re
import time
import random
import logging
import HttpUtil
import datetime
import logging.handlers
from Utils import Utils
from MongoDB import MongoDB
from bs4 import BeautifulSoup
from NovelBean import NovelBean


def log_init(logName):
    global log
    global spider
    spider = HttpUtil.HttpUtil()
    log = logging.getLogger(logName)
    sh = logging.StreamHandler(stream=None)
    fm = logging.Formatter('%(asctime)s  %(levelname)s   %(name)s - %(filename)s:%(lineno)s - %(message)s')
    log.setLevel(logging.INFO)
    sh.setFormatter(fm)
    log.addHandler(sh)
    return log

''' 获取各个书籍分类的分类列表 '''
def get_book_category_list(mlist):
    #basePath = {'http://www.mzhu8.com/mulu/27/': 2}
    basePath = {'http://www.mzhu8.com/mulu/0/':247,\
                'http://www.mzhu8.com/mulu/1/' : 8,\
                'http://www.mzhu8.com/mulu/2/' : 11,\
                'http://www.mzhu8.com/mulu/3/' : 3,\
                'http://www.mzhu8.com/mulu/4/' : 4,\
                'http://www.mzhu8.com/mulu/5/' : 5,\
                'http://www.mzhu8.com/mulu/6/' : 51,\
                'http://www.mzhu8.com/mulu/7/' : 13,\
                'http://www.mzhu8.com/mulu/8/' : 5,\
                'http://www.mzhu8.com/mulu/9/' : 1,\
                'http://www.mzhu8.com/mulu/10/': 5,\
                'http://www.mzhu8.com/mulu/11/': 3,\
                'http://www.mzhu8.com/mulu/12/': 3,\
                'http://www.mzhu8.com/mulu/13/': 1,\
                'http://www.mzhu8.com/mulu/14/': 1,\
                'http://www.mzhu8.com/mulu/15/': 2,\
                'http://www.mzhu8.com/mulu/16/': 36,\
                'http://www.mzhu8.com/mulu/17/': 45,\
                'http://www.mzhu8.com/mulu/18/': 12,\
                'http://www.mzhu8.com/mulu/19/': 9,\
                'http://www.mzhu8.com/mulu/20/': 1,\
                'http://www.mzhu8.com/mulu/21/': 21,\
                'http://www.mzhu8.com/mulu/22/': 1,\
                'http://www.mzhu8.com/mulu/23/': 1,\
                'http://www.mzhu8.com/mulu/24/': 8,\
                'http://www.mzhu8.com/mulu/25/': 3,\
                'http://www.mzhu8.com/mulu/27/': 2}
    for ik, iv in basePath.items():
        if ik[-1] == "/":
            ik = ik[:-1]
        for i in range(1, iv + 1, 1):
            mlist.append(ik + "/" + str(i) + ".html")
    return mlist

def get_book_list(url):
    mlist = []
    url = url.strip('\n')
    ret, data = spider.getHtml(url, code='gbk')
    if False == ret:
        log.error('页面获取失败, url: ' + data)
    else:
        soup = BeautifulSoup(data, 'lxml')
        adiv = soup.find_all('a')
        for i in adiv:
            url = ''
            if i.has_attr('href'):
                url = i['href']
            else:
                url = None
            if url and re.match('http://www.mzhu8.com/book/\d+/index.html', url, re.I):
                mlist.append(url.strip())
    return mlist

''' 获取书籍信息并做初始处理 '''
def get_book_info(url):
    data = ''
    ret = None
    novel = NovelBean()

    novel.setNovelUrl(url)
    ret, data = spider.getHtml(url, code='gbk')
    if False == ret:
        log.error('抓取小说信息失败, url' + data)
        novel = None
    if None != novel:
        soup = BeautifulSoup(data, 'lxml')
        # 解析封面图片
        tmp = soup.find('div', id='fmimg')
        if None != tmp:
            imgdiv = tmp.find('img')
            if None != imgdiv and imgdiv.has_attr('src'):
                url = imgdiv['src']
                arr = url.split('.')
                novel.setImgUrl(url)
                if len(arr) > 2:
                    novel.setImgType(arr[-1])
        # 解析章节信息
        tmp = soup.find('div', id='list')
        if None != tmp:
            chapters = tmp.dl.find_all('dd')
            if None != chapters:
                for itag in chapters:
                    # itag 表示 a 的链接
                    atag = itag.a
                    if None != atag:
                        ataghref = atag.attrs['href']
                        atagname = atag.string
                        if None == ataghref:
                            continue
                        if None == atagname:
                            atagname = ''
                        ataghref = 'http://www.mzhu8.com' + ataghref
                        atagname, ataghref = Utils.norm_chapter(atagname, ataghref)
                        novel.setChapter(atagname, ataghref)

        # 解析其他信息
        tmp = soup.find('div', class_='infos')
        if None != tmp:
            namediv = tmp.parent.find('h1')
            authordiv = tmp.find('span', class_='i_author')
            categorydiv = tmp.find('span', class_='i_sort')
            statusdiv = tmp.find('span', class_='i_lz')
            # 书名
            if None != namediv:
                novel.setName(Utils.norm_name(namediv.string))
            # 作者名
            if None != authordiv:
                novel.setAuthor(Utils.norm_author(authordiv.string))
            # 分类
            if None != categorydiv:
                novel.setCategory(Utils.norm_category(categorydiv.string))
            # 状态 连载/完结
            if None != statusdiv:
                novel.setStatus(Utils.norm_status(statusdiv.string))
        if '' == novel.getName() and len(novel.getChapter()) <= 0:
            novel = None
    return novel

''' 获取历史爬取数据 '''
def get_history_bookurl(ip, port, db, collection):
    mlist = []
    mongo = MongoDB()
    mongo.connect(ip, port)
    mongo.setCollection(db, collection)
    ret = mongo.selectDocuments({}, {'novelUrl': 1})
    for i in ret:
        try:
            mlist.append(i['novelUrl'])
        except BaseException as e:
            log.error('没有字段' + e.message)
    mlist = list(set(mlist))
    return mlist

def get_no_history_url(all, mhistory):
    dset = []
    aset = set(all)
    hset = set(mhistory)
    dset = list(set(aset - hset))
    return dset


''' 主要是获取 书籍封面图片 章节内容 '''
def get_book_content(novel):
    flag = True
    imgUrl = novel.getImgUrl()
    posthead = {}
    postpara = {}
    postUrl = 'http://www.mzhu8.com/modules/article/show.php'
    posthead['Cache-Control'] = 'no-cache'
    posthead['Content-Type'] = 'application/x-www-form-urlencoded'
    
    # 获取图片内容
    if '' != imgUrl:
        ret, data = spider.downloadImageBase64(imgUrl)
        if True == ret:
            novel.setImgContent(data)
    # 抓取章节信息
    for name, url in novel.getChapter().items():
        ret, data = spider.getHtml(url, code='gbk')
        if False == ret:
            flag = False
            log.error('书籍(' + novel.getName() + ')缺少章节' + name + ' url:(' + url + ')')
            novel.setErrorChapter(name, url)
            continue

        # 解析章节 post 参数
        soup = BeautifulSoup(data, 'lxml')
        contentdiv = soup.find('div', id='chapterContent')
        if None != contentdiv:
            mo = re.findall(r'\d+', contentdiv.string, re.I)
            if len(mo) >= 2:
                postpara['aid'] = str(mo[0])
                postpara['cid'] = str(mo[1])
                postpara['r'] = str(random.random()) + '1111'
        # post 请求章节信息
        ret, data = spider.postHtml(postUrl, posthead, postpara)
        if False == ret:
            flag = False
            novel.setErrorChapter(name, url)
            continue
        novel.setRightChapter(name, url)
        data = spider.cleanTags(data)
        data = spider.replaceHtml(data)
        novel.setChapterContent(name, data)
    return flag

def insert_mongodb(ip, port, db, cinfo, cdata, novel):
    mongo = MongoDB()
    # 获取数据库
    info, retToDB = MongoDB.novelPackage(novel)
    mongo.connect(ip, port)
    if None != info:
        mongo.setCollection(db, cinfo)
        mongo.insertOneDocument(info)
        mongo.setCollection(db, cdata)
        mongo.insertManyDocument(retToDB)