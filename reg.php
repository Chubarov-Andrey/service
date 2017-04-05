<html>
<head>
<!--**** Выставляем кодировку windows-1251***** -->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<title>
	Регистрация
	</title>
</head>
<body bgcolor="ACAC7A">
<table width="70%" border="0" cellspacing="5" cellpadding="0">
	<tr>
		<td valign="top">
			<table width="70%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
				<tr>
					<td bgcolor="#EEE8AA">
						<div align="center" class="style1">
						<b>Регистрация</b>
						</div>
					</td>
				</tr>
					<tr bgcolor="#F1F1F1">
						<td bgcolor="#EEE8AA"><div align="left" class="style1">
						<!--**** save_user.php - это адрес обработчика. При нажатии на кнопку "Зарегистрироваться", данные из полей отправятся на страницу save_user.php при помощи метода "POST" ***** -->
						<form action="save_user.php" method="post">
							<p>
								<label>Введите логин:*<br></label>
								<input name="login" type="text" size="15" maxlength="15">
							</p>
							<p>
								<label>Введите пароль:*<br></label>
								<input name="password" type="password" size="15" maxlength="15">
							</p>
							<p>
								<label>Введите ФИО:*<br></label>
								<input name="fio" type="text" size="45" maxlength="80">
							</p>
							<p>
								<!--**** Кнопка отправляет данные на страничку save_user.php ***** -->  
								<input type="submit" name="submit" value="Зарегистрироваться">
							</p>
						</form>
						</td>
					</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>