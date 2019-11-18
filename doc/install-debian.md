# install devel debian

apt install libapache2-mpm-itk locales-all mysql-server php7.1-cli libapache2-mod-php7.1 php7.1 php7.1-intl php7.1-dom php7.1-mbstring php7.1-curl php7.1-mysql php7.1-gettext

apt install libapache2-mpm-itk locales-all mysql-server php5.6-cli libapache2-mod-php5.6 php5.6 php5.6-intl php5.6-dom php5.6-mbstring php5.6-curl php5.6-mysql php5.6-gettext

#php 7.3 
apt install libapache2-mpm-itk locales-all mariadb-server php7.3-cli libapache2-mod-php7.3 php7.3 php7.3-intl php7.3-intl php7.3-dom php7.3-mbstring php7.3-curl php7.3-mysql php7.3-gettext

7.4
apt install libapache2-mpm-itk locales-all mariadb-server php7.4-cli libapache2-mod-php7.4 php7.4 php7.4-intl php7.4-intl php7.4-dom php7.4-mbstring php7.4-curl php7.4-mysql php7.4-gettext



#apache conf
  a2enmod headers
  a2enmod rewrite
  a2enmod deflate

## disable dangerous PHP functions
  disable_functions = pcntl_alarm,pcntl_fork,pcntl_waitpid,pcntl_wait,pcntl_wifexited,pcntl_wifstopped,pcntl_wifsignaled,pcntl_wexitstatus,pcntl_wtermsig,pcntl_wstopsig,pcntl_signal,pcntl_signal_dispatch,pcntl_get_last_error,pcntl_strerror,pcntl_sigprocmask,pcntl_sigwaitinfo,pcntl_sigtimedwait,pcntl_exec,pcntl_getpriority,pcntl_setpriority, apache_setenv, exec,  curl_multi_exec, chgrp, chown, disk_free_space, disk_total_space, diskfreespace, dl, fileinode, highlight_file, shell_exec, show_source, passthru,proc_close, proc_open, proc_get_status, proc_nice, proc_open, proc_terminate,  popen, pclose, phpinfo, posix_kill, posix_mkfifo, posix_setpgid, posix_setsid, posix_setuid,  putenv, system,ini_set

