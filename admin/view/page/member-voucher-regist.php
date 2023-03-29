<style>
    .btn-close {
        float: right;
        color: '#000';
    }

    .rd__square.voucher_level {
        height: 0px;
    }
    .time__select{width:80px!important;}
</style>
<input type="hidden" id="price_unit" value="원">
<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between" style="gap:20px;">
            <div class="flex items-center" style="gap: 20px;">
                <h3>바우처 발행</h3>
            </div>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <form id="frm-regist" action="voucher/publish/add">
            <div class="content__wrap">
                <div class="content__title">쇼핑몰 국가</div>
                <div class="content__row" style="margin-right:20px;">
                    <select class="fSelect eSearch" name="country" style="width:163px;">
                        <option value="KR" selected>한국몰</option>
                        <option value="EN">영문몰</option>
                        <option value="CN">중국몰</option>
                    </select>
                </div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">바우처 이름</div>
                    <div class="content__row" style="margin-right:20px;">
                        <input type="text" name="voucher_name" value="">
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">바우처 코드</div>
                    <div class="content__row">
                        <input type="text" name="voucher_code" value="">
                    </div>
                </div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">온/오프 타입</div>
                    <div class="content__row">
                        <select class="fSelect eSearch" name="on_off_type" style="width:163px;">
                            <option value="" selected>온/오프 타입 선택</option>
                            <option value="ON">온라인</option>
                            <option value="OFF">오프라인</option>
                        </select>
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">바우처 타입</div>
                    <div class="content__row">
                        <select class="fSelect eSearch" name="voucher_type" style="width:163px;">
                            <option value="" selected>바우처 타입 선택</option>
                            <option value="LV">레벨별 발급</option>
                            <option value="MB">멤버별 발급</option>
                            <option value="OFF">오프라인</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">바우처 시작일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" id="issue_start_date"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="day" onChange="dateParamChange(this);">
								<select id="issue_start_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;시</span>
                                <select id="issue_start_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;분</span>
							</div>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">바우처 종료일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" id="issue_end_date"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="day" onChange="dateParamChange(this);">
								<select id="issue_end_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;시
                                <select id="issue_end_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;분
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">바우처 사용기간 유형</div>
                    <div class="content__row" style="margin-right:20px;">
                        <select class="fSelect eSearch" name="voucher_date_type" style="width:200px;"
                            onChange="changeVoucherDateType(this)">
                            <option value="" selected>사용기간 선택</option>
                            <option value="PRD">바우처 등록 후, N일간 사용가능</option>
                            <option value="FXD">지정한 기간내에만 가능</option>
                        </select>
                    </div>
                </div>
                <div class="half__box__wrap date__param__div PRD">
                    <div class="content__title">등록 후, 사용가능 일수</div>
                    <div class="content__row">
                        <input type="number" name="voucher_date_param" style="width:50px;"><span>일</span>
                    </div>
                </div>
            </div>
            <div class="content__wrap grid__half date__param__div FXD" >
				<div class="half__box__wrap">
					<div class="content__title">바우처 사용가능 시작일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" id="voucher_start_date"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="day" onChange="dateParamChange(this);">
								<select id="voucher_start_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;시</span>
                                <select id="voucher_start_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;분</span>
							</div>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">바우처 사용가능 종료일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" id="voucher_end_date"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="day" onChange="dateParamChange(this);">
								<select id="voucher_end_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;시</span>
                                <select id="voucher_end_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;분</span>
							</div>
						</div>
					</div>
				</div>
			</div>

            <div class="content__wrap">
                <div class="content__title">할인 유형</div>
                <div class="content__row">
                    <select class="fSelect eSearch" name="sale_type" style="width:163px;"
                        onChange="changeSaleTypeParamTitle(this)">
                        <option value="" selected>세일 유형 선택</option>
                        <option value="PER">전체가격의 비율</option>
                        <option value="PRC">고정 금액</option>
                    </select>
                </div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">
                        <p id="sale_type_param_title">할인 금액/비율</p>
                    </div>
                    <div class="content__row">
                        <input type="number" name="sale_price" value="" style="width:125px!important;">
                        <span id="sale_price_unit"></span>
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">최소 사용 금액</div>
                    <div class="content__row">
                        <input type="number" name="min_price" value="" style="width:125px!important;">
                        <span id="min_price_unit"></span>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">바우처적용 상품선택</div>
                <div class="content__row form-group" style="padding-left:0px!important;">
                    <label class="rd__square">
                        <input type="radio" name="except_product_flg" value="FALSE" checked>
                        <span>특정 상품</span>
                    </label>
                    <label class="rd__square">
                        <input type="radio" name="except_product_flg" value="TRUE">
                        <span>제외 상품</span>
                    </label>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title voucher_product">
                    <p>바우처적용 상품목록</p>
                    <button class="btn" onclick="moveVoucherProductModal(<?=$voucher_idx?>)">상품선택</button>
                </div>
                <div class="content__row">
                    <div class="table table__wrap">
                        <div class="overflow-x-auto">
                            <TABLE style="width:99%">
                                <thead>
                                    <tr>
                                        <TH style="width:3%;">삭제</TH>
                                        <TH style="width:3%;">상품<br>구분</TH>
                                        <TH>상품 코드</TH>
                                        <TH>상품명</TH>
                                        <TH style="width:8%;">판매가<br>(한국몰)</TH>
                                        <TH style="width:8%;">판매가<br>(영문몰)</TH>
                                        <TH style="width:8%;">판매가<br>(중국몰)</TH>
                                        <TH style="width:50px;">총 재고량</TH>
                                        <TH style="width:50px;">재고수량</TH>
                                        <TH style="width:50px;">판매수량</TH>
                                        <TH style="width:50px;">안전재고</TH>
                                    </tr>
                                </thead>
                                <tbody id="voucher_product_table">
                                    
                                </tbody>
                            </TABLE>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">상세 설명</div>
                <div class="content__row" style="height:120px!important">
                    <textarea name="description" value=""
                        style="height:100%;width:90%;border:solid 1px;resize:none;"></textarea>
                </div>
            </div>

            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">발행 멤버</div>
                    <div class="content__row form-group" style="padding-left:0px!important;">
                        <label class="rd__square voucher_level">
                            <input type="radio" name="member_level_flg" value="ALL" checked>
                            <span>전체</span>
                        </label>
                        <label class="rd__square voucher_level">
                            <input type="radio" name="member_level_flg" value="DML">
                            <span>특정 레벨 선택</span>
                        </label>
                    </div>
                    <div class="content__title"></div>
                    <div class="content_row">
                        <div class=" detail__member__level">
                            <div class="content__row form-group" style="padding-left:0px!important;">
