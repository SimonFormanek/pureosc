# screen

## setup sbcrollback buffer
On debian use this settings. More info https://stackoverflow.com/questions/359109/using-the-scrollwheel-in-gnu-screen
user
  echo 'termcapinfo xterm* ti@:te@' >> ~/.screenrc
global
  echo 'termcapinfo xterm* ti@:te@' >> /etc/screenrc