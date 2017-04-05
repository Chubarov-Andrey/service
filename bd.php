<?php
//выполняем подключение к базе данных
  $db = mysql_connect ('localhost','root','root') or die (mysql_error()) ;
  mysql_select_db ('service'/*,$db*/);
?>