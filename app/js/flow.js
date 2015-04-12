$(document).ready(function() { 
  var loading = false;
  $(window).scroll(function(){
    if((($(window).scrollTop()+$(window).height())+150)>=$(document).height()){
        if(loading == false){
            loading = true;
            $('#loadingbar').css("display","block");
            $.get("flow_load.php?page="+$('#loaded_max').val(), function(loaded){
                $('.flow-content').append(loaded);
                $('#loaded_max').val(parseInt($('#loaded_max').val())+1);
                $('#loadingbar').css("display","none");
                loading = false;
                /**/
                $("a[rel=projektimages]").fancybox({
 	                'overlayShow'	: true,
 	                'transitionIn'	: 'elastic',
                  'transitionOut': 'elastic'
                });
                /**/
            }) ;
        }  
    }
  });
});
