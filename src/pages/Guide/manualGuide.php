<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}

$videosUrl = [
  "https://drive.google.com/file/d/1IN3WSir94uzGzdt_2is7Wj1ajX70-rMP/preview",
  "https://drive.google.com/file/d/1YTK7IsJXtEKFuWUO-MKCc8U6tgMyYXss/preview",
  "https://drive.google.com/file/d/16CIawm6043Q6BwhY_fIyMzPm6cs29ySc/preview",
  "https://drive.google.com/file/d/1NHY5mY9usAQExZg9MzgHikgb0LEhdnTf/preview"
];

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Workflow Guide - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/pages/dashboard.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <div class="container__title-header">
      <h1>Workflow <strong>Guide</strong></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2><strong>Manual</strong> and <strong>Videos</strong></h2>
      </div>
      <div class="dashboard-container__manual">
        <div class="manual">
          <h2>English Manual</h2>
          <p>
            Detailed instructions for navigating this system and completing the Country Card review and approval process
            can be found here.
          </p>
          <button class="btn-primary">
            View
          </button>
          <a href="../../assets/GoPE!_User_Manual_English.pdf" download>
            <button class="btn-primary">
              Download <span> <i class="fas fa-download"></i></span>
            </button>
          </a>
        </div>
        <div>
          <object data="../../ assets/GoPE!_User_Manual_English.pdf" type="application/pdf" width="100%" height="100%">
            <p>Link <a href="../../assets/GoPE!_User_Manual.pdf">to the PDF!</a></p>
          </object>
        </div>
      </div>
      <div class="dashboard-container__manual">
        <div class="manual">
          <h2>Spanish Manual</h2>
          <p>
            Detailed instructions for navigating this system and completing the Country Card review and approval process
            can be found here.
          </p>
          <button class="btn-primary">
            View
          </button>
          <a href="../../
          assets/GoPE!_User_Manual_Spanish.pdf" download>
            <button class="btn-primary">
              Download <span> <i class="fas fa-download"></i></span>
            </button>
          </a>
        </div>
        <div>
          <object data="../../assets/GoPE!_User_Manual_Spanish.pdf" type="application/pdf" width="100%" height="100%">
            <p>Link <a href="../../assets/GoPE!_User_Manual.pdf">to the PDF!</a></p>
          </object>
        </div>
      </div>
      <div class="dashboard_container__videos-carousel">
        <h2>Instructional Videos</h2>
        <div class="slider-video">
          <a href="#0" class="next control"><i class="fas fa-chevron-right"></i></a>
          <a href="#0" class="prev control"><i class="fas fa-chevron-left"></i></a>
          <ul>
            <?php foreach ($videosUrl as $videoUrl) : ?>
            <li class="dashboard_container__videos-carousel__video">
              <iframe width="560" height="315" src="<?php echo $videoUrl; ?>" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  $(function() {

    var slideCount = $(".slider-video ul li").length;
    var slideWidth = $(".slider-video ul li").width();
    var slideHeight = $(".slider-video ul li").height();
    var slideUlWidth = slideCount * slideWidth;

    $(".slider-video").css({
      "max-width": slideWidth,
      "height": slideHeight
    });
    // $(".slider-video ul").css({
    //   "width": slideUlWidth,
    //   "margin-left": -slideWidth
    // });
    $(".slider-video ul li:last-child").prependTo($(".slider-video ul"));

    function moveLeft() {
      $(".slider-video ul").stop().animate({
        left: +slideWidth
      }, 700, function() {
        $(".slider-video ul li:last-child").prependTo($(".slider-video ul"));
        $(".slider-video ul").css("left", "");
      });
    }

    function moveRight() {
      $(".slider-video ul").stop().animate({
        left: -slideWidth
      }, 700, function() {
        $(".slider-video ul li:first-child").appendTo($(".slider-video ul"));
        $(".slider-video ul").css("left", "");
      });
    }


    $(".next").on("click", function() {
      moveRight();
    });

    $(".prev").on("click", function() {
      moveLeft();
    });


  });

  const btnNext = document.querySelector('.btn-next');
  btnNext.addEventListener('click', () => {
    window.location.href = 'workflowInstructions.php';
  });
  </script>
</body>

</html>