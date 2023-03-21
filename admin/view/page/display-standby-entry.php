<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between" style="gap:20px;">
            <div class="flex items-center" style="gap: 20px;">
                <h3>스탠바이 응모 현황</h3>
            </div>
            <div type="button" class="btn" onclick="location.href='/display/standby'">뒤로 가기</div>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$standby_idx = getUrlParamter($page_url, 'standby_idx');
        $option_idx = getUrlParamter($page_url, 'option_idx');
        $country = getUrlParamter($page_url, 'country');
		?>
		<input type="hidden" id="standby_idx" value="<?=$standby_idx?>">
        <input type="hidden" id="option_idx" value="<?=$option_idx?>">
        <input type="hidden" id="country" value="<?=$country?>">
        
        <div class="table table__wrap">
            <div class="overflow-x-auto">
                <table>
                    <colgroup>
                        <col width="auto">
                        <col width="12%">
                        <col width="8%">
                        <col width="8%">
                        <col width="8%">
                        <col width="8%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>상품정보</th>
                            <th>바코드</th>
                            <th>옵션명</th>
                            <th>스탠바이 판매 수량</th>
                            <th>스탠바이 응모 인원수</th>
                            <th>스탠바이 구매 수량</th>
                        </tr>
                    </thead>
                    <tbody id="standby_entry_summary_table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between">
            <h3>스탠바이 응모 정보</h3>
        </div>
        <div class="drive--x"></div>
    </div>

    <div class="card__body">
        <div class="content__wrap grid__half">
            <div class="half__box__wrap">
                <div class="content__title">스탠바이 시작일</div>
                <div class="content__row">
                    <p id="entry_start_date"></p>
                </div>
            </div>
            <div class="half__box__wrap">
                <div class="content__title">스탠바이 종료일</div>
                <div class="content__row">
                    <p id="entry_end_date"></p>
                </div>
            </div>
        </div>

        <div class="content__wrap grid__half">
            <div class="half__box__wrap">
                <div class="content__title">구매 시작일</div>
                <div class="content__row">
                    <p id="purchase_start_date"></p>
                </div>
            </div>
            <div class="half__box__wrap">
                <div class="content__title">구매 종료일</div>
                <div class="content__row">
                    <p id="purchase_end_date"></p>
                </div>
            </div>
        </div>
        <div class="content__wrap grid__half">
            <div class="half__box__wrap">
                <div class="content__title">판매 가격</div>
                <div class="content__row">
                    <p id="sales_price_kr"></p>
                </div>
            </div>
            <div class="half__box__wrap">
                <div class="content__title">멤버 레벨</div>
                <div class="content__row">
                    <p id="member_level"></p>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between">
            <h3>응모자 검색</h3>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <form id="frm-standby-entry-filter" action="order/standby/entry/list/get">
            <input type="hidden" name="standby_idx" value="<?=$standby_idx?>">
            <input type="hidden" name="option_idx" value="<?=$option_idx?>">
            <input type="hidden" name="country" value="<?=$country?>">
            <input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
            <input type="hidden" class="sort_type" name="sort_type" value="DESC">
            <input type="hidden" class="rows" name="rows" value="20">
            <input type="hidden" class="page" name="page" value="1">
            <div claszs="body__info--count" style="display: block;margin:20px 0;">
                <div class="drive--left"></div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">참여자명</div>
                    <div class="content__row">
                        <input type="text" name="member_name" value=""
                            style="height:28px;border:solid 1px #bfbfbf;width:150px;margin-right:5px;">
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">구매 여부</div>
                    <div class="content__row">
                        <div class="rd__block">
                            <input id="purchase_flg_all" type="radio" name="purchase_flg" value="" checked>
                            <label for="purchase_flg_all">전체</label>

                            <input id="purchase_flg_true" type="radio" name="purchase_flg" value="TRUE">
                            <label for="purchase_flg_true">구매</label>

                            <input id="purchase_flg_false" type="radio" name="purchase_flg" value="FALSE">
                            <label for="purchase_flg_false">미구매</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">응모한 날짜</div>
                <div class="content__row">
                    <div class="content__date__wrap">
                        <div class="content__date__picker">
                            <input id="apply_start_date" class="date_param" type="date" name="apply_start_date"
                                class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
                                date_type="apply" onChange="">&nbsp;-&nbsp;
                        </div>
                        <div class="content__date__picker">
                            <input id="apply_end_date" class="date_param" type="date" name="apply_end_date"
                                class="margin-bottom-6" placeholder="To" readonly style="width:150px;"
                                date_type="apply" onChange="">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="detail_toggle" toggle="hide"></div>
            <div class="btn__wrap--lg">
                <div class="blue__color__btn" onClick="getStandbyEntryList();"><span>검색</span></div>
                <div class="defult__color__btn" onClick="init_fileter('frm-standby-entry-filter','getStandbyEntryList')"><span>초기화</span></div>
            </div>
        </div>
    </div>

    <div class="card__header" style="margin-top:50px;">
        <div class="flex justify-between">
            <h3>응모자 정보</h3>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <form id="frm-standby-entry-list">
            <div class="table table__wrap">
                <div class="table__filter">
                    <div class="filrer__wrap">
                        <div style="width: 140px;" class="filter__btn" onclick="excelDownload();">엑셀 다운로드</div>
                    </div>                                
                </div>
                <div class="overflow-x-auto">
                    <table style="table-layout: fixed;" id="excel_table">
                        <thead>
                            <tr>
                                <th style="width:100px;">참여자</th>
                                <th style="width:100px;">응모한 날짜</th>
                                <th style="width:100px;">구매 여부</th>

                                <th style="width:200px;">주문 번호</th>
                                <th style="width:200px;">주문 상품 번호</th>
                                <th style="width:100px;">주문 상태</th>
                                <th style="width:100px;">주문 수량</th>
                                <th style="width:200px;">회원 연락처</th>

                                <th style="width:200px;">회원 이메일</th>
                                <th style="width:200px;">상품 가격</th>
                                <th style="width:200px;">사용 포인트</th>
                                <th style="width:200px;">할인 금액</th>
                                <th style="width:200px;">배송비</th>

                                <th style="width:200px;">총 결제금액</th>
                                <th style="width:100px;">수령자</th>
                                <th style="width:200px;">수령자 연락처</th>
                                <th style="width:100px;">우편번호</th>

                                <th style="width:350px;">지번 주소</th>
                                <th style="width:350px;">도로명 주소</th>
                                <th style="width:350px;">상세 주소</th>
                                <th style="width:200px;">주문 메모</th>
                            </tr>
                        </thead>
                        <tbody id="standby_entry_detail_table">
                            <TR>
                                <TD class="default_td" colspan="23">
                                    조회 결과가 없습니다
                                </TD>
                            </TR>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
