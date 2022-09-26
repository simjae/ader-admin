<script>
console.log(config.api + "display/product/grid/lib/get");
$(document).ready(function(){
    $.ajax({
		type: "post",
		data: {
			"product_idx":5
		},
		dataType: "json",
		url: config.api + "display/product/grid/lib/get",
		error: function() {
			alert("상품 이미지 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
            d.forEach(function(index) {
                console.log("data",data)
                console.log("product_code", index.product_code);
        });
            
		}
	});  
});

function product() {
    return(`
        <div class="relative recommend__prd">
            <div class="absolute right-0 p-5">
                <img src="/images/nav/wishlist.svg" alt="">
            </div>
            <div class="recommend__img" style="background-image:url('/images/landing/BLASSTB12GN_1.jpeg') ;"></div>
            <div class="px-2 py-3">
                <div class="flex justify-between">
                    <div>tnnn blazer</div>
                    <div>529.000</div>
                </div>
                <div>Gray</div>
                <div class="flex justify-between">
                    <div class="color__chip">
                        <li class="bg-slate-500"></li>
                        <li class="bg-orange-600"></li>
                        <li class="bg-emerald-400"></li>
                    </div>
                    <div class="flex gap-3">
                        <div>A1</div>
                        <div>A2</div>
                    </div>
                </div>
            </div>
        </div>`
    )
}

const writeProduct = () => {
    product()
}



</script>