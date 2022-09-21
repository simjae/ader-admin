<style>
.size_option td {
    border:none;
}

</style>
<div class="content__card">
    <div class="card__header">
        <div class="flex justify-between">
            <span>모델 신장 175cm<br>착용 사이즈는 A2입니다.</span>
            <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div class="content__wrap" style="align-items: start;">
			<div class="content__title">
                <canvas id="size_img" width="230" height="250"></canvas>
            </div>
            <div class="content__title" style="margin-left:200px">
                <table class="size_option">
                    <tr>
                        <td>A.총장</td>
                        <td>옆목점에서 끝단 까지의 수직길이</td>
                    </tr> 
                    <tr>
                        <td>B.가슴단면</td>
                        <td>암홀점에서 1CM아래 양끝의 수평길이</td>
                    </tr>
                    <tr>
                        <td>C.어깨너비</td>
                        <td>어깨점 양끝의 수평길이</td>
                    </tr>
                    <tr>
                        <td>D.목너비</td>
                        <td>옆목점 양끝의 수평길이</td>
                    </tr>
                    <tr>
                        <td>E.소매장</td>
                        <td>어깨점부터 소매끝단까지의 길이</td>
                    </tr>  
                    <tr>
                        <td>F.소매입구</td>
                        <td>옆목점에서소매 끝단의 양끝의 수평길이</td>
                    </tr>
                </table>
			</div>
        </div>
        <div class="content__wrap">
            <div class="content__title">
                
            </div>
        </div>
        <div class="drive--x"></div>
        <div class="content__wrap">
            <div class="table__wrap table" style="width:100%;">
                <table>
                    <thead>
                        <tr>
                            <th style="width:12%;">사이즈(cm)</th>
                            <th style="width:12%;">총장</th>
                            <th style="width:12%;">가슴단면</th>
                            <th style="width:12%;">어깨너비</th>
                            <th style="width:12%;">목너비</th>
                            <th style="width:12%;">소매장</th>
                            <th style="width:12%;">소매입구</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>A1</td>
                            <td>73cm</td>
                            <td>55.5cm</td>
                            <td>49.5cm</td>
                            <td>19cm</td>
                            <td>23cm</td>
                            <td>19cm</td>
                        </tr>
                        <tr>
                            <td>A2</td>
                            <td>75.5cm</td>
                            <td>60cm</td>
                            <td>54cm</td>
                            <td>19.5cm</td>
                            <td>25cm</td>
                            <td>20cm</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

var canvas = document.querySelector('canvas');
var canvasObj = canvas.getContext('2d');

$(document).ready(function() {
    var img = new Image;
    img.src = "/images/default/white_shirt.png";

    img.onload = function(){
        canvasObj.drawImage(img, 0, 0, 230, 250);
    };

    $('.size_option tr').mouseover(function(){
        $('.size_option td').css('text-decoration', 'none');
        $(this).find('td').css('text-decoration', 'underline');
        var size_part = $(this).find('td').eq(0).text();
        printToCanvas(size_part);
    })
});
function printToCanvas(size_part){
    var img = new Image;
    img.src = "/images/default/white_shirt.png";

    img.onload = function(){
        canvasObj.drawImage(img, 0, 0, 230, 250);
        canvasObj.beginPath();
        switch(size_part){
            case 'A.총장':
                canvasObj.moveTo(140,32);
                canvasObj.lineTo(140,218);
                break;
            case 'B.가슴단면':
                canvasObj.moveTo(65,118);
                canvasObj.lineTo(167,118);
                break;
            case 'C.어깨너비':
                canvasObj.moveTo(66,45);
                canvasObj.lineTo(167,45);
                break;
            case 'D.목너비':
                canvasObj.moveTo(100,30);
                canvasObj.lineTo(130,30);
                break;
            case 'E.소매장':
                canvasObj.moveTo(66,49);
                canvasObj.lineTo(29,90);
                break;
            case 'F.소매입구':
                canvasObj.moveTo(30,86);
                canvasObj.lineTo(57,117);
                break;
        }
        canvasObj.stroke();
    };
}
</script>