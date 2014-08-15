<?php
$config = <<<EOD
{
	"info":  {
		"name": "fieldpassword",
		"description": {
			"en": "set a Password tode/encrypt a cryptable Field ( c_ )",
			"de": "Passwort-Eingabe zur Entschlüsselung eines verschlüsselten Feldes"
		},
		"io":  [
			"",
			""
		],
		"authors":  ["Christoph Taubmann"],
		"homepage": "http://cms-kit.org",
		"mail": "info@cms-kit.org",
		"copyright": "GPL",
		"credits":  []
	},
	"system":  {
		"version": 0.8,
		"inputs":  [
			"VARCHAR",
			"TEXT"
		],
		"include":  ["wizard:fieldpassword\\nexternal:true"],
		"translations":  [
			"en",
			"de"
		]
	}
}
EOD;
?>
