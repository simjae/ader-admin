<html>
<head>
<meta charset="UTF-8">

<script type="text/javascript">

// global(window)영역에 zip-instance를 만들어 둔다.
var zipInst = null;

function myOnChangeFile(evt)
{
	var file = document.getElementById("zipUpload").files[0];
	
	if (file != null)
	{
		var reader = new FileReader();
		reader.onload = function (evt) {
			// 파일내용을 읽으면 이 곳에 온다.
			// 파일내용은 evt.target.result에 있게 되고 이를 JSZip에 넘겨 구조를 파악하게 한다.
			JSZip.loadAsync( evt.target.result ).then(
				// Zip파일내용이 처리되면 화면에 그리는 코드가 수행될 것이다.
				function (zip) 
				{
					zipInst = zip;
					zip_list_images(zipInst);
				}
			);
		}
		reader.onerror = function (evt) {
			alert( 'fail');
		}
		reader.readAsArrayBuffer(file);
	}
	else {
		alert( 'fail');
	}
}

function zip_list_images(zip) 
{
	var data = new FormData();
	var length = Object.keys(zip.files).length;
	var cnt = 0;

	zip.forEach(
		function (relativePath, entry)
		{	
			var file_name;
			var ext;
			if( entry.name.length < 4 ) {
				return;
			}
			ext = entry.name.substr( entry.name.length - 4, 4 );
			file_name = entry.name.substr( 0, entry.name.length - 4 );
			if( entry.name.endsWith('.jpg') || entry.name.endsWith('.png') )
			{	
				zip.file( entry.name ).async("base64").then(
					function ( base64Text )
					{
						var file = convertToFile('data:image/jpeg;base64, ' + base64Text, entry.name);
						data.append('file_name[]', file);
						cnt++;
					}
				).then(
					function(){
						if(length == cnt){
							for (var key of data.keys()) {
								console.log(key);
							}
							for (var value of data.values()) {
								console.log(value);
							}
							$.ajax({
								url: config.api + "zip/add",
								data: data,
								type: "post",  
								processData:false,
								contentType:false,
								dataType: "json",
								success: function(d) {
									if(d.code == 200) {
										;
									}
								},
								error: function() {
									;
								}
							});
						}
					}
				)
			}
		}
	);
}

function convertToFile(dataUrl, name){
	var arr = dataUrl.split(','),
		mime = arr[0].match(/:(.*?);/)[1],
		bstr = atob(arr[1]), 
		n = bstr.length, 
		u8arr = new Uint8Array(n);
		
	while(n--){
		u8arr[n] = bstr.charCodeAt(n);
	}
	return new File([u8arr], name, {type:mime});
}
</script>
</head>
<body>
	<div>
		Zip파일 선택 : <input id="zipUpload" type="file" onchange="myOnChangeFile(event)" />
	</div>
	<form id="frm-add" action="" enctype="multipart/form-data">
	</form>
</body>
</html>