<?php
/*
+=============================================================================
| 
| FAQ
| ---
|
| 최초 작성	: 양한빈
| 최초 작성일	: 2016.03.02
| 최종 수정일	: 2017.10.12
| 버전		: 1.0
| 설명		: 
| 
+=============================================================================
*/
define('ACCESS_ALLOW',false);
define('HELIX','site/faq');
$api_module = array('list','add','del','seq','category','category-add','category-del');
include '../../../controller/api.json.php';
?>