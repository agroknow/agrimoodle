#!/bin/sh

# the backup directory, change this if needed
backup_dir="~/backups"
mkdir "${backup_dir}"

# nothing to change from here on...

# prepare some strings (date and backup file)
d=`date +%Y%m%d`
bf="${backup_dir}/${d}_loms.tgz"

# fire the commands
find . -name '*.json' | xargs tar zcvf $bf
ln -f $bf loms_backup.tgz

# and let them know we're done!
echo "All json files have been archived in ${bf} (linked to loms_backup.tgz)"

