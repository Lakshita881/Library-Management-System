<?php

class MembersController extends AppController
{
    public $helpers = array('Html', 'Form');
    public $uses = array('Member', 'BookIssue');

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('register', 'login');
    }

    public function register()
    {
        if ($this->request->is('post')) {

            $this->Member->create();

            if ($this->Member->save($this->request->data)) {

                $this->Session->setFlash(
                    'Registration successful. Please login.'
                );

                return $this->redirect(
                    array('action' => 'login')
                );
            }

            $this->Session->setFlash(
                'Registration failed. Please try again.'
            );
        }
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
                'Invalid email or password.'
            );
        }
    }




//     public function login()
// {
//     if ($this->request->is('post')) {

//         debug($this->request->data);

//         if ($this->Auth->login()) {

//             debug($this->Auth->user());
//             die;
//         }

//         debug('Login failed');
//         die;
//     }
// }

    public function logout()
    {
        return $this->redirect(
            $this->Auth->logout()
        );
    }

    public function dashboard(){

    }

    // public function profile(){
        
    // }

    public function profile()
    {
        $memberId = $this->Auth->user('id');

        if (!$memberId) {
            return $this->redirect(array(
                'controller' => 'Members',
                'action' => 'login'
            ));
        }

        $member = $this->Member->find('first', array(
            'conditions' => array(
                'Member.id' => $memberId
            )
        ));

        $this->set('member', $member);
    }

//     public function profile()
// {
//     debug($this->Auth->user());
//     die;
// }

    public function issuedBooks()
    {
        $memberId = $this->Auth->user('id');

        if (!$memberId) {
            return $this->redirect(array(
                'controller' => 'Members',
                'action' => 'login'
            ));
        }

        $issues = $this->BookIssue->find('all', array(
            'conditions' => array(
                'BookIssue.member_id' => $memberId
            ),
            'contain' => array(
                'Book',
                'Member'
            )
        ));

        $this->set('issues', $issues);
    }

    // public function view_books(){

    // }

        public function view_Books()
    {
        $this->loadModel('Book');

        $books = $this->Book->find('all');

        $this->set('books', $books);
    }


}