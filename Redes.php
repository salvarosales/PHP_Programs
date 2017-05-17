<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_redes = "YOUR_HOSTNAME";
$database_redes = "YOUR_DATABASE";
$username_redes = "YOUR_USER";
$password_redes = "YOUR_PASS";
$redes = mysql_pconnect($hostname_redes, $username_redes, $password_redes) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
