<?php
session_start();
require "connect.php";
if(!isset($_SESSION['connect']))
{
	$_SESSION['connect'] = "0";
}

if($_SESSION['connect'] == "1")
{
	$connect = "1";
}
else
{
	$connect = "0";
}

if(!empty($_POST['connexion']) && $_POST['connexion'] == 'Connexion')
{
	if(!empty($_POST['login']) && !empty($_POST['pass']))
 	{
		if(ereg("^[[:alnum:]]+$",$_POST['login']))
		{
			$login = $_POST['login'];
			$pass = sha1($_POST['pass']);
			$pass = md5($pass);
			$req = $bdd->query('SELECT count(*) FROM user WHERE login = "'.$login.'" && pass = "'.$pass.'"');
			$data = $req->fetch();
			
			if($data[0] == 1)
			{
				$req = $bdd->query('SELECT id FROM user WHERE login = "'.$_POST['login'].'" && pass = "'.$_POST['pass'].'"');
				$data = $req->fetch();
				$_SESSION['id'] = $data['id'];
				$_SESSION['connect'] = "1";
				echo "<meta http-equiv='Refresh' content='0;URL=forum.php'>";
			}
		}
	}
	else
	{
		$error = "Champ nom de compte et/ou mot de passe vide!";
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Forum promotion monge 2013-2015</title>
		<link rel="stylesheet" href="style.css">
		<meta charset="UTF-8">
	</head>
	<body>
		<form action="index.php" method="post">
			<input class="login" type="text" name="login" placeholder="Nom de compte" autofocus><br>
			<input class="password" type="password" name="pass" placeholder="Mot de passe"><br>
			<input type="submit" name="Connexion" value="Connexion">
		</form>
	</body>
</html>