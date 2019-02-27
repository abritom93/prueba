<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'serie-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
    <img id="uploadPreview" width="150" height="150"  src="<?php echo Yii::app()->baseUrl?>/images/no_image.png" />
	<?php echo $form->errorSummary($model); ?>

<?php echo $form->textAreaRow($model,'descripcion',array('rows'=>6, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'nom_serie',array('class'=>'span5','maxlength'=>50)); ?><br>

    <label>Cantidad de capítulos</label>
	<?php echo $form->numberField($model,'cant_cap',array('class'=>'span2')); ?><br>
    <label>Precio por capítulos</label>
	<?php echo $form->numberField($model,'precio_cap',array('class'=>'span2')); ?><br>


   <input class="span5" maxlength="255" name="Serie[foto]" id="Serie_foto" type="file" accept="image/gif,image/bmp,image/jpeg,image/png" onchange="previewImage(1)">

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<script>
    var previewImage= function(nb) {
        var reader = new FileReader();
        reader.readAsDataURL(document.getElementById('Serie_foto').files[0]);
        reader.onload = function (e) {
            document.getElementById('uploadPreview').src = e.target.result;
        };
    }
</script>