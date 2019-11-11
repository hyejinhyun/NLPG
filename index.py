# Import flask dependencies
from flask import Blueprint, request, render_template, flash, redirect, url_for
from flask import current_app as current_app

from module import dbModule

# Define the blueprint
main= Blueprint('index', __name__, url_prefix='/')   #url_prefix는 파일 경로

# SELECT 함수 예제
@main.route('/', methods=['GET'])
def select():
    db_class= dbModule.Database()

    sql     = "SELECT title, content,url \
                FROM nlpgDB.newsTable \
                ORDER By id DESC \
                LIMIT 10"
    row     = db_class.executeAll(sql)

    print(row)

    return render_template('/nlpg/index.html',
                            resultData=row[:11])
