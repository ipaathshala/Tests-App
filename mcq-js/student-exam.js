$(document).ready(function(){
	
	$("#invbatch, #invstudent, #invexam, #invdate, #duplicate, #invalid, #fail, #success, #loader").hide();

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

	/*Load student list*/
	$("#batch").change(function(){
		var batch = $("#batch option:selected").val();
		$.ajax({
			type:'GET',
			url:'php-ajax/student-dropdown',
			data:{batch:batch},
			success:function(result){
				if(result!=0){
					$("#student").html(result).show();
				}
				else{
					$("#student").trigger(0);
				}
			},
			error: function (error){
				$(".fail").delay(2000).show().slideUp('fast');
				return false;
			}
		});
	});

	/*Load exams list*/
	$.ajax({
		type:'POST',
		url:'php-ajax/examlist-option',
		success:function(result){
			if(result!=0){
				$('#exam').html(result).show();
			}
		},
		error: function(error){
			$('#fail').delay(2000).show().slideUp('fast');
			return false;
		}
	});

	$('.addRow').on('click',function(){
		var html1 = '';
		html1 +='<tr>'; 
		html1 +='<td><input type="date" class="form-control startdate" name="startdate[]"></td>'; 
		html1 +='<td><input type="date" class="form-control enddate" name="enddate[]"></td>'; 
		html1 +='<td><input type="time" class="form-control starttime" name="starttime[]"></td>'; 
		html1 +='<td><input type="time" class="form-control endtime" name="endtime[]"></td>'; 
		html1 +='<td><button class="btn btn-danger btn-sm waves-effect waves-light removeRow"><i class="fa fa-times"></i></button></td>'; 
		html1 +='</td>';
		html1 +='</tr>';
		$('#examDetails').append(html1);
	});
	$(document).on('click','.removeRow',function(){
		$(this).closest('tr').remove();
	});

	$('form').submit(function(){
		var batchId = $("#batch option:selected").val();
		var stdId = $("#student option:selected").val();
		var examId = $("#exam option:selected").val();
		var startDate = $('.startdate').val();
		var endDate = $('.enddate').val();
		var startTime = $('.starttime').val();
		var endTime = $('.endtime').val();
		var selectedDate1 = new Date(startDate);
		var selectedDate2 = new Date(endDate);
		var now = new Date();

		if(batchId==0){
			$("#invbatch").delay(2000).show().slideUp('fast');
			return false;
		}
		if(stdId==0){
			$("#invstudent").delay(2000).show().slideUp('fast');
			return false;
		}
		if(examId==0){
			$("#invexam").delay(2000).show().slideUp('fast');
			return false;
		}
		if (selectedDate1 < now || selectedDate2 < now) {
			$("#invdate").delay(2000).show().slideUp('fast');
			return false;
		}
		else{
			$.ajax({
				type:'POST',
				url:'php-ajax/savestd-exam',
				data:new FormData(this),
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(result){
					$('button').hide();
					$('#loader').show();
				},
				success:function(result){
					if(result == 2){
						$('#loader').hide();
						$('button').show();	
						$('#duplicate').delay(2000).show().slideUp('fast');
						return false;
					}
					if(result == true){
						$('#success').delay(2000).show().slideUp('fast');
						$('form').trigger('reset');
						$('#loader').hide();
						$('button').show();	
					}
					if(result == 0){
						$('#invalid').delay(2000).show().slideUp('fast');
						return false;
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