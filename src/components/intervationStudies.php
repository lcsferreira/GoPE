<div class="agreement-group" id="<?php echo $inc ?>">
  <div class="indicator-input" style="margin: 0 !important">
    <label for="full_reference-<?php echo $inc ?>">
      Full reference
    </label>
    <input type="text" name="full_reference-<?php echo $inc ?>" id="full_reference-<?php echo $inc ?>"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"
      value="<?php if($intervationStudy["full_reference"]){ echo $intervationStudy["full_reference"];}else{echo "";} ?>">
  </div>
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
          <h3>Ative transport</h3>
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
    </div>
  </div>
  <button class="btn-delete" onclick="deleteStudy(<?php echo $inc ?>)"><strong>Delete</strong> Study</button>
</div>