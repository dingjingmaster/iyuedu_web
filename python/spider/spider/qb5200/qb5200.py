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
    bookCategory = []                                                           # 书籍分类
    bookList = []
    hlist = []