<?php
						$get_member_level_sql = "
							SELECT
								IDX,
								TITLE
							FROM
								MEMBER_LEVEL
							WHERE
								DEL_FLG = FALSE
						";
						$db->query($get_member_level_sql);

						foreach($db->fetch() as $level_info){
?>		
                                <label>
                                    <input type="checkbox" name="member_level[]" value="<?=$level_info['IDX']?>">
                                    <span><?=$level_info['TITLE']?></span>
                                </label>     
<?php
						}
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card__footer">
        <div class="footer__btn__wrap" style="grid: none;">
            <div class="btn__wrap--lg">
                <div class="blue__color__btn" onClick="registVoucher()"><span>바우처 등록</span></div>
                <div class="defult__color__btn" onClick="returnVoucherPage()"><span>뒤로가기</span></div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    timeSelectSet();
    $('.date__param__div').hide();
    $('.detail__member__level').hide();
    $('#frm-regist').find('select[name="country"]').on('change', function () {
        var country = $(this).val();
        switch (country) {
            case 'KR':
                $('#price_unit').val('원');
                break;
            case 'EN':
                $('#price_unit').val('Doller');
                break;
            case 'CN':
                $('#price_unit').val('Doller');
                break;
        }
    })
    $('#frm-regist').find('select[name="on_off_type"]').on('change', function () {
        var on_off_type = $(this).val();
        var strOption = '';
        switch (on_off_type) {
            case 'ON':
                strOption = `
					<option value="LV">레벨별 바우처</option>
                    <option value="MB">멤버별 바우처</option>
				`;
                break;
            
			case 'OFF':
                strOption = `<option value="OFF">오프라인 바우처</option>`;
                break;
            
			case '':
                strOption = `<option value="">온-오프 타입을 선택해주세요</option>`;
                break;
        }
        $('select[name="voucher_type"]').html('')
        $('select[name="voucher_type"]').append(strOption);
    })
    $('input[name="member_level_flg"]').on('change', function () {
        var member_level_flg = $(this).val();
        if (member_level_flg == 'DML') {
            $('.detail__member__level').show();
        }
        else if (member_level_flg == 'ALL') {
            $('.detail__member__level').hide();
        }
    })
});

