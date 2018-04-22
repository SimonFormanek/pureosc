#!/bin/bash
#sending F12+Enter F12: ^[[24~, Enter: ^M (sending F2 can cause problems
screen -list | grep autosaveprefix_|sed 's/(.*/-X stuff ^[[24~^M/'|sed 's/^/screen -S /'|bash /dev/stdin
