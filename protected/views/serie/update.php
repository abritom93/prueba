<?php
$this->breadcrumbs=array(
	'Series'=>array('index'),
	$model->id_serie=>array('view','id'=>$model->id_serie),
	'Update',
);

$this->menu=array(
	array('label'=>'List Serie','url'=>array('index')),
	array('label'=>'Create Serie','url'=>array('create')),
	array('label'=>'View Serie','url'=>array('view','id'=>$model->id_serie)),
	array('label'=>'Manage Serie','url'=>array('admin')),
);
?>

<h1>Update Serie <?php echo $model->id_serie; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>