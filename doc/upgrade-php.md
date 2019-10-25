# upgrade-php
Replace 7.2, 7\.2 with your version,
  apt install `aptitude search php7.2 | grep -v :i386 | awk '{print $2}' | sed 's/7\.2/7\.3/' | xargs`
