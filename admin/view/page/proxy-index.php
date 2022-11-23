<?php
    header('Content-Type: text/json');
    header('Access-Control-Allow-Origin: *');

    $request_url = "http://203.245.9.174/ader_prod_img/BLAFWKV01BL/product/img_BLAFWKV01BL_09_P_S_202210210000.jpg";

    $ch = curl_init();
    $options = array(
        CURLOPT_URL            => $request_url,
        CURLOPT_RETURNTRANSFER => true,    // 반환값을 받을 것인가?
        CURLOPT_HEADER         => true,    // 헤더를 표시할 것인가?
        CURLOPT_FOLLOWLOCATION => true,    
        CURLOPT_ENCODING       => "",    
        CURLOPT_AUTOREFERER    => true,    
        CURLOPT_CONNECTTIMEOUT => 120, 
        CURLOPT_TIMEOUT        => 120,
        CURLOPT_MAXREDIRS      => 10,     
    )

    curl_setopt_aray($ch, $options);
    $response = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerstring = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if($httpcode == 200) {
        echo $body;
    }
?>
