<?php   
if (file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-config.php')) {
    include($_SERVER['DOCUMENT_ROOT'].'/wp-config.php');
} else if (file_exists($_SERVER['SUBDOMAIN_DOCUMENT_ROOT'].'/wp-config.php')) {
    include($_SERVER['SUBDOMAIN_DOCUMENT_ROOT'].'/wp-config.php');    
}
$username=DB_USER;
$password=DB_PASSWORD;
$database=DB_NAME;
$host=DB_HOST;
