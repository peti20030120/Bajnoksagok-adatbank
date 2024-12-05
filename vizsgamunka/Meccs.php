<?php
	require_once("adatbazis.php");
	
	$Meccs_id = $_GET['Meccs_id'];
	
	$Cim = mysqli_fetch_array(mysqli_query($conn, "SELECT hcsap.Nev HNEV, m.Hazai_csapat_goljai HGOL, m.Vendeg_csapat_goljai VGOL, vcsap.Nev VNEV 
								FROM meccsek m
								LEFT JOIN csapatok hcsap ON hcsap.Id = m.Hazai_csapat_id 
								LEFT JOIN csapatok vcsap ON vcsap.Id= m.Vendeg_csapat_id 
								WHERE m.Id = ".$Meccs_id.";"));
	if($Meccs_id == null || $Meccs_id == "")
	{
		header("Location:Meccsek.php");
		exit();
	}


?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset= "utf-8">
		<title> <?php print $Cim["HNEV"]." ".$Cim["HGOL"].":".$Cim["VGOL"]." ".$Cim["VNEV"]; ?> </title>
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/osszes.css">
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/bootstrap.css">
	</head>
	<body>
		<?php 
			include("inc/menu.php");
		?>
		<div class="meccsekhatterkep">
			<div class="container-fluid betumeret20 oldalkitoltese feherhatter">
				<?php
					$Hcsap = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Hazai_csapat_id FROM meccsek WHERE Id=".$Meccs_id.";")));
					$Vcsap = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Vendeg_csapat_id FROM meccsek WHERE Id=".$Meccs_id.";")));
					$Hcsapnev = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Nev FROM csapatok WHERE Id=".$Hcsap.";")));
					$Vcsapnev = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Nev FROM csapatok WHERE Id=".$Vcsap.";")));
					$Hazaigol = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Hazai_csapat_goljai FROM meccsek WHERE Hazai_Csapat_id=".$Hcsap." AND Id=".$Meccs_id.";")));
					$Vendeggol = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Vendeg_csapat_goljai FROM meccsek WHERE Vendeg_Csapat_id=".$Vcsap." AND Id=".$Meccs_id.";")));
					$Hedzo = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT e.Nev
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								LEFT JOIN csapatok cs ON cs.Id = m.Hazai_csapat_id
								LEFT JOIN edzok e ON e.Csapat_id = cs.Id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";")));
					$Vedzo = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT e.Nev
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								LEFT JOIN csapatok cs ON cs.Id = m.Vendeg_csapat_id
								LEFT JOIN edzok e ON e.Csapat_id = cs.Id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";")));
					$VLiga = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT b.Nev
								FROM bajnoksagok b
								LEFT JOIN meccsek m ON m.Bajnoksag_id = b.Id
								LEFT JOIN meccs_egy_csapat_felol mecs ON mecs.Meccs_id = m.Id
								WHERE m.Id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";")));
					$HLiga = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT b.Nev
								FROM bajnoksagok b
								LEFT JOIN meccsek m ON m.Bajnoksag_id = b.Id
								LEFT JOIN meccs_egy_csapat_felol mecs ON mecs.Meccs_id = m.Id
								WHERE m.Id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";")));
					print
						'
						<!--Menüsor-->
						<div class="row menusor betumeret24">
							<div class="col-md-4 feherrahuzas">
								<a class="linkfekete" href="/vizsgamunka/Csapat.php?Csapat_neve='. $Hcsapnev .'"> '. $Csapat_neve = $Hcsapnev .'</a>
							</div>
							<div class="col-md-4 kozep">
								'.$Hazaigol.' &nbsp; &nbsp; : &nbsp; &nbsp; '.$Vendeggol.'
							</div>
							<div class="col-md-4 jobb feherrahuzas">
								<a class="linkfekete" href="/vizsgamunka/Csapat.php?Csapat_neve='. $Vcsapnev .'"> '. $Csapat_neve = $Vcsapnev .'</a>
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
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";"))).'
							</div>
							<div class="col-md-4 kozep">
								Liga helyezés
							</div>
							<div class="col-md-4 jobb">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT bcs.Helyezes
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								LEFT JOIN bajnoksagok_csapatok bcs ON bcs.Csapat_id = m.Vendeg_Csapat_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";"))).'
							</div>
						</div>
						<div class="row kiemeles">
							<div class="col-md-4">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Loves
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";"))).'
							</div>
							<div class="col-md-4 kozep">
								Lövések
							</div>
							<div class="col-md-4 jobb">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Loves
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";"))).'
							</div>
						</div>
						<!--Kapura lövések-->
						<div class="row kiemeles">
							<div class="col-md-4">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Kapura_loves
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";"))).'
							</div>
							<div class="col-md-4 kozep">
								Kapura lövések
							</div>
							<div class="col-md-4 jobb">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Kapura_loves
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";"))).'
							</div>
						</div>
						<!--Szögletek-->
						<div class="row kiemeles">
							<div class="col-md-4">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Szoglet
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";"))).'
							</div>
							<div class="col-md-4 kozep">
								Szöglet
							</div>
							<div class="col-md-4 jobb">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Szoglet
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";"))).'
							</div>
						</div>
						<!--Védések-->
						<div class="row kiemeles">
							<div class="col-md-4">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Vedesek
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";"))).'
							</div>
							<div class="col-md-4 kozep">
								Védések
							</div>
							<div class="col-md-4 jobb">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Vedesek
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";"))).'
							</div>
						</div>
						<!--Szabálytalanság-->
						<div class="row kiemeles">
							<div class="col-md-4">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Szabalytalansagok
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";"))).'
							</div>
							<div class="col-md-4 kozep">
								Szabálytalanság
							</div>
							<div class="col-md-4 jobb">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Szabalytalansagok
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";"))).'
							</div>
						</div>
						<!--Sárga lap-->
						<div class="row kiemeles">
							<div class="col-md-4">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Sarga_lap
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";"))).'
							</div>
							<div class="col-md-4 kozep">
								Sárga lap
							</div>
							<div class="col-md-4 jobb">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Sarga_lap
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";"))).'
							</div>
						</div>
						<!--Piros lap-->
						<div class="row kiemeles">
							<div class="col-md-4">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Piros_lap
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";"))).'
							</div>
							<div class="col-md-4 kozep">
								Piros lap
							</div>
							<div class="col-md-4 jobb">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Piros_lap
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";"))).'
							</div>
						</div>
						<!--Labda birtoklás-->
						<div class="row kiemeles">
							<div class="col-md-4">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Labda_birtoklas
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Hcsap.";"))).'
							</div>
							<div class="col-md-4 kozep">
								Labda birtoklás
							</div>
							<div class="col-md-4 jobb">
								'.implode(mysqli_fetch_row(mysqli_query($conn, "SELECT mecs.Labda_birtoklas
								FROM meccs_egy_csapat_felol mecs
								LEFT JOIN meccsek m ON m.Id = mecs.Meccs_id
								WHERE Meccs_id = ".$Meccs_id." AND mecs.Csapat_id = ".$Vcsap.";"))).'
							</div>
						</div>
					';
				?>
			</div>
		</div>
		<?php
			include("inc/labresz.php");
		?>
	</body>
</html>