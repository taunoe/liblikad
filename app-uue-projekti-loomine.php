<?php
/* ----------------------------------------
  app_uue-projekti-loomine.php
  Tauno Erik
  08 juuli 2011
-----------------------------------------*/
session_start();

$title = 'Uue projekti loomine.';

require_once ('app/app_header.php');


/* -----------------------------------------
 Kui sisseloginud siis 
 -Uue Projekti loomise form
----------------------------------------- */
if(isset($_SESSION['sisseloginud']))
{
 ?>
 <div class="sixteen columns">
  <div id="UueProjektiLisamine">
    <h3>Uue projekti loomine</h3>
	  <form action="" method="post" enctype="multipart/form-data">
	
      <!-- Projekti Nimi -->
      <label for="ProjektiNimiInput">Projekti nimi:</label>
      <input id="ProjektiNimiInput" type="text" title="Kirjuta projekti nimi." name="ProjektiNimiInput" />
    
      <!-- Projekti Kirjeldus -->
      
      <label for="ProjektiKirjeldusTextarea">Kirjeldus:</label>
      <textarea id="ProjektiKirjeldusTextarea" titlt="Projekti iseloomustus" name="ProjektiKirjeldusTextarea" ></textarea>
 
      <!-- Projekti Kaanepilt --->
      <label for="ProjektiKaanepiltInput">Kaanepilt:</label>
      <input type="file" name="kaanepilt" />

      <button type="submit" name="submit" class="Salvesta"> Salvesta</button>
    </form>
  </div>
 </div>
 <?php
}
/* --------------------------------------
 Kui ei ole sisseloginud
 -Avaleht kaanepiltidega erinevatele projektidele
-------------------------------------- */
else
{
?>
  <div id="cover-images" class="sixteen columns">
  <?php print covers($projects); ?>
  </div>
<?php
}


/* ------------------------------------------------------
  Formilt tulevate andmete töötlemine
  Kindlasti on vajalik projekti nimi
------------------------------------------------------ */
if(isset($_POST['submit']))
{
  // Kui on Projekti nimi
  if (!empty($_POST['ProjektiNimiInput']))
  {
  /*--------------------------------------------------------*/
    $nimi = trim($_POST['ProjektiNimiInput']);
    $nimi = preg_replace ($keelatud, $asendused, $nimi);
    // Kui kataloog on juba olemas
  	if(is_dir($data_folder.$nimi))
	  {
	    $message = errorMsg('Kataloom on juba olemas!');
      print ($message);
	  } 
	  // Teen uue Projekti
	  else
	  {	
	    mkdir($data_folder.$nimi, 0777, true);
	    mkdir($data_folder.$nimi.$thumb, 0777, true);
	    // Projekti kirjeldus
	    if(!empty($_POST["ProjektiKirjeldusTextarea"]))
      { 
        $file_content = trim($_POST['ProjektiKirjeldusTextarea']);
      }
      else
      { 
        $file_content = 'Projekti kirjeldus'; 
      }  
      $newfile = $data_folder.$nimi.'/'.$nimi.'.html';
      $thefile = fopen($newfile, 'w');
      $file_content = stripslashes('<p>'.$file_content.'</p><br/>');
      fwrite($thefile, $file_content);
      fclose($thefile);

	    // Kaane pilt
	    if (isset ($_FILES['kaanepilt']))
      {
        MakeCoverImage($nimi);
	    }
	  exit('<META HTTP-EQUIV="refresh" content="0; URL=upload.php?projekt='.$nimi.'">');
	  }
	/* ---------------------------------------------------- */
  }
  else
  // Kui pole nime ei tee midagi
  {
    $message = errorMsg('Projektil peab olema nimi!');
    print ($message);
  }
}

/* ------------------------------------------------------ */
require_once ('app/app_footer.php');
?>
<script type="text/javascript">
  CKEDITOR.replace( 'ProjektiKirjeldusTextarea' );
</script>
	
