<?php
 // Выставляем кодировку UTF-8
 header("Content-Type: text/html; charset=UTF-8");
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
//заносим введенные пользователем ФИО в переменную $fio, если он пустой, то уничтожаем переменную
if (isset($_POST['fio'])) {
	$fio=$_POST['fio'];
	if ($fio =='') {
		unset($fio);
	} 
}
//если пользователь не ввел логин, пароль или ФИО, то выдаем ошибку и останавливаем скрипт
if (empty($login) or empty($password) or empty($fio)) {
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
// подключаемся к базе
include ("bd.php");
// проверка на существование пользователя с таким же логином
$result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
$myrow = mysql_fetch_array($result);
if (!empty($myrow['id'])) {
	exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
}
// если такого нет, то сохраняем данные
$result2 = mysql_query ("INSERT INTO users (login,password,FIO) VALUES('$login','$password','$fio')");
// Проверяем, есть ли ошибки
if ($result2=='TRUE'){
	echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
}
else {
	echo "Ошибка! Вы не зарегистрированы.";
}
?>