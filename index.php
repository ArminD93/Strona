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
			<div class="header">	
					<img src=".\img\log2.jpg" alt=Żeglarstwo/>
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
				  <li class="active"><a href="#">Home</a></li>
				  <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
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
				  <li><a href="#">Kontakt</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				  
				  <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				</ul>
			  </div>
			</div>
		  </nav>
			</div>



			
				<article>

							<div class="text">
									<h1> AKTUALNOŚCI  <img class="pic" src=".\img\boats-icon-png.png" alt="żaglówka" /> </h1>
										
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin non dui nibh. Mauris eget ex tempor,
										aliquam ligula non, consectetur magna. Mauris mauris odio, vulputate sit amet egestas nec, vehicula sit amet magna.
										Fusce magna lectus, cursus non aliquet nec, euismod et nisi. Sed pulvinar lobortis pharetra. 
										In nec neque eu ex mattis condimentum. Nulla eget enim vitae est pellentesque finibus. Duis elementum facilisis dignissim.
										Quisque non sagittis leo. Donec maximus risus sit amet tellus pharetra, non finibus nisi vestibulum. 
										Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
							
										<p>Curabitur dignissim est libero, et pellentesque enim facilisis nec. In eget convallis nisl. Vestibulum sed urna semper,
										cursus sapien sed, tincidunt sapien. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos 
										himenaeos. Suspendisse pretium quis velit varius lacinia. Sed vel feugiat magna. Sed sodales pellentesque nisi. 
										Cras ornare tortor magna, vitae maximus odio maximus at. Phasellus ultricies erat nec nisl pharetra tristique. 
										Nulla convallis turpis id scelerisque sollicitudin. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
										per inceptos himenaeos. Fusce vel gravida lacus. Integer ac congue nulla, at luctus lorem. Morbi fermentum lorem ut mollis 
										tempor.</p>

										<p>Aliquam viverra neque in ipsum rhoncus, quis pulvinar mi aliquam. Etiam tristique nisl nec ante venenatis ultricies.
										Aliquam quis urna sagittis, vulputate mauris at, cursus purus. Aliquam gravida consequat massa sit amet laoreet. 
										Proin quis ullamcorper nisl. Nullam dictum eu felis ut posuere. Pellentesque tristique molestie scelerisque.
										Etiam egestas mattis dui. Praesent id malesuada nisi. Sed eu quam risus. Nullam quis urna arcu. In hac habitasse 
										platea dictumst. Nunc faucibus velit ex, nec suscipit lorem aliquam et. Aenean ornare mi odio, ut imperdiet enim 
										fringilla ac. Sed sed nisl eu tellus convallis ornare ut at nunc. Nam id sollicitudin turpis, at facilisis turpis.</p>
										
										<p>Quisque risus nunc, imperdiet vitae venenatis sit amet, dictum in nibh. In interdum leo sit amet elit commodo,
										a aliquam eros pharetra. Maecenas maximus eu lorem eget hendrerit. Donec nec pulvinar odio. Cras luctus hendrerit 
										nunc, eu tempor magna eleifend vel. Aenean blandit pellentesque sem eget lobortis. Suspendisse potenti. 
										Sed velit mauris, facilisis vel nulla eu, mollis pellentesque eros. Curabitur faucibus quam ante, vitae eleifend 
										libero interdum quis. Fusce vitae eleifend lectus. Sed nec ipsum commodo metus porttitor consectetur.</p>

							</div>
								

							<div class="img">
										<?php
										//Pobieramy dane produktów z bazy dla wybranej (metodą GET) kategorii
											$kat_id = isset($_GET['kat_id']) ? (int)$_GET['kat_id'] : 1;
											$sql = 'SELECT `nazwa`, `opis`, `img`, `altimg` 
																FROM `produkty` 
																WHERE `kategoria_id` = ' . $kat_id .
																' ORDER BY `nazwa`';
											$wynik = mysqli_query($polaczenie, $sql);
											if (mysqli_num_rows($wynik) > 0) {
												while (($produkt = @mysqli_fetch_array($wynik))) {
												echo 
												'<a class="example-image" href="' . $produkt['img'] . '" data-lightbox="example-set" ><img class="example-image" src="' . $produkt['altimg'] . '" alt="image-2" </a> ' 
											  . PHP_EOL;
													}
											} 
											else {
											echo 'wyników 0';
											}
										
											mysqli_close($polaczenie);
													?>
								</div>
				
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