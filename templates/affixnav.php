<?php
/*
Template Name: affixnav
*/

get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col-sm-5 hidden-xs">
        <ul class="nav affix col-sm-4"  id="affixnav">
        </ul>
        <style type="text/css">
a.anchor{display: block; position: relative; top: -110px; visibility: hidden;}
        </style>
<script>
jQuery(function($){
  var n=0;
  $('#affixcontent h2,#affixcontent h3,#affixcontent h4').each(function(){
    if($(this).prop("tagName") == 'H2'){
       $('#affixnav').append('<li><a href="#p'+n+'"><b>'+$(this).text()+'</b></a></li>');
     }else{
       $('#affixnav').append('<li><a href="#p'+n+'">&nbsp;&nbsp;'+$(this).text()+'</a></li>');
     }
   
    $(this).append('<a class="anchor" name="p'+(n++)+'" />');
  })
  $('#affixnav a').click(function(){
    $('#affixnav li').removeClass('active');
    $(this).parent().addClass('active')
  })
})
</script>
      </div>
    <div id="affixcontent" class="col-sm-7">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
  </div>

</div><!-- .container -->
<?php get_footer(); ?>