<?php
$country = $_POST['country'];
$textarea = $_POST['textarea'];
$textarea = strtoupper($textarea);

if ($country != null) {
	$select = "";
	if ($textarea != null ){
		$select = " ".$textarea." ";
	} else {
		$select = " INFORMATION,
					TERMS,
					REFUND_POLICY,
					PERSONAL_INFO_POLICY,
					GUIDE";
	}

	$sql = "SELECT 
				".$select."
			FROM 
				dev.STORE
			WHERE 
				COUNTRY = '".$country."'";
	$db->query($sql);

	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'country'       => $data['COUNTRY'],
			'information'   => $data['INFORMATION'],
			'terms'         => $data['TERMS'],
			'refundPolicy'         => $data['REFUND_POLICY'],
			'personalInfoPolicy'         => $data['PERSONAL_INFO_POLICY'],
			'guide'         => $data['GUIDE']
		);
	}
}
?>