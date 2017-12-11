<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="baricon-"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
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
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <h3>Collapsible Navbar</h3>
  <p>In this example, the navigation bar is hidden on small screens and replaced by a button in the top right corner (try to re-size this window).
  <p>Only when the button is clicked, the navigation bar will be displayed.</p>


<?php
  //Pobieramy dane produktów z bazy dla wybranej (metodą GET) kategorii
$kat_id = isset($_GET['kat_id']) ? (int)$_GET['kat_id'] : 1;
$sql = 'SELECT `nazwa`, `opis` 
             FROM `produkty` 
             WHERE `kategoria_id` = ' . $kat_id .
             ' ORDER BY `nazwa`';
$wynik = mysqli_query($polaczenie, $sql);
if (mysqli_num_rows($wynik) > 0) {
  while (($produkt = @mysqli_fetch_array($wynik))) {
      echo '<p><b>' . $produkt['nazwa'] . '</b>: ' . $produkt['opis'] . '</p>' . PHP_EOL;
  }
} else {
  echo 'wyników 0';
}
 
mysqli_close($polaczenie);
?>
</div>

</body>
</html>
