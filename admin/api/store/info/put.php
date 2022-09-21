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
$country            = $_POST['country'];
$textarea           = $_POST['textarea'];

$content            = $_POST['content'];
$content = str_replace("'","\'",$content);
$content = str_replace('"','\"',$content);

$update_sql = "";
switch ($textarea) {
    case "information":
        $update_sql .= " INFORMATION = '".$content."', ";
        break;
    case "terms":
        $update_sql .= " TERMS = '".$content."', ";
        break;
    case "refundPolicy":
        $update_sql .= " REFUND_POLICY = '".$content."', ";
        break;
    case "personalInfoPolicy":
        $update_sql .= " PERSONAL_INFO_POLICY = '".$content."', ";
        break;
    case "guide":
        $update_sql .= " GUIDE = '".$content."', ";
        break;
}

$sql = "UPDATE
            dev.STORE
        SET
            ".$update_sql."
            UPDATE_DATE = NOW(),
            UPDATER = 'Admin'
        WHERE
            COUNTRY = '".$country."'";
$db->query($sql);
?>