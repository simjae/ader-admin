<?php
/*
 +=============================================================================
 | 
 | ftp to file 업로드 (URL 이미지 서버 내 저장)
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

function sessionCheck() {
	$session_id = null;
	if (isset($_SESSION['ADMIN_ID'])) {
		$session_id = $_SESSION['ADMIN_ID'];
	} else {
		$json_result['code'] = 401;
		$json_result['msg'] = "로그인 후 다시 시도해주세요.";
		return $json_result;
	}
	
	return $session_id;
}
function url_to_file_up($ftp_dir,$server_img_path,$product_dir_name,$img_type_seq){
	$ftp_host 				= '203.245.9.174';
	$user 					= 'aderwms';
	$password 				= 'bv1229';
	$conn 					= ftp_connect($ftp_host);
	if(!$conn){
		echo "FTP SERVER CONNECT ERROR";
		exit;
	}
	
	$result = ftp_login($conn, $user, $password);
	if(!$result){
		echo "FTP SERVER LOGIN ERROR";
	}
	
	if($img_type_seq != null && is_array($img_type_seq)){
		$outfit_exist = array_search('outfit', $img_type_seq);
		$product_exist =  array_search('product', $img_type_seq);
		$detail_exist =  array_search('detail', $img_type_seq);
	}

	$upload_file = array();

	$ftp_file_path = $ftp_dir."/".$product_dir_name."/";
	$contents = ftp_nlist($conn,$ftp_file_path);
	
	if(!empty($contents)){
		$outfit_file_arr = array();
		$product_file_arr = array();
		$detail_file_arr = array();

		foreach($contents as $file_name_list){
			if(strpos($file_name_list, 'outfit') !== false){
				$outfit_file_arr[] = $file_name_list;
			}
			else if(strpos($file_name_list, 'product') !== false){
				$product_file_arr[] = $file_name_list;
			}
			else if(strpos($file_name_list, 'detail') !== false){
				$detail_file_arr[] = $file_name_list;
			}
		}
		
		$cnt = 0;
		foreach(${$img_type_seq[0].'_file_arr'} as $file_item){
			$img_type = '';
			switch($img_type_seq[0]){
				case 'outfit':
					$img_type = 'O';
					break;
				case 'product':
					$img_type = 'P';
					break;
				case 'detail':
					$img_type = 'D';
			}
			
			$cnt++;
			
			$explode_arr = explode('.', $file_item);
			$ext = $explode_arr[count($explode_arr) - 1];

			if($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
				$ftp_file_name = str_replace($ftp_file_path,'',$file_item);
				$tmp_file_name = $server_img_path."tmp_".$ftp_file_name;

				$url = "http://".$ftp_host."/".$ftp_dir."/".$product_dir_name."/".$ftp_file_name;
				$ftp_file = file_get_contents($url);
				$res = file_put_contents($tmp_file_name, $ftp_file);

				if($res == true){
					array_push($upload_file,[
						'url'			=>$url,
						'filename'		=>$url,
						'img_size'		=>"L",
						'img_type'		=>$img_type
					]);

					$size = getimageSize($tmp_file_name);
					$width = $size[0];
					$height = $size[1];
					$imgtype = $size[2];
					
					if($imgtype==1)      $img_lrg = ImageCreateFromGif($tmp_file_name);
					else if($imgtype==2) $img_lrg = ImageCreateFromJpeg($tmp_file_name);
					else if($imgtype==3) $img_lrg = ImageCreateFromPng($tmp_file_name);
					
					$makesize_mdl = 1000;
					$makesize_sml = 600;
						
					$filename_mdl = "";
					if ($width >= $makesize_mdl || $height >= $makesize_mdl) {            
						$filename_mdl = "img_".$product_dir_name."_".sprintf('%02d', $cnt)."_".$img_type."_M_".time().".".$ext;

						if ($width >= $height) {
							$mdl_width = $makesize_mdl;
							$mdl_height = ($height*$makesize_mdl)/$width;
							
						} else if($width < $height) {
							$mdl_width = ($width * $makesize_mdl)/$height;
							$mdl_height = $makesize_mdl;
						}

						if ($imgtype==1) {
							$img_mdl = ImageCreate($mdl_width,$mdl_height); // GIF일경우
							$white = ImageColorAllocate($img_mdl, 255,255,255);
							
							imagefill($img_mdl,1,1,$white);
							ImageCopyResized($img_mdl,$img_lrg,0,0,0,0,$mdl_width,$mdl_height,$width,$height);
							$upload_result = imageGIF($img_mdl,$server_img_path.$filename_mdl);
							
						} else if ($imgtype==2) {
							$img_mdl=ImageCreateTrueColor($mdl_width,$mdl_height); // JPG일경우
							$white = ImageColorAllocate($img_mdl, 255,255,255);
							
							imagefill($img_mdl,1,1,$white);
							imagecopyresampled($img_mdl,$img_lrg,0,0,0,0,$mdl_width,$mdl_height,$width,$height);
							$upload_result = imageJPEG($img_mdl,$server_img_path.$filename_mdl,90);
							
						} else {
							$img_mdl=ImageCreateTrueColor($mdl_width,$mdl_height); // PNG일경우
							imagesavealpha($img_mdl, true);
							$white = Imagecolorallocatealpha($img_mdl,0x00,0x00,0x00,127);
							
							imagefill($img_mdl,0,0,$white);
							imagecopyresampled($img_mdl,$img_lrg,0,0,0,0,$mdl_width,$mdl_height,$width,$height);
							$upload_result = imagePNG($img_mdl,$server_img_path.$filename_mdl);
						}
						if ($upload_result == true) {								
							array_push($upload_file,[
								'url'			=>$url,
								'filename'		=>$filename_mdl,
								'img_size'		=>"M",
								'img_type'		=>$img_type
							]);
						}

						ImageDestroy($img_mdl);
					}
						
					if ($width >= $makesize_sml || $height >= $makesize_sml) {            
						$filename_sml = "img_".$product_dir_name."_".sprintf('%02d', $cnt)."_".$img_type."_S_".time().".".$ext;

						if ($width >= $height) {
							$sml_width = $makesize_sml;
							$sml_height = ($height*$makesize_sml)/$width;
							
						} else if($width < $height) {
							$sml_width = ($width * $makesize_sml)/$height;
							$sml_height = $makesize_sml;
						}

						if ($imgtype==1) {
							$img_sml = ImageCreate($sml_width,$sml_height); // GIF일경우
							$white = ImageColorAllocate($img_sml, 255,255,255);
							
							imagefill($img_sml,1,1,$white);
							ImageCopyResized($img_sml,$img_lrg,0,0,0,0,$sml_width,$sml_height,$width,$height);
							$upload_result = imageGIF($img_sml,$server_img_path.$filename_sml);
							
						} else if ($imgtype==2) {
							$img_sml=ImageCreateTrueColor($sml_width,$sml_height); // JPG일경우
							$white = ImageColorAllocate($img_sml, 255,255,255);
							
							imagefill($img_sml,1,1,$white);
							imagecopyresampled($img_sml,$img_lrg,0,0,0,0,$sml_width,$sml_height,$width,$height);
							$upload_result = imageJPEG($img_sml,$server_img_path.$filename_sml,90);
							
						} else {
							$img_sml=ImageCreateTrueColor($sml_width,$sml_height); // PNG일경우
							imagesavealpha($img_sml, true);
							$white = Imagecolorallocatealpha($img_sml,0x00,0x00,0x00,127);
							
							imagefill($img_sml,0,0,$white);
							imagecopyresampled($img_sml,$img_lrg,0,0,0,0,$sml_width,$sml_height,$width,$height);
							$upload_result = imagePNG($img_sml,$server_img_path.$filename_sml);
						}
						if ($upload_result == true) {
							array_push($upload_file,[
								'url'			=>$url,
								'filename'		=>$filename_sml,
								'img_size'		=>"S",
								'img_type'		=>$img_type
							]);
						}
						ImageDestroy($img_sml);
					}
					file_del($tmp_file_name);
				}
			}
		}
		foreach(${$img_type_seq[1].'_file_arr'} as $file_item){
			$img_type = '';
			switch($img_type_seq[1]){
				case 'outfit':
					$img_type = 'O';
					break;
				case 'product':
					$img_type = 'P';
					break;
				case 'detail':
					$img_type = 'D';
			}
			
			$cnt++;
			$explode_arr = explode('.', $file_item);
			$ext = $explode_arr[count($explode_arr) - 1];

			if($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
				$ftp_file_name = str_replace($ftp_file_path,'',$file_item);
				$tmp_file_name = $server_img_path."tmp_".$ftp_file_name;

				$url = "http://".$ftp_host."/".$ftp_dir."/".$product_dir_name."/".$ftp_file_name;
				$ftp_file = file_get_contents($url);
				$res = file_put_contents($tmp_file_name, $ftp_file);

				if($res == true){
					array_push($upload_file,[
						'url'			=>$url,
						'filename'		=>$url,
						'img_size'		=>"L",
						'img_type'		=>$img_type
					]);

					$size = getimageSize($tmp_file_name);
					$width = $size[0];
					$height = $size[1];
					$imgtype = $size[2];
					
					if($imgtype==1)      $img_lrg = ImageCreateFromGif($tmp_file_name);
					else if($imgtype==2) $img_lrg = ImageCreateFromJpeg($tmp_file_name);
					else if($imgtype==3) $img_lrg = ImageCreateFromPng($tmp_file_name);
						
					$makesize_mdl = 1000;
					$makesize_sml = 600;
						
					$filename_mdl = "";
					if ($width > $makesize_mdl || $height > $makesize_mdl) {            
						$filename_mdl = "img_".$product_dir_name."_".sprintf('%02d', $cnt)."_".$img_type."_M_".time().".".$ext;

						if ($width >= $height) {
							$mdl_width = $makesize_mdl;
							$mdl_height = ($height*$makesize_mdl)/$width;
							
						} else if($width < $height) {
							$mdl_width = ($width * $makesize_mdl)/$height;
							$mdl_height = $makesize_mdl;
						}

						if ($imgtype==1) {
							$img_mdl = ImageCreate($mdl_width,$mdl_height); // GIF일경우
							$white = ImageColorAllocate($img_mdl, 255,255,255);
							
							imagefill($img_mdl,1,1,$white);
							ImageCopyResized($img_mdl,$img_lrg,0,0,0,0,$mdl_width,$mdl_height,$width,$height);
							$upload_result = imageGIF($img_mdl,$server_img_path.$filename_mdl);
							
						} else if ($imgtype==2) {
							$img_mdl=ImageCreateTrueColor($mdl_width,$mdl_height); // JPG일경우
							$white = ImageColorAllocate($img_mdl, 255,255,255);
							
							imagefill($img_mdl,1,1,$white);
							imagecopyresampled($img_mdl,$img_lrg,0,0,0,0,$mdl_width,$mdl_height,$width,$height);
							$upload_result = imageJPEG($img_mdl,$server_img_path.$filename_mdl,90);
							
						} else {
							$img_mdl=ImageCreateTrueColor($mdl_width,$mdl_height); // PNG일경우
							imagesavealpha($img_mdl, true);
							$white = Imagecolorallocatealpha($img_mdl,0x00,0x00,0x00,127);
							
							imagefill($img_mdl,0,0,$white);
							imagecopyresampled($img_mdl,$img_lrg,0,0,0,0,$mdl_width,$mdl_height,$width,$height);
							$upload_result = imagePNG($img_mdl,$server_img_path.$filename_mdl);
						}
						if ($upload_result == true) {								
							array_push($upload_file,[
								'url'			=>$url,
								'filename'		=>$filename_mdl,
								'img_size'		=>"M",
								'img_type'		=>$img_type
							]);
						}

						ImageDestroy($img_mdl);
					}
						
					if ($width > $makesize_sml || $height > $makesize_sml) {            
						$filename_sml = "img_".$product_dir_name."_".sprintf('%02d', $cnt)."_".$img_type."_S_".time().".".$ext;

						if ($width >= $height) {
							$sml_width = $makesize_sml;
							$sml_height = ($height*$makesize_sml)/$width;
							
						} else if($width < $height) {
							$sml_width = ($width * $makesize_sml)/$height;
							$sml_height = $makesize_sml;
						}

						if ($imgtype==1) {
							$img_sml = ImageCreate($sml_width,$sml_height); // GIF일경우
							$white = ImageColorAllocate($img_sml, 255,255,255);
							
							imagefill($img_sml,1,1,$white);
							ImageCopyResized($img_sml,$img_lrg,0,0,0,0,$sml_width,$sml_height,$width,$height);
							$upload_result = imageGIF($img_sml,$server_img_path.$filename_sml);
							
						} else if ($imgtype==2) {
							$img_sml=ImageCreateTrueColor($sml_width,$sml_height); // JPG일경우
							$white = ImageColorAllocate($img_sml, 255,255,255);
							
							imagefill($img_sml,1,1,$white);
							imagecopyresampled($img_sml,$img_lrg,0,0,0,0,$sml_width,$sml_height,$width,$height);
							$upload_result = imageJPEG($img_sml,$server_img_path.$filename_sml,90);
							
						} else {
							$img_sml=ImageCreateTrueColor($sml_width,$sml_height); // PNG일경우
							imagesavealpha($img_sml, true);
							$white = Imagecolorallocatealpha($img_sml,0x00,0x00,0x00,127);
							
							imagefill($img_sml,0,0,$white);
							imagecopyresampled($img_sml,$img_lrg,0,0,0,0,$sml_width,$sml_height,$width,$height);
							$upload_result = imagePNG($img_sml,$server_img_path.$filename_sml);
						}
						if ($upload_result == true) {
							array_push($upload_file,[
								'url'			=>$url,
								'filename'		=>$filename_sml,
								'img_size'		=>"S",
								'img_type'		=>$img_type
							]);
						}
						ImageDestroy($img_sml);
					}
					file_del($tmp_file_name);
				}
			}
		}
		foreach(${$img_type_seq[2].'_file_arr'} as $file_item){
			$img_type = '';
			switch($img_type_seq[2]){
				case 'outfit':
					$img_type = 'O';
					break;
				case 'product':
					$img_type = 'P';
					break;
				case 'detail':
					$img_type = 'D';
			}
			$cnt++;
			$explode_arr = explode('.', $file_item);
			$ext = $explode_arr[count($explode_arr) - 1];

			if($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
				$ftp_file_name = str_replace($ftp_file_path,'',$file_item);
				$tmp_file_name = $server_img_path."tmp_".$ftp_file_name;

				$url = "http://".$ftp_host."/".$ftp_dir."/".$product_dir_name."/".$ftp_file_name;
				$ftp_file = file_get_contents($url);
				$res = file_put_contents($tmp_file_name, $ftp_file);

				if($res == true){
					array_push($upload_file,[
						'url'			=>$url,
						'filename'		=>$url,
						'img_size'		=>"L",
						'img_type'		=>$img_type
					]);

					$size = getimageSize($tmp_file_name);
					$width = $size[0];
					$height = $size[1];
					$imgtype = $size[2];
					
					if($imgtype==1)      $img_lrg = ImageCreateFromGif($tmp_file_name);
					else if($imgtype==2) $img_lrg = ImageCreateFromJpeg($tmp_file_name);
					else if($imgtype==3) $img_lrg = ImageCreateFromPng($tmp_file_name);
						
					$makesize_mdl = 1000;
					$makesize_sml = 600;
						
					$filename_mdl = "";
					if ($width > $makesize_mdl || $height > $makesize_mdl) {            
						$filename_mdl = "img_".$product_dir_name."_".sprintf('%02d', $cnt)."_".$img_type."_M_".time().".".$ext;

						if ($width >= $height) {
							$mdl_width = $makesize_mdl;
							$mdl_height = ($height*$makesize_mdl)/$width;
							
						} else if($width < $height) {
							$mdl_width = ($width * $makesize_mdl)/$height;
							$mdl_height = $makesize_mdl;
						}

						if ($imgtype==1) {
							$img_mdl = ImageCreate($mdl_width,$mdl_height); // GIF일경우
							$white = ImageColorAllocate($img_mdl, 255,255,255);
							
							imagefill($img_mdl,1,1,$white);
							ImageCopyResized($img_mdl,$img_lrg,0,0,0,0,$mdl_width,$mdl_height,$width,$height);
							$upload_result = imageGIF($img_mdl,$server_img_path.$filename_mdl);
							
						} else if ($imgtype==2) {
							$img_mdl=ImageCreateTrueColor($mdl_width,$mdl_height); // JPG일경우
							$white = ImageColorAllocate($img_mdl, 255,255,255);
							
							imagefill($img_mdl,1,1,$white);
							imagecopyresampled($img_mdl,$img_lrg,0,0,0,0,$mdl_width,$mdl_height,$width,$height);
							$upload_result = imageJPEG($img_mdl,$server_img_path.$filename_mdl,90);
							
						} else {
							$img_mdl=ImageCreateTrueColor($mdl_width,$mdl_height); // PNG일경우
							imagesavealpha($img_mdl, true);
							$white = Imagecolorallocatealpha($img_mdl,0x00,0x00,0x00,127);
							
							imagefill($img_mdl,0,0,$white);
							imagecopyresampled($img_mdl,$img_lrg,0,0,0,0,$mdl_width,$mdl_height,$width,$height);
							$upload_result = imagePNG($img_mdl,$server_img_path.$filename_mdl);
						}
						if ($upload_result == true) {								
							array_push($upload_file,[
								'url'			=>$url,
								'filename'		=>$filename_mdl,
								'img_size'		=>"M",
								'img_type'		=>$img_type
							]);
						}

						ImageDestroy($img_mdl);
					}
						
					if ($width > $makesize_sml || $height > $makesize_sml) {            
						$filename_sml = "img_".$product_dir_name."_".sprintf('%02d', $cnt)."_".$img_type."_S_".time().".".$ext;

						if ($width >= $height) {
							$sml_width = $makesize_sml;
							$sml_height = ($height*$makesize_sml)/$width;
							
						} else if($width < $height) {
							$sml_width = ($width * $makesize_sml)/$height;
							$sml_height = $makesize_sml;
						}

						if ($imgtype==1) {
							$img_sml = ImageCreate($sml_width,$sml_height); // GIF일경우
							$white = ImageColorAllocate($img_sml, 255,255,255);
							
							imagefill($img_sml,1,1,$white);
							ImageCopyResized($img_sml,$img_lrg,0,0,0,0,$sml_width,$sml_height,$width,$height);
							$upload_result = imageGIF($img_sml,$server_img_path.$filename_sml);
							
						} else if ($imgtype==2) {
							$img_sml=ImageCreateTrueColor($sml_width,$sml_height); // JPG일경우
							$white = ImageColorAllocate($img_sml, 255,255,255);
							
							imagefill($img_sml,1,1,$white);
							imagecopyresampled($img_sml,$img_lrg,0,0,0,0,$sml_width,$sml_height,$width,$height);
							$upload_result = imageJPEG($img_sml,$server_img_path.$filename_sml,90);
							
						} else {
							$img_sml=ImageCreateTrueColor($sml_width,$sml_height); // PNG일경우
							imagesavealpha($img_sml, true);
							$white = Imagecolorallocatealpha($img_sml,0x00,0x00,0x00,127);
							
							imagefill($img_sml,0,0,$white);
							imagecopyresampled($img_sml,$img_lrg,0,0,0,0,$sml_width,$sml_height,$width,$height);
							$upload_result = imagePNG($img_sml,$server_img_path.$filename_sml);
						}
						if ($upload_result == true) {
							array_push($upload_file,[
								'url'			=>$url,
								'filename'		=>$filename_sml,
								'img_size'		=>"S",
								'img_type'		=>$img_type
							]);
						}
						ImageDestroy($img_sml);
					}
					file_del($tmp_file_name);
				}
			}
		}
		ftp_close($conn);
		return $upload_file;
	}
	else{
		return null;
	}
}

function getProductFileCnt($db, $product_code){
	$default_url_path			= "/ader_prod_img/";
    $host = '203.245.9.174';
    $user = 'aderwms';
    $password = 'bv1229';

    $conn = ftp_connect($host);

	$result_arr = array();
	$result_arr['folder_exist'] = false;

    if(!$conn){
        echo "error";
        exit;
    }

    $result = ftp_login($conn, $user, $password);

    if(!$result){
        echo "login error";
    }

    if(strlen($product_code) > 0){
		$url_path = $default_url_path.$product_code;
		$contents = ftp_nlist($conn,$url_path);

		if(!empty($contents)){
			$outfit_file_cnt = 0;
			$product_file_cnt = 0;
			$detail_file_cnt = 0;

			$result_arr['folder_exist'] = true;
			foreach($contents as $val){
				$explode_arr = explode('.', $val);
				$ext = $explode_arr[count($explode_arr) - 1];
		
				if($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
					if(strpos($val, 'outfit') != false){
						$outfit_file_cnt++;
					}
					else if(strpos($val, 'product') != false){
						$product_file_cnt++;
					}
					else if(strpos($val, 'detail') != false){
						$detail_file_cnt++;
					}
				}
			}
			$result_arr['outfit_cnt'] = $outfit_file_cnt;
			$result_arr['product_cnt'] = $product_file_cnt;
			$result_arr['detail_cnt'] = $detail_file_cnt;
		}
	}
	return $result_arr;
}

?>