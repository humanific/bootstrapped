<?php

function bootstrapped_contact_form($subject,$to, $class=''){
	
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
		<?php
}

function contactform_shortcode( $atts, $content = null ) {
   global $post;
   ob_start();
   bootstrapped_contact_form(
   	isset($atts['subject']) ? $atts['subject'] : __('Information request sent from','bootstrapped')." ".get_permalink( $post->ID ),
	isset($atts['to']) ? $atts['to'] : get_bloginfo( 'admin_email' )
	);
	return ob_get_clean();
}

add_shortcode( 'contactform', 'contactform_shortcode' );



function get_carousel($images){
	global $carouselid;
	$carouselid++;
	ob_start();
	if ($images) :?>
		<div class="carousel slide" data-ride="carousel" id="carousel<?php echo $carouselid ?>">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
			<?php 
			foreach( $images as $k => $imagePost ): ?>
				<li data-target="#carousel<?php echo $carouselid ?>" data-slide-to="<?php echo $k;?>" <?php if($k==0) : ?> class="active" <?php endif; ?>></li>
			<?php endforeach ;?>
		  </ol>
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
			<?php 
			foreach( $images as $k => $imagePost ): 
				$image_attributes = wp_get_attachment_image_src(  $imagePost->ID, 'big' ); 
				?>
				<div class="item<?php if($k==0) : ?> active<?php endif; ?>" ><img src="<?php echo $image_attributes[0]; ?>" /></div>
			<?php endforeach ;?>
		  </div>
		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel<?php echo $carouselid ?>" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		  </a>
		  <a class="right carousel-control" href="#carousel<?php echo $carouselid ?>" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
		</div>
		<?php endif; 
		return ob_get_clean();
}


function carousel_shortcode( $atts, $content = null ) {
   global $post;
   if(isset($atts['ids'])){
   		$pids = explode(',', $atts['ids']);
	   $ids = array();
	   foreach( $pids as $id ) $ids[] = intval($id);
   		$wpq = new WP_Query( array(  'post__in' => $ids ,'post_type' => 'attachment','post_status'=>'inherit') );
		$images = $wpq->posts;
   }else if(isset($atts['postid'])){
		$images =get_children( array('post_parent' => $atts['postid'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
   }else{
   		$images =get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
   }
   return get_carousel($images);
}

add_shortcode( 'carousel', 'carousel_shortcode' );



function add_gallery_styles() {

}



function bootstrapped_gallery_shortcode($atts) {
   global $post;
   wp_enqueue_style( 'blueimpgallery2', get_stylesheet_directory_uri().'/js/blueimp-gallery.min.css');
   wp_enqueue_style( 'blueimpgallery', get_stylesheet_directory_uri().'/js/bootstrap-image-gallery.min.css');
   wp_enqueue_script( 'blueimpgallery', get_stylesheet_directory_uri().'/js/jquery.blueimp-gallery.min.js' , false );
   wp_enqueue_script( 'blueimpgallery', get_stylesheet_directory_uri().'/js/bootstrap-image-gallery.min.js' , false );
	
	
   if(isset($atts['ids'])){
   		$pids = explode(',', $atts['ids']);
	   $ids = array();
	   foreach( $pids as $id ) $ids[] = intval($id);
   		$wpq = new WP_Query( array(  'post__in' => $ids,'post_type' => 'attachment', 'post_status' => 'inherit' ) );
		$images = $wpq->posts;
   }else if(isset($atts['postid'])){
		$images = get_children( array('post_parent' => $atts['postid'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
   }else{
   		$images = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
   }
	ob_start();
	if ($images) :?>
		<div class="gallery">
		<div class="row">
			<?php foreach( $images as $k => $imagePost ): 
				$image_attributes = wp_get_attachment_image_src(  $imagePost->ID, 'thumbnail' ); 
				$large = wp_get_attachment_image_src(  $imagePost->ID, 'large' ); 
				?><div class="col-xs-6 col-md-3">
				<a href="<?php echo $large[0]; ?>" class="thumbnail" data-gallery>
				<img src="<?php echo $image_attributes[0]; ?>" />
				</a>
				</div>
			<?php endforeach ;?>
			</div>
		</div>
		
<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/jscript">
 var borderless = true;
 jQuery('#blueimp-gallery').data('useBootstrapModal', !borderless);
 jQuery('#blueimp-gallery').toggleClass('blueimp-gallery-controls', borderless);
</script>
		
<?php 
add_action( 'wp_print_styles', 'add_gallery_styles', 100 );


endif; 
return ob_get_clean();
}


remove_shortcode('gallery', 'gallery_shortcode'); // removes the original shortcode
add_shortcode('gallery', 'bootstrapped_gallery_shortcode'); // add your own shortcode



function postlist_shortcode( $atts, $content = null ) {
   global $post;
   $q = array('posts_per_page' => 5, 'post_type' => 'post', 'post_status'=>'publish');
   if(isset($atts['cats'])){
   		$q['category_name'] =  $atts['cats'];
   }
	$posts = new WP_Query($q);
	ob_start();
	while ($posts->have_posts()): $posts->the_post(); ?>
	<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
	
	<?php if ( has_post_thumbnail() ) :?>
	<div class="row"> <div class="col-sm-4">
	<?php the_post_thumbnail('thumbnail',array('class'=>"fullwidth"));?>
	</div>
	<div class="col-sm-8">
	<?php the_excerpt(); ?>
	<a href="<?php the_permalink(); ?>" rel="bookmark"><?php __('More','bootstrapped'); ?></a>
	</div></div>
	<?php else: ?>
	<?php the_excerpt(); ?>
	<a href="<?php the_permalink(); ?>" rel="bookmark"><?php __('More','bootstrapped'); ?></a>
	<?php endif; ?>

	<?php endwhile; 
	return ob_get_clean();
}

add_shortcode( 'postlist', 'postlist_shortcode' );


?>