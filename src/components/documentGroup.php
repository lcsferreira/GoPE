<?php
if($id !== 0){
  $id = $id;
}else{
	  $id = "1";
}
?>
<div id="<?php echo $id ?>-<?php echo $userType ?>" class="input-document-indicator">
  <?php
  if ($userType == 'contact') :
  ?>
  <p class="contact-label">Provide new information here:</p>
  <?php
  endif;
  ?>
  <div class="indicator-input">
    <label for="<?php echo $id ?>-document-<?php echo $userType ?>">Document
      title</label>
    <input type="text" name="<?php echo $id ?>-title-<?php echo $userType ?>"
      id="<?php echo $id ?>-title-<?php echo $userType ?>" value="<?php echo $documentTilte ?>"
      onblur="saveDocumentValue('<?php echo $id; ?>-title-<?php echo $userType ?>', '<?php echo $tableName; ?>')">
  </div>
  <div class="indicator-input">
    <label for="<?php echo $id ?>-year_publication-<?php echo $userType ?>">Year of
      publication</label>
    <input type="text" name="<?php echo $id ?>-year_publication-<?php echo $userType ?>"
      id="<?php echo $id ?>-year-publication-<?php echo $userType ?>" value="<?php echo $yearPublication ?>"
      onblur="saveDocumentValue('<?php echo $id; ?>-year_publication-<?php echo $userType ?>', '<?php echo $tableName; ?>')">
  </div>
  <div class="indicator-input">
    <label for="<?php echo $id ?>-eletronic-source-<?php echo $userType ?>">Eletronic
      Source</label>
    <input type="text" name="<?php echo $id ?>-eletronic-source-<?php echo $userType ?>"
      id="<?php echo $id ?>-eletronic-source-<?php echo $userType ?>" value="<?php echo $eletronicSource ?>"
      onblur="saveDocumentValue('<?php echo $id; ?>-eletronic-source-<?php echo $userType ?>', '<?php echo $tableName; ?>')">
  </div>
  <div class="indicator-input">
    <label for="<?php echo $id ?>-voluntary-comments-<?php echo $userType ?>">Voluntary
      comments</label>
    <textarea name="<?php echo $id ?>-voluntary-comments-<?php echo $userType ?>"
      id="<?php echo $id ?>-voluntary-comments-<?php echo $userType ?>" cols="20" rows="5"
      onblur="saveDocumentValue('<?php echo $id; ?>-voluntary-comments-<?php echo $userType ?>', '<?php echo $tableName; ?>')"><?php echo $voluntaryComment ?></textarea>
  </div>
</div>