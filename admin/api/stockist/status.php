<?php

$status = db_get($_TABLE['STOCKIST'],'IDX='.$no,'STATUS');
$result = db_update($_TABLE['STOCKIST'],'STATUS="'.(($status == 'Y')?'N':'Y').'"','IDX='.$no);
if(!$result) $code = 500;
?>