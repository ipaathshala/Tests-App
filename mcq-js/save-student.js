$(document).ready(function(){
	
	$("#invbatch, #invfile, #invalid, #fail, #success, #loader").hide();

	/*Load batch list*/
	$.ajax({
		type:'POST',
		url:'php-ajax/loadbatch-list',
		success:function(result){
			if(result!=0){
				$('#batch').html(result).show();
			}
		},
		error: function(error){
			$('#fail').delay(2000).show().slideUp('fast');
			return false;
		}
	});

	$('form').submit(function(){
		var batchid = $('#batch option:selected').val();
		var fileType = $('#file').val();
		var extensions = [".csv"];
		var check = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + extensions.join('|') + ")$");

		if(batchid==0){
			$('#invbatch').delay(2000).show().slideUp('fast');
			return false;
		}
		if(fileType===''||!check.test(fileType.toLowerCase())){
			$('#invfile').delay(2000).show().slideUp('fast');
			return false;
		}
		else{
			$.ajax({
				type:'POST',
				url:'php-ajax/save-student',
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
						$('#success').delay(2000).show().slideUp('fast');
						$('form').trigger('reset');
						$('#loader').hide();
						$('button').show();	
					}
				},
				error:function(error){
					$('#loader').hide();
					$('button').show();
					$('#fail').delay(2000).show().slideUp('fast');
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