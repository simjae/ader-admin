<?php
	if (!isset($_SESSION['MEMBER_IDX'])) {
		echo "
			<script>
				location.href='/login';
			</script>
		";
	}
	
	include $_CONFIG['PATH']['PAGE'] . '/components/basket.php';	
?>
<style>main{overflow-x: initial;}</style>
<script type="module">
    import ForyouRender from '/scripts/module/foryou.js';
    import { Basket} from '/scripts/module/basket.js';
    const basket = new Basket("basket",false);
    const foryou = new ForyouRender();
</script>