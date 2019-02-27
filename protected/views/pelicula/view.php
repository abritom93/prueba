<?php
$this->breadcrumbs=array(
	'Peliculas'=>array('index'),
	$model->id_pelicula,
);

$this->menu=array(
	array('label'=>'List Pelicula','url'=>array('index')),
	array('label'=>'Create Pelicula','url'=>array('create')),
	array('label'=>'Update Pelicula','url'=>array('update','id'=>$model->id_pelicula)),
	array('label'=>'Delete Pelicula','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_pelicula),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pelicula','url'=>array('admin')),
);
?>

<h1>View Pelicula #<?php echo $model->id_pelicula; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id_pelicula',
		'nom_pelicula',
		'precio',
		'descripcion',
	),
)); ?>
