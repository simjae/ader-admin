<div class="content__card">
    <div class="card__header">
        <h3>프로젝트 선택</h3>
        <div class="drive--x"></div>
    </div>
    <div class="card__body" style="display:flg">
		<div class="container_PRJ container_PRJ_CN">
			<input class="project_idx" type="hidden" name="project_idx" value="0">
			
            <div>
                <div class="project__select__wrap">
                
                </div>
                <div class="btn__area">
                    <button class="btn" style="float:right;" onclick="addCollectionProject('CN')">새프로젝트 추가</button>
                </div>
            </div>
            <div class="project__data__wrap">
                <div class="table__wrap">
                    <table>
                        <tbody>
                            <tr>
                                <td style="width:15%;">프로젝트 명</td>
                                <td>
                                    <input class="project_name" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>프로젝트 설명</td>
                                <td>
                                    <input class="project_desc" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>프로젝트 제목</td>
                                <td>
                                    <input class="project_title" type="text" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>프로젝트 썸네일</td>
                                <td>
                                    <input class="thumb_location" type="text" value="">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
				<div style="display:flex;justify-content:space-between;">
                    <div class="btn__area">
                        <font style="font-size:12px;">썸네일 폴더 경로</font>
                        <input class="server_img_path" type="text" name="server_img_path" placeholder="/images/posting/thumbnail/" value=""></input>
                        
						<button class="btn check_thumb_btn" style="margin-left:15px;" chk-flg="false" onclick="checkThumbLocation('CN');">체크</button>
                        <button class="btn" onclick="putThumbLocation('CN');" style="margin-left:15px;">변경</button>
                    </div>
					
                    <div class="btn__area">
                        <button class="btn" onclick="putCollectionProject('CN')" style="float:right;">프로젝트 수정</button>
                        <button class="btn" onclick="deleteCollectionProject('CN')" style="float:right;margin-right:15px;">삭제하기</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content__card">
    <div class="card__header">
        <h3>컬렉션 이미지 등록</h3>
        <div class="drive--x"></div>
    </div>
    <div class="container_PRD">
        <div class="table__wrap">
			<table>
				<colgroup>
					<col style="width:3%;">
					<col style="width:4%;">
					<col style="width:auto;">
					<col style="width:7%;">
					<col style="width:150px;">
				</colgroup>
				<thead>
					<th>
						<div class="cb__color">
							<label>
								<input type="checkbox" class="select_all" country="CN" onClick="selectAllClick(this);">
								<span></span>
							</label>
						</div>
					</th>
					<th>No.</th>
					<th colspan="2">이미지</th>
					<th>관련상품</th>
				</thead>
				<tbody class="result_table_CN">
					<tr>
						<td class="default_td" style="text-align:left" colspan="5">
						프로젝트를 선택해주세요
						</td>
					</tr>
				</tbody>
			</table>
			
            <div style="display:flex; justify-content: space-between;margin-top:20px;">
                <div class="content__row">
                    <div class="btn" onclick="checkCollectionProductDisplayNum('CN','up')">            
                        <i class="xi-angle-up"></i>            
                        <span class="tooltip top">위로</span>       
                    </div>
                    <div class="btn" onclick="checkCollectionProductDisplayNum('CN','down')">            
                        <i class="xi-angle-down"></i>            
                        <span class="tooltip down">아래로</span>       
                    </div>
                </div>
				
                <div class="content__row">
                    <span style="width:50px" id="collection_img_cnt_CN"></span>
                    
					<input id="ftp_dir_CN" class="ftp_dir" type="text" style="width:300px;" placeholder="/ader_prod_img/posting/collection/CN">
					<button id="check_img_btn_CN" class="btn check_img_btn" chk-flg="false" onclick="checkImgLocation('CN')">체크</button>
					
                    <button class="btn" style="float:right;" onclick="addCollectionProduct('CN')">이미지 등록</button>
                    <button class="btn" style="float:right;" onclick="putCollectionProduct('CN')">수정하기</button>
                    <button class="btn" style="float:right;" onclick="deleteCollectionProduct('CN')">삭제</button>
                </div>
            </div>
        </div>
    </div>
	
</div>

<script>
$(document).ready(function(){
	getCollectionProjectList('CN');
});
</script>