<?php
/* ----------------------------------------
  eelvaated.php
  Tauno Erik
  08. juuli 2011
-----------------------------------------*/

require_once ('app/config.php');
require_once ('app/funktsioonid.php');



/* --------------------------
 kui on ajaxi päring
-------------------------- */
if(IS_AJAX_REQUEST) {
	if(isset($_GET['pdf'])){
    $file = $_GET['pdf'];
    print ('<img src="thumb_pdf?pdf='.$file.'&size=400">');
  }
}
/* --------------------------
 kui ei ole ole
 suuname index.phple
-------------------------- */
else {
    //header('Location: http:// .....  index.php' );
}

?>
