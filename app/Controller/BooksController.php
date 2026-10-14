<?php

class BooksController extends AppController {

    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    // public function beforeFilter() {
    // parent::beforeFilter();

    // // $this->Auth->allow('index', 'view' , 'add');
    // $this->Auth->allow('index');


public function beforeFilter()
{
    parent::beforeFilter();

    // Anyone can view the book list and book details
    $this->Auth->allow('index', 'view');

    // Only librarians can perform these operations
    $restrictedActions = array(
        'add',
        'edit',
        'issue',
        'delete',
        'index'
    );

    if (in_array($this->request->params['action'], $restrictedActions)) {

        // If not logged in, redirect to login
        if (!$this->Auth->user('id')) {
            return $this->redirect(array(
                'controller' => 'members',
                'action' => 'login'
            ));
        }

        // If logged in but not a librarian
        if ($this->Auth->user('role') !== 'librarian') {
                throw new ForbiddenException(
                    'Only liians can perform this action.'
                );
        }
    }
}


    public function index() {

        $books = $this->Book->find('all');

        $this->set('books', $books);
    }



    // public function add() {
    //     if ($this->request->is('post')) {

    //         $this->Book->create();

    //         if ($this->Book->save($this->request->data)) {
    //             $this->Session->setFlash('Book has been saved.');
    //             return $this->redirect(array('action' => 'index'));
    //         }

    //         $this->Session->setFlash('Unable to save the book.');
    //     }
    // }


public function add() {

    if ($this->request->is('post')) {

        $title = isset($this->request->data['Book']['title'])
            ? trim($this->request->data['Book']['title'])
            : '';

        // Prevent empty titles
        if ($title === '') {
            $this->Session->setFlash('Please enter the book title.');
            return;
        }

        // Find an existing book with the same title
        $existingBook = $this->Book->find('count', array(
            'conditions' => array(
                'LOWER(TRIM(Book.title))' => strtolower($title)
            ),
            'recursive' => -1
        ));

        if ($existingBook > 0) {
            $this->Session->setFlash(
                'This book already exists.'
            );
            return;
        }

        // Save only if the title does not exist
        $this->Book->create();

        if ($this->Book->save($this->request->data)) {
            $this->Session->setFlash('Book has been saved.');
            return $this->redirect(array('action' => 'index'));
        }

        $this->Session->setFlash('Unable to save the book.');
    }
}




        public function view($id = null)
        {
            $book = $this->Book->findById($id);

            if (!$book) {
                throw new NotFoundException('Book not found');
            }

            $this->set('book', $book);
        }


//     public function edit($id = null) {


//         if (!$this->Book->exists($id)) {
//         throw new NotFoundException('Book not found');
//     }

//     if ($this->request->is(array('post', 'put'))) {

//         $this->Book->id = $id;

//         if ($this->Book->save($this->request->data)) {

//             $this->Session->setFlash('Book has been updated.');

//             return $this->redirect(array('action' => 'index'));
//         }

//         $this->Session->setFlash('Unable to update the book.');

//     } else {

//         $this->request->data = $this->Book->findById($id);
//     }
// }


public function edit($id = null)
{
    // Prevent browser caching of this response.
    $this->response->header(array(
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        'Pragma' => 'no-cache',
        'Expires' => '0'
    ));

    if (!$id || !$this->Book->exists($id)) {
        throw new NotFoundException('Book not found');
    }

    // After a successful update, redirect if the same edit page
    // is requested again through a normal GET request.
    $lastEditedId = $this->Session->read('Book.lastEditedId');

    if (
        $this->request->is('get') &&
        $lastEditedId !== false &&
        (string)$lastEditedId === (string)$id
    ) {
        $this->Session->delete('Book.lastEditedId');

        return $this->redirect(array(
            'controller' => 'Books',
            'action' => 'index'
        ));
    }

    if ($this->request->is(array('post', 'put'))) {

        $this->Book->id = $id;

        if ($this->Book->save($this->request->data)) {

            // Set this flag only after a successful save.
            $this->Session->write('Book.lastEditedId', $id);

            $this->Session->setFlash(
                'Book has been updated.'
            );

            return $this->redirect(array(
                'controller' => 'Books',
                'action' => 'index'
            ));
        }

        $this->Session->setFlash(
            'Unable to update the book.'
        );

    } else {

        $this->request->data = $this->Book->findById($id);
    }
}




//Book Issue function 

