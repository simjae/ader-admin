<div class="hidden china-tap filter-tap">
<div class="content__card">
		<div class="card__header">
            <h2>홈페이지 내 알림메세지 설정(중문몰)</h2>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
            <form id="frm-list-03">
                <input type="hidden" name="country" id="" value="CN">
                <div class="table__wrap table">
                    <table>
                        <tbody id="notice_table_03">
                            <tr>
                                <th style="vertical-align:middle;">재고 수량 부족</th>
                                <td>
                                    <input type="hidden" name="alarm_condition[]" id="" value="stock_empty">
                                    <input style="width:90%" placeholder="" type="text" name="alarm_message" id="">
                                </td>
                                <td style="width:85px"><button style="width:70px;height:30px;border:1px solid;background-color:black;color:#ffffff;font-size:0.5rem;cursor:pointer;" onclick="singleSaveBtn(this)">메세지 저장</button></td>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle;">상품분류 접근제한</th>
                                <td>
                                    <input type="hidden" name="alarm_condition[]" id="" value="product_category_access">
                                    <input style="width:90%" placeholder="" type="text" name="alarm_message" id="">
                                </td>
                                <td style="width:85px"><button style="width:70px;height:30px;border:1px solid;background-color:black;color:#ffffff;font-size:0.5rem;cursor:pointer;" onclick="singleSaveBtn(this)">메세지 저장</button></td>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle;">상품사용후기<br>제한 설정</th>
                                <td>
                                    <input type="hidden" name="alarm_condition[]" id="" value="product_review">
                                    <input style="width:90%" placeholder="" type="text" name="alarm_message" id="">
                                </td>
                                <td style="width:85px"><button style="width:70px;height:30px;border:1px solid;background-color:black;color:#ffffff;font-size:0.5rem;cursor:pointer;" onclick="singleSaveBtn(this)">메세지 저장</button></td>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle;">불량회원 로그인시<br>안내 문구 설정</th>
                                <td>
                                    <input type="hidden" name="alarm_condition[]" id="" value="bad_user_login_restrict">
                                    <input style="width:90%" placeholder="" type="text" name="alarm_message" id="">
                                </td>
                                <td style="width:85px"><button style="width:70px;height:30px;border:1px solid;background-color:black;color:#ffffff;font-size:0.5rem;cursor:pointer;" onclick="singleSaveBtn(this)">메세지 저장</button></td>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle;">불량회원 구매제한<br>안내 문구 설정</th>
                                <td>
                                    <input type="hidden" name="alarm_condition[]" id="" value="bad_user_buy_restrict">
                                    <input style="width:90%" placeholder="" type="text" name="alarm_message" id="">
                                </td>
                                <td style="width:85px"><button style="width:70px;height:30px;border:1px solid;background-color:black;color:#ffffff;font-size:0.5rem;cursor:pointer;" onclick="singleSaveBtn(this)">메세지 저장</button></td>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle;">온라인 설문조사<br>결과보기 기능제한</th>
                                <td>
                                    <input type="hidden" name="alarm_condition[]" id="" value="online_servey_result_limit">
                                    <input style="width:90%" placeholder="" type="text" name="alarm_message" id="">
                                    <p style="line-height:2; color: #888888;"> - 在线问卷调查结果显示，没有权限的群组点击时显示的购物网站画面信息.</p>
                                </td>
                                <td style="width:85px"><button style="width:70px;height:30px;border:1px solid;background-color:black;color:#ffffff;font-size:0.5rem;cursor:pointer;" onclick="singleSaveBtn(this)">메세지 저장</button></td>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle;">회원가입 재가입 제한</th>
                                <td>
                                    <input type="hidden" name="alarm_condition[]" id="" value="re_sign_up_restrict">
                                    <input style="width:90%" placeholder="" type="text" name="alarm_message" id="">
                                </td>
                                <td style="width:85px"><button style="width:70px;height:30px;border:1px solid;background-color:black;color:#ffffff;font-size:0.5rem;cursor:pointer;" onclick="singleSaveBtn(this)">메세지 저장</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-between" style="margin-top:20px;">  
                        <div class="black-btn" tab-num="03" onclick="saveAlarm(this)"><span>저장</span></div>
                    </div>
                </div>
            </form>
		</div>
	</div>
</div>