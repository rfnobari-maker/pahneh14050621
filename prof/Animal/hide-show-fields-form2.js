		
$("#seeAnotherField2").change(function() {
			if ($(this).val() == "1" || $(this).val() == "2") {
				$('#otherFieldDiv3').show();
				$('#otherFieldDiv4').show();
				$('#otherFieldDiv5').show();
				$('#otherFieldDiv6').show();

			} else {
				$('#otherFieldDiv3').hide();
				$('#otherFieldDiv4').hide();
				$('#otherFieldDiv5').hide();
				$('#otherFieldDiv6').hide();
			}
		});
$("#seeAnotherField2").trigger("change");

