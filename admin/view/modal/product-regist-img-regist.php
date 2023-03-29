<div class="content__card update__modal">
	<h3>
		상품 이미지 순서설정
		<a onclick="modal_close();" class="btn-close" style="float:right">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body">
		<form id="frm-update" action="product/add">
			<input type="hidden" id="ordersheet_idx_arr" name="ordersheet_idx_arr" value="<?=$ordersheet_idx_arr?>">
			<div class="table__wrap" style="margin-top:10px;">
                <table style="margin-bottom:50px;">
                    <thead>
                        <tr>
                            <td>상품명</td>
                            <td>상품 코드</td>
                            <td>폴더 구성 여부</td>
                        </tr>
                    </thead>
                    <tbody>
<?php
    $default_url_path			= "/ader_prod_img/";
    $ordersheet_idx_arr	        = explode(',',$ordersheet_idx_arr);
    $host = '203.245.9.174';
    $user = 'aderwms';
    $password = 'bv1229';
    $dir = '';

    $conn = ftp_connect($host);

    if(!$conn){
        echo "error";
        exit;
    }

    $result = ftp_login($conn, $user, $password);

    if(!$result){
        echo "login error";
    }

    if(count($ordersheet_idx_arr) > 0){
        foreach($ordersheet_idx_arr as $ordersheet_idx){
            $product_code = '';
            $product_name = '';
            $get_product_info_sql = "
                SELECT
                    PRODUCT_CODE,
                    PRODUCT_NAME
                FROM
                    ORDERSHEET_MST
                WHERE 
                    IDX = '".$ordersheet_idx."'
            ";
            $db->query($get_product_info_sql);
            foreach($db->fetch() as $data){
                $product_code = $data['PRODUCT_CODE'];
                $product_name = $data['PRODUCT_NAME'];
            }
            $url_path = $default_url_path.$product_code;
            $contents = ftp_nlist($conn,$url_path);

            if(!empty($contents)){
?>
                        <tr>
                            <td><?=$product_name?></td>
                            <td><?=$product_code?></td>
                            <td><input type="hidden" name="exist_flg[]" value="true"><?="상품코드 폴더가 모두 존재합니다."?></td>
                        </tr>
<?php
            }
            else{
?>
                        <tr>
                            <td><?=$product_name?></td>
                            <td><?=$product_code?></td>
                            <td><input type="hidden" name="exist_flg[]" value="false"><?="상품코드 폴더가 존재하지 않습니다."?></td>
                        </tr>
<?php
            }
        }
    }
