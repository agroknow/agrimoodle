# agriMoodle HUB

> HUB URL  : http://wiki.rural-inclusion.eu/am-hub/
> PASSWORD : (empty)

## LOG

### Tue, Jun 25 2013
~ 
~ registered apivita instance. it can now **Publish** to the hub
~ setup at http://wiki.rural-inclusion.eu/am-hub/
~ discussion with Giannis


## TODO
- how can we massively "publish" existing courses
- try changing the default theme
- how can we have our hub to appear in the official "HUBS" list 


## INSTALLATION

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
password: (check zim)
