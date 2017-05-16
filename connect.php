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
		<title>Connection-Page</title>
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
					<?php 

						if(isset($_COOKIE['username']) AND isset($_COOKIE['password'])) {
			
							//ACCESS DATABASE
							try {
								$dataBase = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '', 
												array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION	));
							}
							catch(Exception $e) { die('Error : ' .$e->getMessage()); }

							//TABLE REQUEST
							$request = $dataBase->prepare('SELECT Id_user FROM users 
															WHERE username = :username 
															AND password   = :password');

							$request->execute(array(
								'username' => $_COOKIE['username'],
								'password' => $_COOKIE['password']));

							if($result = $request->fetch()) {
								$_SESSION['username'] = $_COOKIE['username'];
								$_SESSION['Id']       = $result['Id_user'];
							}
						}

						if(!empty($_SESSION)) {

							?>

							<!--MENU-->
							<div class="panel panel-primary">
								<div class="panel-heading text-center">
									<h4><?php echo $_SESSION['username'] ?></h4>
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills nav-stacked">
										<li>
											<a href="connect.php">
												<span class="glyphicon glyphicon-home"></span> 
												Home-Page
											</a>
										</li>
										<li>
											<a href="forum.php">
												<span class="glyphicon glyphicon-eye-open"></span> 
												The Forum
											</a>
										</li>
										<li>
											<a href="profile.php?user=<?php echo $_SESSION['username'] ?>">
												<span class="glyphicon glyphicon-star-empty"></span> 
												My Profile
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
							<?php
						}
					?>

					<!--NEW USER-->
					<div class="panel panel-primary text-center">
						<div class="panel-heading">
							<h4>New to the<br> Community ?</h4>
						</div>
						<div class="panel-body">
							<p>
								Worry no more !<br><br>
								Registration is a simple process that will only take a few minutes.<br><br>
								The first step is to click on the link below.
							</p>
						</div>
						<div class="panel-footer">
							<button class="btn btn-primary">
								<a href="register.php" style="color: white;">REGISTER</a>
							</button>
						</div>
					</div>	
					
				</div>

				<!--CENTER MAIN COLUMN-->
				<div class="col-sm-8 text-center">
					<div class="container-fluid">

						<!--WELCOME MESSAGE-->
						<div class="well">
							<h2 class="text-primary">Welcome to the Third Wave</h2>
							<p><i>Feel free to log in !</i></p>
						</div>
						
						<!--THE FORM-->
						<form action="connect_post.php" method="post" class="form-horizontal">
							
							<div class="well well-lg">

								<!--USERNAME-->
								<div class="form-group">
									<label for="username" class="col-sm-3">Username </label>
									<div class="col-sm-7">
										<input type="text" name="username" id="username" 
													placeholder="Your username" class="form-control">
									</div>
								</div>

								<!--PASSWORD-->
								<div class="form-group">
									<label for="password" class="col-sm-3">Password </label>
									<div class="col-sm-7">
										<input type="password" name="password" id="password" 
													placeholder="Your password" class="form-control">
									</div>
								</div>
							</div>

							<!--REMEMBER ME-->
							<div class="form-group">
								<label for="remember_me">Remeber Me </label>
								<input type="checkbox" name="remember_me" id="remember_me">
							</div>

							<!--SUBMIT BUTTON-->
							<div class="text-center" style="margin-bottom: 30px;">
								<button type="submit" class="btn btn-primary btn-lg">LOG IN</button>			
							</div>
						</form>		
					</div>
					<div class="container-fluid">
						<div class="well">
							<h2 class="text-primary">The Last Gossip</h2>
							<i>trust us, it is entirely mostly true</i>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>THE BIGGEST SECRET: DO REPTILIAN-HUMAN HYBRIDS RUN OUR WORLD?</h4>
							</div>
							<div class="panel-body text-left">
								<p>Controversy has become the mantra of the whirlwind that is David Icke’s life over the past few decades. Since the early 90’s, he has challenged people’s parameters of reality suggesting that all is not what it seems in regards to how our world is run. David’s verdict is clear; the people that lie at the top of our power structures are hiding a sinister secret, one that would make anyone sound crazy if it were verbalized. Since the dawn of civilized man, the ruling class have been controlled by extra-terrestrial/dimensional beings, with an agenda which ultimately establishes the human race as mindless and robotic slaves to a system based on fear and control. It is easy to see why this theory has attracted so much back-lash.</p><br>
							</div>
							<div class="panel-footer text-left">
								<p><i>JEFF ROBERTS OCTOBER 17, 2013</i></p>
							</div>	

						</div>
					</div>
				</div>

				<!--RIGHT COLUMN-->
				<div class="col-sm-2">

					<!--ABOUT US-->
					<div class="panel panel-primary text-center">
						<div class="panel-heading">
							<h4>All there is to know about the Third Wave</h4>
						</div>
						<div class="panel-body text-left">
							<p>A recent study has found that women who carry a little extra weight live longer than the men who mention it.</p>
							<p>Life is all about perspective. The sinking of the Titanic was a miracle to the lobsters in the ship's kitchen.</p>
							<p>Apparently I snore so loudly that it scares everyone in the car I'm driving</p>
							<p>I changed my password to "incorrect". So whenever I forget what it is the computer will say "Your password is incorrect".</p>
							<p>Childs experience: if a mother is laughing at the fathers jokes, it means they have guests.</p>
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