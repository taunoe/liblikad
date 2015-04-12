<?php
/* ----------------------------------------
  index.php
  Tauno Erik
  08 juuli 2011
-----------------------------------------*/
session_start();

$title = 'Arendus projektid';
require_once ('app/app_header.php');


/*----------------------------------------------------
 Kui on valitud projekt hakkame selle andmeid kuvama
 muidu ainult kaanepildid
 index.php?projekt=Kass jne
----------------------------------------------------*/
if (isset($_GET['projekt']) && !empty($_GET['projekt']) && is_dir($project_folder))
{
 
  // Projekti nimi
  $projekti_nimi = $_GET['projekt'];
  $a = array ('/\_/');
  $b = array (' ');
  $nimi = preg_replace ($a, $b, $projekti_nimi);
  // Projekti Pealkiri ja allalaadimise nupp
  ?>
  <div class="sixteen columns">
    <div class="fifteen columns alpha">
      <h1><?php print ($nimi); ?></h1>
      </div>
      <div class="one columns omega">
        <a href="<? print ($data_folder.'zip.php?zip='.$projekti_nimi);?>" title="Lae kogu projekt alla.">
          <img src="app/images/Download.png" alt="Lae alla.">
        </a>
      </div>
  </div>
  <?php        
  // Html faili sisu
  if (file_exists($project_html))
  { ?>
    <div class="sixteen columns">
      <?php print file_get_contents($project_html); ?>
    </div>
<?php } 
  
  /* ----------------------------------
  Pildid, pdfid ja muud failid tabides
  ---------------------------------- */ 
?>
  <ul class="tabs">
  <?php
  // Pildi tab ------------------------
  if(!empty($project_images)) { 
  ?>
    <li><a class="active" href="#Pildid">Pildid</a></li>
  <?php
  }
  // Pdfi tab ------------------------- 
  if(!empty($project_pdfs)) { 
  ?>
    <li ><a href="#Pdfid">Pdfid</a></li>
  <?php
  }
  // CSV tab ------------------------- 
  if(!empty($project_csvs)) { 
  ?>
    <li><a href="#Csvd">Csvd</a></li>
  <?php
  }
  // Muu tab -------------------------
  if(!empty($project_other_supported_files)) { 
  ?>
    <li><a href="#Muud">Muud failid</a></li>
  <?php
  }
  ?>
  </ul>
  
  <?php
  /* ---------------------------------
  Tabide sisu
  --------------------------------- */
  ?>
  <ul class="tabs-content">
  <?php
  // Pildid --------------------------
  if(!empty($project_images)) { 
  ?>
    <li class="active" id="PildidTab">
    <?php print (ProjectImages($project_images,$projekti_nimi)); ?>
    </li>
  <?php
  }
  // Pdfid --------------------------- 
  if(!empty($project_pdfs)) { 
  ?>
    <li id="PdfidTab">
    <?php print (ProjectPdfs($project_pdfs)); ?>
    </li>
  <?php
  }
  // Pdfid --------------------------- 
  if(!empty($project_csvs)) { 
  ?>
    <li id="CsvdTab">
    <?php print (ProjectCsvs($project_csvs)); ?>
    </li>
  <?php
  }
  // Muud failid --------------------
  if(!empty($project_other_supported_files)) { 
  ?>
    <li id="MuudTab">
    <?php print (ProjectOtherFiles($project_other_supported_files)); ?>
    </li>
  <?php
  }
  ?>
  </ul>
<?php
}
else
{ 
//Avaleht kaanepiltidega erinevatele projektidele
?>
  <div id="cover-images" class="sixteen columns">
  <?php print covers($projects); ?>
  </div>
<?php
}

/* ------------------------------------------------------
  FOOTER
------------------------------------------------------ */
require_once ('app/app_footer.php');

?>
