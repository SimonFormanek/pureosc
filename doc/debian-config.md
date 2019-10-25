## no blank screen on console
From root tty:
  setterm -blank 0
  
## HandleLidSwitch
  cat /etc/systemd/logind.conf
  HandleLidSwitch=ignore

for p in /sys/class/drm/*/status; do con=${p%/status}; echo -n "${con#*/card?-}: "; cat $p; done
