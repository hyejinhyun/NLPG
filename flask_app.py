from flask import Flask
from flaskext.mysql import MySQL
#from gevent.pywsgi import WSGIServer
from module.index import main


app = Flask(__name__)
app.config["DEBUG"] = True
mysql=MySQL()

# MySQL configurations
app.config['MYSQL_DATABASE_USER'] = 'nlpg'
app.config['MYSQL_DATABASE_PASSWORD'] = 'ewha1886!'
app.config['MYSQL_DATABASE_DB'] = 'nlpg$nlpg'
app.config['MYSQL_DATABASE_HOST'] = 'nlpg.mysql.pythonanywhere-services.com'
mysql.init_app(app)

app.register_blueprint(main)

if __name__ == "__main__":
    app.run()
    '''
    http_server = WSGIServer(('', 5000), app)
    http_server.serve_forever()
    '''
