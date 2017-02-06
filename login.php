<?php
require("connect_sql.php");
?>

<html>
	<head>
		<title>login</title>
	</head>
	<body>
		<form action="auth.php" method="POST">
id:
<input type="text" name="id" maxlength="100">
password:
<input type="password" name="password" maxlength="256">

<input type="submit" name="submit" value="login">