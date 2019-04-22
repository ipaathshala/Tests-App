$(document).ready(function(){
	$("#invexam, #invfile, #invans, #invplus, #invalid, #fail, #success, #loader").hide();

	/*Load exam list on page refresh*/
	$.ajax({
		type:'POST',
		url:'php-ajax/qusexam-list',
		success:function(result){
			if(result!=0){
				$('#exam').html(result).show();
			}
		},
		error: function(error){
			$('#fail').delay('2000').show().slideUp('fast');
			return false;
		}
	});

	/*Save test details*/
	$('form').submit(function(){
		var examid = $("#exam option:selected").val();
		var fileType = $("#file").val();
		var answer = $("#ans option:selected").val();
		var extensions = [".jpg", ".jpeg", ".png"];
		var check = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + extensions.join('|') + ")$");

		var plusmarks = $('#positive').val();
		var minusmarks = $('#negative').val();

		if(examid=='0'){
			$('#invexam').delay(2000).show().slideUp('fast');
			return false;
		}
		if(fileType==='' || !check.test(fileType.toLowerCase())) {
			$('#invfile').delay(2000).show().slideUp('fast');
			return false;
		}
		if(answer=='0'){
			$('#invans').delay(2000).show().slideUp('fast');
			return false;
		}
		if(plusmarks=='0'){
			$('#invplus').delay(2000).show().slideUp('fast');
			return false;
		}
		else{
			$.ajax({
			type:'POST',
			url:'php-ajax/save-test',
			data:new FormData (this),
			contentType:false,
			cache:false,
			processData:false,
			beforeSend:function(result){
				$('button').hide();
				$('#loader').show();
			},
			success:function(result){
				if(result == true){
					$('#success').delay('2000').show().slideUp('fast');
					$('form').trigger('reset');
					$('#loader').hide();
					$('button').show();	
				}
			},
			error:function(error){
				$('#loader').hide();
				$('button').show();
				$('#fail').delay('2000').show().slideUp('fast');
				return false;	
			},
			complete:function(result){
				$("#loader").hide();
				$('button').show();
			}
			});
			return false;
		}
	});
});