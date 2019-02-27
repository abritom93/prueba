<?php
$this->breadcrumbs=array(
	'Peliculas',
);

$this->menu=array(
	array('label'=>'Create Pelicula','url'=>array('create')),
	array('label'=>'Manage Pelicula','url'=>array('admin')),
);
?>

<h1>Peliculas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
