<div class="content__card modal__view" style="margin: 0;">
	<input id="param" type="hidden" value="<?=$param?>">
	
		
	<div class="card__header">
		<h3>컬렉션 검색
			<a onclick="modal_close();" class="btn-close" style="float:right">
				<i class="xi-close"></i>
			</a>
		</h3>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<form id="frm-filter_project" action="display/posting/story/modal/project/list/get">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="IDX">
			
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			
			<input class="action" type="hidden" value="">
			<input class="country" type="hidden" name="country" value="">
			<input class="story_type" type="hidden" name="story_type" value="">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">컬렉션 이름</div>
					<div class="content__row">
						<input type="text" name="project_name" value="">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">컬렉션 설명</div>
					<div class="content__row">
						<input type="text" name="project_desc" value="">
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">컬렉션 타이틀</div>
				<div class="content__row">
					<input type="text" name="project_title" value="">
				</div>
			</div>
		</form>
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div toggle="hide"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getRelativeProjectList();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter_project','getRelativeProjectList');"><span>초기화</span></div>
					<div class="defult__color__btn" onClick="modal_close();"><span>취소</span></div>
				</div>
			</div>
		</div>

		<div class="content__card">
			<form id="frm-list_all">
				<div class="card__header">
					<h3>컬렉션 검색 결과</h3>
					<div class="drive--x"></div>
				</div>
				<div class="card__body">
					<div class="info__wrap " style="justify-content:space-between; align-items: center;">
						<div class="body__info--count">
							<div class="drive--left"></div>
							총 컬렉션 수 <font class="cnt_project_total info__count" >0</font>개 / 검색결과 <font class="cnt_project_result info__count" >0</font>개
						</div>
							
						<div class="content__row">
							<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
								<option value="CREATE_DATE|DESC">등록일 역순</option>
								<option value="CREATE_DATE|ASC" selected>등록일 순</option>
								<option value="PROJECT_NAME|DESC">컬렉션 이름 역순</option>
								<option value="PROJECT_NAME|ASC">컬렉션 이름 순</option>
								<option value="PROJECT_DESC|DESC">컬렉션 설명 역순</option>
								<option value="PROJECT_DESC|ASC">컬렉션 설명 순</option>
								<option value="PROJECT_TITLE|DESC">컬렉션 타이틀 역순</option>
								<option value="PROJECT_TITLE|ASC">컬렉션 타이틀 순</option>
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
							<TABLE>
								<colgroup>
									<col width="150px;">
									<col width="500px;">
									<col width="500px;">
									<col width="500px;">
									<col width="500px;">
									<col width="350px;">
									<col width="250px;">
									<col width="350px;">
									<col width="250px;">
								</colgroup>
								<THEAD>
									<TR>
										<TH>컬렉션 선택</TH>
										<TH>컬렉션 이름</TH>
										<TH>컬렉션 설명</TH>
										<TH>컬렉션 타이틀</TH>
										<TH>컬렉션 URL</TH>
										<TH>컬렉션 작성일</TH>
										<TH>컬렉션 작성자</TH>
										<TH>컬렉션 수정일</TH>
										<TH>컬렉션 수정자</TH>
									</TR>
								</THEAD>
								<TBODY id="result_table_project_modal">
									
								</TBODY>
							</TABLE>
						</div>
					</div>
					
					<div class="padding__wrap">
						<input type="hidden" class="total_cnt" paging_type="project" value="0" onChange="setPaging(this);">
						<input type="hidden" class="result_cnt" paging_type="project" value="0" onChange="setPaging(this);">
						<div class="paging"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg" style="display:block">
				<div class="defult__color__btn" style="margin:0 auto" onClick="modal_close();"><span>돌아가기</span></div>
			</div>
		</div>
	</div>
</div>



<script>
$(document).ready(function() {
	let frm = $('#frm-filter_project');
	
	let param = $('#param').val();
	let tmp_arr = param.split('_');
	
	frm.find('.action').val(tmp_arr[0]);
	frm.find('.country').val(tmp_arr[1]);
	frm.find('.story_type').val(tmp_arr[2]);
	
	getRelativeProjectList();
});


function getRelativeProjectList(){
	let frm = $('#frm-filter_project');
	
	let action = frm.find('.action').val();
	let country = frm.find('.country').val();
	let story_type = frm.find('.story_type').val();
	
	let result_table = $("#result_table_project_modal");
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD colspan="9" style="text-align:left;">';
	strDiv += '        조회 결과가 없습니다.';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents((frm),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			d.forEach(function(row) {
				let strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD style="text-align:center;">';
				strDiv += '        <div class="btn" onClick="addRelativeProject(' + row.page_idx + ');">';
				strDiv += '            컬렉션 선택';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.project_name + '</TD>';
				strDiv += '    <TD>' + row.project_desc + '</TD>';
				strDiv += '    <TD>' + row.project_title + '</TD>';
				strDiv += '    <TD>' + row.project_url + '</TD>';
				strDiv += '    <TD>' + row.create_date + '</TD>';
				strDiv += '    <TD>' + row.creater + '</TD>';
				strDiv += '    <TD>' + row.update_date + '</TD>';
				strDiv += '    <TD>' + row.updater + '</TD>';
				strDiv += '</TR>';
				
				result_table.append(strDiv);
			});
		},
	},rows, page);
}

function addRelativeProject(page_idx) {
	let frm = $('#frm-filter_project');
	
	let action = frm.find('.action').val();
	let country = frm.find('.country').val();
	let story_type = frm.find('.story_type').val();
	
	let parent_frm = $("#frm-" + action + "_" + country);
	parent_frm.find('.page_idx').val(page_idx);
	
	$.ajax({
		url: config.api + "display/posting/story/modal/project/get",
		type: "post",
		data: {
			'page_idx': page_idx,
		},
		dataType: "json",
		error: function() {
			alert('게시물 선택처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				let result_table = $("#result_table_" + action + "_project_" + country);
				
				result_table.html('');
				
				let data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						let strDiv = "";
						strDiv += '<TR>';
						strDiv += '    <TD>' + row.project_name + '</TD>';
						strDiv += '    <TD>' + row.project_desc + '</TD>';
						strDiv += '    <TD>' + row.project_title + '</TD>';
						strDiv += '    <TD>' + row.project_url + '</TD>';
						strDiv += '    <TD>' + row.create_date + '</TD>';
						strDiv += '    <TD>' + row.creater + '</TD>';
						strDiv += '    <TD>' + row.update_date + '</TD>';
						strDiv += '    <TD>' + row.updater + '</TD>';
						strDiv += '</TR>';
						
						result_table.append(strDiv);
					});
					
					modal_close();
				}
			} else {
				alert('게시물 선택처리에 실패했습니다. 선택하려는 게시물을 확인해주세요.');
			}
		}
	});
}

</script>