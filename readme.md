# cms-kit Wizard Field-Password-Editor

Path: cms-kit/backend/wizards/fieldpassword

## Description


This Wizard lets you set an *individual password* for an encryptable field.
The field must have a field-name beginning with "c_".
Inputs are de/encoded via Blowfish.
The password is stored as a session and will be deleted on logout.


If no password is set, the field is skipped while saving and the encrypted content will not been shown in backend!

You can set/define a passord in various ways:

1. The password can be set once per session/field via the wizard "fieldpassword".
2. There is also another wizard to set one password for all crypted fields!
To make it accessible from the backend simply put this into your settings
("Package-Manager">"Project-Extensions">"all">"Configuration")

	"wizards": [
		{
			"label": "Field-password",
			"url": "wizards/fieldpassword/setkey.php?project=%projectName%"
		}
	]

3. If you want to define a fixed password (*only in trusted surroundings*)
you can define your password in your settings and define a JSON-Object (Type object) *"crypt"*,
witch you have to define an JSON-Object (Type object) with
  * your *Database-object-name* and
  * a JSON-Object (Type string) with your *field-name* holding your password.


	"crypt":  {
		"objectname":  {
			"c_fieldname": "my_supersecret_password"
		}

	}


## Installation

### manual Installation

1. download and extract this Folder into backend/wizards/

### Installation via package management





