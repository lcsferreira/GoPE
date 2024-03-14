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
$cardUpload = $_FILES['cardUpload'];

$valid_extensions = array('pdf'); // valid extensions// upload directory
$path = '../../uploads/cards_en/';

if (!empty($cardUpload)) {
  $pdf = $cardUpload['name'];
  $tmp2 = $cardUpload['tmp_name'];
  // get uploaded file's extension
  $ext2 = strtolower(pathinfo($pdf, PATHINFO_EXTENSION));
  // can upload same image using rand function
  $pdf = $path . $idCountry.'.'.$ext2;
  // check's valid format
  if(in_array($ext2, $valid_extensions)) 
  { 
    if(move_uploaded_file($tmp2,$pdf))
    {
      //sql update cards_en table of has_card to 1
      // $sql = "UPDATE cards_en SET has_card = 1 WHERE id = $idCountry";
      // mysqli_query($connection, $sql);

      //generate thumbnail
      $pdfFilePath = $pdf;
      $thumbnailFile = $path . $idCountry; // Nome fixo para a thumbnail
      // echo $thumbnailFile;
      // echo $path;
      $oldThumnail = getThumbnail($path, $idCountry);
      echo $oldThumnail;
      // unlink($path.$oldThumnail);
      $imagick = new Imagick($pdfFilePath);
      $imagick->setResolution(300, 300);
      $imagick->setImageFormat('png'); 
      // $imagick->setResolution(3000, 2000); // Resolução em DPI (dots per inch)
      // $imagick->thumbnailImage(500, 500, true); // Redimensionar para Full HD
      $imagick->writeImage($thumbnailFile."-". date("Y-m-d-H-i-s") . '.png');

      echo $idCountry;
    }
  } else 
  {
    echo 'invalid';
  }
} else {
  echo 'Please select a file';
}
?>