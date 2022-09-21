<?php
/*
 +=============================================================================
 | 
 | 1:1문의 목록
 | ----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.12.8
 | 최종 수정일	: 2015.12.8 21:24
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include '../../static/init.php';

$total = db_count($Table['Qna']);	// 전체 회원수
$num = $total;
if(DBMS == 'MYSQL') {
	$query  = 'SELECT A.*,B.NAME,B.EMAIL,B.MOBILE FROM '.$Table['Qna'].' AS A ';
	$query .= ' LEFT JOIN '.$Table['Member'].' AS B ON A.ID = B.ID ';
	$query .= ' ORDER BY A.IDX DESC';
	$query .= ' LIMIT '.($page-1)*$rownum.','.$rownum;
}
$sql = db_query($query);
$query_list = 'rownum='.$rownum.'&page='.$page;
?>
<form id="frm1" name="frm1">
<input type="hidden" name="idxs">
<table border="0" cellpadding="0" cellspacing="0" class="table-list-1">
<thead>
	<tr>
		<th style="width:30px;text-align:center"><input type="checkbox" class="checkbox-all-toggle" data-form="frm1"></th>
		<th style="width:7%">번호</th>
		<th style="width:10%">회원 아이디</th>
		<th style="width:10%">분류</th>
		<th>제목</th>
		<th style="width:10%">답변여부</th>
		<th style="width:15%">접수일</th>
		<th style="width:120px"></th>
	</tr>
</thead>
<tbody>
<?
if($total > 0) {
	while($data = db_array($sql)) {
		$no = $data['IDX'];
		$id = $data['ID'].' ('.$data['NAME'].')';
		$category = $data['CATEGORY'];
		$title = $data['TITLE'];
		$answer_yn = ($data['STATUS']=='N')?'대기':'완료';
		$regdate = $data['REG_DATE'];
?>
<tr>
	<td class="text-center"><input type="checkbox" name="no" value="<?=$no?>"></td>
	<td><?=$num--?></td>
	<td><?=$id?></td>
	<td><?=$category?></td>
	<td onClick="modal('members/qna-detail','no=<?=$no?>');" class="list-clickable"><?=$title?></td>
	<td><?=$answer_yn?></td>
	<td><?=$regdate?></td>
	<td style="width:120px">
		<a class="btn blue" onClick="modal('members/qna-detail','no=<?=$no?>');"><i class="fa fa-edit"></i> 상세</a>
		<a class="btn red btn-popover" data-popover="delete" data-popover-confirm="members/qna-del.proc" data-popover-query="no=<?=$no?>" data-target="list" data-url="members/qna-list" data-query="rownum=<?=$rownum?>&page=<?=$page?>"><i class="fa fa-trash-o"></i> 삭제</a>
	</td>
</tr>
<?
	}
} else {
?>
<tr>
	<td colspan="8">접수된 1:1문의가 없습니다</td>
</tr>
<?
}
?>

</tbody>
</table>
</form>

<div class="body-row margin-top-15">
	<div class="left">
		<a class="btn btn-large red" onClick="select_delete('frm1','members/qna-del','list','members/qna-list','<?=$query_list?>');"><i class="fa fa-trash-o"></i> 선택 삭제</a>
	</div>
	<div class="right">
		<? 
			$pagenum = paging($total,$rownum,9,$page); 
			echo htmlPaging($pagenum,$page,'members/qna-list','','list');
		?>
	</div>
</div>