# performance

## cache
install into memory

## log settings

apache do not log all in production

## database
  slow_query_log=1
  slow_query_log_file     = /var/log/mysql/mariadb-slow.log
  long_query_time = 0.5

## PHP