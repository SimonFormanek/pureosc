# mysql-logs

on mysql prompt:
  PURGE BINARY LOGS BEFORE (date(now()) + interval 0 second - interval 3 day);
  SET GLOBAL expire_logs_days = 3;

## my.cnf  section: mysqld
  expire_logs_days=3

## crontab

  36 01 * * * mysql -uroot -e 'PURGE BINARY LOGS BEFORE DATE_SUB( NOW( ), INTERVAL 3 DAY)'