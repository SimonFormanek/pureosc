#!/bin/bash
F=`basename -s .md $1`

#   SCREENDETACHED=`screen -list |grep autosaveprefix_$F`
    SCREENDETACHED=`screen -list |grep ${F}_autosaveprefix`
    echo SCREENDETACHED: $SCREENDETACHED
#exit
    if [[ $SCREENDETACHED ]] ; then
	chmod 740 $F.md
	screen -dr $SCREENDETACHED
#	chmod 660 $F
    else
    #TODO:svn lock??
    chmod 740 $F
#        screen  -S  autosaveprefix_$F mcedit $F.md
        screen  -S  ${F}_autosaveprefix mcedit $F.md
    fi

#configure your markdown convertor:
Markdown.pl $1 > $F.html

if [[ $2  == -*p* ]] ; then
	#configure your browser:
	lynx $F.html
fi
