#!/usr/bin/env python
# -*- encoding=utf8 -*-

import sys
reload(sys)
sys.path.append('../lib')
sys.setdefaultencoding('utf8')

from MongoDB import MongoDB
import time

''' mzhu8 上线 '''
def online_data(onlineIP, onlinePort,\
                localIP, localPort, localDB, info, data):
    # 线上数据库
    onlineMongo = MongoDB()
    onlineMongo.connect(onlineIP, onlinePort, user, pwd)

    # 本地数据库
    localMongo = MongoDB()
    localMongo.connect(localIP, localPort)

    # 获取目前线上数据库中已有书籍数量
    onlineMongo.setCollection('novel_online', 'online_info')
    ret = onlineMongo.selectDocumentById('detail')
    if not ret:
        # 设置默认值
        onlineMongo.insertOneDocument({'_id':'detail', 'size':'0'})
    onlineMongo.updateDocumentById('detail', 'category', categoryMap)

    # 获取本地书籍信息
    for i in localMongo.novelUnpackageAll(localDB, info, data):
        if None == i:
            print '遍历数据错误'
            break
        if(MongoDB.novelOnline(onlineIP, onlinePort, i, user, pwd)):
            localMongo.setCollection(localDB, info)
            localMongo.updateDocumentById(i.getId(), 'online', i.getOnline())


'''
    1. 读取抓取数据
    2. 检查能否上线
    3. 更新上线字段
    4. 检查线上是否存在 ? 更新 or 分配 gid 插入新字段
'''
if __name__ == '__main__':

    onlineIP = '127.0.0.1'
    onlineIP = '45.76.64.223'
    user = 'dingjing'
    pwd = 'root'
    onlinePort = 1888
    categoryMap = {}
    categoryMapPath = './data/category_info.txt'
    ''' 同步的数据库 '''
    localIP = '127.0.0.1'
    localPort = 27017
    localDB = 'spiderNovel'
    info1 = 'mzhu8_info'
    data1 = 'mzhu8_data'

    ''' 读取分类映射信息 '''
    fr = open(categoryMapPath, 'r')
    for line in fr.readlines():
        line = line.strip()
        if ("" != line) and ('#' != line[0]):
            arr = line.split('{]')
            categoryMap[arr[0]] = arr[1]

    ''' 数据同步到线上 '''
    online_data(onlineIP, onlinePort, localIP, localPort, localDB, info1, data1)


