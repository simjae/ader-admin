<style>
.btn-close{float:right;color:'#000';}
.rd__square.voucher_level{height:0px;}
</style>
<input type="hidden" id="price_unit">
<div class="content__card">
    <div class="card__header">
		<div class="flex justify-between" style="gap:20px;">
			<div class="flex items-center" style="gap: 20px;">
				<h3 id="modal_title">바우처 편집</h3>
			</div>
            <a onclick="modal_close();" class="btn-close">
                <i class="xi-close"></i>
            </a>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
        <form id="frm-update" action="voucher/publish/put">
            <input name="voucher_idx" type="hidden" value='<?=$voucher_idx?>'>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">바우처 이름</div>
                    <div class="content__row" style="margin-right:20px;">
                        <p id="voucher_name"></p>
                    </div>
                </div>    
                <div class="half__box__wrap">
                    <div class="content__title">바우처 코드</div>
                    <div class="content__row">
                        <p id="voucher_code"></p>
                    </div>
                </div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">온/오프라인 타입</div>
                    <div class="content__row">
                        <p id="on_off_type_str"></p>
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">바우처 타입</div>
                    <div class="content__row">
                    <p id="voucher_type_str"></p>
                </div>
                </div>
            </div>
            <div class="date__param__area">
                <div class="content__wrap grid__half">
                    <div class="half__box__wrap">
                        <div class="content__title">바우처 발행 시작일</div>
                        <div class="content__row">
                            <div class="content__date__picker">
                                <input class="display_date" type="date" name="issue_start_date" date_type="issue" placeholder="From" readonly="" style="width:150px" onChange="dateParamChange(this)">
                            </div>
                        </div>
                    </div>
                    <div class="half__box__wrap">
                        <div class="content__title">바우처 발행 종료일</div>
                        <div class="content__row">
                            <div class="content__date__picker">
                                <input class="display_date" type="date" name="issue_end_date" date_type="issue" placeholder="To" readonly="" style="width:150px" onChange="dateParamChange(this)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content__wrap grid__half">
                    <div class="half__box__wrap">
                        <div class="content__title">바우처 사용기간 유형</div>
                        <div class="content__row" style="margin-right:20px;">
                            <select class="fSelect eSearch" name="voucher_date_type" style="width:200px;" onChange="changeVoucherDateType(this)">
                                <option value="" selected>세일 유형 선택</option>
                                <option value="PRD">바우처 등록 후, N일간 사용가능</option>
                                <option value="FXD">지정한 기간내에만 가능</option>
                            </select>
                        </div>
                    </div>
                    <div class="half__box__wrap date__param__div">
                        <div class="content__title">등록 후, 사용가능 일수</div>
                        <div class="content__row">
                            <input type="number" name="voucher_date_param"  style="width:50px;"><span>일</span>
                        </div>
                    </div>
                </div>
                <div class="content__wrap grid__half">
                    <div class="half__box__wrap">
                        <div class="content__title">바우처 사용가능 시작일</div>
                        <div class="content__row">
                            <div class="content__date__picker">
                                <input class="display_date" type="date" name="voucher_start_date" date_type="voucher" placeholder="From" readonly="" style="width:150px" onChange="dateParamChange(this)">
                            </div>
                        </div>
                    </div>
                    <div class="half__box__wrap">
                        <div class="content__title">바우처 사용가능 종료일</div>
                        <div class="content__row">
                            <div class="content__date__picker">
                                <input class="display_date" type="date" name="voucher_end_date" date_type="voucher" placeholder="To" readonly="" style="width:150px" onChange="dateParamChange(this)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">할인 유형</div>
                <div class="content__row">
                    <select class="fSelect eSearch" name="sale_type" style="width:163px;" onChange="changeSaleTypeParamTitle(this)">
                        <option value="" selected>세일 유형 선택</option>
                        <option value="PER">전체가격의 비율</option>
                        <option value="PRC">고정 금액</option>
                    </select>
                </div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">
                        <p id="sale_type_param_title">할인 금액/비율</p></div>
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
                <div class="content__title">상세 설명</div>
                <div class="content__row" style="height:120px!important">
                    <textarea name="description" value="" style="height:100%;width:90%;border:solid 1px;resize:none;"></textarea>
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
                                <label>
                                    <input type="checkbox" name="member_level[]" value="1">
                                    <span>일반회원</span>
                                </label>
                                <label>
                                    <input type="checkbox" name="member_level[]" value="2">
                                    <span>Ader Family</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">총 발행 수량</div>
                    <div class="content__row">
                        <p id="tot_issue_num"></p>
                    </div>
                </div>
            </div>
        </form>
	</div>
    <div class="card__footer">
        <div class="footer__btn__wrap" style="grid: none;">
            <div class="btn__wrap--lg">
            <div  class="blue__color__btn" onClick="updateVoucher()"><span>바우처 편집</span></div>
                <div class="defult__color__btn" onClick="cancelUpdateVoucher()"><span>편집 취소</span></div>
            </div>
        </div>
    </div> 
</div>

<script>
$(document).ready(function() {	
    var voucher_idx = $('#frm-update').find('input[name="voucher_idx"]').val();
    getVoucherInfo(voucher_idx);

    $('input[name="member_level_flg"]').on('change',function(){
        var member_level_flg = $(this).val();
        if(member_level_flg == 'DML'){
            $('.detail__member__level').show();
        }
        else if(member_level_flg == 'ALL'){
            $('.detail__member__level').hide();
        }
    })
});

