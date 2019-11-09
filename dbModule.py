# -*- coding: utf-8 -*-
"""
Created on Sat Nov  9 17:17:18 2019

@author: hyeji
"""

import pymysql

class Database():
    def __init__(self):
        self.db= pymysql.connect(host='localhost',
                                  user='nlpg',
                                  password='ewha1886!',
                                  db='nlpg',
                                  charset='utf8')
        self.cursor= self.db.cursor(pymysql.cursors.DictCursor)

    def execute(self, query, args={}):
        self.cursor.execute(query, args)

    def executeOne(self, query, args={}):
        self.cursor.execute(query, args)
        row= self.cursor.fetchone()
        return row

    def executeAll(self, query, args={}):
        self.cursor.execute(query, args)
        row= self.cursor.fetchall()
        return row

    def commit():
        self.db.commit()