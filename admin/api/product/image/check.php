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
$url_path = $_POST['url_path'];
$product_code = $_POST['product_code'];

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

$type_arr = ['outfit', 'product', 'detail'];
$result_arr = [];
foreach($type_arr as $type){
    $chech_path = $url_path;
    $check_contents = ftp_nlist($conn,$total_path);
    
    if($check_contents != null){
        $total_path = $url_path."/".$type;
        $contents = ftp_nlist($conn,$total_path);
        $file_array = array();

        foreach($contents as $key=>$val){
            $explode_arr = explode('.', $val);
            $ext = $explode_arr[count($explode_arr) - 1];

            if($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
                $tmp_name = str_replace($total_path,'',$contents[$key]);
                $file_name_arr = explode('_',$tmp_name);
                array_push($file_array,"http://".$host."/".$total_path.$tmp_name);
            }
        }
        array_push($result_arr,array(
                    'type'      => $type,
                    'file_list' => $file_array
        ));
    }
    else{
        $json_result['code'] = 300;
        $json_result['msg'] = '폴더가 존재하지 않습니다.';
    }
}

ftp_close($conn);

$json_result['data'] = $result_arr;
?>