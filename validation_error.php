<!DOCTYPE html>
<html>
	<head>
		<!--BOOTSRAP CDN->
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

					<!--ERROR IMAGE-->
					<img src="registration_error_image.jpg" class="img-responsive center-block" style="margin-bottom: 30px;">

					<?php 	
						
						//ACCESS DATABASE
						try {
							$dataBase = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '',
								array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
						}	
						catch(Exception $e) { die('Error : ' .$e->getMessage()); }

						//PREPARE THE ERROR MESSAGES
						$validation_error = array();
						$email_error    = 'The email address you have entered is invalid.';
						$username_error = 'The username you have entered is already taken.';
						$password_error = 'The passwords you have entered do not match.';
						$february_error = 'That year, the last day of february was the 28th. I remember...so much rain...';
						$leap_year      = 'That year, the last day of February was the 29th. I remember...cause everything changed when the fire nation attacked...';

						//FORM VALIDATION
						if(isset($_POST['username']) AND strlen($_POST['username']) != 0 
							AND isset($_POST['email']) AND strlen($_POST['email']) != 0 
								AND isset($_POST['password1']) AND strlen($_POST['password1']) != 0  
									AND isset($_POST['password2']) AND strlen($_POST['password2']) != 0 
										AND isset($_POST['year']) AND strlen($_POST['year']) != 0
											AND isset($_POST['month']) AND strlen($_POST['month']) != 0 
												AND isset($_POST['day']) AND strlen($_POST['day']) != 0) {

							//CHECK THE UNIQUENESS OF THE USERNAME
							$_POST['username'] = htmlspecialchars($_POST['username']);

							$request = $dataBase->prepare('SELECT * FROM users WHERE username = ?');
							$request->execute(array($_POST['username']));

							if(!$result = $request->fetch()) {
								$username = $_POST['username'];
							}
							else {
								array_push($validation_error, $username_error);
							}
							$request->closeCursor();

							//SECURE THE EMAIL INPUT
							$_POST['email'] = htmlspecialchars($_POST['email']);

							if(preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
								$email = $_POST['email'];
							}
							else {
								array_push($validation_error, $email_error);
							}

							//CHECK PASSWORDS MATCH
							$_POST['password1'] = htmlspecialchars($_POST['password1']);
							$_POST['password2'] = htmlspecialchars($_POST['password2']);

							if($_POST['password1'] === $_POST['password2']) {
								$password = sha1($_POST['password1']);			
							}
							else {
								array_push($validation_error, $password_error);
							}

							//GENDER
							$gender = $_POST['your_gender'];

							//BIRTHDAY VALIDITY	
							$year  = $_POST['year'];
							$month = $_POST['month'];

								//THE FEBRUARY PROBLEM
							if($_POST['month'] == 02) { 
								if($_POST['day'] > 28) {
									if(date('L', strtotime($_POST['year'])) === 1) {
										if($_POST['day'] > 29) {
											array_push($validation_error, $leap_year);
										}
										else {
											$day = $_POST['day'];
										}
									}
									else {
										array_push($validation_error, $february_error);
									}
								}
								else {
									$day = $_POST['day'];
								}
							}
							else {
								$day   = $_POST['day'];
							}

							//DESCRIPTION
							if(isset($_POST['description']) AND strlen($_POST['description']) != 0) {
								$description = htmlspecialchars($_POST['description']);
							}
							else {
								$description = 'I am kinda shy, please stop reading about me!';
							}
						}
						else {
							//ERROR MESSAGE FOR INCOMPLETE FORM
							?>
							<div class="well well-lg text-center">
								<h1 class="text-danger"><strong>ALL FIELDS MUST BE COMPLETED !</strong></h1>
							</div>
							<?php
						}

						//INSERTING THE NEW USER IN DATABASE
						if(isset($username) AND isset($email) AND isset($password)
							AND isset($gender) AND isset($year) AND isset($month) AND isset($day)) {
							$birthday = $year .'/' .$month .'/' .$day;	

							$request = $dataBase->prepare('INSERT INTO users(username, email, password, 
																				gender, description, birthday)
															VALUES(:username, :email, :password, 
																				:gender, :description, :birthday)');
							$request->execute(array(
							'username'    => $username,
							'email'       => $email,
							'password'    => $password,
							'gender'      => $gender,
							'description' => $description,
							'birthday'    => $birthday));

							header('Location:connect.php');

							$request->closeCursor();
						}
						else {

							//ERROR MESSAGE FOR INVALID FORM
							foreach ($validation_error as $element) {
								?>
								<div class="well well-lg text-center">
									<h3 class="text-danger"><strong><?php echo $element ?></strong></h3>
								</div>
								<?php
							}	
						}
					?>

					<!--SUBMIT BUTTON-->
					<div class="text-center">
						<button class="btn btn-danger btn-lg">
							<a href="register.php" style="color: #f9f9f9;">By All Means, Try Again</a>
						</button>
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