var standby_entry_arr = [];
$(document).ready(function(){
    var counrty = $('#country').val();
	var standby_idx = $('#standby_idx').val();
	var option_idx = $('#option_idx').val();

	$.ajax({
		url: config.api + "order/standby/entry/get",
		type: "post",
		data: {
			'standby_idx': standby_idx,
			'country': counrty,
            'param_option_idx' : option_idx
		},
		dataType: "json",
		error: function() {
			alert('스탠바이 등록 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
                $('#standby_entry_detail_table').html('');
				var rows = d.data[0];
                /*api추가 필요*/
                var member_level_Str = '';
                switch(rows.member_level){
                    case 'ALL':
                        member_level_Str = '전체';
                        break;
                    case '1':
                        member_level_Str = '일반';
                        break;
                    case '2':
                        member_level_Str = 'Ader Fmaily';
                        break;
                }
                /*           */
				$(`#member_level`).text(member_level_Str);
				$('#sales_price_kr').text(parseInt(rows.sales_price).toLocaleString('ko-KR') + '원');

				var entry_start_date_arr =  rows.entry_start_date.split(' ');
				$('#entry_start_date').text(entry_start_date_arr[0]+'일 '+entry_start_date_arr[1].split(':')[0]+'시');
				
				var entry_end_date_arr =  rows.entry_end_date.split(' ');
                $('#entry_end_date').text(entry_end_date_arr[0]+'일 '+entry_end_date_arr[1].split(':')[0]+'시');	
				
				var purchase_start_date_arr =  rows.purchase_start_date.split(' ');
                $('#purchase_start_date').text(purchase_start_date_arr[0]+'일 '+purchase_start_date_arr[1].split(':')[0]+'시');

				var purchase_end_date_arr =  rows.purchase_end_date.split(' ');
                $('#purchase_end_date').text(purchase_end_date_arr[0]+'일 '+purchase_end_date_arr[1].split(':')[0]+'시');
				
                if(rows.qty_info != null && rows.qty_info.length > 0){
                    var qty_rows = rows.qty_info;
                    var qty_cnt = rows.qty_info.length;
                    var strDiv = `
                        <tr>
                            <td rowspan="${qty_cnt}">
                                <p style="margin-bottom:5px;"></p>
                                <div class="product__img__wrap">
                                    <div class="product__img"
                                        style="background-image:url('${rows.img_location}');">
                                    </div>
                                    <span>
                                        <p>${rows.product_code}</p><br>
                                        <p>${rows.product_name}</p><br>
                                        <p>${parseInt(rows.sales_price).toLocaleString('ko-KR')} ₩</p><br>
                                        <p>Color : ${rows.color}</p><br>
                                    </span>
                                </div>
                            </td>
                    `;
                    var optionDiv = '';

                    qty_rows.forEach(function(qty_data, index){
                        console.log(qty_data);
                        entry_cnt = 0;
                        order_cnt = 0;
                        if(qty_data.entry_info != null && qty_data.entry_info.length > 0){
                            entry_cnt = qty_data.entry_info.length;

                            qty_data.entry_info.forEach(function(entry_data){
                                entry_data.option_name = qty_data.option_name;
                                standby_entry_arr.push(entry_data);
                                if(entry_data.order_idx > 0){
                                    order_cnt++;
                                }
                            })
                        }
                        console.log(order_cnt);
                        if(index == 0){
                            optionDiv += '';
                        }
                        else{
                            optionDiv += `
                            <tr>
                            `;
                        }
                        
                        optionDiv += `
                                <td>${qty_data.barcode}</td>
                                <td>${qty_data.option_name}</td>
                                <td>${qty_data.product_qty}</td>
                                <td>${entry_cnt}</td>
                                <td>${order_cnt}</td>
                            </tr>
                        `;
                        fist_chk = false;
                    })
                }
                strDiv += optionDiv;
                $('#standby_entry_summary_table').append(strDiv);

                getStandbyEntryList();
			} else {
				alert('스탠바이 등록에 실패했습니다.');
				return false;
			}
		}
	});
})

