<?php
function attrRegister($array, $nama, $tipe, $description, $min, $max){
	global $thingsID, $baseUrl;
	$userID = getUserId();
		$urlAtribut = $baseUrl."user/".$userID."/thing/".$thingsID."/property/register";
		$konten = '{
		"name": "'.$nama.'", 
		"access": '.(in_array('acc', $array) ? 'true' : 'false').',
		"control": '.(in_array('ctrl', $array) ? 'true' : 'false').',
		"valueType": "'.$tipe.'",
		"description": "'.$description.'",
		"min": '.$min.',
		"max": '.$max.'
		}';
		echo $konten."<br>";
		$hasil = kurl($urlAtribut, "POST",$konten)."<br>";
		echo $hasil;
		return $hasil;
}