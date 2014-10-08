<div class="container">
	<form id="form-main" class="form-submit" role="form" action="<?php echo site_url($controller.'/process-reset');?>">
		<div class="form-generator">
			<h3 class="logo" style="font-size:32px">Reset Password</h3>
			
			<div id="ajax-response"></div>

			<input type="password" class="form-control input-custom" name="password" placeholder="New password..." required autofocus>
			<input type="password" class="form-control input-custom" name="repassword" placeholder="Retype password..." required>
			<input type="hidden" name="activation_code" value="<?php echo $activation_code;?>">

		    <div class="clearfix" style="margin-top:24px;">
	            <button id="btnGenerate" class="btn-dark pull-left" type="submit" data-loading-text="Please wait...">Reset</button> 
	        	<span class="pull-right">
	        		<a href="<?php echo site_url("auth");?>">Back</a>
	        	</span>
	        </div>

	        <div class="trigger">
		        <span class="glyphicon glyphicon-refresh" style="font-size:48px;"></span>
		    </div>

        </div>
	</form>
</div>

<script type="text/javascript">
$(function(){
	var docHeight = $(document).height();
    var formHeight = $(".form-generator").height();
    
    $(".form-generator").css("margin-top",(docHeight - formHeight - 90)/3);

    $('[data-toggle="tooltip"]').tooltip();

	$('.form-submit').unbind('submit').on('submit', function(e){
		e.preventDefault();
		var form = $(this);
		var btn = form.find('button[type="submit"]');

		form.ajaxSubmit({
			beforeSubmit: function(){
				$('#ajax-response').html("");
				btn.button('loading');
			},
			type: 'post',
			dataType: 'json',
			timeout: 10000,
			success: function(rs){
				if(rs.status == 1){
					$('#ajax-response').append('<div class="alert alert-'+rs.param+'"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> '+rs.message+'</div>');
					
				}else{
					$('#ajax-response').append('<div class="alert alert-'+rs.param+'"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> '+rs.message+'</div>');
				}
				btn.button('reset');
			},
			error: function(){
					$('#ajax-response').append('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> Application has errors.</div>');
			}
		});

	});

});
</script>