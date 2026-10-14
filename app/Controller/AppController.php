
<?php

App::uses('Controller', 'Controller');

class AppController extends Controller
{
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Member',
                    'fields' => array(
                        'username' => 'email',
                        'password' => 'password'
                    )
                )
            ),

            'loginAction' => array(
                'controller' => 'members',
                'action' => 'login'
            ),

            'loginRedirect' => array(
                'controller' => 'members',
                'action' => 'dashboard'
            ),

            'logoutRedirect' => array(
                'controller' => 'home',
                'action' => 'index'
            ),

            'authError' => 'Please login to access this page.'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function beforeRender()
    {
        parent::beforeRender();

        $this->response->header(
            'Cache-Control',
            'no-store, no-cache, must-revalidate, max-age=0'
        );

        $this->response->header('Pragma', 'no-cache');
        $this->response->header('Expires', '0');
    }



}
