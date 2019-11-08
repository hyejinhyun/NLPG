import pymysql

from flaskimport Blueprint, request, render_template, flash, redirect, url_for
from flaskimport current_app as current_app
 
from app.moduleimport dbModule
 
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

test= Blueprint('test', __name__, url_prefix='/')   #url_prefix는 파일 경로
 
@test.route('/', methods=['GET'])
def index():
    return render_template('/index.html',
                            resultData=None)
 
 
 
# SELECT 함수 예제
@test.route('/', methods=['GET'])
def select():
    db_class= dbModule.Database()
 
    sql     = "SELECT title, content,url \
                FROM nlpgDB.testTable \
                ORDER By id DESC \
                LIMIT 10"
    row     = db_class.executeAll(sql)
 
    print(row)
 
    return render_template('/index.html',
                            resultData=row[:11])
 
