<?php
include_once "../../../config.php"
?>
<?php
$country_id = $_GET['id'];
$target_dir = "../../uploads/tables";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$sql = "SELECT file_name FROM research_pe_admin WHERE id_country = $country_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$oldFile = $row['file_name'];
$oldFilePath = $target_dir . "/" . $oldFile;

unlink($oldFilePath);

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
$uniqueId = time();
$pdf = $country_id . "-" . $uniqueId . ".pdf";
$pdfPath = $target_dir . "/" . $pdf;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $pdfPath)) {
    //sql update cards_en table of has_card to 1
    $sql = "UPDATE research_pe_admin SET has_table = 1, file_name = '$pdf' WHERE id_country = $country_id";
    mysqli_query($conn, $sql);

    header("Location: ../../pages/Indicators/researchPe.php?id=$country_id");
  } else {
    header("Location: ../../pages/Indicators/researchPe.php?id=$country_id");
  }
}
?>