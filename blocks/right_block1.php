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
		<?php
		//обнуляем флажок
		$p=0;
		// Проверяем, пусты ли пересменные логина и id пользователя
		if (empty($_SESSION['login']) or empty($_SESSION['id'])){
			// Если пусты, то мы не выводим ссылку
			echo "Вы вошли на сайт, как гость<br><a href='#'></a>";
		}
		// Если не пусты, то мы выводим ссылку
		else{
			echo "Вы вошли на сайт, как ".$_SESSION['login']."<br> Вы авторизованы.  </a>";
			//присваеваем флажку значение 1
			$p=1;
		}
		?> 
		<br/>
		<form method="post" action="index.php">
		<input type="submit" name="exit" value="Выйти">
		<?php 
		// если нажата кнопка Выйти
		if(isset($_POST['exit'])) {
			//закрываем сессию
			session_destroy();
			//обновляем страницу
			echo '<body onload="document.location.reload()">';
		}
		?>
		</form>
		<BR>
		<HR>
		<?php
		// выводим время
		echo date("H:i");
		?>
		</td>
	</tr>
</table>
</body>
</html>



