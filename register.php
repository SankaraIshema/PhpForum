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
		<title>Registration To The third Wave</title>
	</head>
	<body>

		<!--HEAD BANNER -->
		<div class="jumbotron text-center">
			<h1 style="color: #5bc0de;">The Third Wave Community</h1>
			<q class="text-warning"><i>For elevated debates</i></q>
		</div>

		<!--MAIN PAGE-->
		<div class="container-fluid">
			<div class="row">

				<!--LEFT COLuMN-->
				<div class="col-sm-2">
					
				</div>

				<!--CENTER MAIN COLUMN-->
				<div class="col-sm-8 text-center">

					<!--SIGN-UP SIGN-->
					<div class="well">
						<h2 style="color: #5bc0de;">Sign-up into the Third Wave !</h2>
					</div>

					<!--FORM-->
					<form action="validation_error.php" method="post" class="form-horizontal" enctype="multipart/form-data">

						<!--USERNAME-->
						<div class="form-group">
							<label for="username" class="col-sm-3 control-label text-right">Username </label>
							<div class="col-sm-6">
								<input type="text" name="username" id="username" class="form-control" 
													placeholder="Your Great Username">
							</div>
						</div>

						<!--EMAIL-->
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label text-right">Email </label>
							<div class="col-sm-6">
								<input type="text" name="email" id="email" class="form-control" 
													placeholder="Your Beautiful email address">
							</div>
						</div>

						<!--PASSWORD-->
						<div class="form-group">
							<label for="password1" class="col-sm-3 control-label text-right">password </label>
							<div class="col-sm-6">
								<input type="password" name="password1" id="password1" class="form-control" 
													placeholder="Your Craftily Chosen Password">
							</div>
						</div>

						<!--PASSWORD CONFIRMATION-->
						<div class="form-group">
							<label for="password2" class="col-sm-3 control-label text-right">Confirm Password </label>
							<div class="col-sm-6">
								<input type="password" name="password2" id="password2" class="form-control" 
													placeholder="The Above">
							</div>
						</div>

						<!--GENDER-->
						<div class="form-group">
							<label for="gender" class="control-label col-sm-3">Your Gender</label>
							<div class="col-sm-6 text-left" id="gender">
								<label class="radio-inline">
									<input type="radio" name="your_gender" value="male">
									Male
								</label>
								<label class="radio-inline">
									<input type="radio" name="your_gender" value="female">
									Female
								</label>
								<label class="radio-inline">
									<input type="radio" checked name="your_gender" value="You'll have to ask me">
									You'll have to ask me
								</label>
							</div>
						</div>

						<!--BIRTHDAY-->
						<div class="form-group">
							<label for="birthday" class="control-label col-sm-3">Your Birth Day</label>
							<div class="col-sm-6" id="birthday">
								
								<!--YEAR-->
								<label for="year" class="control-label">Year</label>
								<select name="year" id="year">
									<option></option>
									<?php 
										for($i = date('Y'); $i >= date('Y', strtotime('-100 years')); $i--) {
											echo '<option value=' .$i .'>' .$i .'</option>';
										}
									?>
								</select>

								<!--MONTH-->
								<label for="month" class="control-label">Month</label>
								<select name="month" id="month">
									<option></option>
									<?php 
										for($i = 1; $i <= 12; $i++) {
											$i = str_pad($i, 2, 0, STR_PAD_LEFT);
											echo '<option value=' .$i .'>' .$i .'</option>';
										}
									?>
								</select>

								<!--DAY-->
								<label for="day" class="control-label">Day</label>
								<select name="day" id="day">
									<option></option>
									<?php 
										for($i = 1; $i <= 31; $i++) {
											$i = str_pad($i, 2, 0, STR_PAD_LEFT);
											echo '<option value=' .$i .'>' .$i .'</option>';
										}
									?>
								</select>
							</div>
						</div>

						<!--DESCRIBE YOURSELF-->
						<div class="form-group">
							<label class="control-label col-sm-3" for="description">About Magnificent You</label>
							<div class="col-sm-6">
								<textarea class="form-control" name="description" id="description" rows="5" 
													placeholder="About Magnificent Me !"></textarea>
							</div>
						</div>

						<!--SUBMIT BUTTON-->
						<div class="text-center" style="margin-bottom: 30px;">
							<button type="submit" class="btn btn-info btn-lg">SIGN IN</button>			
						</div>
					</form>

					<p class="text-right"><a href="connect.php">Back To Home-Page</a></p>
					
				</div>

				<!--RIGHT COLUMN-->
				<div class="col-sm-2">
					
				</div>
			</div>
		</div>

		<!--FOOTER-->
		<div class="jumbotron text-center">
			<h4 class="text-info">Designed by Jamal Interprises</h4>
			<q class="text-warning"><i>Because the lulz demands it</i></q>
		</div>>
	</body>
</html>