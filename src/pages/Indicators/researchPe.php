<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}

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

$sql = "SELECT * FROM research_pe_comments WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$commentValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM research_pe_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$adminValues = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Physical education research - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/sideNavBar.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/components/commentGroup.css">
  <link rel="stylesheet" href="../../css/pages/indicators.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1>Country <strong>Progress</strong></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="indicators-container">
      <?php include '../../components/sideNavBar.php'; ?>
      <div style="display: flex; flex-direction:column; gap:2rem; margin-left: 10rem;">
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>Physical Education and school-based physical activity research</strong></h2>
          </div>

          <!-- show a pdf with the table of intervation studies -->
          <div class="thumbnail-pdf" id="preview">
            <?php if ($adminValues['has_table'] == 0) : ?>
            <p>No table uploaded</p>
            <form action="../../query/Indicators/tableUpload.php?id=<?php echo $_GET["id"]; ?>" method="post"
              enctype="multipart/form-data">
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" value="Confirm" name="submit">
            </form>
            <?php else : ?>
            <img data-pdf-thumbnail-file="../../uploads/tables/<?php echo $_GET["id"]; ?>.pdf">
            <form action="../../query/Indicators/tableUpload.php?id=<?php echo $_GET["id"]; ?>" method="post"
              enctype="multipart/form-data">
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" value="Confirm" name="submit">
            </form>
            <div class="control-panel">
              <a href="../../uploads/tables/<?php echo $_GET["id"]; ?>.pdf" download class="btn-primary">
                <strong>Download</strong> table
              </a>
              <button class="btn-add">
                <strong>Add</strong> intervation study
              </button>
            </div>
            <?php endif; ?>
          </div>


          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorName = "research_pe";
              $indicatorOrder = 1;
              $tableName = "research_pe";
              include '../../components/commentGroup.php';
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
  $(document).ready(function(e) {
    $(".thumbnail-pdf img").each(function() {
      var pdf = $(this).data("pdf-thumbnail-file");
      var img = $(this);
      pdfjsLib.getDocument(pdf).promise.then(function(pdf) {
        return pdf.getPage(1);
      }).then(function(page) {
        var scale = 1.5;
        var viewport = page.getViewport({
          scale: scale
        });
        var canvas = document.createElement("canvas");
        var context = canvas.getContext("2d");
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        var renderContext = {
          canvasContext: context,
          viewport: viewport
        };
        page.render(renderContext).promise.then(function() {
          img.attr("src", canvas.toDataURL());
        });
      });
    });

  });

  function uploadTable() {
    const pdfFile = document.getElementById("pdfFile");
    const countryId = <?php echo $_GET["id"]; ?>;
    const formData = new FormData();
    formData.append("pdfFile", pdfFile.files[0]);
    formData.append("countryId", countryId);
    $.ajax({
      url: "../../query/Indicators/tableUpload.php",
      type: "POST",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function(data) {
        if (data == "invalid") {
          alert("Invalid file format. Please upload a PDF file.");
        } else if (data == "no file selected") {
          alert("No file selected");
        } else {
          location.reload();
        }
      }
    });
  }
  </script>
</body>

</html>