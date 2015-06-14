<?php
function login(){
	global $baseUrl;
	$email = $_POST['email'];
	$url = $baseUrl."user/check/".$email;
	$hasil = kurl($url,"GET","");
	$hasilDecode = json_decode($hasil);
	if (array_key_exists('user', $hasilDecode)) {
		echo dbInsert("setting",array(
			"kunci"=>"user_id",
			"value"=>$hasilDecode->user));
	}else{
		echo "gagal";
	}
}