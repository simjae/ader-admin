<style>
    .time__select {
        width: 80px !important;
    }
</style>
<div class="content__card">
	<form id="frm-draw-add" action="order/draw/add">
		<input type="hidden" name="product_idx">
		<?php
		function getUrlParamter($url, $sch_tag)
		{
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}

		$page_url = $_SERVER['REQUEST_URI'];
		$country = getUrlParamter($page_url, 'country');
		?>
		<input type="hidden" name="country" value="<?= $country ?>">
		<div class="card__header">
			<h3>드로우 등록</h3>
			<div class="drive--x"></div>
		</div>

        <div class="card__body">
            <div class="table table__wrap">
                <div class="table__filter">
                    <div class="filrer__wrap">
                        <div class="filter__btn" onclick="searchProductModal();">상품 검색</div>
                    </div>
                </div>

                <div class="table table__wrap">
                    <table>
                        <colsgroup>
                            <col style="width:4%;">
                            <col style="width:auto">
                            <col style="width:20%;">
                            <col style="width:10%;">
                            <col style="width:8%;">
                            <col style="width:8%;">
                            <col style="width:8%;">
                            <col style="width:8%;">
                            <col style="width:10%;">
                        </colsgroup>
                        <thead>
                            <tr>
                                <th>상품변경</th>
                                <th>드로우 상품정보</th>
                                <th>바코드</th>
                                <th>사이즈</th>
                                <th>재고수량</th>
                                <th>한국몰 판매수량</th>
                                <th>영문몰 판매수량</th>
                                <th>중국몰 판매수량</th>
                                <th>판매수량</th>
                            </tr>
                        </thead>
                        <tbody id="draw_product_table" class="default_td">
                            <tr>
                                <td colspan="9">상품검색 버튼을 눌러 상품을 선택해주세요
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">드로우 시작일</div>
                    <div class="content__row">
                        <div class="content__date__wrap">
                            <div class="content__date__picker">
                                <input class="date_param" type="date" id="entry_start_date" class="margin-bottom-6"
                                    placeholder="From" readonly style="width:150px;" date_type="entry"
                                    onChange="dateParamChange(this);">
                                <select id="entry_start_hour" class="time__select hour" date_type="entry"
                                    onChange="dateParamChange(this);"></select>
                                <span>&nbsp;시
                            </div>
                        </div>
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">드로우 종료일</div>
                    <div class="content__row">
                        <div class="content__date__wrap">
                            <div class="content__date__picker">
                                <input class="date_param" type="date" id="entry_end_date" class="margin-bottom-6"
                                    placeholder="From" readonly style="width:150px;" date_type="entry"
                                    onChange="dateParamChange(this);">
                                <select id="entry_end_hour" class="time__select hour" date_type="entry"
                                    onChange="dateParamChange(this);"></select>
                                <span>&nbsp;시
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">구매 시작일</div>
                    <div class="content__row">
                        <div class="content__date__wrap">
                            <div class="content__date__picker">
                                <input class="date_param" type="date" id="purchase_start_date" class="margin-bottom-6"
                                    placeholder="From" readonly style="width:150px;" date_type="purchase"
                                    onChange="dateParamChange(this);">

                                <select id="purchase_start_hour" class="time__select hour" date_type="purchase"
                                    onChange="dateParamChange(this);"></select>
                                <span>&nbsp;시
                            </div>
                        </div>
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">구매 종료일</div>
                    <div class="content__row">
                        <div class="content__date__wrap">
                            <div class="content__date__picker">
                                <input class="date_param" type="date" id="purchase_end_date" class="margin-bottom-6"
                                    placeholder="From" readonly style="width:150px;" date_type="purchase"
                                    onChange="dateParamChange(this);">
                                <select id="purchase_end_hour" class="time__select hour" date_type="purchase"
                                    onChange="dateParamChange(this);"></select>
                                <span>&nbsp;시
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">판매 가격</div>
                    <div class="content__row">
                        <input type="number" name="sales_price" value=""
                            style="height:28px;border:solid 1px #bfbfbf;width:100px;margin-right:5px;">원
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">멤버 레벨</div>
                    <div class="content__row">
                        <div class="rd__block">
                            <input id="member_level_all" type="radio" name="member_level" value="ALL" checked>
                            <label for="member_level_all">전체</label>

                            <input id="member_level_1" type="radio" name="member_level" value="1">
                            <label for="member_level_1">일반</label>

                            <input id="member_level_2" type="radio" name="member_level" value="2">
                            <label for="member_level_2">Ader Family</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">당첨일</div>
                <div class="content__row">
                    <div class="content__date__wrap">
                        <div class="content__date__picker">
                            <input class="date_param" type="date" id="announce_date" class="margin-bottom-6"
                                placeholder="From" readonly style="width:150px;" date_type="announce"
                                onChange="">

                            <select id="announce_hour" class="time__select hour" date_type="announce"
                                onChange=""></select>
                            <span>&nbsp;시
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__btn__wrap">
            <div toggle="hide"></div>
            <div class="btn__wrap--lg">
                <div class="blue__color__btn" onClick="addDraw('KR');"><span>드로우 등록</span></div>
                <div class="defult__color__btn" onclick="location.href='/display/draw'"><span>이전페이지로 돌아가기</span>
                </div>
            </div>
        </div>
