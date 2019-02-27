<?php
$this->breadcrumbs=array(
	'Series',
);

$this->menu=array(
	array('label'=>'Create Serie','url'=>array('create')),
	array('label'=>'Manage Serie','url'=>array('admin')),
);
?>

<h1>Series</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
