<div class="agreement-group" id="<?php echo $inc ?>">
  <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Intervention study
    <?php echo $inc ?>
  </h3>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="title-<?php echo $inc ?>">
      Title
    </label>
    <textarea name="title-<?php echo $inc ?>" id="title-<?php echo $inc ?>" cols="30" rows="2"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"><?php if ($intervationStudy["title"]) {
                                                                                                                                                            echo $intervationStudy["title"];
                                                                                                                                                          } else {
                                                                                                                                                            echo "";
                                                                                                                                                          } ?></textarea>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="year-<?php echo $inc ?>">
      Year
    </label>
    <input type="text" name="year-<?php echo $inc ?>" id="year-<?php echo $inc ?>"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"
      value="<?php if ($intervationStudy["year"]) {
                                                                                                                                                      echo $intervationStudy["year"];
                                                                                                                                                    } else {
                                                                                                                                                      echo "";
                                                                                                                                                    } ?>">
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="authors-<?php echo $inc ?>">
      Authors
    </label>
    <textarea name="authors-<?php echo $inc ?>" id="authors-<?php echo $inc ?>" cols="30" rows="2"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"><?php if ($intervationStudy["authors"]) {
                                                                                                                                                                echo $intervationStudy["authors"];
                                                                                                                                                              } else {
                                                                                                                                                                echo "";
                                                                                                                                                              } ?></textarea>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="eletronic-source-<?php echo $inc ?>">
      Eletronic source
    </label>
    <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
    <textarea name="eletronic-source-<?php echo $inc ?>" id="eletronic-source-<?php echo $inc ?>" cols="30" rows="2"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"><?php if ($intervationStudy["eletronic_source"]) {
                                                                                                                                                                                  echo $intervationStudy["eletronic_source"];
                                                                                                                                                                                } else {
                                                                                                                                                                                  echo "";
                                                                                                                                                                                } ?></textarea>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="is_pop_study_comp-<?php echo $inc ?>">
      Is the population of the study composed of children aged 5 to 10 years old and/or adolescents aged 11 to 17 years
      old attending school (for different age limits, the mean age needs to fall within these gaps)?
    </label>
    <!-- <input type="text" name="period-data-collection-<?php echo $inc ?>" id="period-data-collection-<?php echo $inc ?>"
      onblur="saveIntervationStudiesValues(<?php echo $inc ?>)"
      value="<?php if ($intervationStudy["is_pop_study_comp"]) {
                echo $intervationStudy["is_pop_study_comp"];
              } else {
                echo "";
              } ?>"> -->
    <div class="switch-field" id="is_pop_study_comp-<?php echo $inc ?>">
      <input type="radio" id="is_pop_study_comp-<?php echo $inc ?>-yes" name="is_pop_study_comp-<?php echo $inc ?>"
        value="yes"
        <?php if ($intervationStudy["is_pop_study_comp"] == 1 && $intervationStudy["is_pop_study_comp"] !== null) {
                                                                                                                                  echo "checked";
                                                                                                                                } ?>
        onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="is_pop_study_comp-<?php echo $inc ?>-yes">Yes</label>
      <input type="radio" id="is_pop_study_comp-<?php echo $inc ?>-no" name="is_pop_study_comp-<?php echo $inc ?>"
        value="no"
        <?php if ($intervationStudy["is_pop_study_comp"] == 0 && $intervationStudy["is_pop_study_comp"] !== null) {
                                                                                                                                echo "checked";
                                                                                                                              } ?>
        onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="is_pop_study_comp-<?php echo $inc ?>-no">No</label>
    </div>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="is_main_outcome-<?php echo $inc ?>">
      Is physical activity (i.e., MVPA, VPA, meeting the PA recommendations) the main outcome of the study?
    </label>
    <div class="switch-field" id="is_main_outcome-<?php echo $inc ?>">
      <input type="radio" id="is_main_outcome-<?php echo $inc ?>-yes" name="is_main_outcome-<?php echo $inc ?>"
        value="yes"
        <?php if ($intervationStudy["is_main_outcome"] == 1 && $intervationStudy["is_main_outcome"] !== null) {
                                                                                                                              echo "checked";
                                                                                                                            } ?>
        onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="is_main_outcome-<?php echo $inc ?>-yes">Yes</label>
      <input type="radio" id="is_main_outcome-<?php echo $inc ?>-no" name="is_main_outcome-<?php echo $inc ?>"
        value="no"
        <?php if ($intervationStudy["is_main_outcome"] == 0 && $intervationStudy["is_main_outcome"] !== null) {
                                                                                                                            echo "checked";
                                                                                                                          } ?>
        onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="is_main_outcome-<?php echo $inc ?>-no">No</label>


    </div>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="is_study_intervention-<?php echo $inc ?>">
      Is the study an intervention (a type of study in which an intervention is applied to a group of people in a
      specific context to verify its impact on an outcome of interest)
    </label>
    <div class="switch-field" id="is_study_intervention-<?php echo $inc ?>">
      <input type="radio" id="is_study_intervention-<?php echo $inc ?>-yes"
        name="is_study_intervention-<?php echo $inc ?>" value="yes"
        <?php if ($intervationStudy["is_study_intervention"] == 1 && $intervationStudy["is_study_intervention"] !== null) {
                                                                                                                                            echo "checked";
                                                                                                                                          } ?>
        onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="is_study_intervention-<?php echo $inc ?>-yes">Yes</label>
      <input type="radio" id="is_study_intervention-<?php echo $inc ?>-no"
        name="is_study_intervention-<?php echo $inc ?>" value="no"
        <?php if ($intervationStudy["is_study_intervention"] == 0 && $intervationStudy["is_study_intervention"] !== null) {
                                                                                                                                          echo "checked";
                                                                                                                                        } ?>
        onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="is_study_intervention-<?php echo $inc ?>-no">No</label>


    </div>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="is_prim_school_set-<?php echo $inc ?>">
      Is the study primarily conducted within the school setting?
    </label>
    <div class="switch-field" id="is_prim_school_set-<?php echo $inc ?>">
      <input type="radio" id="is_prim_school_set-<?php echo $inc ?>-yes" name="is_prim_school_set-<?php echo $inc ?>"
        value="yes"
        <?php if ($intervationStudy["is_prim_school_set"] == 1 && $intervationStudy["is_prim_school_set"] !== null) {
                                                                                                                                        echo "checked";
                                                                                                                                      } ?>
        onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="is_prim_school_set-<?php echo $inc ?>-yes">Yes</label>
      <input type="radio" id="is_prim_school_set-<?php echo $inc ?>-no" name="is_prim_school_set-<?php echo $inc ?>"
        value="no"
        <?php if ($intervationStudy["is_prim_school_set"] == 0 && $intervationStudy["is_prim_school_set"] !== null) {
                                                                                                                                      echo "checked";
                                                                                                                                    } ?>
        onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="is_prim_school_set-<?php echo $inc ?>-no">No</label>


    </div>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="is_published_peer-<?php echo $inc ?>">
      Is the study published in a peer-reviewed journal?
    </label>
    <div class="switch-field" id="is_published_peer-<?php echo $inc ?>">
      <input type="radio" id="is_published_peer-<?php echo $inc ?>-yes" name="is_published_peer-<?php echo $inc ?>"
        value="yes"
        <?php if ($intervationStudy["is_published_peer"] == 1 && $intervationStudy["is_published_peer"] !== null) {
                                                                                                                                        echo "checked";
                                                                                                                                      } ?>
        onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="is_published_peer-<?php echo $inc ?>-yes">Yes</label>
      <input type="radio" id="is_published_peer-<?php echo $inc ?>-no" name="is_published_peer-<?php echo $inc ?>"
        value="no"
        <?php if ($intervationStudy["is_published_peer"] == 0 && $intervationStudy["is_published_peer"] !== null) {
                                                                                                                                      echo "checked";
                                                                                                                                    } ?>
        onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="is_published_peer-<?php echo $inc ?>-no">No</label>


    </div>
  </div>
  <div class=" indicator-input" style="margin: 0 !important">
    <label for="was_collected-<?php echo $inc ?>">
      Was the data of the study collected until December 2019 or after January 2021?
    </label>
    <div class="switch-field" id="was_collected-<?php echo $inc ?>">
      <input type="radio" id="was_collected-<?php echo $inc ?>-yes" name="was_collected-<?php echo $inc ?>" value="yes"
        <?php if ($intervationStudy["was_collected"] == 1 && $intervationStudy["was_collected"] !== null) {
                                                                                                                                  echo "checked";
                                                                                                                                } ?> onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="was_collected-<?php echo $inc ?>-yes">Yes</label>
      <input type="radio" id="was_collected-<?php echo $inc ?>-no" name="was_collected-<?php echo $inc ?>" value="no"
        <?php if ($intervationStudy["was_collected"] == 0 && $intervationStudy["was_collected"] !== null) {
                                                                                                                                echo "checked";
                                                                                                                              } ?> onclick="saveIntervationStudiesValues(<?php echo $inc ?>)" />
      <label for="was_collected-<?php echo $inc ?>-no">No</label>

    </div>
  </div>

  <button class="btn-delete" onclick="deleteStudy(<?php echo $inc ?>)"><strong>Delete</strong> Study</button>
</div>