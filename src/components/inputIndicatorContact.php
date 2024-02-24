<label for="<?php echo $inputName ?>-contact">
  <?php echo $inputTitle ?></label>
<input type="<?php echo $inputType ?>" name="<?php echo $inputName ?>-contact" id="<?php echo $inputName ?>-contact"
  onblur="saveContactValue('<?php echo $inputName ?>', '<?php echo $tableName ?>')"
  value="<?php if($contactValues[$inputName]){ echo $contactValues[$inputName];}else{echo "";} ?>">