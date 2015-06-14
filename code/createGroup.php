<?php
function createGroup(){
	global $gatewayBaseUrl,$apiKey;
	$nama = $_POST['nama'];
	$lampus = $_POST['group'];
	if (!empty($lampus)) {
		$konten = '{"name":"'.$nama.'"}';
		$hasil = kurl($gatewayBaseUrl.$apiKey."/groups","POST",$konten);
		$hasilDecode = json_decode(substr($hasil, 1,-1));
		if (array_key_exists('success', $hasilDecode)){
			$id = $hasilDecode->success->id;
			$konten = '{"lights":[';
			foreach ($lampus as $lampu) {
				$konten .= '"'.$lampu.'",';
			}
			$konten = rtrim($konten,",");
			$konten.=']}';
			$url = $gatewayBaseUrl.$apiKey."/groups/".$id;
			echo kurl($url,"PUT",$konten);
		}
	}
	header("Location: index.php");
	die();
}