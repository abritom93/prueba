<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <?php Yii::app()->bootstrap->register(); ?>
        <style>
            html {
                min-height: 100%;
                position: relative;
            }
            body {
                margin: 0;
                margin-bottom: 40px;
            }
        #footer {

            background-color: black;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 40px;
            color: white;

        }
        </style>
    </head>

    <body>

    <?php $this->widget('bootstrap.widgets.TbNavbar',array(
        'collapse'=>'true',
        'type'=>'inverse',
        'brandOptions'=>array(
            'style'=>'display:none;'
        ),
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>array(
                    array('label'=>'Home', 'url'=>array('/site/index')),
                    array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                    array('label'=>'Contact', 'url'=>array('/site/contact')),
                    array('label'=>'User', 'url'=>array('/usuario/index')),
                    array('label'=>'Series', 'url'=>array('/serie/index')),
                    array('label'=>'Peliculas', 'url'=>array('/pelicula/index')),
                    array('label'=>'Login',
                        'visible'=>Yii::app()->user->isGuest,
                        'items'=>array(
                            'htmlOptions'=>array('class'=>'dropdown-toggle',
                                'template'=>'<form id="LoginForm" name="LoginForm" class="navbar-form" method="post" action="'.Yii::app()->urlManager->createUrl("/site/login").'">
                                            <span>
                                            <input type="text" id="LoginForm_username" name="LoginForm[username]" value="" class="span2" placeholder="'.Yii::t('app','Username').'">
                                            <div id="username_error" class="errorMessage hidden">'.Yii::t('app','A valid username is required').'</div>
                                            </span>
                                            <span>
                                            <input type="password" id="LoginForm_password" name="LoginForm[password]" value="" class="span2" placeholder="'.Yii::t('app','Password').'">
                                            <div id="password_error" class="errorMessage hidden">'.Yii::t('app','An empty password is not allowed').'</div>
                                            </span>
                                            <div id="divSubmit">
                                            <span>
                                            <input type="submit" class="btn btn-primary btn-small" id="btnLogin" name="btnLogin" value="Login" />
                                            <input type="button" class="btn btn-primary btn-small" id="btnRegistrar" name="btnRegistrar" value="Registrarse" data-toggle="modal", data-target="#myModal"/>
                                            </span
                                            </div>
                                            <div id="divWaitRpt" class="hidden row" align="center">
                                                <img src="'.Yii::app()->baseUrl.'/images/loading.gif">
                                            </div>
                                          </form>'
                                //Using an Ajax request, a message like the following would be used for feeding back the user in case of an authentication failure
                                /*<div class="error hidden">'.Yii::t('app','Combination of Username and Password are incorrect').'</div>*/
                            ),
                        )),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            ),
        ),
    )); ?>

    <div class="container" id="page" style="width: 95%; mar">

        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
            )); ?><!-- breadcrumbs -->
        <?php endif?>

        <?php echo $content; ?>

        <div class="clear"></div>

        <div id="footer" style="text-align: center">
            Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
            All Rights Reserved.<br/>

        </div><!-- footer -->

    </div><!-- page -->

    </body>
    </html>


