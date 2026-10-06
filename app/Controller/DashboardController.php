<?php

App::uses('AppController', 'Controller');

class DashboardController extends AppController
{
    public $components = array('Session');

    public function index()
    {
        if (!$this->Session->check('Auth.User')) {
            return $this->redirect(
                array('controller' => 'member', 'action' => 'login')
            );
        }
    }
}