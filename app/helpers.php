<?php
function terbilang($a){
		$bilangan = ['','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas'];

	// 1 - 11
		if($a < 12){
			$kalimat = $bilangan[$a];
		}
	// 12 - 19
		elseif($a < 20){
			$kalimat = $bilangan[$a-10].' Belas';
		}
	// 20 - 99
		elseif($a < 100){
			$utama = $a/10;
			$depan = substr($utama , 0,1);
			$belakang = $a%10;
			$kalimat = $bilangan[$depan].' Puluh '.$bilangan[$belakang];
		}
	// 100 - 199
		elseif($a < 200){
			$kalimat = 'Seratus '. terbilang($a - 100);
		}
	// 200 - 999
		elseif($a < 1000){
			$utama = $a/100;
			$depan = substr($utama ,0,1);
			$belakang = $a%100;
			$kalimat = $bilangan[$depan].' Ratus '.terbilang($belakang);
		}
	// 1,000 - 1,999
		elseif($a < 2000){
			$kalimat = 'Seribu '.terbilang($a - 1000);
		}
	// 2,000 - 9,999
		elseif($a < 10000){
			$utama = $a/1000;
			$depan = substr($utama, 0,1);
			$belakang = $a%1000;
			$kalimat = $bilangan[$depan].' Ribu '.terbilang($belakang);
		}
	// 10,000 - 99,999
		elseif($a < 100000){
			$utama = $a/100;
			$depan = substr($utama, 0,2);
			$belakang = $a%1000;
			$kalimat = terbilang($depan).' Ribu '.terbilang($belakang);
		}
	// 100,000 - 999,999
		elseif($a < 1000000){
			$utama = $a/1000;
			$depan = substr($utama,0,3);
			$belakang = $a%1000;
			$kalimat = terbilang($depan).' Ribu '.terbilang($belakang);
		}
	// 1,000,000 - 	99,999,999
		elseif($a < 100000000){
			$utama = $a/1000000;
			$depan = substr($utama,0,4);
			$belakang = $a%1000000;
			$kalimat = terbilang($depan).' Juta '.terbilang($belakang);
		}
		elseif($a < 1000000000){
			$utama = $a/1000000;
			$depan = substr($utama,0,4);
			$belakang = $a%1000000;
			$kalimat = terbilang($depan) . ' Juta '. terbilang($belakang);
		}
		elseif($a < 10000000000){
			$utama = $a/1000000000;
			$depan = substr($utama,0,1);
			$belakang = $a%1000000000;
			$kalimat = terbilang($depan) . ' Milyar '. terbilang($belakang);
		}
		elseif($a < 100000000000){
			$utama = $a/1000000000;
			$depan = substr($utama,0,2);
			$belakang = $a%1000000000;
			$kalimat = terbilang($depan) . ' Milyar '. terbilang($belakang);
		}
		elseif($a < 1000000000000){
			$utama = $a/1000000000;
			$depan = substr($utama,0,3);
			$belakang = $a%1000000000;
			$kalimat = terbilang($depan) . ' Milyar '. terbilang($belakang);
		}
		elseif($a < 10000000000000){
			$utama = $a/10000000000;
			$depan = substr($utama,0,1);
			$belakang = $a%10000000000;
			$kalimat = terbilang($depan) . ' Triliun '. terbilang($belakang);
		}
		elseif($a < 100000000000000){
			$utama = $a/1000000000000;
			$depan = substr($utama,0,2);
			$belakang = $a%1000000000000;
			$kalimat = terbilang($depan) . ' Triliun '. terbilang($belakang);
		}

		elseif($a < 1000000000000000){
			$utama = $a/1000000000000;
			$depan = substr($utama,0,3);
			$belakang = $a%1000000000000;
			$kalimat = terbilang($depan) . ' Triliun '. terbilang($belakang);
		}

		elseif($a < 10000000000000000){
			$utama = $a/1000000000000000;
			$depan = substr($utama,0,1);
			$belakang = $a%1000000000000000;
			$kalimat = terbilang($depan) . ' Kuadriliun '. terbilang($belakang);
		}

		$pisah = explode(' ', $kalimat);
		$full = [];
		for($i=0; $i < count($pisah); $i++){
			if($pisah[$i] != ""){
				array_push($full,$pisah[$i]);
			}
		}
		return join(' ',$full);
	}
	