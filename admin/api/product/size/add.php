<?PHP
/*
 +=============================================================================
 | 
 | 상품 사이즈별 치수정보 등록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.09.21
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
    $product_code   = $_POST['product_code'];
    $column_cnt     = $_POST['column_cnt'];
    $category_name  = $_POST['category_name'];
    $size_info_1    = $_POST['size_info_1'];
    $size_info_2    = $_POST['size_info_2'];
    $size_info_3    = $_POST['size_info_3'];
    $size_info_4    = $_POST['size_info_4'];
    $size_info_5    = $_POST['size_info_5'];
    $size_info_6    = $_POST['size_info_6'];

    $product_idx = 0;
    $column_sql = "";
    $value_sql  = "";

    if($product_code != null){
        $db->query('SELECT IDX FROM dev.SHOP_PRODUCT WHERE PRODUCT_CODE = "'.$product_code.'" ');
        foreach($db->fetch() as $data){
            $product_idx = $data['IDX'];
        }
    }
    for($i=1; $i<=$column_cnt; $i++){
        $column_sql .= " SIZE_INFO_".$i.", ";
    }
    if($category_name != null){
        for($i=0; $i < count($category_name); $i++){
            $value_sql .= "
                (".$product_idx.",
                 '".$product_code."',
                 '".$category_name[$i]."',
            ";
            for($j=1; $j<=$column_cnt; $j++){
                if(strlen(${"size_info_".$j}[$i]) > 0){
                    $value_sql .= " '".${"size_info_".$j}[$i]."', ";
                }
                else{
                    $value_sql .= " NULL, ";
                }
            }
            $value_sql .= "
                 NOW(),
                 'Admin',
                 NOW(),
                 'Admin')
            ";
            if($i < count($category_name)-1){
                $value_sql .= ",";
            }
        }
    }
    $sql = "
            INSERT INTO dev.PRODUCT_SIZE (
                PRODUCT_IDX,
                PRODUCT_CODE,
                SIZE_NAME,
                ".$column_sql."
                CREATE_DATE,
                CREATER,
                UPDATE_DATE,
                UPDATER
            )
            VALUE
            ".$value_sql."
        ";
   $db->query($sql);
?>