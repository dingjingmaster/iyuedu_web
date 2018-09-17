#!/usr/bin/env python
# -*- encoding=utf8 -*-

import sys
reload(sys)
sys.path.append('../lib')
sys.setdefaultencoding('utf8')

import time
import random
import thread
import threading

from selenium import webdriver


if __name__ == '__main__':
    threads = []
    books = ['http://www.enjoyread.top/web/content/content/id/02ee9bde4b05f7ea1b7b4ae071376b26/num/162183/name/%E7%AC%AC%E4%B8%80%E7%AB%A0%20%E6%96%A9%E8%8D%89%E9%99%A4%E6%A0%B9%EF%BC%81',
             ]

    # geckodriver
    gbrower = webdriver.Chrome('../lib/chromedriver.exe')
    #gbrower = webdriver.Firefox('../lib/geckodriver')
    gbrower.get('http://www.enjoyread.top')                                         # 打开首页
    time.sleep(6)
    gbrower.get('http://www.enjoyread.top/web/category/category/')
    time.sleep(6)
    gbrower.get(books[random.randint(0, len(books)-1)])
    while True:
        time.sleep(1 + random.randint(0, 3))
        url = ''
        try:
            url = gbrower.find_elements_by_link_text(u'下一章')[0].get_attribute('href')
        except:
            break
        ''' 开始滚动阅读 '''
        for i in range(0, 10000, 500):
            js = 'window.scrollTo(0,' + str(i) + ')'
            try:
                gbrower.execute_script(js)
            except:
                pass
            time.sleep(1)
        gbrower.get(url)
    gbrower.quit()