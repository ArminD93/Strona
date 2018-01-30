<?php

	session_start();
	
	if (!isset($_SESSION['udanarejestracja']))
	{
		header('Location: login.php'); //przekieruje na strone z logowaniem
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']); //kasujemy zmienną z sesji
	}
	
	//Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
	if (isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
	if (isset($_SESSION['fr_regulamin'])) unset($_SESSION['fr_regulamin']);
	
	//Usuwanie błędów rejestracji
	if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
	if (isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
	if (isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);
	
?>


<DOCTYPE !HTML>
	<!-- linia informuje przeglądarkę, w której wersji html,  postanowilismy okodowac dokument  - HTML ozn, że w html 5-->
	<html lang="pl">

	<head>
		<meta charset="utf-8" />
		<!-- charset zestaw znakow z klawiatury-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- sposób wyświetlania na urządzeniach mobilnych-->
		<title>Załóż konto</title>
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
		<script src='https://www.google.com/recaptcha/api.js'></script>

		<style>
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
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
					
			
				</div>
		  </nav>
			</div>
			


			
				<article>

							<div class="text">
									<h1> Rejestracja  </h1>

									Dziękujemy za rejestrację w serwisie! Możesz już zalogować się na swoje konto!<br /><br />
	
									<a href="login.php">Zaloguj się na swoje konto!</a>
										
									
								
							</div>
								

							

								


				
				</article>

					
				
		
			
				

			

			<div class="footer">
				<footer>&copy; Armin Derencz</footer>
			</div>

			
		</div>


	</body>


	</html>