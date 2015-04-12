<?php
/* ----------------------------------------------
 flow.php
 08 juuli 2011
 Tauno Erik
 
 K6ik pildid
---------------------------------------------- */
session_start();

$title ='Image Flow';
define('Flow', true);//flow.js laadimiseks footeris
require_once ('app/app_header.php');

?>
 
  <div class="sixteen columns">
    <div id="data">
      <ul class="flow-content">
        <?php print (Flow($k6ik_images)); ?>
      </ul>
    </div><!-- Data end //-->
  </div><!-- sixteen columns end //-->
  <div id="loadingbar" style="display:none;position:fixed;bottom:0;left:0;right:0;background-color:#E7E5E1;color:#000;text-align:center;">
    <b>Laen</b>
  </div><!-- loadingbar end //--> 
  <input type="hidden" value='2' id="loaded_max" />
     
     
<?php
/* ------------------------------------------------------
  FOOTER
------------------------------------------------------ */
require_once ('app/app_footer.php');
?>
