<div class="indicator-comments">
  <button class="btn-hide-comment"
    onclick="hideComment('<?php echo $indicatorOrder; ?>-comments')"><strong>Hide</strong>
    Comments</button>
  <div id="<?php echo $indicatorOrder; ?>-comments" style="display: flex; flex-direction: column; gap: 1rem;">
    <label for="<?php echo $indicatorName; ?>-comments">If any adjustment is needed, provide additional comments
      here: </label>
    <textarea name="<?php echo $indicatorName; ?>-comments" id="<?php echo $indicatorName; ?>-comments" cols="20"
      rows="5"
      onblur="saveComment('<?php echo $indicatorName; ?>', '<?php echo $tableName; ?>')"><?php if ($commentValues[$indicatorName]) {
                                                                                                                                                                                                                echo $commentValues[$indicatorName];
                                                                                                                                                                                                              } else {
                                                                                                                                                                                                                echo "";
                                                                                                                                                                                                              }; ?></textarea>
  </div>
</div>