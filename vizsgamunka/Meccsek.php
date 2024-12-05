<?php
	require_once("adatbazis.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset= "utf-8">
		<title> Meccs </title>
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/osszes.css">
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/bootstrap.css">
	</head>
		<body>
			<?php 
				include("inc/menu.php");
				$adatok = mysqli_query($conn, "SELECT b.Nev BNEV, m.Id mid, m.Datum datum, hcs.Nev hnev, m.Hazai_csapat_goljai hgol, m.Vendeg_csapat_goljai vgol, 
				vcs.Nev vnev
				FROM meccsek m
				LEFT JOIN bajnoksagok b ON b.Id = m.Bajnoksag_Id
				LEFT JOIN csapatok hcs ON hcs.Id = m.Hazai_csapat_id
				LEFT JOIN csapatok vcs ON vcs.Id = m.Vendeg_csapat_id
				ORDER BY b.Id AND m.Datum;");
				
				foreach($adatok as $ered) {
					$Hcsapif = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Hazai_csapat_id FROM meccsek WHERE Id=".$ered['mid'].";")));
					$Vcsapif = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Vendeg_csapat_id FROM meccsek WHERE Id=".$ered['mid'].";")));
					$Hcsapnevif = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Nev FROM csapatok WHERE Id=".$Hcsapif.";")));
					$Vcsapnevif = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Nev FROM csapatok WHERE Id=".$Vcsapif.";")));
					$Hazaigolif = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Hazai_csapat_goljai FROM meccsek WHERE Hazai_Csapat_id=".$Hcsapif." AND Id=".$ered['mid'].";")));
					$Vendeggolif = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Vendeg_csapat_goljai FROM meccsek WHERE Vendeg_Csapat_id=".$Vcsapif." AND Id=".$ered['mid'].";")));
					$Hedzo = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT e.Nev
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								LEFT JOIN csapatok cs ON cs.Id = m.Hazai_csapat_id
								LEFT JOIN edzok e ON e.Csapat_id = cs.Id
								WHERE Meccs_id = ".$ered["mid"]." AND mecs.Csapat_id = ".$Hcsapif.";")));
					$Vedzo = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT e.Nev
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								LEFT JOIN csapatok cs ON cs.Id = m.Vendeg_csapat_id
								LEFT JOIN edzok e ON e.Csapat_id = cs.Id
								WHERE Meccs_id = ".$ered["mid"]." AND mecs.Csapat_id = ".$Vcsapif.";")));
					$VLiga = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT b.Nev
								FROM bajnoksagok b
								LEFT JOIN meccsek m ON m.Bajnoksag_id = b.Id
								LEFT JOIN meccs_egy_csapat_felol mecs ON mecs.Meccs_id = m.Id
								WHERE m.Id = ".$ered["mid"]." AND mecs.Csapat_id = ".$Vcsapif.";")));
					$HLiga = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT b.Nev
								FROM bajnoksagok b
								LEFT JOIN meccsek m ON m.Bajnoksag_id = b.Id
								LEFT JOIN meccs_egy_csapat_felol mecs ON mecs.Meccs_id = m.Id
								WHERE m.Id = ".$ered["mid"]." AND mecs.Csapat_id = ".$Hcsapif.";")));
					print
					'
					<div class="meccsekhatterkep kepekhez">
						<div class="container-fluid betumeret24 feherhatter">
							<!--Menüsor-->
							<div class="row menusor">
								<div class="col-md-4 feherrahuzas">
									<a class="linkfekete" href="/vizsgamunka/Csapat.php?Csapat_neve='. $Hcsapnevif .'"> '. $Csapat_neve = $Hcsapnevif .'</a>
								</div>
								<div class="col-md-4 kozep">
									'.$Hazaigolif.' &nbsp; &nbsp; : &nbsp; &nbsp; '.$Vendeggolif.'
								</div>
								<div class="col-md-4 jobb feherrahuzas">
									<a class="linkfekete" href="/vizsgamunka/Csapat.php?Csapat_neve='. $Vcsapnevif .'"> '. $Csapat_neve = $Vcsapnevif .'</a>
								</div>
							</div>
							<div class="row kiemeles">
								<div class="col-md-4 feherrahuzas">
									<a class="linkfekete" href="/vizsgamunka/Edzok.php?Edzo_neve='. $Hedzo .'"> '. $Edzo_neve = $Hedzo .'</a>
								</div>
								<div class="col-md-4 kozep">
									Edzők
								</div>
								<div class="col-md-4 jobb feherrahuzas">
									<a class="linkfekete" href="/vizsgamunka/Edzok.php?Edzo_neve='. $Vedzo .'"> '. $Edzo_neve = $Vedzo .'</a>
								</div>
							</div>
							<div class="row kiemeles">
								<div class="col-md-4 feherrahuzas bal">
									<a class="linkfekete" href="/vizsgamunka/Bajnoksag.php?Bajnoksag_neve='. $HLiga .'"> '. $Bajnoksag_neve = $HLiga .'</a>
								</div>
								<div class="col-md-4 kozep">
									Bajnoksága
								</div>
								<div class="col-md-4 feherrahuzas jobb">
									<a class="linkfekete" href="/vizsgamunka/Bajnoksag.php?Bajnoksag_neve='. $VLiga .'"> '. $Bajnoksag_neve = $VLiga .'</a>
								</div>
							</div>
							<div class="row kiemeles">
								<div class="col-md-4">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT bcs.Helyezes
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									LEFT JOIN bajnoksagok_csapatok bcs ON bcs.Csapat_id = m.Hazai_Csapat_id
									WHERE Meccs_id = ".$ered["mid"]." AND mecs.Csapat_id = ".$Hcsapif.";"))).'
								</div>
								<div class="col-md-4 kozep">
									Liga helyezés
								</div>
								<div class="col-md-4 jobb">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT bcs.Helyezes
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									LEFT JOIN bajnoksagok_csapatok bcs ON bcs.Csapat_id = m.Vendeg_Csapat_id
									WHERE Meccs_id = ".$ered["mid"]." AND mecs.Csapat_id = ".$Vcsapif.";"))).'
								</div>
							</div>
							<div class="row kiemeles">
								<div class="col-md-4">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Loves
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Hcsapif.";"))).'
								</div>
								<div class="col-md-4 kozep">
									Lövések
								</div>
								<div class="col-md-4 jobb">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Loves
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Vcsapif.";"))).'
								</div>
							</div>
							<!--Kapura lövések-->
							<div class="row kiemeles">
								<div class="col-md-4">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Kapura_loves
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Hcsapif.";"))).'
								</div>
								<div class="col-md-4 kozep">
									Kapura lövések
								</div>
								<div class="col-md-4 jobb">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Kapura_loves
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Vcsapif.";"))).'
								</div>
							</div>
							<!--Szögletek-->
							<div class="row kiemeles">
								<div class="col-md-4">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Szoglet
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Hcsapif.";"))).'
								</div>
								<div class="col-md-4 kozep">
									Szöglet
								</div>
								<div class="col-md-4 jobb">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Szoglet
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Vcsapif.";"))).'
								</div>
							</div>
							<!--Védések-->
							<div class="row kiemeles">
								<div class="col-md-4">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Vedesek
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Hcsapif.";"))).'
								</div>
								<div class="col-md-4 kozep">
									Védések
								</div>
								<div class="col-md-4 jobb">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Vedesek
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Vcsapif.";"))).'
								</div>
							</div>
							<!--Szabálytalanság-->
							<div class="row kiemeles">
								<div class="col-md-4">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Szabalytalansagok
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Hcsapif.";"))).'
								</div>
								<div class="col-md-4 kozep">
									Szabálytalanság
								</div>
								<div class="col-md-4 jobb">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Szabalytalansagok
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Vcsapif.";"))).'
								</div>
							</div>
							<!--Sárga lap-->
							<div class="row kiemeles">
								<div class="col-md-4">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Sarga_lap
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Hcsapif.";"))).'
								</div>
								<div class="col-md-4 kozep">
									Sárga lap
								</div>
								<div class="col-md-4 jobb">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Sarga_lap
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Vcsapif.";"))).'
								</div>
							</div>
							<!--Piros lap-->
							<div class="row kiemeles">
								<div class="col-md-4">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Piros_lap
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Hcsapif.";"))).'
								</div>
								<div class="col-md-4 kozep">
									Piros lap
								</div>
								<div class="col-md-4 jobb">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Piros_lap
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Vcsapif.";"))).'
								</div>
							</div>
							<!--Labda birtoklás-->
							<div class="row kiemeles">
								<div class="col-md-4">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Labda_birtoklas
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Hcsapif.";"))).'
								</div>
								<div class="col-md-4 kozep">
									Labda birtoklás
								</div>
								<div class="col-md-4 jobb">
									'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Labda_birtoklas
									FROM meccs_egy_csapat_felol mecs
									LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
									WHERE Meccs_id = ".$ered['mid']." AND mecs.Csapat_id = ".$Vcsapif.";"))).'
								</div>
							</div>
						</div>
					</div>
				';
				}
					include("inc/labresz.php");
				?>
	</body>
</html>