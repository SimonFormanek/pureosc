#!/bin/bash
#make constants changeable
#go to includes/languages/my_language diectory...
find . -name "*.php" |\
    while read txt; do
	sed "/define/ s/');/',true);/g" -i $txt
done
