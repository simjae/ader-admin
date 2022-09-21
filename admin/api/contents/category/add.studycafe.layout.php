<div class="row" id="inp-expire">
	<div class="col-2">
		<div class="form-group">
			<input type="number" name="expire_date">
			<label class="control-label">만료기간 일수</label>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group" id="inp-expire_min">
			<input type="number" name="expire_min">
			<label class="control-label">이용시간 (시간)</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<input type="number" name="seq" value="1" required>
			<label class="control-label">진열 순서</label>
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			<label class="switch">
				<input type="checkbox" value="y" name="soldout">
				<span class="bg"></span>
				<span class="trigger"></span>
			</label>
			<label class="control-label">품절</label>
		</div>
	</div>
	<div class="col-4">
		<div class="form-group">
			<label class="switch">
				<input type="checkbox" value="y" name="status">
				<span class="bg"></span>
				<span class="trigger"></span>
			</label>
			<label class="control-label">판매 여부</label>
		</div>
	</div>
</div>

<div class="row" id="inp-target_no">
	<div class="col-2">
		<div class="form-group">
			<select name="map_type"></select>
			<label class="control-label">좌석 유형 선택</label>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group">
			<select name="target_no"></select>
			<label class="control-label">특정석 전용 상품</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label class="switch">
				<input type="checkbox" value="y" name="selltime_yn">
				<span class="bg"></span>
				<span class="trigger"></span>
			</label>
			<label class="control-label">판매시간대 지정</label>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group" id="inp-selltime">
			<div class="row">
				<div class="col-7-3">
					<select name="selltime_s">
						<?php for($i=0;$i<=24;$i++) { ?>
						<option value="<?=$i?>"><?=$i?>시</option>
						<?php } ?>
					</select>
				</div>
				<div class="col-7" style="height:54px">
					<span class="center">~</span>
				</div>
				<div class="col-7-3">
					<select name="selltime_e">
						<?php for($i=0;$i<=24;$i++) { ?>
						<option value="<?=$i?>"><?=$i?>시</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<label class="control-label">판매시간 (0시 ~ 24시)</label>
		</div>
	</div>
</div>

<div class="row" id="inp-allday">
	<div class="col-2">
		<div class="form-group">
			<label class="switch">
				<input type="checkbox" value="y" name="allday_yn">
				<span class="bg"></span>
				<span class="trigger"></span>
			</label>
			<label class="control-label">이용시간대 지정</label>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group" id="inp-useful_timeterm_s">
			<div class="row">
				<div class="col-7-3">
					<select name="time_s">
						<?php for($i=0;$i<=24;$i++) { ?>
						<option value="<?=$i?>"><?=$i?>시</option>
						<?php } ?>
					</select>
				</div>
				<div class="col-7" style="height:54px">
					<span class="center">~</span>
				</div>
				<div class="col-7-3">
					<select name="time_e">
						<?php for($i=0;$i<=24;$i++) { ?>
						<option value="<?=$i?>"><?=$i?>시</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<label class="control-label">이용시간 (0시 ~ 24시)</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<div class="form-group">
			<label class="switch">
				<input type="checkbox" value="y" name="is_ticket">
				<span class="bg"></span>
				<span class="trigger"></span>
			</label>
			<label class="control-label">개별 티켓</label>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group" id="goods-ticket-cnt">
			<input type="number" name="ticket_cnt" value="1">
			<label class="control-label">티켓 출력 수</label>
		</div>
	</div>
</div>
<div class="form-group" id="goods-ticket-add-text">
	<input type="hidden" name="add_text">
	<div class="textarea" contentEditable="true" name="add_text"></div>
	<label class="control-label">티켓 하단 문구</label>
</div>


<div class="">
	<h2>연장 상품권</h2>
	<table class="list">
		<thead>
			<tr>
				<th>#</th>
				<th>상품명</th>
				<th>가격</th>
				<th>품절</th>
				<th></th>
			</tr>
		</thead>
		<tbody id="goods-relative-list">
			<tr><td class="nodata" colspan="5">연장 상품이 없습니다.</td></tr>
		</tbody>
	</table>
</div>