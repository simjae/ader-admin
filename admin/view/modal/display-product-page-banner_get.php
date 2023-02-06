<style>
#seo{margin-top : 50px;}
.sub{margin-top : 10px;}
.tmp_container_BNR {
	margin-top:10px;display:flex;width:100%;flex-wrap:wrap;flex-direction:row;
}
.tmp_lib_banner {
	width: 230px;height: 20px;line-height: 10px;background-color: #140f82;border-radius: 5px;color: #ffffff;font-size: 0.5px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;padding: 5px;margin-right: 5px;margin-top: 5px;float: left;
	cursor: pointer;
}
.add_lib_banner_btn {
	width:100px;height:25px;text-align:center;padding:5px;barkground-color:#ffffff;border:1px solid #bfbfbf;
	cursor:pointer;
}
</style>
<div class="content__card" style="max-width:1000px;margin: 0;">
	<form id="frm-list_BNR" action="display/product/grid/lib/banner/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		
		<input type="hidden" class="rows" name="rows" value="5">
		<input type="hidden" class="page" name="page" value="1">
		
		<input class="banner_type" type="hidden" name="banner_type" value="">
		<input type="hidden" name="banner_idx" value="<?=$banner_idx?>">
		
		<div class="card__header">
			<div class="flex justify-between">
				<h3>배너 라이브러리 검색</h3>
				<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body" style="width:1000px;">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">배너 타이틀</div>
					<div class="content__row">
						<input class="banner_title" type="text" name="banner_title" style="width:90%;">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">배너 메모</div>
					<div class="content__row">
						<input class="banner_memo" type="text" name="banner_memo" style="width:90%;">
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div onclick="getLibraryBanner();"  class="blue__color__btn"><span>검색</span></div>
					<div onclick="modal_cancel();" class="defult__color__btn"><span>검색 취소</span></div>
					<div onclick="addLibraryBanner();"  class="blue__color__btn"><span>배너 추가</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>

<div class="content__card" style="max-width:1000px;">
	<input type="hidden" class="action_type" name="action_type">
	<input type="hidden" class="action_name" name="action_name">
	
	<div class="card__header">
		<h3>배너 라이브러리 검색 결과</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="info__wrap " style="justify-content:space-between; align-items: center;">
			<div class="body__info--count">
				<div class="drive--left"></div>
				총 배너 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
			</div>
				
			<div class="content__row">
				<select style="width:163px;float:right;margin-right:10px;" lib_type="BNR" onChange="orderChange(this);">
					<option value="CREATE_DATE|DESC" selected>등록일 역순</option>
					<option value="CREATE_DATE|ASC">등록일 순</option>
					<option value="PRODUCT_NAME|DESC">상품 이름 역순</option>
					<option value="PRODUCT_NAME|ASC">상품 이름 순</option>
					<option value="PRODUCT_CODE|DESC">상품 코드 역순</option>
					<option value="PRODUCT_CODE|ASC">상품 코드 순</option>
					<option value="PRODUCT_CODE|DESC">상품 재고 역순</option>
					<option value="PRODUCT_CODE|ASC">상품 재고 순</option>
				</select>
				<select name="rows" style="width:163px;margin-right:10px;float:right;" lib_type="BNR" onChange="rowsChange(this);">
					<option value="5" selected>5개씩보기</option>
					<option value="10">10개씩보기</option>
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
		
		<div class="tmp_container_BNR"></div>
		
		<div class="table table__wrap">
			<div class="overflow-x-auto">
				<TABLE id="excel_table">
					<THEAD>
						<TR>
							<TH>라이브러리 추가</TH>
							<TH style="width:5%;">No.</TH>
							<TH>배너 타이틀</TH>
							<TH>배너 썸네일</TH>
							<TH>배너 경로</TH>
							<TH style="width:8%;">배너 등록일</TH>
							<TH style="width:8%;">작성자</TH>
							<TH style="width:8%;">배너 갱신일</TH>
							<TH style="width:8%;">갱신자</TH>
						</TR>
					</THEAD>
					<TBODY class="result_table_BNR">
					</TBODY>
				</TABLE>
			</div>
		</div>
		
		<div class="padding__wrap">
			<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
			<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
			<div class="paging_BNR"></div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {	
	getLibraryBanner();
});

