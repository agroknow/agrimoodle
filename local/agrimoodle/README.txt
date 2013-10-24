$Id: README.txt $

AGRI-MOODLE Module for Moodle 2.X
=================================

Overview
--------
This is the base module that factors out code and configuration which is being
used by other agrimoodle-related modules.

It's still under heavy development.


Requirements
------------
Moodle 2.0 or later
Note: All files are utf8-encoded.

Installation
------------
A simple 1-2-3 process:
* Install this plugin in your /local folder
* Then login as an admin and go to: Site Administration -> Notifications
* This should trigger the installation process


Description of files
--------------------
(see also: http://docs.moodle.org/dev/Local_customisation)

* local/agrimoodle/db/version.php - version of script (must be incremented after changes)
* local/agrimoodle/db/install.xml - executed during install (new version.php found)
* local/agrimoodle/db/install.php - executed right after install.xml
* local/agrimoodle/db/uninstall.php - executed during uninstallation
* local/agrimoodle/db/upgrade.php - executed after version.php change
* local/agrimoodle/db/access.php - definition of capabilities
* local/agrimoodle/db/events.php - event handlers and subscripts
* local/agrimoodle/db/messages.php - messaging registration
* local/agrimoodle/db/services.php - definition of web services and web service functions
* local/agrimoodle/lang/en/local_agrimoodle.php - language file
* local/agrimoodle/settings.php - admin settings


Credits and Copyright
---------------------
This work is being developed by AGRO-KNOW Technologies and EUMMENA (2012-)
- http://www.agroknow.gr
- http://www.eummena.org

Software team:
- Tasos Koutoumanos <tafkey@about.me>
- Ahmad Shukr <ahshukr@gmail.com>
 