<?php
/* ----------------------------------------
  config.php
  Tauno Erik
  14 juuli 2011
-----------------------------------------*/

define('IS_AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$users = array(
  'tauno' => '6a42dd6e7ca9a813693714b0d9aa1ad8' //erik md5
);


//Meta info
$author = 'Tauno Erik';
$title = 'Libikaid';
$description = 'Liblikaid keda olen kohanud ja pildistanud';

//Projektide asukoht
$data_folder = 'data/';

//Thumbnailide kataloog
$thumb = '/thumb';

//Projekti kataloog
$project_folder = $data_folder.$_GET['projekt'].'/';

//Loeme projektid massiivi
$projects = glob($data_folder.'*', GLOB_MARK|GLOB_ONLYDIR);

//Projekti html fail
$project_html = $project_folder.$_GET['projekt'].'.html';

//Vaikimisi kaanepilt
$cover_image_default = 'app/images/cover_150_150.jpg';

$cover_image = 'cover.jpg';

$img_extensions = array('JPG', 'JPEG', 'PNG', 'GIF','jpg','jpeg','png','gif');

$pildi_laiendid = '*.jpeg,*.JPEG,*.jpg,*.JPG,*.png,*.PNG,*.gif,*.GIF';
$pdf_laiendid = '*.pdf,*.PDF';
$muud_laiendid = '*.csv,*.txt,*.odf,*.odt,*.ods,*.odp,*.svg,*.xcf,*.ai,*.psd,*.chm,*.mp3,*.wav,*.zip,*.xls,*.doc';

//
$project_csvs = glob($project_folder.'*.csv', GLOB_BRACE);

//Loeme projekti pildid massiivi
$project_images = glob($project_folder.'{'.$pildi_laiendid.'}', GLOB_BRACE);

//K6ik projektide kataloogides olevad pildid
$k6ik_images = glob($data_folder.'*/{'.$pildi_laiendid.'}', GLOB_BRACE);

//Seda pilti ingnoreerime
$ignor_image = array('cover');

//Pdf failid
$project_pdfs = glob($project_folder.'{'.$pdf_laiendid.'}', GLOB_BRACE);

//Muud toetatud failid mida n2itame
$project_other_supported_files = glob($project_folder.'{'.$muud_laiendid.'}', GLOB_BRACE);

//Projekti nimedes keelatud asjad ja nende asendused
$keelatud = array ('/\ /','/\*/','/\//','/\\\/');
$asendused = array ('_','_','_','_');

//Veateade
$message = 'Message ..';

?>
