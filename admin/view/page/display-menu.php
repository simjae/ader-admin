<style>
	ul{
		list-style: none;
	}
	li{
		color: aquamarine;
		list-style: none;
	}
	.edit__menu__wrap{
		display: flex;
		gap: 20px;
		
	}
	.large__nav__wrap{
		justify-content: center;
		width: 170px;
	}
	.large__nav--box{
		display: flex;
		justify-content: center;
	}
	.large__nav--box:first-child{
		margin: 10px;
	}
	.large__nav--btn{
		border-radius: 7px;
		width: 170px;
		text-align: center;
		padding: 10px;
		background-color: #6a6a6a;
		color: #fff;
		margin-bottom: 30px;
		cursor: pointer;
		display: flex;
		justify-content: space-around;
		align-items: center;
	}
	.large__nav--btn.checked{
		background-color: #140f82;
	}

	.medium__nav__wrap{
		display: flex;
		flex-direction: column;
		gap: 10px;
	}
	.medium__nav--btn{
		width: 100%;
		border-radius: 7px;
		background-color: #d5d5d5;
		color: #000;
		text-align: center;
		padding: 10px;
		cursor: pointer;
		display: flex;
		justify-content: space-around;
		align-items: center;
	}
	.medium__nav--btn.checked{
		background-color: #140f82;
		color: #fff;
	}
	.small__nav__wrap{
		display: flex;
		flex-direction: column;
		gap: 10px;
	}
	.small__nav--btn{
		width: 100%;
		padding: 2px 10px;
		border-radius: 7px;
		background-color: #efefef;
		color: #000;
		text-align: center;
		cursor: pointer;
		display: flex;
		justify-content: space-around;
		align-items: center;
	}
	.small__nav--btn.checked{
		background-color: #efefef;
		color: #000;
	}
	.small__nav__box:first-child{
		margin-top: 10px;
	}


	.hidden{
		display: none;
	}
	#modal{
		position: absolute;
		top: 0;
		z-index: 1;
		width: 100%;
	}
	.modal__bg{
		width: 100%;
		height: 100vh;
		background-color: #000000d1;
		
	}
	.modal__content{
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		background-color: rgb(250, 250, 250);
		width: 400px;
		height: 400px;
		border-radius: 4px;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}
	.content__wrap{
		width: 100%;
	}
	.modal__title{
		text-align: left;
		margin-bottom: 40px;
		font-size:20px;

	}
	.munu__input__wrap input{
		width: 90%;
		padding: 5px;
		margin: 5px;
	}
	.munu__input__wrap label{
		display: grid;
		align-items: center;
		grid-template-columns: 100px 1fr;
	}

	.btn__box{
		display: flex;
		justify-content: space-around;
	}
	.btn__box > div{
		border: #140f82 1px solid;
		padding: 10px 30px;
		border-radius: 4px;
	}
	.modal__apply{
		background-color: #140f82;
		color: #fff;
	}
	.add__wrap{
		display: flex;
		gap: 30px;
		align-items: center;
	}
	.add__btn{
		padding: 5px 10px;
		height: 28px;
		border-radius: 4px;
		border: solid 1px #000000;
		color: #000000;
		background-color: #fff;
		cursor: pointer;
	}
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
<div class="content__card">
	<div class="card__header">
		<div class="add__wrap">
			<h3>메뉴 편집</h3>
			<div class="add__btn" onclick="categoryAddBtn()">카테고리 추가</div>
			<div class="add__btn" onclick="applyBtn()">저장</div>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="overflow-x-auto" style="overflow: auto;">
			<div class="edit__menu__wrap">
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(() => {
	getMenuLoadApi(false);
});
/*---------------- 문서 로드시 메뉴 write ----------------*/
function menuHtmlLoad(data) {
	//let libraryImgHtml = "";
	let large = data;
	let wrap = document.querySelector('.edit__menu__wrap');

    for (let i in large) {
		let largeHtml = '';
		let middleHtml = '';
		let smallHtml = '';
		
		let div = document.createElement('div');
		
		let largeTarget = large[i];
		largeHtml += `
				<div class="large__nav__box">
					<div class='large__nav--btn' onclick='menuBtnCheck(this);' data-title='${largeTarget.menu_lrg_title}' data-type='${largeTarget.menu_lrg_type}' data-url='${largeTarget.menu_lrg_url}'>
						<span data-table_type="LRG" data-idx='${largeTarget.menu_lrg_idx}' class="material-icons" onclick="openMenuModal(this);">edit</span>
						<span class="title" >${largeTarget.menu_lrg_title}</span>
						<span class="material-icons" onclick="menuRemoveBtn(this, 'large');">close</span>
					</div>
		`;
		if(largeTarget.hasOwnProperty('menu_mdl_data')){
			middleHtml = '';
			middleHtml +=`<div class="medium__nav__wrap">`
			let middleTarget = large[i].menu_mdl_data.data;
			for (let j in middleTarget) {
				middleHtml += `
						<div class="medium__nav__box">
							<div class="medium__nav--btn" onclick="menuBtnCheck(this);" data-title='${middleTarget[j].menu_mdl_title}' data-type='${middleTarget[j].menu_mdl_type}' data-url='${middleTarget[j].menu_mdl_url}'>
								<span data-table_type="MDL" data-idx='${middleTarget[j].menu_mdl_idx}'class="material-icons" onclick="openMenuModal(this);">edit</span>	
								<span class="title">${middleTarget[j].menu_mdl_title}</span>
								<span class="material-icons" onclick="menuRemoveBtn(this, 'medium');">close</span>
							</div>
						`;
						if(middleTarget[j].hasOwnProperty('menu_sml_data')){
							smallHtml = '';
							smallHtml +=`<div class="small__nav__wrap">`
							let smallTarget = middleTarget[j].menu_sml_data.data;
							for(let k in smallTarget){
								smallHtml += `
										<div class="small__nav__box">
											<div class="small__nav--btn" onclick="menuBtnCheck(this);" data-title='${smallTarget[k].menu_sml_title}' data-url='${smallTarget[k].menu_sml_url}'>
												<span data-table_type="SML" data-idx='${smallTarget[k].menu_sml_idx}'class="material-icons" onclick="openMenuModal(this);">edit</span>
												<span class="title">${smallTarget[k].menu_sml_title}</span>
												<span class="material-icons" onclick="menuRemoveBtn(this,'small');">close</span>
											</div>
										</div>
										`;
							}
							smallHtml +=`</div>`
						}
						middleHtml += smallHtml;
					middleHtml +=`</div>`
			}
			middleHtml +=`</div>`
		}
		largeHtml += middleHtml;
		largeHtml +=`</div>`



		div.innerHTML= largeHtml; 
		div.classList.add('large__nav__wrap');
		wrap.appendChild(div);
    }
}
function getMenuLoadApi(tmp_flg) {
	$.ajax({
		type: "post",
		data: {
			"tmp_flg":tmp_flg
		},
		dataType: "json",
		url: config.api + "menu/get",
		error: function() {
			alert("불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				if (data != null) {
					menuHtmlLoad(data);
				}
			}
		}
	});
}
/*---------------- 수정 모달 ----------------*/
function getMenuModalApi(tmp_flg, table_type, menu_idx) {
	$.ajax({
		type: "post",
		data: {
			"tmp_flg":tmp_flg,
			"table_type":table_type,
			"menu_idx":menu_idx
		},
		dataType: "json",
		url: config.api + "menu/get",
		error: function() {
			alert("메뉴 정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				if (data != null) {
					console.log(data);
				}
			}
		}
	});
}
function openMenuModal(obj) {
	event.stopPropagation();    
	let tmpFlg = false;
	let menu_idx = $(obj).data('idx');
	let tableType = $(obj).data('table_type');
	let data = {
		'menu_idx':menu_idx,
		'tmp_flg':tmpFlg,
		'table_type':tableType
	};

	let l = $('.large__nav--btn');
	let m = $('.medium__nav--btn');
	let s = $('.small__nav--btn');
	l.not($(obj)).removeClass('checked');
	m.not($(obj)).removeClass('checked');
	s.not($(obj)).removeClass('checked');

	getMenuModalApi(tmpFlg, tableType, menu_idx);
	modal('/get', data);
	$(obj).parent().addClass('checked');
}
/*----------------  클릭한 메뉴 체크  ----------------*/
function menuBtnCheck(e){
	let largeCheck = document.querySelector('.large__nav--btn.checked');
	let mediumCheck = document.querySelector('.medium__nav--btn.checked');
	
	let l = $('.large__nav--btn');
	let m = $('.medium__nav--btn');
	let s = $('.small__nav--btn');
	l.not($(e)).removeClass('checked');
	m.not($(e)).removeClass('checked');
	s.not($(e)).removeClass('checked');
	
	$(e).toggleClass('checked');

	if(largeCheck){
		largeCheck.classList.remove('checked');
	}
	if(mediumCheck){
		mediumCheck.classList.remove('checked');
	}
	// if(s) {
	// 	s.removeClass('checked');
	// }

	let setClass = '.'+$(e).attr('class').split(' ').join('.');
	$('.edit__menu__wrap').data("current",setClass);
}
/*---------------- 카테고리 추가 버튼 ----------------*/
// 0923 수정 : 카테고리 삭제 직후 추가버튼을 누를시 아무런 행동안하는 버그 수정
// 'current'키의 value값을 가져오는 방식대신,
// 카테고리를 클릭했을때 추가되는 클래스인 '.checked' selector를 직접 사용하는 방식으로 수정
function categoryAddBtn(){
	let checked_div = document.querySelectorAll('.checked');
	let div_depth = '';
	
	if(checked_div != undefined && checked_div.length == 1){
		div_depth = checked_div[0].className.split(' ')[0];
	}

	const largeBtnClass ='large__nav--btn';
	const mediumBtnClass ='medium__nav--btn';

	switch(div_depth){
		case largeBtnClass:
			mediumAppend();
			break;
		case mediumBtnClass:
			smallAppend();
			break;
		default:
			largeAppend();
	}
}
/*----------------  카테고리 추가  ----------------*/
function largeAppend() {
	let wrap = document.querySelector('.edit__menu__wrap');
	let div = document.createElement('div');
	let appendHtml = `
			<div class='large__nav--btn' data-depth="1" onclick='menuBtnCheck(this);'>
				<span data-table_type="LRG" data-idx='' class="material-icons" onclick="openMenuModal(this)">edit</span>
				<span class="title" data-title="">대분류</span>
				<span class="material-icons" onclick="menuRemoveBtn(this, 'large');" style="">close</span>
			</div>
			<div class="medium__nav__wrap"></div>
    `;
	div.innerHTML= appendHtml; 
	div.classList.add('large__nav__wrap');
	wrap.appendChild(div);
}
function mediumAppend() {
	let btnCheck = document.querySelector('.large__nav--btn.checked');
	let currentCheck  = btnCheck.nextElementSibling;
	let div = document.createElement('div');
	let appendHtml = `
			<div class="medium__nav--btn" onclick="menuBtnCheck(this);">
				<span data-table_type="MDL" data-idx='' class="material-icons" onclick="openMenuModal(this)">edit</span>	
				<span class="title" data-title="">중분류</span>
				<span class="material-icons" onclick="menuRemoveBtn(this, 'medium');" style="">close</span>
			</div>
			<div class="small__nav__wrap"></div>
			`;
	div.innerHTML= appendHtml; 
	div.classList.add('medium__nav__box');
	currentCheck.appendChild(div);
}
function smallAppend() {
	let btnCheck = document.querySelector('.medium__nav--btn.checked');
	let currentCheck  = btnCheck.nextElementSibling;
	let div = document.createElement('div');
	let appendHtml = `
			<div class="small__nav--btn" onclick="menuBtnCheck(this);">
				<span data-table_type="SML" data-idx='' class="material-icons" onclick="openMenuModal(this)">edit</span>
				<span class="title" data-title="">소분류</span>
				<span class="material-icons" onclick="menuRemoveBtn(this,'small');" style="">close</span>
			</div>
			<div class="small__nav__wrap"></div>
			`;
	div.innerHTML= appendHtml; 
	div.classList.add('small__nav__box');
	currentCheck.appendChild(div);
}
function applyBtn(){
	let lrgWrap =  document.querySelectorAll('.large__nav__wrap');
	let mdlWrap =  document.querySelectorAll('.large__nav__wrap');
	let dataArr =[];
	lrgWrap.forEach((el , index) =>{
		let lrtTitle = el.querySelector('.large__nav--btn').dataset.title;
		let lrgUrl = el.querySelector('.large__nav--btn').dataset.url;
		let lrgType = el.querySelector('.large__nav--btn').dataset.type;
		let dataObj = {};
		dataObj.menu_lrg_idx = index;
		dataObj.menu_lrg_title = lrtTitle;
		dataObj.menu_lrg_url = lrgUrl;
		dataObj.menu_lrg_type = lrgType;
		dataArr.push(dataObj);
	});
	console.log(dataArr);
	return dataArr;
}

/*---------------- 메뉴 요소 삭제 ----------------*/
//0923 수정 : 새로운 최상위 카테고리 추가 후 바로 삭제할 시, 모든 카테고리가 삭제되는 버그 수정
//삭제 버튼 클릭시 실질적으로 없어져야할 최상위 class명으로 접근하여 삭제하는 방식으로 변경
function menuRemoveBtn(e, category){
	switch (category) {
		case 'large':
			$(e).parents('.large__nav__wrap').remove();
			break;
		case 'medium':
			$(e).parents('.medium__nav__box').remove();
			break;
		case 'small':
			$(e).parents('.small__nav__box').remove();
			break;
	}
}
</script>