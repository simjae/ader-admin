<style>
.btn-close{float:right;color:'#000';}
.rd__square.voucher_level{height:0px;}
.content__title.voucher_product{text-align:center;}
.time__select{width:80px!important;}	
</style>

<?php
function getUrlParamter($url, $sch_tag)
{
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    return $query[$sch_tag];
}
$page_url = $_SERVER['REQUEST_URI'];
$voucher_idx = getUrlParamter($page_url, 'voucher_idx');
?>
<input type="hidden" id="price_unit">
<div class="content__card">
    <div class="card__header">
		<div class="flex justify-between" style="gap:20px;">
			<div class="flex items-center" style="gap: 20px;">
				<h3 id="modal_title">바우처 편집</h3>
			</div>
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
                        <div class="content__title">바우처 시작일</div>
                        <div class="content__row">
                            <div class="content__date__wrap">
                                <div class="content__date__picker">
                                    <input class="date_param" type="date" id="issue_start_date"
                                        class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
                                        date_type="entry" onChange="dateParamChange(this);">
                                    <select id="issue_start_hour" class="time__select hour" date_type="issue" onChange="dateParamChange(this);"></select>
                                    <span>&nbsp;시
                                    <input id="issue_start_minite" class="time__select minite" date_type="issue" onChange="dateParamChange(this);"></input>
                                    <span>&nbsp;분
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
                                        date_type="entry" onChange="dateParamChange(this);">
                                    <select id="issue_end_hour" class="time__select hour" date_type="issue" onChange="dateParamChange(this);"></select>
                                    <span>&nbsp;시
                                    <input id="issue_end_minite" class="time__select minite" date_type="issue" onChange="dateParamChange(this);"></input>
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
                            <div class="content__date__wrap">
                                <div class="content__date__picker">
                                    <input class="date_param" type="date" id="voucher_start_date"
                                        class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
                                        date_type="entry" onChange="dateParamChange(this);">
                                    <select id="voucher_start_hour" class="time__select hour" date_type="voucher" onChange="dateParamChange(this);"></select>
                                    <span>&nbsp;시
                                    <input id="voucher_start_minite" class="time__select minite" date_type="voucher" onChange="dateParamChange(this);"></input>
                                    <span>&nbsp;분
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
                                        date_type="entry" onChange="dateParamChange(this);">
                                    <select id="voucher_end_hour" class="time__select hour" date_type="voucher" onChange="dateParamChange(this);"></select>
                                    <span>&nbsp;시
                                    <input id="voucher_end_minite" class="time__select minite" date_type="voucher" onChange="dateParamChange(this);"></input>
                                    <span>&nbsp;분
                                </div>
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
                <div class="defult__color__btn" onClick="returnPublishVoucherPage()"><span>발행 바우처목록으로 돌아가기</span></div>
            </div>
        </div>
    </div> 
</div>

