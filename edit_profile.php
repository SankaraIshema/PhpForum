<?php 
	session_start();
	//ACCESS DATABASE
	try {
		$dataBase = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '', 
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION	));
	}
	catch(Exception $e) { die('Error : ' .$e->getMessage()); }

	$request = $dataBase->prepare('SELECT email, gender, description, password
									FROM users 
									WHERE username = ?');

	$request->execute(array($_SESSION['username']));
	$result = $request->fetch();

	$_SESSION['password'] = $result['password'];

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
		<title>Profile Editing</title>
	</head>
	<body>

		<!--HEAD BANNER -->
		<div class="jumbotron text-center">
			<h1 style="color: #5cb85c;">The Third Wave Community</h1>
			<q class="text-warning"><i>For elevated debates</i></q>
		</div>

		<!--MAIN PAGE-->
		<div class="container-fluid">
			<div class="row">

				<!--LEFT COLUMN-->
				<div class="col-sm-3">

					<!--THE AVATAR-->
					<div class="thumbnail" style="height: 400px;">
						<?php 

							$allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');

							$final_avatar = './Avatar/anon-avatar.jpg';
							
							foreach ($allowed_extensions as $element) {
								$avatar = './Avatar/' .$_SESSION['Id_user'] .'.' .$element;

								if(file_exists($avatar)) {
									$final_avatar = $avatar;
								}
							}
							
						?>
						<img src="<?php echo $final_avatar; ?>">
						<div class="caption">
							<h3 class="text-center"><strong><?php echo $_SESSION['username'] ?></strong></h3>
						</div>
					</div>

					<!--CHANGE YOUR AVATAR-->
					<form action="edit_profile_post.php" method="post" class="form-horizontal" enctype="multipart/form-data">
						<input type="file" name="avatar" class="form-control">
						<button type="submit" class="btn btn-block btn-success">Upload</button>
					</form>
				</div>

				<!--CENTER MAIN COLUMN-->
				<div class="col-sm-7">

					<table class="table">
						<thead>
							<th>
								<h1 class="text-center">Edit Your Own Profile</h1>
							</th>
						</thead>
						<tbody>
							<tr>
								<td>
									<!--USERNAME-->
									<form action="edit_profile_post.php" method="post" class="form-horizontal">
										<div class="form-group">
											<label for="username" class="col-sm-3 control-label text-right">Username </label>
											<div class="col-sm-6 input-group">
												<input type="text" name="username" id="username" class="form-control" 
																	value="<?php echo $_SESSION['username'] ?>">
												<div class="input-group-btn">
													<button class="btn btn-success" type="submit">
														update <span class="glyphicon glyphicon-ok"></span>
													</button>
												</div>
											</div>
										</div>
									</form>		

									<!--EMAIL-->
									<form action="edit_profile_post.php" method="post" class="form-horizontal">
										<div class="form-group">
											<label for="email" class="col-sm-3 control-label text-right">Email </label>
											<div class="col-sm-6 input-group">
												<input type="text" name="email" id="email" class="form-control" 
																	value="<?php echo $result['email'] ?>">
												<div class="input-group-btn">
													<button class="btn btn-success" type="submit">
														update <span class="glyphicon glyphicon-ok"></span>
													</button>
												</div>
											</div>
										</div>
									</form>
								</td>
							</tr>
							<tr>
								<td>
									<!--PASSWORD-->
									<form action="edit_profile_post.php" method="post" class="form-horizontal">

										<!--OLD PASSWORD-->
										<div class="form-group">
											<label for="password1" class="col-sm-3 control-label text-right">Password </label>
											<div class="col-sm-6">
												<input type="password" name="password1" id="password1" class="form-control" 
																	placeholder="Your Old Password">
											</div>
										</div>
										
										<!--PASSWORD CONFIRMATION-->
										<div class="form-group">
											<label for="password2" class="col-sm-3 control-label text-right">New Password </label>
											<div class="col-sm-6">
												<input type="password" name="password2" id="password2" class="form-control" 
																	placeholder="The New One">
											</div>
										</div>
								
										<!--PASSWORD CONFIRMATION-->
										<div class="form-group">
											<label for="password3" class="col-sm-3 control-label text-right">Confirm New Password </label>
											<div class="col-sm-6">
												<input type="password" name="password3" id="password3" class="form-control" 
																	placeholder="The New Two">
											</div>
										</div>

										<!--PASSWORD SUBMIT BUTTON-->
										<div class="text-center" style="margin-bottom: 30px;">
											<button type="submit" class="btn btn-success">
												update
												<span class="glyphicon glyphicon-ok"></span>
											</button>
										</div>
									</form>
								</td>	
							</tr>
							<tr>
								<td>
									<!--GENDER-->
									<form action="edit_profile_post.php" method="post" class="form-horizontal">
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

										<!--GENDER SUBMIT BUTTON-->
										<div class="text-center" style="margin-bottom: 30px;">
											<button type="submit" class="btn btn-success">
												update
												<span class="glyphicon glyphicon-ok"></span>
											</button>
										</div>
									</form>
								</td>	
							</tr>
							<tr>
								<td>
									<!--DESCRIBE YOURSELF-->
									<form action="edit_profile_post.php" method="post" class="form-horizontal">
										<div class="form-group">
											<label class="control-label col-sm-3" for="description">About Magnificent You</label>
											<div class="col-sm-6">
												<textarea class="form-control" name="description" id="description" 
																rows="5"><?php echo $result['description'] ?></textarea>
											</div>
										</div>

										<!--DESCRIBE YOURSELF SUBMIT BUTTON-->
										<div class="text-center" style="margin-bottom: 30px;">
											<button type="submit" class="btn btn-success">
												update
												<span class="glyphicon glyphicon-ok"></span>
											</button>
										</div>	
									</form>	
								</td>	
							</tr>
						</tbody>
					</table>	
				</div>

				<!--RIGHT COLUMN-->
				<div class="col-sm-2">

					<!--MENU-->
					<div class="panel panel-success">
						<div class="panel-heading text-center">
							<h4><?php echo $_SESSION['username'] ?></h4>
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li>
									<a href="connect.php">
										<span class="glyphicon glyphicon-home"></span> 
										Go to Home-Page
									</a>
								</li>
								<li>
									<a href="forum.php">
										<span class="glyphicon glyphicon-eye-open"></span> 
										Go to the Forum
									</a>
								</li>
								<li>
									<a href="profile.php?user=<?php echo $_SESSION['username'] ?>">
										<span class="glyphicon glyphicon-star-empty"></span> 
										Go To My Profile
									</a>
								</li>
								<li>
									<a href="edit_profile.php">
										<span class="glyphicon glyphicon-pencil"></span>
										Edit My Profile
									</a>
								</li>
								<li>
									<a href="disconnect.php">
										<span class="glyphicon glyphicon-user"></span> 
										Disconnect
									</a>
								</li>
							</ul>
						</div>	
					</div>
				</div>
			</div>
		</div>

		<!--FOOTER-->
		<div class="jumbotron text-center">
			<h4 class="text-primary">Designed by Jamal Interprises</h4>
			<q class="text-warning"><i>Because the lulz demands it</i></q>
		</div>
	</body>
</html>