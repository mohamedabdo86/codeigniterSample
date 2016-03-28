<style>
    .fancybox-inner{
        /*overflow:hidden !important;*/
        height: 270px !important;
        width: 480px !important;
        margin-left: -16px !important;
    }
    .english .fancybox-inner{
        overflow: hidden !important;
    }
    .fancybox-wrap{
        width: 470px !important;
        height: 270px; !important;
    }
    #ask-title{	
        position: relative;
        top: -50px;
        right: 190px;
        color: white;
        font-size: 25px;	
    }
    #go_to_ask_an_expert{
        background-color: #00a8ff;
        margin-right: 45px;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-right: 30px;
        padding-left: 30px;
        border-radius: 9px;
        /* margin-top: 65px; */
        color: white;
    }

    #cancel
    {
        background-color: #b8b8b8;
        margin-right: 45px;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-right: 30px;
        padding-left: 30px;
        border-radius: 9px;
        /* margin-top: 65px; */
        color: white;
    }

    #attention{
        margin-right: 190px;
    }
    .english #attention{
        margin-left: 190px;
    }
    #ask-img{
        margin-right: 150px;
        margin-top: 5px
    }
    .english #ask-img{
        margin-left: 150px;
    }
    .english #ask-title{
        top: -35px;
        left: 190px;
    }
    #accept{
        margin-top: 30px; 
        float:right
    }
    #ignore{
        margin-top: 30px;
        margin-right: 300px;
    }
    .english #ignore {
        margin-left: 300px;
    }
    .english #accept{
        float: left;
        margin-left: 30px;
    }
</style>
<script>
    $(document).ready(function() {
        $('#cancel').on('click', function(event) {
            event.stopPropagation();
            $.fancybox.close();
        });
    });
</script>

<div id="attention"><img  src="<?php echo base_url() . "images/nestle_fit/attention-img.png"; ?>"/></div>
<div style="width: 470px;
     background-color: #b6b8b8;
     height: 45px;
     margin-left: 1px;">
    <img id="ask-img" src="<?php echo base_url() . "images/nestle_fit/ask-an-expert-img.png"; ?>"/>
    <h3 id="ask-title">اسأل خبير</h3>
</div>
<p style="text-align: center;
   margin-top: 10px;
   font-size: 18px;">انت كدا هتخرجي من تطبيق الصحة اختياري</p>
<div id="accept"> <?php echo anchor('best_me/ask_an_expert', 'متابعه', 'id="go_to_ask_an_expert"'); ?></div>

<div id="ignore"> <a href="javascript:void(0);"  id="cancel">رجوع</a></div>

