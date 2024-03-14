<label for="<?php echo $indicatorName; ?>-<?php echo $inputName; ?>-contact" class="radio-option-no-description">
  <div class="option-text">
    <h3><?php echo $inputTitle; ?></h3>
  </div>
  <input type="radio" name="radio-group-<?php echo $indicatorName; ?>-contact"
    id="<?php echo $indicatorName; ?>-<?php echo $inputName; ?>-contact" value="<?php echo $inputValue; ?>"
    <?php if ($contactValues[$indicatorName] == $inputValue && $contactValues[$indicatorName] !== null) {
                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                  } ?>
    onclick="saveAgreementValue('<?php echo $indicatorName; ?>', '<?php echo $tableName; ?>', '<?php echo $inputValue; ?>')" />
  <span class="checkmark"></span>
</label>