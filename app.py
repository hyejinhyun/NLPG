from flask import Flask
# Import a module/component using its blueprint handler variable
from module.index import main

app = Flask(__name__)

# Register blueprint
app.register_blueprint(main)

if __name__ == "__main__":
    app.run()
