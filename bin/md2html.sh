#!/bin/bash
F=`basename -s .md $1`

#edit page
#if [[ $2  == -*e* ]] ; then
		#error todo to musi byt presny vyraz:
    SCREENDETACHED=`screen -list | grep autosaveprefix_$F`
    echo SCREENDETACHED: $SCREENDETACHED
    if [[ $SCREENDETACHED ]] ; then
	chmod 740 $F.md
	screen -dr $SCREENDETACHED
#	chmod 660 $F
    else
    #TODO:svn lock??
    chmod 740 $F
        screen  -S  autosaveprefix_$F mcedit $F.md
    fi
#    SCREENDETACHED=`screen -list | grep $F`
#    if [[ ! $SCREENDETACHED ]] ; then
#    #TODO:svn lock??
#    chmod 660 $F
#    fi
#fi

#configure your markdown convertor:
Markdown.pl $1 > $F.html

if [[ $2  == -*p* ]] ; then
	#configure your browser:
	lynx $F.html
fi
