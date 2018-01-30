<?php
//Kawałek kodu, który nas przekieruje na strone testy.php, jeśli będziemy zalogowani
	session_start();
	
	if (isset($_POST['email']))
	{
		//Udana walidacja
		$wszystko_OK=true;

		//Sprawdź poprawność nickname'a
		$nick = $_POST['nick'];

		//Sprawdzenie długości nick'a
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($nick)==false) //sprawdz czy wsszystkie znaki alfanumeryczne
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email']; //wczesniej input'owi nadaliśmy nazwe email
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL); //filtr stosowany do walidacji email, pozwalajcy usunac wszystkie niepoprwne znaki z tego adresu
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT); //hashowanie hasla i dodanie "soli" - kiliku losowych znakow
		
		
		//Czy zaakceptowano regulamin?
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
		}				
		
		//walidacja czy nie bot
		$sekret = "6Lcntj0UAAAAAHlkiYOPtc1boSbBCQbrDnH8xRAx";								//& - drugą zmienną doklejamy symbolem &
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz); //zdekoduj wartość z formatu json - javaScript Object notation - lekki format wymiany danych bazujący na podzbiorze język JS.
		
		if ($odpowiedz->success==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
		}		
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);//informowanie php, ze chcemy wyrzucac(raportowac) wyjatki a nie ostrzezenia
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno()); //rzuc nowym wyjatkiem po to by sekcja catch zlapala go
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick']="Istnieje już użytkownik o takim nicku! Wybierz inny.";
				}
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy użytkonikwa do bazy
					
					if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: witamy.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			//echo '<br />Informacja developerska: '.$e;
		}
		
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
		<script src="LogReg.js"></script>

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

									<form method="post">
									
										Nickname: <br /> <input type="text" value="<?php
											if (isset($_SESSION['fr_nick']))
											{
												echo $_SESSION['fr_nick'];
												unset($_SESSION['fr_nick']);
											}
										?>" name="nick" /><br />
										
										<?php
											if (isset($_SESSION['e_nick']))
											{
												echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
												unset($_SESSION['e_nick']);
											}
										?>
										
										E-mail: <br /> <input type="text" value="<?php
											if (isset($_SESSION['fr_email']))
											{
												echo $_SESSION['fr_email'];
												unset($_SESSION['fr_email']);
											}
										?>" name="email" /><br />
										
										<?php
											if (isset($_SESSION['e_email']))
											{
												echo '<div class="error">'.$_SESSION['e_email'].'</div>';
												unset($_SESSION['e_email']);
											}
										?>
										
										Hasło: <br /> <input type="password"  value="<?php
											if (isset($_SESSION['fr_haslo1']))
											{
												echo $_SESSION['fr_haslo1'];
												unset($_SESSION['fr_haslo1']);
											}
										?>" name="haslo1" /><br />
										
										<?php
											if (isset($_SESSION['e_haslo']))
											{
												echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
												unset($_SESSION['e_haslo']);
											}
										?>		
										
										Powtórz hasło: <br /> <input type="password" value="<?php
											if (isset($_SESSION['fr_haslo2']))
											{
												echo $_SESSION['fr_haslo2'];
												unset($_SESSION['fr_haslo2']);
											}
										?>" name="haslo2" /><br />
										
										<label>
											<input type="checkbox" name="regulamin" <?php
											if (isset($_SESSION['fr_regulamin']))
											{
												echo "checked";
												unset($_SESSION['fr_regulamin']);
											}
												?>/> Akceptuję regulamin
										</label>
										
										<?php
											if (isset($_SESSION['e_regulamin']))
											{
												echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
												unset($_SESSION['e_regulamin']);
											}
										?>	
										
										<div class="g-recaptcha" data-sitekey="6Lcntj0UAAAAALLB6lhLZTLmFrZauuKlECzOK3nY"></div>
										
										<?php
											if (isset($_SESSION['e_bot']))
											{
												echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
												unset($_SESSION['e_bot']);
											}
										?>	
										
										<br />
										
										<input type="submit" value="Zarejestruj się" />
										
									</form>
										
									
								
							</div>
								

							

								


				
				</article>

					
				
		
			
				

			

			<div class="footer">
				<footer>&copy; Armin Derencz</footer>
			</div>

			
		</div>


	</body>


	</html>