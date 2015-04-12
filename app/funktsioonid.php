<?php
/* ----------------------------------------
  funktsioonid.php
  Tauno Erik
  19 juuli 2011
-----------------------------------------*/

/* ----------------------------------------------------
 Veateatede varvimine
---------------------------------------------------- */
function coloredMsg($color, $msg)
{
	return '<span style="color:'.$color.';">'.$msg.'</span>';
}
	
function errorMsg($msg){return coloredMsg('red', $msg);}
function okMsg($msg){return coloredMsg('green', $msg);}


/* ------------------------------------------------
 Login form
------------------------------------------------ */
function loginform($action='index.php?a=login'){
 $loginform = '<form action="'.$action.'" method="post"><fieldset>
	              <label for="name">Nimi:</label><input name="name" type="text" >
	              <label for="password">Salasõna:</label><input name="password" type="password" >
	              <button type="submit">Login sisse</button>
              </fieldset></form>';
 return $loginform;
}


/* ------------------------------------------------
 Login
------------------------------------------------ */
function login(){
  global $users;
  $name = $_POST["name"];
  $pass = md5($_POST["password"]);
  if(isset($users[$name]))
  {
    if ($users[$name] == $pass)
    {
      $_SESSION["sisseloginud"] = TRUE;
    }
  }
}


/* ------------------------------------------------
 Logout
------------------------------------------------ */
function logout(){
  session_destroy();
}


/* ------------------------------------------------
 BUTTON
 Projektide rippmenyy genereerimine
------------------------------------------------ */
function ButtonProjektiMenu($projects){
  $data = '';
  if (count($projects) != '0' ){
    foreach ($projects as $p) 
    {
    $project_name = substr($p, 5,-1);//eemaldame eest 'data/' ja tagant '/'
    $a = array ('/\_/');
    $b = array (' ');
    $nimi = preg_replace ($a, $b, $project_name);
    $data .='<li class="li-folders" id="'.$project_name.'">
               <a href="'.$project_name.'" title="Projekt: '.$project_name.'" >'.$nimi.'</a>
             </li>'; 
	  }
	
	}
	else
	{
	  if(isset($_SESSION['sisseloginud']))
	  {
	    $data .= '<li class="li-folders"><a href="app-uue-projekti-loomine.php">Loo esimene</a></li>';
	  }else{
	  // Kui ei, siis sisse logimise aken ja suuname 
	  $action = 'app-uue-projekti-loomine.php?a=login';
	  $data .= '<li class="li-folders">
	              <a href="" title="Lisa uus projekt" data-reveal-id="UueProjektiLisamine">
	                Loo esimene
	              </a>
	            </li>
	            <div class="reveal-modal">'.loginform($action).'</div>';
	  }
	}
	return $data;
}


/* ----------------------------------------------
 BUTTON
 Uue projekti loomine
---------------------------------------------- */
function ButtonUusProjekt(){
  $data = '';
  if(isset($_SESSION['sisseloginud']))
	{
    // Link uue projekti loomise lehele	
	  $data .= '<a href="app-uue-projekti-loomine.php" title="Lisa uus projekt">
	              <img src="app/images/Add.png">
	            </a>';
	}
	else
	{
	  // Kui ei, siis sisse logimise aken ja suuname 
	  $action = 'app-uue-projekti-loomine.php?a=login';
	  $data .= '<a href="" title="Lisa uus projekt" data-reveal-id="UueProjektiLisamine">
	              <img src="app/images/Add_hall.png">
	            </a>
	            <div id="UueProjektiLisamine" class="reveal-modal">'.loginform($action).'</div>';
  }
  return $data;
}


