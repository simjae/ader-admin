<?php
/*
 +=============================================================================
 | 
 | 마이페이지 정보 취득
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$member_idx = NULL;
if(!isset($_SESSION['MEMBER_IDX'])){
    $json_result['code'] = 304;
    $json_result['msg'] = '비로그인 상태입니다.';
} 
else {
    $member_idx = $_SESSION['MEMBER_IDX'];

    $country = null;
    if (isset($_POST['country'])) {
        $country = $_POST['country'];
    }
    $list_type = null;
    if (isset($_POST['list_type'])) {
        $list_type = $_POST['list_type'];
    }

    if($country != null && $list_type != null){
        $where = '';
        switch ($list_type) {
            case 'apply':
                $where .= ' AND (REO.DEL_FLG = FALSE AND REO.REORDER_STATUS = FALSE)';
                break;
            case 'alarm':
                $where .= ' AND (REO.DEL_FLG = FALSE AND REO.REORDER_STATUS = TRUE)';
                break;
            case 'cancel':
                $where .= ' AND (REO.DEL_FLG = TRUE)';
                break;
        }
        
        $sql = "
            SELECT
                REO.IDX,
                REO.PRODUCT_NAME,
                OM.COLOR,
                OM.COLOR_RGB,
                REO.OPTION_NAME,
                PR.SALES_PRICE_KR,
                (
                    SELECT
                        REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
                    FROM
                        dev.PRODUCT_IMG S_PI
                    WHERE
                        S_PI.PRODUCT_IDX = PR.IDX AND
                        S_PI.DEL_FLG = FALSE AND
                        S_PI.IMG_SIZE = 'S' AND
                        S_PI.IMG_TYPE = 'P'
                    ORDER BY
                        S_PI.IDX ASC
                    LIMIT
                        0,1
                )   AS IMG_LOCATION,
                DATE_FORMAT(REO.UPDATE_DATE, '%Y.%m.%d') AS UPDATE_DATE
            
            FROM
                dev.PRODUCT_REORDER     REO     LEFT OUTER JOIN 
                dev.SHOP_PRODUCT PR 
            ON
                REO.PRODUCT_IDX = PR.IDX        LEFT JOIN 
                dev.ORDERSHEET_MST      OM 
            ON
                PR.ORDERSHEET_IDX = OM.IDX
            WHERE
                REO.MEMBER_IDX = ".$member_idx."
                ".$where."
            ORDER BY
                REO.IDX DESC
        ";

        $db->query($sql);

        foreach($db->fetch() as $data){
            $json_result['data'][] = array(
                'reorder_idx'           => $data['IDX'],
                'product_name'          => $data['PRODUCT_NAME'],
                'color'             => $data['COLOR'],
                'color_rgb'             => $data['COLOR_RGB'],
                'option_name'           => $data['OPTION_NAME'],
                'sales_price_kr'        => $data['SALES_PRICE_KR'],
                'img_location'          => $data['IMG_LOCATION'],
                'update_date'           => $data['UPDATE_DATE']
            );
        }
    }
    else{
        $json_result['code'] = 302;
        $json_result['msg'] = '재주문 정보 API을 실행하지 못했습니다.';
    }
}


?>