import json
import unittest

import main as backend


{
	_id: ,
	Patient_ID: "10025AE336"
	Anthropometrics:{
		
		First_Name: "Radhika",
		Last_Name: "Sharma",
		Date_Of_Birth: "1995-09-26",
        	Gender: "Mâle",
        	Age : "27", 
        	Height : "18",
       	 	Weight: "70",
       	 	BMI:"", 
        	Weight status : "",
        	Pregnancy status:"",
        	blood group: "",
        	Smoking status: "",
        	Current alcohol drinking : "",
        	Comorbidity : "",
        	Indication for testing : "Exposure to confirmed  SARS-CoV-2 contact /Symptomatic presentation"
        
	},
	Contact: {
		e-mail: "radhika_sharma.123@gmail.com",
		phone: "9848022338"
	},
	Address: {
		city: "Hyderabad",
		Country: "South Africa"
	}
    
    History of Chronic or Infectious Disease: {
		diabetes: "",
		Cancer : "", 
        	Coronary heart disease : "",
        	Previous stroke: "",
        	Respiratory disease :"acute", 
        	Severe pneumonia : "",
        	hypertension :"",
        	Cerebrovascular disease : "",
        	Tuberculosis : "",
        	pneunomie  : ""
	}
    
     COVID_19 Symptoms: {
		Fever: "",
		Dry cough : "",
        	Throat pain : " ",
        	Cold : "",
        	Muscle pain :"",
        	Anosmia : "",
        	Dry cough or coughing up mucus : "",
        	Blocked nose  : "",
        	Problems breathing  : "",
        	Headache  : "",
        	Sore throat :"",
        	Muscle or joint pains : "",
        	Chest pain : "",
        	Sinonasal pain  : "",
        	Loss of appetite : "",
        	Felt tired   : "",
        	Diarrhea  :"",
        	Nausea  : "",
        	Vomit : "",
        	Abdominal pain   : "",
        	Dizziness  : ""     
        
	}    
}









class BackendTestCase(unittest.TestCase):

    def __init__(self, method_name='runTest'):
        super(BackendTestCase, self).__init__(method_name)
        backend.app.testing = True
        self.app = backend.app.test_client()

    def test_1_post_enterprises(self):
        rsp = self.app.post('/enterprise', data=json.dumps(enterprise1))
        self.assertTrue('id' in json.loads(rsp.data))

        rsp = self.app.post('/enterprise', data=json.dumps(enterprise2))
        self.assertTrue('id' in json.loads(rsp.data))

        rsp = self.app.post('/enterprise', data=json.dumps(enterprise3))
        self.assertTrue('id' in json.loads(rsp.data))

        rsp = self.app.post('/enterprise', data=json.dumps(enterprise4))
        self.assertTrue('id' in json.loads(rsp.data))

        rsp = self.app.post('/enterprise', data=json.dumps(enterprise5))
        self.assertTrue('id' in json.loads(rsp.data))

    def test_2_get_enterprises(self):
        rsp = self.app.get('/enterprises')
        enterprises = json.loads(rsp.data)
        self.assertEqual(len(enterprises), 5)


if __name__ == '__main__':
    unittest.main()
