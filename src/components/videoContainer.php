<div class="indicator-video-container">
  <div class="indicator-video-container__header">
    <h2><strong><?php echo $videoTitle; ?></strong></h2>
    <button class="hide-show-video">
      <i class="fas fa-chevron-up indicator-video-container__icon"></i>
    </button>
  </div>
  <div class="indicator-video-container__content">
    <iframe src="<?php echo $videoUrl; ?>" frameborder="0"
      allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen width="500"
      height="400"></iframe>
  </div>
</div>