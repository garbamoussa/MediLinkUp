import json

from pymongo import MongoClient
from flask import Flask, request

client = MongoClient(username='admin', password='password')
db = client.sms_risk
app = Flask(__name__)


@app.route('/enterprises', methods=['GET'])
def retrieve_enterprises():

    rsp = []

    for enterprise in db.enterprises.find():
        enterprise['id'] = str(enterprise['_id'])
        del enterprise['_id']
        rsp.append(enterprise)

    return json.dumps(rsp)


@app.route('/enterprise', methods=['POST'])
def create_enterprise():

    enterprise = json.loads(request.data)

    rsp = db.enterprises.insert_one(enterprise)

    return json.dumps({'id': str(rsp.inserted_id)})


HOST = '0.0.0.0'
DEBUG = True

if __name__ == "__main__":
    app.run(host=HOST, debug=DEBUG)
