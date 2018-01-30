<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: login.php');
		exit();
	}
	
?>

<DOCTYPE !HTML>
<!-- linia informuje przeglądarkę, w której wersji html,  postanowilismy okodowac dokument  - HTML ozn, że w html 5-->
	<html lang="pl">

	<head>
		<meta charset="utf-8" />
		<!-- charset zestaw znakow z klawiatury-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- sposób wyświetlania na urządzeniach mobilnych-->
		<title>Żeglarstwo</title>
		<meta http-equiv="x-UA-Compatible" content="IE=edge,chrome=1" />

		<link href='https://fonts.googleapis.com/css?family=Lato|Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<!--okreslenie czcionek-->
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="favicon.ico" />
		<!--ikonka strony-->

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		 <link rel="stylesheet" href="lightbox2-master/dist/css/lightbox.min.css">

		<link rel="stylesheet" href="style.css" type="text/css" />
		<link rel="stylesheet" href="css/fontello.css" type="text/css" />
		<link rel="stylesheet" href="css/flaticon.css" type="text/css" />

		<!-- ################-->
		<script src="timer.js"></script>
		<script src="slider.js"></script>
		<script src="LogReg.js"></script>
	</head>

	<body onload="odliczanie();">
		<!--należy ustawić wywołanie funkcji odliczanie w sekcji body, onload - przy załadowaniu strony-->

		<div class="grid">
		<div class="title">
					<i class="flaticon-yachting" ></i>
				Żeglarstwo
				
				<div id="zegar">00:00:00</div>

				<i class="flaticon-big-anchor" ></i>
				
			</div>

			<div class="header" id="main-slider"><!-- outermost container element -->
					<div class="header-wrapper"><!-- innermost wrapper element -->
							<img src=".\img\log2.jpg" alt="First" class="slide" /><!-- slides -->
							<img src=".\img\2.jpg" alt="Second" class="slide" />
							<img src=".\img\3.jpg" alt="Third" class="slide" />
							<img src=".\img\5.png" alt="Third" class="slide" />
					</div>
			</div>	

			<div class="menu">
					
			<nav class="navbar navbar-inverse">
			<div class="container-fluid">
			  <div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				  <span class="baricon-"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="index.php">Żeglarstwo</a>
			  </div>
			  <div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
				  
				  <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Inne <span class="caret"></span></a>
					<ul class="dropdown-menu">
					 <?php 
							$polaczenie = @mysqli_connect('localhost', 'root', '', 'pai_derencz');
							if (!$polaczenie) {
							  die('Wystąpił błąd połączenia: ' . mysqli_connect_errno());
							}
							@mysqli_query($polaczenie, 'SET NAMES utf8');
							
							$sql = 'SELECT `id`, `nazwa` 
										FROM `kategorie` 
										ORDER BY `nazwa`';
							$wynik = mysqli_query($polaczenie, $sql);
							if (mysqli_num_rows($wynik) > 0) {
							  echo "<ul>" . PHP_EOL;
							  while (($kategoria = @mysqli_fetch_array($wynik))) {
								echo '<li><a href="' . $_SERVER["PHP_SELF"] . '?kat_id=' . $kategoria['id'] . '">' . $kategoria['nazwa'] . '</a></li>' . PHP_EOL;
							  }
							  echo "</ul>" . PHP_EOL;
							} else {
							  echo 'wyników 0';
							}
													
					  ?>
					</ul>
				  </li>
				  <li><a href="#">O mnie</a></li>
				  <li class="active"><a href="#">Kontakt</a></li>
					
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><?php echo "<b>E-mail</b>: ".$_SESSION['email'];?></li>
					<li><?php echo " Witaj ".$_SESSION['user'].'!'; ?></li>
				  <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				  <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Wyloguj się</a></li>
				</ul>
			  </div>
			</div>
		  </nav>
			</div>



			
				<article>
			
				</article>
		
			
				<div class="budowa">
					<a href="budowa_jachtu.php" class="tilelinkhtml5">
						<div id="cf">
							<img class="bottom" src=".\img\zaglowka.jpg" alt=Żeglarstwo/>
							<div class="tile5">
								<class="top" i class="flaticon-improvement">
									</i>
									<br />Budowa jachtu
							</div>
						</div>
					</a>
				</div>
				<div class="teoria">
					<a href="teoria_zeglowania.php" class="tilelinkhtml5">
						<div id="cf">
							<img class="bottom" src=".\img\Boat.jpg" alt=Żeglarstwo/>
							<div class="tile5">
								<i class="icon-book"></i>
								<br />Teoria żeglowania
							</div>
						</div>
					</a>

				</div>
				<div class="przepisy">
					<a href="przepisy.php" class="tilelinkhtml5">
						<div id="cf">
							<img class="bottom" src=".\img\unnamed.png" alt=Żeglarstwo/>
							<div class="tile5">
								<class="top" i class="flaticon-lighttower-with-light">
									</i>
									<br />Przepisy
							</div>
						</div>
					</a>
				</div>
				<div class="meteo">
					<a href="meteorologia.php" class="tilelinkhtml5">
						<div id="cf">
							<img class="bottom" src=".\img\sea-storm1.jpg" alt=Żeglarstwo/>
							<div class="tile5">
								<i class="demo-icon icon-cloud-sun"></i>
								<br />Meteorologia
							</div>
						</div>
					</a>
				</div>
				<div class="zaglowce">
					<a href="zaglowce.php" class="tilelinkhtml5">
						<div id="cf">
							<img class="bottom" src=".\img\tall-ships.jpg" alt=Żaglowce/>
							<div class="tile5">
								<i class="flaticon-old-ship"></i>
								<br />Żaglowce
							</div>
						</div>
					</a>
				</div>
				<div class="testy">
					<a href="testy.php" class="tilelinkhtml5">
						<div id="cf">
							<img class="bottom" src=".\img\IMG_7802.jpg" alt=Żaglowce/>
							<div class="tile5">
								<i class="icon-edit"></i>
								<br />Testy
							</div>
						</div>
					</a>
				</div>

			

			<div class="footer">
				<footer>&copy; Armin Derencz</footer>
			</div>
		</div>


	</body>


	</html>