function dateParamChange(obj) {
	//content__date__picker
    let date_type = $(obj).attr('date_type');
    let parent_obj = $(obj).parent();

    let now_date = new Date();
    let now_gettime = now_date.getTime();
    let now_year = now_date.getFullYear();
    let now_month = (now_date.getMonth() + 1).toString().padStart(2,'0');
    let now_day = (now_date.getDate()).toString().padStart(2,'0');
    let now_hour = (now_date.getHours()).toString().padStart(2,'0');
    let now_minite = (now_date.getMinutes()).toString().padStart(2,'0');
    let now_date_str = `${now_year}-${now_month}-${now_day}`;
  
    switch(date_type){
        case 'day':
            if($(obj).val() < now_date_str){
                alert('과거시점으로 입력하실 수 없습니다.');
                $(obj).val(now_date_str);
				parent_obj.find('.time__select').val('');
                parent_obj.find('.time__select.hour').attr('disabled',false);
                parent_obj.find('.time__select.minite').attr('disabled',true);
                return false;
            }
            parent_obj.find('.time__select').val('');
            parent_obj.find('.time__select.hour').attr('disabled',false);
            parent_obj.find('.time__select.minite').attr('disabled',true);
            break;
        case 'hour':
            if(parent_obj.find('.date_param').val() + ' ' + $(obj).val() < now_date_str + ' ' + now_hour){
                alert('과거시점으로 입력하실 수 없습니다.');
                $(obj).val('');
                parent_obj.find('.time__select.minite').attr('disabled',true);
                return false;
            }
            parent_obj.find('.time__select.minite').val('');
            parent_obj.find('.time__select.minite').attr('disabled',false);
            break;
        case 'minite':
            if(parent_obj.find('.date_param').val() + ' ' + parent_obj.find('.time__select.hour').val() + ':' + $(obj).val() < now_date_str + ' ' + now_hour + ':' + now_minite){
                alert('과거시점으로 입력하실 수 없습니다.');
                $(obj).val('');
                return false;
            }
            break;
    }
}

function changeVoucherDateType(obj) {
    var date_param = $(obj).val();
    $('.date__param__div').show();
    if(date_param == 'FXD'){
        $('.date__param__div.PRD').hide();
    }
    
}

