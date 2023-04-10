
<link rel="stylesheet" href="/css/mypage/orderlist.css">
<div class="orderlist__wrap">
	<div class="orderlist__tab__btn__container">
		<div class="tab__btn__item" action-type="ALL" onclick="viewOrderList(this)">
			<span data-i18n="o_order">주문</span>
		</div>

		<div class="tab__btn__item" action-type="OC" onclick="viewOrderList(this)">
			<span data-i18n="o_cancel">취소</span>
		</div>

		<div class="tab__btn__item" action-type="OE" onclick="viewOrderList(this)">
			<span data-i18n="o_exchange">교환</span>
		</div>

		<div class="tab__btn__item" action-type="OR" onclick="viewOrderList(this)">
			<span data-i18n="o_return">반품</span>
		</div>
	</div>

	<input id="param_status" type="hidden" value="ALL">

	<div class="orderlist__tab__wrap tab_ALL">
		<div class="order__list order_list_ALL">
			<input type="hidden" name="rows" value="5">
			<input type="hidden" name="page" value="1">

			<div class="pc__view  w_view_ALL"></div>
			<div class="mobile__view m_view_ALL"></div>

			<div class="orderlist__paging"></div>
		</div>

		<div class="orderlist__tab order__detail">
			<div class="pc__view w_detail_view_ALL"></div>
			<div class="mobile__view m_detail_view_ALL"></div>
		</div>
	</div>

	<div class="orderlist__tab__wrap tab_OC" style="display:none;">
		<div class="order__list order_list_OC">
			<input type="hidden" name="rows" value="5">
			<input type="hidden" name="page" value="1">

			<div class="pc__view w_view_OC"></div>
			<div class="mobile__view m_view_OC"></div>

			<div class="orderlist__paging"></div>
		</div>

		<div class="orderlist__tab order__detail">
			<div class="pc__view w_detail_view_OC"></div>
			<div class="mobile__view m_detail_view_OC"></div>
		</div>
	</div>

	<div class="orderlist__tab__wrap tab_OE" style="display:none;">
		<div class="order__list order_list_OE">
			<input type="hidden" name="rows" value="5">
			<input type="hidden" name="page" value="1">

			<div class="pc__view w_view_OE"></div>
			<div class="mobile__view m_view_OE"></div>

			<div class="orderlist__paging"></div>
		</div>

		<div class="orderlist__tab order__detail">
			<div class="pc__view w_detail_view_OE"></div>
			<div class="mobile__view m_detail_view_OE"></div>
		</div>
	</div>

	<div class="orderlist__tab__wrap tab_OR" style="display:none;">
		<div class="order__list order_list_OR">
			<input type="hidden" name="rows" value="5">
			<input type="hidden" name="page" value="1">

			<div class="pc__view w_view_OR"></div>
			<div class="mobile__view m_view_OR"></div>

			<div class="orderlist__paging"></div>
		</div>

		<div class="orderlist__tab order__detail">
			<div class="pc__view w_detail_view_OR"></div>
			<div class="mobile__view m_detail_view_OR"></div>
		</div>
	</div>
</div>
<script src="/scripts/mypage/orderlist.js"></script>