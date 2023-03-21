<style>
	.checked{background-color:#707070!important;color:#ffffff!important;}
	.unchecked{background-color:#ffffff!important;color:#000000!important;}
	.btn__gray{
		height: 20px;
		color: #fff;
		padding: 3.5px 20px;
		border-radius: 2px;
		background-color: #bfbfbf;
		cursor:pointer;
	}
</style>

<?php include_once("check.php"); ?>

<div class="content__card">
    <form id="frm-filter" action="pcs/wholesale/search/get">
        <input type="hidden" class="sort_type" name="sort_type" value="DESC">
        <input type="hidden" class="sort_value" name="sort_value" value="PRODUCT_CODE">
        <input type="hidden" class="rows" name="rows" value="5">
        <input type="hidden" class="page" name="page" value="1">
        <div class="card__header">
            <h3>상품 검색</h3>
            <div class="drive--x"></div>
        </div>
        <div class="card__body">
            <div class="content__wrap grid__half" >
                <div class="half__box__wrap">
                    <div class="content__title">상품 코드</div>
                    <div class="content__row">
                        <input type="text" id="product_code" name="product_code" value="" onkeyup="autoComplateProduct()">
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">상품명</div>
                    <div class="content__row">
                        <input type="text" id="product_name" name="product_name" value="" onkeyup="autoComplateProduct()">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="info__wrap " style="justify-content:space-between; align-items: center;">
        <div class="body__info--count">
            <div class="drive--left"></div>
            총 오더시트 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
        </div>
            
        <div class="content__row">
            <select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
                <option value="PRODUCT_CODE|DESC" selected>상품코드 역순</option>
                <option value="PRODUCT_CODE|ASC">상품코드 순</option>
                <option value="PRODUCT_NAME|DESC">상품명 역순</option>
                <option value="PRODUCT_NAME|ASC">상품명 순</option>
                <option value="CREATE_DATE|DESC">등록일 역순</option>
                <option value="CREATE_DATE|ASC">등록일 순</option>
                <option value="UPDATE_DATE|DESC">갱신일 역순</option>
                <option value="UPDATE_DATE|ASC">갱신일 순</option>
            </select>
            <select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
                <option value="5" selected>5개씩보기</option>
                <option value="10">10개씩보기</option>
                <option value="20">20개씩보기</option>
                <option value="30">30개씩보기</option>
                <option value="50">50개씩보기</option>
                <option value="100">100개씩보기</option>
            </select>
        </div>
    </div>
    <div class="table table__wrap">
        <div class="overflow-x-auto">
            <TABLE>
                <THEAD>
                    <TR>
                        <TH style="width:10%;">선택</TH>
                        <TH style="width:15%;">스타일코드</TH>
                        <TH style="width:10%;">색상코드</TH>
                        <TH style="width:20%;">상품코드</TH>
                        <TH style="width:20%;">상품명</TH>
                        <TH style="width:20%;">색상</TH>
                    </TR>
                </THEAD>
                <TBODY id="result_table">
                </TBODY>
            </TABLE>
        </div>
    </div>
    <div class="padding__wrap">
        <input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
        <input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
        <div class="paging"></div>
    </div>
</div>

<div class="content__card">
    <div class="card__header">
        <h3>홀세일 등록</h3>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">
                <div class="content__wrap grid__half" >
                    <div class="half__box__wrap">
                        <div class="content__title">국가</div>
                        <div class="content__row">
                            <div class="rd__block">
                                <input id="country" type="text" name="country" value="">
                            </div>
                        </div>
                    </div>
                    <div class="half__box__wrap">
                        <div class="content__title">바이어</div>
                        <div class="content__row">
                            <div class="rd__block">
                                <input id="buyer" type="text" name="buyer" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table table__wrap">
					<div class="overflow-x-auto">
                        <TABLE id="insert_table_wholesale_info">
							<THEAD>
								<TR>
									<TH style="width:12%">상품 코드</TH>
									<TH style="width:12%">홀세일 납기 예정일</TH>
									<TH style="width:12%">홀세일 납기 수량</TH>
									<TH style="width:40%">메모</TH>
								</TR>
							</THEAD>
							<TBODY id="update_table">
                                <TD class="default_td" colspan="4">
                                <input id="due_date_0" type="date" class="margin-bottom-6 dateParam" name="due_date[]" value="" onchange="dateParamChange(this)">
                                </TD>
							</TBODY>
						</TABLE>
                	</div>
                </div>
            </form>
        </div>
		<div class="flex justify-center">
			<button type="button"
				style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;"
				onClick="confirm('홀세일을 등록하시겠습니까?.','wholesaleRegist()');">홀세일등록</button>
		</div>
    </div>
</div>
<script>

$(document).ready(function() {
	autoComplateProduct();
});

function autoComplateProduct(){
    $("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="6">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
    
	get_contents($("#frm-filter"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			d.forEach(function(row) {
				var strDiv = '';
				strDiv = `
                        <tr>
                            <td>
                                <button type="button" class="btn__gray" onclick="addWholesaleRegistForm(${row.idx},'${row.product_code}')">선택
                                </button>
                            </td>
                            <td>${row.style_code}</td>
                            <td>${row.color_code}</td>
                            <td>${row.product_code}</td>
                            <td>${row.product_name}</td>
                            <td>${row.color}</td>
                        </tr>
				`;
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}
                        
function addWholesaleRegistForm(idx, code){
    var default_flg = $('#update_table').find('.default_td').length;

    if(default_flg > 0){
        $('#update_table').html('');
    }
    var row_cnt = $('#update_table').children().length;

    var strTr = `
        <TR>
            <TD>
                <input type="hidden" class="idxParam" name="ordersheet_idx[]" value="${idx}">
                <span class="codeParam">${code}</span>
            </TD>
            <TD>
                <input id="due_date_${row_cnt+1}" type="date" class="margin-bottom-6 dateParam" name="due_date[]" value="">
            </TD>
            <TD><input type="number" class="qtyParam" name="product_qty[]" value=""></TD>
            <TD><input type="text" name="memo[]" value=""></TD>
        </TR>
    `;

    $('#update_table').append(strTr);
    setDatePicker();
}

function dateParamChange(obj) {
	var param = $(obj).val();
	var param_date = new Date(param);

	var param_year = param_date.getFullYear();
	var param_month = ("0" + (1 + param_date.getMonth())).slice(-2);
	var param_day = ("0" + param_date.getDate()).slice(-2);

	var param_result = param_year + '-' + param_month + '-' + param_day;

	if(param_result < getToday()){
		alert('이전 날짜로 납기 예정일을 입력할 수 없습니다.');
		return false;
	}
}


function wholesaleRegist() {
	var country = $('#frm-regist').find('input[name=country]').val();
	if(country.length == 0){
		alert('등록하려는 홀세일의 국가를 입력해주세요');
		return false;
	}

	var buyer = $('#frm-regist').find('input[name=buyer]').val();
	if(buyer.length == 0){
		alert('등록하려는 홀세일의 바이어를 입력해주세요');
		return false;
	}

    var qty_date_cnt = 0;
    $('#update_table').find('.dateParam').each(function(index, item){
        var due_date = $(this).val().trim();
        if(due_date == ''){
            alert('납기예정일을 모두 입력해주세요');
            qty_date_cnt++;
            return false;
        }
        else if(due_date < getToday()){
            alert('이전 날짜로 납기 예정일을 입력할 수 없습니다.');
            qty_date_cnt++;
            return false;
        }
    });
    if(qty_date_cnt > 0){
        return false;
    }

    var qty_err_cnt = 0;
    $('#update_table').find('.qtyParam').each(function(index, item){
        var product_qty = $(this).val().trim();
        if(product_qty == ''){
            alert('납기예정수량을 모두 입력해주세요');
            qty_err_cnt++;
            return false;
        }
        else if(product_qty < 0){
            alert('홀세일 납기 수량은 0보다 작을 수 없습니다.');
            qty_err_cnt++;
            return false;
        }
    });
    if(qty_err_cnt > 0){
        return false;
    }

	var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pcs/wholesale/add",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("홀세일 작성 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('홀세일이 정상적으로 작성되었습니다.',function pageLocation() {
					location.href = '/pcs/wholesale/list';
				});
			}
		}
	});
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	autoComplateProduct();
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	autoComplateProduct();
}

function getToday(){
	var date = new Date();
	var year = date.getFullYear();
	var month = ("0" + (1 + date.getMonth())).slice(-2);
	var day = ("0" + date.getDate()).slice(-2);

	return year + '-' + month + '-' + day;
}

function setDatePicker(){
    $('.dateParam').datepicker({
      dateFormat: 'yy-mm-dd',
      monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
      dayNamesMin: ['일','월','화','수','목','금','토'],
      weekHeader: 'Wk',
      changeMonth: true, //월변경가능
      changeYear: true, //년변경가능
      yearRange:'1900:+10', // 연도 셀렉트 박스 범위(현재와 같으면 1988~현재년)
      showMonthAfterYear: true, //년 뒤에 월 표시
      autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
   });
}
</script>