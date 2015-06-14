<?php
function registerThings(){
	...
	$thingsToken = kurl($baseUrl."user/".$userID."/thing/register","POST",$kontenRequest);
	$json_obj = json_decode($thingsToken);
	if (strpos($json_obj->message,'failed') !== false) {
		echo "gagal";
	}else{
		$thingsID = $json_obj->id;
		echo "things ID: ".$thingsID."<br>";
		$control = "";
		$access = "";
		$urlAtribut = $baseUrl."user/".$userID."/thing/".$thingsID."/property/register";
		for ($i=0; $i < count($attr); $i++) { 
			if (!empty($attr[$i])) {
				$hasil = "";
				$attrName = "";
				switch ($i) {
					case 0:
						$hasil = attrRegister($attr[$i],"bri","INT","Tingkat kecerahan Lampu",0,255);
						$attrName = "bri";
						break;
				...
				}
				if (strpos($hasil,'added:') !== false) {
				    in_array('acc', $attr[$i]) ? $access .= $attrName."," : '';
					in_array('ctrl', $attr[$i]) ? $control .= $attrName."," : '';
				}
			}
		}
		
		$access = rtrim($access, ",");
		$control = rtrim($control, ",");

		dbInsert('things',array(
			'id'=>$thingsID,
			'type'=> ($tipe == 1) ?'Lampu' : 'Group',
			'nama'=>$nama,
			'local_id'=>$local_id,
			'control'=>$control,
			'access'=>$access,
			));
	}
...
}