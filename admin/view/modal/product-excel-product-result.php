<input id="json_str" type="hidden" name="json_str" value='<?=$json_str?>'>

<div class="content__card" style="width:750px">
    <div class="card__header">
        <div class="flex justify-between">
            <h3 id=''>상품 엑셀 업로드 결과</h3>
            <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
        </div>
        <div class="drive--x"></div>
    </div>
</div>

<script>
$(document).ready(function() {
    var json_str = $('#json_str').val();
    var json_data = eval("(" + json_str + ")");

    console.log(json_data);

    $.each(json_data, function(key, value){
        var title = '';
        var str_table = ``;
        var str_td = ``;

        if(value.false.length > 0){
            str_table += `
                <div class="card__header">
                    <div class="flex justify-between">
                        <h4 style="margin-left:10px"; id=''>실패정보 안내</h3>
                    </div>
                </div>
                <div class="card__body">
                    <div class="content__wrap">
                        <div class="table__wrap table">
                            <table style="width:400px">
                                <thead>
                                    <tr>
            `;
            switch(key){
                case 'product':
                    title = '상품';
                    str_table += `
                                        <th>No.</th>
                                        <th>상품 코드</th>
                                        <th>상품 명</th>
                                        <th>엑셀 행번호</th>
                                        <th>실패 원인</th>
                    `;
                    for(var i = 0; i < value.false.length; i++){
                        str_td += `
                                            <tr>
                                                <td>${i+1}</td>
                                                <td>${value.false[i].product_code}</td>
                                                <td>${value.false[i].product_name}</td>
                                                <td>${value.false[i].row_num}</td>
                                                <td>${value.false[i].reason}</td>
                                            </tr>
                        `;
                    }
                    break;
                case 'sales_info':
                    title = '판매옵션';
                    str_table += `
                                        <th>No.</th>
                                        <th>상품 코드</th>
                                        <th>엑셀 행번호</th>
                                        <th>실패 원인</th>
                    `;
                    for(var i = 0; i < value.false.length; i++){
                        str_td += `
                                            <tr>
                                                <td>${i+1}</td>
                                                <td>${value.false[i].product_code}</td>
                                                <td>${value.false[i].row_num}</td>
                                                <td>${value.false[i].reason}</td>
                                            </tr>
                        `;
                    }
                    break;
                case 'option_info':
                    title = '상품옵션';
                    str_table += `
                                        <th>No.</th>
                                        <th>상품 코드</th>
                                        <th>옵션 이름</th>
                                        <th>엑셀 행번호</th>
                                        <th>실패 원인</th>
                    `;
                    for(var i = 0; i < value.false.length; i++){
                        str_td += `
                                            <tr>
                                                <td>${i+1}</td>
                                                <td>${value.false[i].product_code}</td>
                                                <td>${value.false[i].option_name}</td>
                                                <td>${value.false[i].row_num}</td>
                                                <td>${value.false[i].reason}</td>
                                            </tr>
                        `;
                    }
                    break;
                case 'img':
                    title = '상품 이미지';
                    str_table += `
                                        <th>No.</th>
                                        <th>상품 코드</th>
                                        <th>이미지 타입</th>
                                        <th>파일 명</th>
                                        <th>엑셀 행번호</th>
                    `;
                    for(var i = 0; i < value.false.length; i++){
                        str_td += `
                                            <tr>
                                                <td>${i+1}</td>
                                                <td>${value.false[i].product_code}</td>
                                                <td>${value.false[i].img_type}</td>
                                                <td>${value.false[i].img_name}</td>
                                                <td>${value.false[i].row_num}</td>
                                            </tr>
                        `;
                    }
                    break;
                case 'relevant':
                    title = '관련상품';
                    str_table += `
                                        <th>No.</th>
                                        <th>상품 코드</th>
                                        <th>관련상품 코드</th>
                                        <th>엑셀 행번호</th>
                                        <th>실패 원인</th>
                    `;
                    for(var i = 0; i < value.false.length; i++){
                        str_td += `
                                            <tr>
                                                <td>${i+1}</td>
                                                <td>${value.false[i].product_code}</td>
                                                <td>${value.false[i].relevant_code}</td>
                                                <td>${value.false[i].row_num}</td>
                                                <td>${value.false[i].reason}</td>
                                            </tr>
                        `;
                    }
                    break;
            }
            str_table += `
                                                
                                    </tr>
                                </thead>
                                <tbody>
                                    ${str_td}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
        }
        else{
            switch(key){
                case 'product':
                    title = '상품';
                    break;
                case 'sales_info':
                    title = '판매옵션';
                    break;
                case 'option_info':
                    title = '상품옵션';
                    break;
                case 'img':
                    title = '상품 이미지';
                    break;
                case 'relevant':
                    title = '관련상품';
                    break;
            }
        }
        
        var str_div = `
            <div class="card__body">
                <h3 style="margin-left:10px";>${title} 정보</h4>
                <div class="content__wrap">
                    <div class="content__title">전체 업로드 데이터 개수</div>
                    <div class="content__row">
                        <span id="total_upload_cnt">${value.true.length + value.false.length}개</span>
                    </div>
                </div>
                <div class="content__wrap">
                    <div class="content__title">성공 개수</div>
                    <div class="content__row">
                        <span id="success_upload_cnt">${value.true.length}개</span>
                    </div>
                </div>
                <div class="content__wrap">
                    <div class="content__title">실패 개수</div>
                    <div class="content__row">
                        <span id="fail_upload_cnt">${value.false.length}개</span>
                    </div>
                </div>
                <div class="content__wrap"></div>
            </div>
            ${str_table}
            <div class="drive--x"></div>
        `;
        $('.modal .content__card').append(str_div);
    });

    
    
    /*
    var result_arr = result.split('|');
    
    var count_arr = result_arr[0].split(',');
    var fail_code_arr = result_arr[1].split(',');
    var fail_rn_arr = result_arr[2].split(',');

    $('#total_upload_cnt').text(' : ' + count_arr[0] + ' 개');
    $('#success_upload_cnt').text(' : ' + count_arr[1] + ' 개');
    $('#fail_upload_cnt').text(' : ' + count_arr[2] + ' 개');

    if(result_arr[1].length > 0){
        var fail_cnt = fail_code_arr.length;
        for(var i = 0; i < fail_cnt; i++){
            var div_str = `
                <tr>
                    <td>${i+1}</td>
                    <td>${fail_code_arr[i]}</td>
                    <td>${fail_rn_arr[i]}</td>
                </tr>
            `;
            $('#fail_list').append(div_str);
        }
    }
    else{
        $('#fail_list').append(`<TD colspan="3">결과가 없습니다.</td>`);
    }
    */
});
</script>