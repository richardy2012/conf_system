<?php
//require_once '../../config/database.php';
require_once dirname(dirname(dirname(__FILE__))) .'/config/database.php';

//define( 'DB_CONFIG', 'mysql://colosky:helloworld@192.168.0.10:3307/dev_team' );
define( 'DB_CONFIG', 'mysql://'.$db['default']['username'].':'.$db['default']['password'] .'@'.
    $db['default']['hostname'].':3306/'.$db['default']['database']);

define( 'DB_PREFIX', $db['default']['dbprefix'] );
define( 'ROOT_PATH', dirname(__FILE__) );
?>