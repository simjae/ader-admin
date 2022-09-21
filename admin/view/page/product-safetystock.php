<style>
	.flex__wrap{
		display: flex;
		justify-content: space-between;
	}
	.wrap__bg--wh {
		background-color: #fff;
		padding: 10px;
		margin: 10px 0;
	}
	.defult__btn{
		color: black;
		background-color: #fff;
		border-radius: 5px;
		text-align: center;
		padding:  5px;
		border: 1px solid #484848;
	}
	.search__btn{
		color: black;
		background-color: #11aba6;
		border-radius: 5px;
		text-align: center;
		padding:  5px;
		border: 1px solid #11aba6;
	}
	.delete__btn{
		background: red;
		margin: 10px 0;
		width: 80px;
		color: #fff;
		border-radius: 5px;
		padding: 5px;
	}
	.stock__modal__wrap{
		background-color: #000000bd;
		width: 100%;
		height: 100%;
		position: absolute;
		z-index: 100;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}
	.stock__modal{
		z-index: 10;
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		width: 60%;
  		height: 300px;
	}
</style>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>상품관리</li>
		<li>안전재고관리</li>
	</ul>
</div>

<div class="row">
	<div class="portlet" style="margin-top:20px;">
		<div class="title">
			<h1 id="tabTitle">안전 재고 관리</h1>
		</div>
		
		<div class="body">
			<div class="row">
				<TABLE class="list" style="font-size:0.7rem;">
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="10%">
						<col width="40%">
					</colgroup>
					<TBODY>
						<TR>
							<TD>검색 분류</TD>
							<TD colspan="3">
								<div class="row">
									<select class="fSelect eSearch" name="eField[]" style="width:163px;">
										<option value="product_name" selected="selected">상품명</option>
										<option value="eng_product_name">영문상품명</option>
										<option value="item_name">상품명(관리용)</option>
										<option value="purchase_prd_name">공급사 상품명</option>
										<option value="">--------------------</option>
										<option value="product_no">상품번호</option>
										<option value="product_code">상품코드</option>
										<option value="old_product_code">(구)상품코드</option>
										<option value="ma_product_code">자체 상품코드</option>
										<option value="item_code">품목코드</option>
										<option value="admin_item_code">자체 품목코드</option>
										<option value="">--------------------</option>
										<option value="Manufacturer">제조사</option>
										<option value="Supplier">공급사</option>
										<option value="Brand">브랜드</option>
										<option value="Trend">트렌드</option>
										<option value="Classification">자체분류</option>
										<option value="">--------------------</option>
										<option value="model_name">모델명</option>
										<option value="origin">원산지</option>
										<option value="Condition">상품상태</option>
										<option value="product_tag">상품 검색태그</option>
										<option value="product_weight">상품 전체중량</option>
										<option value="">--------------------</option>
										<option value="pm_memo">메모</option>
										<option value="ins_user">등록아이디</option>
									</select>
									
									<input type="text" value="" style="width:70%;">
									
									<button style="width:30px;height:30px;border:1px solid;background-color:#ffffff;">-</button>
									<button style="width:30px;height:30px;border:1px solid;background-color:#ffffff;">+</button>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>상품 분류</TD>
							<TD colspan="3">
								<div class="form-group">
									<label>
										<input type="checkbox" name="productTypeAll" value="">
										<span>전체 상품분류 보기</span>
									</label>
								</div>
								<div class="row form-group">
									<select class="fSelect category eCategory" id="eCategory1" depth="1" name="categorys[]" style="width:163px;">
										<option value="">- 대분류 선택 -</option>
										<option value="35">개인결제</option>
										<option value="64">NEW(Shop)</option>
										<option value="470">2022 S/S 슈즈 &amp; 가방</option>
										<option value="447">선물제안(전체보기/기프트에디션)</option>
										<option value="78">Collection</option>
										<option value="73">Editorial</option>
										<option value="170">콜라보레이션</option>
										<option value="75">Stockists</option>
										<option value="74">Press</option>
										<option value="108">Significant Home</option>
										<option value="266">Ghost Store</option>
										<option value="410">과거제품</option>
										<option value="524">새 상품분류</option>
									</select>

									<select class="fSelect category eCategory" id="eCategory2" depth="2" name="categorys[]" style="width:163px;">
										<option value="">- 중분류 선택 -</option>
									</select>

									<select class="fSelect category eCategory" id="eCategory3" depth="3" name="categorys[]" style="width:163px;">
										<option value="">- 소분류 선택 -</option>
									</select>

									<select class="fSelect category eCategory" id="eCategory4" depth="4" name="categorys[]" style="width:163px;">
										<option value="">- 상세분류 선택 -</option>
									</select>
									
									<label>
										<input type="checkbox" name="" value="">
										<span>하위분류 포함검색</span>
									</label>
									
									<label>
										<input type="checkbox" name="" value="">
										<span>분류 미등록 상품 검색</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>상품 등록일</TD>
							<TD colspan="3">
								<div class="row">
									<select class="fSelect category" name="date" style="width:163px;">
										<option value="regist">상품등록일</option>
										<option value="modify">상품최종수정일</option>
									</select>
									
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">오늘</button>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">3일</button>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">7일</button>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">1개월</button>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">3개월</button>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">1년</button>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">전체</button>
								
									<input type="date" name="registDate_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
									~
									<input type="date" name="registDate_to" placeholder="To" readonly style="width:150px;">
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>진열 상태</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input type="radio" name="displayStatus" value="" checked>
										<span>전체</span>
									</label>
									
									<label>
										<input type="radio" name="displayStatus" value="">
										<span>진열 함</span>
									</label>
									
									<label>
										<input type="radio" name="displayStatus" value="">
										<span>진열 안함</span>
									</label>
								</div>
							</TD>
							<TD>판매 상태</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input type="radio" name="saleStatus" value="" checked>
										<span>전체</span>
									</label>
									
									<label>
										<input type="radio" name="saleStatus" value="">
										<span>판매 함</span>
									</label>
									
									<label>
										<input type="radio" name="saleStatus" value="">
										<span>판매 안함</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR class="detail_hidden">
							<TD>재고 수량</TD>
							<TD colspan="3">
								<div class="row">
									<select class="fSelect" name="stockcount[]" style="width:163px;">
										<option value="stock">재고수량</option>
										<option value="warn">안전재고</option>
									</select>
									
									<input type="text" value="" style="width:50px;margin-right:5px;">개
									~
									<input type="text" value="" style="width:50px;margin-right:5px;">개
									
									<button style="width:30px;height:30px;border:1px solid;background-color:#ffffff;">-</button>
									<button style="width:30px;height:30px;border:1px solid;background-color:#ffffff;">+</button>
								</div>
							</TD>
						</TR>
						
						<TR class="detail_hidden">
							<TD>재고관리 등급</TD>
							<TD colspan="3">
								<div class="row form-group">
									<div class="row form-group">
										<label>
											<input type="radio" name="stockGrade" value="" checked>
											<span>전체</span>
										</label>
										
										<label>
											<input type="radio" name="stockGrade" value="">
											<span>일반 재고</span>
										</label>
										
										<label>
											<input type="radio" name="stockGrade" value="">
											<span>중요 재고</span>
										</label>
									</div>
								</div>
							</TD>
						</TR>
						
						<TR class="detail_hidden">
							<TD>품절 사용</TD>
							<TD colspan="3">
								<div class="row form-group">
									<label>
										<input type="radio" name="soldUse" value="" checked>
										<span>전체</span>
									</label>
									
									<label>
										<input type="radio" name="soldUse" value="">
										<span>사용 함</span>
									</label>
									
									<label>
										<input type="radio" name="soldUse" value="">
										<span>사용 안함</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR class="detail_hidden">
							<TD>품목 진열 상태</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input type="radio" name="soldDisplayStatus" value="" checked>
										<span>전체</span>
									</label>
									
									<label>
										<input type="radio" name="soldDisplayStatus" value="">
										<span>진열 함</span>
									</label>
									
									<label>
										<input type="radio" name="soldDisplayStatus" value="">
										<span>진열 안함</span>
									</label>
								</div>
							</TD>
							<TD>품목 판매 상태</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input type="radio" name="soldSaleStatus" value="" checked>
										<span>전체</span>
									</label>
									
									<label>
										<input type="radio" name="soldSaleStatus" value="">
										<span>판매 함</span>
									</label>
									
									<label>
										<input type="radio" name="soldSaleStatus" value="">
										<span>판매 안함</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR class="detail_hidden">
							<TD>상품 가격</TD>
							<TD colspan="3">
								<div class="row form-group">
									<select class="fSelect" name="price[]" style="width:163px;">
										<option value="product">판매가</option>
										<option value="custom">소비자가</option>
										<option value="buy">공급가</option>
									</select>
									
									<input type="text" value="" style="width:100px;margin-right:5px;">KRW
									 ~ 
									<input type="text" value="" style="width:100px;margin-right:5px;">KRW
									
									<button style="width:30px;height:30px;border:1px solid;background-color:#ffffff;">-</button>
									<button style="width:30px;height:30px;border:1px solid;background-color:#ffffff;">+</button>
								</div>
							</TD>
						</TR>
						
						<TR class="detail_hidden">
							<TD>상품 구분(해외통관)</TD>
							<TD colspan="3">
								<div class="form-group">
									<label>
										<input type="checkbox" name="unclassified" value="">
										<span>분류 미등록 상품 검색</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR class="detail_hidden">
							<TD>번역 상태</TD>
							<TD colspan="3">
								<select class="fSelect" name="translate" style="width:163px;">
									<option value="">- 번역상태 선택 -</option>
									<option value="F">미번역</option>
									<option value="T">번역완료</option>
								</select>
							</TD>
						</TR>
						<TR class="detail_hidden">
							<TD>제휴서비스</TD>
							<TD colspan="3">
								<select class="fSelect" name="service" style="width:163px;">
									<option value="">전체</option>
									<option value="F">미번역</option>
									<option value="T">번역완료</option>
								</select>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
				
				<div id="detail_toggle" toggle="hide" style="float:right;margin-top:10px;font-weight:800;cursor:pointer;">상세검색 열기</div>
			</div>
			
			<div class="row">
				<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;float:right">초기화</button>
				<button style="width:80px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;border-radius:5px;float:right;margin-right:10px;">검색</button>
			</div>
		</div>
	</div>
	
	<div class="portlet" style="margin-top:20px;">
		<div class="title">
			<h1 id="tabTitle">상품 목록</h1>
		</div>
		
		<div class="body">
			<div class="row">
				<div class="row form-group" style="margin-top:0px;padding-left:0px;">
					<label>
						[상품 총 <font style="color:#3971FF;font-weight:800;">5,643</font>개
						 / 
						 품목 총 <font style="color:#3971FF;font-weight:800;">1,710</font>개]
					</label>
					
					<select class="fSelect _bind_limit" name="limit" style="width:163px;float:right;">
						<option value="10">10개씩보기</option>
						<option value="20" selected="selected">20개씩보기</option>
						<option value="30">30개씩보기</option>
						<option value="50">50개씩보기</option>
						<option value="100">100개씩보기</option>
					</select>
					
					<select class="fSelect" name="orderby" style="width:163px;float:right;margin-right:10px;">
						<option value="regist_d" selected="selected">등록일 역순</option>
						<option value="regist_a">등록일 순</option>
						<option>---------------</option>
						<option value="modify_d">수정일 역순</option>
						<option value="modify_a">수정일 순</option>
						<option>---------------</option>
						<option value="name_d">상품명 역순</option>
						<option value="name_a">상품명 순</option>
						<option>---------------</option>
						<option value="price_d">판매가 역순</option>
						<option value="price_a">판매가 순</option>
						<option class="sort" disabled="disabled">---------------</option>
						<option value="sort_d" class="sort" disabled="disabled">진열 역순</option>
						<option value="sort_a" class="sort" disabled="disabled">진열 순</option>
					</select>
				</div>
				
				<div class="row" style="margin-top:10px;">
					<button id="stock__modal" style="width:120px;height:30px;border:1px solid;background-color:#ffffff;">재고관리 일괄설정</button>
					<button style="width:100px;height:30px;border:1px solid;background-color:#ffffff;">엑셀 다운로드</button>
					<button style="width:120px;height:30px;border:1px solid;background-color:#ffffff;">재고정보 업로드</button>
					
					<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;float:right">설정</button>
					<button style="width:50px;height:30px;border:1px solid;background-color:#444b59;color:#ffffff;float:right;margin-right:10px;">저장</button>
				</div>
				
				<div class="row">
					<TABLE class="list" style="font-size:0.7rem;">
						<THEAD>
							<TR>
								<TH style="width:5%;">No.</TH>
								<TH>상품명</TH>
								<TH style="width:5%;">총 재고량</TH>
								<TH style="width:5%;">묶음선택</TH>
								<TH style="width:3%;">
									<div class="row form-group">
										<label>
											<input type="checkbox" name="selectAll" value="">
											<span></span>
										</label>
									</div>
								</TH>
								<TH>품목명</TH>
								<TH style="width:8%;">재고관리 사용</TH>
								<TH style="width:8%;">재고관리 등급</TH>
								<TH style="width:8%;">수량체크 기준</TH>
								<TH style="width:5%;">재고수량</TH>
								<TH style="width:5%;">안전재고</TH>
								<TH style="width:5%;">품절표시</TH>
								<TH style="width:8%;">진열상태</TH>
								<TH style="width:8%;">판매상태</TH>
								<TH style="width:8%;">총 누적 판매량</TH>
							</TR>
						</THEAD>
						
						<TBODY>
							<TR>
								<TD>800</TD>
								<TD>
									<div class="row">
										<div style="width:30px;height:30px;border:1px solid #000000;margin-right:10px;"></div>
										<font style="text-decoration:underline;">박경희</font><br>
										(P0000LSL)
									</div>
								</TD>
								<TD>80</TD>
								<TD>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;font-size:0.5rem;">묶음선택</button>
								</TD>
								<TD>
									<div class="form-group">
										<label>
											<input type="checkbox" name="select">
											<span></span>
										</label>
									</div>
								</TD>
								<TD>
									EU36<br>
									(P0000LSF000A)
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabledControl eUseStock" name="use_stock[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">사용함</option>
										<option value="F">사용안함</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabled " name="stock_importance[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="A" selected="selected">일반재고</option>
										<option value="B">중요재고</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabled " name="stock_checking_type[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="B">결제기준</option>
										<option value="A" selected="selected">주문기준</option>
									</select>
								</TD>
								<TD>
									<input type="text" value="0">
								</TD>
								<TD>
									<input type="text" value="0">
								</TD>
								<TD>
									<div class="form-group">
										<label>
											<input type="checkbox" name="select" checked>
											<span></span>
										</label>
									</div>
								</TD>
								<TD>
									<select class="fSelect eStockValue" name="is_display[P0000LSF000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">진열함</option>
										<option value="F">진열안함</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue" name="is_selling[P0000LSF000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">판매함</option>
										<option value="F">판매안함</option>
									</select>
								</TD>
								<TD>8(8)</TD>
							</TR>
							
							<TR>
								<TD>800</TD>
								<TD>
									<div class="row">
										<div style="width:30px;height:30px;border:1px solid #000000;margin-right:10px;"></div>
										<font style="text-decoration:underline;">박경희</font><br>
										(P0000LSL)
									</div>
								</TD>
								<TD>80</TD>
								<TD>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;font-size:0.5rem;">묶음선택</button>
								</TD>
								<TD>
									<div class="form-group">
										<label>
											<input type="checkbox" name="select">
											<span></span>
										</label>
									</div>
								</TD>
								<TD>
									EU36<br>
									(P0000LSF000A)
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabledControl eUseStock" name="use_stock[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">사용함</option>
										<option value="F">사용안함</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabled " name="stock_importance[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="A" selected="selected">일반재고</option>
										<option value="B">중요재고</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabled " name="stock_checking_type[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="B">결제기준</option>
										<option value="A" selected="selected">주문기준</option>
									</select>
								</TD>
								<TD>
									<input type="text" value="0">
								</TD>
								<TD>
									<input type="text" value="0">
								</TD>
								<TD>
									<div class="form-group">
										<label>
											<input type="checkbox" name="select" checked>
											<span></span>
										</label>
									</div>
								</TD>
								<TD>
									<select class="fSelect eStockValue" name="is_display[P0000LSF000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">진열함</option>
										<option value="F">진열안함</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue" name="is_selling[P0000LSF000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">판매함</option>
										<option value="F">판매안함</option>
									</select>
								</TD>
								<TD>8(8)</TD>
							</TR>
							
							<TR>
								<TD>800</TD>
								<TD>
									<div class="row">
										<div style="width:30px;height:30px;border:1px solid #000000;margin-right:10px;"></div>
										<font style="text-decoration:underline;">박경희</font><br>
										(P0000LSL)
									</div>
								</TD>
								<TD>80</TD>
								<TD>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;font-size:0.5rem;">묶음선택</button>
								</TD>
								<TD>
									<div class="form-group">
										<label>
											<input type="checkbox" name="select">
											<span></span>
										</label>
									</div>
								</TD>
								<TD>
									EU36<br>
									(P0000LSF000A)
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabledControl eUseStock" name="use_stock[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">사용함</option>
										<option value="F">사용안함</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabled " name="stock_importance[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="A" selected="selected">일반재고</option>
										<option value="B">중요재고</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabled " name="stock_checking_type[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="B">결제기준</option>
										<option value="A" selected="selected">주문기준</option>
									</select>
								</TD>
								<TD>
									<input type="text" value="0">
								</TD>
								<TD>
									<input type="text" value="0">
								</TD>
								<TD>
									<div class="form-group">
										<label>
											<input type="checkbox" name="select" checked>
											<span></span>
										</label>
									</div>
								</TD>
								<TD>
									<select class="fSelect eStockValue" name="is_display[P0000LSF000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">진열함</option>
										<option value="F">진열안함</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue" name="is_selling[P0000LSF000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">판매함</option>
										<option value="F">판매안함</option>
									</select>
								</TD>
								<TD>8(8)</TD>
							</TR>
							
							<TR>
								<TD>800</TD>
								<TD>
									<div class="row">
										<div style="width:30px;height:30px;border:1px solid #000000;margin-right:10px;"></div>
										<font style="text-decoration:underline;">박경희</font><br>
										(P0000LSL)
									</div>
								</TD>
								<TD>80</TD>
								<TD>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;font-size:0.5rem;">묶음선택</button>
								</TD>
								<TD>
									<div class="form-group">
										<label>
											<input type="checkbox" name="select">
											<span></span>
										</label>
									</div>
								</TD>
								<TD>
									EU36<br>
									(P0000LSF000A)
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabledControl eUseStock" name="use_stock[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">사용함</option>
										<option value="F">사용안함</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabled " name="stock_importance[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="A" selected="selected">일반재고</option>
										<option value="B">중요재고</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabled " name="stock_checking_type[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="B">결제기준</option>
										<option value="A" selected="selected">주문기준</option>
									</select>
								</TD>
								<TD>
									<input type="text" value="0">
								</TD>
								<TD>
									<input type="text" value="0">
								</TD>
								<TD>
									<div class="form-group">
										<label>
											<input type="checkbox" name="select" checked>
											<span></span>
										</label>
									</div>
								</TD>
								<TD>
									<select class="fSelect eStockValue" name="is_display[P0000LSF000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">진열함</option>
										<option value="F">진열안함</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue" name="is_selling[P0000LSF000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">판매함</option>
										<option value="F">판매안함</option>
									</select>
								</TD>
								<TD>8(8)</TD>
							</TR>
							
							<TR>
								<TD>800</TD>
								<TD>
									<div class="row">
										<div style="width:30px;height:30px;border:1px solid #000000;margin-right:10px;"></div>
										<font style="text-decoration:underline;">박경희</font><br>
										(P0000LSL)
									</div>
								</TD>
								<TD>80</TD>
								<TD>
									<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;font-size:0.5rem;">묶음선택</button>
								</TD>
								<TD>
									<div class="form-group">
										<label>
											<input type="checkbox" name="select">
											<span></span>
										</label>
									</div>
								</TD>
								<TD>
									EU36<br>
									(P0000LSF000A)
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabledControl eUseStock" name="use_stock[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">사용함</option>
										<option value="F">사용안함</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabled " name="stock_importance[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="A" selected="selected">일반재고</option>
										<option value="B">중요재고</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue eStockValueDisabled " name="stock_checking_type[P0000LSL000A]" style="font-size:0.5rem;">
										<option value="B">결제기준</option>
										<option value="A" selected="selected">주문기준</option>
									</select>
								</TD>
								<TD>
									<input type="text" value="0">
								</TD>
								<TD>
									<input type="text" value="0">
								</TD>
								<TD>
									<div class="form-group">
										<label>
											<input type="checkbox" name="select" checked>
											<span></span>
										</label>
									</div>
								</TD>
								<TD>
									<select class="fSelect eStockValue" name="is_display[P0000LSF000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">진열함</option>
										<option value="F">진열안함</option>
									</select>
								</TD>
								<TD>
									<select class="fSelect eStockValue" name="is_selling[P0000LSF000A]" style="font-size:0.5rem;">
										<option value="T" selected="selected">판매함</option>
										<option value="F">판매안함</option>
									</select>
								</TD>
								<TD>8(8)</TD>
							</TR>
						</TBODY>
					</TABLE>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="stock__modal__wrap" style="display: none;">
	<div class="wrap__bg--wh stock__modal">
		<div class="flex__wrap"style="padding: 10px 0;">
			<h3>재고관리 일괄설정</h3>
			<i class="xi-close stock__modal__close"></i>
		</div>
		<TABLE class="list" style="min-width:0px;">
			<TR>
				<TD colspan="6">
					<div class="form-group">
						<label>
							<input id="stockCategoryAll" type="checkbox" name="stockCategoryAll" value="">
							<span>전체선택</span>
						</label>
					</div>
				</TD>
			</TR>
			<TR>
				<TD>	
					<div class="form-group">
						<label>
							<input type="checkbox" name="stockCategory" value="">
							<span>재고관리 사용</span>
						</label>
					</div>
					<div>
						<select class="fSelect eStockValue" name="is_selling[P0000LSF000A]" style="font-size:0.5rem;">
							<option value="T" selected="selected">사용함</option>
							<option value="F">사용안함</option>
						</select>
					</div>
				</TD>
				<TD>	
					<div class="form-group">
						<label>
							<input type="checkbox" name="stockCategory" value="">
							<span>재고관리 등급</span>
						</label>
					</div>
					<div>
						<select class="fSelect eStockValue" name="is_selling[P0000LSF000A]" style="font-size:0.5rem;">
							<option value="T" selected="selected">사용함</option>
							<option value="F">사용안함</option>
						</select>
					</div>
				</TD>
				<TD>	
					<div class="form-group">
						<label>
							<input type="checkbox" name="stockCategory" value="">
							<span>수량체크 기준</span>
						</label>
					</div>
					<div>
						<select class="fSelect eStockValue" name="is_selling[P0000LSF000A]" style="font-size:0.5rem;">
							<option value="T" selected="selected">주문기준</option>
							<option value="F">사용안함</option>
						</select>
					</div>
				</TD>
				<TD>	
					<div class="form-group">
						<label>
							<input type="checkbox" name="stockCategory" value="">
							<span>재고수량</span>
						</label>
					</div>
					<div>
						<input type="text" name="stockCnt">
					</div>
				</TD>
				<TD>	
					<div class="form-group">
						<label>
							<input type="checkbox" name="stockCategory" value="">
							<span>안전재고</span>
						</label>
					</div>
					<div>
						<input type="text" name="safetyStockCnt">
					</div>
				</TD>
				<TD>	
					<div class="form-group">
						<label>
							<input type="checkbox" name="stockCategory" value="">
							<span>품절기능</span>
						</label>
					</div>
					<div class="form-group">
						<label>
							<input type="checkbox" name="" value="">
							<span></span>
						</label>
					</div>
				</TD>
			</TR>
			<TR>
				<TH>
					<div class="form-group">
						<label>
							<input type="checkbox" name="stockCategory" value="">
							<span>판매여부</span>
						</label>
					</div>
				</TH>
				<TD colspan="5">
					<div class="form-group">
						<label>
							<input type="checkbox" name="sellStatusAll" value="">
							<span>전체</span>
						</label>
					</div>
					<div class="flex">
						<div class="form-group">
							<label>
								<input type="checkbox" name="sellStatus" value="">
								<span>한국어 쇼핑몰(한국어)</span>
							</label>
						</div>
						<div class="form-group">
							<label>
								<input type="checkbox" name="sellStatus" value="">
								<span>영문몰(영어)</span>
							</label>
						</div>
						<div class="form-group">
							<label>
								<input type="checkbox" name="sellStatus" value="">
								<span>중어몰(중국어(간체))</span>
							</label>
						</div>
					</div>
					<p>-판매할 쇼핑몰을 선택하세요.</p>
				</TD>
			</TR>
		</TABLE>
	</div>
</div>
<script>
$(document).ready(function() {	
	$('.detail_hidden').hide();
	
	$('#detail_toggle').click(function() {
		if ($(this).attr('toggle') == 'hide') {
			$(this).attr('toggle','show');
			$('#detail_toggle').text('상세검색 닫기');
		} else {
			$(this).attr('toggle','hide');
			$('#detail_toggle').text('상세검색 열기');
		}
		$('.detail_hidden').toggle();
	});
});

$(function(){
	$('#stock__modal').on('click',function(){
		$('.stock__modal__wrap').show();
	});
	$('.stock__modal__close').on('click',function(){
		$('.stock__modal__wrap').hide();
	});
	
	$("#stockCategoryAll").click(function() {
		if($("#stockCategoryAll").is(":checked")) {
			$("input[name=stockCategory]").prop("checked", true);
		}
		else{
			$("input[name=stockCategory]").prop("checked", false);
		} 
			
	});
	
	$("input[name=stockCategory]").click(function() {
		let total = $("input[name=stockCategory]").length;
		let checked = $("input[name=stockCategory]:checked").length;
		
		if(total != checked){
			$("#stockCategoryAll").prop("checked", false);
			
		}
		else{
			$("#stockCategoryAll").prop("checked", true); 
		} 
		clkBtn();	
	});
		
	});
	$(document).mouseup(function (e){
		let LayerPopup = $(".stock__modal");
		if(LayerPopup.has(e.target).length === 0){
			$(".stock__modal__wrap").hide();
		}
	});
	function clkBtn(){
		let chkArray = new Array();

		$("input[name='stockCategory']:checked").each(function() { 
		let tmpVal = $(this).val(); 
		chkArray.push(tmpVal);
		});

		if( chkArray.length < 1 ){
		alert("값을 선택해주시기 바랍니다.");
		return;
		}

		console.log(chkArray);
	}




</script>