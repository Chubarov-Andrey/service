<html>
<head>
<!--**** Выставляем кодировку windows-1251***** -->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<title>
	Добавление заявки
	</title>
</head>
<body bgcolor="ACAC7A">
<table width="70%" border="0" cellspacing="5" cellpadding="0">
	<tr>
		<td valign="top">
			<table width="70%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
				<tr>
					<td bgcolor="#EEE8AA"><div align="center" class="style1"><b>Добавление заявки</b></div></td>
				</tr>
				<tr bgcolor="#F1F1F1">
					<td bgcolor="#EEE8AA"><div align="left" class="style1">
					<form enctype="multipart/form-data" method="post" action="add.php">
					Название заявки:* <br />
					<input maxlength="30" type="text" name="title1"/> <br />
					Контактный телефон для связи:* <br/>
					<textarea maxlength="30" cols="35" rows="1" name="telephone"> </textarea> 
					<br />
					Краткое описание проблемы:* <br/>
					<textarea maxlength="1500" cols="150" rows="10" name="text1"> </textarea> <br />
					Картинка с неисправностью (в формате jpg)<br/> <input type="file" name="image" />
					<input type="hidden" name="date1" value="<?php echo date('Y-m-d'); ?>" />
					<input type="hidden" name="time1" value="<?php echo date('H:i:s'); ?>" />
					<input type="submit" name="add" value="Добавить" onclick=" location.href='index.php'  "/>
					<hr/>
					</form>
					<?php
					//запуск сесии
					session_start();
					//подключаемся к базе
					include_once("bd.php");
					//обработка нажатия кнопки Добавить
					if(isset($_POST['add'])) {
						// очищаем переменную, содержущую название темы от лишних пробелов, ссылок и тегов и проверяем на заполенность
						if (strlen(strip_tags(trim($_POST['title1'])))==0) {
							// если пуста => ошибка: Тема не указана
							exit("Тема не указана!");
						}
						//иначе, очищаем переменную, содержущую телефон от лишних пробелов, ссылок и тегов и проверяем на заполенность
						else if (strlen(strip_tags(trim($_POST['telephone'])))==0) {
							// если пуста => ошибка: Телефон не указан
							exit("Телефон не указан!");
						}
						//иначе, очищаем переменную, содержущую текст заявки от лишних пробелов, ссылок и тегов и проверяем на заполенность
						else if (strlen(strip_tags(trim($_POST['text1'])))<10) {
							// если содержит менее 10 символов => ошибка: Текст описания проблемы не может быть менее 10 символов
							exit("Текст описания проблемы не может быть менее 10 символов!");
						}
						// если всё введено
						else {
							//обнуляем флажок
							$dawnim=0;
							//присваиваем переменным строки из соответствующих полей, очищенные от лишних пробелов, ссылок и тегов
							$title1=strip_tags(trim($_POST['title1']));
							//присваиваем переменной значение ФИО текущего пользователя
							$fio=$_SESSION['fio'];
							$telephone=strip_tags(trim($_POST['telephone']));
							$text1=strip_tags(trim($_POST['text1']));
							$date1=$_POST['date1'];
							$time1=$_POST['time1'];
							// Если загружена картинка
							if( !empty( $_FILES['image']['name'] ) ) {
								// Проверяем, что при загрузке не произошло ошибок
								if ( $_FILES['image']['error'] == 0 ) {
									// Если файл загружен успешно, то проверяем - графический ли он
									if( substr($_FILES['image']['type'], 0, 5)=='image' ) {
										// Читаем содержимое файла
										$image = file_get_contents( $_FILES['image']['tmp_name'] );
										// Экранируем специальные символы в содержимом файла
										$image = mysql_escape_string( $image );
										// Заносим полученные данные в базу данных
										mysql_query("INSERT INTO publictab(title,telephon,text,date,time,fio,image) 
										VALUES ('$title1','$telephone','$text1','$date1','$time1','$fio','".$image."')");
										// устанавливаем значение флажка равным 1
										$dawnim=1;
										// переходим на список заявок
										header("Location: http://localhost/index.php");
									}
								}
							}
							// если флажок равен нулю
							if ($dawnim==0) {
								// Заносим полученные данные в базу данных (без фото)
								mysql_query("INSERT INTO publictab(title,telephon,text,date,time,fio) 
								VALUES ('$title1','$telephone','$text1','$date1','$time1','$fio')");
								header("Location: http://localhost/index.php");
								// переходим на список заявок
							}
						}
					}
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>