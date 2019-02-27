<?php
$this->breadcrumbs=array(
	'Series'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Serie','url'=>array('index')),
	array('label'=>'Manage Serie','url'=>array('admin')),
);
?>

<h1>Create Serie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>