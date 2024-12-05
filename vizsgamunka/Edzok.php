<?php
	require_once("adatbazis.php");
	
	$Edzo_neve = $_GET['Edzo_neve'];
	if($Edzo_neve == null || $Edzo_neve == "")
	{
		header("Location:Fooldal.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>	
	<head>
		<meta charset= "utf-8">
		<title> <?php print $Edzo_neve; ?> </title>
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/bootstrap.css">
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/osszes.css">
	</head>
	<body>
		<?php
			include("inc/menu.php")
		?>
		<div class="container-fluid">
			<div class="row menusor betumeret18 felkover">
				<div class="col-md-3">
					<!--Edző neve-->
					Edző neve
				</div>
				<div class="col-md-3">
					<!---Aktuális csapatának a neve-->
					Aktuális csapatának a neve
				</div>
				<div class="col-md-1">
					<!--Életkor-->
					Életkor
				</div>
				<div class="col-md-2">
					<!--Nemzetiseg-->
					Nemzetiseg
				</div>
				<div class="col-md-1">
					<!--Értékelése-->
					Értékelése
				</div>
				<div class="col-md-2">
					<!--Legnagyobb sikere-->
					Legnagyobb sikere
				</div>
			</div>
			<?php
				$adatok = mysqli_query($conn, "SELECT edzok.Eletkor EEletkor
													, edzok.Nemzetiseg ENemzetiseg
													, cs.Nev CsNev
													, edzok.Ertekeles EErtekeles
													, edzok.Legnagyobb_siker ELegnagyobb_siker
													FROM edzok
													LEFT JOIN csapatok cs ON cs.Id = edzok.Csapat_Id
													WHERE edzok.Nev = '".$Edzo_neve."';");
				foreach($adatok as $ered) {	
					print '
							<div class="row betumeret16 vilagoskekhatter">
								<div class="col-md-3">
									<!--Neve-->
									'.$Edzo_neve.'
								</div>
								<div class="col-md-3 szurkerahuzas">
									<!---Aktuális csapatának a neve-->
									<a class="linkfekete" href="/vizsgamunka/Csapat.php?Csapat_neve='. $ered["CsNev"] .'"> '. $Csapat_neve = $ered["CsNev"] .'</a>
								</div>
								<div class="col-md-1">
									<!--Életkor-->
									'. $ered["EEletkor"] .'
								</div>					
								<div class="col-md-2">
									<!--Nemzetiség-->
									'. $ered["ENemzetiseg"] .'
								</div>				
								<div class="col-md-1">
									<!--Értékelése-->
									'. $ered["EErtekeles"] .'
								</div>
								<div class="col-md-2">
									<!--Legnagyobb siker-->
									'. $ered["ELegnagyobb_siker"] .'
								</div>
							</div>
							';						
							}
			?>
		</div>
		<div class="magyarvalogatotthatterkep kepekhez">
			<div class="container-fluid feherhatter oldalkitoltese">
				<div class="row betumeret24 menusor kozep felkover">
					<div class="col-md-12">
						Edző élete
					</div>
				</div>
				<?php
					$Tortenete = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT Elet_tortenete
																				FROM edzok
																				WHERE edzok.Nev = '".$Edzo_neve."';")));
					print '
						<div class="row betumeret16 kozep">
							<div class="col-md-12 soronkent">
								'.$Tortenete.'
							</div>
						</div>';
					?>
			</div>
		</div>
		<?php
			include("inc/labresz.php")
		?>
	</body>
</html>