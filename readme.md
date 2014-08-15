# cms-kit Wizard Field-Password-Editor

Path: cms-kit/backend/wizards/fieldpassword

## Description


This Wizard lets you set a *individual Password* for an encryptable Field. The Field must have a Field-Name beginning with "c_". Inputs (Text-Fields) are de/encoded via Blowfish. The password is stored as a Session and will be deleted on Logout.


If no Password is set, the Field is skipped while saving and the encrypted Content will not been shown in Backend!

You can set/define a Passord in various ways:

1. The Password can be set once per Session/Field via the Wizard "fieldpassword".
2. There is also another Wizard to set one Password for all crypted Fields! To make it accessible from the Backend simply put this into your Settings ("Extensinon-Manager">"Project-Extensions">"all">"Configuration")

	"wizards": [
		{
			"label": "Field-Password",
			"url": "wizards/fieldpassword/setkey.php?project=%projectName%"
		}
	]

3. If you want to define a fixed Password (*in trusted Surroundings*) you can define your Password in your Settings and define a JSON-Object (Type object) *"crypt"*, with you have to define an JSON-Object (Type object) with your *Database-Object-Name* and a JSON-Object (Type string) with your *Field-Name* holding your Password.


	"crypt":  {
		"objectname":  {
			"c_fieldname": "my_secret_password"
		}

	}


## Installation

### manual Installation

1. download and extract this Folder into backend/wizards/

### Installation via package management





