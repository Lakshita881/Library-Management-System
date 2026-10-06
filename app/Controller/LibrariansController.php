<?php

class LibrariansController extends AppController
{
    public $helpers = array('Html', 'Form');

    public $uses = array('Librarian');

    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Librarian',
                    'fields' => array(
                        'username' => 'email',
                        'password' => 'password'
                    )
                )
            ),

            'loginAction' => array(
                'controller' => 'librarians',
                'action' => 'login'
            ),

            'loginRedirect' => array(
                'controller' => 'librarians',
                'action' => 'dashboard'
            ),

            'logoutRedirect' => array(
                'controller' => 'librarians',
                'action' => 'login'
            )
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();

         $this->Auth->allow('login');

        // $this->Auth->allow('login', 'createStaticLibrarians');
    }

    public function login()
    {
        if ($this->request->is('post')) {

            if ($this->Auth->login()) {

                return $this->redirect(
                    $this->Auth->redirectUrl()
                );
            }

            $this->Session->setFlash(
                'Invalid librarian email or password.'
            );
        }
    }





    public function createStaticLibrarians()
{
    $librarians = array(
        array(
            'name' => 'Librarian One',
            'email' => 'librarian1@gmail.com',
            'password' => 'library123'
        ),
        array(
            'name' => 'Librarian Two',
            'email' => 'librarian2@gmail.com',
            'password' => 'library456'
        ),
        array(
            'name' => 'Librarian Three',
            'email' => 'librarian3@gmail.com',
            'password' => 'library789'
        )
    );

    foreach ($librarians as $data) {

        $this->Librarian->create();

        if ($this->Librarian->save($data)) {
            echo $data['email'] . ' created successfully.<br>';
        } else {
            echo $data['email'] . ' failed.<br>';
        }
    }

    exit;
}

    public function dashboard()
    {
    }

    public function logout()
    {
        $this->Auth->logout();

        return $this->redirect(
            array(
                'controller' => 'librarians',
                'action' => 'login'
            )
        );
    }
}