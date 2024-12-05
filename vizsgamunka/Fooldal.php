<?php
	require_once("adatbazis.php");
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!--A játékos nevét, majd függvénnyel add meg!!!-->
		<title> Főoldal </title>
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/bootstrap.css">
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/osszes.css">
	</head>
	<body>
		<?php
			include("inc/menu.php");
		?>
		<div class="container-fluid">
			<div class="row menusor betumeret24 felkover">
				<div class="col-md-4">
					Liga neve
				</div>
				<div class="col-md-4 kozep">
					Nemzetisége
				</div>
				<div class="col-md-4 jobb">
					Nehézség
				</div>
			</div>
		</div>
		<div class="magyarvalogatotthatterkep kepekhez">
			<div class="container-fluid oldalkitoltese feherhatter">
			<?php
			$bajnoksagok = mysqli_query($conn, "SELECT * FROM bajnoksagok;");
			foreach($bajnoksagok as $ered){
				print '
					<div class="row kiemeles bajnoksagok betumeret24">
						<div class="col-md-4 feherrahuzas">
							<a class="linkfekete" href="/vizsgamunka/Bajnoksag.php?Bajnoksag_neve='. $ered["Nev"] .'"> '. $Bajnoksag_neve = $ered["Nev"] .'</a>
						</div>
						<div class="col-md-4 kozep">
							'.$ered["Nacionalitas"].'
						</div>
						<div class="col-md-4 jobb">
							'.$ered["Nehezseg"].'
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