/* ----------------------------------------------
 BUTTON
 Teised admin nuppud
 - upload
 - 
---------------------------------------------- */
function ButtonAdminNupp($action,$ikoon,$ikoon_hall,$title,$id){
  $data = '';
  if(isset($_SESSION['sisseloginud']))
	{
    if(!empty($_GET['projekt']))
	  {
      $data .= '<a href="'.$action.'.php?projekt='.$_GET['projekt'].'" title="'.$title.'">
                  <img src="app/images/'.$ikoon.'">
                </a>';
    }else{
      $data .= '<img src="app/images/'.$ikoon_hall.'">';
    }
	}
	else
	{
	  $action = $action.'.php?a=login&projekt='.$_GET['projekt'];
	  $data .= '<a href="" title="'.$title.'" data-reveal-id="'.$id.'reveal">
	              <img src="app/images/'.$ikoon_hall.'">
	            </a>
              <div id="'.$id.'reveal" class="reveal-modal">'.loginform($action).'</div>';
  }
  return $data;
}



/* ----------------------------------------------
 BUTTON
 edit.php
---------------------------------------------- */
function ButtonEdit($action,$ikoon,$ikoon_hall,$title,$id){
  $data = '<ul class="menu"><li class="">';
  if(isset($_SESSION['sisseloginud']))
	{
    if(!empty($_GET['projekt']))
	  {
      $data .= '<a href="'.$action.'.php?projekt='.$_GET['projekt'].'" title="'.$title.'">
                  <img src="app/images/'.$ikoon.'" />
                </a>
                <div id="kolmnurk"><img src="app/images/Kolmnurk.png"></div>
                <ul id="">
                  <li><a href="'.$action.'.php?projekt='.$_GET['projekt'].'&edit=html">Sisu</a></li>
                  <li><a href="'.$action.'.php?projekt='.$_GET['projekt'].'&edit=cover">Kaanepilt</a></li>
                  <li><a href="'.$action.'.php?projekt='.$_GET['projekt'].'&edit=delete">Kustutamine</a></li>
                </ul>
              </li>
            </ul><!--class menu end //-->';
    }
    else //Kui projekti ei ole maaratud
    {
      $data .= '<img src="app/images/'.$ikoon_hall.'"/>
              </li>
            </ul><!-- menu end //-->';
    }
	}
	else //Kui ei ole sisseloginud
	{
	  $action = $action.'.php?a=login&projekt='.$_GET['projekt'];
	  
	  $data .= '<a href="" title="'.$title.'" data-reveal-id="'.$id.'reveal">
	              <img src="app/images/'.$ikoon_hall.'"/>
	            </a>
	          </li>
	        </ul><!-- menu end //-->
          <div id="4reveal" class="reveal-modal">'.loginform($action).'</div>';
  }
  return $data;
}



/* ----------------------------------------------
 BUTTON
 Stats
---------------------------------------------- */
function ButtonStats($action,$ikoon,$ikoon_hall,$title,$id){
  $data = '';
  /*if(isset($_SESSION['sisseloginud']))
	{*/
    if(!empty($_GET['projekt']))
	  {
      $data .= '<a href="'.$action.'.php?projekt='.$_GET['projekt'].'" title="'.$title.'">
                  <img src="app/images/'.$ikoon.'">
                </a>';
    }else{
      $data .= '<a href="'.$action.'.php" title="'.$title.'">
                  <img src="app/images/'.$ikoon.'">
                </a>';
    }
	/*}
	else
	{
	  //$action = $action.'.php?a=login&projekt='.$_GET['projekt'];
	  $data .= '<a href="" title="'.$title.'" data-reveal-id="'.$id.'reveal">
               <img src="app/images/'.$ikoon_hall.'">
             </a>
             <div id="'.$id.'reveal" class="reveal-modal">'.loginform($action).'</div>';
	  
  }*/
  return $data;
}



/* -----------------------------------------------
 Avalehel kõigi projektide kaanepiltide kuvamine
 + link projektile
----------------------------------------------- */
function covers($projects){ 
  global $cover_image_default;
  $covers = '<ul class="x">';
	
	foreach ($projects as $p) {
    $project_name = substr($p, 5,-1);//eemaldame eest 'data/' ja tagant '/' 
		$cover_image = $p.'cover.jpg';
		$covers .= ('<li class="cover-image"> <a href="'.$project_name.'" title="'.$project_name.'">');
		
		if (file_exists($cover_image)){
		  $covers .= ('<img src="'.$cover_image.'" alt="'.$project_name.'">');
		}else{
		  $covers .= ('<img src="'.$cover_image_default.'" alt="'.$project_name.'">');
		}
		
		$covers .= ('</a></li>');
	}
	$covers .= '</ul>';
	return $covers;
}


