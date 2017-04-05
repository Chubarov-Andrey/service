<?php
// Выставляем кодировку UTF-8
header("Content-Type: text/html; charset=UTF-8"); 
//запуск сессии
session_start();
?>
<html>
<head>
	<title></title>
</head>
<body> 
<table  width="290" border="1" align="center"  cellpadding="0" cellspacing="0"  bordercolor="#000000">
	<td  bgcolor="#9ACD32">
		<div align="center"  class="style1"><b>Авторизация</b></div>
	</td>
	<tr bgcolor="#CCFF66">
		<td>
		<form action="testreg.php" method="post">
			<p>
				<label>Ваш логин:<br></label>
				<input name="login" type="text" size="15" maxlength="15">
			</p>
			<p>
				<label>Ваш пароль:<br></label>
				<input name="password" type="password" size="15" maxlength="15">
			</p>
			<p>
				<!--**** (type="submit") отправляет данные на страницу testreg.php ***** --> 
				<input type="submit" name="submit" value="Войти">
				<br>
				<!--**** ссылка на регистрацию ***** --> 
				<a href="reg.php">Зарегистрироваться</a> 
			</p>
		</form>
		<br> 
		<?php
		//обнуляем флажок
		$p=0;
		// Проверяем, пусты ли пересменные логина и id пользователя
		if (empty($_SESSION['login']) or empty($_SESSION['id'])){
			// Если пусты, то мы не выводим ссылку
			echo "Вы вошли на сайт, как гость<br><a href='#'></a>";
		}
		else{
			// Если не пусты, то мы выводим ссылку
			echo "Вы вошли на сайт, как ".$_SESSION['login']."<br> Вы авторизованы.  </a>";
			//присваиваем флажку значение 1
			$p=1; 
		}
		?>
		<hr>
		<br>
		<?php
		//выводим дату
		echo date("H:i");
		?>
		</td>
	</tr>
</table>
</body>
</html>



