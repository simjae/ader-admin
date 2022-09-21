<?php
/*
 +=============================================================================
 | 
 | 환경 설정 저장 작성
 | ---------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015. 8.23
 | 최종 수정일	: 2015.12. 8 19:50 양한빈
 | 버전		: 1.0
 | 설명		: (2015.8.23) 최초작성
 | 
 +=============================================================================
*/
?>
<h1>기본 설정</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>환경설정</li>
		<li>기본 정보</li>
	</ul>
</div>
<div class="body">

	<div class="row">
		<div class="portlet">
			<div class="title">
				<h1><i class="xi-globus"></i>사이트 기본정보</h1>
			</div>
			<div class="body">
				<form name="frm1" id="frm1" action="/api/site/config/">
				<div class="form-group">
					<input type="text" name="SITE_TITLE" value="<?=$_CONFIG['SITE_TITLE']?>" class="form-control" title="상단타이틀">
					<label class="control-label">상단타이틀</label>
				</div>

				<div class="form-group hidden">
					<div class="form-row">
						<a class="btn btn-large blue">변경</a>
					</div>
					<label class="control-label">파비콘</label>
				</div>

				<div class="form-group">
					<input type="text" name="ADMIN_NAME" value="<?=$_CONFIG['ADMIN_NAME']?>" maxlength="15" class="form-control width-150" title="관리자명">
					<label class="control-label">사이트 관리자명</label>
				</div>

				<div class="form-group">
					<input type="text" name="ADMIN_EMAIL" value="<?=$_CONFIG['ADMIN_EMAIL']?>" class="form-control"  title="관리자 이메일">
					<label class="control-label">사이트 관리자 이메일</label>
				</div>

				<div class="form-group">
					<input type="text" name="ADMIN_TEL" value="<?=$_CONFIG['ADMIN_TEL']?>" class="form-control width-150" maxlength="13" title="관리자 연락처">
					<label class="control-label">사이트 관리자 연락처</label>
				</div>

				<div class="form-group">
					<input type="text" name="PRIVACY_NAME" value="<?=$_CONFIG['PRIVACY_NAME']?>"  class="form-control width-150" title="개인정보관리책임자">
					<label class="control-label">개인정보관리책임자</label>
				</div>

				<div class="form-group">
					<input type="text" name="PRIVACY_EMAIL" value="<?=$_CONFIG['PRIVACY_EMAIL']?>" class="form-control" title="개인정보관리책임자 이메일">
					<label class="control-label">개인정보관리책임자 이메일</label>
				</div>

				<div class="form-group">
					<input type="text" name="PRIVACY_TEL" value="<?=$_CONFIG['PRIVACY_TEL']?>" class="form-control width-150" maxlength="13" title="개인정보관리책임자 연락처">
					<label class="control-label">개인정보관리책임자 연락처</label>
				</div>

				<div class="form-group">
					<div class="switch">
						<input type="checkbox" name="MOBILEWEB" value="Y" <?=($_CONFIG['MOBILEWEB'])?'checked':''?>>
						<div class="switch-container">
							<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
						</div>
					</div>
					<label class="control-label">모바일웹 사용</label>
				</div>

				<div class="form-group">
					<input type="text" name="MOBILEURL" value="<?=$_CONFIG['MOBILEURL']?>" class="form-control" title="모바일웹 주소">
					<label class="control-label">모바일웹 주소</label>
				</div>

				</form>
			</div>

			<? //if(permit('siteconfig|common||modify')) { ?>
			<div class="footer">
				<a class="btn btn-large green" onclick="fn_submit($('#frm1'));"><i class="xi-check"></i> 저장</a>
				<a class="btn btn-large" onclick="frm1.reset();"><i class="xi-undo"></i> 이전값 초기화</a>
			</div>
			<? //} ?>

		</div>
	</div>

	<?php if($_CONFIG['MODULE']['shop'] && false) { ?>
	<div class="row">
		<!-- BEGIN PG결제사 정보 -->
		<div class="portlet white">
			<div class="title">
				<h1><i class="xi-cart"></i>PG전자결제 정보</h1>
			</div>
			<div class="body">
				<form name="frm3" id="frm3" action="modules/site/config/?m=pg">
					<div class="form-group">
						<label><input type="radio" name="PG" value="NONE" <?=($_CONFIG['PG']=='NONE')?'checked':''?>><span>사용 안함</span></label>
						<label><input type="radio" name="PG" value="IMPORT" <?=($_CONFIG['PG']=='IMPORT')?'checked':''?>><span>아임포트</span></label>
						<label><input type="radio" name="PG" value="KCP" <?=($_CONFIG['PG']=='KCP')?'checked':''?>><span>KCP</span></label>
						<label><input type="radio" name="PG" value="LGU" <?=($_CONFIG['PG']=='LGU')?'checked':''?>><span>LG U+</span></label>
						<label><input type="radio" name="PG" value="PAYPAL" <?=($_CONFIG['PG']=='PAYPAL')?'checked':''?>><span>페이팔</span></label>
						<label><input type="radio" name="PG" value="ALLTHEGATE" <?=($_CONFIG['PG']=='ALLTHEGATE')?'checked':''?>><span>올더게이트</span></label>
						<label><input type="radio" name="PG" value="INICIS" <?=($_CONFIG['PG']=='INICIS')?'checked':''?>><span>KG이니시스</span></label>
						<label><input type="radio" name="PG" value="KG" <?=($_CONFIG['PG']=='KG')?'checked':''?>><span>KG</span></label>
						<label class="control-label">PG사</label>
					</div>
					<div class="form-group">
						<input type="text" name="PG_ID" title="상점 아이디" value="<?=$_CONFIG['PG_ID']?>">
						<label class="control-label">상점 아이디</label>
					</div>

					<div class="form-group">
						<input type="text" name="PG_PW" class="form-control" title="상점 비밀번호">
						<label class="control-label">상점 비밀번호</label>
					</div>

					<div class="form-group">
						<input type="text" name="PG_KEYPW" class="form-control" maxlength="4" minlength="4" title="Key 비밀번호">
						<label class="control-label">Key 비밀번호</label>
					</div>

					<div class="form-group">
						<div class="switch">
							<input type="checkbox" name="PG_TESTMODE" value="Y" <?=($_CONFIG['PG_TESTMODE'])?'checked':''?>>
							<div class="switch-container">
								<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
							</div>
						</div>
						<label class="control-label">테스트 결제</label>
					</div>

					<div class="form-group">
						<label class="control-label">결제 수단</label>
						<div class="form-row">
							<?php for($i=0;$i<sizeof($_PG['PAYMETHOD']);$i++) { ?>
							<label><input type="checkbox" name="PAYMETHOD[]" value="<?=$_PG['PAYMETHOD'][$i]?>" <? if(strpos($_CONFIG['PG_PAYMETHOD'],','.$_PG['PAYMETHOD'][$i].',') > -1) echo 'checked';?>><span> <?=$_PG['PAYMETHOD'][$i]?></span></label>
							<?php } ?>
						</div>
					</div>

					<div class="form-group">
						<div class="switch">
							<input type="checkbox" name="PG_INTEREST" value="Y" <?=($_CONFIG['PG_INTEREST'])?'checked':''?>>
							<div class="switch-container">
								<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
							</div>
						</div>
						<div>
							<?php
							for($i=2;$i<=12;$i++) {
							?>
							<label><input type="checkbox" name="INTERESTSTR[]" value="<?=$i?>" <?php if(strpos($_CONFIG['PG_INTERESTSTR'],':'.$i.'개월') > -1) echo 'checked';?>><span><?=$i?> 개월</span></label>
							<?php
							}
							?>
						</div>
						<label class="control-label">무이자 할부</label>
					</div>

					<div class="form-group">
						<div class="switch">
							<input type="checkbox" name="PG_OCB" value="Y" <?=($_CONFIG['PG_OCB'])?'checked':''?>>
							<div class="switch-container">
								<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
							</div>
						</div>
						<label class="control-label">OK Cashbag 적립</label>
					</div>

					<div class="form-group">
						<div class="switch">
							<input type="checkbox" name="PG_CASHRECEIPE" value="Y" <?=($_CONFIG['PG_CASHRECEIPE'])?'checked':''?>>
							<div class="switch-container">
								<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
							</div>
						</div>
						<label class="control-label">현금영수증 발행</label>
					</div>

				</form>

			</div>
			<div class="footer">
				<a class="btn btn-large green" onclick="fn_submit($('#frm3'));"><i class="xi-check"></i> 저장</a>
				<a class="btn btn-large" onclick="frm3.reset();"><i class="xi-undo"></i> 이전값 초기화</a>
			</div>
		<!-- END PG결제사 정보 -->


		</div><!-- // <div class="portlet  -->
	</div><!-- // <div class="row"> -->
	<?php } ?>


	<?php if($_CONFIG['MODULE']['sms'] && false) { ?>
	<div class="row">
		<!-- BEGIN SMS호스팅정보 -->
		<div class="portlet white">
			<div class="title">
				<h1>
					<i class="xi-mobile"></i>SMS 호스팅정보
					<div class="tools">
						<a class="btn" onclick="modal('site/sms/test');"><i class="xi-mobile"></i><span class="tooltip top">SMS 테스트</span></a>
					</div>
				</h1>
			</div>
			<div class="body">
				<form name="frm2" id="frm2" action="modules/site/config/?m=sms">
					<div class="form-group">
						<label><input type="radio" id="SMS1" name="SMS" value="NONE" <?=($_CONFIG['SMS']=='NONE')?'checked':''?>><span>설정 안함</span></label>
						<label><input type="radio" id="SMS2" name="SMS" value="GABIA" <?=($_CONFIG['SMS']=='GABIA')?'checked':''?>><span>가비아</span></label>
						<label><input type="radio" id="SMS3" name="SMS" value="CAFE24" <?=($_CONFIG['SMS']=='CAFE24')?'checked':''?>><span>까페24</span></label>
						<label class="control-label">SMS호스팅</label>
					</div>
					<div class="form-group">
						<input type="text" name="SMS_SENDTEL" value="<?=$_CONFIG['SMS_SENDTEL']?>" placeholder="발송 전화번호">
						<label class="control-label">발송 전화번호</label>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-2">
								<input type="text" name="SMS_ID" value="<?=$_CONFIG['SMS_ID']?>" placeholder="SMS호스팅 아이디">
							</div>
							<div class="col-2">
								<input type="text" name="SMS_APIKEY" value="<?=$_CONFIG['SMS_APIKEY']?>" placeholder="API Key">
							</div>
						</div>
						<label class="control-label">호스팅 정보</label>
					</div>
				</form>
			</div>
			<div class="footer">
				<a class="btn btn-large green"  onclick="fn_submit($('#frm2'));"><i class="xi-check"></i> 적용</a>
				<a class="btn btn-large" onclick="frm2.reset();"><i class="xi-undo"></i> 이전값 초기화</a>
			</div>
			<!-- END SMS호스팅정보 -->
		</div>
	</div>
	<?php } ?>
</div>