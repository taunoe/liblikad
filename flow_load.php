<?php
/* ----------------------------------------------
 flow_load.php
 08 juuli 2011
 Tauno Erik
 
 K6ik pildid
---------------------------------------------- */
require_once ('app/config.php');
require_once ('app/funktsioonid.php');

/* --------------------------------------------------------------------- */
define('IS_AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

if(IS_AJAX_REQUEST) {
    print (Flow($k6ik_images));
}
else {
    //header('Location: http://   index.php');
}
/* --------------------------------------------------------------------- */ 


// Et ajaxiga laetud pildid ka lightboxiga töötaks on ka siin!
?>
<script type="text/javascript">
$(function() {
  $("a[rel=projektimages]").fancybox({
 	  'overlayShow'	: true,
 	  'transitionIn'	: 'elastic',
    'transitionOut': 'elastic'
  });
});
</script>
