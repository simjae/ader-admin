<style>
    .btn-close {
        float: right;
        color: '#000';
    }

    .rd__square.voucher_level {
        height: 0px;
    }
</style>
<input type="hidden" id="price_unit" value="원">
<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between" style="gap:20px;">
            <div class="flex items-center" style="gap: 20px;">
                <h3>바우처 발행</h3>
            </div>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <form id="frm-regist" action="voucher/publish/add">
            <input type="hidden" name="on_off_type" value='ON'>
            <input type="hidden" name="voucher_type" value='BR'>
            <div class="content__wrap">
                <div class="content__title">쇼핑몰 국가</div>
                <div class="content__row" style="margin-right:20px;">
                    <select class="fSelect eSearch" name="country" style="width:163px;">
                        <option value="KR" selected>한국몰</option>
                        <option value="EN">영문몰</option>
                        <option value="CN">중국몰</option>
                    </select>
                </div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">바우처 이름</div>
                    <div class="content__row" style="margin-right:20px;">
                        <input type="text" name="voucher_name" value="">
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">바우처 코드</div>
                    <div class="content__row">
                        <input type="text" name="voucher_code" value="">
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">생일바우처 월 선택</div>
                <div class="content__row">
                    <div class="content__date__wrap">
                        <div class="content__date__picker">
                            <input type="month" name="birth_month" onChange='monthParamChange(this)'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">할인 유형</div>
                <div class="content__row">
                    <select class="fSelect eSearch" name="sale_type" style="width:163px;"
                        onChange="changeSaleTypeParamTitle(this)">
                        <option value="" selected>세일 유형 선택</option>
                        <option value="PER">전체가격의 비율</option>
                        <option value="PRC">고정 금액</option>
                    </select>
                </div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">
                        <p id="sale_type_param_title">할인 금액/비율</p>
                    </div>
                    <div class="content__row">
                        <input type="number" name="sale_price" value="" style="width:125px!important;">
                        <span id="sale_price_unit"></span>
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">최소 사용 금액</div>
                    <div class="content__row">
                        <input type="number" name="min_price" value="" style="width:125px!important;">
                        <span id="min_price_unit"></span>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">상세 설명</div>
                <div class="content__row" style="height:120px!important">
                    <textarea name="description" value=""
                        style="height:100%;width:90%;border:solid 1px;resize:none;"></textarea>
                </div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">발행 멤버</div>
                    <div class="content__row form-group" style="padding-left:0px!important;">
                        <label class="rd__square voucher_level">
                            <input type="radio" name="member_level_flg" value="ALL" checked>
                            <span>전체</span>
                        </label>
                        <label class="rd__square voucher_level">
                            <input type="radio" name="member_level_flg" value="DML">
                            <span>특정 레벨 선택</span>
                        </label>
                    </div>
                    <div class="content__title"></div>
                    <div class="content_row">
                        <div class=" detail__member__level">
                            <div class="content__row form-group" style="padding-left:0px!important;">
<?php
						$get_member_level_sql = "
							SELECT
								IDX,
								TITLE
							FROM
								MEMBER_LEVEL
							WHERE
								DEL_FLG = FALSE
						";
						$db->query($get_member_level_sql);

						foreach($db->fetch() as $level_info){
?>
                                <label>
                                    <input type="checkbox" name="member_level[]" value="<?=$level_info['IDX']?>">
                                    <span><?=$level_info['TITLE']?></span>
                                </label>		    
<?php
						}
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card__footer">
        <div class="footer__btn__wrap" style="grid: none;">
            <div class="btn__wrap--lg">
                <div class="blue__color__btn" onClick="registVoucher()"><span>생일바우처 등록</span></div>
                <div class="defult__color__btn" onClick="returnVoucherPage()"><span>뒤로가기</span></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.date__param__div').hide();
        $('.detail__member__level').hide();
        $('#frm-regist').find('select[name="country"]').on('change', function () {
            var country = $(this).val();
            switch (country) {
                case 'KR':
                    $('#price_unit').val('원');
                    break;
                case 'EN':
                    $('#price_unit').val('Doller');
                    break;
                case 'CN':
                    $('#price_unit').val('Doller');
                    break;
            }
        })
        $('#frm-regist').find('select[name="on_off_type"]').on('change', function () {
            var on_off_type = $(this).val();
            var strOption = '';
            switch (on_off_type) {
                case 'ON':
                    strOption = `   <option value="LV">레벨별 바우처</option>
                                <option value="MB">멤버별 바우처</option>
                                <option value="BR">생일별 바우처</option>`;
                    break;
                case 'OFF':
                    strOption = `   <option value="OFF">오프라인 바우처</option>`;
                    break;
                case '':
                    strOption = `   <option value="">온-오프 타입을 선택해주세요</option>`;
                    break;
            }
            $('select[name="voucher_type"]').html('')
            $('select[name="voucher_type"]').append(strOption);
        })
        $('input[name="member_level_flg"]').on('change', function () {
            var member_level_flg = $(this).val();
            if (member_level_flg == 'DML') {
                $('.detail__member__level').show();
            }
            else if (member_level_flg == 'ALL') {
                $('.detail__member__level').hide();
            }
        })
    });

    function monthParamChange(obj) {
    }

    function changeSaleTypeParamTitle(obj) {
        var price_unit = $('#price_unit').val();
        switch ($(obj).val()) {
            case 'PER':
                $('#sale_type_param_title').text('할인 비율');
                $('#sale_price_unit').text('%');
                break;
            case 'PRC':
                $('#sale_type_param_title').text('할인 금액');
                $('#sale_price_unit').text(price_unit);
                break;
            default:
                $('#sale_type_param_title').text('할인 금액/비율');
                $('#sale_price_unit').text('');
                break;
        }
    }
    function registVoucher() {
        var voucher_name = $('#frm-regist').find('input[name="voucher_name"]').val();
        var voucher_code = $('#frm-regist').find('input[name="voucher_code"]').val();

        if (voucher_name.length == 0) {
            alert('바우처 명을 입력해주세요');
            return false;
        }

        if (voucher_code.length == 0) {
            alert('바우처 코드를 입력해주세요');
            return false;
        }

        confirm('바우처를 등록하시겠습니까?', function () {
            var formData = new FormData();
            formData = $("#frm-regist").serializeObject();
            $.ajax({
                type: "post",
                data: formData,
                dataType: "json",
                url: config.api + "voucher/publish/add",
                error: function () {
                    alert('바우처 등록작업이 실패했습니다.');
                },
                success: function (d) {
                    if (d.code == 200) {
                        location.href = "/member/voucher";
                    }
                }
            });
        })
    }

    function returnVoucherPage() {
        confirm('바우처목록 창으로 돌아가시겠습니까?', function () {
            location.href = "/member/voucher";
        })
    }

</script>