function getStandbyEntryList(){
	$("#standby_entry_detail_table").html('');
	
	var strDiv = `
				<TR>
					<TD colspan="23">
						조회 결과가 없습니다
					</TD>
				</TR>
	`;
	$("#standby_entry_detail_table").append(strDiv);
	var rows = $('#frm-standby-entry-filter').find('.rows').val();
	$('#frm-standby-entry-filter').find('.page').val(1);
	
	get_contents($("#frm-standby-entry-filter"),{
		pageObj : $("#frm-standby-entry-list").find(".paging"),
		html : function(d) {
            if(d != null){
                if (d.length > 0) {
                    $("#standby_entry_detail_table").html('');
                }
                d.forEach(function(row) {
                    strDiv = `
                        <tr>
                            <td>${row.member_name}</td>
                            <td>${row.create_date != null ? row.create_date.split(' ')[0] : ''}</td>
                            <td>${(row.purchase_flg == false)?'미구매':'구매'}</td>
                    `;
                    if(row.order_code > 0){
                        strDiv += `
                                <td>${row.order_code}</td>
                                <td>${row.product_code}</td>
                                <td>${row.order_status}</td>
                                <td>${row.product_qty}</td>
                                <td>${row.member_mobile}</td>

                                <td>${row.member_email}</td>
                                <td>${parseInt(row.price_product).toLocaleString('ko-KR')}원</td>
                                <td>${parseInt(row.price_mileage_point).toLocaleString('ko-KR')}원</td>
                                <td>${parseInt(row.price_discount).toLocaleString('ko-KR')}원</td>
                                <td>${parseInt(row.price_delivery).toLocaleString('ko-KR')}원</td>

                                <td>${parseInt(row.price_total).toLocaleString('ko-KR')}원</td>
                                <td>${row.to_name}</td>
                                <td>${row.to_mobile}</td>
                                <td>${row.to_zipcode}</td>
                                
                                <td>${row.to_lot_addr==null?'':row.to_lot_addr}</td>
                                <td>${row.to_road_addr==null?'':row.to_road_addr}</td>
                                <td>${row.to_detail_addr==null?'':row.to_detail_addr}</td>
                                <td>${row.to_order_memo==null?'':row.to_order_memo}</td>
                            </tr>
                        `;
                    }
                    else{
                        strDiv += `
                            <td colspan="21" style="text-align:left;">
                                주문 정보가 없습니다.
                            </td>
                        `;
                    }
                    $("#standby_entry_detail_table").append(strDiv);

                });
            }
		},
	},rows,1);
}

function excelDownload() {
	if ($('#standby_entry_detail_table').find('.default_td').length > 0) {
		alert('응모자가 없습니다.');
	} else {
		
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		sheet_name = "스텐바이 응모자 목록";
		file_name = "스텐바이 응모자_" + file_date;
		insertLog("전시관리 > 스텐바이", "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table'), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}

function init_fileter(frm_id, func_name){
	var formObj = $('#' + frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);
    formObj.find('.rd__block').find('input:radio[value=""]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=number]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	window[func_name]();
}
</script>