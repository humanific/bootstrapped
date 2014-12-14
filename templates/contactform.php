<?php

if($_POST) {
		$headers = 'From: '.$_POST['f_name'].' <'.$_POST['email'].'>' . "\r\n";
		$s = is_array($subject) ? $_POST['f_subject'] : $subject ;
		$msg = $s. "\r\nurl : ".$_SERVER['HTTP_REFERER']. "\r\nfrom : ".$_POST['f_name']." ".$_POST['email']. "\r\n\r\n".$_POST['f_msg'];
		
		if(wp_mail( $to,$s , $msg, $headers )){
			echo '<div class="alert alert-success">';
			 _e('Thanks, your message has been sent.','arthus');
			echo '</div>';
			$time = current_time('mysql');
			$data = array(
			    'comment_post_ID' => get_the_ID(),
			    'comment_author' => $_POST['f_name'],
			    'comment_author_email' => $_POST['email'],
			    'comment_content' => '<b>'.$s.'</b>'.$_POST['f_msg'],
			    'comment_date' => $time
			);
			wp_insert_comment($data);
		}else{
				echo '<div class="alert alert-danger">';
				 _e('Sorry, something went wrong.','arthus');
				echo '</div>';
		}
	}

?>
<script src="<?php echo get_stylesheet_directory_uri()?>/js/jquery.validate.js"></script>
<script>

	jQuery(document).ready(function($){
		 $("#contactform").validate();
	})
	jQuery.extend(jQuery.validator.messages, {
        required: "<?php _e("This field is mandatory",'arthus'); ?>", email: "<?php _e('Please check this email address','arthus'); ?>"

   });
</script>
<form method="post" id="contactform"  class="<?php echo $class;?>"  role="form">
			<?php if(is_array($subject)):?>
			<div class="form-group">
			<label class="<?php if($class=='form-horizontal') { echo 'col-sm-3';}?> control-label" for="f_subject"><?php _e('Subject','arthus'); ?></label>
			<div class="<?php if($class=='form-horizontal') { echo 'col-sm-9';}?>"><select name="f_subject" class="form-control ">
			
			<?php foreach($subject as $k=>$s) :?>
			<option <?php if($_REQUEST['subject']==$k) { echo 'selected' ;} ?> value="<?php echo $k; ?>"><?php echo $s; ?></option>
			<?php endforeach;?>

			</select>
			</div></div>
			<?php endif;?>
			<?php if ( is_user_logged_in() ){ 
					global $current_user;
					get_currentuserinfo();
				}
			?>
					<div class="form-group">
						<label class="<?php if($class=='form-horizontal') { echo 'col-sm-3';}?> control-label" for="f_name"><?php _e('Your name','arthus'); ?>*</label>
						<div class="<?php if($class=='form-horizontal') { echo 'col-sm-9';}?>"><input type="text" value="<?php echo $current_user->display_name; ?>" name="f_name" class="form-control required " />
						</div>
					</div>
					<div class="form-group">
						<label class="<?php if($class=='form-horizontal') { echo 'col-sm-3';}?> control-label" for="email"><?php _e('Your email','arthus'); ?>*</label>
						<div class="<?php if($class=='form-horizontal') { echo 'col-sm-9';}?>"><input type="text" value="<?php echo $current_user->user_email; ?>" name="email"  class="form-control required email " />
						</div>
					</div>
					<div class="form-group">
						<label class="<?php if($class=='form-horizontal') { echo 'col-sm-3';}?> control-label" for="f_msg"><?php _e('Your question','arthus'); ?>*</label>
						<div class="<?php if($class=='form-horizontal') { echo 'col-sm-9';}?>"><textarea name="f_msg" class="form-control required " style="height:200px"></textarea>
						</div>
					</div>
			<div class="form-group">
				<input type="hidden" value="<?php echo $_GET['origin']?>" name="origin" />
				<div class="<?php if($class=='form-horizontal') { echo 'col-sm-offset-3 col-sm-9';}?>">
					<input type="submit" class="btn btn-primary" value="<?php _e('Send','arthus'); ?>" />
				</div>
			</div>
		</form>
		