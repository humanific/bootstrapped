<?php


function ajax_login(){
    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>'error'));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>'success'));
    }
	die();
}


   


// Execute the action only if the user isn't logged in





function arthus_login_modal(){ ?>
<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form id="lostpassword"  method="post" class="form-horizontal">
        </form>
	    <form id="login"  method="post" class="form-horizontal">
	        <h3><?php _e('Log in','arthus');?></h3>
	        <div id="status"></div>
			<div class="form-group">
			<label class="col-sm-4 control-label" for="username"><?php _e('Email','arthus'); ?></label>
			<div class="col-sm-6">
			<input type="text" name="username" id="username" class="form-control" />
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-4 control-label" for="password"><?php _e('Password','arthus'); ?></label>
			<div class="col-sm-6">
			<input type="password" name="password" id="password" class="form-control" />
			</div>
			</div>
			
			<div class="form-group">
			<div class="col-sm-offset-4 col-sm-6">
	        <input class="btn btn-primary" type="submit" value="<?php _e('Log in','arthus');?>" name="submit">
	        <a class="btn btn-default" data-dismiss="modal"><?php _e('Cancel','arthus');?></a>
			</div>
			</div>
	        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
	        <hr>
			<div class="form-group">
			<div class="col-sm-offset-4 col-sm-6">
	        <a class="lost" href="<?php $pass = arthus_get_custompage('lostpassword'); echo $pass['url']; ?>"><?php echo $pass['title'];?></a><br>
	        <a href="<?php $reg = arthus_get_custompage('register'); echo $reg['url'];?>"><?php echo $reg['title'];?></a>
			</div>
			</div>

			</form>


			<script>
			jQuery(function($) {
				var msgs = {error:"<?php _e('Wrong username or password.','arthus');?>",
				success:"<?php _e('Login successful, redirecting...','arthus');?>"}
			    $('form#login').on('submit', function(e){
			        $('form#login #status').show().text("<?php _e('Sending user info, please wait...','arthus');?>").attr( "class", "alert alert-info" );
			        $.ajax({
			            type: 'POST',
			            dataType: 'json',
			            url: '<?php echo admin_url( 'admin-ajax.php' );?>',
			            data: { 
			                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
			                'username': $('form#login #username').val(), 
			                'password': $('form#login #password').val(), 
			                'security': $('form#login #security').val() },
			            success: function(data){
			            console.log('success',$('form#login div.status'));
			                $('form#login #status').text(msgs[data.message]);
			                if (data.loggedin == true){
			                    window.location.reload();
			                    $('form#login #status').attr( "class", "alert alert-success" );
			                }else{
			                	$('form#login #status').attr( "class", "alert alert-danger" );
			                }
			            }
			        });
			        e.preventDefault();
			    });
			});
			</script>
      </div>
    </div>
  </div>
</div> <?php
	
}



if (!is_user_logged_in()) {
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
	add_action('wp_footer', 'arthus_login_modal', 100);
}
?>