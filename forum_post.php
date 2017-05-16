<?php 

	try {
		$dataBase = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '', 
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION	));
	}
	catch(Exception $e) { die('Error : ' .$e->getMessage()); }

	if(isset($_POST['new_post']) AND strlen($_POST['new_post']) != 0) {
		session_start();
		
		$new_post = htmlspecialchars($_POST['new_post']);

		$request = $dataBase->prepare('INSERT INTO forum_post(Id_user, post)
												VALUES(:Id_user, :post)');

		$request->execute(array(
			'Id_user' => $_SESSION['Id_user'],
			'post' => $new_post));

		header('Location:forum.php');

		$request->closeCursor();
	}

?>