<?php
/* ----------------------------------------------
 edit.php
 17 juuli 2011
 Tauno Erik
---------------------------------------------- */
session_start();

require_once ('app/app_header.php');

if(!isset($_SESSION['sisseloginud'])){
  header('Location:./');exit();
}else{
/* ------------------------------------------
 Kui oleme sisseloginud 
------------------------------------------- */

// Projekti nimi -----------------------------
$projekti_nimi = $_GET['projekt'];
$a = array ('/\_/');
$b = array (' ');
$nimi = preg_replace ($a, $b, $projekti_nimi);

$project_html = $project_folder.$_GET['projekt'].'.html';


/* -------------------------------------
 Projekti kirjelduse andmete muutmine
------------------------------------- */
if($_POST["EditArea"] && $_POST["submit"]=="Salvesta")
{
  $file_content = $_POST['EditArea'];
  $thefile = fopen($project_html, 'w');
  $file_content = stripslashes($file_content);
  fwrite($thefile, $file_content);
  fclose($thefile);
  exit('<META HTTP-EQUIV="refresh" content="0; URL=./'.$projekti_nimi.'">');
}


/* -------------------------------------
 Projekti Uus Kaanepilt
------------------------------------- */
if(isset($_POST['upload']))
{
  if(isset($_FILES["kaanepilt"]))
  {
    MakeCoverImage($projekti_nimi);
    print('<META HTTP-EQUIV="refresh" content="0; URL=edit.php?projekt='.$projekti_nimi.'&edit=cover">');
  }
  print('uus kaanepilt');
}


/* ----------------------------------------------
 Ajaxi päringud
 - failide kustutamine
---------------------------------------------- */
if(IS_AJAX_REQUEST) 
{ 
  /* ------------------------------------------------------------------------------
   Failide kustutamine a=data/projekt/fail.jpg jne
   Piltidel on thumbnailid, seepärast eraldi funkid
   Muidugi võiks ka funk ise välja selgitada, mis fail ja siis vastavalt käituda
  ------------------------------------------------------------------------------ */
  if(isset($_POST["a"]))
  {
    $file =$_POST["a"];
    $f = pathinfo($file);
    // Kui on pilt -----------------------------------
    if(in_array($f['extension'] ,$img_extensions))
    {
      DeleteImage($file);
    }
    // Kui on pdf ------------------------------------
    else if($f['extension'] == 'pdf')
    {
      DeletePdf($file);
    }
    // Kõik muud failid ------------------------------
    else
    {
      unlink($file) or die ("Ei saa: $php_errormsg");
    }
  }
  
  if(isset($_POST["p"]))
  {
    // Kogu projekti kustutamine? ----------------------
    $folder = $_POST["p"];
    DeleteProjekt($folder);
  }
  
}
// Ajax end //////

function h2($projekti_nimi,$tegevus){
 $data = '<p><a href="'.$projekti_nimi.'">'.$projekti_nimi.'</a>: <strong>'.$tegevus.'</strong></p>';
 return $data;
}

?>
  
 
 <div class="sixteen columns">
   <?php //print('<h2><a href="'.$projekti_nimi.'">'.$nimi.'</a></h2>');?>
 </div>
 
 
  <div class="sixteen columns">
  <?php
  /* ------------------------------------------------
   Kolm tegevust edit.php?projekt=projekt&edit=html
   -cover
   -delete
   -html vaikimisi
  ----------------------------------------------- */
  $action = isset($_GET['edit']) ? $_GET['edit'] : NULL;
  
  switch($action) 
  {
  case 'cover':
   // Uus kaanepildi valimine v6i yleslaadimine
   print(h2($projekti_nimi,'Kaanepildi muutmine'));
   print(EditCover($projekti_nimi));
  break;
  
  case 'delete':
    print(h2($projekti_nimi,'Failide kustutamine'));
    // Failide nimekiri ?>
    <table class="DeleteTable">
     <tbody>
       <?php print(DeleteFiles($projekti_nimi)); ?>
     </tbody>
    </table>
    <table class="KustutaProjekt">
      <tr>
        <th><img src="app/images/Alert.png"></th>
        <th class="th_middle">KUSTUTA TERVE PROJEKT:<?php print ($projekti_nimi); ?></th> 
	      <th>
	        <a href="#" class="delProjekt" name="<?php print ($projekti_nimi); ?>" title="Kustuta" >
	          <img src="app/images/Remove.png"> </th>
	        </a>
      </tr>
    </table>
  <?php
  break;
  
  case 'rename':
   // Projekti ymbernimetamine
   // ja failide???
   print(h2($projekti_nimi,'Ymbernimetamine'));
   print($projekti_nimi);
  break;

  default://html
   print(h2($projekti_nimi,'Kirjelduse muutmine'));
   print (EditHtml($project_html));
  break;
  }
  ?>
  </div><!-- sixteen columns end //-->
<?php
}//Kui on sisseloginud l6pp

/* ------------------------------------------------------
  FOOTER
------------------------------------------------------ */
require_once ('app/app_footer.php');
if ($_GET['edit'] == 'html' or $_GET['edit'] == '')
{
 print '<script type="text/javascript">CKEDITOR.replace("EditArea");</script>';
}
?>

