<?php
// запуск сессии
session_start();
?>
<html>
<head>
	<!--**** Выставляем кодировку windows-1251***** -->
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<title>Заявка</title>
</head>
<body bgcolor="ACAC7A">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
	<td valign="top">
		<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
			<tr>
				<td bgcolor="#EEE8AA">
					<div align="center" class="style1"><b>Заявка</b></div>
				</td>
			</tr>
			<tr>
				<tr bgcolor="#F1F1F1">
					<td bgcolor="#EEE8AA"><div align="left" class="style1">
					<?php 
					//подключаем базу
					include_once("bd.php");
					//получение адресной строки в переменную  $url
					$url=($_SERVER["REQUEST_URI"]);
					//преобразование адресной строки с целью получения id записи в переменную $url
					$url= trim(substr($url, 20, 5));
					//запись данных из таблицы заявок в массив $rowr[]
					$resr=mysql_query(" SELECT * FROM publictab");
					$rowr=mysql_fetch_array($resr);
					// запускаем цикл вывода списка заявок из массива $rowr[]
					while ($rowr=mysql_fetch_array($resr)){
						//выборка из массива заявки с нужным id
						if ($rowr['id']==$url) {
							//вывод подробных данных о заявке
							?>
							<h1><?php echo $rowr['title']?></h1>
							<p>Описание: <?php echo $rowr['text']?></p>
							<p>
								<?php
								//если в заявке есть картинка, вывести её на экран
								if ($rowr['image']<>NULL){
								echo '<img align="center" src="data:image/jpg;base64,'.base64_encode($rowr['image']).'">';
								}
								?>
							</p>
							<hr/>
							<p>ФИО: <?php echo $rowr['fio']?></p>
							<p>Контактный телефон для связи: <?php echo $rowr['telephon']?></p>
							<p>Дата публикации: <?php echo $rowr['date']?></p>
							<p>Время: <?php echo $rowr['time']?></p>
							<!--**** Вывод ссылки на список заявок ***** -->
							<a href="index.php"> К списку заявок </a>
							<hr/>
							<?php
						}
					}
					mysql_close();
					?>
					</td>
				</tr>
			</tr>
		</table>
	</td>
<td width="20%" valign="top">
<?php 
// если пользователь авторизован вывести блок
if (isset($_SESSION['id']))
include("blocks/right_block1.php");
// иначе вывести блок
else include("blocks/right_block.php");
?>
</td>
</table>
</body>
</html>