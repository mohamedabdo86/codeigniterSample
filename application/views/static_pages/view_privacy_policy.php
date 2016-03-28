<script type="text/javascript">
$(document).ready(function(e) {
    //$("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#7e7979",boxzoom:false}); 
});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
	
	$('.question').click(function(o){
		if (o){
		   o.preventDefault();
		   var target = $(this).attr("href");
	   }else{
		   var target = location.hash;
	   }
		$('html, body').animate({
			scrollTop: $( target ).offset().top
		}, 1000, function(){
			location.hash = target;
		});
		$(target).css("color", "#000");
		$(target).css("background", "#EEE");
		setTimeout(function(){
		  $(target).fadeIn(3000,function(){
		  $(target).css("color", "#0d587a");
		  $(target).css("background", "#FFF");
		  });
		}, 2000);
		return false;
	});

});
</script>
<style>
.innertitle
{
	font-size:20pt;
}
.inner_body
{ 
	box-shadow:1px 1px 6px #807976;
	border-radius:5px;
	margin:15px;
}
.container
{
	padding: 20px;
	/*height: 500px;*/
	background-color: #fff;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
}
.pricavy_desc
{
	white-space:normal;
	padding:10px;
	background-color:#f8f8f8;
	margin-bottom: 10px;
}
h3
{
	color:#0d587a;
	font-weight:bold;
	line-height:30px;
}
p
{
	white-space:normal;
	font-size: 13px;
}
.question
{
	line-height: 30px;
}

</style>
<div class="white_background_color top_radius_5 height_40">
    <div class="sections_wrapper_margin global_sperator_margin_top ">
        <h1 class="terms_conditions_color innertitle">
        <?php
			foreach($privacy_policy_desc as $policy)
			{
				echo $policy['static_name'.$current_language_db_prefix];
			}
          ?>
          </h1>
    </div> 
</div>
<div class="thick_line terms_conditions_background_color"></div>

<div class="white_background_color" style="height:auto;border:1px solid #FFF;">	


<div class="inner_body" >
    <div class="container" id="boxscroll"> 
		<div class="pricavy_desc">
        	<?php
            foreach($privacy_policy_desc as $policy)
			{
				echo $policy['static_text'.$current_language_db_prefix];
			}
			?>
        </div>
        <div class="oblong_with_triangle">
       		 <a class="oblong" ><?php echo lang('globals_privacy_policy_question'); ?> <div class="triangle_shape"></div></a>        
   		</div>
        <div class="pricavy_question">
        	<?php
            for($i=0; $i<sizeof($privacy_policy); $i++ ):
				echo '<h3><a class="question" href="#'.($i+1).'" >';
				echo $i+1 ." - ".$privacy_policy[$i]['privacy_policy_question'.$current_language_db_prefix] ;
				echo '</a></h3>';
				
			endfor;
			?>
        
        </div>
        
        <div class="pricavy_question_answer">
        	<?php
            for($i=0; $i<sizeof($privacy_policy); $i++ ):
				
				echo '<h3 name="'.($i+1).'" id="'.($i+1).'" >';
				echo $i+1 ." - ".$privacy_policy[$i]['privacy_policy_question'.$current_language_db_prefix] ;
				echo '</h3>';
				echo '<p>'.$privacy_policy[$i]['privacy_policy_answer'.$current_language_db_prefix].'</p>' ;
				
			endfor;
			?>
        
        </div>
   
   
   
    </div><!-- End OF .boxscroll-->
</div><!--End OF .inner_body-->
</div>

