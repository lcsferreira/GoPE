<div class="indicator-video-container">
  <div class="indicator-video-container__header">
    <h2><strong><?php echo $videoTitle; ?></strong></h2>
    <button class="hide-show-video">
      <i class="fas fa-chevron-up indicator-video-container__icon"></i>
    </button>
  </div>
  <div class="indicator-video-container__content">
    <iframe src="<?php echo $videoUrl ?>" width="640" height="480" allow="autoplay"></iframe>
  </div>
</div>