<?php
	require_once("../../adatbazis.php");
	require_once("../session.php");


//Bajnokság rögzítés kezdete
	
	
	if(isset($_POST["Uj_bajnoksag_neve"]) && isset($_POST["Uj_bajnoksag_nemzetisege"]) && isset($_POST["Uj_bajnoksag_nehezsege"]) && isset($_POST["Leiras"])) {
		$Uj_bajnoksag_neve = mysqli_real_escape_string($conn, $_POST["Uj_bajnoksag_neve"]);
		$Uj_bajnoksag_nemzetisege = mysqli_real_escape_string($conn, $_POST["Uj_bajnoksag_nemzetisege"]);
		$Uj_bajnoksag_nehezsege = mysqli_real_escape_string($conn, $_POST["Uj_bajnoksag_nehezsege"]);
		$Leiras = mysqli_real_escape_string($conn, $_POST["Leiras"]);
		if($Uj_bajnoksag_neve != "" && $Uj_bajnoksag_nemzetisege != "" && $Uj_bajnoksag_nehezsege != "") {
			$vane = mysqli_query($conn,"
			SELECT Id FROM bajnoksagok WHERE Nev='". $Uj_bajnoksag_neve ."';
			");
		
			if(mysqli_num_rows($vane) == 0) {
				mysqli_query($conn, "INSERT INTO bajnoksagok(Nev, Nacionalitas, Nehezseg, Leiras)
									VALUES('".$Uj_bajnoksag_neve."', '".$Uj_bajnoksag_nemzetisege."', ".$Uj_bajnoksag_nehezsege.", '".$Leiras."');");
			} else {
				print "Ilyen bajnokság már létezik!";
			} 
		} else {
			print "Minden mezőt ki kell töltened!";
		}
	}
	
//Bajnokság rögzítés vége
//Csapat rögzítés eleje

	if(isset($_POST["Cs_nev"]) && isset($_POST["Cs_gyorsasag"]) && isset($_POST["Cs_vedekezes"]) && isset($_POST["Cs_kozeppalya"]) && isset($_POST["Cs_tamadas"]) && isset($_POST["Cs_moralitas"]) && isset($_POST["Cs_forma"])) {
		$Nev = mysqli_real_escape_string($conn, $_POST["Cs_nev"]);
		$Gyorsasag = mysqli_real_escape_string($conn, $_POST["Cs_gyorsasag"]);
		$Vedekezes = mysqli_real_escape_string($conn, $_POST["Cs_vedekezes"]);
		$Kozeppalya = mysqli_real_escape_string($conn, $_POST["Cs_kozeppalya"]);
		$Tamadas = mysqli_real_escape_string($conn, $_POST["Cs_tamadas"]);
		$Moralitas = mysqli_real_escape_string($conn, $_POST["Cs_moralitas"]);
		$Forma = mysqli_real_escape_string($conn, $_POST["Cs_forma"]);
		if($Nev != "" && $Gyorsasag != "" && $Vedekezes != "" && $Kozeppalya != "" && $Tamadas != "" && $Moralitas != "" && $Forma != "") {
			$vane = mysqli_query($conn,"
			SELECT Id FROM csapatok WHERE Nev='".$Nev."';
			");
		
			if(mysqli_num_rows($vane) == 0) {
				mysqli_query($conn, "INSERT INTO csapatok(Nev, Gyorsasag, Vedekezes, Kozeppalya, Tamadas, Moralitas, Forma)
									VALUES('".$Nev."', ".$Gyorsasag.", ".$Vedekezes.", ".$Kozeppalya.", ".$Tamadas.", 
									".$Moralitas.", ".$Forma.");");
			} else {
				mysqli_query($conn, "UPDATE csapatok 
									SET Gyorsasag = ".$Gyorsasag.", Vedekezes = ".$Vedekezes.", Kozeppalya = ".$Kozeppalya.", Tamadas = ".$Tamadas.",
									Moralitas = ".$Moralitas.", Forma = ".$Forma." 
									WHERE Nev = '".$Nev."';");
			} 
		} else {
			print "Minden mezőt ki kell töltened!";
		}
	}

//Csapat rögzítés vége
//Csapat bajnoksághöz kötésének eleje
	if(isset($_POST["Cs_Csapat_id"]) && isset($_POST["Cs_Bajnoksag_id"]) /*&& isset($_POST["Bcs_submit"])*/) {
		$Csapat_id = mysqli_real_escape_string($conn, $_POST["Cs_Csapat_id"]);
		$Bajnoksag_id = mysqli_real_escape_string($conn, $_POST["Cs_Bajnoksag_id"]);
		$vane = mysqli_query($conn, "SELECT csapat_id
									FROM bajnoksagok_csapatok
									WHERE csapat_id = ".$Csapat_id.";");
									
		if(mysqli_num_rows($vane) == 0) {
				mysqli_query($conn, "INSERT INTO bajnoksagok_csapatok(bajnoksag_id,  csapat_id)
									VALUES(".$Bajnoksag_id.", ".$Csapat_id.");");
		} else {
			print "Ez a csapat már bajnoksághoz van kötve.";
	}
	}
//Csapat bajnoksághöz kötésének vége
//Meccs rögzítés eleje
	
	if(isset($_POST["Hazai_id"]) && isset($_POST["Vendeg_id"]) && isset($_POST["Bajnoksag_id"]) && isset($_POST["Hazai_golok"]) && 
	isset($_POST["Vendeg_golok"]) && isset($_POST["Datum"])){
		$Hazai_id = mysqli_real_escape_string($conn, $_POST["Hazai_id"]);
		$Vendeg_id = mysqli_real_escape_string($conn, $_POST["Vendeg_id"]);
		$Bajnoksag_id = mysqli_real_escape_string($conn, $_POST["Bajnoksag_id"]);
		$Datum = mysqli_real_escape_string($conn, $_POST['Datum']);
		$Hazai_golok = mysqli_real_escape_string($conn, $_POST['Hazai_golok']);
		$Vendeg_golok = mysqli_real_escape_string($conn, $_POST['Vendeg_golok']);
		


		
		
		if($Hazai_id != $Vendeg_id) {
			$vane = mysqli_query($conn, "SELECT m.Id
										FROM meccsek m
										LEFT JOIN csapatok hcs ON hcs.Id = m.Hazai_csapat_id
										LEFT JOIN csapatok vcs ON vcs.Id = m.Vendeg_csapat_goljai
										LEFT JOIN bajnoksagok b ON b.Id = m.Bajnoksag_Id
										WHERE m.Hazai_csapat_id = ".$Hazai_id." AND m.Vendeg_csapat_id = ".$Vendeg_id." AND b.Id = ".$Bajnoksag_id.";");
			if(mysqli_num_rows($vane) == 0) {
				mysqli_query($conn, "INSERT INTO meccsek(Bajnoksag_Id, Datum, Hazai_csapat_id, Hazai_csapat_goljai, Vendeg_csapat_goljai, Vendeg_csapat_id)
				VALUES(".$Bajnoksag_id.", '".$Datum."', ".$Hazai_id.", ".$Hazai_golok.", ".$Vendeg_golok.", ".$Vendeg_id.");");
			} else {
				print "Ez a meccs már fel van véve.";
			}
		}
		else{
			print "A csapatok nem mérkőzhetnek saját maguk ellen!";
		}
		
	}
	
	
	if(isset($_POST['Meccs_id'])){
		$Meccs_id = mysqli_real_escape_string($conn, $_POST["Meccs_id"]);
		if($Meccs_id != ""){
			$csap = mysqli_fetch_array(mysqli_query($conn, "SELECT vcsap.nev vnev, hcsap.nev hnev
	FROM meccsek meccs
	LEFT JOIN csapatok hcsap on hcsap.id = meccs.Hazai_csapat_id
	LEFT JOIN csapatok vcsap on vcsap.id = meccs.Vendeg_csapat_id 
	WHERE meccs.Id = ".$Meccs_id.";"));
			print $csap[0].";".$csap[1];
		}
		else{
			
		}
	}
	
//Meccs rögzítés vége	
//Meccs adat rögzítés eleje	
	
	if(isset($_POST['Meccs']) && isset($_POST['Csapat']) && isset($_POST['Loves']) && isset($_POST['Kapura_loves']) && isset($_POST['Szoglet'])&& isset($_POST['Sarga_lap'])&& isset($_POST['Piros_lap'])&& isset($_POST['Labda_birtoklas']) && isset($_POST['Szabalytalansagok']) && isset($_POST['Vedesek'])) {
		$Meccs = mysqli_real_escape_string($conn, $_POST['Meccs']);
		$Csapat = mysqli_real_escape_string($conn, $_POST['Csapat']);
		$Loves = mysqli_real_escape_string($conn, $_POST['Loves']);
		$Kapura_loves = mysqli_real_escape_string($conn, $_POST['Kapura_loves']);
		$Szoglet = mysqli_real_escape_string($conn, $_POST['Szoglet']);
		$Sarga_lap = mysqli_real_escape_string($conn, $_POST['Sarga_lap']);
		$Piros_lap = mysqli_real_escape_string($conn, $_POST['Piros_lap']);
		$Labda_birtoklas = mysqli_real_escape_string($conn, $_POST['Labda_birtoklas']);
		$Szabalytalansagok = mysqli_real_escape_string($conn, $_POST['Szabalytalansagok']);
		$Vedesek = mysqli_real_escape_string($conn, $_POST['Vedesek']);
		if($Meccs != "" && $Loves != "" && $Kapura_loves != "" && $Szoglet != "" && $Sarga_lap != "" && $Piros_lap != "" && $Labda_birtoklas != "" && $Szabalytalansagok != "" && $Vedesek != "") {
			$Csapat_id = implode(mysqli_fetch_row(mysqli_query($conn, "SELECT id FROM csapatok WHERE nev='".$Csapat."';")));
			$vane = mysqli_query($conn,"SELECT Id FROM meccs_egy_csapat_felol WHERE Meccs_id=".$Meccs." AND Csapat_id =".$Csapat_id.";");
			if(mysqli_num_rows($vane) == 0) {
			
				mysqli_query($conn, "INSERT INTO meccs_egy_csapat_felol(
										Meccs_id,
										Csapat_Id,
										Loves,
										Kapura_loves,
										Szoglet,
										Sarga_lap,
										Piros_lap,
										Labda_birtoklas,
										Szabalytalansagok,
										Vedesek
										) 
										VALUES(
										".$Meccs.",
										".$Csapat_id.",
										".$Loves.",
										".$Kapura_loves.",
										".$Szoglet.",
										".$Sarga_lap.",
										".$Piros_lap.",
										".$Labda_birtoklas.",
										".$Szabalytalansagok.",
										".$Vedesek."
										);");									
			}	else {
				print"Ez a meccs már fel van véve!";
			} 
		} else {
			print "Minden mezőt ki kell töltened!";
		}
	}
	
//Meccs adat rögzítés vége	
//Játékos rögzítés eleje
	if(isset($_POST["J_Nev"]) && 
	isset($_POST["J_Csapat"]) && 
	isset($_POST["J_Bajnoksag"]) && 
	isset($_POST["J_Poszt"]) && 
	isset($_POST["J_Eletkor"]) && 
	isset($_POST["J_Magassag"]) &&
	isset($_POST["J_Suly"]) &&
	isset($_POST["J_Meccs"]) && 
	isset($_POST["J_Gol"]) && 
	isset($_POST["J_Golpassz"]) && 
	isset($_POST["J_Beadas"]) &&
	isset($_POST["J_Sikeres_beadas"]) && 
	isset($_POST["J_Nemzetiseg"]) &&
	isset($_POST["J_Ertek"]) && 
	isset($_POST["J_Fizetes"]) &&
	isset($_POST["J_Serules"]) && 
	isset($_POST["J_Atigazolas"])) {
		$Nev = mysqli_real_escape_string($conn, $_POST["J_Nev"]);
		$Csapat = mysqli_real_escape_string($conn, $_POST["J_Csapat"]);
		$Bajnoksag = mysqli_real_escape_string($conn, $_POST["J_Bajnoksag"]);
		$Poszt = mysqli_real_escape_string($conn, $_POST["J_Poszt"]);
		$Eletkor = mysqli_real_escape_string($conn, $_POST["J_Eletkor"]);
		$Magassag = mysqli_real_escape_string($conn, $_POST["J_Magassag"]);
		$Suly = mysqli_real_escape_string($conn, $_POST["J_Suly"]);
		$Meccs = mysqli_real_escape_string($conn, $_POST["J_Meccs"]);
		$Gol = mysqli_real_escape_string($conn, $_POST["J_Gol"]);
		$Golpassz = mysqli_real_escape_string($conn, $_POST["J_Golpassz"]);
		$Beadas =mysqli_real_escape_string($conn, $_POST["J_Beadas"]);
		$Sikeres_beadas = mysqli_real_escape_string($conn, $_POST["J_Sikeres_beadas"]);
		$Nemzetiseg = mysqli_real_escape_string($conn, $_POST["J_Nemzetiseg"]);
		$Ertek =mysqli_real_escape_string($conn, $_POST["J_Ertek"]);
		$Fizetes = mysqli_real_escape_string($conn, $_POST["J_Fizetes"]);
		$Serules = mysqli_real_escape_string($conn, $_POST["J_Serules"]);
		$Atigazolas = mysqli_real_escape_string($conn, $_POST["J_Atigazolas"]);
		if($Nev != "" && $Csapat != "" && $Bajnoksag != "" &&
		$Poszt != "" && $Eletkor != "" && $Magassag != "" && 
		$Suly != "" && $Meccs != "" && $Gol != "" &&
		$Golpassz != "" && 
		$Beadas != "" && $Sikeres_beadas != "" && $Nemzetiseg != "" && 
		$Ertek != "" && $Fizetes != "" && $Serules != "" && $Atigazolas != "") {
			$vane = mysqli_query($conn,
			"SELECT Id FROM jatekos WHERE Nev='".$Nev."';");
			
			if(mysqli_num_rows($vane) == 0) {
				mysqli_query($conn, "INSERT INTO jatekos(Csapat_id, Poszt_id, Nev, Bajnoksag_id, Eletkor, Magassag, Suly,
														Meccs, Gol, Golpassz, Beadas, Sikeres_beadas, 
														Nemzetiseg, Ertek, Fizetes, Serulesek, Atigazolas)
									VALUES(".$Csapat.", ".$Poszt.", '".$Nev."', ".$Bajnoksag.", 
									".$Eletkor.", ".$Magassag.", ".$Suly.", ".$Meccs.", ".$Gol.",
									".$Golpassz.", ".$Beadas.",
									".$Sikeres_beadas.", '".$Nemzetiseg."', ".$Ertek.", ".$Fizetes.",
									".$Serules.", ".$Atigazolas.");");
			} else {
				print "A játékos adatai frissítve";
				mysqli_query($conn, "UPDATE jatekos SET Csapat_id = ".$Csapat.", Poszt_id = ".$Poszt.",
				Bajnoksaksag_id = ".$Bajnoksag." ,Eletkor = ".$Eletkor.", Magassag = ".$Magassag.", Suly = ".$Suly.", 
				Meccs = ".$Meccs.", Gol = ".$Gol.", Golpassz = ".$Golpassz.", 
				Beadas = ".$Beadas.", Sikeres_beadas = ".$Sikeres_beadas.", 
				Nemzetiseg = '".$Nemzetiseg."', Ertek = ".$Ertek.", Fizetes = ".$Fizetes.", Serulesek = ".$Serules.", 
				Atigazolas = ".$Atigazolas." WHERE Nev = '".$Nev."';");
			} 
		} else {
			print "Minden mezőt ki kell töltened!";
		}
	}

//Játékos rögzítés vége
//Játékos értékelés rögzítés eleje

	/*print_r($_POST);*/
	if(isset($_POST["Je_Jatekos"]) && 
	isset($_POST["Je_Ertekeles"]) && 
	isset($_POST["Je_Felszabaditas"]) && 
	isset($_POST["Je_Gyorsasag"]) && 
	isset($_POST["Je_Allo_kepesseg"]) && 
	isset($_POST["Je_Passz_pontossag"]) && 
	isset($_POST["Je_Loves_pontossag"]) && 
	isset($_POST["Je_Lovo_ero"]) &&
	isset($_POST["Je_Jatekos_beadas"]) &&
	isset($_POST["Je_Cselezes"]) && 
	isset($_POST["Je_Helyezkedes"]) &&
	isset($_POST["Je_Fejeles"]) && 
	isset($_POST["Je_Fizikum"]) &&
	isset($_POST["Je_Szereles"])) {
		$Jatekos = mysqli_real_escape_string($conn, $_POST["Je_Jatekos"]);
		$Ertekeles = mysqli_real_escape_string($conn, $_POST["Je_Ertekeles"]);
		$Felszabaditas = mysqli_real_escape_string($conn, $_POST["Je_Felszabaditas"]);
		$Gyorsasag = mysqli_real_escape_string($conn, $_POST["Je_Gyorsasag"]);
		$Allo_kepesseg = mysqli_real_escape_string($conn, $_POST["Je_Allo_kepesseg"]);
		$Passz_pontossag = mysqli_real_escape_string($conn, $_POST["Je_Passz_pontossag"]);
		$Loves_pontossag = mysqli_real_escape_string($conn, $_POST["Je_Loves_pontossag"]);
		$Lovo_ero = mysqli_real_escape_string($conn, $_POST["Je_Lovo_ero"]);
		$Beadas = mysqli_real_escape_string($conn, $_POST["Je_Jatekos_beadas"]);
		$Cselezes = mysqli_real_escape_string($conn, $_POST["Je_Cselezes"]);
		$Helyezkedes = mysqli_real_escape_string($conn, $_POST["Je_Helyezkedes"]);
		$Fejeles = mysqli_real_escape_string($conn, $_POST["Je_Fejeles"]);
		$Fizikum = mysqli_real_escape_string($conn, $_POST["Je_Fizikum"]);
		$Szereles = mysqli_real_escape_string($conn, $_POST["Je_Szereles"]);
		if($Felszabaditas != "" && $Gyorsasag != "" && $Allo_kepesseg != "" &&
		$Passz_pontossag != "" && $Loves_pontossag != "" && $Lovo_ero != "" && 
		$Beadas != "" && $Cselezes != "" && $Helyezkedes != "" && $Fejeles != "" &&
		$Fizikum != "" && $Szereles != "") {
			$vane = mysqli_query($conn,
			"SELECT Id FROM jatekos_ertekelese WHERE Jatekos_id=".$Jatekos.";");
			
			if(mysqli_num_rows($vane) == 0) {
				mysqli_query($conn, "INSERT INTO jatekos_ertekelese(Jatekos_id, Ertekeles, Felszabaditas, Gyorsasag, Allo_kepesseg, Passz_pontossag, 
									Loves_pontossag, Lovo_ero, Beadas, Cselezes, Helyezkedes, Fejeles, Fizikum, Szereles)
									VALUES(".$Jatekos.", ".$Ertekeles.", ".$Felszabaditas.", ".$Gyorsasag.", ".$Allo_kepesseg.", ".$Passz_pontossag.",
									".$Loves_pontossag.", ".$Lovo_ero.", ".$Beadas.", ".$Cselezes.", ".$Helyezkedes.", ".$Fejeles.", ".$Fizikum.", ".$Szereles.");");
			} else {
				mysqli_query($conn, "UPDATE jatekos_ertekelese SET Jatekos_id = ".$Jatekos.", Felszabaditas = ".$Felszabaditas.",
				Gyorsasag = ".$Gyorsasag.", Allo_kepesseg = ".$Allo_kepesseg.", Passz_pontossag = ".$Passz_pontossag.", 
				Loves_pontossag = ".$Loves_pontossag.", Lovo_ero = ".$Lovo_ero.", Beadas = ".$Beadas.", Cselezes = ".$Cselezes.", 
				Helyezkedes = ".$Helyezkedes.", Fejeles = ".$Fejeles.", Fizikum = ".$Fizikum.", Szereles = ".$Szereles.", 
				WHERE Jatekos_id = ".$Jatekos.";");
			} 
		} else {
			print "Minden mezőt ki kell töltened!" ;
		}
	}

//Játékos értékelés rögzítés vége
//Edző rögzítés eleje

	if(isset($_POST["Edzo_nev"]) && 
	isset($_POST["Edzo_csapat"]) && 
	isset($_POST["Edzo_eletkor"]) && 
	isset($_POST["Edzo_nemzetiseg"]) && 
	isset($_POST["Edzo_ertekeles"]) && 
	isset($_POST["Edzo_legnagyobb_siker"]) &&
	isset($_POST["Edzo_elet_tortenete"])) {
		$Edzo_nev = 
		mysqli_real_escape_string($conn, $_POST["Edzo_nev"]);
		$Edzo_eletkor = 
		mysqli_real_escape_string($conn, $_POST["Edzo_eletkor"]);
		$Edzo_nemzetiseg = 
		mysqli_real_escape_string($conn, $_POST["Edzo_nemzetiseg"]);
		$Edzo_ertekeles = 
		mysqli_real_escape_string($conn, $_POST["Edzo_ertekeles"]);
		$Legnagyobb_siker = 
		mysqli_real_escape_string($conn, $_POST["Edzo_legnagyobb_siker"]);
		$Edzo_csapat = 
		mysqli_real_escape_string($conn, $_POST["Edzo_csapat"]);
		$Edzo_elet_tortenete =
		mysqli_real_escape_string($conn, $_POST["Edzo_elet_tortenete"]);
		if($Edzo_nev != "" && $Edzo_eletkor != "" && $Edzo_nemzetiseg != "" &&
		$Edzo_ertekeles != "" && $Legnagyobb_siker != "" && $Edzo_csapat != "") {
			$vane = mysqli_query($conn,
			"SELECT Id FROM edzok WHERE Nev='".$Edzo_nev."';");
			if(mysqli_num_rows($vane) == 0) {
				mysqli_query($conn, "INSERT INTO edzok(Csapat_Id, Nev, Eletkor, Nemzetiseg, Ertekeles, Legnagyobb_siker, Elet_tortenete)
									VALUES(".$Edzo_csapat.", '".$Edzo_nev."', ".$Edzo_eletkor.", '".$Edzo_nemzetiseg."', ".$Edzo_ertekeles.", '".$Legnagyobb_siker."', '".$Edzo_elet_tortenete."');");
			} else {
				mysqli_query($conn, "UPDATE edzok SET Csapat_Id = ".$Edzo_csapat.", Nev = '".$Edzo_nev."',
				Eletkor = ".$Edzo_eletkor.", Nemzetiseg = '".$Edzo_nemzetiseg."', Ertekeles = ".$Edzo_ertekeles.", 
				Legnagyobb_siker = ".$Legnagyobb_siker.", Elet_tortenete = '".$Edzo_elet_tortenete."';");
			} 
		} else {
			print "Minden mezőt ki kell töltened!";
		}
	}

//Edző rögzítés vége
//Poszt rögzítés eleje

	if(isset($_POST["P_nev"])) {
		$Poszt_nev = 
		mysqli_real_escape_string($conn, $_POST["P_nev"]);
		if($Poszt_nev != "") {
			$vane = mysqli_query($conn,
			"SELECT Id FROM poszt WHERE Nev='".$Poszt_nev."';");
			if(mysqli_num_rows($vane) == 0) {
				mysqli_query($conn, "INSERT INTO poszt(Nev)
									VALUES('".$Poszt_nev."');");
			} else {
				mysqli_query($conn, "UPDATE poszt Nev = '".$Poszt_nev."',;");
			} 
		} else {
			print "Minden mezőt ki kell töltened!";
		}
	}

//Poszt rögzítés vége
?>