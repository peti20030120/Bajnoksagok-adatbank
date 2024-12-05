<?php 
	require_once("adatbazis.php");
	
	$Csapat_neve= $_GET['Csapat_neve'];
	if($Csapat_neve == null || $Csapat_neve == "")
	{
		header("Location:Fooldal.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset= "utf-8">
		<title> <?php print $Csapat_neve; ?> </title>
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/bootstrap.css">
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/osszes.css">
	</head>
	
	<!--http:\\localhost\vizsgamunka\Edzok.php?nev=Kis-Jozsef-->
	
	<body>
		<!--Menü sor eleje-->
		<?php
			include("inc/menu.php");
		?>
		<!--Menü sor vége-->
		<div class="container-fluid">
			<div class="row menusor betumeret24 felkover">
				<div class="col-md-4">
					<!--Csapat neve-->
					Csapat neve
				</div>
				<div class="col-md-4 kozep">
					Bajnokságának neve
					<!--Bajnokságának neve-->
				</div>
				<div class="col-md-4 jobb">
					Edzőjének neve
					<!--Edzőjének neve-->
			</div>
		</div>
			<!--Csapat alap adatok lekérésének az eleje-->
				<?php
				$Alap_adat = mysqli_query($conn, "SELECT ed.Nev NEV, b.Nev nev
													FROM csapatok
													LEFT JOIN edzok ed ON ed.Csapat_Id = csapatok.Id
													LEFT JOIN bajnoksagok_csapatok bcs ON bcs.csapat_id = csapatok.Id
													LEFT JOIN bajnoksagok b on b.Id = bcs.bajnoksag_id
													WHERE csapatok.Nev = '".$Csapat_neve."';");
					foreach($Alap_adat as $ered) {
						print '
			<div class="row betumeret16 vilagoskekhatter">
				<div class="col-md-4">
					<!--Csapat neve-->
					'.$Csapat_neve.'
				</div>
				<div class="col-md-4 kozep szurkerahuzas">
					<!--Bajnokságának neve-->
					<a class="linkfekete" href="/vizsgamunka/Bajnoksag.php?Bajnoksag_neve='. $ered["nev"] .'"> '. $Bajnoksag_neve = $ered["nev"] .'</a>
				</div>
				<div class="col-md-4 jobb szurkerahuzas">
					<!--Edzőjének neve-->
					<a class="linkfekete" href="/vizsgamunka/Edzok.php?Edzo_neve='. $ered["NEV"] .'"> '. $Edzo_neve = $ered["NEV"] .'</a>
				</div>
			</div>
						';					
					}
				?>
			<!--Csapat alap adatok lekérésének az vége-->
			<div class="row menusor betumeret16 felkover">
				<div class="col-md-2">
					<!--Gyorsaság-->
					Gyorsaság
				</div>
				<div class="col-md-1">
					<!--Védekezés-->
					Védekezés
				</div>
				<div class="col-md-1 ">
					<!--Középpálya-->
					Középpálya
				</div>
				<div class="col-md-1 ">
					Támadás
					<!--Támadás-->
				</div>
				<div class="col-md-2">
					<!--Gól/meccs-->
					Gól/meccs
				</div>
				<div class="col-md-2">
					<!--Kapott gól/meccs-->
					Kapott gól/meccs
				</div>
				<div class="col-md-1">
					<!--Moralitás-->
					Moralitás
				</div>
				<div class="col-md-1">
					<!--Forma-->
					Forma
				</div>
			</div>
		</div>
		<div class="container-fluid vilagoskekhatter">
					<?php
						$adatok = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Id
														FROM csapatok 
														WHERE Nev = '".$Csapat_neve."';")));
						
						
						$Alap_adat2 = mysqli_query($conn, "SELECT cs.Gyorsasag, cs.Vedekezes, cs.Kozeppalya, cs.Tamadas, 
															cs.Moralitas, cs.Forma
															FROM csapatok cs
															WHERE Id = ".$adatok.";");
						foreach($Alap_adat2 as $ered) {
							$Seged_szam1 = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT SUM((SELECT SUM(Hazai_csapat_goljai)
																						FROM meccsek
																						WHERE Hazai_csapat_id = ".$adatok."));")));
																							
							
							$Seged_szam2 = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT SUM((SELECT SUM(Vendeg_csapat_goljai)
																						FROM meccsek
																						WHERE Vendeg_csapat_id = ".$adatok."));")));
								
							$Lott_golok = $Seged_szam1 + $Seged_szam2;
							$Meccsek = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(Id)
																						FROM meccsek
																						WHERE Hazai_csapat_id = ".$adatok." OR Vendeg_csapat_id = ".$adatok.";")));
							$Gol_meccs = round($Lott_golok/$Meccsek,2);
							$Seged_szam3 = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT IFNULL(SUM((SELECT SUM(Hazai_csapat_goljai)
																							FROM meccsek
																							WHERE Vendeg_csapat_id = ".$adatok.")), 0);")));
							$Seged_szam4 = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT IFNULL(SUM((SELECT SUM(Vendeg_csapat_goljai)
																							FROM meccsek
																							WHERE Hazai_csapat_id = ".$adatok.")), 0);")));
							$Kapott_golok = $Seged_szam3 + $Seged_szam4;
							$Kapott_gol_meccs = round($Kapott_golok/$Meccsek,2);

							print '
								<div class="row betumeret14">
									<div class="col-md-2">
										<!--Gyorsaság-->
										'.$ered["Gyorsasag"].'
									</div>
									<div class="col-md-1">
										<!--Védekezés-->
										'.$ered["Vedekezes"].'
									</div>
									<div class="col-md-1">
										<!--Középpálya-->
										'.$ered["Kozeppalya"].'
									</div>
									<div class="col-md-1">
										<!--Támadás-->
										'.$ered["Tamadas"].'
									</div>
									<div class="col-md-2">
										<!--Gól/meccs-->
										'.$Gol_meccs.'
									</div>
									<div class="col-md-2">
										<!--Kapott gól/meccs-->
										'.$Kapott_gol_meccs.'
									</div>
									<div class="col-md-1">
										<!--Moralitás-->
										'.$ered["Moralitas"].'
									</div>
									<div class="col-md-1">
										<!--Forma-->
										'.$ered["Forma"].'
									</div>
								</div>
							';					
						}
					?>
		</div>
		<div class="container-fluid kozep menusor betumeret24 felkover">
			Játékosai
		</div>
		<div class="container-fluid">
			<div class="row menusor betumeret18 felkover">
				<div class="col-md-2">
					<!--Neve-->
					Neve
				</div>
				<div class="col-md-1">
					<!--Életkor-->
					Életkor
				</div>
				<div class="col-md-1">
					<!--Nemzetiseg-->
					Nemzetiség
				</div>
				<div class="col-md-2 kozep">
					<!--Poszt-->
					Poszt
				</div>
				<div class="col-md-1">
					<!--Értékelése-->
					Értékelése
				</div>
				<div class="col-md-1 kozep">
					<!--Értéke-->
					Értéke
				</div>
				<div class="col-md-2">
					<!--Góljainak száma-->
					Góljainak száma
				</div>
				<div class="col-md-2">
					<!--Gólpasszok száma-->
					Gólpasszok száma
				</div>
			</div>
		</div>
		<div class="kepekhez szurkolohatterkep">
			<div class="container-fluid feherhatter">
						<?php
						$Jatekos = mysqli_query($conn, "SELECT jatekos.Nev JNev, jatekos.Eletkor JEletkor, jatekos.Nemzetiseg JNemzetiseg
														, jatekos.Golpassz JGolpassz, je.Ertekeles JErtekeles
														, jatekos.Ertek JErtek, jatekos.Gol JGol, p.Nev JPoszt
														FROM jatekos
														LEFT JOIN csapatok cs ON cs.Id = jatekos.Csapat_id
														LEFT JOIN jatekos_ertekelese je ON je.Jatekos_id = jatekos.Id
														LEFT JOIN Poszt p ON p.Id = jatekos.Poszt_id
														WHERE cs.Nev = '".$Csapat_neve."'
														ORDER BY p.Id;");
						foreach($Jatekos as $ered) {
							print '
								<div class="row kiemeles betumeret16">
									<div class="col-md-2 szurkerahuzas">
										<!--Neve-->
										<a class="linkfekete" href="/vizsgamunka/Jatekos.php?Jatekos_neve='. $ered["JNev"] .'"> '. $Jatekos_neve = $ered["JNev"] .'</a>
									</div>
									<div class="col-md-1">
										<!--Életkor-->
										'.$ered["JEletkor"].'
									</div>
									<div class="col-md-1">
										<!--Nemzetiseg-->
										'.$ered["JNemzetiseg"].'
									</div>
									<div class="col-md-2 kozep">
										<!--Poszt-->
										'.$ered["JPoszt"].'
									</div>
									<div class="col-md-1">
										<!--Értékelése-->
										'.$ered["JErtekeles"].'
									</div>
									<div class="col-md-1">
										<!--Értéke-->
										'.$ered["JErtek"].'
									</div>
									<div class="col-md-2">
										<!--Góljainak száma-->
										'.$ered["JGol"].'
									</div>
									<div class="col-md-2">
										<!--Gólpassz-->
										'.$ered["JGolpassz"].'
									</div>
								</div>
							';					
						}
						?>
			</div>
			<div class="container-fluid kozep menusor betumeret24 felkover">
					Meccsei
			</div>
		</div>
		<div class="meccsekhatterkep kepekhez">
			<div class="container-fluid feherhatter">
				
				
					<?php
						$Osszes_meccs = mysqli_query($conn, "SELECT m.Datum datum, hcs.Nev hnev, m.Hazai_csapat_goljai hgol,
						m.Vendeg_csapat_goljai vgol, vcs.Nev vnev, m.Id mid
	FROM meccsek m
	LEFT JOIN csapatok hcs ON hcs.Id = m.Hazai_csapat_id
	LEFT JOIN csapatok vcs ON vcs.Id = m.Vendeg_csapat_id
	WHERE hcs.Nev = '".$Csapat_neve."' OR vcs.Nev = '".$Csapat_neve."';");
						foreach($Osszes_meccs as $ered) {
							print
							'
							<div class="row kiemeles betumeret16">
								<div class="col-md-2">
								<!--Dátum-->
								'.$ered["datum"].'
								</div>
								<div class="col-md-3 feherrahuzas kozep">
									<!--Hazai csapat neve-->
									<a class="linkfekete" href="/vizsgamunka/Csapat.php?Csapat_neve='. $ered["hnev"] .'"> '. $Csapat_neve = $ered["hnev"] .'</a>
								</div>
								<div class="col-md-1 jobb">
									<!--Hazai csapat góljai-->
									'.$ered["hgol"].'
								</div>
								<div class="col-md-1 bal">
									<!--Vendég csapat góljai-->
									'.$ered["vgol"].'
								</div>
								<div class="col-md-3 feherrahuzas kozep">
									<!--Vendég csapat neve-->
									<a class="linkfekete" href="/vizsgamunka/Csapat.php?Csapat_neve='. $ered["vnev"] .'"> '. $Csapat_neve = $ered["vnev"] .'</a>
								</div>
									<div class="col-md-2 feherrahuzas jobb">
									<!--Bővebb információ-->
									<a class="linkfekete" href="/vizsgamunka/Meccs.php?Meccs_id='. $ered["mid"] .'" '. $Meccs_id = $ered["mid"].'>  Bővebb infomáció </a>
								</div>
							</div>
							';
						}
					?>
				
			</div>
		</div>
			<?php
				include("inc/labresz.php");
			?>
	</body>
</html>