        <?php

        class MembersController extends AppController
        {
            public $helpers = array('Html', 'Form');
            public $uses = array('Member', 'BookIssue');

            // public function beforeFilter()
            // {
            //     parent::beforeFilter();

            //     // $this->Auth->allow('register', 'login' , 'ViewBooks');
            //     $this->Auth->allow('register','login');
            // }

            public function beforeFilter()
            {
                parent::beforeFilter();

                $this->Auth->allow(
                    'register',
                    'login'
                );
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
// public function register()
// {
//     if ($this->request->is('post')) {

//         // Remove starting and ending spaces
//         $this->request->data['Member']['name'] =
//             trim($this->request->data['Member']['name']);

//         $this->request->data['Member']['email'] =
//             trim($this->request->data['Member']['email']);

//         $this->request->data['Member']['password'] =
//             trim($this->request->data['Member']['password']);

//         $this->request->data['Member']['phone'] =
//             trim($this->request->data['Member']['phone']);

//         $this->request->data['Member']['address'] =
//             trim($this->request->data['Member']['address']);


//         // Get trimmed values
//         $email = $this->request->data['Member']['email'];
//         $phone = $this->request->data['Member']['phone'];


//         // Check if email already exists
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


//         // Check if phone already exists
//         $existingMember = $this->Member->find('first', array(
//             'conditions' => array(
//                 'Member.phone' => $phone
//             )
//         ));

//         if ($existingMember) {

//             $this->Session->setFlash(
//                 'Phone number is already registered.'
//             );

//             return;
//         }


//         // Create new member
//         $this->Member->create();


//         // Save member
//         if ($this->Member->save($this->request->data)) {

//             $this->Session->setFlash(
//                 'Registration successful. Please login.'
//             );

//             return $this->redirect(array(
//                 'action' => 'login'
//             ));

//         } else {

//             $this->Session->setFlash(
//                 'Please enter correct details.'
//             );
//         }
//     }
// }


public function register()
{
    if ($this->request->is('post')) {

        // Check that Member form data was submitted
        if (
            empty($this->request->data['Member']) ||
            !is_array($this->request->data['Member'])
        ) {
            $this->Session->setFlash(
                'Registration form data was not received. Please try again.'
            );
            return;
        }

        // Get submitted values safely and trim spaces
        $data = $this->request->data['Member'];

        $name = isset($data['name']) ? trim($data['name']) : '';
        $email = isset($data['email']) ? trim($data['email']) : '';
        $password = isset($data['password']) ? trim($data['password']) : '';
        $phone = isset($data['phone']) ? trim($data['phone']) : '';
        $address = isset($data['address']) ? trim($data['address']) : '';

        // Put cleaned values back into the form data
        $this->request->data['Member']['name'] = $name;
        $this->request->data['Member']['email'] = $email;
        $this->request->data['Member']['password'] = $password;
        $this->request->data['Member']['phone'] = $phone;
        $this->request->data['Member']['address'] = $address;

        // Check required fields
        if (
            $name === '' ||
            $email === '' ||
            $password === '' ||
            $phone === '' ||
            $address === ''
        ) {
            $this->Session->setFlash(
                'Please fill in all required fields.'
            );
            return;
        }

        // Check if email already exists
        $existingMember = $this->Member->find('first', array(
            'conditions' => array(
                'Member.email' => $email
            ),
            'recursive' => -1
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
            ),
            'recursive' => -1
        ));

        if ($existingMember) {
            $this->Session->setFlash(
                'Phone number is already registered.'
            );
            return;
        }

        // Create and save the member
        $this->Member->create();

        if ($this->Member->save($this->request->data)) {

            $this->Session->setFlash(
                'Registration successful. Please login.'
            );

            return $this->redirect(array(
                'controller' => 'members',
                'action' => 'login'
            ));

        } else {
            $this->Session->setFlash(
                'Please enter correct details.'
            );
        }
    }
}


            // public function logout()
            // {
            //     return $this->redirect(
            //         $this->Auth->logout()
            //     );
            // }




        public function logout()
        {
            $this->Auth->logout();
            $this->Session->destroy();

            return $this->redirect(array(
                'controller' => 'home',
                'action' => 'index'
            ));
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


            // public function issuedBooks()
            // {
            //     $memberId = $this->Auth->user('id');

            //     if (!$memberId) {
            //         return $this->redirect(array(
            //             'controller' => 'Members',
            //             'action' => 'login'
            //         ));
            //     }

            //     $issues = $this->BookIssue->find('all', array(
            //         'conditions' => array(
            //             'BookIssue.member_id' => $memberId
            //         ),
            //         'contain' => array(
            //             'Book',
            //             'Member'
            //         )
            //     ));

            //     $this->set('issues', $issues);
            // }


        public function issuedBooks($memberId = null)
        {
            $loggedInId = $this->Auth->user('id');
            $role = $this->Auth->user('role');

            if (!$loggedInId) {
                return $this->redirect(array(
                    'controller' => 'members',
                    'action' => 'login'
                ));
            }

            // A librarian may view any member's issued books.
            // A regular member may view only their own books.
            if ($memberId !== null) {
                if ($role !== 'librarian') {
                    throw new ForbiddenException(
                        'Only librarians can view another member\'s issued books.'
                    );
                }

                if (
                    !ctype_digit((string)$memberId) ||
                    (int)$memberId <= 0 ||
                    !$this->Member->exists((int)$memberId)
                ) {
                    throw new NotFoundException('Member not found.');
                }

                $memberId = (int)$memberId;
            } else {
                $memberId = (int)$loggedInId;
            }

            $this->loadModel('Book');

            $member = $this->Member->find('first', array(
                'conditions' => array('Member.id' => $memberId),
                'recursive' => -1
            ));

            // Get only books that have not yet been returned.
            // $issues = $this->BookIssue->find('all', array(
            //     'conditions' => array(
            //         'BookIssue.member_id' => $memberId,
            //         'BookIssue.status' => 'Issued'
            //     ),
            //     'order' => array('BookIssue.due_date' => 'ASC'),
            //     'recursive' => -1
            // ));

            //Displaying the history of all the books that were issued by the user/member
            $issues = $this->BookIssue->find('all', array(
                'conditions' => array(
                    'BookIssue.member_id' => $memberId
                ),
                'order' => array('BookIssue.id' => 'DESC'),
                'recursive' => -1
            ));


            // Fetch book details without relying on model associations.
            foreach ($issues as $key => $issue) {
                $book = $this->Book->find('first', array(
                    'conditions' => array(
                        'Book.id' => $issue['BookIssue']['book_id']
                    ),
                    'fields' => array('Book.id', 'Book.title'),
                    'recursive' => -1
                ));

                $issues[$key]['Book'] = !empty($book)
                    ? $book['Book']
                    : array('title' => 'Book not found');
            }

            $this->set(compact('member', 'issues', 'memberId'));
            $this->set('isLibrarian', $role === 'librarian');
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

        // public function edit($id = null)
        // {
        //     // if (!$id) {
        //     //     throw new NotFoundException('Invalid member');
        //     // }

        //     // $member = $this->Member->findById($id);

        //     // if (!$member) {
        //     //     throw new NotFoundException('Member not found');
        //     // }
        //     if (!$id || !($member = $this->Member->findById($id))) {
        //             throw new NotFoundException('Invalid or missing member');
        //     }

        //     if ($this->request->is(array('post', 'put'))) {

        //         $this->Member->id = $id;

        //         $data = array(
        //             'name' => $this->request->data['Member']['name'],
        //             'email' => $this->request->data['Member']['email'],
        //             'phone' => $this->request->data['Member']['phone'],
        //             'address' => $this->request->data['Member']['address']
        //         );

        //         if ($this->Member->save($data)) {

        //             $this->Session->setFlash(
        //                 'Member details updated successfully.'
        //             );

        //             return $this->redirect(
        //                 array(
        //                     'action' => 'index'
        //                 )
        //             );
        //         }

        //         $this->Session->setFlash(
        //             'Unable to update member.'
        //         );

        //     } else {

        //         $this->request->data = $member;
        //     }
        // }

public function edit($id = null)
{
    // Prevent caching of the edit page.
    $this->response->header(array(
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        'Pragma' => 'no-cache',
        'Expires' => 'Thu, 01 Jan 1970 00:00:00 GMT'
    ));

    if (!$id || !($member = $this->Member->findById($id))) {
        throw new NotFoundException('Invalid or missing member');
    }

    // Redirect once if the user revisits the edit page after saving.
    $lastEditedId = $this->Session->read('Member.lastEditedId');

    if ($this->request->is('get') && (string)$lastEditedId === (string)$id) {

        $this->Session->delete('Member.lastEditedId');

        return $this->redirect(array(
            'action' => 'index'
        ));
    }

    if ($this->request->is(array('post', 'put'))) {

        if (
            !isset($this->request->data['Member']) ||
            !is_array($this->request->data['Member'])
        ) {
            $this->Session->setFlash('Invalid form submission.');

        } else {

            $submitted = $this->request->data['Member'];

            $data = array(
                'name' => isset($submitted['name']) ? trim($submitted['name']) : '',
                'email' => isset($submitted['email']) ? trim($submitted['email']) : '',
                'phone' => isset($submitted['phone']) ? trim($submitted['phone']) : '',
                'address' => isset($submitted['address']) ? trim($submitted['address']) : ''
            );

            $this->Member->id = $id;

            if ($this->Member->save($data)) {

                $this->Session->write('Member.lastEditedId', $id);

                $this->Session->setFlash(
                    'Member details updated successfully.'
                );

                return $this->redirect(array(
                    'action' => 'index'
                ));
            }

            $this->Session->setFlash(
                'Unable to update member.'
            );
        }

    } else {

        $this->request->data = $member;
    }
}


        // new merged login 

        // public function login()
        // {
        //     if ($this->request->is('post')) {

        //         // First check email and password
        //         if ($this->Auth->login()) {

        //             // Get the actual logged-in user from database
        //             $user = $this->Auth->user();

        //             // Get role entered in login form
        //             $enteredRole = $this->request->data['Member']['role'];

        //             // Compare entered role with database role
        //             if ($enteredRole !== $user['role']) {

        //                 // Wrong role
        //                 $this->Auth->logout();

        //                 $this->Session->setFlash(
        //                     'Invalid role defined.'
        //                 );

        //                 return $this->redirect(array(
        //                     'controller' => 'members',
        //                     'action' => 'login'
        //                 ));
        //             }

        //             // Correct role
        //             if ($user['role'] === 'librarian') {

        //                 return $this->redirect(array(
        //                     'controller' => 'librarians',
        //                     'action' => 'dashboard'
        //                 ));

        //             } elseif ($user['role'] === 'member') {

        //                 return $this->redirect(array(
        //                     'controller' => 'members',
        //                     'action' => 'dashboard'
        //                 ));

        //             } else {

        //                 // Unknown role
        //                 $this->Auth->logout();

        //                 $this->Session->setFlash(
        //                     'Invalid role defined.'
        //                 );

        //                 return $this->redirect(array(
        //                     'controller' => 'members',
        //                     'action' => 'login'
        //                 ));
        //             }

        //         } else {

        //             // Email or password incorrect
        //             $this->Session->setFlash(
        //                 'Invalid email or password.'
        //             );
        //         }
        //     }
        // }


        public function login()
        {
            if ($this->request->is('post')) {

                // Get email entered by user
                $email = trim($this->request->data['Member']['email']);

                // Check whether email exists in members table
                $member = $this->Member->find('first', array(
                    'conditions' => array(
                        'Member.email' => $email
                    )
                ));

                // Email does not exist
                if (!$member) {

                    $this->Session->setFlash(
                        'Email is not registered.'
                    );

                    return;
                }

                // Check email and password using CakePHP Auth
                if ($this->Auth->login()) {

                    // Get logged-in member data
                    $loggedInMember = $this->Auth->user();

                    // Check role from members table
                    if ($loggedInMember['role'] == 'librarian') {

                        // Librarian → Librarian Dashboard
                        return $this->redirect(array(
                            'controller' => 'librarians',
                            'action' => 'dashboard'
                        ));

                    } else {

                        // Normal Member → Member Dashboard
                        return $this->redirect(array(
                            'controller' => 'members',
                            'action' => 'dashboard'
                        ));
                    }

                } else {

                    // Wrong password
                    $this->Session->setFlash(
                        'Invalid email or password.'
                    );
                }
            }
        }

// Return Funcion 


public function returnBook($issueId = null)
{
    if (!$this->request->is('post')) {
        throw new MethodNotAllowedException();
    }

    // KEEP your existing librarian-only authorization check here.

    if (empty($issueId) || !is_numeric($issueId)) {
        throw new NotFoundException('Invalid issue ID.');
    }

    $issue = $this->BookIssue->find('first', array(
        'conditions' => array(
            'BookIssue.id' => (int)$issueId
        ),
        'recursive' => -1
    ));

    if (empty($issue)) {
        throw new NotFoundException('Issue record not found.');
    }

    $issueData = $issue['BookIssue'];

    // Prevent returning the same book twice.
    if ($issueData['status'] !== 'Issued') {
        $this->Session->setFlash(
            'This book has already been returned or is not currently issued.'
        );

        return $this->redirect(array(
            'action' => 'issuedBooks',
            $issueData['member_id']
        ));
    }

    // Load the Book model without changing your existing issue function.
    $this->loadModel('Book');

    $book = $this->Book->find('first', array(
        'conditions' => array(
            'Book.id' => (int)$issueData['book_id']
        ),
        'recursive' => -1
    ));

    if (empty($book)) {
        throw new NotFoundException(
            'The book linked to this issue no longer exists.'
        );
    }

    // Calculate the fine: ₹5 per day after the due date.
    $today = date('Y-m-d');
    $dueDate = $issueData['due_date'];
    $fine = 0;

    if ($today > $dueDate) {
        $due = new DateTime($dueDate);
        $currentDate = new DateTime($today);

        $lateDays = (int)$due->diff($currentDate)->format('%a');
        $fine = $lateDays * 5;
    }

    $memberId = (int)$issueData['member_id'];
    $bookId = (int)$issueData['book_id'];
    $newQuantity = (int)$book['Book']['quantity'] + 1;

    // Save the return and quantity change in one transaction.
    $dataSource = $this->BookIssue->getDataSource();
    $dataSource->begin();

    $this->BookIssue->id = (int)$issueId;

    $issueSaved = $this->BookIssue->save(array(
        'BookIssue' => array(
            'status' => 'Returned',
            'return_date' => $today,
            'fine' => $fine
        )
    ), array(
        'validate' => false,
        'callbacks' => false
    ));

    $this->Book->id = $bookId;

    $bookSaved = false;

    if ($issueSaved) {
        $bookSaved = $this->Book->saveField(
            'quantity',
            $newQuantity,
            array('validate' => false)
        );
    }

    if ($issueSaved && $bookSaved) {
        $dataSource->commit();

        $this->Session->setFlash(
            'Book returned successfully. Fine: ₹' .
            number_format($fine, 2)
        );
    } else {
        $dataSource->rollback();

        $this->Session->setFlash(
            'Could not return the book. No changes were saved.'
        );
    }

    return $this->redirect(array(
        'action' => 'issuedBooks',
        $memberId
    ));
}




        }