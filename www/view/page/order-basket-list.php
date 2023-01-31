<?php 
	include $_CONFIG['PATH']['PAGE'] . '/components/basket.php';
?>
<script type="module">
    import ForyouRender from '/scripts/module/foryou.js';
    import { Basket} from '/scripts/module/basket.js';
    const basket = new Basket("basket",false);
    const foryou = new ForyouRender();
</script>