/*----------------------------------
  Pildid projekti lehel
----------------------------------*/
function ProjectImages($project_images,$projekti_nimi){
 global $ignor_image;
 global $data_folder;
 $projectimages = '';
 foreach ($project_images as $img) {
    $image = pathinfo($img);
    if(!in_array($image['filename'] , $ignor_image))
    {
      $thumbnail = $data_folder.$projekti_nimi.'/thumb/th_'.$image['basename'];
      if(!file_exists($thumbnail))
      {
        MakeThumb($img,$thumbnail);
      }
      $projectimages .= '<a rel="projektimages" href="'.$img.'" title="'.$image['filename'].'">
                           <img src="'.$thumbnail.'" alt="'.$image['filename'].'" width="100px">
                         </a>';
    }
  }
  return $projectimages;
}


/* ----------------------------------
 MAKE THUMBnail
 Kasutuses:
 function ProjectImages
 function Flow
---------------------------------- */
function MakeThumb($img,$thumbnail){
 require_once ('app/phpthumb/ThumbLib.inc.php');//??? on ka headeeris ???
 try
 {
   $thumb = PhpThumbFactory::create($img);
 }
 catch (Exception $e)
 {
   //
 }
 $thumb->resize(200,250);
 $thumb->cropFromCenter(100);
 $thumb->save($thumbnail);
}


/*----------------------------------
  Pdfid projekti lehel
----------------------------------*/
function ProjectPdfs($project_pdfs){
 $projectpdfs = '<ul class="pdf-list">';
 foreach ($project_pdfs as $pdf) {
   $file = pathinfo($pdf);
   $projectpdfs .= '<li>
                      <a class="cluetip sinilink" rel="eelvaated.php?pdf='.$pdf.'" title="'.$file['filename'].'" href="'.$pdf.'">'.($file['filename']).'</a>
                    </li>';
 }
 $projectpdfs .= '</ul>';
 return $projectpdfs;
}


function ProjectCsvs($project_csvs){
 $data = '';
 foreach ($project_csvs as $csv) {
   $info = pathinfo($csv); 
   $data .= '<a class="sinilink" href="'.$csv.'" title="'.$info['filename'].'">'.$info['filename'].'</a>';
   $data .= csvReader($csv);
 }
 return $data;
}

/*----------------------------------
  Muud failid projekti lehel
----------------------------------*/
function ProjectOtherFiles($project_other_supported_files){
 $projectotherfiles = '<ul class="other-file-list">';
 foreach ($project_other_supported_files  as $file) {
   $file_info = pathinfo($file);
   $projectotherfiles .= '<li>
                            <a class="sinilink" href="'.$file.'">'.($file_info['filename']).'</a> '.$file_info['extension'].'
                          </li>';
 }
 $projectotherfiles .= '</ul>';
 return $projectotherfiles;
}


/* --------------------------------------
 Pdfide eelvaate renderdamine
--------------------------------------- */
function thumbPdf ($pdf, $width='400',$tmp = './tmp')
{
  try
  {
    $format = "jpg";
    $source = $pdf.'[0]';
    $pdf= md5_file($pdf); //
    $dest = "$tmp/$pdf.$format";
    
    if (!file_exists($dest))
    {
      $exec = "convert -scale $width $source $dest";
      //$exec = "convert $width $source $dest";
      exec($exec);
    }
    
    $im = new Imagick($dest);
    header("content-Type:".$im->getFormat() );
    header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));

    return $im;
  }
  catch(Exception $e)
  {
    return $e->getMessage();
  }
}


