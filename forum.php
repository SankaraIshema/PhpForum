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
		<title>Third Wave Forum</title>
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
				<div class="col-sm-2">
					
				</div>

				<!--CENTER MAIN COLUMN-->
				<div class="col-sm-8">

				<!--WELCOME MESSAGE-->

				<div class="well text-center">
					<h2 class="text-danger">
						<strong>
							<span class="glyphicon glyphicon-thumbs-up text-success"></span>
							<i>Hello <?php echo $_SESSION['username']?>, Good To Have You Back </i>
						</strong>
					</h2>					
				</div>

				<?php 

					//ACCESS THE DATABASE
					try {
						$dataBase = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '', 
										array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION	));
					}
					catch(Exception $e) { die('Error : ' .$e->getMessage()); }

					//RETRIEVE THE POSTS
					$request = $dataBase->query('SELECT username, post, f.Id_user AS Id, 
													DATE_FORMAT(date_post, \'%Y %M the %D\') AS date				
													FROM users u INNER JOIN forum_post f
												 	ON u.Id_user = f.Id_user
												 	ORDER BY Id_forum_post DESC
												 	LIMIT 10');

					//DISPLAY THE POSTS
					while($result = $request->fetch()) {
						?>
						<div class="well">
							<div class="media">
								<div class="media-left media-middle">
									<?php 

										$allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');

										$final_avatar = './Avatar/anon-avatar.jpg';

										foreach ($allowed_extensions as $element) {
											$avatar = './Avatar/' .$result['Id'] .'.' .$element;

											if(file_exists($avatar)) {
												$final_avatar = $avatar;
											}
										}

									?>
									<img src="<?php echo $final_avatar; ?>"class="media-object" style="width: 60px;">
								</div>
								<div class="media-body">
									<h4 class="media-heading text-success">
										<a href="profile.php?user=<?php echo $result['username'] ?>">
											<strong><?php echo $result['username'] ?></strong><?php echo ' ' .$result['date'] ?>
										</a>
									</h4>
									<p><?php echo $result['post'] ?></p>
								</div>
							</div>
						</div>
						<?php
					}
					$request->closeCursor();
				?>

				<!--POSTING-->
				<form action="forum_post.php" method="post">

					<!--TEXT AREA-->
					<div class="form-group">
						<label for="new_post" class="control-label">Write a post :</label>
						<textarea class="form-control" rows="5" name="new_post" id="new_post"></textarea>
					</div>

					<!-- SUBMIT BUTTON-->
					<div class="text-center">
						<button type="submit" class="btn btn-success btn-lg" style="margin-bottom: 30px;">POST</button>
					</div>
				</form>
					
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
			<h4 class="text-success">Designed by Jamal Interprises</h4>
			<q class="text-warning"><i>Because the lulz demands it</i></q>
		</div>
	</body>
</html>