<?php
/*
 +=============================================================================
 | 
 | 법적 고지사항
 | -------
 |
 | 최초 작성	: 윤재은
 | 최초 작성일	: 2023.02.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 |            
 | 
 +=============================================================================
*/
// GUD / PNL / TRM
// 3개 무조건
// 컨트리
// 폴리시 타입
$country = null;
if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

if ($country != null) {
  $select_policy_sql = "
    SELECT 
      POLICY_TYPE,
      POLICY_TXT 
    FROM 
      POLICY_INFO 
    WHERE 
      COUNTRY = '".$country."' AND 
      (
        POLICY_TYPE = 'GUD' OR 
        POLICY_TYPE = 'PNL' OR
        POLICY_TYPE = 'TRM'
      );
  ";

  $db->query($select_policy_sql);
  
  foreach($db->fetch() as $policy_data) {
    $json_result['data'][] = array(
      'policy_type' =>$policy_data['POLICY_TYPE'],
      'policy_txt' =>$policy_data['POLICY_TXT']
    );
  }
} else {
  $json_result['code'] = 301;
	$json_result['msg'] = "COUNTRY 정보가 없습니다. 확인 후 다시 시도해주세요.";
}
?>