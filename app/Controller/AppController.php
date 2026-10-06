
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
            )
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
    }
}

