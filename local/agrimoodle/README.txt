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


Installation
------------
   The zip-archive includes the same directory hierarchy as moodle
   So you only have to copy the files to the correspondent place.
   copy the folder agrimoodle.zip/mod/agrimoodle --> [moodle]/mod/agrimoodle
   The langfiles normaly can be left into the folder mod/agrimoodle/lang.
   All languages should be encoded with utf8.

After it you have to run the admin-page of moodle (http://moodle-site/admin)
in your browser. You have to loged in as admin before.
The installation process will be displayed on the screen.
That's all. Good luck!


Description of files
--------------------
(see also: http://docs.moodle.org/dev/Local_customisation)

* /local/agrimoodle/db/version.php - version of script (must be incremented after changes)
* /local/agrimoodle/db/install.xml - executed during install (new version.php found)
* /local/agrimoodle/db/install.php - executed right after install.xml
* /local/agrimoodle/db/uninstall.php - executed during uninstallation
* /local/agrimoodle/db/upgrade.php - executed after version.php change
* /local/agrimoodle/db/access.php - definition of capabilities
* /local/agrimoodle/db/events.php - event handlers and subscripts
* /local/agrimoodle/db/messages.php - messaging registration
* /local/agrimoodle/db/services.php - definition of web services and web service functions
* /local/agrimoodle/lang/en/local_agrimoodle.php - language file
* /local/agrimoodle/settings.php - admin settings


Credits and Copyright
---------------------
This work is being developed by EUMMENA (2012-) 
http://www.eummena.org

Software team:
- Tasos Koutoumanos
- Ahmad Shukr <ahshukr@gmail.com>

@TODO
  * check out TODO.txt
 