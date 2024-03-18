<div id="document-<?php echo $docInc; ?>-<?php echo $docRole; ?>">
  <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Document
    <?php echo $docInc ?>
    <span><button class="btn-delete"
        onclick="deleteDocumentFromMonitoringSystem(<?php echo $docInc ?>, '<?php echo $type; ?>', <?php echo $inc; ?>)"
        <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>><i class="fas fa-trash-alt"></i></button></span>
  </h3>
  <div class="indicator-input">
    <label for="document-title-<?php echo $docInc; ?>-<?php echo $docRole; ?>">Document title</label>
    <input type="text" name="document-title-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      id="document-title-<?php echo $docInc; ?>-<?php echo $docRole; ?>" value="<?php echo $document["title"] ?>"
      onblur="saveDocumentValue('document-title-<?php echo $docInc; ?>-<?php echo $docRole; ?>', '<?php echo $tableName; ?>', '<?php echo $inc; ?>')"
      <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>>
  </div>

  <div class="indicator-input">
    <label for="document-eletronic_source-<?php echo $docInc; ?>-<?php echo $docRole; ?>">Eletronic source</label>
    <input type="text" name="document-eletronic_source-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      id="document-eletronic_source-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      value="<?php echo $document["eletronic_source"] ?>"
      onblur="saveDocumentValue('document-eletronic_source-<?php echo $docInc; ?>-<?php echo $docRole; ?>', '<?php echo $tableName; ?>', '<?php echo $inc; ?>')"
      <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>>
  </div>

</div>