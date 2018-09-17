#!/usr/bin/env python
# -*- encoding=utf8 -*-

import re
import sys
reload(sys)
import time
import base64
import urllib
import urllib2
import httplib
import logging
import datetime
import cStringIO
import logging.handlers
from PIL import Image
from bs4 import BeautifulSoup

sys.setdefaultencoding('utf8')

class HttpUtil:
    def __init__(self):
        # 日至初始化
        self.log = logging.getLogger('HttpUtil')
        sh = logging.StreamHandler(stream=None)
        fm = logging.Formatter('%(asctime)s  %(levelname)s   %(name)s - %(filename)s:%(lineno)s - %(message)s')
        self.log.setLevel(logging.INFO)
        sh.setFormatter(fm)
        self.log.addHandler(sh)
        
        self.tryTime = 10                                           # 失败尝试次数
        self.conn = None
    
    
    def getHtml(self, url, code='utf8'):
        data = ''
        tryInt = 0
        ret = True
        htype, host, req = HttpUtil.parseUrl(url)
        if 'http' == htype:
            self.conn = HttpUtil.getHttpConnection(host)
        elif 'https' == htype:
            self.conn = HttpUtil.getHttpsConnection(host)
            
        while tryInt <= self.tryTime:
            try:
                self.conn.request('GET', req)
                res = self.conn.getresponse()         
                if 200 == int(res.status):
                    ret = True
                    data = '' + res.read().decode(code)
                    self.log.info('get url' + url + ' ok!')
                    break
                else:
                    ret = False
                    data = '' + url
                    time.sleep(0.1)
            except BaseException as e:
                ret = False
                data = url
                time.sleep(0.1)
                self.log.error('get 请求失败!' + e.message)
            tryInt += 1
        return (ret, data)
    
    
    def postHtml(self, url, heads, params, code='utf8'):
        data = url
        tryInt = 0
        ret = True
        if len(heads) <=0 or len(params) <= 0:
            ret = False
        htype, host, req = HttpUtil.parseUrl(url)
        if 'http' == htype:
            self.conn = HttpUtil.getHttpConnection(host)
        elif 'https' == htype:
            self.conn = HttpUtil.getHttpsConnection(host)
        while tryInt <= self.tryTime and ret:
            try:
                self.conn.request('POST', req, urllib.urlencode(params), heads)
                res = self.conn.getresponse()
                if 200 == int(res.status):
                    ret = True
                    data = '' + res.read().decode(code)
                    self.log.info('post url' + url + ' ok!')
                    break
                else:
                    ret = False
                    data = url
                    time.sleep(0.1)
            except BaseException as e:
                ret = False
                time.sleep(0.1)
                data = url
                self.log.error('post 请求失败!' + e.message)
            tryInt += 1
        return (ret, data)
    
    def downloadImageBase64(self, url):
        tryInt = 0
        data = url
        ret = True
        
        while tryInt <= self.tryTime:
            try:
                img = cStringIO.StringIO(urllib2.urlopen(url).read())
                data = base64.b64encode(img.getvalue())
                ret = True
            except BaseException as e:
                ret = False
                self.log.error('下载图片内容失败!' + e.message)
            tryInt += 1
        return (ret, data)
        
        # 解码
        #image = Image.open(cStringIO.StringIO(base64.b64decode(bs64)))
        #image.show()

    
    def download(self, url, savePath):
        ret = True
        data = ''
        tryInt = 0
        while tryInt <= self.tryTime:
            ret = True
            data = ''
            try:
                urllib.urlretrieve(url, savePath)
                break
            except BaseException as e:
                data = url
                ret = False
                time.sleep(0.1)
                self.log.error('下载内容失败!' + e.message)    
            tryInt += 1
            time.sleep(0.1)
        return (ret, data)    
    
    
    @staticmethod
    def getHttpConnection(host):
        return httplib.HTTPConnection(host, 80, True, 3000)
    
    
    @staticmethod
    def getHttpsConnection(host):
        return None
    
    
    @staticmethod
    def cleanTags(html):
        html = re.sub(r'<br(.*|.?)>', '', html.decode('utf8'), 0, re.I)
        html = html.replace('<p>', '')
        html = html.replace('</p>', '')
        return html


    @staticmethod
    def replaceHtml(html):
        dict = {'&lt;':'<', '&gt;':'>', '&nbsp;':' ', '&quot;':'\"', '&deg;':'。'}
        for k, v in dict.items():
            html = html.replace(k, v)
        return html

    @staticmethod
    def parseUrl(url):
        htype = ''
        host = ''
        req = ''
        arr = url.split("://")
        if len(arr) == 1:
            host = arr[0]
        elif len(arr) == 2:
            host = arr[1]
        else:
            return None
        if arr[0] == 'https' or arr[0] == 'http':
            htype = arr[0]
        else:
            htype = 'http'
        arr = host.split("/")
        if len(arr) == 1:
            host = arr[0]
            req = '/'
        else:
            host = arr[0]
            req = '/' + '/'.join(arr[1:])
        return (htype, host, req)
    
    
    
    