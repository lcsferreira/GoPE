<div class="agreement-group" id="monitoring-system-<?php echo $inc ?>-<?php echo $type; ?>">
  <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Monitoring system
    <?php echo $inc ?>
    <span><button class="btn-delete" onclick="deleteMonitoringSystem(<?php echo $inc ?>, '<?php echo $type; ?>')"
        <?php if($_SESSION['type'] != $type){echo " disabled";} ?>><i class="fas fa-trash-alt"></i></button></span>
  </h3>
  <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
    <label for="reach-group-<?php echo $inc ?>-<?php echo $type; ?>">
      Reach
    </label>
    <div class="agreement-group" id="reach-group-<?php echo $inc ?>-<?php echo $type; ?>" style="margin: 0 !important">
      <label for="reach-pe-<?php echo $inc ?>-<?php echo $type; ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Specifically for physical education</h3>
        </div>
        <input type="radio" name="radio-group-reach-monitoring-system-<?php echo $inc ?>-<?php echo $type; ?>"
          id="reach-pe-<?php echo $inc ?>-<?php echo $type; ?>" value="1"
          onclick="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')" <?php if ($monitoringSystem["reach"] == 1 && $monitoringSystem["reach"] !== null) {
        echo "checked";
        } ?> <?php if($_SESSION['type'] != $type){echo " disabled";} ?> />
        <span class="checkmark"></span>
      </label>
      <label for="reach-school-<?php echo $inc ?>-<?php echo $type; ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>General for school</h3>
        </div>
        <input type="radio" name="radio-group-reach-monitoring-system-<?php echo $inc ?>-<?php echo $type; ?>"
          id="reach-school-<?php echo $inc ?>-<?php echo $type; ?>" value="2"
          onclick="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')" <?php if ($monitoringSystem["reach"] == 2 && $monitoringSystem["reach"] !== null) {
        echo "checked";
        } ?> <?php if($_SESSION['type'] != $type){echo " disabled";} ?> />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>

  <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
    <label for="monitoring-purpose-<?php echo $inc ?>-<?php echo $type; ?>">
      Monitoring purpose
      <br><span style="font-weight: 400; font-size:1rem; margin: 0">(More than 1 option can be selected)</span>
      <span method="monitoring_purpose"><i class="fas fa-info-circle"></i></span>
    </label>
    <div class="agreement-group" id="monitoring-purpose-<?php echo $inc ?>-<?php echo $type; ?>"
      style="margin: 0 !important">
      <label for="curriculum_implementation-<?php echo $inc ?>-<?php echo $type; ?>"
        class="radio-option-no-description">
        <div class="option-text">
          <h3>Curriculum implementation</h3>
        </div>
        <input type="checkbox" name="radio-group-monitoring-purpose"
          id="curriculum_implementation-<?php echo $inc ?>-<?php echo $type; ?>" value="curriculum_implementation"
          onclick="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')" <?php if ($monitoringSystem["curriculum_implementation"] == 1 && $monitoringSystem["curriculum_implementation"] !== null) {
        echo "checked";
      } ?> <?php if($_SESSION['type'] != $type){echo " disabled";} ?> />
        <span class="checkmark"></span>
      </label>
      <label for="pe_general_school-<?php echo $inc ?>-<?php echo $type; ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Mandatory Physical Education Delivery</h3>
        </div>
        <input type="checkbox" name="radio-group-monitoring-purpose"
          id="pe_general_school-<?php echo $inc ?>-<?php echo $type; ?>" value="pe_general_school"
          onclick="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')" <?php if ($monitoringSystem["pe_general_school"] == 1 && $monitoringSystem["pe_general_school"] !== null) {
        echo "checked";
      } ?> <?php if($_SESSION['type'] != $type){echo " disabled";} ?> />
        <span class="checkmark"></span>
      </label>
      <label for="min_time-<?php echo $inc ?>-<?php echo $type; ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Minimum time accomplished</h3>
        </div>
        <input type="checkbox" name="radio-group-monitoring-purpose"
          id="min_time-<?php echo $inc ?>-<?php echo $type; ?>" value="min_time"
          onclick="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')" <?php if ($monitoringSystem["min_time"] == 1 && $monitoringSystem["min_time"] !== null) {
        echo "checked";
      } ?> <?php if($_SESSION['type'] != $type){echo " disabled";} ?> />
        <span class="checkmark"></span>
      </label>
      <label for="other-<?php echo $inc ?>-<?php echo $type; ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Other</h3>
        </div>
        <input type="checkbox" name="radio-group-monitoring-purpose" id="other-<?php echo $inc ?>-<?php echo $type; ?>"
          value="other" onclick="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')" <?php if ($monitoringSystem["other"] == 1 && $monitoringSystem["other"] !== null) {
        echo "checked";
      } ?> <?php if($_SESSION['type'] != $type){echo " disabled";} ?> />
        <span class="checkmark"></span>
      </label>
      <?php if ($monitoringSystem["other"] == 1 && $monitoringSystem["other"] !== null) {
        echo "<input type='text' name='other_purposes' id='other_purposes-".$inc."-".$type."' value='" . $monitoringSystem["other_purposes"] . "' placeholder='which purpose(s)' onblur='saveMonitoringSystemValues(".$inc.", ".$type.")' />";
      } else{
      echo "<input type='text' name='other_purposes' id='other_purposes-".$inc."-".$type."'
        value='" . $monitoringSystem["other_purposes"] . "' placeholder='which purpose(s)' hidden
        onblur='saveMonitoringSystemValues(".$inc.", ".$type.")' />";
      }?>
    </div>
  </div>

  <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
    <label for="<?php echo $inc ?>-<?php echo $type; ?>">
      Education level to which is applied
    </label>
    <div class="agreement-group" id="education_level-<?php echo $inc ?>-<?php echo $type; ?>"
      style="margin: 0 !important">
      <label for="education_level-primary-<?php echo $inc ?>-<?php echo $type; ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Primary education</h3>
        </div>
        <input type="radio" name="radio-group-education-level-monitoring-system-<?php echo $inc ?>-<?php echo $type; ?>"
          id="education_level-primary-<?php echo $inc ?>-<?php echo $type; ?>" value="1"
          onclick="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')" <?php if ($monitoringSystem["education_level"] == 1 && $monitoringSystem["education_level"] !== null) {
        echo "checked";
        } ?> <?php if($_SESSION['type'] != $type){echo " disabled";} ?> />
        <span class="checkmark"></span>
      </label>
      <label for="education_level-secondary-<?php echo $inc ?>-<?php echo $type; ?>"
        class="radio-option-no-description">
        <div class="option-text">
          <h3>Secondary education</h3>
        </div>
        <input type="radio" name="radio-group-education-level-monitoring-system-<?php echo $inc ?>-<?php echo $type; ?>"
          id="education_level-secondary-<?php echo $inc ?>-<?php echo $type; ?>" value="2"
          onclick="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')" <?php if ($monitoringSystem["education_level"] == 2 && $monitoringSystem["education_level"] !== null) {
        echo "checked";
        } ?> <?php if($_SESSION['type'] != $type){echo " disabled";} ?> />
        <span class="checkmark"></span>
      </label>
      <label for="education_level-both-<?php echo $inc ?>-<?php echo $type; ?>" class="radio-option-no-description">
        <div class="option-text">
          <h3>Primary and Secondary education</h3>
        </div>
        <input type="radio" name="radio-group-education-level-monitoring-system-<?php echo $inc ?>-<?php echo $type; ?>"
          id="education_level-both-<?php echo $inc ?>-<?php echo $type; ?>" value="3"
          onclick="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')" <?php if ($monitoringSystem["education_level"] == 3 && $monitoringSystem["education_level"] !== null) {
        echo "checked";
        } ?> <?php if($_SESSION['type'] != $type){echo " disabled";} ?> />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>

  <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
    <label for="years_applied-<?php echo $inc ?>-<?php echo $type; ?>">
      School years to which is applied
    </label>
    <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
    <input type="text" name="years_applied" id="years_applied-<?php echo $inc ?>-<?php echo $type; ?>"
      value="<?php if($monitoringSystem["years_applied"]){ echo $monitoringSystem["years_applied"];}else{echo "";} ?>"
      onblur="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')"
      <?php if($_SESSION['type'] != $type){echo " disabled";} ?>>
  </div>

  <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
    <label for="year_publication-<?php echo $inc ?>-<?php echo $type; ?>">
      Year of publication
    </label>
    <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
    <input type="number" name="year_publication" id="year_publication-<?php echo $inc ?>-<?php echo $type; ?>"
      value="<?php if($monitoringSystem["year_publication"]){ echo $monitoringSystem["year_publication"];}else{echo "";} ?>"
      onblur="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')"
      <?php if($_SESSION['type'] != $type){echo " disabled";} ?>>
  </div>

  <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
    <label for="years_application-<?php echo $inc ?>-<?php echo $type; ?>">
      Years of application
    </label>
    <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
    <input type="text" name="years_application" id="years_application-<?php echo $inc ?>-<?php echo $type; ?>"
      value="<?php if($monitoringSystem["years_application"]){ echo $monitoringSystem["years_application"];}else{echo "";} ?>"
      onblur="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')"
      <?php if($_SESSION['type'] != $type){echo " disabled";} ?>>
  </div>

  <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
    <label for="voluntary_comments-<?php echo $inc ?>-<?php echo $type; ?>">
      Voluntary comments
    </label>
    <input type="text" name="voluntary_comments" id="voluntary_comments-<?php echo $inc ?>-<?php echo $type; ?>"
      value="<?php if($monitoringSystem["voluntary_comments"]){ echo $monitoringSystem["voluntary_comments"];}else{echo "";} ?>"
      onblur="saveMonitoringSystemValues(<?php echo $inc ?>, '<?php echo $type; ?>')"
      <?php if($_SESSION['type'] != $type){echo " disabled";} ?>>
  </div>

  <div id="monitoring-system-documents-<?php echo $inc ?>-<?php echo $type; ?>">
    <?php
    if($monitoringSystemsDocumentsAdmin != null && $type == "admin"):
      ?>
    <?php
    foreach($monitoringSystemsDocumentsAdmin as $document){
      if($document["inc"] == $inc){
        $docInc = $document["doc_inc"];
        $inc = $document["inc"];
        $docRole = $type;
        include("documentMonitoring.php");
      }
    }
    ?>
    <?php
    elseif($monitoringSystemsDocumentsContact != null && $type == "contact"):
      ?>
    <?php
    foreach($monitoringSystemsDocumentsContact as $document){
      if($document["inc"] == $inc){
        $docInc = $document["doc_inc"];
        $inc = $document["inc"];
        $docRole = $type;
        include("documentMonitoring.php");
      }
    }
    ?>
    <?php
    endif;
    ?>
  </div>

  <?php if($_SESSION['type'] == $type): ?>
  <button id="addDocument-<?php echo $inc ?>-<?php echo $type; ?>" class="btn-primary" style="width: 100% !important"
    onclick="addDocumentToMonitoringSystem(<?php echo $inc ?>, '<?php echo $type; ?>')"><strong>Add</strong> Document to
    Monitoring
    system</button>
  <?php endif; ?>
</div>