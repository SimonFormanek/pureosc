# xen config
list live xens

  xl list

create (start) from config

  xl create -c xen-hostname.cfg

create manually

  xen-create-image --hostname domena.cz --lvm vg1 --force --broadcast 213.151.89.127 --gateway 213.151.89.65 --ip 8.8.8.8 --netmask 255.255.255.0 --nodhcp

### console 

  xl console xen-hostname

exit console
  Ctrl+]

host reboot/shutdown
  xl reboot xen-host.cfg
  xl shutdown xen-host.cfg
  xl destroy xen-host.cfg

## restart xen
  systemctl restart xen