<script>
$(document).ready(function() {	
    var voucher_idx = $('#frm-update').find('input[name="voucher_idx"]').val();
    getVoucherInfo(voucher_idx);
    timeSelectSet();
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

                var issue_start_date_arr =  row.issue_start_date.split(' ');
				$('#issue_start_date').val(issue_start_date_arr[0]);
				$('#issue_start_hour').val(issue_start_date_arr[1].split(':')[0]).prop("selected",true);
				$('#issue_start_minite').val(issue_start_date_arr[1].split(':')[1]);

                var issue_end_date_arr =  row.issue_end_date.split(' ');
				$('#issue_end_date').val(issue_end_date_arr[0]);
				$('#issue_end_hour').val(issue_end_date_arr[1].split(':')[0]).prop("selected",true);
				$('#issue_end_minite').val(issue_end_date_arr[1].split(':')[1]);

                var voucher_start_date_arr =  row.voucher_start_date.split(' ');
				$('#voucher_start_date').val(voucher_start_date_arr[0]);
				$('#voucher_start_hour').val(voucher_start_date_arr[1].split(':')[0]).prop("selected",true);
				$('#voucher_start_minite').val(voucher_start_date_arr[1].split(':')[1]);

                var voucher_end_date_arr =  row.voucher_end_date.split(' ');
				$('#voucher_end_date').val(voucher_end_date_arr[0]);
				$('#voucher_end_hour').val(voucher_end_date_arr[1].split(':')[0]).prop("selected",true);
				$('#voucher_end_minite').val(voucher_end_date_arr[1].split(':')[1]);

                $('select[name="sale_type"]').val(row.sale_type).prop('selected',true);
                $('input[name="sale_price"]').val(row.sale_price);
                $('input[name="min_price"]').val(row.min_price);
                $('input[name="description"]').val(row.description);

                $(`input[name=except_product_flg]:input[value="${row.except_product_flg == '1'?'TRUE':'FALSE'}"]`).attr('checked',true);

                if(row.member_level == 'ALL'){
                    $('.detail__member__level').hide();
                    $('input[name="member_level_flg"]:input[value="ALL"]').attr('checked', true);
                }
                else{
                    $('.detail__member__level').show();
                    $('input[name="member_level_flg"]:input[value="DML"]').attr('checked', true);
                    if(row.member_level != null){
                        let member_level_arr = row.member_level.split(',');
                        member_level_arr.forEach(function(level_row){
                            $(`input[name="member_level[]"][value="${level_row}"]`).prop('checked',true);
                        })
                    }
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

                if(row.voucher_product != null && row.voucher_product.data.length > 0){
                    row.voucher_product.data.forEach(function(voucher_product_row){
                        let strDiv = "";

                        strDiv += '<TR>';
                        strDiv += `		<td onclick="voucherProductDelete(this)"><a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
                                            <input type="hidden" name="product_idx_list[]" value="${voucher_product_row.product_idx}">
                                        </td>`;
                        var product_type = "";
                        if (voucher_product_row.product_type == "B") {
                            product_type = "일반";
                        } else if (voucher_product_row.product_type == "S") {
                            product_type = "세트";
                        }
                        strDiv += '    <td>' + product_type + '</td>';
                        strDiv += '    <td>' + voucher_product_row.product_code + '</td>';

                        let background_url = "background-image:url('" + voucher_product_row.img_location + "');";
                        strDiv += '    <TD>';
                        strDiv += '        <div class="product__img__wrap">';
                        strDiv += '            <div class="product__img" style="' + background_url + '">';
                        strDiv += '            </div>';
                        strDiv += '            <div>';
                        strDiv += '                <p>' + voucher_product_row.product_name + '</p><br>';
                        strDiv += '                <p style="color:#EF5012">' + voucher_product_row.update_date + '</p>';
                        strDiv += '            </div>';
                        strDiv += '        </div>';
                        strDiv += '    </TD>';

                        let discount_kr = voucher_product_row.discount_kr;
                        strDiv += '    <td style="text-align: right;">';
                        if (discount_kr > 0) {
                            strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
                            strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + voucher_product_row.price_kr.toLocaleString('ko-KR') + "</span></br>";
                            strDiv += '        <span>' + voucher_product_row.sales_price_kr.toLocaleString('ko-KR') + "</span></br>";
                        } else {
                            if(voucher_product_row.price_kr != null){
                                strDiv += '        ' + voucher_product_row.price_kr.toLocaleString('ko-KR');
                            }
                        }
                        strDiv += '    </td>';

                        let discount_en = voucher_product_row.discount_en;
                        strDiv += '    <td style="text-align: right;">';
                        if (discount_en > 0) {
                            strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
                            strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + voucher_product_row.price_en.toLocaleString('ko-KR') + "</span></br>";
                            strDiv += '        <span>' + voucher_product_row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
                        } else {
                            if(voucher_product_row.price_en != null){
                                strDiv += '        ' + voucher_product_row.price_en.toLocaleString('ko-KR');
                            }
                        }
                        strDiv += '    </td>';

                        let discount_cn = voucher_product_row.discount_cn;
                        strDiv += '    <td style="text-align: right;">';
                        if (discount_cn > 0) {
                            strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
                            strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + voucher_product_row.price_cn.toLocaleString('ko-KR') + "</span></br>";
                            strDiv += '        <span>' + voucher_product_row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
                        } else {
                            if(voucher_product_row.price_cn != null){
                                strDiv += '        ' + voucher_product_row.price_cn.toLocaleString('ko-KR');
                            }
                        }
                        strDiv += '    </td>';

                        let stock_qty = voucher_product_row.stock_qty;
                        let order_qty = voucher_product_row.order_qty;
                        let safe_qty = voucher_product_row.safe_qty;

                        let product_qty = stock_qty - order_qty;

                        strDiv += '    <TD style="width:50px;">' + product_qty + '</TD>';
                        strDiv += '    <TD style="width:50px;">' + stock_qty + '</TD>';
                        strDiv += '    <TD style="width:50px;">' + order_qty + '</TD>';
                        strDiv += '    <TD style="width:50px;">' + safe_qty + '</TD>';
                        strDiv += '</TR>';

                        $('#voucher_product_table').append(strDiv);
                    });
                }
                else{
                    strDiv = `
                        <TD class="default_td" colspan="11">
                            바우처적용 상품이 없습니다
                        </TD>
                    `;
                    $('#voucher_product_table').append(strDiv);
                }
            }
        }
    });
}
function updateVoucher(){
    confirm('바우처정보를 수정하시겠습니까?', function(){
        $('.date__param__area').find('select').prop('disabled', false);
        var formData = new FormData();
		formData = $("#frm-update").serializeObject();
        
        var issue_start_date = '';
        if($('#issue_start_date').val() == ''){
            alert('바우처 시작일을 입력해주세요');
            return false;
        }
        issue_start_date += $('#issue_start_date').val() + ' ';
        issue_start_date += $('#issue_start_hour').val() + ':';
        issue_start_date += $('#issue_start_minite').val()==''?'00':$('#issue_start_minite').val();

        var issue_end_date = '';
        if($('#issue_end_date').val() == ''){
            alert('바우처 종료일을 입력해주세요');
            return false;
        }
        issue_end_date += $('#issue_end_date').val() + ' ';
        issue_end_date += $('#issue_end_hour').val() + ':';
        issue_end_date += $('#issue_end_minite').val()==''?'00':$('#issue_end_minite').val();

        var voucher_start_date = '';
        if($('#voucher_start_date').val() == ''){
            alert('바우처 사용가능 시작일을 입력해주세요');
            return false;
        }
        voucher_start_date += $('#voucher_start_date').val() + ' ';
        voucher_start_date += $('#voucher_start_hour').val() + ':';
        voucher_start_date += $('#voucher_start_minite').val()==''?'00':$('#voucher_start_minite').val();

        var voucher_end_date = '';
        if($('#voucher_end_date').val() == ''){
            alert('구매 종료일을 입력해주세요');
            return false;
        }
        voucher_end_date += $('#voucher_end_date').val() + ' ';
        voucher_end_date += $('#voucher_end_hour').val() + ':';
        voucher_end_date += $('#voucher_end_minite').val()==''?'00':$('#voucher_end_minite').val();

        formData.issue_start_date = issue_start_date;
        formData.issue_end_date = issue_end_date;
        formData.voucher_start_date = voucher_start_date;
        formData.voucher_end_date = voucher_end_date;

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
                        location.href = 'http://116.124.128.246:81/member/voucher';
                    })
                }
            }
        });
    })
}
function timeSelectSet(){
    var hourOption = '<option value="">시</option>';
    
    for(var i = 0; i <= 24; i++){
        var hour_val = i.toString().padStart(2,'0');
        hourOption += `
            <option value='${hour_val}'>${hour_val}</option>
        `;
    }
    $('.hour').append(hourOption);
}
function voucherProductDelete(obj){
	$(obj).parent().remove();
}
function moveVoucherProductModal(voucher_idx){
	modal('/add_product', `voucher_idx=${voucher_idx}`);
}
function returnPublishVoucherPage(){
    confirm('발행바우처 목록창으로 돌아가시겠습니까?', function(){
        location.href = 'http://116.124.128.246:81/member/voucher';
    })
}

</script>