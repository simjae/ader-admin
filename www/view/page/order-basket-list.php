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
<script>
	const foryou = new ForyouRender();
</script>
<script type="module">
    import { Basket} from '/scripts/module/basket.js';
    const basket = new Basket("basket",false);
</script>