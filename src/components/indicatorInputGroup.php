<div class="indicator-input" id="<?php echo $indicatorOrder ?>-<?php echo $indicatorRole ?>">
  <?php 
		foreach ($inputs as $input){
			if( $indicatorRole == 'admin' ){
				$inputName = $input->name;
				$inputTitle = $input->title;
				$inputType = $input->type;
				$tableName = $input->tableName;
				include '../../components/inputIndicatorAdmin.php';
			} else if( $indicatorRole == 'contact' ){
				$inputName = $input->name;
				$inputTitle = $input->title;
				$inputType = $input->type;
				$tableName = $input->tableName;
				include '../../components/inputIndicatorContact.php';
			}
		}
	?>
</div>