function changeSaleTypeParamTitle(obj) {
    var price_unit = $('#price_unit').val();
    switch ($(obj).val()) {
        case 'PER':
            $('#sale_type_param_title').text('할인 비율');
            $('#sale_price_unit').text('%');
            break;
        case 'PRC':
            $('#sale_type_param_title').text('할인 금액');
            $('#sale_price_unit').text(price_unit);
            break;
        default:
            $('#sale_type_param_title').text('할인 금액/비율');
            $('#sale_price_unit').text('');
            break;
    }
}
function registVoucher() {
    var voucher_name = $('#frm-regist').find('input[name="voucher_name"]').val();
    var voucher_code = $('#frm-regist').find('input[name="voucher_code"]').val();
    var on_off_type = $('#frm-regist').find('select[name="on_off_type"]').val();
    var voucher_type = $('#frm-regist').find('select[name="voucher_type"]').val();
    var voucher_date_type = $('#frm-regist').find('select[name="voucher_date_type"]').val();
    

    if (voucher_name.length == 0) {
        alert('바우처 명을 입력해주세요');
        return false;
    }

    if (voucher_code.length == 0) {
        alert('바우처 코드를 입력해주세요');
        return false;
    }

    if (on_off_type.length == 0) {
        alert('온-오프 타입을 선택해주세요');
        return false;
    }

    if (voucher_type.length == 0) {
        alert('바우처 타입을 선택해주세요');
        return false;
    }

    if (voucher_date_type.length == 0) {
        alert('바우처 사용기간 유형을 선택해주세요');
        return false;
    }

    confirm('바우처를 등록하시겠습니까?', function () {
        var formData = new FormData();
        formData = $("#frm-regist").serializeObject();

        var issue_start_date = '';
        if($('#issue_start_minite').val() == ''){
            alert('바우처 시작일을 입력해주세요');
            return false;
        }
        issue_start_date += $('#issue_start_date').val() + ' ';
        issue_start_date += $('#issue_start_hour').val() + ':';
        issue_start_date += $('#issue_start_minite').val()==''?'00':$('#issue_start_minite').val();

        var issue_end_date = '';
        if($('#issue_end_minite').val() == ''){
            alert('바우처 종료일을 입력해주세요');
            return false;
        }
        issue_end_date += $('#issue_end_date').val() + ' ';
        issue_end_date += $('#issue_end_hour').val() + ':';
        issue_end_date += $('#issue_end_minite').val()==''?'00':$('#issue_end_minite').val();
        
        var voucher_start_date = '';
        if($('#voucher_start_minite').val() == ''){
            alert('바우처 사용가능 시작일을 입력해주세요');
            return false;
        }
        voucher_start_date += $('#voucher_start_date').val() + ' ';
        voucher_start_date += $('#voucher_start_hour').val() + ':';
        voucher_start_date += $('#voucher_start_minite').val()==''?'00':$('#voucher_start_minite').val();

        var voucher_end_date = '';
        if($('#voucher_end_minite').val() == ''){
            alert('구매 종료일을 입력해주세요');
            return false;
        }
        voucher_end_date += $('#voucher_end_date').val() + ' ';
        voucher_end_date += $('#voucher_end_hour').val() + ':';
        voucher_end_date += $('#voucher_end_minite').val()==''?'00':$('#voucher_end_minite').val();

        if(issue_start_date > issue_end_date){
            alert('종료일을 시작일 이후로 지정해주세요');
            return false;
        }
        if(voucher_start_date > voucher_end_date){
            alert('종료일을 시작일 이후로 지정해주세요');
            return false;
        }
        formData.issue_start_date = issue_start_date;
        formData.issue_end_date = issue_end_date;
        formData.voucher_start_date = voucher_start_date;
        formData.voucher_end_date = voucher_end_date;
        
        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "voucher/publish/add",
            error: function () {
                alert('바우처 등록작업이 실패했습니다.');
            },
            success: function (d) {
                if (d.code == 200) {
                    alert('바우처 등록이 완료되었습니다.',function(){
                        location.href="/member/voucher";
                    });
                }
            }
        });
    })
}
function voucherProductDelete(obj){
    $(obj).parent().remove();
}
function moveVoucherProductModal(voucher_idx){
    modal('/add_product', `voucher_idx=${voucher_idx}`);
}
function returnVoucherPage() {
    confirm('바우처목록 창으로 돌아가시겠습니까?', function () {
        location.href = "/member/voucher";
    })
}

function timeSelectSet(){
	var hourOption = '<option value="">선택</option>';
    var miniteOption = '<option value="">선택</option>';
	
	for(var i = 0; i <= 24; i++){
		var hour_val = i.toString().padStart(2,'0');
		hourOption += `
			<option value='${hour_val}'>${hour_val}</option>
		`;
	}
	$('.hour').append(hourOption);

    for(var j = 0; j < 60; j++){
		var minite_val = j.toString().padStart(2,'0');
		miniteOption += `
			<option value='${minite_val}'>${minite_val}</option>
		`;
	}
	$('.minite').append(miniteOption);
}

</script>