function dateParamChange(obj) {
    var date_type = $(obj).attr('date_type');
	var sel_std_date = new Date($('input[name="' + date_type + '_start_date"]').val()).getTime();
	var sel_end_date = new Date($('input[name="' + date_type + '_end_date"]').val()).getTime();

	if(sel_std_date != NaN && sel_end_date != NaN){
		if(sel_std_date > sel_end_date ){
			alert('정확한 검색기간를 선택해주세요');
		}
	}
}

function changeVoucherDateType(obj){
    var date_param = $(obj).val();

    if(date_param == 'PRD'){
        $('.half__box__wrap.date__param__div').show();
    }
    else{
        $('.half__box__wrap.date__param__div').hide();
        $('input[name="voucher_date_param"]').val('');
    }
}

function changeSaleTypeParamTitle(obj){
    var price_unit = $('#price_unit').val();
    switch($(obj).val()){
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
function getVoucherInfo(idx){
    $.ajax({
        type: "post",
        data: {'voucher_idx': idx},
        dataType: "json",
        url: config.api + "voucher/publish/get",
        error: function() {
            alert('바우처 열람작업이 실패했습니다.');
        },
        success: function(d) {
            if(d.code == 200) {
                var row = d.data[0];

                var sale_type_title_str = '';
                var type_unit_str = '';
                var price_unit_str = '';

                var on_off_type_str = '';
                switch(row.on_off_type){
                    case 'ON':
                        on_off_type_str = '온라인';
                        break;
                    case 'OFF':
                        on_off_type_str = '오프라인';
                        break;
                }

                var vouchar_type_str = '';
                switch(row.voucher_type){
                    case 'MB':
                        vouchar_type_str = '회원별 바우처';
                        break;
                    case 'LV':
                        vouchar_type_str = '회원레벨별 바우처';
                        break;
                    case 'BR':
                        vouchar_type_str = '생일바우처';
                        $('.date__param__area').find('input[type="date"]').datepicker('disable').removeAttr('disabled');
                        $('.date__param__area').find('select').prop('disabled', true);
                        $('#modal_title').text('생일 바우처 편집');
                        break;
                    case 'OFF':
                        vouchar_type_str = '오프라인';
                        break;
                }

                switch(row.country){
                    case 'KR':
                        price_unit_str = '원';
                        break;
                    case 'EN':
                        price_unit_str = 'Dollar';
                        break;
                    case 'EN':
                        price_unit_str = 'Dollar';
                        break;
                }
                $('#price_unit').val(price_unit_str);
                if(row.sale_type != null){
                    if(row.sale_type == 'PER'){
                        sale_type_title_str = '할인 비율';
                        type_unit_str = '%';
                    }
                    else if(row.sale_type == 'PRC'){
                        sale_type_title_str = '할인 금액';
                        type_unit_str = price_unit_str;
                    }
                    $('#sale_type_param_title').text(sale_type_title_str);
                }
                $('#sale_price_unit').text(type_unit_str);
                $('#min_price_unit').text(price_unit_str);
                
                $('#voucher_name').text(row.voucher_name);
                $('#voucher_code').text(row.voucher_code);
                $('#on_off_type_str').text(on_off_type_str);
                $('#voucher_type_str').text(vouchar_type_str);
                $('input[name="issue_start_date"]').val(row.issue_start_date.split(' ')[0]);
                $('input[name="issue_end_date"]').val(row.issue_end_date.split(' ')[0]);
                $('input[name="voucher_start_date"]').val(row.voucher_start_date.split(' ')[0]);
                $('input[name="voucher_end_date"]').val(row.voucher_end_date.split(' ')[0]);
                $('select[name="sale_type"]').val(row.sale_type).prop('selected',true);
                $('input[name="sale_price"]').val(row.sale_price);
                $('input[name="min_price"]').val(row.min_price);
                $('input[name="description"]').val(row.description);

                if(row.member_level == 'ALL'){
                    $('.detail__member__level').hide();
                    $('input[name="member_level_flg"]:input[value="ALL"]').attr('checked', true);
                }
                else{
                    $('.detail__member__level').show();
                    $('input[name="member_level_flg"]:input[value="DML"]').attr('checked', true);
                    $(`input[name="member_level[]"][value="${row.member_level}"]`).prop('checked',true);
                }

                if(row.voucher_date_type == 'PRD'){
                    $('.half__box__wrap.date__param__div').show();
                }
                else{
                    $('.half__box__wrap.date__param__div').hide();
                }
                $('select[name="voucher_date_type"]').val(row.voucher_date_type).prop('selected', true);
                $('input[name="voucher_date_param"]').val(row.voucher_date_param);
                $('#tot_issue_num').text(row.tot_issue_num);
            }
        }
    });
}
function updateVoucher(){
    confirm('바우처정보를 수정하시겠습니까?', function(){
        $('.date__param__area').find('select').prop('disabled', false);
        var formData = new FormData();
		formData = $("#frm-update").serializeObject();
        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "voucher/publish/put",
            error: function() {
                alert('바우처 수정작업이 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('바우처가 정상적으로 수정되었습니다.', function(){
                        getPublishVoucherInfo();
                        modal_close();
                    })
                    //location.href="/member/voucher";
                }
            }
        });
    })
}

function cancelUpdateVoucher(){
    confirm('바우처목록 창으로 돌아가시겠습니까?', function(){
        modal_close();
    })
}

</script>