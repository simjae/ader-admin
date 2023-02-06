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
	$session_id = "Admin";
	if (isset($_SESSION['ADMIN_ID'])) {
		$session_id = $_SESSION['ADMIN_ID'];
	} else {
		//$json_result['code'] = 400;
	}
	
	return $session_id;
}

function url_to_file_up_posting($ftp_dir,$server_img_path,$img_dir){
	$ftp_host 				= '203.245.9.174';
	$user 					= 'aderwms';
	$password 				= 'bv1229';
	$dir 					= '';
	$conn 					= ftp_connect($ftp_host);

	if(!$conn){
		echo "FTP SERVER CONNECT ERROR";
		exit;
	}
	
	$result = ftp_login($conn, $user, $password);
	if(!$result){
		echo "FTP SERVER LOGIN ERROR";
	}
	
	$upload_result = array();
	
	$upload_file = array();
	$product_cnt = 0;
		
	$ftp_file_path = $ftp_dir."/".$img_dir."/";

	$contents = ftp_nlist($conn,$ftp_file_path);

	if(count($contents) > 0){
		sort($contents);
	}

	$cnt = 0;
	if (!empty($contents)) {
		$product_cnt = count($contents);
		foreach($contents as $key=>$contents_val){
			$cnt++;
			if($cnt < 10){
				$cnt = '0'.$cnt;
			}
			
			$explode_arr = explode('.', $contents_val);
			$ext = $explode_arr[count($explode_arr) - 1];
			
			if($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
				$ftp_file_name = str_replace($ftp_file_path,'',$contents_val);
				$tmp_file_name = $server_img_path."/tmp_".$ftp_file_name;
				
				$url = "http://".$ftp_host.$ftp_dir."/".$img_dir."/".$ftp_file_name;
				$ftp_file = file_get_contents($url);
				$res = file_put_contents($tmp_file_name, $ftp_file);
				
				if($res == true){
					array_push($upload_file,[
						'url'			=>$url,
						'filename'		=>$url,
						'img_size'		=>"L"
					]);

					$size = getimageSize($tmp_file_name);
					$width = $size[0];
					$height = $size[1];
					$imgtype = $size[2];
					
					if($imgtype==1)      $img_lrg = ImageCreateFromGif($tmp_file_name);
					else if($imgtype==2) $img_lrg = ImageCreateFromJpeg($tmp_file_name);
					else if($imgtype==3) $img_lrg = ImageCreateFromPng($tmp_file_name);
						
					$makesize_mdl = 600;
					$makesize_sml = 130;
						
					$filename_mdl = "";
					if ($width > $makesize_mdl || $height > $makesize_mdl) {            
						$filename_mdl = "/img_".$img_dir."_".$cnt."_M_".time().".".$ext;

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
								'img_size'		=>"M"
							]);
						}

						ImageDestroy($img_mdl);
					}
						
					if ($width > $makesize_sml || $height > $makesize_sml) {            
						$filename_sml = "/img_".$img_dir."_".$cnt."_S_".time().".".$ext;

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
								'img_size'		=>"S"
							]);
						}
						ImageDestroy($img_sml);
					}
					file_del($tmp_file_name);
				}
				else{
					if(!file_exists(pathinfo($tmp_file_name)['dirname'])){
						print_r('폴더 생성 필요 ');
					}
				}
			}
		}
	}
	
	$upload_result = array(
		'product_cnt'	=>$product_cnt,
		'upload_file'	=>$upload_file
	);
	
	ftp_close($conn);
	
	return $upload_result;
}

function url_to_file_up($ftp_dir,$server_img_path,$new_product_code){
	$ftp_host 				= '203.245.9.174';
	$user 					= 'aderwms';
	$password 				= 'bv1229';
	$dir 					= '';
	$conn 					= ftp_connect($ftp_host);

	if(!$conn){
		echo "FTP SERVER CONNECT ERROR";
		exit;
	}
	
	$result = ftp_login($conn, $user, $password);
	if(!$result){
		echo "FTP SERVER LOGIN ERROR";
	}
	
	$upload_file = array();
	$img_type = ['O','P','D'];
	foreach($img_type as $val){
		$img_dir = "";
		switch ($val) {
			case "O" :
				$img_dir = "outfit";
				break;
			
			case "P" :
				$img_dir = "product";
				break;
			
			case "D" :
				$img_dir = "detail";
				break;
		}
		
		$ftp_file_path = $ftp_dir."/".$new_product_code."/".$img_dir."/";
		$contents = ftp_nlist($conn,$ftp_file_path);
		$cnt = 0;
		
		if (!empty($contents)) {
			foreach($contents as $key=>$contents_val){
				$cnt++;
				if($cnt < 10){
					$cnt = '0'.$cnt;
				}
				
				$explode_arr = explode('.', $contents_val);
				$ext = $explode_arr[count($explode_arr) - 1];
				
				if($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
					$ftp_file_name = str_replace($ftp_file_path,'',$contents_val);
					$tmp_file_name = $server_img_path."tmp_".$ftp_file_name;
					
					$url = "http://".$ftp_host.$ftp_dir."/".$new_product_code."/".$img_dir."/".$ftp_file_name;
					
					$ftp_file = file_get_contents($url);
					$res = file_put_contents($tmp_file_name, $ftp_file);
					
					if($res == true){
						array_push($upload_file,[
							'url'			=>$url,
							'filename'		=>$url,
							'img_size'		=>"L",
							'img_type'		=>$val
						]);

						$size = getimageSize($tmp_file_name);
						$width = $size[0];
						$height = $size[1];
						$imgtype = $size[2];
						
						if($imgtype==1)      $img_lrg = ImageCreateFromGif($tmp_file_name);
						else if($imgtype==2) $img_lrg = ImageCreateFromJpeg($tmp_file_name);
						else if($imgtype==3) $img_lrg = ImageCreateFromPng($tmp_file_name);
							
						$makesize_mdl = 600;
						$makesize_sml = 130;
							
						$filename_mdl = "";
						if ($width > $makesize_mdl || $height > $makesize_mdl) {            
							$filename_mdl = "img_".$new_product_code."_".$cnt."_".$val."_M_".time().".".$ext;

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
									'img_type'		=>$val
								]);
							}

							ImageDestroy($img_mdl);
						}
							
						if ($width > $makesize_sml || $height > $makesize_sml) {            
							$filename_sml = "img_".$new_product_code."_".$cnt."_".$val."_S_".time().".".$ext;

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
									'img_type'		=>$val
								]);
							}
							ImageDestroy($img_sml);
						}
						file_del($tmp_file_name);
					}
				}
			}
		}
	}
	
	ftp_close($conn);
	
	return $upload_file;
}
?>