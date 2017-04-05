<?php
 // Выставляем кодировку UTF-8
header("Content-Type: text/html; charset=UTF-8");
//запускаем сессию
session_start();
//заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['login'])) {
	$login = $_POST['login'];
	if ($login == '') {
		unset($login);
	} 
}
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) {
	$password=$_POST['password']; 
	if ($password =='') {
		unset($password);
	}
}
//если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
if (empty($login) or empty($password)) {
	exit ("Вы ввели не всю информацию, венитесь назад и заполните все поля!");
}
//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);
// подключаем базу
include ("bd.php");
//извлекаем из базы все данные о пользователе с введенным логином
$result = mysql_query("SELECT * FROM users WHERE login='$login'",$db); 
$myrow = mysql_fetch_array($result);
//если пользователя с введенным логином не существует
if (empty($myrow['password'])){
	exit ("Извините, введённый вами логин или пароль неверный.");
}
//если существует, то сверяем пароли
else {
	//если пароли совпадают, то запускаем пользователю сессию
	if ($myrow['password']==$password) {
		$_SESSION['login']=$myrow['login'];
		$_SESSION['fio']=$myrow['FIO'];
		$_SESSION['id']=$myrow['id'];
		echo "Вы успешно вошли на сайт! <a href='index.php'>Главная страница</a>";
	}
	//если пароли не сошлись
	else {       
       exit ("Извините, введённый вами логин или пароль неверный.");
	}
}
?>