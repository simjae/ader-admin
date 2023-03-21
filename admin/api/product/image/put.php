<?php
/*
 +=============================================================================
 | 
 | FTP 파일목록 검사
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.12.02
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");

$product_idx_list       = $_POST['product_idx_arr'];
$img_type_list          = $_POST['img_type'];
$default_url_path		= "ader_prod_img";
$server_img_path        = "/var/www/admin/www/images/product/";

if($product_idx_list != null){
    $get_product_sql = "
        SELECT
            IDX,
            PRODUCT_CODE
        FROM
            SHOP_PRODUCT
        WHERE
            IDX IN (".$product_idx_list.")
    ";
    
    $db->query($get_product_sql);

    foreach($db->fetch() as $data){
        $upload_file = url_to_file_up($default_url_path, $server_img_path, $data['PRODUCT_CODE'], $img_type_list);

        if ($upload_file != null) {
            $db->query('DELETE FROM PRODUCT_IMG WHERE PRODUCT_IDX = '.$data['IDX'].' ');
            for ($i=0; $i<count($upload_file); $i++) {
                $img_type = $upload_file[$i]['img_type'];
                $img_url = $upload_file[$i]['url'];
                $img_location = "";
                if($upload_file[$i]['img_size'] == 'L'){
                    $img_location = $upload_file[$i]['url'];
                } else{
                    $img_location = $server_img_path.$upload_file[$i]['filename'];
                }
                $img_size = $upload_file[$i]['img_size'];
                
                $img_sql = "
                            INSERT INTO
                                PRODUCT_IMG
                            (
                                PRODUCT_IDX,
                                PRODUCT_CODE,
                                IMG_TYPE,
                                IMG_SIZE,
                                IMG_URL,
                                IMG_LOCATION,
                                CREATE_DATE,
                                CREATER,
                                UPDATE_DATE,
                                UPDATER
                            )
                            VALUES
                            (
                                ".$data['IDX'].",
                                '".$data['PRODUCT_CODE']."',
                                '".$img_type."',
                                '".$img_size."',
                                '".$img_url."',
                                '".$img_location."',
                                NOW(),
                                'Admin',
                                NOW(),
                                'Admin'
                            )";
                $db->query($img_sql);
            }
        }
    }
}
?>