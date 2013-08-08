=== APIVITA installation ===


Installation on wiki.rural-inclusion.eu (62.217.124.232)


$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'apivita_am';
$CFG->dbuser    = 'root';
$CFG->dbpass    = 'XXXXX';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array 


- http://62.217.124.232/herbal-mednet
- Agrimoodle admin account:
  webmaster / (check zim)





git remote add moodle git://git.moodle.org/moodle.git
git pull moodle MOODLE_25_STABLE
...
(only conflict was with .gitignore)
git commit -a


Your Moodle files have been changed, and you are about to automatically upgrade your server to this version:
2.5 (Build: 20130514) (2013051400.00)
