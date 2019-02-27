<div class="view">
<div class="row-fluid">
    <div class="span3">
        <b><?php echo CHtml::encode($data->getAttributeLabel('id_serie')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->id_serie),array('view','id'=>$data->id_serie)); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
        <?php echo CHtml::encode($data->descripcion); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('nom_serie')); ?>:</b>
        <?php echo CHtml::encode($data->nom_serie); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('cant_cap')); ?>:</b>
        <?php echo CHtml::encode($data->cant_cap); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('precio_cap')); ?>:</b>
        <?php echo CHtml::encode($data->precio_cap); ?>
        <br />
    </div>

    <div class="span6">
        <img style="width: 100px; height: 100px;" src="<?php echo Yii::app()->baseUrl?>/images/series/<?php echo  CHtml::encode($data->foto); ?>">
    </div>

</div><br>
    <br>
</div>