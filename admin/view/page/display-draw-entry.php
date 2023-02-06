<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between" style="gap:20px;">
            <div class="flex items-center" style="gap: 20px;">
                <h3>드로우 응모 현황</h3>
            </div>
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
		$draw_idx = getUrlParamter($page_url, 'draw_idx');
        $option_idx = getUrlParamter($page_url, 'option_idx');
        $country = getUrlParamter($page_url, 'country');
		?>
		<input type="hidden" id="draw_idx" value="<?=$draw_idx?>">
        <input type="hidden" id="option_idx" value="<?=$option_idx?>">
        <input type="hidden" id="country" value="<?=$country?>">
        <div class="table table__wrap">
            <table>
                <colgroup>
                    <col style="width:25%">
                    <col style="width:15%">
                    <col style="width:15%">
                    <col style="width:15%">
                    <col style="width:10%">
                    <col style="width:10%">
                    <col style="width:10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>상품정보</th>
                        <th>바코드</소>
                        <th>옵션명</th>
                        <th>드로우 판매 수량</th>
                        <th>드로우 응모 인원수</th>
                        <th>드로우 당첨 인원수</th>
                        <th>드로우 구매 수량</th>
                    </tr>
                </thead>
                <tbody id="draw_entry_summary_table"></tbody>
            </table>
        </div>
    </div>
    <div class="card__header" style="margin-top:50px;">
        <div class="flex justify-between">
            <h3>상품 응모 정보</h3>
        </div>
        <div class="drive--x"></div>
    </div>

    <div class="card__body">
        <div class="content__wrap grid__half">
            <div class="half__box__wrap">
                <div class="content__title">드로우 시작일</div>
                <div class="content__row">
                    <p id="entry_start_date"></p>
                </div>
            </div>
            <div class="half__box__wrap">
                <div class="content__title">드로우 종료일</div>
                <div class="content__row">
                    <p id="entry_end_date"></p>
                </div>
            </div>
        </div>
        <div class="content__wrap">
            <div class="content__title">당첨일</div>
            <p id="announce_date"></p>
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
        <form id="frm-draw-entry-filter" action="order/draw/entry/get">
            <input type="hidden" name="draw_idx" value="<?=$draw_idx?>">
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
                        <input type="number" name="member_name" value=""
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
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">당첨 여부</div>
                    <div class="content__row">
                        <div class="rd__block">
                            <input id="prize_flg_all" type="radio" name="prize_flg" value="1" checked>
                            <label for="prize_flg_all">전체</label>

                            <input id="prize_flg_true" type="radio" name="prize_flg" value="1">
                            <label for="prize_flg_true">당첨</label>

                            <input id="prize_flg_false" type="radio" name="prize_flg" value="2">
                            <label for="prize_flg_false">미당첨</label>
                        </div>
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">응모한 날짜</div>
                    <div class="content__row">
                        <div class="content__date__wrap">
                            <div class="content__date__picker">
                                <input id="apply_end_date" class="date_param" type="date" name="apply_start_date"
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
            </div>
        </form>
    </div>

    <div class="card__footer">
        <div class="footer__btn__wrap">
            <div class="detail_toggle" toggle="hide"></div>
            <div class="btn__wrap--lg">
                <div class="blue__color__btn" onClick="getDrawEntryList();"><span>검색</span></div>
                <div class="defult__color__btn" ><span>초기화</span></div>
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
        <form id="frm-draw-entry-list">
            <div class="info__wrap " style="justify-content:space-between; align-items: center;">
                <div class="body__info--count">
                    <div class="drive--left"></div>
                    총 응모자 수 <font class="cnt_total info__count">0</font>명 / 검색결과 <font class="cnt_result info__count">0
                    </font>명
                </div>

                <div class="content__row">
                    <select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
                        <option value="CREATE_DATE|DESC">등록일 역순</option>
                        <option value="CREATE_DATE|ASC" selected>등록일 순</option>
                        <option value="PRODUCT_NAME|DESC">상품명 역순</option>
                        <option value="PRODUCT_NAME|ASC">상품명 순</option>
                    </select>
                    <select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
                        <option value="10" selected>10개씩보기</option>
                        <option value="20">20개씩보기</option>
                        <option value="30">30개씩보기</option>
                        <option value="50">50개씩보기</option>
                        <option value="100">100개씩보기</option>
                        <option value="200">200개씩보기</option>
                        <option value="300">300개씩보기</option>
                        <option value="500">500개씩보기</option>
                    </select>
                </div>
            </div>
            <div class="table table__wrap">
                <div class="overflow-x-auto">
                    <table style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th style="width:100px;">참여자</th>
                                <th style="width:100px;">응모한 날짜</th>
                                <th style="width:100px;">구매 여부</th>
                                <th style="width:100px;">당첨 여부</th>

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

                                <th style="width:100px;">배송지</th>
                                <th style="width:100px;">수령자</th>
                                <th style="width:200px;">수령자 연락처</th>
                                <th style="width:100px;">우편번호</th>
                                <th style="width:350px;">지번 주소</th>
                                <th style="width:350px;">도로명 주소</th>
                                <th style="width:350px;">상세 주소</th>
                                <th style="width:200px;">주문 메모</th>
                            </tr>
                        </thead>
                        <tbody id="draw_entry_detail_table">
                            <TR>
                                <TD colspan="23">
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
var draw_entry_arr = [];
$(document).ready(function(){
     
    var counrty = $('#country').val();
	var draw_idx = $('#draw_idx').val();
	var option_idx = $('#option_idx').val();

	$.ajax({
		url: config.api + "order/draw/entry/get",
		type: "post",
		data: {
			'draw_idx': draw_idx,
			'country': counrty,
            'param_option_idx' : option_idx
		},
		dataType: "json",
		error: function() {
			alert('프리오더 등록 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
                $('#draw_entry_summary_table').html('');
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
				
                var announce_date_arr =  rows.announce_date.split(' ');
				$('#announce_date').text(announce_date_arr[0]+'일 '+announce_date_arr[1].split(':')[0]+'시');
				
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
                        entry_cnt = 0;
                        order_cnt = 0;
                        prize_cnt = 0;
                        if(qty_data.entry_info != null && qty_data.entry_info.length > 0){
                            entry_cnt = qty_data.entry_info.length;

                            qty_data.entry_info.forEach(function(entry_data){
                                entry_data.option_name = qty_data.option_name;
                                draw_entry_arr.push(entry_data);
                                if(entry_data.order_idx > 0){
                                    order_cnt++;
                                }
                                if(entry_data.prize_flg == '1'){
                                    prize_cnt++;
                                }
                            })
                        }
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
                                <td>${prize_cnt}</td>
                                <td>${order_cnt}</td>
                            </tr>
                        `;
                        fist_chk = false;
                    })
                }
                strDiv += optionDiv;

                var entryDiv = '';
                getDrawEntryList();
                
                $('#draw_entry_summary_table').append(strDiv);

				
			} else {
				alert('프리오더 등록에 실패했습니다.');
				return false;
			}
		}
	});
})

function getDrawEntryList(){
	$("#draw_entry_detail_table").html('');
	
	var strDiv = `
				<TR>
					<TD colspan="23">
						조회 결과가 없습니다
					</TD>
				</TR>
	`;
	$("#draw_entry_detail_table").append(strDiv);
	
	var rows = $('#frm-draw-entry-filter').find('.rows').val();
	$('#frm-draw-entry-filter').find('.page').val(1);
	
	get_contents($("#frm-draw-entry-filter"),{
		pageObj : $("#frm-draw-entry-list").find(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#draw_entry_detail_table").html('');
			}
			d.forEach(function(entry) {
				var order_info = null;
                entryDiv = `
                    <tr>
                        <td>${entry.member_name}</td>
                        <td>${entry.option_name}</td>
                        <td>${entry.create_date != null ? entry.create_date.split(' ')[0] : ''}</td>
                `;

                if((entry.order_idx > 0) && (entry.order_info != null && entry.order_info.length > 0)){
                    order_info = entry.order_info[0];
                    entryDiv += `
                            <td>${order_info.order_code}</td>
                            <td>${order_info.order_product_code}</td>
                            <td>${order_info.status}</td>
                            <td>${order_info.product_qty}</td>
                            <td>${entry.member_mobile}</td>

                            <td>${entry.member_email}</td>
                            <td>${parseInt(order_info.price_product).toLocaleString('ko-KR')}원</td>
                            <td>${parseInt(order_info.price_mileage_point).toLocaleString('ko-KR')}원</td>
                            <td>${parseInt(order_info.price_discount).toLocaleString('ko-KR')}원</td>
                            <td>${parseInt(order_info.price_delivery).toLocaleString('ko-KR')}원</td>

                            <td>${parseInt(order_info.price_total).toLocaleString('ko-KR')}원</td>
                            <td>${order_info.to_place}</td>
                            <td>${order_info.to_name}</td>
                            <td>${order_info.to_mobile}</td>
                            <td>${order_info.to_zipcode}</td>
                            
                            <td>${order_info.to_lot_addr}</td>
                            <td>${order_info.to_road_addr}</td>
                            <td>${order_info.to_detail_addr}</td>
                            <td>${order_info.to_order_memo}</td>
                        </tr>
                    `;
                }
				$("#draw_entry_detail_table").append(strDiv);
			});
		},
	},rows,1);

}
</script>