/* -----------------------------------------------
 Kaanepildi tegemine
 edit.php
 app-uue-projekti-loomine.php
----------------------------------------------- */
function MakeCoverImage($projekti_nimi){
  global $data_folder;
  global $cover_image;
  global $img_extensions;
  
  $img_info = pathinfo($_FILES['kaanepilt']['name']);
  
	if(in_array($img_info['extension'], $img_extensions))
	{
	  $origname = $_FILES['kaanepilt']['name'];
	  $orig_tmp = $_FILES['kaanepilt']['tmp_name'];
	  $orig = $data_folder.$projekti_nimi.'/'.$origname;
	  $cover = $data_folder.$projekti_nimi.'/'.$cover_image;
	  move_uploaded_file($orig_tmp, $orig);
	  // Teeme ruudukujulise thumbnaili
	  try
	  {
	    $thumb = PhpThumbFactory::create($orig);
	  }
	  catch (Exception $e)
	  {
	    //errors
	  }
	  $thumb->resize(300);
	  $thumb->cropFromCenter(150);
	  $thumb->save($cover);
	}
}


/* ---------------------------
 CSV reader
--------------------------- */
function csvReader($cvsfile){
  $fp = fopen($cvsfile,'r') or die('can\'t open file');
  $data = '<table>';
  while($csv_line = fgetcsv($fp,1024)) {
    $data .= '<tr>';
    for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
      $data .= '<td>'.$csv_line[$i].'</td>';
    }
    $data .= '</tr>';
  }
  $data .= '</table>';
  fclose($fp) or die('can\'t close file');
  return $data;
}


/* ----------------------------
  flow.php
  Kõigi piltide näitamine
--------------------------- */
function Flow($images) {
 $limit = '50';
 global $img_extensions;
 global $data_folder;
 global $cover_image;
 //-------------------------
 $curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
 $offset    = ($curr_page - 1) * $limit; 
 $qty_items = count($images);
 $qty_pages = ceil($qty_items / $limit);
 $next_page = $curr_page < $qty_pages ? $curr_page + 1 : null;
 $prev_page = $curr_page > 1 ? $curr_page - 1 : null;
 $images = array_slice($images, $offset, $limit);
 //--------------------
 
 $data = '';
 
 foreach($images as $img) 
 {
   if (is_file($img))
   {
     $image = pathinfo($img);
     if ($image['basename'] != $cover_image)
     {
       $d = explode('/',$img);
       $thumbnail = $data_folder.$d[1].'/thumb/th_'.$image['basename'];
       if(!file_exists($thumbnail))
       {
         MakeThumb($img,$thumbnail);
       }
       $data .= '<li class="flow-image">
                   <a rel="projektimages" href="'.$img.'" title="'.$image['basename'].'" >
                     <img src="'.$thumbnail.'" width="100px" alt="'.$image['basename'].'"/>
                   </a>
                 </li><!-- end //-->';
     }
   }
 }
 return $data;
}


/* -----------------------------
 edit.php
 Edit HTML
----------------------------- */
function EditHtml($project_html) {
  $data = '';
  if(!empty($_GET['projekt']))
  {
  if(!file_exists($project_html)){
    $newfile = $project_html;
    $thefile = fopen($newfile, 'w');
    $file_content = '<p>Kirjeldus</p>';
    fwrite($thefile, $file_content);
    fclose($thefile); 
  }
  $data .= '<form id="form" name="form" method="post" action="edit.php?projekt='.$_GET['projekt'].'">
	            <textarea name="EditArea" style="width:100%;" id="Edit" >
	              '.file_get_contents($project_html).'
	            </textarea>
	            <input name="submit" id="submit" type="submit" value="Salvesta" class="buttonstyle">
	            <input name="reset" id="reset" type="reset" value="T&uuml;hista muudatused" class="buttonstyle">
	          </form>';
  }
  return $data;
}


