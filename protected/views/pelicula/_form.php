<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pelicula-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
    <img id="uploadPreview" width="150" height="150"  src="<?php echo Yii::app()->baseUrl?>/images/no_image.png" />

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'nom_pelicula',array('class'=>'span5','maxlength'=>255)); ?>

    <label>Precio</label>

	<?php echo $form->numberField($model,'precio',array('class'=>'span2')); ?>

	<?php echo $form->textAreaRow($model,'descripcion',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?><br>

<input class="span5" maxlength="255" name="Pelicula[foto]" id="Pelicula_foto" type="file" accept="image/gif,image/bmp,image/jpeg,image/png" onchange="previewImage(1)">

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
        reader.readAsDataURL(document.getElementById('Pelicula_foto').files[0]);
        reader.onload = function (e) {
            document.getElementById('uploadPreview').src = e.target.result;
        };
    }
</script>