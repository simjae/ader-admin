<?php

$path = $_POST['path'];

$host = '203.245.9.174';
$user = 'aderwms';
$password = 'bv1229';
$dir = '';

$conn = ftp_connect($host);

if(!$conn){
    echo "error";
    exit;
}

$result = ftp_login($conn, $user, $password);

if(!$result){
    echo "login error";
}

//$path = 'ader_prod_img/BLAFWKV01BL/product';
//$product_code = "BLASSHD01KK";

$contents = ftp_nlist($conn,$path);
$file_array = array();

//'gif', 'png', 'jpg', 'jpeg'

foreach($contents as $key=>$val){
    $explode_arr = explode('.', $val);
    $ext = $explode_arr[count($explode_arr) - 1];

    if($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
        $tmp_name = str_replace($path,'',$contents[$key]);
        $file_name_arr = explode('_',$tmp_name);
        array_push($file_array,"http://".$host."/".$path.$tmp_name);
    }
    
    //if ($file_name_arr[0] == $product_code) {
        
    //}
}


ftp_close($conn);

$json_result['data'] = $file_array;
?>