</div>
</form>
</div>


<script>
    $(document).ready(function () {
        timeSelectSet();
    });

    function searchProductModal() {
        modal('/search_product', null);
    }

    function timeSelectSet() {
        var hourOption = '';

        for (var i = 0; i <= 24; i++) {
            var hour_val = i.toString().padStart(2, '0');
            hourOption += `
            <option value='${hour_val}'>${hour_val}</option>
        `;
        }
        $('.hour').append(hourOption);
    }

    function dateParamChange(obj) {
        var date_type = $(obj).attr('date_type');

        var sel_std_obj = $('#' + date_type + '_start_date');
        var sel_end_obj = $('#' + date_type + '_end_date');
        var sel_std_hour_obj = $('#' + date_type + '_start_hour');
        var sel_end_hour_obj = $('#' + date_type + '_end_hour');

        var sel_std_date = new Date(sel_std_obj.val()).getTime();
        var sel_end_date = new Date(sel_end_obj.val()).getTime();

        if (Date.now() >= sel_std_date) {
            alert('시작일을 금일 이후로 선택해주세요');
            sel_std_obj.val('');
            sel_end_obj.val('');
        }
        if (!isNaN(sel_std_date) && !isNaN(sel_end_date)) {
            if (sel_std_obj.val().replaceAll('-', '') + sel_std_hour_obj.val() >
                sel_end_obj.val().replaceAll('-', '') + sel_end_hour_obj.val()) {

                alert('종료일 이후로 시작일을 지정할 수 없습니다.');
                sel_std_obj.val('');
                sel_end_obj.val('');

                sel_std_hour_obj.val('00').prop('selected', true);
                sel_end_hour_obj.val('00').prop('selected', true);
            }
        }
    }

    function addDraw(country) {
        confirm('드로우를 추가하시겠습니까?', function () {
            var formData = new FormData();
            formData = $('#frm-draw-add').serializeObject();

            var qty_info = [];
            var tmp_qty_info = [];
            var option_len = $('.option_idx_param').length;

            for (var i = 0; i < option_len; i++) {
                tmp_qty_info = [];
                tmp_qty_info.push($('.option_idx_param').eq(i).val());
                tmp_qty_info.push($('.option_name_param').eq(i).val());
                tmp_qty_info.push($('.barcode_param').eq(i).val());
                tmp_qty_info.push($('.product_qty_param').eq(i).val());

                qty_info.push(tmp_qty_info);
            }
            formData.qty_info = qty_info;

            var entry_start_date = '';
            if ($('#entry_start_date').val() == '') {
                alert('드로우 시작일을 입력해주세요');
                return false;
            }
            entry_start_date += $('#entry_start_date').val().replaceAll('-', '');
            entry_start_date += $('#entry_start_hour').val();
            entry_start_date += '00';

            var entry_end_date = '';
            if ($('#entry_end_date').val() == '') {
                alert('드로우 종료일을 입력해주세요');
                return false;
            }
            entry_end_date += $('#entry_end_date').val().replaceAll('-', '');
            entry_end_date += $('#entry_end_hour').val();
            entry_end_date += '00';

            var announce_date = '';
            if ($('#announce_date').val() == '') {
                alert('드로우 당첨일을 입력해주세요');
                return false;
            }
            announce_date += $('#announce_date').val().replaceAll('-', '');
            announce_date += $('#announce_hour').val();
            announce_date += '00';

            var purchase_start_date = '';
            if ($('#purchase_start_date').val() == '') {
                alert('구매 시작일을 입력해주세요');
                return false;
            }
            purchase_start_date += $('#purchase_start_date').val().replaceAll('-', '');
            purchase_start_date += $('#purchase_start_hour').val();
            purchase_start_date += '00';

            var purchase_end_date = '';
            if ($('#purchase_end_date').val() == '') {
                alert('구매 종료일을 입력해주세요');
                return false;
            }
            purchase_end_date += $('#purchase_end_date').val().replaceAll('-', '');
            purchase_end_date += $('#purchase_end_hour').val();
            purchase_end_date += '00';

            if (entry_end_date > purchase_start_date) {
                alert('구매 시작일은 스텐바이 종료일 이후로 지정해야합니다.');
                return false;
            }

            if (entry_end_date > announce_date && purchase_start_date < announce_date) {
                alert('당첨일을 드로우 종료일과 구매 시작일 사이로 설정해주세요');
                return false;
            }


            formData.entry_start_date = entry_start_date;
            formData.entry_end_date = entry_end_date;
            formData.announce_date = announce_date;
            formData.purchase_start_date = purchase_start_date;
            formData.purchase_end_date = purchase_end_date;
            //select_val

            if ($('input[name="sales_price"]').val() == '') {
                alert('판매가격을 입력해주세요');
            }
            $.ajax({
                url: config.api + "order/draw/add",
                type: "post",
                data: formData,
                dataType: "json",
                error: function () {
                    alert('드로우 등록 처리중 오류가 발생했습니다.');
                },
                success: function (d) {
                    let code = d.code;
                    if (code == 200) {
                        alert('드로우 등록이 완료되었습니다.');
                    } else {
                        alert('드로우 등록에 실패했습니다.');
                        return false;
                    }
                }
            });
        });
    }
</script>