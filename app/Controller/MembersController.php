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


            //New Changed Register function
        // public function register()
        // {
        //     if ($this->request->is('post')) {
        //         $name = trim($this->request->data['Member']['name']);
        //         $email = trim($this->request->data['Member']['email']);
        //         $password = trim($this->request->data['Member']['password']);
        //         $phone = trim($this->request->data['Member']['phone']);
        //         $address = trim($this->request->data['Member']['address']);

        //         // Check email
        //         if (empty($email)) {

        //             $this->Session->setFlash(
        //                 'Email is required.'
        //             );

        //             return;
        //         }

        //         // Check password
        //         if (empty($password)) {

        //             $this->Session->setFlash(
        //                 'Password is required.'
        //             );

        //             return;
        //         }

        //         // Check duplicate email
        //         $existingMember = $this->Member->find('first', array(
        //             'conditions' => array(
        //                 'Member.email' => $email
        //             )
        //         ));

        //         if ($existingMember) {

        //             $this->Session->setFlash(
        //                 'Email is already registered. Please use another email.'
        //             );

        //             return;
        //         }

        //         // Check duplicate phone 
        //         $existingMember = $this->Member->find('first', array(
        //             'conditions' => array(
        //                 'Member.phone' => $phone
        //             )
        //         ));

        //         if ($existingMember) {

        //             $this->Session->setFlash(
        //                 'Phone No Already Registered'
        //             );

        //             return;
        //         }

        //         // Create new member
        //         $this->Member->create();

        //         if ($this->Member->save($this->request->data)) {

        //             $this->Session->setFlash(
        //                 'Registration successful. Please login.'
        //             );

        //             return $this->redirect(array(
        //                 'action' => 'login'
        //             ));

        //         } else {

        //             $this->Session->setFlash(
        //                 'Please fill valid details.'
        //             );
        //         }
        //     }
        // }
public function register()
{
    if ($this->request->is('post')) {

        // Remove starting and ending spaces
        $this->request->data['Member']['name'] =
            trim($this->request->data['Member']['name']);

        $this->request->data['Member']['email'] =
            trim($this->request->data['Member']['email']);

        $this->request->data['Member']['password'] =
            trim($this->request->data['Member']['password']);

        $this->request->data['Member']['phone'] =
            trim($this->request->data['Member']['phone']);

        $this->request->data['Member']['address'] =
            trim($this->request->data['Member']['address']);


        // Get trimmed values
        $email = $this->request->data['Member']['email'];
        $phone = $this->request->data['Member']['phone'];


        // Check if email already exists
        $existingMember = $this->Member->find('first', array(
            'conditions' => array(
                'Member.email' => $email
            )
        ));

        if ($existingMember) {

            $this->Session->setFlash(
                'Email is already registered. Please use another email.'
            );

            return;
        }


        // Check if phone already exists
        $existingMember = $this->Member->find('first', array(
            'conditions' => array(
                'Member.phone' => $phone
            )
        ));

        if ($existingMember) {

            $this->Session->setFlash(
                'Phone number is already registered.'
            );

            return;
        }


        // Create new member
        $this->Member->create();


        // Save member
        if ($this->Member->save($this->request->data)) {

            $this->Session->setFlash(
                'Registration successful. Please login.'
            );

            return $this->redirect(array(
                'action' => 'login'
            ));

        } else {

            $this->Session->setFlash(
                'Please enter correct details.'
            );
        }
    }
}


            public function logout()
            {
                return $this->redirect(
                    $this->Auth->logout()
                );
            }

            public function dashboard(){

            }



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
            // if (!$id) {
            //     throw new NotFoundException('Invalid member');
            // }

            // $member = $this->Member->findById($id);

            // if (!$member) {
            //     throw new NotFoundException('Member not found');
            // }
            if (!$id || !($member = $this->Member->findById($id))) {
                    throw new NotFoundException('Invalid or missing member');
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

        // new merged login 

        public function login()
        {
            if ($this->request->is('post')) {

                // First check email and password
                if ($this->Auth->login()) {

                    // Get the actual logged-in user from database
                    $user = $this->Auth->user();

                    // Get role entered in login form
                    $enteredRole = $this->request->data['Member']['role'];

                    // Compare entered role with database role
                    if ($enteredRole !== $user['role']) {

                        // Wrong role
                        $this->Auth->logout();

                        $this->Session->setFlash(
                            'Invalid role defined.'
                        );

                        return $this->redirect(array(
                            'controller' => 'members',
                            'action' => 'login'
                        ));
                    }

                    // Correct role
                    if ($user['role'] === 'librarian') {

                        return $this->redirect(array(
                            'controller' => 'librarians',
                            'action' => 'dashboard'
                        ));

                    } elseif ($user['role'] === 'member') {

                        return $this->redirect(array(
                            'controller' => 'members',
                            'action' => 'dashboard'
                        ));

                    } else {

                        // Unknown role
                        $this->Auth->logout();

                        $this->Session->setFlash(
                            'Invalid role defined.'
                        );

                        return $this->redirect(array(
                            'controller' => 'members',
                            'action' => 'login'
                        ));
                    }

                } else {

                    // Email or password incorrect
                    $this->Session->setFlash(
                        'Invalid email or password.'
                    );
                }
            }
        }



        }