<?php
//запускаем сессию
session_start();
 // Выставляем кодировку UTF-8
header("Content-Type: text/html; charset=UTF-8");
//создание файла xml в корне
fopen("table.xml", "w");
?>
<html>
<head>
	<title>
	Главная страница
	</title>
</head>
<body bgcolor="ACAC7A">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
	<tr>
		<td valign="top">
			<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
				<tr>
					<td bgcolor="#EEE8AA">
						<div align="center" class="style1"><b>Главная</b></div>
					</td>
				</tr>
				<tr bgcolor="#F1F1F1">
					<td style="padding:10px"><p>Приветствуем Вас на сайте "Система заявок на ремонт"!</p>
					<img align="center" src="image/slide-9.jpg.jpg"><p>На нашем сайте Вы сможете оставить заявку на ремонт ПК, ноутбуков и мобильных устройств. Наши специалисты свяжутся с вами по указанному номеру телефона и проведут бесплатную консультацию.</p>
					<?php 
					//проверяем на авторизацию
					if (empty($_SESSION['login']) or empty($_SESSION['id'])){
						echo 'У Вас нет прав для просмотра списка заявок. Пройдите процедуру авторизации!';
					}
					//если пользователь авторизован, выводим ссылку на страницу добавления заявки
					else echo '<a href="add.php"> Добавить заявку </a>';
					// если пользователь - администратор, выводим ссылку на xml файл
					if ($_SESSION['login']=='admin') {
						?>
						<br/>
						<br/>
						<a href="/table.xml">скачать XML список</a>
						<?php
					};
					// подключаем базу данных
					include_once("bd.php");
					//находим id последней заявки и сохраняем его в переменную
					$query='SELECT MAX(id) FROM publictab';
					$query=mysql_fetch_row(mysql_query($query));
					$max_id=$query[0];
					// выводим все записи из таблицы заявок в массив $rowl[]
					$resl=mysql_query(" SELECT * FROM publictab");
					$rowl=mysql_fetch_array($resl);
					// обнуляем переменную, ответственную за формирование xml файла
					$fert=0;
					// запускаем цикл вывода списка заявок из массива $rowl
					while ($rowl=mysql_fetch_array($resl)){
						// если пользователь - администратор или ФИО пользователя совпадает с ФИО в заявке
						if (($_SESSION['login']=='admin')or ($_SESSION['fio']==$rowl['fio'])){
							//если запись является последней окрашиваем заголовок в красный цвет
							if ($max_id==$rowl['id']) {
								?>
								<hr/>
								<h3 style="color:#ff0000"><?php echo $rowl['title']?></h3> 
								<?php
							}
							// иначе выводим обычный заголовок
							else {
								?>
								<hr/>
								<h3><?php echo $rowl['title']?></h3> 
								<?php
							};
							// выводим данные о завке, описание обрезаем до 140 символов
							?>
							<p>Краткое описание проблемы: <?php echo mb_strimwidth($rowl['text'], 0, 140, "...")?></p>
							<p>ФИО: <?php echo $rowl['fio']?></p>
							<p>Дата публикации: <?php echo $rowl['date']?></p>
							<p>Время: <?php echo $rowl['time']?></p>
							<?php 
							// если эта запись является самой ранней, то  
							if ($fert == 0) {
								// записываем имя xml в переменную
								$file = 'table.xml';
								// формируем начальные тэги
								$current = '<?xml version="1.0" encoding="UTF-8"?><table>';
								// формируем содержимое xml из таблицы
								$current .= ("<zap id=\"\n");
								$current .= ($rowl['id']);
								$current .= ("\">\n");
								$current .= ("<title>\n");
								$current .= ($rowl['title']);
								$current .= ("</title>\n");
								$current .= ("<telephon>\n");
								$current .= ($rowl['telephon']);
								$current .= ("</telephon>\n");
								$current .= ("<date>\n");
								$current .= ($rowl['date']);
								$current .= ("</date>\n");
								$current .= ("<time>\n");
								$current .= ($rowl['time']);
								$current .= ("</time>\n");
								$current .= ("</zap>\n");
								// если эта запись последняя, то закрываем тэг </table>
								if ($max_id==$rowl['id']) {
									$current .= ("</table>\n");
									// закрываем условие
								};
								// Пишем содержимое в файл
								file_put_contents($file, $current);
								// Присваеваем флажку переменную 1
								$fert=1;
								// закрываем условие
							}
							// иначе если флажок равен 1
							else if ($fert == 1) {
								// записываем имя xml в переменную
								$file = 'table.xml';
								// Открываем файл для получения существующего содержимого
								$current = file_get_contents($file);
								// Добавляем новую запись в файл
								$current .= ("<zap id=\"\n");
								$current .= ($rowl['id']);
								$current .= ("\">\n");
								$current .= ("<title>\n");
								$current .= ($rowl['title']);
								$current .= ("</title>\n");
								$current .= ("<telephon>\n");
								$current .= ($rowl['telephon']);
								$current .= ("</telephon>\n");
								$current .= ("<date>\n");
								$current .= ($rowl['date']);
								$current .= ("</date>\n");
								$current .= ("<time>\n");
								$current .= ($rowl['time']);
								$current .= ("</time>\n");
								$current .= ("</zap>\n");
								// если эта запись последняя, то закрываем тэг </table>
								if ($max_id==$rowl['id']) {
									$current .= ("</table>\n");
									// закрываем условие
								};
								// Пишем содержимое обратно в файл
								file_put_contents($file, $current);
								// закрываем условие
							};
							// Выводим ссылку на подробный просмотр заявки
							printf("<a href=http://localhost/application.php?id=%s> Подробнее... </a><br>\n", $rowl["id"]); ?>
							<?php
						}// Конец условия, ЕСЛИ админ, то вывод всех заявок, ЕСЛИ пользователь, то только его заявки
					}// конец while
					// Закрываем соединение с базой
					mysql_close();
					?>
					</td>
				</tr>
			</table>
		</td>
		<td width="20%" valign="top">
		<?php 
		// если пользователь совершил вход, то выводим блок
		if (isset($_SESSION['id']))
			include("blocks/right_block1.php");
		// иначе выводим блок
		else include("blocks/right_block.php");
		?>
		</td>
	</tr>
</table>
</body>
</html>
