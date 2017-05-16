<?php 
	session_start();

	try {
		$dataBase = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '', 
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION	));
	}
	catch(Exception $e) { die('Error : ' .$e->getMessage()); }

	//ERROR MESSAGES
	$profile_error = array();
	$form_incomplete    = 'Could you please fill the whole thing?';
	$email_invalid      = 'The email address you have entered is invalid.';
	$username_taken     = 'The username you have entered is already taken.';
	$password_match     = 'The passwords you have entered do not match.';
	$password_wrong     = 'Due to chemtrails and excessive vaccinations, some forget their password. Just relax and try again.';
	$file_wrong_type    = 'Your file extension is not supported by The Matrix - Smith.';
	$file_wrong_size    = 'Your file is way too big for this humble forum. Be careful not to choke on your aspirations.';
	$file_upload_failed = 'For unknown reasons your upload failed. You should not have ingnored all those facebook post that promise you hell if you did not share.'; 

	//THE AVATAR
	if(isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0) {
		if($_FILES['avatar']['size'] < 1000000) {

			$file_data = pathinfo($_FILES['avatar']['name']);
			$file_extension = $file_data['extension'];
			$allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');

			if(in_array($file_extension, $allowed_extensions)) {
				move_uploaded_file($_FILES['avatar']['tmp_name'], './Avatar/' .$_SESSION['Id_user'] .'.' .$file_extension);

				header('Location:profile.php?user=' .$_SESSION['username']);

			}
			else {
				array_push($profile_error, $file_wrong_type);
			}
		}
		else {
			array_push($profile_error, $file_wrong_size);
		}
	}

	//USERNAME
	if(isset($_POST['username']) AND strlen($_POST['username']) != 0) {
		$new_username = htmlspecialchars($_POST['username']);

		$request = $dataBase->prepare('SELECT username FROM users WHERE username = ?');
		$request->execute(array($new_username));

		if(!$result = $request->fetch()) {
			$request = $dataBase->prepare('UPDATE users 
										SET username = :new_username 
										WHERE Id_user = :Id');
			$request->execute(array(
				'new_username' => $new_username,
				'Id'           => $_SESSION['Id_user']));

			$request->closeCursor();

			$_SESSION['username'] = $new_username;

			header('Location:profile.php?user=' .$_SESSION['username']);
		}
		else {
			array_push($profile_error, $username_taken);
		}
	}

	//EMAIL
	if(isset($_POST['email']) AND strlen($_POST['email']) != 0) {
		$_POST['email'] = htmlspecialchars($_POST['email']);

		if(preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
			$new_email = $_POST['email'];

			$request = $dataBase->prepare('UPDATE users 
											SET email = :new_email 
											WHERE Id_user = :Id');
			$request->execute(array(
				'new_email' => $new_email,
				'Id'        => $_SESSION['Id_user']));

			$request->closeCursor();
			
			header('Location:profile.php?user=' .$_SESSION['username']);
		}	
		else {
			array_push($profile_error, $email_invalid);
		}
	}

	//PASSWORD
	if(isset($_POST['password1']) AND strlen($_POST['password1']) != 0
		AND isset($_POST['password2']) AND strlen($_POST['password2']) != 0
			AND isset($_POST['password3']) AND strlen($_POST['password3']) != 0) {

		$_POST['password1'] = htmlspecialchars($_POST['password1']);
		$_POST['password2'] = htmlspecialchars($_POST['password2']);
		$_POST['password3'] = htmlspecialchars($_POST['password3']);

		$old_password = sha1($_POST['password1']);

		if($old_password === $_SESSION['password']) {
			if($_POST['password2'] === $_POST['password3']) {
				$new_password = sha1($_POST['password2']);

				$request = $dataBase->prepare('UPDATE users 
												SET password = :new_password 
												WHERE Id_user = :Id');
				$request->execute(array(
					'new_password' => $new_password,
					'Id'           => $_SESSION['Id_user']));

				$request->closeCursor();
			
				header('Location:profile.php?user=' .$_SESSION['username']);
			}
			else {
				array_push($profile_error, $password_match);
			}
		}
		else {
			array_push($profile_error, $password_wrong);
		}
	}

	//GENDER
	if(isset($_POST['your_gender'])) {
		$new_gender = $_POST['your_gender'];

		$request = $dataBase->prepare('UPDATE users 
										SET gender = :new_gender 
										WHERE Id_user = :Id');
		$request->execute(array(
			'new_gender' => $new_gender,
			'Id'         => $_SESSION['Id_user']));

		$request->closeCursor();
			
		header('Location:profile.php?user=' .$_SESSION['username']);
	}

	//DESCRIBE YOURSELF
	if(isset($_POST['description']) AND strlen($_POST['description']) != 0) {
		$new_description = htmlspecialchars($_POST['description']);

		$request = $dataBase->prepare('UPDATE users 
										SET description = :new_description 
										WHERE Id_user = :Id');
		$request->execute(array(
			'new_description' => $new_description,
			'Id'              => $_SESSION['Id_user']));

		$request->closeCursor();
			
		header('Location:profile.php?user=' .$_SESSION['username']);
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<!--BOOTSRAP CDN-->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- Latest compiled and minified JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
		<meta charset="utf-8">
		<title>Template</title>
	</head>
	<body>

		<!--HEAD BANNER -->
		<div class="jumbotron text-center">
			<h1 style="color: #d9534f;">The Third Wave Community</h1>
			<q class="text-warning"><i>For elevated debates</i></q>
		</div>

		<!--MAIN PAGE-->
		<div class="container-fluid">
			<div class="row">

				<!--LEFT COLUMN-->
				<div class="col-sm-2">
					
				</div>

				<!--CENTER MAIN COLUMN-->
				<div class="col-sm-8">
					<img src="profile_error.jpg" class="img-responsive center-block">
					<?php 

						foreach ($profile_error as $element) {
							echo '<div class="well text-center">';

							if($element === 'Could you please fill the whole thing?') {
								echo '<h4>' .$element .'</h4>';
								echo '<img src="dirty_joke.jpg" class="img-responsive">';
							}
							else {
								echo $element;
							}
							echo '</div>';
						}
					?>
					<div class="text-center">
						<button class="btn btn-warning btn-lg"><a href="edit_profile.php">Try Again</a></button>	
					</div>
				</div>

				<!--RIGHT COLUMN-->
				<div class="col-sm-2">
					
				</div>
			</div>
		</div>

		<!--FOOTER-->
		<div class="jumbotron text-center">
			<h4 class="text-danger">Designed by Jamal Interprises</h4>
			<q class="text-warning"><i>Because the lulz demands it</i></q>
		</div>
	</body>
</html>