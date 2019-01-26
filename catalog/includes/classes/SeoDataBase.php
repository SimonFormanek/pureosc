<?php
define('USE_SEO_REDIRECT_DEBUG', 'false');
/**
 * Ultimate SEO URLs Contribution - osCommerce MS-2.2
 *
 * Ultimate SEO URLs offers search engine optimized URLS for osCommerce
 * based applications. Other features include optimized performance and 
 * automatic redirect script.
 * @package Ultimate-SEO-URLs
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @copyright Copyright 2005, Bobby Easland 
 * @author Bobby Easland 
 * @filesource
 */

/**
 * SEO_DataBase Class
 *
 * The SEO_DataBase class provides abstraction so the databaes can be accessed
 * without having to use tep API functions. This class has minimal error handling
 * so make sure your code is tight!
 * @package Ultimate-SEO-URLs
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @copyright Copyright 2005, Bobby Easland 
 * @author Bobby Easland 
 */
class SeoDataBase
{
    /**
     * Database host (localhost, IP based, etc)
     * @var string
     */
    var $host;

    /**
     * Database user
     * @var string
     */
    var $user;

    /**
     * Database name
     * @var string
     */
    var $db;

    /**
     * Database password
     * @var string
     */
    var $pass;

    /**
     * Database link
     * @var resource
     */
    var $link_id;

    /**
     * MySQL_DataBase class constructor 
     * 
     * @author Bobby Easland 
     * @version 1.0
     * 
     * @param string $host
     * @param string $user
     * @param string $db
     * @param string $pass  
     */
    public function __construct($host, $user, $db, $pass)
    {

        $this->host = $host;
        $this->user = $user;
        $this->db   = $db;
        $this->pass = $pass;
        $this->ConnectDB();
////			    $this->SelectDB();
    }
# end function

    /**
     * Function to connect to MySQL 
     * @[member='author'] Bobby Easland
     * @version 1.1
     */
    function ConnectDB()
    {
        $this->link_id = mysqli_connect($this->host, $this->user, $this->pass,
            $this->db);
        if (!$this->link_id) {
            die('Connect Error ('.mysqli_connect_errno().') '
                .mysqli_connect_error());
        }
    }
# end function

    /**
     * Function to select the database
     * @[member='author'] Bobby Easland
     * @version 1.0
     * @[member='Return'] resoource
     * 	  
      function SelectDB(){
      return mysqli_select_db($this->link_id, $this->db);
      } # end function

     * *
     * Function to perform queries
     * @[member='author'] Bobby Easland
     * @version 1.0
     * @[member='param'] string $query SQL statement
     * @[member='Return'] resource
     */
    function Query($query)
    {
        $result = @mysqli_query($this->link_id, $query);
        return $result;
    }
# end function

    /**
     * Function to fetch array
     * @[member='author'] Bobby Easland
     * @version 1.0
     * @[member='param'] resource $resource_id
     * @[member='param'] string $type MYSQL_BOTH or MYSQL_ASSOC
     * @[member='Return'] array
     */
    function FetchArray($resource_id, $type = MYSQLI_BOTH)
    {
        if ($resource_id) {
            $result = mysqli_fetch_array($resource_id, $type);
            return $result;
        }
        return false;
    }
# end function

    /**
     * Function to fetch the number of rows
     * @[member='author'] Bobby Easland
     * @version 1.0
     * @[member='param'] resource $resource_id
     * @[member='Return'] mixed 
     */
    function NumRows($resource_id)
    {
        return @mysqli_num_rows($resource_id);
    }
# end function

    /**
     * Function to fetch the last insertID
     * @[member='author'] Bobby Easland
     * @version 1.0
     * @[member='Return'] integer
     */
    function InsertID()
    {
        return mysqli_insert_id($this->link_id);
    }

    /**
     * Function to free the resource
     * @[member='author'] Bobby Easland
     * @version 1.0
     * @[member='param'] resource $resource_id
     * @[member='Return'] boolean
     */
    function Free($resource_id)
    {
        @mysqli_free_result($resource_id);
    }
# end function

    /**
     * Function to add slashes
     * @author Bobby Easland 
     * @version 1.0
     * @param string $data
     * @return string 
     */
    function Slashes($data)
    {
        return addslashes($data);
    }
# end function

    /**
     * Function to perform DB inserts and updates - abstracted from osCommerce-MS-2.2 project
     * @author Bobby Easland 
     * @version 1.0
     * @param string $table Database table
     * @param array $data Associative array of columns / values
     * @param string $action insert or update
     * @param string $parameters
     * @return resource
     */
    function DBPerform($table, $data, $action = 'insert', $parameters = '')
    {
        reset($data);
        if ($action == 'insert') {
            $query = 'INSERT INTO `'.$table.'` (';
            while (list($columns, ) = each($data)) {
                $query .= '`'.$columns.'`, ';
            }
            $query = substr($query, 0, -2).') values (';
            reset($data);
            while (list(, $value) = each($data)) {
                switch ((string) $value) {
                    case 'now()':
                        $query .= 'now(), ';
                        break;
                    case 'null':
                        $query .= 'null, ';
                        break;
                    default:
                        $query .= "'".$this->Slashes($value)."', ";
                        break;
                }
            }
            $query = substr($query, 0, -2).')';
        } elseif ($action == 'update') {
            $query = 'UPDATE `'.$table.'` SET ';
            while (list($columns, $value) = each($data)) {
                switch ((string) $value) {
                    case 'now()':
                        $query   .= '`'.$columns.'`=now(), ';
                        break;
                    case 'null':
                        $query   .= '`'.$columns .= '`=null, ';
                        break;
                    default:
                        $query   .= '`'.$columns."`='".$this->Slashes($value)."', ";
                        break;
                }
            }
            $query = substr($query, 0, -2).' WHERE '.$parameters;
        }
        return $this->Query($query);
    }
# end function        
}

# end class


