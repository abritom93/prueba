<?php

class SerieController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view',''),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GetAllSeriesJson','GetByIDJson','AddSerie','LoadData','LoadMoreData','BuscarPorNombreSerie','LoadMoreDataBuscarPorNombre','LoadDataSeries','DeleteSerie'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Serie;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Serie']))
		{

			$model->attributes=$_POST['Serie'];

            $uploadedFile= CUploadedFile::getInstance($model,'foto');
            $rnd = rand(0,9999);
            $fileName = "{$rnd}-{$uploadedFile}";
            $uploadedFile->saveAs(Yii::app()->basePath.'/../images/series/'.$fileName);
            $model->foto=$fileName;
            $model->fecha=new CDbExpression('NOW()');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_serie));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Serie']))
		{
			$model->attributes=$_POST['Serie'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_serie));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Serie');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Serie('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Serie']))
			$model->attributes=$_GET['Serie'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Serie::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='serie-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    //Obtener el detalle dado una serie
    public function actionGetByIDJson(){

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            if (isset($_GET['idSerie'])) {

                // Obtener parámetro idMeta
                $parametro = $_GET['idSerie'];

                // Tratar retorno
                $retorno = Yii::app()->db->createCommand("call USP_getById ($parametro)")->queryRow();


                if ($retorno) {

                    $meta["estado"] = "1";
                    $meta["serie"] = $retorno;
                    // Enviar objeto json de la meta
                    print json_encode($meta);
                } else {
                    // Enviar respuesta de error general
                    print json_encode(
                        array(
                            'estado' => '2',
                            'mensaje' => 'No se obtuvo el registro'
                        )
                    );
                }

            }
            else {
                // Enviar respuesta de error
                print json_encode(
                    array(
                        'estado' => '3',
                        'mensaje' => 'Se necesita un identificador'
                    )
                );
            }
        }
    }


    //Insertar nueva serie
    public function actionAddSerie(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Decodificando formato Json
            $body = json_decode(file_get_contents("php://input"), true);

            // Insertar meta
            $model= new Serie;
            $model->nom_serie=$body['nomSerie'];
            $model->cant_cap=(int)$body['cantCap'];
            $model->precio_cap=(int)$body['precioCap'];
            $model->descripcion=$body['descripcion'];

            $imagen=$body['foto'];
            $data = base64_decode($imagen);
//
//        // Proporciona una locación a la nueva imagen (con el nombre y formato especifico)
            $filepath = Yii::app()->basePath.'/../images/series/'.$body['nomSerie'].'.jpeg'; // or image.jpg
//
//        // Finalmente guarda la imágen en el directorio especificado y con la informacion dada
            file_put_contents($filepath, $data);
            $model->foto=$body['nomSerie'].'.jpeg';
            $model->fecha=new CDbExpression('NOW()');

            if ($model->save()) {
                // Código de éxito
                print json_encode(
                    array(
                        'estado' => '1',
                        'mensaje' => 'Creación exitosa')
                );
            }
            else {
                // Código de falla
                print json_encode(
                    array(
                        'estado' => '2',
                        'mensaje' => 'Creación fallida')
                );
            }
        }
    }


    public function actionLoadData(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['limite'])) {
                // Obtener parámetro idMeta
                $limit = $_GET['limite'];
                $lista =  Yii::app()->db->createCommand("call USP_loadData($limit)")->queryAll();
                if($lista){
                    $meta["estado"] = 1;
                    $meta["series"] = $lista;
                    echo json_encode($meta);
                }
                else{
                    $meta["estado"] = 2;
                    $meta["mensaje"] = "No hay series que mostrar";
                    echo json_encode($meta);
                }
            }
        }
    }

    public function actionLoadMoreData(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['limite']) && isset($_GET['lastID'])) {
                // Obtener parámetro idMeta
                $limit = (int)$_GET['limite'];
                $lastId= (int)$_GET['lastID'];
                $lista = Yii::app()->db->createCommand("call USP_loadMoreData($lastId,$limit)")->queryAll();

                if($lista){
                    $meta["estado"] = 1;
                    $meta["series"] = $lista;
                    echo json_encode($meta);
                }
                else{
                    $meta["estado"] = 2;
                    $meta["mensaje"] = "No hay más series que mostrar";
                    echo json_encode($meta);
                }
            }
        }
    }

    public function actionBuscarPorNombreSerie(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['query']) && isset($_GET['limite'])) {
                $query = $_GET['query'];
                $limite = (int)$_GET['limite'];
                $lista = Yii::app()->db->createCommand("call buscarSerie('$query',$limite)")->queryAll();
                if($lista){
                    $meta["estado"] = 1;
                    $meta["series"] = $lista;
                    echo json_encode($meta);
                }
                else{
                    $meta["estado"] = 2;
                    $meta["mensaje"] = "No hay series con este nombre";
                    echo json_encode($meta);
                }
            }
        }
    }

    public function actionLoadMoreDataBuscarPorNombre(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['limite']) && isset($_GET['lastID']) && isset($_GET['query']) ) {
                // Obtener parámetro idMeta
                $limit = (int)$_GET['limite'];
                $lastId= (int)$_GET['lastID'];
                $query= $_GET['query'];

                $lista = Yii::app()->db->createCommand("call USP_loadMoreDataBuscarPorNombre($lastId,$limit,'$query')")->queryAll();

                if($lista){
                    $meta["estado"] = 1;
                    $meta["series"] = $lista;
                    echo json_encode($meta);
                }
                else{
                    $meta["estado"] = 2;
                    $meta["mensaje"] = "No hay más series con este nombre";
                    echo json_encode($meta);
                }
            }
        }
    }

    //Obtener las ultimas 10 series
    public function actionLoadDataSeries(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['limite'])) {
                // Obtener parámetro idMeta
                $limit = $_GET['limite'];
                $lista =  Yii::app()->db->createCommand("call USP_loadDataSerieMain($limit)")->queryAll();
                if($lista){
                    $meta["estado"] = 1;
                    $meta["series"] = $lista;
                    echo json_encode($meta);
                }
                else{
                    $meta["estado"] = 2;
                    $meta["mensaje"] = "No hay series que mostrar";
                    echo json_encode($meta);
                }
            }
        }
    }

    //Eliminar serie dado id
    public function actionDeleteSerie(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['idSerie'])) {
                // Obtener parámetro idMeta
                $id=$_GET['idSerie'];
                $model= $this->loadModel($id);

                if ($model->delete()) {
                    // Código de éxito
                    print json_encode(
                        array(
                            'estado' => '1',
                            'mensaje' => 'Eliminación exitosa')
                    );
                }
                else {
                    // Código de falla
                    print json_encode(
                        array(
                            'estado' => '2',
                            'mensaje' => 'Eliminación fallida')
                    );
                }
            }
        }
    }



}
