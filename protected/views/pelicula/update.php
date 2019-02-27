<?php
$this->breadcrumbs=array(
	'Peliculas'=>array('index'),
	$model->id_pelicula=>array('view','id'=>$model->id_pelicula),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pelicula','url'=>array('index')),
	array('label'=>'Create Pelicula','url'=>array('create')),
	array('label'=>'View Pelicula','url'=>array('view','id'=>$model->id_pelicula)),
	array('label'=>'Manage Pelicula','url'=>array('admin')),
);
?>

<h1>Update Pelicula <?php echo $model->id_pelicula; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>