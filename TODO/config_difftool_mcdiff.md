prio:3 git, diff, bash, devel
#mcdiff not working...
git difftool  4db182b catalog/create_account.php

    [merge]
	extcmd = /usr/local/bin/mcdiff_wrapper.sh
#	tool = meld
#	tool = mcdiff 
[diff]
#	extcmd = /usr/local/bin/mcdiff_wrapper.sh
	tool = meld
#	tool = mcdiff
[pager]
	diff =
	keepBackup = false
    [core]
	editor = mcedit
	quotepath = off
[push]
	default = simple
[difftool]
	prompt = false
