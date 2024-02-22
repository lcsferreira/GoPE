<div id="agreement-group-<?php echo $agreementOrder; ?>" class="agreement-group">
  <label for="correct-<?php echo $agreementOrder; ?>" class="radio-option">
    <div class="option-text">
      <h3>Correct</h3>
      <p>
        The information provided is <strong>correct</strong> and
        <strong>up to date</strong> and should be included on the new 2024
        Country Card.
      </p>
    </div>
    <input type="radio" name="radioGroup" id="correct-<?php echo $agreementOrder; ?>" value="1" <?php if ($agreementValues[$inputName] == 1 && $agreementValues[$inputName] != null) {
                                                                                                  echo "checked";
                                                                                                } ?>
      onclick="saveAgreementValue('<?php echo $agreementOrder; ?>', '<?php echo $inputName; ?>', '<?php echo $tableName; ?>', '1')" />
    <span class="checkmark"></span>
  </label>

  <label for="correct-provide-<?php echo $agreementOrder; ?>" class="radio-option">
    <div class="option-text">
      <h3>Correct, but provide new information</h3>
      <p>
        The information provided is <strong>correct</strong> and
        <strong>up to date</strong> and should be included on the new 2024
        Country Card. Furthermore, I
        <strong>wish to provide</strong> additional information that
        should also be included in the new Country Card 2024.
      </p>
    </div>
    <input type="radio" name="radioGroup" id="correct-provide-<?php echo $agreementOrder; ?>" value="2" <?php if ($agreementValues[$inputName] == 2 && $agreementValues[$inputName] != null) {
                                                                                                          echo "checked";
                                                                                                        } ?>
      onclick="saveAgreementValue('<?php echo $agreementOrder; ?>', '<?php echo $inputName; ?>', '<?php echo $tableName; ?>', '2')" />
    <span class="checkmark"></span>
  </label>

  <label for="out-of-date-<?php echo $agreementOrder; ?>" class="radio-option">
    <div class="option-text">
      <h3>Out of date</h3>
      <p>
        The information provided is <strong>out of date</strong> and
        should <strong>not be included</strong> in the new Country Card
        2024. Therefore, I <strong>wish to provide</strong> the
        <strong>updated information</strong> that should be included in
        the new Country Card 2024.
      </p>
    </div>
    <input type="radio" name="radioGroup" id="out-of-date-<?php echo $agreementOrder; ?>" value="3" <?php if ($agreementValues[$inputName] == 3 && $agreementValues[$inputName] != null) {
                                                                                                      echo "checked";
                                                                                                    } ?>
      onclick="saveAgreementValue('<?php echo $agreementOrder; ?>', '<?php echo $inputName; ?>', '<?php echo $tableName; ?>', '3')" />
    <span class="checkmark"></span>
  </label>
</div>