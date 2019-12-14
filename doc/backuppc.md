#backuppc

## install

TODO

## add server to backup

### on backup server

  cd /etc/backuppc/
  cp template server
  edit server
  #replace /home/template /home/server string

do not forget add exclusion of private ssh keys in BackupFilesExclude section

### on new client

  sudo apt install rsync
  sudo adduser backuppc
  su - backuppc
  ssh-keygen
  ssh-copy-id rsync-server:
  ssh -v cloud.pureosc.cz 'sudo rsync'
