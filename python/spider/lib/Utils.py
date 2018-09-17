#!/usr/bin/env python
# -*- encoding=utf8 -*-
import sys
reload(sys)
sys.setdefaultencoding('utf8')
import re

''' 在url去除.html的末尾存在章节序号信息 '''
def chapter_default_cb(name, url):
    urlnum = url[:-5].split('/')[-1]
    name = urlnum + '{]' + name
    return (name, url)


class Utils:

    @staticmethod
    def norm_name(mstr):
        return mstr
    
    @staticmethod
    def norm_author(mstr):
        mstr = re.sub(u'^作者[:：]', '', mstr, re.I)
        return mstr
    
    @staticmethod
    def norm_category(mstr):
        
        # 删除开始位置 "类型"
        mstr = re.sub(u'^类型[:：]', '', mstr, re.I)
        return mstr
        
    @staticmethod
    def norm_status(mstr):
        
        # 删除开始出 "状态"
        mstr = re.sub(u'^状态[:：]', '', mstr, re.I)
        return mstr
    
    @staticmethod
    def norm_chapter(name, url, call_back=chapter_default_cb):
        return call_back(name, url)
        
            
    
if __name__ == '__main__':

    name, url = Utils.norm_chapter("测试1", "http://www.baidu.com/1/121312/123.html")
    print name
    print url