<?PHP
/*
 +=============================================================================
 | 
 | Admin 논리적 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.19
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];
$policy_type		= $_POST['policy_type'];

$policy_txt			= $_POST['policy_txt'];

$policy_txt = str_replace("'","\'",$policy_txt);
$policy_txt = str_replace('"','\"',$policy_txt);

if ($country != null && $policy_type != null) {
	$update_policy_info_sql = "
		UPDATE
			POLICY_INFO
		SET
			POLICY_TXT = '".$policy_txt."'
		WHERE
			COUNTRY = '".$country."' AND
			POLICY_TYPE = '".$policy_type."'
	";
	
	$db->query($update_policy_info_sql);
}

?>