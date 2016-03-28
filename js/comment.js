
$(document).ready(function(e) {
	 var baseurl = $('#baseurl').val();
    $('.submit_comment').submit(function(){
		 
        $.ajax({
            url : baseurl+'index.php/en/ajax/insert_comments',
            data : $('form').serialize(),
            type: "POST",
           success : function(){
			   $('.comment_big_input').val('Thank you for your time, your comment is awaiting to approve...');
                //$(comment).hide().insertBefore('#insertbeforMe').slideDown('slow');
            }
        })
        return false;
    })
    
});
