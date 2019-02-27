<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pelicula')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_pelicula),array('view','id'=>$data->id_pelicula)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nom_pelicula')); ?>:</b>
	<?php echo CHtml::encode($data->nom_pelicula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precio')); ?>:</b>
	<?php echo CHtml::encode($data->precio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />


</div>