<?php
	
	//formato de data Y-m-d
	function dateToDb($dateTime){
		if(!is_null($dateTime)){
			$dateTime = explode(' ', $dateTime);
			$date = $dateTime[0];
			$time = isset($dateTime[1]) ? $dateTime[1] : null;
			$dt = explode('/', $date);
			$dt = $dt[2].'-'.$dt[1].'-'.$dt[0];
			return trim($dt.' '.$time);
		}
		else{
			return null;
		}
	}

	//formato de data d/m/Y
	function dateFromDb($dateTime){
		if(!is_null($dateTime)){
			$dateTime = explode(' ', $dateTime);
			$date = $dateTime[0];
			$time = isset($dateTime[1]) ? $dateTime[1] : null;
			if(!is_null($date)){
				$dt = explode('-', $date);
				$dt = $dt[2].'/'.$dt[1].'/'.$dt[0];
				return trim($dt.' '.$time);
			}
		}
		return null;
	}

	function diffDate($dt1, $dt2, $type='', $sep='-'){
		
		$partes = explode('-', $dt1);
		$date1 = mktime(0, 0, 0, $partes[1], $partes[2], $partes[0]);

		$partes = explode('-', $dt2);
		$date2 = mktime(0, 0, 0, $partes[1], $partes[2], $partes[0]);

		// Calcula a diferença de segundos entre as duas datas:
		$diferenca = $date1 - $date2; // 19522800 segundos

		// Calcula a diferença de dias
		return (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

	}

?>