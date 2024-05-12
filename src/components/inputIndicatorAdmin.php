<label for="<?php echo $inputName ?>-admin">
  <?php echo $inputTitle ?> <span method="<?php echo $inputName ?>"><i class="fas fa-info-circle"></i></span></label>
<input type="<?php echo $inputType ?>" name="<?php echo $inputName ?>-admin" id="<?php echo $inputName ?>-admin"
  onblur="saveAdminValue('<?php echo $inputName ?>', '<?php echo $tableName ?>')"
  value="<?php if($adminValues[$inputName]){ echo $adminValues[$inputName];}else{echo "";} ?>"
  <?php if($_SESSION['type'] == "contact"){echo " disabled";} ?>>