#!/usr/bin/env python
# -*- encoding=utf8 -*-

import sys
reload(sys)
sys.path.append('../../lib')
sys.setdefaultencoding('utf8')

from function import log_init
from function import get_book_list
from function import get_book_info
from function import get_book_content
from function import get_book_category_list
from function import insert_mongodb
from function import get_history_bookurl
from function import get_no_history_url

if __name__ == '__main__':
    bookCategory = []                                                                       # 书籍分类
    bookList = []
    hlist = []

    port = 27017
    ip = '127.0.0.1'
    db = 'spiderNovel'
    cinfo = 'mzhu8_info'
    cdata = 'mzhu8_data'
    log = log_init('mzhu8')

    log.info('spider 初始化成功')
    get_book_category_list(bookCategory)                                                    # 书籍个分类页面
    log.info('spider 获取书籍分类页面成功')

    for url in bookCategory:
        bookList += get_book_list(url)
        bookList = list(set(bookList))
    log.info('spider 获取书籍列表成功!数量 ' + str(len(bookList)) + ' 本')

    # 获取历史书籍 并去除
    hlist = get_history_bookurl(ip, port, db, cinfo)
    log.info('历史抓取书籍 ' + str(len(hlist)) + ' 本')
    bookList = get_no_history_url(bookList, hlist)
    log.info('将要抓取书籍 ' + str(len(bookList)) + ' 本')

    # 抓取每本书
    for url in bookList:
        # 获取书籍信息
        novelInfo = get_book_info(url)
        if None == novelInfo:
            continue
        # 抓取书籍内容
        get_book_content(novelInfo)
        # 分别存储书籍章节信息 和 书籍信息
        insert_mongodb(ip, port, db, cinfo, cdata, novelInfo)