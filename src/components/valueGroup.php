<div class="indicator-input" id="<?php echo $inputOrder ?>-admin">
  <label for="<?php echo $inputName ?>-admin">
    <?php $formattedInputName = ucwords(str_replace('-', ' ', $inputName));
    echo $formattedInputName ?></label>
  <input type="<?php echo $groupType ?>" name="<?php echo $inputName ?>" id="<?php echo $inputName ?>">
</div>
<div class="indicator-input" id="<?php echo $inputOrder ?>-contact">
  <p class="contact-label">Provide new information here:</p>
  <label for="<?php echo $inputName ?>-contact">
    <?php $formattedInputName = ucwords(str_replace('-', ' ', $inputName));
    echo $formattedInputName ?></label>
  <input type="<?php echo $groupType ?>" name="<?php echo $inputName ?>" id="<?php echo $inputName ?>">
</div>