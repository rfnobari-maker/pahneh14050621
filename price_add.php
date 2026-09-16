<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Insert data in MySQL database using Ajax</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="./assets/js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div style="margin: auto;width: 60%;" dir="rtl">
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<form id="fupForm" name="form1" method="post">
	<div class="row">
    	<div class="form-group" >
			<label for="pwd">کد محصول:</label>
			<input type="text" class="form-control" id="p_cod" placeholder="کد محصول" name="p_cod">
		</div>
		<div class="form-group" >
			<label for="pwd">نام محصول:</label>
			<input type="text" class="form-control" id="p_name" placeholder="نام محصول" name="p_name">
		</div>
		<div class="form-group">
			<label for="pwd">واحد:</label>
			<input type="text" class="form-control" id="p_unit" placeholder="واحد" name="p_unit">
		</div>
		<div class="form-group" >
			<label for="pwd">حداقل قیمت:</label>
			<input type="text" class="form-control" id="min_price" placeholder="حداقل قیمت" name="min_price">
		</div>
		<div class="form-group">
			<label for="pwd">حداکثر قیمت:</label>
			<input type="text" class="form-control" id="max_price" placeholder="حداکثر قیمت" name="max_price">
		</div>

		<input type="button" name="save" class="btn btn-primary" value="ثبت اطلاعات" id="butsave">
	</form>
</div>

<script>
$(document).ready(function() {
$('#butsave').on('click', function() {
$("#butsave").attr("disabled", "disabled");
var p_cod = $('#p_cod').val();
var p_name = $('#p_name').val();
var p_unit = $('#p_unit').val();
var max_price = $('#max_price').val();
var min_price = $('#min_price').val();
if(p_cod!="" && p_name!="" && p_unit!="" && max_price!="" && min_price!=""){
	$.ajax({
		url: "save.php",
		type: "POST",
		data: {
			p_cod: p_cod,
			p_name: p_name,
			p_unit: p_unit,
			max_price: max_price,
			min_price: min_price				
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			if(dataResult.statusCode==200){
				$("#butsave").removeAttr("disabled");
				$('#fupForm').find('input:text').val('');
				$("#success").show();
				$('#success').html('اطلاعات با موفقیت ثبت شد'); 						
			}
			else if(dataResult.statusCode==201){
				alert("Error occured !");
			}
			
		}
	});
	}
	else{
		alert('لطفا همه فیلد ها را تکمیل کنید');
		$("#butsave").removeAttr("disabled");
		
	}
});
});
</script>
</body>
</html>