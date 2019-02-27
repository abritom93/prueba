<?php

/**
 * This is the model class for table "serie".
 *
 * The followings are the available columns in table 'serie':
 * @property integer $id_serie
 * @property string $descripcion
 * @property string $nom_serie
 * @property integer $cant_cap
 * @property integer $precio_cap
 * @property string $foto
 * @property string $fecha
 */
class Serie extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Serie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'serie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cant_cap, precio_cap', 'numerical', 'integerOnly'=>true),
			array('foto', 'length', 'max'=>255),
			array('nom_serie', 'length', 'max'=>50),
            array('descripcion', 'safe'),
//            array('foto', 'file', 'types'=>'jpeg, gif, png, bmp,jpg'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_serie, descripcion, nom_serie, cant_cap, precio_cap, foto, fecha', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_serie' => 'Id Serie',
			'descripcion' => 'Descripción:',
			'nom_serie' => 'Nombre:',
			'cant_cap' => 'Cantidad de capítulo:',
			'precio_cap' => 'Precio de capítulo:',
			'foto' => 'Foto:',
            'fecha' => 'Fecha:',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_serie',$this->id_serie);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('nom_serie',$this->nom_serie,true);
		$criteria->compare('cant_cap',$this->cant_cap);
		$criteria->compare('precio_cap',$this->precio_cap);
		$criteria->compare('foto',$this->foto,true);
        $criteria->compare('fecha',$this->fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}