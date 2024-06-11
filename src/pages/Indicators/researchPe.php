<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
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
  <link rel="stylesheet" href="../../css/components/agreementGroup.css">
  <link rel="stylesheet" href="../../css/components/commentGroup.css">
  <link rel="stylesheet" href="../../css/components/inputYesNo.css">
  <link rel="stylesheet" href="../../css/components/videoContainer.css">
  <link rel="stylesheet" href="../../css/pages/indicators.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/components/modalMethod.css">
  <link rel="stylesheet" href="../../css/components/cardLocation.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <?php include '../../components/modalMetodology.php'; ?>
    <?php
      $cardLocationPath = "../../assets/card_pe_research.png";
      include '../../components/cardLocation.php';
    ?>
    <?php 
      $typeModal = "warning";
      $icon = "fas fa-exclamation-triangle";
      $buttonCloseText = "Close";
      include '../../components/modalInfo.php'; 
    ?>
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1>Research in PE and school-based PA <i class="fas fa-info-circle" id="cardLocationModal"></i></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="indicators-container">
      <?php include '../../components/sideNavBar.php'; ?>
      <div style="display: flex; flex-direction:column; gap:2rem; margin-left: 10rem;">
        <?php 
          $videoTitle = "Methodological approach for collecting Physical Education and school-based physical activity interventions research";
          $videoUrl = "https://drive.google.com/file/d/1jt1NhHPP0CY-s7I-yg6sAzZ-F5S76doK/preview";
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
              information box <span method="pe_research"><i class="fas fa-info-circle"></i></span>.
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
            <!-- <img data-pdf-thumbnail-file="../../uploads/tables/<?php echo $_GET["id"]; ?>.pdf"> -->
            <embed src="../../uploads/tables/<?php echo $adminValues['file_name']; ?>" type="application/pdf"
              width="100%" height="400px" />
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
  <script src="./methods/researchPe.js"></script>

  <script>
  $(document).ready(function(e) {
    $(".btn-back").click(function() {
      window.location.href = "../Indicators/peMonitoring.php<?php echo "?id=" . $_GET['id'] ?>";
    });
    $(".btn-next").click(function() {
      window.location.href = "../Indicators/conclusion.php<?php echo "?id=" . $_GET['id'] ?>";
    });

    $(".hide-show-video").click(function() {
      hideVideo()
    });

    $("#addStudy").click(function() {
      addStudy();
    });

    let methodSpans = document.querySelectorAll("[method='pe_research']");
    methodSpans.forEach(methodSpan => {
      methodSpan.addEventListener("click", function() {
        openModalMethod(methodSpan.getAttribute("method"))
      })
    })

    openCardLocationModal()

  });

  function openModalMethod(method) {
    const methodData = methods.find(
      m => m.name == method)

    $("#modalMethod").css("display", "block")

    $("#indicatorTitle").html(methodData.title)
    $("#modalIndicatorMethod").html(methodData.html)
    $("#modal-close-method").click(function() {
      closeModalMethod()
    })
  }

  function closeModalMethod() {
    $("#indicatorTitle").html("")
    $("#modalIndicatorMethod").html("")
    $("#modalMethod").css("display", "none")
  }

  function openCardLocationModal() {
    $("#cardLocationModal").click(function() {
      $("#cardLocation").css("display", "block")
      $("#card-location-modal-close").click(function() {
        closeCardLocationModal()
      })
    })
  }

  function closeCardLocationModal() {
    $("#cardLocation").css("display", "none")
  }

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
      <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Intervention study
        ${inc}
      </h3>
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
        <input type="number" name="year-${inc}" id="year-${inc}"
          onblur="saveIntervationStudiesValues(${inc})">
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="authors-${inc}">
          Authors 
        </label>
        <textarea name="authors-${inc}" id="authors-${inc}" cols="30" rows="2"
          onblur="saveIntervationStudiesValues(${inc})"></textarea>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="eletronic-source-${inc}">
          Eletronic source
        </label>
        <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
          information.</p>
        <textarea name="eletronic-source-${inc}" id="eletronic-source-${inc}" cols="30" rows="2"
          onblur="saveIntervationStudiesValues(${inc})"></textarea>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="is_pop_study_comp-${inc}">
          Is the population of the study composed of children aged 5 to 10 years old and/or adolescents aged 11 to 17 years
          old attending school (for different age limits, the mean age needs to fall within these gaps)?
        </label>
        <div class="switch-field" id="is_pop_study_comp-${inc}">
          <input type="radio" id="is_pop_study_comp-${inc}-yes" name="is_pop_study_comp-${inc}"
            value="yes" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="is_pop_study_comp-${inc}-yes">Yes</label>
          <input type="radio" id="is_pop_study_comp-${inc}-no" name="is_pop_study_comp-${inc}"
            value="no" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="is_pop_study_comp-${inc}-no">No</label>
        </div>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="is_main_outcome-${inc}">
          Is physical activity the main/primary outcome of the study (e.g. moderate to vigorous physical activity, meeting the physical activity recommendations, number of steps, active travel, etc)?
        </label>
        <div class="switch-field" id="is_main_outcome-${inc}">
          <input type="radio" id="is_main_outcome-${inc}-yes" name="is_main_outcome-${inc}"
            value="yes" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="is_main_outcome-${inc}-yes">Yes</label>
          <input type="radio" id="is_main_outcome-${inc}-no" name="is_main_outcome-${inc}"
            value="no" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="is_main_outcome-${inc}-no">No</label>
        </div> 
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="is_study_intervention-${inc}">
          Is the study an intervention (e.g. randomized-controlled trial, quasi-experimental, …) or a study with a different design (e.g. longitudinal, cohort, qualitative) but related to an intervention?
        </label>
        <div class="switch-field" id="is_study_intervention-${inc}">
          <input type="radio" id="is_study_intervention-${inc}-yes"
            name="is_study_intervention-${inc}" value="yes" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="is_study_intervention-${inc}-yes">Yes</label>
          <input type="radio" id="is_study_intervention-${inc}-no"
            name="is_study_intervention-${inc}" value="no" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="is_study_intervention-${inc}-no">No</label>
        </div>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="is_prim_school_set-${inc}">
          Is the study primarily conducted within the school setting?
        </label>
        <div class="switch-field" id="is_prim_school_set-${inc}">
          <input type="radio" id="is_prim_school_set-${inc}-yes" name="is_prim_school_set-${inc}"
            value="yes" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="is_prim_school_set-${inc}-yes">Yes</label>
          <input type="radio" id="is_prim_school_set-${inc}-no" name="is_prim_school_set-${inc}"
            value="no" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="is_prim_school_set-${inc}-no">No</label>
        </div>
        
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="is_published_peer-${inc}">
          Is the study published in a peer-reviewed journal?
        </label>
        <div class="switch-field" id="is_published_peer-${inc}">
          <input type="radio" id="is_published_peer-${inc}-yes" name="is_published_peer-${inc}"
            value="yes" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="is_published_peer-${inc}-yes">Yes</label>
          <input type="radio" id="is_published_peer-${inc}-no" name="is_published_peer-${inc}"
            value="no" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="is_published_peer-${inc}-no">No</label>

        </div>
      </div>
      <div class=" indicator-input" style="margin: 0 !important">
        <label for="was_collected-${inc}">
          Was the data of the study collected until December 2019 or after January 2021?
        </label>
        <div class="switch-field" id="was_collected-${inc}">
          <input type="radio" id="was_collected-${inc}-yes" name="was_collected-${inc}" value="yes" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="was_collected-${inc}-yes">Yes</label>
          <input type="radio" id="was_collected-${inc}-no" name="was_collected-${inc}" value="no" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="was_collected-${inc}-no">No</label>

        </div>
      </div>

      <div class=" indicator-input" style="margin: 0 !important">
        <label for="has_abstract_en-${inc}">
          Does the study has an abstract written in English?
        </label>
        <div class="switch-field" id="has_abstract_en-${inc}">
          <input type="radio" id="has_abstract_en-${inc}-yes" name="has_abstract_en-${inc}" value="yes" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="has_abstract_en-${inc}-yes">Yes</label>
          <input type="radio" id="has_abstract_en-${inc}-no" name="has_abstract_en-${inc}" value="no" onclick="saveIntervationStudiesValues(${inc})" />
          <label for="has_abstract_en-${inc}-no">No</label>

        </div>
      </div>
      <button class="btn-delete" onclick="deleteStudy(${inc})"><strong>Delete</strong> Study</button>
    </div>
    `;


    $("#studies").append(study);
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
          // console.log(data);
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
    const authors = grupoStudy.querySelector(`#authors-${inc}`);
    const isPopStudyCompYes = grupoStudy.querySelector(`#is_pop_study_comp-${inc}-yes`);
    const isPopStudyCompNo = grupoStudy.querySelector(`#is_pop_study_comp-${inc}-no`);
    const isMainOutcomeYes = grupoStudy.querySelector(`#is_main_outcome-${inc}-yes`);
    const isMainOutcomeNo = grupoStudy.querySelector(`#is_main_outcome-${inc}-no`);
    const isStudyInterventionYes = grupoStudy.querySelector(`#is_study_intervention-${inc}-yes`);
    const isStudyInterventionNo = grupoStudy.querySelector(`#is_study_intervention-${inc}-no`);
    const isPrimSchoolSetYes = grupoStudy.querySelector(`#is_prim_school_set-${inc}-yes`);
    const isPrimSchoolSetNo = grupoStudy.querySelector(`#is_prim_school_set-${inc}-no`);
    const isPublishedPeerYes = grupoStudy.querySelector(`#is_published_peer-${inc}-yes`);
    const isPublishedPeerNo = grupoStudy.querySelector(`#is_published_peer-${inc}-no`);
    const wasCollectedYes = grupoStudy.querySelector(`#was_collected-${inc}-yes`);
    const wasCollectedNo = grupoStudy.querySelector(`#was_collected-${inc}-no`);
    const hasAbstractEnYes = grupoStudy.querySelector(`#has_abstract_en-${inc}-yes`);
    const hasAbstractEnNo = grupoStudy.querySelector(`#has_abstract_en-${inc}-no`);

    let isPopStudyComp = null;
    if (isPopStudyCompYes.checked) {
      isPopStudyComp = true;
    } else if (isPopStudyCompNo.checked) {
      isPopStudyComp = false;
    }

    let isMainOutcome = null;
    if (isMainOutcomeYes.checked) {
      isMainOutcome = true;
    } else if (isMainOutcomeNo.checked) {
      isMainOutcome = false;
    }

    let isStudyIntervention = null;
    if (isStudyInterventionYes.checked) {
      isStudyIntervention = true;
    } else if (isStudyInterventionNo.checked) {
      isStudyIntervention = false;
    }

    let isPrimSchoolSet = null;
    if (isPrimSchoolSetYes.checked) {
      isPrimSchoolSet = true;
    } else if (isPrimSchoolSetNo.checked) {
      isPrimSchoolSet = false;
    }

    let isPublishedPeer = null;
    if (isPublishedPeerYes.checked) {
      isPublishedPeer = true;
    } else if (isPublishedPeerNo.checked) {
      isPublishedPeer = false;
    }

    let wasCollected = null;
    if (wasCollectedYes.checked) {
      wasCollected = true;
    } else if (wasCollectedNo.checked) {
      wasCollected = false;
    }

    let hasAbstractEn = null;
    if (hasAbstractEnYes.checked) {
      hasAbstractEn = true;
    } else if (hasAbstractEnNo.checked) {
      hasAbstractEn = false;
    }


    const values = {
      title: title.value,
      year: year.value,
      authors: authors.value,
      eletronicSource: eletronicSource.value,
      isPopStudyComp: isPopStudyComp,
      isMainOutcome: isMainOutcome,
      isStudyIntervention: isStudyIntervention,
      isPrimSchoolSet: isPrimSchoolSet,
      isPublishedPeer: isPublishedPeer,
      wasCollected: wasCollected,
      hasAbstractEn: hasAbstractEn
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