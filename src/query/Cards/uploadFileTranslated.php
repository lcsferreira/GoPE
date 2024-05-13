<?php
include '../../../config.php';

function getThumbnail($path, $country) {
  if (is_dir($path)) {
      $files = scandir($path);
      
      foreach ($files as $file) {
        // echo $file;
        if ($file != "." && $file != ".." && strpos($file, $country) === 0 && pathinfo($file, PATHINFO_EXTENSION) === "png") {
          // echo $file;
          return $file; // Retorna o primeiro arquivo encontrado
        }
      }
  }
  
  return null; // Retorna null se nenhum arquivo for encontrado
}

// $data = $_POST['data'];
$idCountry = $_POST['idCountry'];
$fileUpload = $_FILES['fileUpload'];

$valid_extensions = array('pdf', 'pwp', 'docx'); // valid extensions// upload directory
$path = '../../uploads/files/';

if (!empty($fileUpload)) {
  $pdf = $fileUpload['name'];
  $tmp2 = $fileUpload['tmp_name'];
  // get uploaded file's extension
  $ext2 = strtolower(pathinfo($pdf, PATHINFO_EXTENSION));
  // can upload same image using rand function
  $pdf = $path . $idCountry.'_translated.'.$ext2;
  // check's valid format
  if(in_array($ext2, $valid_extensions)) 
  { 
    if(move_uploaded_file($tmp2,$pdf))
    {
      //sql update cards_en table of has_card to 1
      $sql = "UPDATE cards_tr SET has_contact_file = 1 WHERE id_country = $idCountry";
      mysqli_query($conn, $sql);

      echo "success";
    }
  } else 
  {
    echo 'invalid';
  }
} else {
  echo 'Please select a file';
}
?>