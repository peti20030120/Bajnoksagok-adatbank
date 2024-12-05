<?php
	require_once("adatbazis.php");
	
	$Bajnoksag_neve = $_GET['Bajnoksag_neve'];
	if($Bajnoksag_neve == null || $Bajnoksag_neve == "")
	{
		header("Location:Fooldal.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset= "utf-8">
		<title> <?php print $Bajnoksag_neve; ?> </title>
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/osszes.css">
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/bootstrap.css">
	</head>
	<body>		
		<?php
			include("inc/menu.php");
		?>
		<div class="magyarvalogatotthatterkep kepekhez">
			<div class="leiras betumeret16 feherhatter">
				<?php
					print implode(mysqli_fetch_row(mysqli_query($conn, "SELECT leiras FROM bajnoksagok WHERE bajnoksagok.Nev='".$Bajnoksag_neve."';")));
				?>
			</div>
		</div>
		<div class="container-fluid kozep">
			<div class="row menusor betumeret24">
				<div class="col-md-1">
					<!--Helyezés-->
					H
				</div>
				<div class="col-md-2">
					<!--Csapat neve-->
					Csapat neve
				</div>
				<div class="col-md-1">
					<!--Meccsek száma-->
					M
				</div>
				<div class="col-md-1">
					<!--Győzelmek-->
					Gy
				</div>
				<div class="col-md-1">
					<!--Döntetlenek-->
					D
				</div>
				<div class="col-md-1">
					<!--Vereségek-->
					V
				</div>
				<div class="col-md-1">
					<!--Lőtt gólok-->
					LG
				</div>
				<div class="col-md-1">
					<!--Kapott gólok-->
					KG
				</div>
				<div class="col-md-1">
					<!--Gól különbség-->
					GK
				</div>
				<div class="col-md-1">
					<!--Pontok-->
					P
				</div>
			</div>
		</div>
		<div class="szurkolohatterkep kepekhez">
			<div class="container-fluid feherhatter">
				

				
				<!--Itt jártunk, bajnoksagok_csapatok tábla kérdése-->
					<?php
						$adatok = mysqli_query($conn, "SELECT bajnoksagok.Nev
														, cs.nev
														, cs.Id csid 
														FROM bajnoksagok 
														LEFT JOIN bajnoksagok_csapatok bcs ON bcs.bajnoksag_id = bajnoksagok.id
														LEFT JOIN csapatok cs ON cs.id = bcs.csapat_id
														WHERE bajnoksagok.nev = '".$Bajnoksag_neve."'
														ORDER BY csid;");
														
						/*Számolásos adatlekérés eleje*/								
														
						foreach($adatok as $ered){
							$Gyozelmek = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(Id)
																						FROM meccsek
																						WHERE (Hazai_csapat_id = ".$ered['csid']." AND Hazai_csapat_goljai > Vendeg_csapat_goljai) 
																						OR (Vendeg_csapat_id = ".$ered['csid']." AND Vendeg_csapat_goljai > Hazai_csapat_goljai);")));
							$Dontetlenek = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(Id)
																						FROM meccsek
																						WHERE (Hazai_csapat_id = ".$ered['csid']." AND Hazai_csapat_goljai = Vendeg_csapat_goljai) 
																						OR (Vendeg_csapat_id = ".$ered['csid']." AND Vendeg_csapat_goljai = Hazai_csapat_goljai);")));
							$Pontok = $Gyozelmek*3 + $Dontetlenek;
							
							mysqli_query($conn, "UPDATE bajnoksagok_csapatok SET bajnoksagok_csapatok.Pontok = ".$Pontok."
												WHERE bajnoksagok_csapatok.csapat_id = ".$ered['csid'].";");
						}		

						
						
														
						/*Számolásos adatlekérés vége*/								
														
														
						$adatok2 = mysqli_query($conn, "SELECT bajnoksagok.Nev BNev
														, cs.Nev CsNev
														, cs.Id csid 
														, bcs.Pontok
														FROM bajnoksagok 
														LEFT JOIN bajnoksagok_csapatok bcs ON bcs.bajnoksag_id = bajnoksagok.id
														LEFT JOIN csapatok cs ON cs.id = bcs.csapat_id
														WHERE bajnoksagok.nev = '".$Bajnoksag_neve."'
														ORDER BY Pontok DESC;");
						
						
						$i = 0;
						foreach($adatok2 as $ered) {
							$Gyozelmek = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(Id)
																						FROM meccsek
																						WHERE (Hazai_csapat_id = ".$ered['csid']." AND Hazai_csapat_goljai > Vendeg_csapat_goljai) 
																						OR (Vendeg_csapat_id = ".$ered['csid']." AND Vendeg_csapat_goljai > Hazai_csapat_goljai);")));
							$Dontetlenek = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(Id)
																						FROM meccsek
																						WHERE (Hazai_csapat_id = ".$ered['csid']." AND Hazai_csapat_goljai = Vendeg_csapat_goljai) 
																						OR (Vendeg_csapat_id = ".$ered['csid']." AND Vendeg_csapat_goljai = Hazai_csapat_goljai);")));
							$Veresegek = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(Id)
																						FROM meccsek
																						WHERE (Hazai_csapat_id = ".$ered['csid']." AND Hazai_csapat_goljai < Vendeg_csapat_goljai) 
																						OR (Vendeg_csapat_id = ".$ered['csid']." AND Vendeg_csapat_goljai < Hazai_csapat_goljai);")));
							$Meccsek = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(Id)
																					FROM meccsek
																					WHERE Hazai_csapat_id = ".$ered['csid']." OR Vendeg_csapat_id = ".$ered['csid'].";")));
							
							$Seged_szam1 = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT IFNULL(SUM((SELECT SUM(Hazai_csapat_goljai)
																						FROM meccsek
																						WHERE Hazai_csapat_id = ".$ered['csid'].")), 0);")));
							
							
							$Seged_szam2 = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT IFNULL(SUM((SELECT SUM(Vendeg_csapat_goljai)
																						FROM meccsek
																						WHERE Vendeg_csapat_id = ".$ered['csid'].")), 0);")));

							$Lott_golok = $Seged_szam1 + $Seged_szam2;
							$Seged_szam3 = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT IFNULL(SUM((SELECT SUM(Hazai_csapat_goljai)
																						FROM meccsek
																						WHERE Vendeg_csapat_id = ".$ered['csid'].")), 0);")));
							$Seged_szam4 = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT IFNULL(SUM((SELECT SUM(Vendeg_csapat_goljai)
																						FROM meccsek
																						WHERE Hazai_csapat_id = ".$ered['csid'].")), 0);")));
							$Kapott_golok = $Seged_szam3 + $Seged_szam4;
							$Gol_kulonbseg = $Lott_golok - $Kapott_golok;
							
							$i++;
							mysqli_query($conn, "UPDATE bajnoksagok_csapatok
												SET Helyezes = ".$i."
												WHERE Csapat_id = ".$ered['csid'].";");
							$Pontok = $Gyozelmek*3 + $Dontetlenek*1;
							print '
								<div class="row kiemeles betumeret16">
									<div class="col-md-1">
										<!--Helyezés-->
										'.$i.'
									</div>
									
									<div class="col-md-2 feherrahuzas">
										<!--Csapat neve-->
										<a class="linkfekete" href="/vizsgamunka/Csapat.php?Csapat_neve='. $ered["CsNev"] .'"> '. $Csapat_neve = $ered["CsNev"] .'</a>
									</div>
									
									<div class="col-md-1">
										<!--Meccsek_szama-->
										'. $Meccsek .'
									</div>
									
									<div class="col-md-1">
										<!--Gyozelmek-->
										'.$Gyozelmek.'
									</div>
									
									<div class="col-md-1">
										<!--Döntetlenek-->
										'.$Dontetlenek.'
									</div>
									
									<div class="col-md-1">
										<!--Vereségek-->
										'.$Veresegek.'
									</div>
									
									<div class="col-md-1">
										<!--Lőtt gólok-->
										'.$Lott_golok.'
									</div>
									
									<div class="col-md-1">
										<!--Kapott gólok-->
										'.$Kapott_golok.'
									</div>
									
									<div class="col-md-1">
										<!--Gól különbség-->
										'.$Gol_kulonbseg.'
									</div>
									
									<div class="col-md-1">
										<!--Pontok-->
										'. $ered["Pontok"] .'
									</div>
								</div>
							';						
						}
					?>
			</div>
		</div>
		<div class="meccsekhatterkep kepekhez">
			<div class="container-fluid kozep feherhatter oldalkitoltese">
				<div class="row menusor betumeret24">
					<div class="col-md-12 feherrahuzas">
						<a class="linkfekete" href="/vizsgamunka/Meccsek.php"> Meccsek </a>
					</div>
				</div>
				<?php
					$meccsek = mysqli_query($conn, "SELECT m.Id mid, m.Datum datum, hcs.Nev hnev, m.Hazai_csapat_goljai hgol, m.Vendeg_csapat_goljai vgol, vcs.Nev vnev
	FROM meccsek m
	LEFT JOIN bajnoksagok b ON b.Id = m.Bajnoksag_Id
	LEFT JOIN csapatok hcs ON hcs.Id = m.Hazai_csapat_id
	LEFT JOIN csapatok vcs ON vcs.Id = m.Vendeg_csapat_id
	WHERE b.Nev = '".$Bajnoksag_neve."'
	ORDER BY m.Datum;");
					foreach($meccsek as $ered) {
					print '
					<div class="row kiemeles betumeret16">
						<div class="col-md-2">
							<!--Dátum-->
							'.$ered["datum"].'
						</div>
						<div class="col-md-3 feherrahuzas">
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
						<div class="col-md-3 feherrahuzas">
							<!--Vendég csapat neve-->
							<a class="linkfekete" href="/vizsgamunka/Csapat.php?Csapat_neve='. $ered["vnev"] .'"> '. $Csapat_neve = $ered["vnev"] .'</a>
						</div>
							<div class="col-md-2 feherrahuzas">
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