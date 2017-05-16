<?php 
	
	//ACCESS DATABASE
	try {
		$dataBase = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '', 
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION	));
	}
	catch(Exception $e) { die('Error : ' .$e->getMessage()); }

	//SECURE THE INPUTS
	$_POST['username'] = htmlspecialchars($_POST['username']);
	$_POST['password'] = htmlspecialchars($_POST['password']);


	//CHECK IF THE FORM IS COMPLETE
	if(isset($_POST['username']) AND strlen($_POST['username']) != 0
		AND isset($_POST['password']) AND strlen($_POST['password']) != 0 ) {

		//STOCK THE INPUTS
		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		//TABLE REQUEST
		$request = $dataBase->prepare('SELECT Id_user FROM users 
										WHERE username = :username 
										AND password   = :password');

		$request->execute(array(
			'username' => $username,
			'password' => $password));

		//CREATE SESSION VARIABLE
		if($result = $request->fetch()) {
			session_start();
			$_SESSION['Id_user']  = $result['Id_user'];
			$_SESSION['username'] = $username;

			if(isset($_POST['remember_me'])) {
				setcookie('username', $username,    time() + 3600 * 24 * 365, null, null, false, true);
				setcookie('password', $password,    time() + 3600 * 24 * 365, null, null, false, true);
			}

			header('Location:forum.php');
		}
		else {

			//SUMMON CONNECTION_ERROR PAGE => UNKNOWN USER
			header('Location:connection_error.php?error=id');
		}
	}
	else {

		//SUMMON CONNECTION_ERROR PAGE => MISSING INPUT(S)
		header('Location:connection_error.php?error=incomplete');
	}

	$request->closeCursor();
?>