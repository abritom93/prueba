<?php
$this->breadcrumbs=array(
	'Series'=>array('index'),
	$model->id_serie,
);

$this->menu=array(
	array('label'=>'List Serie','url'=>array('index')),
	array('label'=>'Create Serie','url'=>array('create')),
	array('label'=>'Update Serie','url'=>array('update','id'=>$model->id_serie)),
	array('label'=>'Delete Serie','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_serie),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Serie','url'=>array('admin')),
);
?>

<h1>View Serie #<?php echo $model->id_serie; ?></h1>
<div class="row-fluid">

        <?php $this->widget('bootstrap.widgets.TbDetailView',array(
            'data'=>$model,
            'attributes'=>array(
                'descripcion',
                'nom_serie',
                'cant_cap',
                'precio_cap',

            ),
        )); ?>


        <img style="width: 200px; height: 200px" src="<?php echo Yii::app()->baseUrl?>/images/series/<?php echo $model->foto ?>">

</div>