<?php

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
$path = "ader_prod_img";
$product_code = "BLASSHD01KK";

$contents = ftp_nlist($conn,$path);
$file_array = array();

print_r ($contents);

foreach($contents as $key=>$val){
    $tmp_name = str_replace($path,'',$contents[$key]);
    $file_name_arr = explode('_',$tmp_name);
    //if ($file_name_arr[0] == $product_code) {
        array_push($file_array,"https://".$host."/".$path."|".$tmp_name);
    //}
}

print_r ($file_array);

ftp_close($conn);
?>