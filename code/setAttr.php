<?php
function setAttribute(){
	global $gatewayBaseUrl, $apiKey;
	$id = $_POST['id'];
	$value = explode("::", $_POST['value']);
	$attr = explode("::", $_POST['attr']);
	$mode = $_POST['mode'];
	$data_json = '{';
	for ($i=0; $i < count($attr); $i++) { 
		$data_json.= '"'.$attr[$i].'":'.$value[$i];
		if ($i < count($attr)-1) {
			$data_json .= ',';
		}
	}
	$data_json .= '}';
	$url = "";
	if ($mode == 1) {
		$url = $gatewayBaseUrl.$apiKey."/lights/".$id."/state";
	}else{
		$url = $gatewayBaseUrl.$apiKey."/groups/".$id."/action";
	}
	$result = kurl($url,"PUT",$data_json);
	$hasilDecode = json_decode(substr($result, 1,-1));
	if (array_key_exists('success', $hasilDecode)) {
		$message = $hasilDecode->success;
		$state = "";
		foreach ($message as $key => $value) {
			$state = $value;
		}
		$state = ($state == true ? "true" : "false");
		echo "sukses:".$state;
	}else{
		echo $data_json;
	}
}