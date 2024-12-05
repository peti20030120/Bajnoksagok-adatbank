<?php 
	require_once("../adatbazis.php");
	$bajnoksagok = mysqli_query($conn, "SELECT * FROM bajnoksagok;");
	$csapatok = mysqli_query($conn,"SELECT * FROM csapatok;");
	$poszt = mysqli_query($conn,"SELECT * FROM poszt;");
	$meccsek = mysqli_query($conn, "SELECT vcsap.nev vnev, meccs.Hazai_csapat_goljai hgol, meccs.Vendeg_csapat_goljai vgol, hcsap.nev hnev, baj.Nev bnev, meccs.Datum, meccs.Id
FROM meccsek meccs
LEFT JOIN csapatok hcsap on hcsap.id = meccs.Hazai_csapat_id
LEFT JOIN csapatok vcsap on vcsap.id = meccs.Vendeg_csapat_id 
LEFT JOIN bajnoksagok baj ON baj.Id = meccs.Bajnoksag_Id;");
	$jatekosok = mysqli_query($conn, "SELECT Id, Nev FROM jatekos;");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Admin felület </title>
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/bootstrap.css">
		<link rel="Stylesheet" type="text/css" href="/vizsgamunka/css/osszes.css">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="magyarvalogatotthatterkep">
			<div class="container-fluid feherhatter oldalkitoltese">
			
				<!--Bajnokság rögzítés eleje-->
				<div class="kozep felkover betumeret24">
					Bajnokság rögzítés
				</div>
				
				<form id="Uj_bajnoksag" action="/ajax/csapat_fel.php" method="post">
					<input type="text" placeholder="Új bajnokság neve" id="Uj_bajnoksag_neve" name="Uj_bajnoksag_neve"/>
					<input type="text" placeholder="Új bajnokság nemzetisége" id="Uj_bajnoksag_nemzetisege" name="Uj_bajnoksag_nemzetisege"/>
					<input type="number" placeholder="Nehézség" id="Uj_bajnoksag_nehezsege" name="Uj_bajnoksag_nehezsege"/>
					<textarea rows="10" type="text" placeholder="Leírás" id="Leiras" name="Leiras"> </textarea>
					<input type="submit" name="submit" value="Feltöltés" id="Bajnoksag_gomb">
				</form> 
				
				</br>
				</br>
				<!--Bajnokság rögzítés vége-->
				
				<!--Csapat rögzítés eleje-->
				<div class="kozep felkover betumeret24">
					Csapat rögzítés
				</div>
				<form id="Csapat" action="/ajax/csapat_fel.php" method="post">
					<input type="text" placeholder="Név" id="Nev" name="Cs_nev"/>
					<input type="number" placeholder="Gyorsaság" id="Cs_gyorsasag" name="Cs_gyorsasag"/>
					<input type="number" placeholder="Védekezés" id="Cs_vedekezes" name="Cs_vedekezes"/>
					<input type="number" placeholder="Középpálya" id="Cs_kozeppalya" name="Cs_kozeppalya"/>
					<input type="number" placeholder="Támadás" id="Cs_tamadas" name="Cs_tamadas"/>
					<input type="number" placeholder="Moralitás" id="Cs_moralitas" name="Cs_moralitas"/>
					<input type="number" placeholder="Forma" id="Cs_forma" name="Cs_forma"/>
					<input type="submit" name="Cs_submit" value="Feltöltés" id="Csapat_gomb"/>
				</form>
				<!--Csapat rögzítés vége-->
				
				</br>
				</br>
				
				<!--Csapat bajnoksághoz kötés eleje-->
				<div class="kozep felkover betumeret24">
					Kösd bajnoksághoz a csapatot
				</div>
				<form id="bcs_kotes" action="/ajax/csapat_fel.php" method="post">
					<select name="Cs_Csapat_id">
					<option hidden value="">Válassz egy csapatot</option>
						<?php
							foreach($csapatok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<select name="Cs_Bajnoksag_id">
						<option hidden value="">Válassz egy bajnokságot</option>
						<?php
							foreach($bajnoksagok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<input type="submit" name="Bcs_submit" value="Feltöltés" id="Bcs_gomb">
				</form>
				<!--Csapat bajnoksághoz kötés vége-->
				
				</br>
				</br>
				
				<!--Meccs rögzítés eleje-->
				<div class="kozep felkover betumeret24">
					Meccs rögzítés
				</div>
				<form id="Meccs_2" action="/ajax/csapat_fel" method="post">
					<select name="Hazai_id">
					<option hidden value="">Válassz egy csapatot</option>
						<?php
							foreach($csapatok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<select name="Vendeg_id">
					<option hidden value="">Válassz egy csapatot</option>
						<?php
							foreach($csapatok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<select name="Bajnoksag_id">
						<option hidden value="">Válassz egy bajnokságot</option>
						<?php
							foreach($bajnoksagok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<input type="date" placeholder="Dátum" id="Datum" name="Datum"/>
					<input type="number" placeholder="Hazai gólok" id="Hazai_golok" name="Hazai_golok"/>
					<input type="number" placeholder="Vendég gólok" id="Vendeg_golok" name="Vendeg_golok"/>
					<input type="submit" name="submit" value="Feltöltés" id="Meccs_2_gomb">
				</form>
				<!--Meccs rögzítés vége-->
				</br>
				</br>
				<!--Meccs adat rögzítés eleje-->
				<div class="kozep felkover betumeret24">
					Meccs adat rögzítés
				</div>
				<form id="Meccs" action="/ajax/csapat_fel.php" method="post">
					<select name="Meccs" id="ar_Meccs">
						<option hidden value="">Válassz egy meccset</option>
						<?php
							foreach($meccsek as $ered){
								// Katalán - 2020.02.02 Barcelona VS Real Madrid
								print "<option value='".$ered['Id']."'>".$ered['hnev']." ".$ered['hgol'].":".$ered['vgol']." ".$ered['vnev']." ".$ered['bnev']." ".$ered['Datum']." !".$ered['Id']."!</option>";
							}
						?>
					</select>
					<select id="ar_Csapat" name="Csapat">
						<option hidden value="">Válassz egy csapatot</option>
						
					</select>
					<input type="number" placeholder="Lövés" id="Loves" name="Loves"/>
					<input type="number" placeholder="Kapura lövés" id="Kapura_loves" name="Kapura_loves"/>
					<input type="number" placeholder="Szöglet" id="Szoglet" name="Szoglet"/>
					<input type="number" placeholder="Védések" id="Vedesek" name="Vedesek"/>
					<input type="number" placeholder="Szabálytalanságok" id="Szabalytalansagok" name="Szabalytalansagok"/>
					<input type="number" placeholder="Sárga lap" id="Sarga_lap" name="Sarga_lap"/>
					<input type="number" placeholder="Piros lap" id="Piros_lap" name="Piros_lap"/>
					<input type="number" placeholder="Labda birtoklás" id="Labda_birtoklas" name="Labda_birtoklas"/>
					<input type="submit" name="submit" value="Feltöltés" id="Meccs_gomb">
				</form>
				<!--Meccs adat rögzítés vége-->
				</br>
				</br>
				<div class="kozep felkover betumeret24">
					Játékos rögzítés
				</div>
				<!--Játékos rögzítés eleje-->
				<form id="Jatekos" action="/ajax/csapat_fel.php" method="post">
					<input type="text" placeholder="Név" id="JNev" name="J_Nev"/>
					<select name="J_Csapat">
					<option hidden value="">Válassz egy csapatot</option>
						<?php
							foreach($csapatok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<select name="J_Bajnoksag">
					<option hidden value="">Válassz egy bajnokságot</option>
						<?php
							foreach($bajnoksagok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<select name="J_Poszt">
						<option hidden value="">Válassz egy posztot</option>
						<?php
							foreach($poszt as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<input type="number" placeholder="Életkor" id="Eletkor" name="J_Eletkor"/>
					<input type="number" placeholder="Magasság" id="Magassag" name="J_Magassag"/>
					<input type="number" placeholder="Súly" id="Suly" name="J_Suly"/>
					<input type="number" placeholder="Meccs" id="J_Meccs" name="J_Meccs"/>
					<input type="number" placeholder="Gól" id="Gol" name="J_Gol"/>
					<input type="number" placeholder="Gólpassz" id="Golpassz" name="J_Golpassz"/>
					<input type="number" placeholder="Beadás" id="Beadas" name="J_Beadas"/>
					<input type="number" placeholder="Sikeres beadás" id="Sikeres_beadas" name="J_Sikeres_beadas"/>
					<input type="text" placeholder="Nemzetiség" id="Nemzetiseg" name="J_Nemzetiseg"/>
					<input type="number" placeholder="Érték" id="Ertek" name="J_Ertek"/>
					<input type="number" placeholder="Fizetés" id="Fizetes" name="J_Fizetes"/>
					<input type="number" placeholder="Sérülés" id="Serules" name="J_Serules"/>
					<input type="number" placeholder="Átigazolás" id="Atigazolas" name="J_Atigazolas"/>
					<input type="submit" name="J_submit" value="Feltöltés" id="Jatekos_gomb">
				</form>
				<!--Játékos rögzítés vége-->
				
				</br>
				</br>
				
				<!--Játékos értékelés rögzítés eleje-->
				<div class="kozep felkover betumeret24">
					Játékos értékelései
				</div>
				<form id="Jatekos_2" action="/ajax/csapat_fel.php" method="post">	
					<select name="Je_Jatekos">
						<option hidden value="">Válassz játékost</option>
						<?php
							foreach($jatekosok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<input type="number" placeholder="Értékelés" id="Ertekeles" name="Je_Ertekeles"/>
					<input type="number" placeholder="Felszabadítás" id="Felszabaditas" name="Je_Felszabaditas"/>
					<input type="number" placeholder="Gyorsaság" id="Gyorsasag" name="Je_Gyorsasag"/>
					<input type="number" placeholder="Álló képesség" id="Allo_kepesseg" name="Je_Allo_kepesseg"/>
					<input type="number" placeholder="Passz pontosság" id="Passz_pontossag" name="Je_Passz_pontossag"/>
					<input type="number" placeholder="Lövés pontosság" id="Loves_pontossag" name="Je_Loves_pontossag"/>
					<input type="number" placeholder="Lövő erő" id="Lovo_ero" name="Je_Lovo_ero"/>
					<input type="number" placeholder="Beadás" id="Jatekos_beadas" name="Je_Jatekos_beadas"/>
					<input type="number" placeholder="Cselezés" id="Cselezes" name="Je_Cselezes"/>
					<input type="number" placeholder="Helyezkedés" id="Helyezkedes" name="Je_Helyezkedes"/>
					<input type="number" placeholder="Fejelés" id="Fejeles" name="Je_Fejeles"/>
					<input type="number" placeholder="Fizikum" id="Fizikum" name="Je_Fizikum"/>
					<input type="number" placeholder="Szerelés" id="Szereles" name="Je_Szereles"/>
					<input type="submit" name="Je_submit" value="Feltöltés" id="Jatekos_gomb_2">
				</form>
				<!--Játékos értékelés rögzítés vége-->
				
				</br>
				</br>
				
				<div class="kozep felkover betumeret24">
					Edző rögzítés
				</div>
				<!--Edző rögzítés eleje-->
				<form id="Edzo" action="/ajax/csapat_fel.php" method="post">	
					<input type="text" placeholder="Név" id="Edzo_nev" name="Edzo_nev"/>
					<select name="Edzo_csapat">
						<option hidden value="">Válassz csapatot</option>
						<?php
							foreach($csapatok as $ered){
								print "<option value='".$ered['Id']."'>".$ered['Nev']."</option>";
							}
						?>
					</select>
					<input type="number" placeholder="Életkor" id="Edzo_eletkor" name="Edzo_eletkor"/>
					<input type="text" placeholder="Nemzetiség" id="Edzo_nemzetiseg" name="Edzo_nemzetiseg"/>
					<input type="number" placeholder="Értékelés" id="Edzo_ertekeles" name="Edzo_ertekeles"/>
					<input type="text" placeholder="Legnagyobb siker" id="Edzo_legnagyobb_siker" name="Edzo_legnagyobb_siker"/>
					<textarea rows="10" type="text" placeholder="Élet története" id="Edzo_elet_tortenete" name="Edzo_elet_tortenete"> </textarea>
					<input type="submit" name="submit" value="Feltöltés" id="Edzo_gomb">
				</form>
				<!--Edző rögzítés vége-->
				<!--Poszt rögzítés eleje-->
				<div class="kozep felkover betumeret24">
					Poszt rögzítés
				</div>
				<form id="Poszt" action="/ajax/csapat_fel.php" method="post">
					<input type="text" placeholder="Poszt" id="Poszt_nev" name="P_nev"/>
					<input type="submit" name="P_submit" value="Feltöltés" id="Poszt_gomb"/>
				</form>
				<!--Poszt rögzítés vége-->
				
			</div>	
		</div>
	</body>
	
	
	<script type="text/javascript">
		$(document).ready(function (e) {
			
			//Bajnokság rögzítés eleje
			
			$("#Uj_bajnoksag").on('submit',(function(e) {
				e.preventDefault();
				/*document.getElementById('Bajnoksag_gomb').disabled = true;*/
				$.ajax({
					url: '/vizsgamunka/admin/ajax/csapat_fel.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							
							if(data == "") {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres rögzítés!");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Bajnoksag_neve').value = "";
								document.getElementById('Bajnoksag_nemzetisege').value = "";
								document.getElementById('Bajnoksag_nehezsege').value = "";

							} else {
								//notification kiküldése a sikertelen feltöltésről
								alert(data);
							}
							document.getElementById('Bajnoksag_gomb').disabled = false;
						},
				});
			}));
			
			//Bajnokság rögzítés vége
			//Csapat rögzítés eleje
			
			$("#Csapat").on('submit',(function(e) {
				e.preventDefault();
				/*document.getElementById('Csapat_gomb').disabled = true;*/
				$.ajax({
					url: '/vizsgamunka/admin/ajax/csapat_fel.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							if(data == "") {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres rögzítés!");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Nev').value = "";
								document.getElementById('Cs_gyorsasag').value = "";
								document.getElementById('Cs_vedekezes').value = "";
								document.getElementById('Cs_kozeppalya').value = "";
								document.getElementById('Cs_tamadas').value = "";
								document.getElementById('Cs_moralitas').value = "";
								document.getElementById('Cs_forma').value = "";
							} else {
								//notification kiküldése a sikertelen feltöltésről
								alert(data);
							}
							document.getElementById('Csapat_gomb').disabled = false;
						},
				});
			}));
			
			//Csapat rögzítés vége
			//Csapat bajnoksághoz kötésének eleje
			
			$("#bcs_kotes").on('submit',(function(e) {
				e.preventDefault();
				/*document.getElementById('Bcs_gomb').disabled = true;*/
				$.ajax({
					url: '/vizsgamunka/admin/ajax/csapat_fel.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							if(data == "") {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres rögzítés!");
								//minden mező alaphelyzetbe állítása
							} else {
								//notification kiküldése a sikertelen feltöltésről
								alert(data);
							}
							document.getElementById('Bcs_gomb').disabled = false;
						},
				});
			}));
			
			//Csapat bajnoksághoz kötésének vége
			//Meccs rögzítés eleje
			
			$("#Meccs_2").on('submit',(function(e) {
				e.preventDefault();
				/*document.getElementById('Meccs_gomb').disabled = true;*/
				$.ajax({
					url: '/vizsgamunka/admin/ajax/csapat_fel.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							if(data == "") {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres rögzítés!");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Hazai_csapat').value = "";
								document.getElementById('Vendeg_csapat').value = "";
								document.getElementById('Datum').value = "";
								document.getElementById('Hazai_golok').value = "";
								document.getElementById('Vendeg_golok').value = "";
							} else {
								//notification kiküldése a sikertelen feltöltésről
								alert(data);
							}
							document.getElementById('Meccs_2_gomb').disabled = false;
						},
				});
			}));
			
			//Meccs rögzítés vége
			//Meccs adat rögzítés eleje
			
			$("#Meccs").on('submit',(function(e) {
				e.preventDefault();
				/*document.getElementById('Meccs_gomb').disabled = true;*/
				$.ajax({
					url: '/vizsgamunka/admin/ajax/csapat_fel.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							
							if(data == "") {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres rögzítés!");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Loves').value = "";
								document.getElementById('Kapura_loves').value = "";
								document.getElementById('Szoglet').value = "";
								document.getElementById('Vedesek').value = "";
								document.getElementById('Szabalytalansagok').value = "";
								document.getElementById('Sarga_lap').value = "";
								/*document.getElementById('Piros_lap').value = "";
								document.getElementById('Labda_birtoklas').value = "";*/

							} else {
								//notification kiküldése a sikertelen feltöltésről
								alert(data);
							}
							document.getElementById('Meccs_gomb').disabled = false;
						},
				});
			}));
			
			//Meccs adat rögzítés vége
			//Játékos rögzítés kezdete
			
			$("#Jatekos").on('submit',(function(e) {
				e.preventDefault();
				/*document.getElementById('Jatekos_gomb').disabled = true;*/
				$.ajax({
					url: '/vizsgamunka/admin/ajax/csapat_fel.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							
							if(data == "") {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres rögzítés!");
								//minden mező alaphelyzetbe állítása
								document.getElementById('JNev').value = "";
								document.getElementById('Eletkor').value = "";
								document.getElementById('Magassag').value = "";
								document.getElementById('Suly').value = "";
								document.getElementById('J_Meccs').value = "";
								document.getElementById('Gol').value = "";
								document.getElementById('Golpassz').value = "";
								document.getElementById('Beadas').value = "";
								document.getElementById('Sikeres_beadas').value = "";
								document.getElementById('Nemzetiseg').value = "";
								document.getElementById('Ertek').value = "";
								document.getElementById('Fizetes').value = "";
								document.getElementById('Serules').value = "";
								document.getElementById('Atigazolas').value = "";

							} else {
								//notification kiküldése a sikertelen feltöltésről
								alert(data);
							}
							document.getElementById('Jatekos_gomb').disabled = false;
						},
				});
			}));
			
			//Játékos rögzítés vége
			//Játékos értékelés rögzítés kezdete
			
			$("#Jatekos_2").on('submit',(function(e) {
				e.preventDefault();
				/*document.getElementById('Jatekos_gomb_2').disabled = true;*/
				$.ajax({
					url: '/vizsgamunka/admin/ajax/csapat_fel.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							
							if(data == "") {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres rögzítés!");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Ertekeles').value = "";
								document.getElementById('Felszabaditas').value = "";
								document.getElementById('Gyorsasag').value = "";
								document.getElementById('Allo_kepesseg').value = "";
								document.getElementById('Passz_pontossag').value = "";
								document.getElementById('Loves_pontossag').value = "";
								document.getElementById('Lovo_ero').value = "";
								document.getElementById('Jatekos_beadas').value = "";
								document.getElementById('Cselezes').value = "";
								document.getElementById('Helyezkedes').value = "";
								document.getElementById('Fejeles').value = "";
								document.getElementById('Fizikum').value = "";
								document.getElementById('Szereles').value = "";

							} else {
								//notification kiküldése a sikertelen feltöltésről
								alert(data);
							}
							document.getElementById('Jatekos_gomb_2').disabled = false;
						},
				});
			}));
			
			//Játékos értékelés rögzítés vége
			//Edző rögzítés eleje
			$("#Edzo").on('submit',(function(e) {
				e.preventDefault();
				/*document.getElementById('Edzo_gomb').disabled = true;*/
				$.ajax({
					url: '/vizsgamunka/admin/ajax/csapat_fel.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							if(data == "") {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres rögzítés!");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Edzo_nev').value = "";
								document.getElementById('Edzo_eletkor').value = "";
								document.getElementById('Edzo_ertekeles').value = "";
								document.getElementById('Edzo_nemzetiseg').value = "";
								document.getElementById('Edzo_legnagyobb_siker').value = "";
							} else {
								//notification kiküldése a sikertelen feltöltésről
								alert(data);
							}
							document.getElementById('Edzo_gomb').disabled = false;
						},
				});
			}));
			//Edző rögzítés vége
			//Poszt rögzítés eleje
			
			$("#Poszt").on('submit',(function(e) {
				e.preventDefault();
				document.getElementById('Poszt_gomb').disabled = true;
				$.ajax({
					url: '/vizsgamunka/admin/ajax/csapat_fel.php',
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
						{
							if(data == "") {
								//notification kiküldése a sikeres feltöltésről
								alert("Sikeres rögzítés!");
								//minden mező alaphelyzetbe állítása
								document.getElementById('Poszt_nev').value = "";
							} else {
								//notification kiküldése a sikertelen feltöltésről
								alert(data);
							}
							document.getElementById('Poszt_gomb').disabled = false;
						},
				});
			}));
			
			//Poszt rögzítés vége
			
			
			
			//Csapat megadás option mezőbe eleje
			
			document.getElementById('ar_Meccs').onchange = function (evt) {
				var e = document.getElementById("ar_Meccs").options[document.getElementById("ar_Meccs").selectedIndex].value;
				$.ajax({
						cache: false,
						url: '/vizsgamunka/admin/ajax/csapat_fel.php',
						type: 'POST',
						data: {Meccs_id:e},
						success: function(data){
							var newSelect = document.getElementById('ar_Csapat');
							//bekapcsolja az évadszám mezőt ha ki van kapcsolva mert alapértelmezetten ki van
							if(newSelect.disabled == true) {
								newSelect.disabled = false;
							}
							
							
							
							
							//tömbre darabolja a kapott adatot a ';' jelek mentén
							var adat = data.split(";");
							//ez takarítja ki a select részt hogy mindig csak firss adat legyen benne
							$('#ar_Csapat').find('option').remove().end();
							//ez tölti fel a select részt a friss adatokkal az ürítés után
							for(i = 0; i < adat.length; i++) {
								if(adat[i] != "") {
								   var opt = document.createElement("option");
								   opt.value= adat[i];
								   opt.innerHTML = adat[i];
								   newSelect.appendChild(opt);
								}
							}
							$("#ar_Csapat").trigger("change");
						}
					});
					
			}
			
			//Csapat megadás option mezőbe vége
			
			
			
			
		});
	</script>
</html>