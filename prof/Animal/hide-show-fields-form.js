$("#seeAnotherField2").change(function() {
			if ($(this).val() == "1") {
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


$("#seeAnotherField").change(function() {
			if ($(this).val() == "1") {
				$('#otherFieldDiv1').show();
				$('#otherFieldDiv2').show();
			} else {
				$('#otherFieldDiv1').hide();
				$('#otherFieldDiv2').hide();
			}
		});
		$("#seeAnotherField").trigger("change");
		
     $("#seeAnotherFieldGroup").change(function() {
			if ($(this).val() == "1") {
				$('#otherFieldGroupDiv').show();
			} else {
				$('#otherFieldGroupDiv').hide();
			}
		});
		$("#seeAnotherFieldGroup").trigger("change");
		



		