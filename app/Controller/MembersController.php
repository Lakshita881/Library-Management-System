<?php

class MembersController extends AppController
{
    public $helpers = array('Html', 'Form');
    public $uses = array('Member', 'BookIssue');

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('register', 'login' , 'ViewBooks');
    }

    // public function register()
    // {
    //     if ($this->request->is('post')) {

    //         $this->Member->create();

    //         if ($this->Member->save($this->request->data)) {

    //             $this->Session->setFlash(
    //                 'Registration successful. Please login.'
    //             );

    //             return $this->redirect(
    //                 array('action' => 'login')
    //             );
    //         }

    //         $this->Session->setFlash(
    //             'Registration failed. Please try again.'
    //         );
    //     }
    // }



        public function register()
    {
        if ($this->request->is('post')) {

            $email = $this->request->data['Member']['email'];

            // Check if email already exists
            $existingMember = $this->Member->find('first', array(
                'conditions' => array(
                    'Member.email' => $email
                )
            ));

            if ($existingMember) {

                $this->Session->setFlash(
                    'Email is already registered. Please use another email.',
                    'default',
                    array(),
                    'auth'
                );

            } else {

                $this->Member->create();

                if ($this->Member->save($this->request->data)) {

                    $this->Session->setFlash(
                        'Registration successful. Please login.'
                    );

                    return $this->redirect(array(
                        'action' => 'login'
                    ));
                }
            }
        }
    }

        //     public function login()
        // {
        //     if ($this->request->is('post')) {

        //         if ($this->Auth->login()) {

        //             return $this->redirect(array(
        //                 'controller' => 'Members',
        //                 'action' => 'dashboard'
        //             ));
        //         }

        //         $this->Session->setFlash(
        //             'Invalid email or password.'
        //         );
        //     }
        // }


    // public function login()
    // {
    //     if ($this->request->is('post')) {

    //         debug($this->request->data);

    //         if ($this->Auth->login()) {

    //             debug($this->Auth->user());
    //             exit;

    //         } else {

    //             debug('AUTH LOGIN FAILED');
    //             exit;
    //         }
    //     }
    // }
        // public function login()
        // {
        //     if ($this->request->is('post')) {

        //         debug($this->request->data);

        //         $member = $this->Member->find('first', array(
        //             'conditions' => array(
        //                 'Member.email' => $this->request->data['Member']['email'],
        //                 'Member.password' => AuthComponent::password(
        //                     $this->request->data['Member']['password']
        //                 )
        //             )
        //         ));

        //         debug($member);

        //         if ($this->Auth->login()) {

        //             debug($this->Auth->user());
        //             exit;

        //         } else {

        //             debug('AUTH LOGIN FAILED');
        //             exit;
        //         }
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


        public function login()
        {
            if ($this->request->is('post')) {

                if ($this->Auth->login()) {

                    return $this->redirect(array(
                        'controller' => 'Members',
                        'action' => 'dashboard'
                    ));
                }

                $this->Session->setFlash(
                    'Invalid email or password.'
                );
            }
        }


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

        public function ViewBooks()
    {
        $this->loadModel('Book');

        $books = $this->Book->find('all');

        $this->set('books', $books);
    }


        public function add()
    {
        if ($this->request->is('post')) {

            $this->Member->create();

            if ($this->Member->save($this->request->data)) {

                $this->Session->setFlash(
                    'Member added successfully.'
                );

                return $this->redirect(
                    array(
                        'controller' => 'librarians',
                        'action' => 'dashboard'
                    )
                );
            }

            $this->Session->setFlash(
                'Unable to add member.'
            );
        }
    }
    // public function index()
    // {
    //     $members = $this->Member->find(
    //         'all',
    //         array(
    //             'fields' => array(
    //                 'Member.name',
    //                 'Member.email',
    //                 'Member.phone',
    //                 'Member.address'
    //             )
    //         )
    //     );

    //     $this->set('members', $members);
    // }

    public function index()
{
    $members = $this->Member->find(
        'all',
        array(
            'fields' => array(
                'Member.id',
                'Member.name',
                'Member.email',
                'Member.phone',
                'Member.address'
            )
        )
    );

    $this->set('members', $members);
}

public function edit($id = null)
{
    if (!$id) {
        throw new NotFoundException('Invalid member');
    }

    $member = $this->Member->findById($id);

    if (!$member) {
        throw new NotFoundException('Member not found');
    }

    if ($this->request->is(array('post', 'put'))) {

        $this->Member->id = $id;

        $data = array(
            'name' => $this->request->data['Member']['name'],
            'email' => $this->request->data['Member']['email'],
            'phone' => $this->request->data['Member']['phone'],
            'address' => $this->request->data['Member']['address']
        );

        if ($this->Member->save($data)) {

            $this->Session->setFlash(
                'Member details updated successfully.'
            );

            return $this->redirect(
                array(
                    'action' => 'index'
                )
            );
        }

        $this->Session->setFlash(
            'Unable to update member.'
        );

    } else {

        $this->request->data = $member;
    }
}



}