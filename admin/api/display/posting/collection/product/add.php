<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 상품 이미지 추가
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$collection_idx		= $_POST['collection_idx'];
$ftp_dir			= $_POST['ftp_dir'];

//print_r('old_ftp_dir:'.$ftp_dir.' ');
$tmp_arr = explode("/",$ftp_dir);
$img_dir = $tmp_arr[intval(count($tmp_arr) - 1)];

array_pop($tmp_arr);

$ftp_dir_new = implode('/',$tmp_arr);


if ($collection_idx != null && $img_dir != null) {
	$db->begin_transaction();
	try {
		$ftp_dir = "/ader_prod_img/posting/collection/".$img_dir;
		$server_img_path = "/var/www/admin/www/images/posting/collection/".$img_dir;
		
		
		$upload_result = url_to_file_up_posting($ftp_dir_new,$server_img_path,$img_dir);
		
		$product_cnt = intval($upload_result['product_cnt']);
		$upload_file = $upload_result['upload_file'];
		if ($product_cnt > 0 && !empty($upload_file)) {
			$display_num = 1;

			$init_product_sql = "
				DELETE FROM
					dev.COLLECTION_PRODUCT
				WHERE
					COLLECTION_IDX = ".$collection_idx."
			";
			$db->query($init_product_sql);

			for ($i=0; $i<$product_cnt; $i++) {
				$insert_product_sql = "
					INSERT INTO
						dev.COLLECTION_PRODUCT
					(
						DISPLAY_NUM,
						COLLECTION_IDX
					) VALUES (
						".$display_num.",
						".$collection_idx."
					)
				";
				$db->query($insert_product_sql);
				
				$c_product_idx = $db->last_id();
				
				if (!empty($c_product_idx)) {
					$display_num++;
					for ($j = 0; $j < 3; $j++){
						$img_url = $img_location = $upload_file[($i*3) + $j]['url'];
						$img_location = "";
						if($upload_file[($i*3) + $j]['img_size'] == 'L'){
							$img_location = $upload_file[($i*3) + $j]['url'];
						}
						else{
							$img_location = $server_img_path.'/'.$upload_file[($i*3) + $j]['filename'];
						}
						$img_size = $upload_file[($i*3) + $j]['img_size'];

						$insert_img_sql = "
							INSERT INTO
								dev.COLLECTION_IMG
							(
								C_PRODUCT_IDX,
								IMG_SIZE,
								IMG_URL,
								IMG_LOCATION,
								CREATER,
								UPDATER
							) VALUES (
								".$c_product_idx.",
								'".$img_size."',
								'".$img_url."',
								'".$img_location."',
								'".$session_id."',
								'".$session_id."'
							)
						";
						
						$db->query($insert_img_sql);
					}
					/*
					for ($i=0; $i<count($upload_file); $i++) {
						$img_url = $img_location = $upload_file[$i]['url'];
						$img_location = "";
						if($upload_file[$i]['img_size'] == 'L'){
							$img_location = $upload_file[$i]['url'];
						} else{
							$img_location = $server_img_path.'/'.$upload_file[$i]['filename'];
						}
						
						$img_size = $upload_file[$i]['img_size'];
						
						$insert_img_sql = "
							INSERT INTO
								dev.COLLECTION_IMG
							(
								C_PRODUCT_IDX,
								IMG_SIZE,
								IMG_URL,
								IMG_LOCATION,
								CREATER,
								UPDATER
							) VALUES (
								".$c_product_idx.",
								'".$img_size."',
								'".$img_url."',
								'".$img_location."',
								'".$session_id."',
								'".$session_id."'
							)
						";
						
						$db->query($insert_img_sql);
					}
					*/
				}
			}
		}
		
		$db->commit();
		
		$json_result['code'] = 200;
		$json_result['msg'] = "컬렉션 상품 이미지 등록에 성공했습니다.";
	} catch(mysqli_sql_exception $exception){
		print_r($exception);
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "컬렉션 상품 이미지 등록에 실패했습니다.";
	}
}

function url_to_file_up_collection($ftp_dir,$server_img_path,$img_dir){
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

?>