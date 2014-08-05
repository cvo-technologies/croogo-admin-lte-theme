<?php

if (empty($modelClass)) {
	$modelClass = Inflector::singularize($this->name);
}
if (!isset($className)) {
	$className = strtolower($this->name);
}
$what = isset($this->request->data[$modelClass]['id']) ? __d('croogo', 'Edit') : __d('croogo', 'Add');
?>

<?php if ($actionsBlock = $this->fetch('actions')): ?>
<div class="rod">
	<div class="col-lg-12 actions">
		<ul class="nav-buttons list-unstyled">
			<?php echo $actionsBlock; ?>
		</ul>
	</div>
</div>
<?php endif; ?>

<?php if ($contentBlock = $this->fetch('content')): ?>
	<?php echo $contentBlock; ?>
<?php else: ?>
	<?php
		$tabId = 'tabitem-' . Inflector::slug(strtolower($modelClass), '-');
		echo $this->Form->create($modelClass);
		if (isset($this->request->data[$modelClass]['id'])) {
			echo $this->Form->input('id');
		}

		$this->Form->inputDefaults(array(
			'class' => 'form-control',
			'div'   => 'form-group'
		));
	?>
	<div class="row">
		<div class="col-lg-8">
			<ul class="nav nav-tabs">
			<?php
				echo $this->Croogo->adminTab(__d('croogo', $modelClass), "#$tabId");
				echo $this->Croogo->adminTabs();
			?>
			</ul>

			<?php
				$content = '';
				foreach ($editFields as $field => $opts):
					if (is_string($opts)) {
						$field = $opts;
						$opts = array(
							'class' => 'span10',
							'label' => false,
							'tooltip' => ucfirst($field),
						);
					} else {
						$opts = Hash::merge(array('class' => 'span10'), $opts);
					}
					$content .= $this->Form->input($field, $opts);
				endforeach;
			?>

			<div class="tab-content">
			<?php
				if (!empty($content)):
					echo $this->Html->div('tab-pane', $content, array(
						'id' => $tabId,
					));
				endif;
				echo $this->Croogo->adminTabs();
			?>
			</div>
		</div>
		<div class="col-lg-4">
		<?php
			if ($buttonsBlock = $this->fetch('buttons')):
				echo $buttonsBlock;
			else :
				echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
					$this->Form->button(__d('croogo', 'Save'), array('button' => 'primary')) .
					$this->Html->link(__d('croogo', 'Cancel'), array('action' => 'index'), array('button' => 'danger')) .
					$this->Html->endBox();

			endif;
			echo $this->Croogo->adminBoxes();
		?>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>
<?php endif; ?>