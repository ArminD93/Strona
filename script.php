<?php 




								$polaczenie = @mysqli_connect('localhost', 'root', '', 'zagle_pytania');
								if (!$polaczenie) {
								die('Wystąpił błąd połączenia: ' . mysqli_connect_errno());
								}
								@mysqli_query($polaczenie, 'SET NAMES utf8');

								if(isset($_POST['next']))
								{
									$a=$_POST['a'];
								}
								if(!isset($a))
								{
									$a=0;
								}

								
								$sql = "SELECT `id`, `tresc`, `OdpA`, `OdpB`, `OdpC` 
											FROM `meteo` 
											LIMIT 1 OFFSET $a";
											

											
								$wynik = mysqli_query($polaczenie, $sql);
								echo "<form method='post' action=''>";

								

								

								
								
								while (($row = @mysqli_fetch_array($wynik)))
								{						

									echo $row['tresc']. "<br/>";
									echo "<input type='radio' value='odpA' name='odpA'>" .$row['odpA'];
									echo "<input type='radio' value='odpB' name='odpB'>" .$row['odpB'];
									echo "<input type='radio' value='odpC' name='odpCr'>" .$row['odpC']. "<br/>";
									
								}
								$b=$a+1;
								echo "<input type='hidden' value='$b' name='a'>";
								echo "<input type='submit' name='next' value='next'> ";
								echo "<input type='reset' name='reset' value='Reset'>";
								echo "</form>";
								
								
								
												
						?>