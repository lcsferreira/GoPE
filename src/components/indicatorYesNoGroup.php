<div class="agreement-group" id="<?php echo $indicatorOrder ?>-<?php echo $indicatorRole ?>">
  <label for="<?php echo $indicatorOrder ?>-<?php echo $indicatorRole ?>">
    Existence of a national, formal, and external monitoring system to evaluate physical education policy
    implementation.
    <?php if ($indicatorRole == 'admin') : ?>
    <span method="<?php echo $indicatorName ?>"><i class="fas fa-info-circle"></i></span>
    <?php endif; ?>
  </label>
  <?php
  include "../../components/inputYesNo.php"; ?>
</div>