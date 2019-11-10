from flask import Flask

app = Flask(__name__)

# 위에서 추가한 파일을 연동
from nlpg.module.index import main as main
app.register_blueprint(main)

if __name__ == "__main__":
    app.run()
