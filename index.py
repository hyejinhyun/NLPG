# Import flask dependencies
from flask import Blueprint, render_template    # ,request, render_template, flash, redirect, url_for
from flask import current_app as current_app

from module import dbModule
from module import crawling_textrank_mysql

# Define the blueprint
main= Blueprint('index.html', __name__, url_prefix='/')   #url_prefix는 파일 경로

crawling_textrank_mysql.myThread("hi", 300000)

# SELECT 함수
@main.route('/')
@main.route('/index.html', methods=['GET'])
def select():
    db_class= dbModule.Database()

    sql     = "SELECT title, content,url \
               FROM nlpg$nlpg.news \
               ORDER By id DESC \
               LIMIT 10;"
    row     = db_class.executeAll(sql)

    print(row)

    return render_template('/index.html',
                            resultData=row[:11])
