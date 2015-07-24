<?php

	function moneyToDb($val, $type = null) {
		$val = str_replace('.','',$val);
		$val = str_replace(',','.',$val);
		return $val;
	}

	function moneyFromDb($val, $type = null, $decimals = 2) {
		return number_format($val,$decimals,',','.');
	}

?>