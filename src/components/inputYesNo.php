<div class="switch-field" id="<?php echo $indicatorOrder ?>-<?php echo $indicatorRole ?>">
  <input type="radio" id="<?php echo $indicatorName; ?>-yes-<?php echo $indicatorRole ?>"
    name="<?php echo $inputName ?>-<?php echo $indicatorRole ?>" value="yes" <?php if ($indicatorRole == 'admin') : ?>
    onclick="saveAdminValue('<?php echo $indicatorName; ?>', '<?php echo $tableName ?>')"
    <?php if($adminValues[$indicatorName] == 1) : ?> checked <?php endif; ?> <?php else: ?>
    onclick="saveContactValue('<?php echo $indicatorName; ?>', '<?php echo $tableName ?>')"
    <?php if($contactValues[$indicatorName] == 1) : ?> checked <?php endif; ?> <?php endif; ?>
    <?php if($_SESSION['type'] != $indicatorRole){echo " disabled";} ?> />
  <label for="<?php echo $indicatorName; ?>-yes-<?php echo $indicatorRole ?>">Yes</label>
  <input type="radio" id="<?php echo $indicatorName; ?>-no-<?php echo $indicatorRole ?>"
    name="<?php echo $inputName ?>-<?php echo $indicatorRole ?>" value="no" <?php if ($indicatorRole == 'admin') : ?>
    onclick="saveAdminValue('<?php echo $indicatorName; ?>', '<?php echo $tableName ?>')"
    <?php if($adminValues[$indicatorName] == 0) : ?> checked <?php endif; ?> <?php else: ?>
    onclick="saveContactValue('<?php echo $indicatorName; ?>', '<?php echo $tableName ?>')"
    <?php if($contactValues[$indicatorName] == 0) : ?> checked <?php endif; ?> <?php endif; ?>
    <?php if($_SESSION['type'] != $indicatorRole){echo " disabled";} ?> />
  <label for="<?php echo $indicatorName; ?>-no-<?php echo $indicatorRole ?>">No</label>
</div>