<div class="indicator-input" id="<?php echo $inputOrder ?>-admin">
  <label for="<?php echo $inputName ?>-admin">
    <?php echo $inputTitle ?> <span><i class="fas fa-info-circle"></i></span></label>
  <input type="<?php echo $inputType ?>" name="<?php echo $inputName ?>" id="<?php echo $inputName ?>"
    <?php if($_SESSION['type'] != "admin"){echo " disabled";} ?>>
</div>
<div class="indicator-input" id="<?php echo $inputOrder ?>-contact">
  <p class="contact-label">Provide new information here:</p>
  <label for="<?php echo $inputName ?>-contact">
    <?php echo $inputTitle ?></label>
  <input type="<?php echo $inputType ?>" name="<?php echo $inputName ?>-contact" id="<?php echo $inputName ?>-contact"
    <?php if($_SESSION['type'] != "contact"){echo " disabled";} ?>>
</div>