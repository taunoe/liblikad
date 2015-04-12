<?php
/* ----------------------------------------------
 stats.php
 11 juuli 2011
 Tauno Erik
 
 Kas Projekti statistika v6i Koond statistika
---------------------------------------------- */
session_start();

$title = 'Koond statistika';

require_once ('app/app_header.php');

// Projekti nimi
$projekti_nimi = $_GET['projekt'];
$a = array ('/\_/');
$b = array (' ');
$nimi = preg_replace ($a, $b, $projekti_nimi);
?>	
 
<?php
  if(isset($_GET['projekt']) && $_GET['projekt'] != '')
  {
  ?>
    <div class="sixteen columns">
      <h2>
        <?php print '<a href="'.$projekti_nimi.'">'.$nimi.'</a>'; ?>
      </h2>
    </div>
    <div class="sixteen columns"><p>Projekti stats</p>
  <?php
  }
  else
  {
  ?>
    <div class="sixteen columns"><p>Koond stats</p>
  <?php
  }
  ?>
  </div>
  
  
<?php
if(isset($_SESSION['sisseloginud']))
{
  print('<p>Oled sisseloginud.</p>');  
}


/* ------------------------------------------------------
  FOOTER
------------------------------------------------------ */
require_once ('app/app_footer.php');
?>
