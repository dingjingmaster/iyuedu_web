#!/usr/bin/env python
# -*- encoding=utf8 -*-

import sys
reload(sys)
sys.path.append('../lib')
sys.setdefaultencoding('utf8')

from MongoDB import MongoDB
import time

if __name__ == '__main__':
    onlineMongo = MongoDB()
    onlineMongo.connect('127.0.0.1', 27017)
    onlineMongo.setCollection('novel_online', 'online_info')
    modulePath = 'data/module.txt'

    module = {}
    rank = {}
    fr = open(modulePath, 'r')
    for i in fr.readlines():
        i = i.strip()
        if '' == i or '#' == i[0]:
            continue
        arr = i.split('{]')
        key = arr[0].strip()
        value = arr[1:]
        if 'rank' == key[0:4]:
            value = arr[1:]
            rank[key] = '{]'.join(value)
            continue
        module[key] = '{]'.join(value)
    onlineMongo.updateDocumentById('detail', 'module', module)
    onlineMongo.updateDocumentById('detail', 'mainRank', rank)
    pass