<?php
	require_once("adatbazis.php");
	
	$Jatekos_neve = $_GET['Jatekos_neve'];
	if($Jatekos_neve == null || $Jatekos_neve == "")
	{
		header("Location:Fooldal.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!--A játékos nevét, majd függvénnyel add meg!!!-->
		<title> <?php print $Jatekos_neve; ?> </title>
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/bootstrap.css">
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/osszes.css">
	</head>
	<body>
		<?php 
			include("inc/menu.php");
		?>
		<div class="container-fluid">
			<div class="row betumeret24 menusor kozep felkover">
				<div class="col-md-12">
					Játékos adatai:
				</div>
			</div>
			<div class="row betumeret16 menusor felkover">
				<div class="col-md-3">
					<!--Játékos neve-->
					Játékos neve
				</div>
				<div class="col-md-3">
					<!--Csapatának neve-->
					Csapatának neve
				</div>
				<div class="col-md-2">
					<!--Poszt-->
					Poszt
				</div>
				<div class="col-md-1">
					<!--Életkor-->
					Életkor
				</div>
				<div class="col-md-1">
					<!--Magasság-->
					Magasság
				</div>
				<div class="col-md-1">
					<!--Súly-->
					Súly
				</div>
				<div class="col-md-1">
					<!--Értékelése-->
					Értékelése
				</div>
			</div>
			<?php
			$Jatekos = mysqli_fetch_array(mysqli_query($conn, "SELECT p.Nev PNev, j.Nev JNev, cs.Nev CsNev, j.Eletkor JEletkor, 
											j.Magassag JMagassag, j.Suly JSuly, je.Ertekeles JErtekeles, p.Nev JPoszt
											FROM jatekos j
											LEFT JOIN csapatok cs ON cs.Id = j.Csapat_id
											LEFT JOIN poszt p ON p.Id = j.Poszt_id
                                            LEFT JOIN jatekos_ertekelese je ON je.Jatekos_id = j.Id
											WHERE j.Nev = '".$Jatekos_neve."';"));
			print '
			<div class="row betumeret14 vilagoskekhatter">
				<div class="col-md-3">
					<!--Játékos neve-->
					'.$Jatekos["JNev"].'
				</div>
				<div class="col-md-3 feherrahuzas">
					<!--Csapatának neve-->
					<a class="linkfekete" href="/vizsgamunka/Csapat.php?Csapat_neve='. $Jatekos["CsNev"] .'"> '. $Csapat_neve = $Jatekos["CsNev"] .'</a>
				</div>
				<div class="col-md-2">
					<!--Poszt-->
					'.$Jatekos["JPoszt"].'
				</div>
				<div class="col-md-1">
					<!--Életkor-->
					'.$Jatekos["JEletkor"].'
				</div>
				<div class="col-md-1">
					<!--Magasság-->
					'.$Jatekos["JMagassag"].'
				</div>
				<div class="col-md-1">
					<!--Súly-->
					'.$Jatekos["JSuly"].'
				</div>
				<div class="col-md-1">
					<!--Értékelése-->
					'.$Jatekos["JErtekeles"].'
				</div>
			</div>
			';
			?>
			<div class="row menusor felkover betumeret16">
				<div class="col-md-1">
					<!--Meccsek-->
					Meccsek
				</div>
				<div class="col-md-1">
					<!--Gólok-->
					Gólok
				</div>
				<div class="col-md-1">
					<!--Gólok/meccs-->
					Gól /meccs
				</div>
				<div class="col-md-1">
					<!--Gólpasszok-->
					Gólpasszok
				</div>
				<div class="col-md-1">
					<!--Gólpassz/meccs-->
					Gólpassz /meccs
				</div>
				<div class="col-md-1">
					<!--Beadások-->
					Beadások
				</div>
				<div class="col-md-1">
					<!--Sikeres beadások-->
					Sikeres beadások
				</div>
				<div class="col-md-1">
					<!--Nemzetiség-->
					Nemzetiség
				</div>
				<div class="col-md-1">
					<!--Értéke-->
					Értéke
				</div>
				<div class="col-md-1">
					<!--Fizetés-->
					Fizetés
				</div>
				<div class="col-md-1">
					<!--Sérülések-->
					Sérülések
				</div>
				<div class="col-md-1">
					<!--Átigazolások száma-->
					Átigazolások száma
				</div>
			</div>
			<?php $Jatekos = mysqli_fetch_array(mysqli_query($conn, "SELECT j.Meccs JMeccs, j.Gol JGol, j.Gol_meccs JGol_meccs, j.Golpassz JGolpassz
												, j.Golpassz_meccs JGolpassz_meccs, j.Beadas JBeadas, j.Sikeres_beadas JSikeres_beadas
												, j.Nemzetiseg JNemzetiseg, j.Ertek JErtek, j.Fizetes JFizetes, j.Serulesek JSerulesek
												, j.Atigazolas JAtigazolas 
												FROM jatekos j
												LEFT JOIN csapatok cs ON cs.Id = j.Csapat_id	
												WHERE j.Nev = '".$Jatekos_neve."';"));
			
			print '
			<div class="row betumeret14 vilagoskekhatter">
				<div class="col-md-1">
					<!--Meccsek-->
					'.$Jatekos["JMeccs"].'
				</div>
				<div class="col-md-1">
					<!--Gólok-->
					'.$Jatekos["JGol"].'
				</div>
				<div class="col-md-1">
					<!--Gól/meccs-->
					'.round($Jatekos["JGol"]/$Jatekos["JMeccs"],2).'
				</div>
				<div class="col-md-1">
					<!--Gólpasszok-->
					'.$Jatekos["JGolpassz"].'
				</div>
				<div class="col-md-1">
					<!--Gólpasszok/meccs-->
					'.round($Jatekos["JGolpassz"]/$Jatekos["JMeccs"],2).'
				</div>
				<div class="col-md-1">
					<!--Beadás-->
					'.$Jatekos["JBeadas"].'
				</div>
				<div class="col-md-1">
					<!--Sikeres beadások-->
					'.$Jatekos["JSikeres_beadas"].'
				</div>
				<div class="col-md-1">
					<!--Nemzetiség-->
					'.$Jatekos["JNemzetiseg"].'
				</div>
				<div class="col-md-1">
					<!--Értéke-->
					'.$Jatekos["JErtek"].'
				</div>
				<div class="col-md-1">
					<!--Fizetés-->
					'.$Jatekos["JFizetes"].'
				</div>
				<div class="col-md-1">
					<!--Sérülések-->
					'.$Jatekos["JSerulesek"].'
				</div>
				<div class="col-md-1">
					<!--Átigazolások száma-->
					'.$Jatekos["JAtigazolas"].'
				</div>
			</div>
			'; ?>
		</div>							
		<div class="container-fluid">
			<div class="row menusor betumeret24 kozep felkover">
				<div class="col-md-12">
					Játékos értékelései
				</div>
			</div>
			<div class="row menusor betumeret18 felkover">
				<div class="col-md-1">
					<!--Felszabadítások-->
					Felszaba-
					dítások
				</div>
				<div class="col-md-1">
					<!--Gyorsaság-->
					Gyorsaság
				</div>
				<div class="col-md-1">
					<!--Állóképesség-->
					Álló képesség
				</div>
				<div class="col-md-1">
					<!--Passzpontosság-->
					Passz pontosság
				</div>
				<div class="col-md-1">
					<!--Lövés pontosság-->
					Lövés pontosság
				</div>
				<div class="col-md-1">
					<!--Lövő erő-->
					Lövő erő
				</div>
				<div class="col-md-1">
					<!--Beadás-->
					Beadás
				</div>
				<div class="col-md-1">
					<!--Cselezés-->
					Cselezés
				</div>
				<div class="col-md-1">
					<!--Helyezkedés-->
					Helyez-
					kedés
				</div>
				<div class="col-md-1">
					<!--Fejelés-->
					Fejelés
				</div>
				<div class="col-md-1">
					<!--Fizikum-->
					Fizikum
				</div>
				<div class="col-md-1">
					<!--Szerelés-->
					Szerelés
				</div>
			</div>
		</div>
		<div class="kepekhez magyarvalogatotthatterkep">
			<div class="container-fuid feherhatter oldalkitoltese">
				<?php $Jatekos = mysqli_fetch_array(mysqli_query($conn, "SELECT je.Felszabaditas JEFelszabaditas, je.Gyorsasag JEGyorsasag,
																		je.Allo_kepesseg JEAllo_kepesseg, je.Passz_pontossag JEPassz_pontossag,
																		je.Loves_pontossag JELoves_pontossag, je.Lovo_ero JELovo_ero,
																		je.Beadas JEBeadas, je.Cselezes JECselezes, je.Helyezkedes JEHelyezkedes,
																		je.Fejeles JEFejeles, je.Fizikum JEFizikum, je.Szereles JESzereles
																		FROM jatekos_ertekelese je
																		LEFT JOIN jatekos j ON j.Id = je.Jatekos_id
																		WHERE j.Nev = '".$Jatekos_neve."';"));
				print '
				<div class="row betumeret14">
					<div class="col-md-1">
						<!--Felszabadítások-->
						'.$Jatekos["JEFelszabaditas"].'
					</div>
					<div class="col-md-1">
						<!--Gyorsaság-->
						'.$Jatekos["JEGyorsasag"].'
					</div>
					<div class="col-md-1">
						<!--Állóképesség-->
						'.$Jatekos["JEAllo_kepesseg"].'
					</div>
					<div class="col-md-1">
						<!--Passzpontosság-->
						'.$Jatekos["JEPassz_pontossag"].'
					</div>
					<div class="col-md-1">
						<!--Lövés pontosság-->
						'.$Jatekos["JELoves_pontossag"].'
					</div>
					<div class="col-md-1">
						<!--Lövő erő-->
						'.$Jatekos["JELovo_ero"].'
					</div>
					<div class="col-md-1">
						<!--Beadás-->
						'.$Jatekos["JEBeadas"].'
					</div>
					<div class="col-md-1">
						<!--Cselezés-->
						'.$Jatekos["JECselezes"].'
					</div>
					<div class="col-md-1">
						<!--Helyezkedés-->
						'.$Jatekos["JEHelyezkedes"].'
					</div>
					<div class="col-md-1">
						<!--Fejelés-->
						'.$Jatekos["JEFejeles"].'
					</div>
					<div class="col-md-1">
						<!--Fizikum-->
						'.$Jatekos["JEFizikum"].'
					</div>
					<div class="col-md-1">
						<!--Szerelés-->
						'.$Jatekos["JESzereles"].'
					</div>
				</div>
				'; ?>
			</div>
		</div>
		<?php
			include("inc/labresz.php");
		?>
	</body>
</html>