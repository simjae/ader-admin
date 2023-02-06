<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between" style="gap:20px;">
            <div class="flex items-center" style="gap: 20px;">
                <h3>스탠바이 응모 현황</h3>
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
            <h3>응모자 정보</h3>
        </div>
        <div class="drive--x"></div>
    </div>

    <div class="card__body">
        <div class="table table__wrap">
            <div class="overflow-x-auto">
                <table>
                <colgroup>
                        <col width="3%">
                        <col width="3%">
                        <col width="3%">
                        <col width="3%">

                        <col width="6%">
                        <col width="6%">
                        <col width="3%">
                        <col width="2%">
                        <col width="5%">

                        <col width="5%">
                        <col width="5%">
                        <col width="5%">
                        <col width="5%">
                        <col width="3%">

                        <col width="6%">
                        <col width="4%">
                        <col width="3%">
                        <col width="6%">
                        <col width="3%">

                        <col width="6%">
                        <col width="6%">
                        <col width="6%">
                        <col width="4%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>참여자</th>
                            <th>사이즈</th>
                            <th>응모한 날짜</th>
                            <th>구매 여부</th>

                            <th>주문 번호</th>
                            <th>주문 상품 번호</th>
                            <th>주문 상태</th>
                            <th>주문 수량</th>
                            <th>회원 연락처</th>

                            <th>회원 이메일</th>
                            <th>상품 가격</th>
                            <th>사용 포인트</th>
                            <th>할인 금액</th>
                            <th>배송비</th>

                            <th>총 결제금액</th>
                            <th>배송지</th>
                            <th>수령자</th>
                            <th>수령자 연락처</th>
                            <th>우편번호</th>

                            <th>지번 주소</th>
                            <th>도로명 주소</th>
                            <th>상세 주소</th>
                            <th>주문 메모</th>
                        </tr>
                    </thead>
                    <tbody id="standby_entry_detail_table">
                        <tr>
                            <td colspan="23">조회 결과가 없습니다</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
                $('#standby_entry_summary_table').html('');
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
                        console.log(entry_cnt);
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

                var entryDiv = '';
                standby_entry_arr.forEach(function(entry){
                    var order_info = null;
                    entryDiv = `
                        <tr>
                            <td>${entry.member_name}</td>
                            <td>${entry.option_name}</td>
                            <td>${entry.create_date.split(' ')[0]}</td>
                            <td>${(purchase_flg == false)?'미구매':'구매'}</td>
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
                    else{
                        entryDiv += `
                            <td colspan="19" style="text-align:left;">
                                주문 정보가 없습니다.
                            </td>
                        `;
                    }

                    $('#standby_entry_detail_table').append(entryDiv);
                })
                $('#standby_entry_summary_table').append(strDiv);

				
			} else {
				alert('스탠바이 등록에 실패했습니다.');
				return false;
			}
		}
	});
})
</script>