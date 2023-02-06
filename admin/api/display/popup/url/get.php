<?PHP
/*
 +=============================================================================
 | 
 | 팝업 URL GET 엑션 API
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$search_type		= $_POST['search_type'];
$search_keyword		= $_POST['search_keyword'];
$popup_idx			= $_POST['popup_idx'];
$list_type			= $_POST['list_type'];

$rows				= $_POST['rows'];
$page				= $_POST['page'];

$table = "";
$select = "";
$sql = "";

$where = " 1=1 ";
$where_cnt = $where;
if ($popup_idx != null) {
    $sql = "
		SELECT
			IDX				AS URL_IDX,
			POPUP_IDX		AS POPUP_IDX,
			POPUP_URL_TYPE	AS POPUP_URL_TYPE,
			FRONT_IDX		AS FRONT_IDX,
			PAGE_TITLE		AS PAGE_TITLE,
			PRODUCT_IDX		AS PRODUCT_IDX,
			PRODUCT_NAME	AS PRODUCT_NAME,
			PRODUCT_CODE	AS PRODUCT_CODE,
			URL				AS URL
		FROM
			dev.POPUP_URL
		WHERE
			POPUP_IDX = ".$popup_idx."
	";
} else {
    if($list_type == 'web'){
        $table = 'dev.FRONT_PAGE_URL';
        $select = "
			IDX			AS IDX,
			PAGE_TITLE	AS PAGE_TITLE,
			PAGE_URL	AS URL
		";
    }
    else if($list_type == 'product'){
        $table = 'dev.SHOP_PRODUCT';
        $select = "
			IDX				AS IDX,
			PRODUCT_NAME	AS PRODUCT_NAME,
			PRODUCT_CODE	AS PRODUCT_CODE
		";
    }

    if ($search_type != null && $search_keyword != null) {
        switch ($search_type) {
            case "title" :
                $where .= " AND (PAGE_TITLE LIKE '%".$search_keyword."%') ";
                break;
            
            case "url" :
                $where .= " AND (PAGE_URL LIKE '%".$search_keyword."%') ";
                break;
            
            case "product_code" :
                $where .= " AND (PRODUCT_CODE LIKE '%".$search_keyword."%') ";
                break;
            
            case "product_name":
                $where .= " AND (PRODUCT_NAME LIKE '%".$search_keyword."%') ";
                break;
        }
    }

    $limit_start = (intval($page)-1)*$rows;
    $limit = " LIMIT ".$limit_start.",".$rows;

    $json_result = array(
        'total' => $db->count($table,$where),
        'total_cnt' => $db->count($table,$cnt_where),
        'page' => intval($page)
    );
    
    $sql = "
        SELECT 
            ".$select."
        FROM
            ".$table."
        WHERE
            ".$where."
        ".$limit;
}

$db->query($sql);
foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'num'					=> $total_cnt--,
        'idx' 					=> $data['IDX'],
        'popup_idx' 		    => $data['POPUP_IDX'],
        'popup_url_type' 	    => $data['POPUP_URL_TYPE'],
        'front_idx'             => $data['FRONT_IDX'],
        'page_title' 			=> $data['PAGE_TITLE'],
        'page_url' 			    => $data['URL'],
        'product_idx'           => $data['PRODUCT_IDX'],
        'product_name' 			=> $data['PRODUCT_NAME'],
        'product_code' 			=> $data['PRODUCT_CODE']
    );
}
?>
