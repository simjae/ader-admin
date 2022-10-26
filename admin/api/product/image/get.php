<?php

$host = '116.124.128.246';
$user = 'devetc';
$password = 'dkejdpfj2022!@';
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
$path = "admin/www/images/product/";
$product_code = "BLASSHD01KK";

$contents = ftp_nlist($conn,$path);
$file_array = array();

foreach($contents as $key=>$val){
    $tmp_name = str_replace($path,'',$contents[$key]);
    $file_name_arr = explode('_',$tmp_name);
    if ($file_name_arr[0] == $product_code) {
        array_push($file_array,"https://".$host."/".$path."|".$tmp_name);
    }
}

print_r ($file_array);

ftp_close($conn);
?>