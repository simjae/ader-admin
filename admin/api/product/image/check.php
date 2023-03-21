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
$url_path			= $_POST['url_path'];
$product_code		= $_POST['product_code'];
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

$result_arr = [];
$outfit_file_array = [];
$product_file_array = [];
$detail_file_array = [];

if($url_path != null){
    $contents = ftp_nlist($conn,$url_path);
    foreach($contents as $key=>$val){
        $explode_arr = explode('.', $val);
        $ext = $explode_arr[count($explode_arr) - 1];

        if($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
            if(strpos($val, 'outfit') != false){
                $outfit_file_arr[] = "http://".$host."/".$val;
			}
			else if(strpos($val, 'product') != false){
                $product_file_arr[] = "http://".$host."/".$val;
			}
			else if(strpos($val, 'detail') != false){
                $detail_file_arr[] = "http://".$host."/".$val;
			}
	
			
        }
    }
    array_push($result_arr, array('type'=>'outfit', 'file_list'=>$outfit_file_arr));
    array_push($result_arr, array('type'=>'product', 'file_list'=>$product_file_arr));
    array_push($result_arr, array('type'=>'detail', 'file_list'=>$detail_file_arr));
    
    ftp_close($conn);
    $json_result['data'] = $result_arr;
}
else {
    $json_result['code'] = 300;
    $json_result['msg'] = '폴더가 존재하지 않습니다.';
}
?>