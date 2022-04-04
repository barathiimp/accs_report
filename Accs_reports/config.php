<?php
$db_host        = "192.168.53.41";
$db_server_name = "CCMS_PREVIEW_DSN";
$db_name        = "ACCS";
$db_cache       = 'CCMS_STAT';
$db_port       = '1972';
$db_user        = "sysadmin";
$db_pass        = "avaya1";
          //print_r($connect_string);
  //$connect_string="DRIVER={InterSystems ODBC Driver};SERVER=localhost;Namespace=Odbc_test;PORT=3307;DATABASE=login;UID=root;PWD=";
    //$connect_string="DRIVER={Cache ODBC Driver};SERVER=192.168.53.41;Cache=CCMS_STAT;PORT=1972;DATABASE=ACCS;UID=sysadmin;PWD=avaya1";
// Connect to DB
$conn = odbc_connect('CCMS_PREVIEW_DSN','sysadmin','avaya1');


    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","","accs");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>