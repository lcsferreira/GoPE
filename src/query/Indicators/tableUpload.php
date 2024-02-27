<?php
include_once "../../../config.php"
?>
<?php
function getThumbnail($path, $country)
{
  if (is_dir($path)) {
    $files = scandir($path);

    foreach ($files as $file) {
      if ($file != "." && $file != ".." && strpos($file, $country) === 0 && pathinfo($file, PATHINFO_EXTENSION) === "png") {
        return $file; // Retorna o primeiro arquivo encontrado
      }
    }
  }

  return null; // Retorna null se nenhum arquivo for encontrado
}
?>
<?php
$country_id = $_GET['id'];
$target_dir = "../../uploads/tables";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if is pdf file is a real pdf file
if (isset($_POST["submit"])) {
  $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx"
) {
  $uploadOk = 0;
}

$pdf = $target_dir . "/" . $country_id . ".pdf";

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $pdf)) {
    //sql update cards_en table of has_card to 1
    $sql = "UPDATE research_pe_admin SET has_table = 1 WHERE id_country = $country_id";
    mysqli_query($conn, $sql);

    //generate thumbnail
    $pdfFilePath = $pdf;
    $thumbnailFile = $target_dir . $country_id; // Nome fixo para a thumbnail
    $oldThumnail = getThumbnail($target_dir, $country_id);
    // echo $oldThumnail;
    if ($oldThumnail != null) {
      unlink($target_dir . $oldThumnail);
    }
    // $imagick = new Imagick($pdfFilePath);
    // $imagick->setResolution(300, 300);
    // $imagick->setImageFormat('png');
    // $imagick->setResolution(3000, 2000); // Resolução em DPI (dots per inch)
    // $imagick->thumbnailImage(500, 500, true); // Redimensionar para Full HD
    // $imagick->writeImage($thumbnailFile . "-" . date("Y-m-d-H-i-s") . '.png');

    // generate thumbnail png whithout imagick

    header("Location: ../../pages/Indicators/researchPe.php?id=$country_id");

    // echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
  } else {
    header("Location: ../../pages/Indicators/researchPe.php?id=$country_id");
  }
}
?>