function getLibraryBanner() {
	let banner_type = $('#banner_type').val();
	$('.banner_type').val(banner_type);
	
	let result_table = $(".result_table_BNR");
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="10" style="text-align:left;">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var rows = $("#frm-list_BNR").find('.rows').val();
	var page = $("#frm-list_BNR").find('.page').val();
	
	get_contents($("#frm-list_BNR"),{
		pageObj : $(".paging_BNR"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			let strDiv = "";
			d.forEach(function(row) {
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="add_lib_banner_btn" onClick="setLibraryBanner(' + row.banner_idx + ',\'' + row.banner_title + '\',\'' + row.banner_memo + '\')">라이브러리 추가</div>'
				strDiv += '    </TD>';
				strDiv += '    <TD style="width:5%;">' + row.num + '</TD>';
				strDiv += '    <TD>' + row.banner_title + '</TD>';
				
				var background_url = "background-image:url('" + row.banner_thumbnail + "');";
				strDiv += '    <TD>';
				strDiv += '        <div class="banner_thumbnail" style="width:100px;height:100px;border:1px solid #000000;' + background_url + '"></div>';
				strDiv += '    </TD>';
				
				strDiv += '    <TD>' + row.banner_location + '</TD>';
				strDiv += '    <TD>' + row.create_date + '</TD>';
				strDiv += '    <TD>' + row.creater + '</TD>';
				strDiv += '    <TD>' + row.update_date + '</TD>';
				strDiv += '    <TD>' + row.updater + '</TD>';
				strDiv += '</TR>';
			});
			
			result_table.append(strDiv);
		},
	},rows, page);
}

function checkLibraryBanner(banner_idx) {
	let check_result = false;
	let banner_idx_arr = [];
	let tmp_container = $('.tmp_container_BNR');
	
	let cnt = tmp_container.find('.tmp_lib_banner').length;
	for (let i=0; i<cnt; i++) {
		let tmp_banner_idx = parseInt(tmp_container.find('.tmp_lib_banner').eq(i).attr('banner_idx'));
		banner_idx_arr.push(tmp_banner_idx);
	}
	
	if (banner_idx_arr.length > 0) {
		let duplicate_check = banner_idx_arr.indexOf(banner_idx);
		if (duplicate_check < 0) {
			check_result = true;
		}
	} else {
		return true;
	}
	
	return check_result;
}

function setLibraryBanner(banner_idx,banner_title,banner_memo) {
	let check_result = checkLibraryBanner(banner_idx);
	
	if (check_result == true) {
		let strDiv = '<div class="tmp_lib_banner" banner_idx=' + banner_idx + '>' + banner_title + ' | ' + banner_memo + '</div>';
		$('.tmp_container_BNR').append(strDiv);
	} else {
		alert('중복된 배너는 선택할 수 없습니다.');
		return false;
	}
}

function addLibraryBanner(){
	let banner_type = $('#banner_type').val();
	let tmp_container = $('.tmp_container_BNR');
	
	let cnt = tmp_container.find('.tmp_lib_banner').length;
	let banner_idx = [];
	for (let i=0; i<cnt; i++) {
		let tmp_banner_idx = tmp_container.find('.tmp_lib_banner').eq(i).attr('banner_idx');
		banner_idx.push(tmp_banner_idx);
	}
	
	if (banner_idx.length > 0) {
		$.ajax({
			type: "post",
			url: config.api + "display/product/grid/lib/banner/get",
			data: {
				"banner_type" : banner_type,
				"banner_idx" : banner_idx
			},
			dataType: "json",
			error: function() {
				alert("라이브러리 배너 추가 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					let data = d.data;
					if (data != null) {
						$('.product-grid').html('');
						let productImgWrap = document.querySelector('.product-grid');
						
						let strDiv = "";
						data.forEach(function(row) {
							strDiv += '<img id="BANNER_' + banner_type + '_' + row.banner_idx + '" class="library" draggable="true" data-lib_type="BNR" data-banner_type="' + banner_type + '" data-banner_idx="' + row.banner_idx + '" data-product_idx="0" data-product_code="-" data-content_location="' + row.banner_location + '" src="' + row.banner_thumbnail  + '" alt="">';
						});
						
						productImgWrap.innerHTML = strDiv;
						
						libraryDragStart();
						modal_close();
					}
				}
			}
		});
	} else {
		alert('최소 1개 이상의 배너를 선택해야 합니다');
		return false;
	}
}
</script>