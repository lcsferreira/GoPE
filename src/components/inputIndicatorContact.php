<label for="<?php echo $inputName ?>-contact">
  <?php echo $inputTitle ?> <span method="<?php echo $inputName ?>"><i class="fas fa-info-circle"></i></span></label>
<input type="<?php echo $inputType ?>" name="<?php echo $inputName ?>-contact" id="<?php echo $inputName ?>-contact"
  onblur="saveContactValue('<?php echo $inputName ?>', '<?php echo $tableName ?>')"
  value="<?php if($contactValues[$inputName]){ echo $contactValues[$inputName];}else{echo "";} ?>"
  <?php if($_SESSION['type'] == 'admin'){echo " disabled";} ?>>