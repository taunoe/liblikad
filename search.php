<?php
/* -----------------------------------------
 search.php
 11 juuli 2011
 Tauno Erik
----------------------------------------- */
session_start();

$q = isset($_GET['q']) ? $_GET['q'] : NULL;

$ignor = array('.','db');

$title = 'Otsing';
require_once ('app/app_header.php');
//-------------------------------------------//



/* -----------------------------------------------
 Kui otsime midagi, hakkame tulemusi valjastama
----------------------------------------------- */
if (!empty($_GET['q'])) 
{
  if(!in_array($_GET['q'] ,$ignor )) 
  {
    $q = trim(strip_tags($_GET['q']));          
    $patterns = array ('/\//','/\./','/\*/');   
    $replacements = array ('-', '-' , '-');
    $q_pr = preg_replace ($patterns, $replacements, $q);
    /* ------------------------------------
     1. Html faili seest leitud read
    ------------------------------------ */
    /* - leiame k6ik html failid
       - avame need
       - ja otsime sealt otsitavad
       - letud asjad massiivi 
    
    */
    /* ------------------------------------
     2. Pildid
    ------------------------------------ */
    $leitud_pildid = search_glob("*".$q_pr."{".$pildi_laiendid."}",'', $data_folder);
    if (!empty($leitud_pildid)) 
    { 
    ?>
      <div class="sixteen columns"><h5>Leitud pildid:</5></div>
      <div class="sixteen columns"><ul class="flow-content">
      <?php print Flow($leitud_pildid); ?>
      </ul></div>
    <?php
    }
    /* ------------------------------------
     3. Muud failid
    ------------------------------------ */
    $leitud_failid = search_glob("*".$q_pr."{".$pdf_laiendid.",".$muud_laiendid."}",'', $data_folder);
    if (!empty($leitud_failid)) 
    { 
    ?>
      <div class="sixteen columns"><h5>Leitud failid:</5></div>
      <div class="sixteen columns">
      <?php print ProjectOtherFiles($leitud_failid); ?>
      </div>
    <?php
    }
  }
}
else
{
?>
  <form action="search.php" method="get" id="otsinguform" > 
    <fieldset> 
      <input id="otsing" type="text" title="Otsi." name="q" placeholder="Otsi.." autocomplete="off"> 
    </fieldset> 
  </form>
<?
}

//-------------------------------------------//
require_once ('app/app_footer.php');
?>
