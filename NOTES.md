URLS: 
http://localhost/dev/agrimoodle/course/view.php?id=4
http://docs.moodle.org/dev/Data_manipulation_API

# TODO:

oai-target
----------
### Tasos, Nov 30
+ added iterator for json files, check: http://localhost:8080/agrimoodle/blocks/oai_target/lib/PMH.php?verb=GetSql
- TODO, NEXT: need to insert JSON's into DB for oai-pmh code to pick them up
- URGENT: find a proper way to provide a persistent unique ID
### Tasos, Dec 17
+ talked with Marinos... Not much progress, he'll need to catch up! (or exit...)


oerfinder
---------
### Tasos, Dec 17
+ catching up...


# agriMoodle HUB

http://docs.moodle.org/25/en/Hub_administration
- Install the latest stable version of Moodle somewhere on a web server with a nice URL.
- Download the latest hub plugin from https://github.com/moodlehq/moodle-local_hub
- Save the zip into the /local directory of Moodle and unzip, producing /local/hub
- Visit the "Notifications" page in Moodle (/admin) to complete the upgrade and install the hub software.
- Uncheck password policy (search 'passwordpolicy' in admin search)
- Allow extended characters in usernames (search 'extendedusernamechars' in admin search)
- Enable web services for the hub (Administration > Site Administration > Advanced features)
- Enable the XML-RPC protocol (Administration > Site Administration > Plugins > Web services > Manage protocols)
- Set up the SMTP (Administration > Site Administration > Plugins > Message outputs > Email)
- Set up the recaptcha (Administration > Site Administration > Plugins > Authentication > Manage authentication)
- Set up your hub (Administration > Site Administration > Hub > Settings) Supply a description, enable the hub, supply a hub password. 

setup on: http://wiki.rural-inclusion.eu/am-hub/
username: webmaster
password: Agr1M00dle!


# DEBUGGING:

  * print_object($USER);
  * var_dump(__FILE__, __LINE__, $record['lom_record']);

