<?php
    $connect = mysql_connect("localhost","root","") or die(mysql_error());
    $banco = mysql_select_db("nssports") or die (mysql_error());
?>