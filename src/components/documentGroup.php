<div id="document-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>">
  <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Document
    <?php echo $docInc ?>
    <span><button class="btn-delete"
        onclick="deleteDocumentFromIndicator(<?php echo $docInc ?>, '<?php echo $tableName; ?>', '<?php echo $docRole; ?>', '<?php echo $indicatorName; ?>')"
        <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>><i class="fas fa-trash-alt"></i></button></span>
  </h3>
  <div class="indicator-input">
    <label for="document-title-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>">Document
      title</label>
    <input type="text"
      name="document-title-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      id="document-title-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      value="<?php echo $document["title"] ?>"
      onblur="saveDocumentValue('document-title-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>', '<?php echo $tableName; ?>', '<?php echo $docInc ?>')"
      <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>>
  </div>

  <div class="indicator-input">
    <label
      for="document-year_publication-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>">Year
      of publication</label>
    <input type="number"
      name="document-year_publication-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      id="document-year_publication-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      value="<?php echo $document["year_publication"] ?>"
      onblur="saveDocumentValue('document-year_publication-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>', '<?php echo $tableName; ?>', '<?php echo $docInc ?>')"
      <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>>
  </div>

  <div class="indicator-input">
    <label
      for="document-eletronic_source-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>">Eletronic
      source</label>
    <input type="text"
      name="document-eletronic_source-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      id="document-eletronic_source-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      value="<?php echo $document["eletronic_source"] ?>"
      onblur="saveDocumentValue('document-eletronic_source-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>', '<?php echo $tableName; ?>', '<?php echo $docInc ?>')"
      <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>>
  </div>

  <div class="indicator-input">
    <label
      for="document-voluntary_comments-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>">Voluntary
      comments</label>
    <textarea
      name="document-voluntary_comments-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      id="document-voluntary_comments-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      onblur="saveDocumentValue('document-voluntary_comments-<?php echo $indicatorName; ?>-<?php echo $docInc; ?>-<?php echo $docRole; ?>', '<?php echo $tableName; ?>', '<?php echo $docInc ?>')"
      <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>><?php echo $document["voluntary_comments"] ?></textarea>
  </div>

</div>