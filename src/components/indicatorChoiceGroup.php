<div class="agreement-group" id="<?php echo $indicatorOrder ?>-<?php echo $indicatorRole ?>">
  <label for="<?php echo $indicatorOrder ?>-<?php echo $indicatorRole ?>">
    <?php echo $indicatorTitle ?>
    <?php if ($indicatorRole == 'admin') : ?>
    <span method="<?php echo $indicatorName ?>"><i class="fas fa-info-circle"></i></span>
    <?php endif; ?>
  </label>
  <?php
  foreach ($inputs as $input) {
    if ($indicatorRole == 'admin') {
      $inputName = $input->name;
      $inputTitle = $input->title;
      $inputType = $input->type;
      $inputValue = $input->value;
      $tableName = $input->tableName;
      include '../../components/inputRadioIndicatorAdmin.php';
    } else if ($indicatorRole == 'contact') {
      $inputName = $input->name;
      $inputTitle = $input->title;
      $inputType = $input->type;
      $inputValue = $input->value;
      $tableName = $input->tableName;
      include '../../components/inputRadioIndicatorContact.php';
    }
  }
  ?>
</div>