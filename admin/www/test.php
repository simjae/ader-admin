<?php
require_once '../../_static/autoload.php';

echo "Func : getmicrotime()<br>\n result -> ";
$result = getmicrotime();
echo $result;
echo "<br>\n<br>\n";

echo "Func : order_number()<br>\n result -> ";
$result = order_number();
echo $result;
echo "<br>\n<br>\n";

echo "Func : tel_format(\"11133445566\")<br>\n result -> ";
$result = tel_format("11133445566");
echo $result;
echo "<br>\n<br>\n";

echo "Func : file_modified_timestamp(\"test.php\")<br>\n result -> ";
$result = file_modified_timestamp("test.php");
echo $result;
echo "<br>\n<br>\n";

echo "Func : is_phone_number(\"010-1234-1234\")<br>\n result -> ";
$result = is_phone_number("010-1234-1234");
echo $result ? 'true' : 'false';
echo "<br>\n<br>\n";

echo "Func : implode_quotes(array(\"give\", \"me\", \"quotes\"))<br>\n result -> ";
$result = implode_quotes(array("give", "me", "quotes"));
echo $result;
echo "<br>\n<br>\n";

echo "Func : implode2(\"give_me_quotes\"))<br>\n result -> ";
$result = implode2("give_me_quotes");
print_r($result);
echo "<br>\n<br>\n";

echo "Func : del_html(\"<font color=\"red\">test</font>\")<br>\n result -> ";
$result = del_html("<font color=\"red\">test</font>");
echo $result;
echo "<br>\n<br>\n";

echo "Func : addzero(1234)<br>\n result -> ";
$result = addzero(1234, 8);
echo $result;
echo "<br>\n<br>\n";

echo "Func : get_hostname(\"https://adererror.com\")<br>\n result -> ";
$result = get_hostname("https://adererror.com");
echo $result;
echo "<br>\n<br>\n";

echo "Func : check_posturl(\"https://adererror.com\")<br>\n result -> ";
$result = check_posturl("https://adererror.com");
echo $result ? 'Different Host' : 'Same Host';
echo "<br>\n<br>\n";

echo "Func : str_count(\"How many chars ¥aa\", true)<br>\n result -> ";
$result = str_count("How many chars ¥aa", true);
echo $result;
echo "<br>\n<br>\n";

echo "Func : strlen2(\"가나다\")<br>\n result -> ";
$result = strlen2("가나다");
echo $result;
echo "<br>\n<br>\n";
/*
echo "Func : curl(\"http://116.124.128.246/\", array('header'=> 'http'), array('data'=> test'))<br>\n result -> ";
$result = curl("http://116.124.128.246", array('header'=> 'http'), array('data'=> 'test'));
echo $result;
echo "<br>\n<br>\n";
*/
// file_up

echo "Func : file_del(\"test.txt\")<br>\n result -> ";
$result = file_del("test.txt");
echo $result;
echo "<br>\n<br>\n";

echo "Func : is_email(\"test@adererror.com\")<br>\n result -> ";
$result = is_email("test@adererror.com");
echo $result ? 'true' : 'false';
echo "<br>\n<br>\n";

// paging

// 메일 발송 동작 X
echo "Func : send_mail(\"testfrom@adererror.com\", \"testfrom\", \"testto@adererror.com\", \"testto\", \"TitleTest\", \"SubjectTest\")<br>\n result -> ";
$result = send_mail("testfrom@adererror.com", "testfrom", "testto@adererror.com", "testto", "TitleTest", "SubjectTest");
echo $result ? 'true' : 'false';
echo "<br>\n<br>\n";

// mailform

// term

// memberinfo

// unescape

// unescapeEX

// create_temp_password

// update_password

// arr ?
echo "Func : get_file_list(\"/var/www/admin/www/\")<br>\n result -> ";
$result = get_file_list("/var/www/admin/www/");
print_r($result);
echo "<br>\n<br>\n";

echo "Func : get_file_name(\"/var/www/admin/www/test.php\")<br>\n result -> ";
$result = get_file_name("/var/www/admin/www/test.php");
echo $result;
echo "<br>\n<br>\n";

// has_file ?
echo "Func : create_path(\"/var/www/admin/www/test_dir\")<br>\n";
//create_path("/var/www/admin/www/test_dir");
echo "<br>\n<br>\n";
/*
echo "Func : date_ago(\"2022-07-02 13:16:42\")<br>\n result -> ";
$result = date_ago("2025-07-02 00:00:00", null, 1); 
echo $result;
echo "<br>\n<br>\n";
*/
/*
echo "Func : xlstotime(\"05/07/2022 10:17\")<br>\n result -> ";
$result = xlstotime("05/07/2022 10:17");
echo $result;
echo "<br>\n<br>\n";
*/
?>