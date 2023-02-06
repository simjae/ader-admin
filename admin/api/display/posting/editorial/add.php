<?php
/*
 +=============================================================================
 | 
 | 에디토리얼 관리 페이지 - 에디토리얼 썸네일/컨텐츠 등록
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$page_idx			= $_POST['page_idx'];
$ftp_dir			= $_POST['ftp_dir'];

if ($page_idx != null && $ftp_dir != null) {
	$img_ext_arr = array('gif','png','jpg','jpeg');
	$vid_ext_arr = array('mp4','mov','wmv','avi','mkv');
	
	$tmp_arr = explode("/",$ftp_dir);
	$editorial_dir = $tmp_arr[intval(count($tmp_arr) - 1)];
	
	$server_img_path = "/var/www/admin/www/images/posting/editorial/".$editorial_dir;
	$server_vid_path = "/var/www/admin/www/videos/posting/editorial/".$editorial_dir;

	try {
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
		
		$del_thmb_sql = "
			UPDATE
				dev.EDITORIAL_THUMB
			SET
				DEL_FLG = TRUE
			WHERE
				PAGE_IDX = ".$page_idx;
		$db->query($del_thmb_sql);

		$del_cnts_sql = "
			UPDATE
				dev.EDITORIAL_CONTENTS
			SET
				DEL_FLG = TRUE
			WHERE
				PAGE_IDX = ".$page_idx;

		$db->query($del_cnts_sql);

		$size_type = ['web','mobile'];
		$size_type_str = '';

		foreach($size_type as $size_type_val) {
			switch($size_type_val){
				case 'web':
					$size_type_str = 'W';
					break;
				case 'mobile':
					$size_type_str = 'M';
					break;
			}
			
			$ftp_thmb_file_path = $ftp_dir."/thumb/".$size_type_val;
			$ftp_thmb_file = ftp_nlist($conn,$ftp_thmb_file_path);
			if($ftp_thmb_file != null){
				sort($ftp_thmb_file);
			}
			
			$ftp_cnts_file_path = $ftp_dir."/contents/".$size_type_val;
			$ftp_cnts_file = ftp_nlist($conn,$ftp_cnts_file_path);
			if($ftp_cnts_file != null){
				sort($ftp_cnts_file);
			}
			if (empty($ftp_thmb_file) || empty($ftp_cnts_file)) {
				$json_result['code'] = 301;
				$json_result['msg'] = "업로드 하려는 파일이 존재하지 않습니다. 업로드 하려는 파일을 확인해주세요.";
				return $json_result;
			}
			if (count($ftp_thmb_file) != count($ftp_cnts_file)) {
				$json_result['code'] = 301;
				$json_result['msg'] = "에디토리얼 썸네일 파일과 컨텐츠 파일의 수가 일치하지 않습니다. FTP 서버 내의 파일을 확인해주세요.";
				return $json_result;
			}

			$display_num = 1;
			for ($i=0; $i<count($ftp_thmb_file); $i++) {
				$thmb_explode_arr = explode('.', $ftp_thmb_file[$i]);
				$thmb_ext = $thmb_explode_arr[count($thmb_explode_arr) - 1];
				
				$cnts_explode_arr = explode('.', $ftp_cnts_file[$i]);
				$cnts_ext = $cnts_explode_arr[count($cnts_explode_arr) - 1];
				
				if (in_array($thmb_ext,$img_ext_arr) || in_array($thmb_ext,$vid_ext_arr)) {
					
					$ftp_thmb_file_name = str_replace($ftp_thmb_file_path,'',$ftp_thmb_file[$i]);
					
					$server_dir = "";
					$thmb_type = "";
					if (in_array($thmb_ext,$img_ext_arr)) {
						$server_dir = $server_img_path;
						$thmb_type = "img";
					} else if (in_array($thmb_ext,$vid_ext_arr)) {
						$server_dir = $server_vid_path;
						$thmb_type = "vid";
					}
					
					//$tmp_file_name = $server_dir.$ftp_file_name;
					$tmp_file_name = $server_dir."/".$thmb_type."_".$editorial_dir."_THMB_".time().".".$thmb_ext;
					
					if(!is_dir($server_dir)) {
						@mkdir($server_dir,0777);
					}
					
					$thmb_url = "http://".$ftp_host.$ftp_dir."/thumb/".$size_type_val."/".$ftp_thmb_file_name;
					
					$thmb_ftp_file = file_get_contents($thmb_url);
					$res = file_put_contents($tmp_file_name,$thmb_ftp_file);

					if($res == true){
						$insert_thumb_sql = "
							INSERT INTO
								dev.EDITORIAL_THUMB
							(
								PAGE_IDX,
								DISPLAY_NUM,
								THUMB_TYPE,
								SIZE_TYPE,
								THUMB_LOCATION,
								THUMB_URL,
								CREATER,
								UPDATER
							) VALUES (
								".$page_idx.",
								".$display_num.",
								'".strtoupper($thmb_type)."',
								'".$size_type_str."',
								'".$tmp_file_name."',
								'".$thmb_url."',
								'".$session_id."',
								'".$session_id."'
							)
						";

						$db->query($insert_thumb_sql);
						
						$thumb_idx = $db->last_id();
						
						if (!empty($thumb_idx)) {
							if (in_array($cnts_ext,$img_ext_arr) || in_array($cnts_ext,$vid_ext_arr)) {
								$ftp_cnts_file_name = str_replace($ftp_cnts_file_path,'',$ftp_cnts_file[$i]);
								
								$server_dir = "";
								$cnts_type = "";
								if (in_array($cnts_ext,$img_ext_arr)) {
									$server_dir = $server_img_path;
									$cnts_type = "img";
								} else if (in_array($cnts_ext,$vid_ext_arr)) {
									$server_dir = $server_vid_path;
									$cnts_type = "vid";
								}
								
								//$tmp_file_name = $server_dir.$ftp_file_name;
								$tmp_file_name = $server_dir."/".$cnts_type."_".$editorial_dir."_CNTS_".time().".".$cnts_ext;
								
								if(!is_dir($server_dir)) {
									@mkdir($server_dir,0777);
								}
								
								$cnts_url = "http://".$ftp_host.$ftp_dir."/contents/".$size_type_val."/".$ftp_cnts_file_name;
								
								$cnts_ftp_file = file_get_contents($cnts_url);
								$res = file_put_contents($tmp_file_name,$cnts_ftp_file);
								if($res == true){
									$insert_contents_sql = "
										INSERT INTO
											dev.EDITORIAL_CONTENTS
										(
											PAGE_IDX,
											THUMB_IDX,
											CONTENTS_TYPE,
											SIZE_TYPE,
											CONTENTS_LOCATION,
											CONTENTS_URL,
											CREATER,
											UPDATER
										) VALUES (
											".$page_idx.",
											".$thumb_idx.",
											'".strtoupper($cnts_type)."',
											'".$size_type_str."',
											'".$tmp_file_name."',
											'".$cnts_url."',
											'".$session_id."',
											'".$session_id."'
										)
									";
									
									$db->query($insert_contents_sql);
									$contents_idx = $db->last_id();
									if (!empty($contents_idx)) {
										$display_num++;
										
									} else {
										$json_result['code'] = 301;
										$json_result['msg'] = "에디토리얼 컨텐츠 등록에 실패했습니다. 업로드 하려는 컨텐츠 이미지를 확인해주세요.";
										return $json_result;
									}
								}
							}
						} else {
							$json_result['code'] = 301;
							$json_result['msg'] = "에디토리얼 썸네일 등록에 실패했습니다. 업로드 하려는 썸네일 이미지를 확인해주세요.";
							return $json_result;
						}
					}
					else{
						$json_result['code'] = 301;
						$json_result['msg'] = "에디토리얼 썸네일/컨텐츠 파일등록에 실패했습니다. 업로드 하려는 썸네일 이미지를 확인해주세요.";
						return $json_result;
					}
				}
			}
		}
		
		ftp_close($conn);
		
		$db->commit();
		
		$json_result['code'] = 200;
		$json_result['msg'] = "에디토리얼 썸네일/컨텐츠 등록에 성공했습니다.";
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		print_r($exception);
		
		$json_result['code'] = 301;
		$json_result['msg'] = "에디토리얼 썸네일/컨텐츠 등록에 실패했습니다.";
	}
}

?>