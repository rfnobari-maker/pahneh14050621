$(document).ready(function() {
    $('#txtsearch').keyup(function(){
		$().html('loding ...!') ;
		var searchTerm=$('#txtsearch').val() ; 
		$.post('sh_searche.php',{txtsearch:searchTerm},function(data){
		$('#result').html(data) ; 	
		});
	});
});