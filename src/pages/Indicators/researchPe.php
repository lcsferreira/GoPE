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

$sql = "SELECT * FROM research_pe_agreement WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$agreementValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM research_pe_intervation_studies WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$intervationStudies = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
  <link rel="stylesheet" href="../../css/components/agreementGroup.css">
  <link rel="stylesheet" href="../../css/components/commentGroup.css">
  <link rel="stylesheet" href="../../css/components/inputYesNo.css">
  <link rel="stylesheet" href="../../css/components/videoContainer.css">
  <link rel="stylesheet" href="../../css/pages/indicators.css">
  <link rel="stylesheet" href="../../css/components/modalMethod.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <?php include '../../components/modalMetodology.php'; ?>
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1>Country <strong>Indicators</strong></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="indicators-container">
      <?php include '../../components/sideNavBar.php'; ?>
      <div style="display: flex; flex-direction:column; gap:2rem; margin-left: 10rem;">
        <?php 
          $videoTitle = "Methodological approach for collecting Physical Education and school-based physical activity interventions research";
          $videoUrl = "https://www.youtube.com/embed/1w7OgIMMRc4";
          include '../../components/videoContainer.php'; ?>
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>Physical Education and school-based physical activity interventions research</strong></h2>
          </div>


          <div class="instructions">
            <p style="text-align: justify;">
              Please consult the table below, which includes the Physical Education and
              school-based physical activity intervention studies conducted in your country,
              identified through an umbrella systematic review.
              <br>
              You can add different
              intervention studies that may exist and were not identified through the research
              process. To add an intervention study, please consult the inclusion criteria on the
              information box <i class="fas fa-info-circle"></i>.
            </p>
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
            <?php if($_SESSION['type'] == 'admin'): ?>
            <form action="../../query/Indicators/tableUpload.php?id=<?php echo $_GET["id"]; ?>" method="post"
              enctype="multipart/form-data">
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" value="Confirm" name="submit">
            </form>
            <?php endif; ?>
            <div class="control-panel">
              <a href="../../uploads/tables/<?php echo $_GET["id"]; ?>.pdf" download class="btn-primary">
                <strong>Download</strong> table
              </a>
              <button class="btn-add" id="addStudy">
                <strong>Add</strong> Intervention study
              </button>
            </div>
            <?php endif; ?>
          </div>


          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <div id="studies">
                <?php
                  if($intervationStudies != null){
                    foreach ($intervationStudies as $intervationStudy) {
                      $inc = $intervationStudy["inc"];
                      
                      include '../../components/intervationStudies.php';
                    }
                  }
                ?>
              </div>
              <?php
              $indicatorName = "research_pe";
              $indicatorOrder = 1;
              $tableName = "research_pe_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 1;
            $indicatorName = "studies_table";
            $tableName = "research_pe_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
  const methods = [{
    "name": "APA 7th reference",
    "html": "<p>Example of a reference following APA 7th: </p><p><strong>Main structure: </strong>Auhtors’ last name, Authors’ first name initial letter. (Year of publication). Articles title. Journals’ title, volume(number), pages. DOI: </p><p><strong>Example: </strong>Martins, J., Onofre, M., & Hallal, P. C. (2023). Launch of the Global Observatory for Physical Education (GoPE!). Journal of Physical Activity and Health, 20(7), 573-574. DOI: 10.1123/jpah.2023-0099 </p>"
  }]
  $(document).ready(function(e) {
    $(".btn-back").click(function() {
      window.location.href = "../Indicators/peMonitoring.php<?php echo "?id=" . $_GET['id'] ?>";
    });
    $(".btn-next").click(function() {
      window.location.href = "../Indicators/conclusion.php<?php echo "?id=" . $_GET['id'] ?>";
    });
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

    $(".hide-show-video").click(function() {
      hideVideo()
    });

    $("#addStudy").click(function() {
      addStudy();
    });

    $("#apa7thMethod").click(function() {
      $("#modalMethod").show();
      const method = methods.find(method => method.name === "APA 7th reference");
      $("#indicatorTitle").text(method.name);
      $("#modalIndicatorMethod").html(method.html);
      $("#modal-close-method").click(function() {
        $("#modalMethod").hide();
      });
    });
  });

  function saveAgreementValue(indicatorName, tableName, value) {
    let idCountry = <?php echo $_GET['id'] ?>;
    const payload = {
      tableName: tableName,
      indicatorName: indicatorName,
      value: value,
      idCountry: idCountry
    }

    $.ajax({
      type: "POST",
      url: "../../query/Indicators/updateAgreementValue.php",
      data: {
        payload: payload
      },
      success: function(response) {
        console.log(response)
      }
    });
  }

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

  function showAddStudy() {
    //add an input group to the page
    const studies = document.getElementById("studies");
    const inc = studies.childElementCount + 1;
    const study = `
    <div class="agreement-group" id="${inc}" style="margin: 0 !important">
      <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Intervation study
        ${inc}
      </h3>
      <div class="indicator-input" style="margin: 0 !important">
        <label for="${inc}">
        PE and school-based PA domains
        <br><span style="font-weight: 400; font-size:1rem; margin: 0">(More than 1 option can be selected)</span>
        </label>
        <div class="agreement-group" id="${inc}" style="margin: 0 !important">
          <label for="pe-${inc}" class="radio-option-no-description" style="width: auto !important;">
            <div class="option-text">
              <h3>Physical Education</h3>
            </div>
            <input type="checkbox" name="radio-group-intervation-studies" id="pe-${inc}" value="pe" onclick="saveIntervationStudiesValues(${inc})"/>
            <span class="checkmark"></span>
          </label>
          <label for="atp-${inc}" class="radio-option-no-description" style="width: auto !important;">
            <div class="option-text">
              <h3>Active transport</h3>
            </div>
            <input type="checkbox" name="radio-group-intervation-studies" id="atp-${inc}" value="atp" onclick="saveIntervationStudiesValues(${inc})"/>
            <span class="checkmark"></span>
          </label>
          <label for="ac-${inc}" class="radio-option-no-description" style="width: auto !important;">
            <div class="option-text">
              <h3>Active classes/breaks</h3>
            </div>
            <input type="checkbox" name="radio-group-intervation-studies" id="ac-${inc}" value="ac" onclick="saveIntervationStudiesValues(${inc})"/>
            <span class="checkmark"></span>
          </label>
          <label for="ar-${inc}" class="radio-option-no-description" style="width: auto !important;">
            <div class="option-text">
              <h3>Active recess</h3>
            </div>
            <input type="checkbox" name="radio-group-intervation-studies" id="ar-${inc}" value="ar" onclick="saveIntervationStudiesValues(${inc})"/>
            <span class="checkmark"></span>
          </label>
          <label for="e_pa-${inc}" class="radio-option-no-description" style="width: auto !important;">
            <div class="option-text">
              <h3>Extracurricular physical activity</h3>
            </div>
            <input type="checkbox" name="radio-group-intervation-studies" id="e_pa-${inc}" value="e_pa" onclick="saveIntervationStudiesValues(${inc})"/>
            <span class="checkmark"></span>
          </label>
          <label for="other-${inc}" class="radio-option-no-description" style="width: auto !important;">
          <div class="option-text">
            <h3>Other</h3>
          </div>
          <input type="checkbox" name="radio-group-intervation-studies" id="other-${inc}" value="other"
            onclick="saveIntervationStudiesValues(${inc})" />
          <span class="checkmark"></span>
          </label>
        </div>
      </div>
      <div class=" indicator-input" hidden style="margin: 0 !important" id="other-domain-container-${inc}">
        <label for="other-domain-${inc}">
          Other domain
        </label>
        <textarea name="other-domain-${inc}" id="other-domain-${inc}" cols="30" rows="2"
          onblur="saveIntervationStudiesValues(${inc})"></textarea>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="title-${inc}">
          Title
        </label>
        <textarea name="title-${inc}" id="title-${inc}" cols="30" rows="2"
          onblur="saveIntervationStudiesValues(${inc})"></textarea>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="year-${inc}">
          Year
        </label>
        <input type="text" name="year-${inc}" id="year-${inc}"
          onblur="saveIntervationStudiesValues(${inc})">
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="eletronic-source-${inc}">
          Eletronic source
        </label>
        <textarea name="eletronic-source-${inc}" id="eletronic-source-${inc}" cols="30" rows="2"
          onblur="saveIntervationStudiesValues(${inc})"></textarea>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="apa7th_reference-${inc}">
          APA 7th reference
        </label>
        <textarea name="apa7th_reference-${inc}" id="apa7th_reference-${inc}" cols="30" rows="2"
          onblur="saveIntervationStudiesValues(${inc})"></textarea>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="inclusion-criteria-${inc}">
          Inclusion criteria
        </label>
        <textarea name="inclusion-criteria-${inc}" id="inclusion-criteria-${inc}" cols="30"
          rows="4"
          onblur="saveIntervationStudiesValues(${inc})"></textarea>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="exclusion-criteria-${inc}">
          Exclusion criteria
        </label>
        <textarea name="exclusion-criteria-${inc}" id="exclusion-criteria-${inc}" cols="30"
          rows="4"
          onblur="saveIntervationStudiesValues(${inc})"></textarea>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="main-outcomes-${inc}">
          Main outcomes
        </label>
        <textarea name="main-outcomes-${inc}" id="main-outcomes-${inc}" cols="30" rows="4"
          onblur="saveIntervationStudiesValues(${inc})"></textarea>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="min-age-samples-${inc}">
          Minimum age of the sample
        </label>
        <input type="text" name="min-age-samples-${inc}" id="min-age-samples-${inc}"
          onblur="saveIntervationStudiesValues(${inc})">
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="avg-age-samples-${inc}">
          Average age of the sample
        </label>
        <input type="text" name="avg-age-samples-${inc}" id="avg-age-samples-${inc}"
          onblur="saveIntervationStudiesValues(${inc})">
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="max-age-samples-${inc}">
          Maximum age of the sample
        </label>
        <input type="text" name="max-age-samples-${inc}" id="max-age-samples-${inc}"
          onblur="saveIntervationStudiesValues(${inc})">
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="period-data-collection-${inc}">
          Period of data collection
        </label>
        <input type="text" name="period-data-collection-${inc}" id="period-data-collection-${inc}"
          onblur="saveIntervationStudiesValues(${inc})">
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="not_was_lockdown-${inc}">
        Do you confirm that your country was not in a lockdown status due to the covid 19 pandemic when the data collection took place?
        </label>
        <div class="switch-field" id="not_was_lockdown-${inc}">
          <input type="radio" id="not_was_lockdown-${inc}-yes" name="not_was_lockdown-${inc}"
            value="yes" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="not_was_lockdown-${inc}-yes">Yes</label>
          <input type="radio" id="not_was_lockdown-${inc}-no" name="not_was_lockdown-${inc}"
            value="no" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="not_was_lockdown-${inc}-no">No</label>
        </div>
      </div>
      <button class="btn-delete" onclick="deleteStudy(${inc})"><strong>Delete</strong> Study</button>
    </div>
    `;
    studies.innerHTML += study;
  }

  function addStudy() {
    const studies = document.getElementById("studies");
    const inc = studies.childElementCount + 1;

    $.ajax({
      url: "../../query/Indicators/addStudy.php?id=<?php echo $_GET["id"]; ?>",
      type: "POST",
      data: {
        inc: inc
      },
      success: function(data) {
        if (data == "Success") {
          showAddStudy();
        } else {
          console.log(data);
        }
      }
    });

  }

  function removeStudy(inc) {
    const study = document.getElementById(inc);
    study.remove();
  }

  function deleteStudy(inc) {
    $.ajax({
      url: "../../query/Indicators/deleteStudy.php?id=<?php echo $_GET["id"]; ?>",
      type: "POST",
      data: {
        inc: inc
      },
      success: function(data) {
        if (data == "Success") {
          removeStudy(inc);
        } else {
          console.log(data);
        }
      }
    });
  }

  function saveIntervationStudiesValues(inc) {
    const grupoStudy = document.getElementById(inc);
    const title = grupoStudy.querySelector(`#title-${inc}`);
    const year = grupoStudy.querySelector(`#year-${inc}`);
    const eletronicSource = grupoStudy.querySelector(`#eletronic-source-${inc}`);
    const apa7thReference = grupoStudy.querySelector(`#apa7th_reference-${inc}`);
    const inclusionCriteria = grupoStudy.querySelector(`#inclusion-criteria-${inc}`);
    const exclusionCriteria = grupoStudy.querySelector(`#exclusion-criteria-${inc}`);
    const mainOutcomes = grupoStudy.querySelector(`#main-outcomes-${inc}`);
    const minAgeSamples = grupoStudy.querySelector(`#min-age-samples-${inc}`);
    const avgAgeSamples = grupoStudy.querySelector(`#avg-age-samples-${inc}`);
    const maxAgeSamples = grupoStudy.querySelector(`#max-age-samples-${inc}`);
    const periodDataCollection = grupoStudy.querySelector(`#period-data-collection-${inc}`);
    const lockdownYes = grupoStudy.querySelector(`#not_was_lockdown-${inc}-yes`);
    const lockdownNo = grupoStudy.querySelector(`#not_was_lockdown-${inc}-no`);
    let lockdown = "0";
    if (lockdownYes.checked) {
      lockdown = true;
    } else if (lockdownNo.checked) {
      lockdown = false;
    }


    const pe = grupoStudy.querySelector(`#pe-${inc}`);
    const atp = grupoStudy.querySelector(`#atp-${inc}`);
    const ac = grupoStudy.querySelector(`#ac-${inc}`);
    const ar = grupoStudy.querySelector(`#ar-${inc}`);
    const e_pa = grupoStudy.querySelector(`#e_pa-${inc}`);
    const other = grupoStudy.querySelector(`#other-${inc}`);
    if (other.checked) {
      $(`#other-domain-container-${inc}`).show();
    } else {
      $(`#other-domain-container-${inc}`).hide();
    }

    const otherDomain = grupoStudy.querySelector(`#other-domain-${inc}`).value;

    const values = {
      pe: pe.checked,
      atp: atp.checked,
      ac: ac.checked,
      ar: ar.checked,
      e_pa: e_pa.checked,
      other: other.checked,
      otherText: otherDomain,
      title: title.value,
      year: year.value,
      eletronicSource: eletronicSource.value,
      apa7thReference: apa7thReference.value,
      inclusionCriteria: inclusionCriteria.value,
      exclusionCriteria: exclusionCriteria.value,
      mainOutcomes: mainOutcomes.value,
      minAgeSamples: minAgeSamples.value,
      avgAgeSamples: avgAgeSamples.value,
      maxAgeSamples: maxAgeSamples.value,
      periodDataCollection: periodDataCollection.value,
      lockdown: lockdown
    };

    console.log(values);

    $.ajax({
      url: "../../query/Indicators/saveIntervationStudiesValues.php?id=<?php echo $_GET["id"]; ?>",
      type: "POST",
      data: {
        inc: inc,
        values: values
      },
      success: function(data) {
        if (data == "Success") {
          console.log("Success");
        } else {
          console.log(data);
        }
      }
    });

  }

  function saveComment(inputName, tableName) {
    //get the value from textarea
    let value = $(`#${inputName}-comments`).val()
    let idCountry = <?php echo $_GET['id'] ?>;

    const payload = {
      tableName: tableName,
      inputName: inputName,
      value: value,
      idCountry: idCountry
    }

    $.ajax({
      type: "POST",
      url: "../../query/Indicators/updateIndicatorValue.php",
      data: {
        payload: payload
      },
      success: function(response) {
        console.log(response)
      }
    });
  }

  function hideComment(divName) {
    if ($(`#${divName}`).is(":hidden")) {
      $(`#${divName}`).show()
    } else {
      $(`#${divName}`).hide()
    }
  }

  function hideVideo() {
    if ($(".indicator-video-container__content").is(":hidden")) {
      $(".indicator-video-container__content").show()
      //rotate the icon
      $(".indicator-video-container__icon").css("transform", "rotate(0deg)")
      $(".indicator-video-container__header").css("border-radius", "0.75rem 0.75rem 0 0")
    } else {
      $(".indicator-video-container__content").hide()
      //rotate the icon
      $(".indicator-video-container__icon").css("transform", "rotate(180deg)")
      $(".indicator-video-container__header").css("border-radius", "0.75rem")
    }
  }
  </script>
</body>

</html>