?>
                    </tbody>
                </table>
                <table id="thumbname_img_url_table" style="width:200px;margin-bottom:20px;">
                    <colgroup>
                        <col width="100px">
                    </colgroup>
                    <TR>
                        <TH>이미지 타입</TH>
                    </TR>
                    <tr>
                        <TD>
                            <input type="hidden" name="img_type[]" value="thumbnail_O">
                            <p class="type__name">썸네일-아웃핏</p>
                        </TD>
                    </tr>
                    <tr>
                        <TD>
                            <input type="hidden" name="img_type[]" value="thumbnail_P">
                            <p class="type__name">썸네일-상품</p>
                        </TD>
                    </tr>
                </table>
                <table id="img_url_table" style="width:250px;">
                    <colgroup>
                        <col width="100px">
                        <col width="140px">
                    </colgroup>
                    <TR>
                        <TH>순서변경</TH>
                        <TH>이미지 타입</TH>
                    </TR>
                    <TR>
                        <TD>
                            <div class="btn" onclick="displayNumCheck(this)" action_type="up">
                                <i class="xi-angle-up"></i>
                                <span class="tooltip top">위로</span>
                            </div>
                            <div class="btn" onclick="displayNumCheck(this)" action_type="down">
                                <i class="xi-angle-down"></i>
                                <span class="tooltip top">아래로</span>
                            </div>
                        </TD>
                        <TD>
                            <input type="hidden" name="img_type[]" value="outfit">
                            <p class="type__name">아웃풋</p>
                        </TD>
                    </TR>
                    <TR>
                        <TD>
                            <div class="btn" onclick="displayNumCheck(this)" action_type="up">
                                <i class="xi-angle-up"></i>
                                <span class="tooltip top">위로</span>
                            </div>
                            <div class="btn" onclick="displayNumCheck(this)" action_type="down">
                                <i class="xi-angle-down"></i>
                                <span class="tooltip top">아래로</span>
                            </div>
                        </TD>
                        <TD>
                            <input type="hidden" name="img_type[]" value="product">
                            <p class="type__name">상품</p>
                        </TD>
                    </TR>
                    <TR>
                        <TD>
                            <div class="btn" onclick="displayNumCheck(this)" action_type="up">
                                <i class="xi-angle-up"></i>
                                <span class="tooltip top">위로</span>
                            </div>
                            <div class="btn" onclick="displayNumCheck(this)" action_type="down">
                                <i class="xi-angle-down"></i>
                                <span class="tooltip top">아래로</span>
                            </div>
                        </TD>
                        <TD>
                            <input type="hidden" name="img_type[]" value="detail">
                            <p class="type__name">디테일</p>
                        </TD>
                    </TR>
                </table>
			</div>
		</form>
	</div>
	
	<div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="tmp" toggle="tmp"></div>
            <div class="btn__wrap--lg">
                <div  class="blue__color__btn" onclick="productUpdateCheck();"><span>독립몰상품 수정</span></div>
                <div class="defult__color__btn" onclick="modal_cancel();"><span>수정 취소</span></div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
});
function displayNumCheck(obj) {
	let action_type = $(obj).attr('action_type');
	var num = $(obj).closest('tr').index();


	if (action_type == "up") {
		if (num == 1) {
			alert('URL입력창 순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum('up',num);
		}
	} else if (action_type == "down") {
		if (num == 3) {
			alert('URL입력창 순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum('down',num);
		}
	}
}
function updateDisplayNum(action_type,num) {
	var sel_tr = $('#img_url_table').find('tr').eq(num);
	
	var move_tr = '';
	if(action_type == "up"){
		move_tr = $('#img_url_table').find('tr').eq(num-1);
	}
	else if(action_type == "down"){
		move_tr = $('#img_url_table').find('tr').eq(num+1);
	}

	var tmp_html = sel_tr.html();
	sel_tr.html(move_tr.html());
	move_tr.html(tmp_html);
}
function productUpdateCheck() {
    let imgFormData = new FormData();
    imgFormData = $('#frm-update').serializeObject();

    let warn_flg = false;
    let is_array = Array.isArray(imgFormData['exist_flg[]']);
    if(is_array){
        let exist_cnt = imgFormData['exist_flg[]'].length;

        for(let i = 0; i < exist_cnt; i++){
            if(imgFormData['exist_flg[]'][i] == 'false'){
                warn_flg = true;
            }
        }
    }
    else{
        if(imgFormData['exist_flg[]'] == 'false'){
            warn_flg = true;
        }
    }

    let wran_msg = '상품을 등록하시겠습니까?';
    if(warn_flg == true){
        wran_msg = '[FTP]내 상품코드 폴더&이미지가 없는 상품이 존재합니다.<br>상품을 등록하시겠습니까?';
    }

    confirm(wran_msg, function(){
        var formData = new FormData();
        formData = $("#frm-list").serializeObject();
        formData['img_type[]'] = imgFormData['img_type[]'];

        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "product/add",
            error: function() {
                closeLoadingWithMask();
                alert('독립몰 상품등록 처리에 실패했습니다.');
            },
            beforeSend: function(){
                loadingWithMask('/images/default/loading_img.gif')
            },
            success: function(d) {
                if(d.code == 200) {
                    closeLoadingWithMask();
                    insertLog("상품관리 > 독립몰 상품등록", '독립몰 상품등록', select_idx.length);
                    getOrdersheetTabInfo();
                    alert('독립몰 상품이 등록되었습니다.',function(){
                        modal_close();
                    });
                }
                else{
                    closeLoadingWithMask();
                    alert(d.msg);
                }
            }
        });
    })
}
</script>       
       
       