<div id="document-<?php echo $docInc; ?>-<?php echo $docRole; ?>">
  <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Document
    <?php echo $docInc ?>
    <span><button class="btn-delete"
        onclick="deleteDocumentFromMonitoringSystem(<?php echo $docInc ?>, '<?php echo $type; ?>', <?php echo $inc; ?>)"
        <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>><i class="fas fa-trash-alt"></i></button></span>
  </h3>
  <div class="indicator-input">
    <label for="document-title-<?php echo $docInc; ?>-<?php echo $docRole; ?>">Document title</label>
    <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
    <textarea name="document-title-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      id="document-title-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      onblur="saveDocumentValue('document-title-<?php echo $docInc; ?>-<?php echo $docRole; ?>', '<?php echo $tableName; ?>', '<?php echo $inc; ?>')"
      <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>><?php echo $document["title"] ?></textarea>
  </div>

  <div class="indicator-input">
    <label for="document-eletronic_source-<?php echo $docInc; ?>-<?php echo $docRole; ?>">Eletronic source</label>
    <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
    <textarea name="document-eletronic_source-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      id="document-eletronic_source-<?php echo $docInc; ?>-<?php echo $docRole; ?>"
      onblur="saveDocumentValue('document-eletronic_source-<?php echo $docInc; ?>-<?php echo $docRole; ?>', '<?php echo $tableName; ?>', '<?php echo $inc; ?>')"
      <?php if($_SESSION['type'] != $docRole){echo " disabled";} ?>><?php echo $document["eletronic_source"] ?></textarea>
  </div>

</div>