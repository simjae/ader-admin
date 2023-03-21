<?PHP
/*
 +=============================================================================
 | 
 | 기본정보 관리 - 개별조회
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.25
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];
$policy_type		= $_POST['policy_type'];

if ($country != null) {
	$where = " PI.COUNTRY = '".$country."' ";
	
	if ($policy_type != null) {
		$where .= " AND (PI.POLICY_TYPE = '".$policy_type."') ";
	}
	
	$select_policy_info_sql = "
		SELECT
			PI.POLICY_TYPE,
			PI.POLICY_TXT
		FROM
			POLICY_INFO PI
		WHERE
			".$where."
	";
	
	$db->query($select_policy_info_sql);

	foreach($db->fetch() as $policy_data) {
		$json_result['data'][] = array(
			'policy_type'		=> $policy_data['POLICY_TYPE'],
			'policy_txt'		=> $policy_data['POLICY_TXT']
		);
	}
}

?>