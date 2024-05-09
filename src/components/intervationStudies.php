<div class="agreement-group" id="<?php echo $inc ?>">
  <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Intervation study
    <?php echo $inc ?>
  </h3>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="<?php echo $inc ?>">
      PE and school-based PA domains
      <br><span style="font-weight: 400; font-size:1rem; margin: 0">(More than 1 option can be selected)</span>
    </label>
    <div class="agreement-group" id="<?php echo $inc ?>" style="margin: 0 !important">
      <label for="pe-<?php echo $inc ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Physical Education</h3>
        </div>
        <input type="checkbox" name="radio-group-intervation-studies" id="pe-<?php echo $inc ?>" value="pe"
          onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" <?php if ($intervationStudy["pe"] == 1 && $intervationStudy["pe"] !== null) {
        echo "checked";
      } ?> />
        <span class="checkmark"></span>
      </label>
      <label for="atp-<?php echo $inc ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Active transport</h3>
        </div>
        <input type="checkbox" name="radio-group-intervation-studies" id="atp-<?php echo $inc ?>" value="atp"
          onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" <?php if ($intervationStudy["atp"] == 1 && $intervationStudy["atp"] !== null) {
        echo "checked";
      } ?> />
        <span class="checkmark"></span>
      </label>
      <label for="ac-<?php echo $inc ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Active classes/breaks</h3>
        </div>
        <input type="checkbox" name="radio-group-intervation-studies" id="ac-<?php echo $inc ?>" value="ac"
          onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" <?php if ($intervationStudy["ac"] == 1 && $intervationStudy["ac"] !== null) {
        echo "checked";
      } ?> />
        <span class="checkmark"></span>
      </label>
      <label for="ar-<?php echo $inc ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Active recess</h3>
        </div>
        <input type="checkbox" name="radio-group-intervation-studies" id="ar-<?php echo $inc ?>" value="ar"
          onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" <?php if ($intervationStudy["ar"] == 1 && $intervationStudy["ar"] !== null) {
        echo "checked";
      } ?> />
        <span class="checkmark"></span>
      </label>
      <label for="e_pa-<?php echo $inc ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Extracurricular physical activity</h3>
        </div>
        <input type="checkbox" name="radio-group-intervation-studies" id="e_pa-<?php echo $inc ?>" value="e_pa"
          onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" <?php if ($intervationStudy["e_pa"] == 1 && $intervationStudy["e_pa"] !== null) {
        echo "checked";
      } ?> />
        <span class="checkmark"></span>
      </label>
      <label for="other-<?php echo $inc ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Other</h3>
        </div>
        <input type="checkbox" name="radio-group-intervation-studies" id="other-<?php echo $inc ?>" value="other"
          onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" <?php if ($intervationStudy["other"] == 1 && $intervationStudy["other"] !== null) {
        echo "checked";
      } ?> />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class=" indicator-input"
    style="margin: 0 !important; <?php if ($intervationStudy["other"] == 0){echo "display: none";}?>"
    id="other-domain-container-<?php echo $inc ?>">
    <label for="other-domain-<?php echo $inc ?>">
      Other domain
    </label>
    <textarea name="other-domain-<?php echo $inc ?>" id="other-domain-<?php echo $inc ?>" cols="30" rows="2"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"><?php if($intervationStudy["other_domain"]){ echo $intervationStudy["other_domain"];}else{echo "";} ?></textarea>


  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="title-<?php echo $inc ?>">
      Title
    </label>
    <textarea name="title-<?php echo $inc ?>" id="title-<?php echo $inc ?>" cols="30" rows="2"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"><?php if($intervationStudy["title"]){ echo $intervationStudy["title"];}else{echo "";} ?></textarea>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="year-<?php echo $inc ?>">
      Year
    </label>
    <input type="text" name="year-<?php echo $inc ?>" id="year-<?php echo $inc ?>"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"
      value="<?php if($intervationStudy["year"]){ echo $intervationStudy["year"];}else{echo "";} ?>">
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="eletronic-source-<?php echo $inc ?>">
      Eletronic source
    </label>
    <textarea name="eletronic-source-<?php echo $inc ?>" id="eletronic-source-<?php echo $inc ?>" cols="30" rows="2"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"><?php if($intervationStudy["eletronic_source"]){ echo $intervationStudy["eletronic_source"];}else{echo "";} ?></textarea>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="apa7th_reference-<?php echo $inc ?>">
      APA 7th reference
    </label>
    <textarea name="apa7th_reference-<?php echo $inc ?>" id="apa7th_reference-<?php echo $inc ?>" cols="30" rows="2"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"><?php if($intervationStudy["apa7th_reference"]){ echo $intervationStudy["apa7th_reference"];}else{echo "";} ?></textarea>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="inclusion-criteria-<?php echo $inc ?>">
      Inclusion criteria
    </label>
    <textarea name="inclusion-criteria-<?php echo $inc ?>" id="inclusion-criteria-<?php echo $inc ?>" cols="30" rows="4"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"><?php if($intervationStudy["inclusion_criteria"]){ echo $intervationStudy["inclusion_criteria"];}else{echo "";} ?></textarea>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="exclusion-criteria-<?php echo $inc ?>">
      Exclusion criteria
    </label>
    <textarea name="exclusion-criteria-<?php echo $inc ?>" id="exclusion-criteria-<?php echo $inc ?>" cols="30" rows="4"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"><?php if($intervationStudy["exclusion_criteria"]){ echo $intervationStudy["exclusion_criteria"];}else{echo "";} ?></textarea>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="main-outcomes-<?php echo $inc ?>">
      Main outcomes
    </label>
    <textarea name="main-outcomes-<?php echo $inc ?>" id="main-outcomes-<?php echo $inc ?>" cols="30" rows="4"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"><?php if($intervationStudy["main_outcomes"]){ echo $intervationStudy["main_outcomes"];}else{echo "";} ?></textarea>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="min-age-samples-<?php echo $inc ?>">
      Minimum age of the sample
    </label>
    <input type="text" name="min-age-samples-<?php echo $inc ?>" id="min-age-samples-<?php echo $inc ?>"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"
      value="<?php if($intervationStudy["min_age_sample"]){ echo $intervationStudy["min_age_sample"];}else{echo "";} ?>">
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="avg-age-samples-<?php echo $inc ?>">
      Average age of the sample
    </label>
    <input type="text" name="avg-age-samples-<?php echo $inc ?>" id="avg-age-samples-<?php echo $inc ?>"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"
      value="<?php if($intervationStudy["avg_age_sample"]){ echo $intervationStudy["avg_age_sample"];}else{echo "";} ?>">
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="max-age-samples-<?php echo $inc ?>">
      Maximum age of the sample
    </label>
    <input type="text" name="max-age-samples-<?php echo $inc ?>" id="max-age-samples-<?php echo $inc ?>"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"
      value="<?php if($intervationStudy["max_age_sample"]){ echo $intervationStudy["max_age_sample"];}else{echo "";} ?>">
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="period-data-collection-<?php echo $inc ?>">
      Period of data collection
    </label>
    <input type="text" name="period-data-collection-<?php echo $inc ?>" id="period-data-collection-<?php echo $inc ?>"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"
      value="<?php if($intervationStudy["period_data_collect"]){ echo $intervationStudy["period_data_collect"];}else{echo "";} ?>">
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="not_was_lockdown-<?php echo $inc ?>">
      Do you confirm that your country was not in a lockdown status due to the covid 19 pandemic when the data
      collection took place?
    </label>
    <div class="switch-field" id="not_was_lockdown-<?php echo $inc ?>">
      <input type="radio" id="not_was_lockdown-<?php echo $inc ?>-yes" name="not_was_lockdown-<?php echo $inc ?>"
        value="yes" <?php if ($intervationStudy["not_was_lockdown"] == 1 && $intervationStudy["not_was_lockdown"] !== null) {
        echo "checked";
      } ?> onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="not_was_lockdown-<?php echo $inc ?>-yes">Yes</label>
      <input type="radio" id="not_was_lockdown-<?php echo $inc ?>-no" name="not_was_lockdown-<?php echo $inc ?>"
        value="no" <?php if ($intervationStudy["not_was_lockdown"] == 0 && $intervationStudy["not_was_lockdown"] !== null) {
        echo "checked";
      } ?> onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="not_was_lockdown-<?php echo $inc ?>-no">No</label>

    </div>
    <button class="btn-delete" onclick="deleteStudy(<?php echo $inc ?>)"><strong>Delete</strong> Study</button>
  </div>
</div>