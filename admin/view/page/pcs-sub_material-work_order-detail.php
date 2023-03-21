<style>
.left-side{display:none;}
</style>

<?php include_once("check.php"); ?>

<?php
function getUrlParamter($url, $sch_tag) {
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];
$sub_material_idx = getUrlParamter($page_url, 'sub_material_idx');

$get_img_location_sql = "

        SELECT
            REPLACE(WO_IMG_LOCATION,'/var/www/admin/www', '') AS WO_IMG_LOCATION
        FROM
            dev.SUB_MATERIAL_IMAGE
        WHERE
            SUB_MATERIAL_IDX = ".$sub_material_idx."
";

$db->query($get_img_location_sql);

$img_location = '';
foreach($db->fetch() as $data){
    $img_location = $data['WO_IMG_LOCATION'];
}
?>

<img src="<?=$img_location?>">