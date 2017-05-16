<?php 
	session_start();
	//ACCESS DATABASE
	try {
		$dataBase = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '', 
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION	));
	}
	catch(Exception $e) { die('Error : ' .$e->getMessage()); }

	$request = $dataBase->prepare('SELECT Id_user, username, email, gender, birthday, description, 
									date_format(date_registration, \'%Y-%m-%d\') AS date
									FROM users 
									WHERE username = ?');

	$request->execute(array($_GET['user']));
	$result = $request->fetch();

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

		<!--My css-->
		<link rel="stylesheet" type="text/css" href="profile_css.css">
		<meta charset="utf-8">
		<title>Profile</title>
	</head>
	<body>

		<!--HEAD BANNER -->
		<div class="jumbotron text-center">
			<h1 style="color: #428bca;">The Third Wave Community</h1>
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
					<div class="row">
						<div class="col-sm-4">

							<!--THE AVATAR-->
							<div class="thumbnail" style="height: 400px;">
								<?php 
									$allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');

										$final_avatar = './Avatar/anon-avatar.jpg';
										
										foreach ($allowed_extensions as $element) {
											$avatar = './Avatar/' .$result['Id_user'] .'.' .$element;

											if(file_exists($avatar)) {
												$final_avatar = $avatar;
											}
										}

								?>
								<img src="<?php echo $final_avatar; ?>">
								<div class="caption">
									<h3 class="text-center"><strong><?php echo $result['username'] ?></strong></h3>
								</div>
							</div>
						</div>
						<div class="col-sm-4">

							<!--USER'S INFO-->
							<div class="panel panel-info text-center">
								<div class="panel-heading">
									<h3>About Glorious Me</h3>
								</div>
								<div class="panel-body text-left">
									<ul class="list-inline">
										<li><h4><strong>Username </strong></h4></li>
										<li><h4 style="color: #428bca;"><?php echo ' ' .$result['username'] ?></h4></li>
									</ul>
									<ul class="list-inline">
										<li><h4><strong>Member Since </strong></h4></li>
										<li><h4 style="color: #428bca;"><?php echo ' ' .$result['date'] ?></h4></li>
									</ul>
									<ul class="list-inline">
										<li><h4><strong>Gender </strong></h4></li>
										<li><h4 style="color: #428bca;"><?php echo ' ' .$result['gender'] ?></h4></li>
									</ul>
									<ul class="list-inline">
										<li><h4><strong>Date Of Birth </strong></h4></li>
										<li><h4 style="color: #428bca;"><?php echo ' ' .$result['birthday'] ?></h4></li>
									</ul>
								</div>
								<div class="panel-footer">
									<h4>Contact Me</h4>
									<p><?php echo $result['email'] ?></p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">

							<!--USER'S DESCRIPTION-->
							<div class="well well-lg text-center" style="height: 400px;">
								<h2 class="text-center"><i>You Need To Know</i></h2>
								<h3><strong><i><?php echo $result['description'] ?></i></strong></h3>
							</div>
						</div>
					</div>
				</div>

				<!--RIGHT COLUMN-->
				<div class="col-sm-2">

					<!--MENU-->
					<div class="panel panel-info">
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