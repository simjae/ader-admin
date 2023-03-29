
<div class="content__card">
	<form id="frm-list_ADV" action="">
		<div class="card__header">
			<div class="card__header">
				<h3>광고 관련 메세지</h3>
				<div class="drive--x"></div>
				<div class="btn" onclick="saveMsgTap()">메세지 저장</div>
			</div>
		</div>
		<div class="card__body">
			<div class="table__wrap">
				<div class="overflow-x-auto">
					<table>
						<colgroup>
							<col width="280px">
							<col width="280px">
							<col width="280px">
							<col width="280px">
						</colgroup>
						<thead>
							<tr>
								<th>발송 상황 선택</th>
								<th>고객</th>
								<th>운영자</th>
								<th>공급사</th>
							</tr>
						</thead>
						<tbody>
<?php 
		$get_sms_info_sql = "
			SELECT
				IDX,
				SMS_TYPE,
				SITUATION_TITLE,
				SITUATION_CODE,
				SEND_TARGET,
				MEMBER_SEND_FLG,
				ADMIN_SEND_FLG,
				SUPPLIER_SEND_FLG,
				CUSTOMER_SEND_FLG,
				MEMBER_SEND_MSG,
				ADMIN_SEND_MSG,
				SUPPLIER_SEND_MSG
			FROM
				SMS_INFO
			WHERE
				SMS_TYPE = 'ADV'
			AND
				DEL_FLG = FALSE
		";
		$db->query($get_sms_info_sql);
		foreach($db->fetch() as $sms_data){
			$member_target_flg = false;
			$admin_target_flg = false;
			$supplier_target_flg = false;
			$send_target_arr = array();
			if(strlen($sms_data['SEND_TARGET'] > 0)){
				$send_target_arr = explode(',',$sms_data['SEND_TARGET']);
			}
?>
							<tr>
								<td>
									<input type="hidden" name="sms_idx_list[]" value="<?=$sms_data['IDX']?>">
									<p>
										<?=$sms_data['SITUATION_TITLE']?>
									</p>
									<div class="cb__color">
<?php
			foreach($send_target_arr as $val){
				$target_name = '';
				$cheked_str = '';
				
				switch($val){
					case 'M':
						$target_name = '고객';
						$cheked_str = $sms_data['MEMBER_SEND_FLG']==true?'checked':'';
						$member_target_flg = true;
						break;
					case 'A':
						$target_name = '운영자';
						$cheked_str = $sms_data['ADMIN_SEND_FLG']==true?'checked':'';
						$admin_target_flg = true;
						break;
					case 'S':
						$target_name = '공급사';
						$cheked_str = $sms_data['SUPPLIER_SEND_FLG']==true?'checked':'';
						$supplier_target_flg = true;
						break;
					case 'C':
						$target_name = '구매자';
						$cheked_str = $sms_data['CUSTOMER_SEND_FLG']==true?'checked':'';
						break;
				}
?>
							            <label>
							                <input type="checkbox" name="send_target_<?=$sms_data['IDX']?>[]" value="<?=$val?>" <?=$cheked_str?>>
							                <span><?=$target_name?></span>
							            </label>
<?php
			}
?>
									</div>
								</td>
								<td>
<?php
			if($member_target_flg == true){
?>
									<textarea name="member_send_msg_<?=$sms_data['IDX']?>" onkeyup="byteCheck(this)"><?=$sms_data['MEMBER_SEND_MSG']?></textarea>
									<div class="btn preview">미리보기</div>
									<span class="current__byte"><?=mb_strlen($sms_data['MEMBER_SEND_MSG'], 'euc-kr')?></span>/<span class="max__byte">100 Byte</span>
<?php
			}
?>
								</td>
								<td>
<?php
			if($admin_target_flg == true){
?>
									<textarea name="admin_send_msg_<?=$sms_data['IDX']?>" onkeyup="byteCheck(this)"><?=$sms_data['ADMIN_SEND_MSG']?></textarea>
									<div class="btn preview">미리보기</div>
									<span class="current__byte"><?=mb_strlen($sms_data['ADMIN_SEND_MSG'], 'euc-kr')?></span>/<span class="max__byte">100 Byte</span>
<?php
			}
?>
								</td>
								<td>
<?php
			if($supplier_target_flg == true){
?>
									<textarea name="supplier_send_msg_<?=$sms_data['IDX']?>" onkeyup="byteCheck(this)"><?=$sms_data['SUPPLIER_SEND_MSG']?></textarea>
									<div class="btn preview">미리보기</div>
									<span class="current__byte"><?=mb_strlen($sms_data['SUPPLIER_SEND_MSG'], 'euc-kr')?></span>/<span class="max__byte">100 Byte</span>
<?php
			}
?>
								</td>
							</tr>
<?php
		}
?>		
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>