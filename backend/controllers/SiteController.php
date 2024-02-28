<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\base\Security;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'create-user', 'user-list', 'update-user'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $usersCount = User::find()->where(['not', ['username' => 'admin']])->count();
        $model = new LoginForm();
        return $this->render('index', ['usersCount' => $usersCount, 'model' => $model]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login() && Yii::$app->request->post()['LoginForm']['username'] === 'admin') {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCreateUser()
    {
        if (Yii::$app->request->isPost) {
            $postRequest = Yii::$app->request->post('LoginForm');
            $model = new User();
            $model->username = $postRequest['username'];
            $model->auth_key = Yii::$app->security->generateRandomString();
            $security = new Security();
            $password = $postRequest['password'];
            $hash = $security->generatePasswordHash($password);
            $model->password_hash = $hash;
            $model->email = $postRequest['email'];
            $model->save(false);
            return $this->goBack();
        }
    }

    public function actionUserList()
    {
        $query = User::find()->where(['not', ['username' => 'admin']]);

        $email = Yii::$app->request->get('email');
        if ($email) {
            $query->andWhere(['email' => $email]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, // Display 2 users per page
            ],
        ]);

        return $this->render('userList', ['dataProvider' => $dataProvider]);
    }


    public function actionUpdateUser($id)
    {
        if (Yii::$app->request->isPost) {
            $model = User::find()->where(['id' => $id])->one();
            $model->username = Yii::$app->request->post('User')['username'];
            $model->email = Yii::$app->request->post('User')['email'];
            $model->save(false);
            return $this->redirect(['site/user-list']);
        }
    }
}
