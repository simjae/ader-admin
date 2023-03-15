<style>
	:root {
		--order-header--height: 150px;
		--header--content--gap: 50px;

		--solid-bk: #808080;
	}

	input {
		padding: 0;
		box-sizing: border-box;
	}

	ul,
	li {
		padding: 0;
		margin: 0;
	}

	input:focus {
		border: 0;
	}

	.content input:focus {
		caret-color: #343434;
		outline: 0;
	}

	body {
		font-family: var(--ft-no-fu);
		/* background-color: #222; */
		/* color: #ffffff; */
		color: var(--bk);
	}

	.hidden {
		display: none !important;
	}

	.tui-select-box-highlight {
		background: #f8f8f8 !important;
	}

	.tui-select-box-placeholder {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		letter-spacing: normal;
		color: #dcdcdc;
	}

	.tui-select-box-input:focus {
		outline: 0px;
	}

	.tui-select-box-input {
		border: 1px solid #808080;
	}

	#addrDirectBox {
		border-top: 0px;
		padding: 10px;
		height: 90px;
		outline: none;
		resize: none;
		border-bottom: 1px solid #808080;
		border-left: 1px solid #808080;
		border-right: 1px solid #808080;
	}

	.tui-select-box-item {
		color: var(--bk);
		font-family: var(--ft-no-fu);
		font-size: 11px;
		padding: 0 10px;
		border-bottom: 1px solid #eeeeee;
	}

	.order-section {
		display: grid;
		grid-template-columns: repeat(16, 1fr);
		margin-bottom: 200px;
	}

	.cn-box p {
		margin: 0;
	}

	.body-wrap {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;

	}

	.content {
		display: block;
		position: sticky;
		align-self: start;
		grid-column: 7/11;
		top: 50px;
		width: 470px;
		margin: 0 auto;
	}

	/* 주문상품내역 */
	.order-product .hd-title {
		font-family: var(--ft-no-fu);
		font-size: 13px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.order-product .header-wrap {
		margin-top: 40px;
		position: sticky;
	}

	.order-product .header-list {
		position: sticky;
		display: grid;
		grid-template-columns: 3fr 1fr 1fr 1fr;
		padding: 10px 0 20px;
	}

	.order-product .header-col {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.product .product-info .info-row .name {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.55;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.product .color-title {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: 500;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.product .list-row {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.55;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.number-info {
		margin-bottom: 40px;
		border-bottom: 1px solid #eeeeee;
	}

	.option-info {
		padding-bottom: 20px;
		border-bottom: 1px solid #eeeeee;
	}

	.product .size__box li {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: 500;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.order-product .product-wrap {
		max-height: 410px;
		overflow-y: auto;
	}

	.order-product .body-list {
		display: grid;
		grid-template-columns: 3fr 1fr 1fr 1fr;
		width: 100%;
		border-bottom: 1px solid #eeeeee;
		padding: 10px 0;
	}

	.order-product .product-info {
		display: flex;
		padding: 0px;
		gap: 10px;
		border: none;
	}

	.order-product .product-info .info-row[data-refund="true"]::after {
		content: "교환 반품 불가";
		font-family: var(--ft-no-fu);
		font-size: 10px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.7;
		letter-spacing: normal;
		text-decoration: underline;
		text-align: left;
		color: #808080;
	}

	.order-product .product-info .info-box {
		display: flex;
		flex-direction: column;
		gap: 5px;
		justify-content: flex-start;
	}

	.order-product .product-info .info-row {
		gap: 3px;
		justify-content: flex-start;
	}

	.order-product .product-info .info-row.mobile-saleprice {
		display: none;
	}

	.order-product .web-saleprice {
		display: block;
	}

	.order-product .prd-img {
		/* max-width: 3.65vw; */
		max-width: 70px;
		max-height: 86px;
	}

	.order-product .product-toggle-btn {
		display: none;
	}

	.calculation-box {
		display: flex;
		flex-direction: column;
		gap: 20px;
		padding: 20px 0;
		border-bottom: 1px solid #dcdcdc;
	}

	.calculation-box .point-box {
		display: flex;
		flex-direction: column;
		gap: 20px;
	}

	.calculation-row {
		display: flex;
		justify-content: space-between;
	}

	.total-price {
		text-decoration: underline;
	}

	.total-price-wrap {
		display: flex;
		justify-content: space-between;
		padding: 20px 0;
	}

	.content input {
		border: 1px solid #808080;
	}


	.wrapper {
		width: 100%;
	}

	.wrapper[data-group="1"] {
		border-bottom: 1px solid #eeeeee;
		padding-bottom: 10px;
		margin-bottom: 40px;
		display: none;
	}

	.wrapper[data-group="1"].next {
		display: block;
	}

	.wrapper[data-group="1"] .header-wrap {
		border: 0px;
	}

	.wrapper[data-group="1"] .point-row {
		padding-bottom: 10px;
	}

	.wrapper[data-group="1"] .get-point {
		padding-bottom: 10px;
	}

	.header-wrap {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding-bottom: 10px;
	}

	.header-box-btn {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		gap: 10px;
	}

	.header-box {
		padding-bottom: 10px;
		font-family: var(--ft-no-fu);
		font-size: 13px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.header-btn {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		color: var(--bk);
		height: 24px;
		padding: 0 15px;
		border-radius: 2px;
		border: solid 1px #dcdcdc;
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;

	}

	.banner-wrap {
		display: grid;
		grid-template-columns: repeat(16, 1fr);
		width: 100%;
		height: 200px;
		background-color: #ffffff;
	}

	.banner-wrap .banner-box {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100%;
		grid-column: 7/11;
		font-family: var(--ft-no-fu);
		font-size: 13px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;

	}

	.cn-box {
		display: flex;
		flex-direction: column;
		gap: 10px;
	}

	.check-row {
		display: flex;
		gap: 10px;
		margin-bottom: 10px;
		justify-content: space-between;
	}

	.check-row input[type="checkbox"] {
		width: 10px;
		height: 10px;
		cursor: pointer;
	}

	.calculation-wrap {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.55;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.total-price-wrap {
		border-bottom: 1px solid #dcdcdc;
	}

	/* 바우처 */
	.voucher-info {
		margin-bottom: 40px;
	}

	.voucher-info-list {
		display: flex;
		gap: 10px;
		flex-direction: column;
		padding: 10px 14px;
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.64;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	/* 포인트 */
	.point-row {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 10px;
	}

	.point-row input {
		grid-column: 1/4;
	}

	.point-row .point-btn {
		cursor: pointer;
		grid-column: 4/5;
	}

	.point-btn {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		height: 40px;
		border-radius: 1px;
		background-color: #dcdcdc;
	}

	.reserves-info-list {
		display: flex;
		gap: 10px;
		flex-direction: column;
		padding: 10px 14px;
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.36;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.charge-info .body-wrap {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	.charge-btn {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		width: 99%;
		max-width: 100%;
		height: 40px;
		margin-bottom: 10px;
		border-radius: 1px;
		border: solid 1px #dcdcdc;
		font-family: var(--ft-no-fu);
		font-size: 12px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
	}

	/* 주문자정보 */
	.wrapper.order-info {
		margin-bottom: 70px;
	}

	/* 배송지정보 */
	.address-info {
		padding-bottom: 20px;
		margin-bottom: 40px;
		border-bottom: 1px solid #eeeeee;
	}

	.address-info .header-box-btn {
		padding-bottom: 10px;
	}

	.address-info .message-box {
		display: flex;
		flex-direction: row;
		gap: 5px;
	}

	.address-info .cn-box {
		padding-bottom: 15px;
	}

	.address-info .confirm-text.check::after {
		content: attr(data-content);
		font-family: var(--ft-no-fu);
		font-size: 11px;

		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: right;
		position: absolute;
		right: 0;
		bottom: 40px;
		color: #ff0000;
		text-decoration: underline;
	}

	.header-under {
		text-decoration: underline;
		padding-bottom: 10px;
		font-size: 11px;
	}

	.edit-box .input-row {
		display: flex;
		flex-direction: column;
		gap: 10px;
		margin-bottom: 10px;
		position: relative;
	}

	.edit-box .input-row.addr-search {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 10px;
		align-items: end;
	}

	.edit-box .input-row.addr-search .input-text {
		grid-column: 1/4;
		display: flex;
		flex-direction: column;
		gap: 10px;
		margin-bottom: 0px;
	}

	.edit-box .input-row.addr-search .input-text input {
		height: 40px;
	}

	.addr-search-btn {
		cursor: pointer;
		grid-column: 4/5;
		display: flex;
		justify-content: center;
		align-items: center;
		color: var(--bk);
		height: 40px;
		padding: 0 15px;
		border-radius: 2px;
		border: solid 1px #dcdcdc;
	}

	.keyword_label {
		display: none;
	}

	.search_button {
		grid-column: 4/5;
		display: flex;
		justify-content: center;
		align-items: center;
		color: var(--bk);
		height: 40px;
		padding: 0 15px;
		border-radius: 2px;
		border: solid 1px #dcdcdc;
	}

	.edit-box .input-row input {
		height: 40px;
		padding-left: 10px;
		border-radius: 1px;
		border: solid 1px #808080;
		vertical-align: middle;
	}

	.edit-box .check-row {
		display: flex;
		gap: 10px;
		margin-bottom: 10px;
		justify-content: space-between;
	}

	.save-btn {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		color: var(--bk);
		height: 24px;
		padding: 0 15px;
		border-radius: 2px;
		border: solid 1px #dcdcdc;
	}

	.to-place {
		margin-bottom: 10px;
		text-decoration: underline;
	}

	.check-text {
		display: flex;
		gap: 10px;
		align-items: center;
	}

	.directBox {
		display: none;
		width: 100%;
	}


	/* 약관동의 */

	.terms-info-list {
		display: flex;
		gap: 5px;
		flex-direction: column;
		padding: 10px 0;
	}

	.terms-service {
		font-family: var(--ft-no-fu);
		font-size: 11px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.64;
		letter-spacing: normal;
		text-align: left;
		color: #343434;
		padding-top: 20px;
		margin-bottom: 40px;
	}

	.terms-service .header-title {
		padding-top: 20px;
		font-size: 13px;
	}

	/* 스탭 버튼 */


	.step-btn-wrap {
		display: flex;
		justify-content: space-between;
		gap: 10px;
	}

	.step-btn {
		cursor: pointer;
		height: 40px;
		width: 50%;
		display: flex;
		justify-content: center;
		align-items: center;
		font-family: var(--ft-no-fu);
		font-size: 12px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;

	}

	.step-btn.pre {
		background-color: var(--wh);
		color: var(--bk);
		border: solid 1px var(--solid-bk);
	}

	.step-btn.next {
		background-color: var(--bk-dark);
		color: var(--wh);
		border: solid 1px var(--bk-dark);
	}


	#postcodify {
		margin: 0;
		max-height: 400px;
		overflow: auto;
	}

	#postcodify .keyword {
		grid-column: 1/4;
	}

	#postcodify .search_button {
		grid-column: 4/5;
	}

	.post-change-result {
		width: 74.5%;
		margin: 0 !important;
		background-color: #fff;
		overflow: auto;
		max-height: 300px;
		border: 1px solid #808080;
		border-top: 0px;
		top: -32px;
	}

	.postcodify_search_controls {
		display: grid;
		gap: 10px;
		grid-template-columns: repeat(4, 1fr);
	}

	.postcodify_search_result .code5 {
		color: var(--bk);
	}

	.postcodify_search_result .addr-row {
		color: #dcdcdc;
	}

	.postcodify_search_result .old_addr-row {
		color: #dcdcdc;
	}

	@media (max-width: 1025px) {
		.banner-wrap {
			display: inline-block;
		}

		.order-section {
			display: inline-block;
			padding: 10px;
		}

		.product .product-info {
			height: auto;
		}

		.order-section {
			display: flex;
			flex-direction: column;
			padding: 0 10px;
		}

		.content.left {
			position: static;
			width: 100%;
			display: none;
		}

		.content.rigth {
			padding-top: 47px;
		}

		.content.mobile {
			margin-bottom: 40px;
		}

		.content.mobile li,
		ul {
			list-style: none;
		}

		.terms-service {
			padding: 0;
		}

		.step-btn-wrap {
			order: 8;
		}

		.order-product .header-box {
			display: flex;
			justify-content: space-between;
			align-items: center;
			flex-grow: 1;
		}

		.order-product .product-toggle-btn {
			cursor: pointer;
			display: flex;
			justify-content: center;
			align-items: center;
			color: var(--bk);
			height: 24px;
			padding: 0 15px;
			border-radius: 2px;
			border: solid 1px #dcdcdc;
			font-family: var(--ft-no-fu);
			font-size: 11px;
			font-weight: normal;
			font-stretch: normal;
			font-style: normal;
			line-height: normal;
			letter-spacing: normal;
		}

		.order-product .body-list {
			grid-template-columns: 4fr 1fr 1fr;
		}

		.order-product .product-info .info-row.mobile-saleprice {
			display: block;
		}

		.order-product .web-saleprice {
			display: none;
		}

		.order-product .product-wrap {
			margin-bottom: 20px;
		}

		.order-product .product-count {
			display: flex;
			height: 100%;
			align-items: flex-end;
			justify-content: flex-end;
		}

		.order-product .total-price {
			display: flex;
			height: 100%;
			align-items: flex-end;
			justify-content: flex-end;
		}

		.order-product .product-count::before {
			content: "Qty:";
		}

		.calculation-box {
			padding: 0;
			border-bottom: 0px;
			gap: 10px;
			margin-top: 20px;
		}

		.total-price-wrap {
			border-bottom: 1px solid #dcdcdc;
			border-top: 1px solid #dcdcdc;
			padding: 10px 0;
			margin-top: 10px;
		}

		.post-change-result {
			width: 100%;
		}

		.total-price {
			text-decoration: underline;
		}

		.number-info,.address-info {
			margin-bottom: 17.5px;
		}
		.order-product .header-wrap {
			margin: 20px 0 10px;
		}
		.address-info{
			padding-bottom: 10px;
		}
		.calculation-box .point-box {
			gap: 10px;
		}

		.terms-info-list {
			padding-bottom: 0;
		}
		.order-product .header-list {
			display: none;
		}
		.header-wrap,.option-info {
			padding: 0;
		}
		.body-wrap.padding{
			padding-bottom: 10px;
		}
	}
</style>

<?php
	$country = null;
	if (isset($_SESSION['COUNTRY'])) {
		$country = $_SESSION['COUNTRY'];
	}
	
	$member_idx = 0;
	if (isset($_SESSION['MEMBER_IDX'])) {
		$member_idx = $_SESSION['MEMBER_IDX'];
	}
	
	$order_idx = 0;
	if (isset($_GET['order_idx'])) {
		$order_idx = $_GET['order_idx'];
	}
	
	if ($member_idx > 0 && $order_idx > 0) {
		$order_cnt = $db->count("dev.ORDER_INFO", "IDX = ".$order_idx." AND MEMBER_IDX = ".$member_idx);

		if ($order_cnt > 0) {
			$select_order_sql = "
					SELECT
						OI.IDX						AS ORDER_IDX,
						OI.COUNTRY					AS COUNTRY,
						OI.ORDER_CODE				AS ORDER_CODE,
						OI.TO_PLACE					AS TO_PLACE,
						OI.TO_NAME					AS TO_NAME,
						OI.TO_MOBILE				AS TO_MOBILE,
						OI.TO_ZIPCODE				AS TO_ZIPCODE,
						IFNULL(
							OI.TO_ROAD_ADDR,
							OI.TO_LOT_ADDR
						)							AS TO_ADDR,
						OI.TO_DETAIL_ADDR			AS TO_DETAIL_ADDR,
						OI.ORDER_MEMO				AS ORDER_MEMO,
						OI.PG_PAYMENT				AS PG_PAYMENT,
						OI.PG_PRICE					AS PG_PRICE,
						OI.PRICE_PRODUCT			AS PRICE_PRODUCT,
						OI.PRICE_DISCOUNT			AS PRICE_DISCOUNT,
						OI.PRICE_MILEAGE_POINT		AS PRICE_MILEAGE_POINT,
						OI.PRICE_CHARGE_POINT		AS PRICE_CHARGE_POINT,
						OI.PRICE_DELIVERY			AS PRICE_DELIVERY,
						OI.PRICE_TOTAL				AS PRICE_TOTAL
					FROM
						dev.ORDER_INFO OI
					WHERE
						OI.IDX = ".$order_idx.";
				";

			$db->query($select_order_sql);

			$order_info = array();
			$order_product = array();
			
			foreach ($db->fetch() as $order_data) {
				$order_idx = $order_data['ORDER_IDX'];
				$country = $order_data['COUNTRY'];
				
				if (!empty($order_idx)) {
					$select_order_product_sql = "
						SELECT
							(
								SELECT
									REPLACE(
										S_PI.IMG_LOCATION,
										'/var/www/admin/www/',
										''
									)
								FROM
									dev.PRODUCT_IMG S_PI
								WHERE
									S_PI.PRODUCT_IDX = OP.PRODUCT_IDX AND
									S_PI.IMG_TYPE = 'P' AND
									S_PI.IMG_SIZE = 'S'
								ORDER BY
									S_PI.IDX ASC
								LIMIT
									0,1
							)								AS IMG_LOCATION,
							OP.PRODUCT_NAME					AS PRODUCT_NAME,
							OM.COLOR						AS COLOR,
							OM.COLOR_RGB					AS COLOR_RGB,
							OP.OPTION_NAME					AS OPTION_NAME,
							PR.SALES_PRICE_".$country."		AS SALES_PRICE,
							OP.PRODUCT_QTY					AS PRODUCT_QTY,
							OP.PRODUCT_PRICE				AS PRODUCT_PRICE,
							(
								OP.PRODUCT_QTY * OP.PRODUCT_PRICE
							)								AS PRICE_TOTAL
						FROM
							dev.ORDER_PRODUCT OP
							LEFT JOIN dev.SHOP_PRODUCT PR ON
							OP.PRODUCT_IDX = PR.IDX
							LEFT JOIN dev.ORDERSHEET_MST OM ON
							PR.ORDERSHEET_IDX = OM.IDX
						WHERE
							OP.ORDER_IDX = ".$order_idx." AND
							OP.PRODUCT_CODE NOT LIKE 'VOUXXX%'
					";
					
					$db->query($select_order_product_sql);

					foreach ($db->fetch() as $product_data) {
						$order_product[] = array(
							'img_location'		=>$product_data['IMG_LOCATION'],
							'product_name'		=>$product_data['PRODUCT_NAME'],
							'color'				=>$product_data['COLOR'],
							'color_rgb'			=>$product_data['COLOR_RGB'],
							'option_name'		=>$product_data['OPTION_NAME'],
							'sales_price'		=>number_format($product_data['SALES_PRICE']),
							'product_qty'		=>$product_data['PRODUCT_QTY'],
							'product_price'		=>number_format($product_data['PRODUCT_PRICE']),
							'price_total'		=>number_format($product_data['PRICE_TOTAL'])
						);
					}

					$order_info = array(
						'order_code'			=>$order_data['ORDER_CODE'],
						'to_place'				=>$order_data['TO_PLACE'],
						'to_name'				=>$order_data['TO_NAME'],
						'to_mobile'				=>$order_data['TO_MOBILE'],
						'to_zipcode'			=>$order_data['TO_ZIPCODE'],
						'to_addr'				=>$order_data['TO_ADDR'],
						'to_detail_addr'		=>$order_data['TO_DETAIL_ADDR'],
						'order_memo'			=>$order_data['ORDER_MEMO'],
						'pg_payment'			=>$order_data['PG_PAYMENT'],
						'pg_date'				=>$order_data['PG_DATA'],
						'pg_price'				=>$order_data['PG_PRICE'],
						'price_product'			=>number_format($order_data['PRICE_PRODUCT']),
						'price_discount'		=>number_format($order_data['PRICE_DISCOUNT']),
						'price_mileage_point'	=>number_format($order_data['PRICE_MILEAGE_POINT']),
						'price_charge_point'	=>number_format($order_data['PRICE_CHARGE_POINT']),
						'price_delivery'		=>number_format($order_data['PRICE_DELIVERY']),
						'price_total'			=>number_format($order_data['PRICE_TOTAL'])
					);
				}
			}
		} else {
			/*
			echo "
					<script>
						location.href='/main';
					</script>
				";
			*/
		}
	}
?>

<main>
	<div class="banner-wrap">
		<div class="banner-box">
			<span>주문이 완료되었습니다.</span>
		</div>
	</div>
	<section class="order-section">
		<div class="content">
			<div class="wrapper number-info">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">주문번호</span>
						<span>
							<?= $order_info['order_code'] ?>
						</span>
					</div>
				</div>
			</div>
			<div class="wrapper address-info" data-group="3">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">배송지정보</span>
					</div>
				</div>
				<div class="body-wrap">
					<div class="save-box">
						<div class="to-place">
							<?= $order_info['to_place'] ?>
						</div>
						<div class="cn-box">
							<p class="to-name">
								<?= $order_info['to_name'] ?>
							</p>
							<p class="to-phone">
								<?= $order_info['to_mobile'] ?>
							</p>
							<p class="to-zipcode">
								<?= $order_info['to_zipcode'] ?>
							</p>
							<p class="to-addr">
								<?= $order_info['to_addr'] ?>
							</p>
							<p class="to-detail">
								<?= $order_info['to_detail_addr'] ?>
							</p>
						</div>
						<div class="message-box">
							<span class="hd-title">배송메시지</span>
							<span class="message-content">
								<?= $order_info['order_memo'] ?>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="wrapper option-info" data-group="3">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">결제수단</span>
					</div>
					<div class="header-under">
						<span>영수증보기</span>
					</div>
				</div>
				<div class="body-wrap padding">
					<div>신용카드</div>
				</div>
			</div>
			<div class="wrapper order-product" style="">
				<div class="header-wrap">
					<div class="header-box">
						<span class="hd-title">주문내역</span>
					</div>
				</div>
				<div class="header-list">
					<div class="header-col prd-col"><span>제품</span></div>
					<div class="header-col price-col"><span>가격</span></div>
					<div class="header-col qty-col"><span>수량</span></div>
					<div class="header-col sum-col"><span>합계</span></div>
				</div>
				<div class="body-wrap">
					<?php
					foreach ($order_product as $product_data) {
						?>
						<div class="body-list product">
							<div class="product-info">
								<img class="prd-img" cnt="1"
									src="http://116.124.128.246:81/<?= $product_data['img_location'] ?>" alt="">
								<div class="info-box">
									<div class="info-row">
										<div class="name" data-soldout=""><span>
												<?= $product_data['product_name'] ?>
											</span></div>
									</div>
									<div class="info-row mobile-saleprice">
										<div class="product-price">
											<?= $product_data['product_price'] ?>
										</div>
									</div>
									<div class="info-row">
										<div class="color-title"><span>
												<?= $product_data['color'] ?>
											</span></div>
										<div class="color__box" data-maxcount="" data-colorcount="1">
											<div class="color" data-color="<?= $product_data['color_rgb'] ?>"
												data-soldout="STIN"
												style="background-color:<?= $product_data['color_rgb'] ?>"></div>
										</div>
									</div>
									<div class="info-row">
										<div class="size__box">
											<li class="size" data-soldout="STIN">
												<?= $product_data['option_name'] ?>
											</li>
										</div>
									</div>
								</div>
							</div>

							<div class="list-row web-saleprice">
								<span class="product-price">
									<?= $product_data['sales_price'] ?>
								</span>
							</div>
							<div class="list-row">
								<span class="product-count">
									<?= $product_data['product_qty'] ?>
								</span>
							</div>
							<div class="list-row">
								<span class="total-price">
									<?= $product_data['product_price'] ?>
								</span>
							</div>
						</div>
					<?php
					}
					?>

					<div class="calculation-wrap">
						<div class="calculation-box">
							<div class="product-sum calculation-row">
								<span>제품 합계</span>
								<span class="cal-price">
									<?= $order_info['price_product'] ?>
								</span>
							</div>
							<div class="point-box">
								<div class="calculation-row">
									<span>바우처 사용</span>
									<span class="voucher-point-use" data-voucher="0">
										<?= $order_info['price_discount'] ?>
									</span>
								</div>
								<div class="calculation-row">
									<span>적립 포인트 사용</span>
									<span class="accumulate-point-use" data-accumulate="0">
										<?= $order_info['price_mileage_point'] ?>
									</span>
								</div>
								<div class="calculation-row">
									<span>충전 포인트 사용</span>
									<span class="charge-point-use" data-charge="0">
										<?= $order_info['price_charge_point'] ?>
									</span>
								</div>
							</div>
							<div class="calculation-row">
								<span>배송비</span>
								<span data-delprice="5000" class="del-price">
									<?= $order_info['price_delivery'] ?>
								</span>
							</div>
						</div>
						<div class="total-price-wrap">
							<div class="total-box">
								<span>최종 결제금액</span>
								<span class="product-qty hidden"></span>
							</div>
							<span class="total-price">
								<?= $order_info['price_total'] ?>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="terms-service " data-group="4">
				<div class="header-title">주문 취소 안내</div>
				<div class="terms-info-list">
					<p>·&nbsp;'주문 접수' 및 '결제 완료' 단계 : [회원정보>주문>주문상세] 에서 취소 가능
						합니다.</p>
					<p>·&nbsp;'배송 준비중' 이후 단계 : 주문취소 불가하며, 제품 수령 후 '반품'으로 진행
						부탁드립니다.</p>
				</div>
				<div class="header-title">반품 안내</div>
				<div class="terms-info-list">
					<p>·&nbsp;반품 접수는 제품 수령 후 7일 이내 가능합니다.</p>
					<p>·&nbsp;주문 상태가 '배송 완료' 일 경우 [회원정보>주문>주문상세] 에서 반품 접수 가능하며,
						'배송중' 으로 보여질 경우 고객 서비스팀으로 연락 주시기 바랍니다.</p>
					<p>·&nbsp;반품 절차는 아래 링크를 참고하시기 바랍니다.</p>
				</div>
			</div>
			<div class="step-btn-wrap">
				<div class="step-btn pre" onClick="location.href='/order/basket/list'"><span>계속 쇼핑하기</span></div>
				<div class="step-btn next" data-step="1" onClick="location.href='/mypage/main?mypage_type=orderlist'">
					<span>주문/배송조회</span>
				</div>
			</div>
		</div>
	</section>
</main>
<script>
	window.addEventListener("resize", function () {
		resizeEvent();
	});

	function resizeEvent() {
		const bodyWidth = document.querySelector("body").offsetWidth;
		if (1024 <= bodyWidth) {
			document.querySelector(".order-product").querySelector(".header-list").classList.remove("hidden");
		} else if (1024 >= bodyWidth) {
			document.querySelector(".order-product").querySelector(".header-list").classList.add("hidden");
		}
	}
</script>