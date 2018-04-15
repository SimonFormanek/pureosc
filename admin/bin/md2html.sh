#!/bin/bash
F=`basename -s .md $1`
e $1
Markdown.pl $1 > $F.html
lynx $F.html