        // public function issue()
        // {
        //     $this->loadModel('BookIssue');
        //     $this->loadModel('Member');

        //     if ($this->request->is('post')) {

        //         $this->BookIssue->create();

        //         if ($this->BookIssue->save($this->request->data)) {

        //             $this->Session->setFlash(
        //                 'Book has been issued successfully.'
        //             );

        //             return $this->redirect(array(
        //                 'controller' => 'Books',
        //                 'action' => 'index'
        //             ));
        //         }

        //         $this->Session->setFlash(
        //             'Book could not be issued.'
        //         );
        //     }

        //     $members = $this->Member->find('list', array(
        //         'fields' => array(
        //             'Member.id',
        //             'Member.name'
        //         )
        //     ));

        //     $books = $this->Book->find('list', array(
        //         'fields' => array(
        //             'Book.id',
        //             'Book.title'
        //         )
        //     ));

        //     $this->set(compact('members', 'books'));
        // }


            public function librarylogin()
        {
            if ($this->request->is('post')) {

                if ($this->Auth->login()) {

                    return $this->redirect(array(
                        'controller' => 'Books',
                        'action' => 'index'
                    ));
                }

                $this->Session->setFlash(
                    'Invalid email or password.'
                );
            }
        }

        public function delete($id = null) {

            if (!$id) {
                throw new NotFoundException('Invalid book');
            }

            if (!$this->Book->exists($id)) {
                throw new NotFoundException('Book not found');
            }

            if ($this->Book->delete($id)) {

                $this->Session->setFlash(
                    'Book has been deleted.'
                );

            } else {

                $this->Session->setFlash(
                    'Unable to delete the book.'
                );
            }

            return $this->redirect(array(
                'action' => 'index'
            ));
        }




// public function issue()
// {
//     $this->loadModel('BookIssue');
//     $this->loadModel('Member');

//     if ($this->request->is('post')) {

//         $issueDate = isset($this->request->data['BookIssue']['issue_date'])
//             ? $this->request->data['BookIssue']['issue_date']
//             : '';

//         $dueDate = isset($this->request->data['BookIssue']['due_date'])
//             ? $this->request->data['BookIssue']['due_date']
//             : '';

//         $today = date('Y-m-d');

//         // Validate Issue Date format and value.
//         $validIssueDate = false;

//         if (is_string($issueDate) &&
//             preg_match('/^\d{4}-\d{2}-\d{2}$/', $issueDate)) {

//             $year = (int) substr($issueDate, 0, 4);
//             $month = (int) substr($issueDate, 5, 2);
//             $day = (int) substr($issueDate, 8, 2);

//             if (checkdate($month, $day, $year) &&
//                 $issueDate >= $today) {
//                 $validIssueDate = true;
//             }
//         }

//         if (!$validIssueDate) {
//             $this->Session->setFlash(
//                 'Issue date and Due Date cannot be in the past. Please select a Valid Date.'
//             );
//         } else {

//             // Validate Due Date format and value.
//             $validDueDate = false;

//             if (is_string($dueDate) &&
//                 preg_match('/^\d{4}-\d{2}-\d{2}$/', $dueDate)) {

//                 $year = (int) substr($dueDate, 0, 4);
//                 $month = (int) substr($dueDate, 5, 2);
//                 $day = (int) substr($dueDate, 8, 2);

//                 if (checkdate($month, $day, $year) &&
//                     $dueDate >= $today &&
//                     $dueDate >= $issueDate) {
//                     $validDueDate = true;
//                 }
//             }

//             if (!$validDueDate) {
//                 $this->Session->setFlash(
//                     'Due date cannot be in the past or before the issue date.'
//                 );
//             } else {

//                 // Save only after both dates are validated.
//                 $this->BookIssue->create();

//                 if ($this->BookIssue->save($this->request->data)) {

//                     $this->Session->setFlash(
//                         'Book has been issued successfully.'
//                     );

//                     return $this->redirect(array(
//                         'controller' => 'Books',
//                         'action' => 'index'
//                     ));

//                 } else {
//                     $this->Session->setFlash(
//                         'Book could not be issued.'
//                     );
//                 }
//             }
//         }
//     }

//     $members = $this->Member->find('list', array(
//         'fields' => array(
//             'Member.id',
//             'Member.name'
//         )
//     ));

//     $books = $this->Book->find('list', array(
//         'fields' => array(
//             'Book.id',
//             'Book.title'
//         )
//     ));

//     $this->set(compact('members', 'books'));
// }


// public function issue()
// {
//     $this->loadModel('BookIssue');
//     $this->loadModel('Member');
//     $this->loadModel('Book');

//     if ($this->request->is('post')) {

//         $data = $this->request->data['BookIssue'];

//         // Convert CakePHP date dropdowns or date strings to YYYY-MM-DD.
//         $normalizeDate = function ($value) {

//             if (is_array($value)) {

//                 if (
//                     empty($value['year']) ||
//                     empty($value['month']) ||
//                     empty($value['day'])
//                 ) {
//                     return false;
//                 }

//                 $year = (int)$value['year'];
//                 $month = (int)$value['month'];
//                 $day = (int)$value['day'];

//                 if (!checkdate($month, $day, $year)) {
//                     return false;
//                 }

//                 return sprintf('%04d-%02d-%02d', $year, $month, $day);
//             }

//             if (is_string($value)) {

//                 $date = DateTime::createFromFormat('!Y-m-d', $value);

//                 if ($date && $date->format('Y-m-d') === $value) {
//                     return $value;
//                 }
//             }

//             return false;
//         };

//         $issueDate = isset($data['issue_date'])
//             ? $normalizeDate($data['issue_date'])
//             : false;

//         $dueDate = isset($data['due_date'])
//             ? $normalizeDate($data['due_date'])
//             : false;

//         $today = date('Y-m-d');

//         // Validate issue date.
//         if ($issueDate === false || $issueDate < $today) {

//             $this->Session->setFlash(
//                 'Issue date is invalid or in the past. Please select today or a future date.'
//             );

//         // Validate due date.
//         } elseif ($dueDate === false || $dueDate < $today) {

//             $this->Session->setFlash(
//                 'Due date is invalid or in the past. Please select today or a future date.'
//             );

//         // Due date cannot be earlier than issue date.
//         } elseif ($dueDate < $issueDate) {

//             $this->Session->setFlash(
//                 'Due date cannot be before the issue date.'
//             );

//         } else {

//             $bookId = isset($data['book_id'])
//                 ? (int)$data['book_id']
//                 : 0;

//             // Find the selected book.
//             $book = $this->Book->find('first', array(
//                 'conditions' => array(
//                     'Book.id' => $bookId
//                 ),
//                 'fields' => array(
//                     'Book.id',
//                     'Book.title',
//                     'Book.quantity'
//                 ),
//                 'recursive' => -1
//             ));

//             // Check whether the book exists.
//             if (empty($book)) {

//                 $this->Session->setFlash(
//                     'Selected book was not found.'
//                 );

//             // Do not issue a book whose quantity is zero.
//             } elseif ((int)$book['Book']['quantity'] <= 0) {

//                 $this->Session->setFlash(
//                     'This book is out of stock and cannot be issued.'
//                 );

//             } else {

//                 // Save normalized dates.
//                 $this->request->data['BookIssue']['issue_date'] = $issueDate;
//                 $this->request->data['BookIssue']['due_date'] = $dueDate;

//                 $this->BookIssue->create();

//                 // Save the issue record first.
//                 if ($this->BookIssue->save($this->request->data)) {

//                     // Reduce quantity by one only after a successful issue.
//                     $this->Book->id = $bookId;

//                     $updated = $this->Book->saveField(
//                         'quantity',
//                         (int)$book['Book']['quantity'] - 1
//                     );

//                     if ($updated) {

//                         $this->Session->setFlash(
//                             'Book has been issued successfully.'
//                         );

//                         return $this->redirect(array(
//                             'controller' => 'Books',
//                             'action' => 'index'
//                         ));

//                     } else {

//                         // Avoid leaving an issue record without updating stock.
//                         $this->BookIssue->delete(
//                             $this->BookIssue->id
//                         );

//                         $this->Session->setFlash(
//                             'Could not update book quantity. Please try again.'
//                         );
//                     }

//                 } else {

//                     $this->Session->setFlash(
//                         'Book could not be issued. Please check the form.'
//                     );
//                 }
//             }
//         }
//     }

//     // Populate member and book dropdowns.
//     $members = $this->Member->find('list', array(
//         'fields' => array(
//             'Member.id',
//             'Member.name'
//         )
//     ));

//     $books = $this->Book->find('list', array(
//         'fields' => array(
//             'Book.id',
//             'Book.title'
//         )
//     ));

//     $this->set(compact('members', 'books'));
// }


// public function issue($bookId = null)
// {
//     $this->loadModel('Book');
//     $this->loadModel('Member');
//     $this->loadModel('BookIssue');

//     if (
//         $bookId === null ||
//         !ctype_digit((string)$bookId) ||
//         (int)$bookId <= 0 ||
//         !$this->Book->exists((int)$bookId)
//     ) {
//         throw new NotFoundException('Invalid or missing book');
//     }

//     $bookId = (int)$bookId;

//     $book = $this->Book->find('first', array(
//         'conditions' => array('Book.id' => $bookId),
//         'recursive' => -1
//     ));

//     if (empty($book)) {
//         throw new NotFoundException('Book not found');
//     }

//     $today = date('Y-m-d');
//     $issueDate = $today;
//     $dueDate = date(
//         'Y-m-d',
//         strtotime('+15 days', strtotime($issueDate))
//     );

//     if ($this->request->is(array('post', 'put'))) {
//         $data = isset($this->request->data['BookIssue'])
//             ? $this->request->data['BookIssue']
//             : array();

//         $memberId = isset($data['member_id'])
//             ? $data['member_id']
//             : null;

//         if (
//             empty($memberId) ||
//             !ctype_digit((string)$memberId) ||
//             !$this->Member->exists((int)$memberId)
//         ) {
//             $this->Session->setFlash('Please select a valid member.');
//         } elseif ((int)$book['Book']['quantity'] <= 0) {
//             $this->Session->setFlash(
//                 'This book is out of stock and cannot be issued.'
//             );
//         } else {
//             $db = $this->Book->getDataSource();
//             $db->begin();

//             $updated = $this->Book->updateAll(
//                 array('Book.quantity' => 'Book.quantity - 1'),
//                 array(
//                     'Book.id' => $bookId,
//                     'Book.quantity >' => 0
//                 )
//             );

//             if (!$updated || $db->lastAffected() != 1) {
//                 $db->rollback();
//                 $this->Session->setFlash(
//                     'This book is out of stock and cannot be issued.'
//                 );
//             } else {
//                 $this->BookIssue->create();

//                 $issueData = array(
//                     'BookIssue' => array(
//                         'member_id' => (int)$memberId,
//                         'book_id' => $bookId,
//                         'issue_date' => $issueDate,
//                         'due_date' => $dueDate,
//                         'status' => 'Issued',
//                         'fine' => 0
//                     )
//                 );

//                 if ($this->BookIssue->save($issueData)) {
//                     $db->commit();

//                     $this->Session->setFlash(
//                         'Book issued successfully. Due date: ' .
//                         date('d-m-Y', strtotime($dueDate))
//                     );

//                     return $this->redirect(array(
//                         'controller' => 'Books',
//                         'action' => 'index'
//                     ));
//                 } else {
//                     $db->rollback();
//                     $this->Session->setFlash(
//                         'Book could not be issued. Please check the form.'
//                     );
//                 }
//             }
//         }
//     }

//     $book = $this->Book->find('first', array(
//         'conditions' => array('Book.id' => $bookId),
//         'recursive' => -1
//     ));

//     $members = $this->Member->find('list', array(
//         'fields' => array('Member.id', 'Member.name'),
//         'order' => array('Member.name' => 'ASC')
//     ));

//     $this->set(compact(
//         'book',
//         'members',
//         'issueDate',
//         'dueDate'
//     ));
// }



public function issue($bookId = null)
{
    $this->loadModel('Book');
    $this->loadModel('Member');
    $this->loadModel('BookIssue');

    // Validate book ID.
    if (
        $bookId === null ||
        !ctype_digit((string)$bookId) ||
        (int)$bookId <= 0 ||
        !$this->Book->exists((int)$bookId)
    ) {
        throw new NotFoundException('Invalid or missing book');
    }

    $bookId = (int)$bookId;

    $today = date('Y-m-d');
    $issueDate = $today;
    $dueDate = date('Y-m-d', strtotime('+15 days', strtotime($today)));

    if ($this->request->is(array('post', 'put'))) {

        $data = isset($this->request->data['BookIssue'])
            ? $this->request->data['BookIssue']
            : array();

        $memberId = isset($data['member_id'])
            ? $data['member_id']
            : '';

        // Validate member.
        if (
            !ctype_digit((string)$memberId) ||
            (int)$memberId <= 0 ||
            !$this->Member->exists((int)$memberId)
        ) {
            $this->Session->setFlash('Please select a valid member.');
        } else {

            // Check current book quantity.
            $book = $this->Book->find('first', array(
                'conditions' => array('Book.id' => $bookId),
                'fields' => array(
                    'Book.id',
                    'Book.title',
                    'Book.quantity'
                ),
                'recursive' => -1
            ));

            if (
                empty($book) ||
                (int)$book['Book']['quantity'] <= 0
            ) {
                $this->Session->setFlash(
                    'This book is out of stock and cannot be issued.'
                );
            } else {

                $db = $this->Book->getDataSource();
                $db->begin();

                // Decrease stock by exactly one, only if stock remains.
                $updated = $this->Book->updateAll(
                    array(
                        'Book.quantity' => 'Book.quantity - 1'
                    ),
                    array(
                        'Book.id' => $bookId,
                        'Book.quantity >' => 0
                    )
                );

                $affectedRows = $db->lastAffected();

                if (!$updated || $affectedRows != 1) {

                    $db->rollback();

                    $this->Session->setFlash(
                        'No available quantity. This book cannot be issued.'
                    );

                } else {

                    $this->BookIssue->create();

                    $issueData = array(
                        'BookIssue' => array(
                            'member_id' => (int)$memberId,
                            'book_id' => $bookId,
                            'issue_date' => $issueDate,
                            'due_date' => $dueDate,
                            'status' => 'Issued',
                            'fine' => 0
                        )
                    );

                    if ($this->BookIssue->save($issueData)) {

                        $db->commit();

                        $this->Session->setFlash(
                            'Book issued successfully. Due date: ' .
                            date('d-m-Y', strtotime($dueDate))
                        );

                        return $this->redirect(array(
                            'controller' => 'Books',
                            'action' => 'index'
                        ));

                    } else {

                        $db->rollback();

                        $this->Session->setFlash(
                            'Book issue failed. Quantity has not been changed.'
                        );
                    }
                }
            }
        }
    }

    // Refresh book details so the form shows current stock.
    $book = $this->Book->find('first', array(
        'conditions' => array('Book.id' => $bookId),
        'recursive' => -1
    ));

    $members = $this->Member->find('list', array(
        'fields' => array('Member.id', 'Member.name'),
        'order' => array('Member.name' => 'ASC')
    ));

    $this->set(compact(
        'book',
        'members',
        'issueDate',
        'dueDate'
    ));
}



}