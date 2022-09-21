<?php
/*
 +=============================================================================
 | 
 | 메일폼 내용 작성
 | -------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.08.21
 | 최종 수정일	: 2017.06.28
 | 버전		: 1.0
 | 설명		: (2015.8.21) 최초작성
 | 
 +=============================================================================
*/
$subject	= str_replace("'","\'",$_POST['subject']);
$subject	= str_replace('"','\"',$subject);
$contents	= str_replace("'","\'",$_POST['contents']);
$contents	= str_replace('"','\"',$contents);
$contents	= str_replace('\\\\','\\',$contents);
$status		= strtoupper(trim($_POST['status']));
$fromemail	= strtolower(trim($_POST['fromemail']));
$fromname	= trim($_POST['fromname']);
$title = db_get($_TABLE['SITE_MAIL_FORM'],'IDX='.$no,'TITLE');

if($status != 'Y') $status = 'N';

$query  = 'CONTENTS="'.$contents.'",SUBJECT="'.$subject.'",STATUS="'.$status.'",';
$query .= 'FROM_EMAIL="'.$fromemail.'",FROM_NAME="'.$fromname.'"';
$where = 'IDX='.$no;
$result = db_update($_TABLE['SITE_MAIL_FORM'],$query,$where);

if(!$result) $code = 500;
?>