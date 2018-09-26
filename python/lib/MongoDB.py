#!/usr/bin/env python
# -*- encoding=utf8 -*-

import sys
reload(sys)
import bson
import time
import gridfs
import logging
import hashlib
import datetime
import logging.handlers
from NovelBean import NovelBean
from pymongo import MongoClient

sys.setdefaultencoding('utf8')

class MongoDB:
    def __init__(self):
        self.log = logging.getLogger('Mongo-lib')
        sh = logging.StreamHandler(stream=None)
        fm = logging.Formatter('%(asctime)s  %(levelname)s   %(name)s - %(filename)s:%(lineno)s - %(message)s')
        self.log.setLevel(logging.INFO)
        sh.setFormatter(fm)
        self.log.addHandler(sh)