/* -----------------------------
 edit.php
 Edit COVER
----------------------------- */
function EditCover($projekti_nimi) {
 global $data_folder;
 global $project_folder;
 global $cover_image;
 global $cover_image_default;

 $image = $project_folder.$cover_image;
 $data = '<p>Praegune kaanepilt: </p>';
 
 if(file_exists($image)){ $data .= '<img src="'.$image.'">';
 }else{ $data .= '<img src="'.$cover_image_default.'">'; }
 $data .= '<form action="edit.php?projekt='.$projekti_nimi.'&edit=cover" method="post" enctype="multipart/form-data">
             <label for="kaanepilt">Kaanepilt:</label>
             <input type="file" name="kaanepilt" />
             <button type="submit" name="upload" class="upload">upload</button>
           </form>
           <p>Tegelt peaks olemas olevate hulgast valima!</p>';
 
 return $data;
}


/* -------------------------------
 edit.php
 DELETE files
 Failide nimekiri kustutamiseks
------------------------------- */
function DeleteFiles($projekti_nimi) {
 global $data_folder;
 global $thumb;
 global $img_extensions;
 global $cover_image;
 $data = '';
 $projekt_files = glob($data_folder.$projekti_nimi.'/*.*');
 
 foreach ($projekt_files  as $f) {
   $file = pathinfo($f);
   // Kui on pilt
   if(in_array($file['extension'], $img_extensions))
   {
     // Kaanepilt
     if($file['basename'] == $cover_image){ $th = $f;}
     // Tavaline pilt
     else{ $th = $data_folder.$projekti_nimi.$thumb.'/th_'.$file['basename'];}
     $data .= '<tr>
                 <th><img src="'.$th.'" width="50px"></th>
                 <th class="th_middle">'.$file['basename'].'</th>
                 <th class="th_middle"> 
                   <a href="#" class="delButton" name="'.$f.'" title="Kustuta" onclick="confirm(\'xxx\');">
                     <img src="app/images/Remove.png" alt="Kustuta">
                   </a>
                 </th>
               </tr>';
   }else{
     $data .= '<tr>
                 <th>
                   <img src="app/images/apple-touch-icon.png" width="50px">
                 </th>
                 <th class="th_middle">'.$file['basename'].'</th>
                 <th class="th_middle">
                   <a href="#" class="delButton" name="'.$f.'" title="Kustuta" >
                     <img src="app/images/Remove.png">
                   </a>
                 </th>
               </tr>';
   }
 } 
 return $data;
}

/* ----------------------------
 edit.php
 Kustuta Kogo Projekt
--------------------------- */
function DeleteProjekt($folder) 
{
 global $data_folder;
 $folder = escapeshellarg($data_folder.$folder);
 exec("rm -rf $folder");
}

/* ----------------------------
 edit.php
 Kustuta Pilt
--------------------------- */
function DeleteImage($image) 
{
 global $data_folder;// 'data/'
 global $thumb;      // '/thumb'
 
 $img = pathinfo($image);
 $projekt = explode('/', $image);

 $image_th = $data_folder.$projekt[1].$thumb.'/th_'.$img["basename"];
 
 unlink($image);
 if (file_exists($image_th))
 {
   unlink($image_th);
 }
}

/* ----------------------------
 edit.php
 Kustuta PDF
--------------------------- */
function DeletePdf($pdf) 
{
 global $data_folder;
 global $thumb;
       
 $md5_pdf= md5_file($pdf);
 $projekt = explode('/', $pdf);

 $pdf_th = $data_folder.$projekt[1].$thumb.'/'.$md5_pdf.'.jpg';
 
 if(file_exists($pdf)){
   unlink($pdf) or die ("Ei saa: $php_errormsg");
 }
 if(file_exists($pdf_th)){
   unlink($pdf_th) or die ("Ei saa: $php_errormsg");
 }
}


/* -------------------------------------------
 Otsingu funtsioon
 -mitte eriti sygav - ei kaasa alamkatalooge
-------------------------------------------- */
function search_glob($pattern='', $flags = 0, $path=''){
  global $data_folder;
	$path = $data_folder.'*/';
	$files = glob($path.$pattern, GLOB_BRACE);
	return $files;
}

?>
