<?php 
	session_start();
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
			<h1 style="color: #e09335;">The Third Wave Community</h1>
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

					<img src="connection_error_image.jpg" class="img-respponsive center-block" style="margin-bottom: 30px;">

					<!--ERROR MESSAGES-->
					<?php 

						//MISSING INPUTS ERROR MESSAGE
						if($_GET['error'] === 'incomplete') {
							?>
							<div class="well well-lg text-center">
								<h3 class="text-warning"><strong>Perhaps using your keyboard might be a good idea.</strong></h3>
								<p class="text-warning"><i>Take a deep breath and try again. We believe in you.</i></p>
							</div>
							<?php
						}
						else {
							?>

							<!--WRONG PASSWORD ERROR MESSAGE-->
							<div class="well well-lg text-center">
								<h3 class="text-warning"><strong>Sometimes in life, one forgets his password</strong></h3>
								<p class="text-warning"><i>Do not cry it happends a lot. Take a deep breath and try again.</i></p>
							</div>
							<?php
						}

					?>
					
					<!--BACK TO HOME PAGE BUTTON-->
					<div class="text-center">
						<button class="btn btn-warning btn-lg" style="margin-bottom: 30px;">
							<a href="connect.php" style="color: #f9f9f9;">Click Here, It's Gonna Be Alright</a>
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
			<h4 class="text-warning">Designed by Jamal Interprises</h4>
			<q class="text-warning"><i>Because the lulz demands it</i></q>
		</div>
	</body>
</html>