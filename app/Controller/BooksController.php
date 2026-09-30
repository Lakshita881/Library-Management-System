<?php

class BooksController extends AppController {

    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    public function index() {

        $books = $this->Book->find('all');

        $this->set('books', $books);
    }



    public function add() {
        if ($this->request->is('post')) {

            $this->Book->create();

            if ($this->Book->save($this->request->data)) {
                $this->Session->setFlash('Book has been saved.');
                return $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash('Unable to save the book.');
        }
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException('Invalid book');
        }

        $book = $this->Book->findById($id);

        if (!$book) {
            throw new NotFoundException('Book not found');
        }

        $this->set('book', $book);
    }

    // public function edit(){

    // }


    public function edit($id = null) {

    if (!$id) {
        throw new NotFoundException('Invalid book');
    }

    if (!$this->Book->exists($id)) {
        throw new NotFoundException('Book not found');
    }

    if ($this->request->is(array('post', 'put'))) {

        $this->Book->id = $id;

        if ($this->Book->save($this->request->data)) {

            $this->Session->setFlash('Book has been updated.');

            return $this->redirect(array('action' => 'index'));
        }

        $this->Session->setFlash('Unable to update the book.');

    } else {

        $this->request->data = $this->Book->findById($id);
    }
}

public function issue()
{
    $this->loadModel('BookIssue');
    $this->loadModel('Member');

    if ($this->request->is('post')) {

        $this->BookIssue->create();

        if ($this->BookIssue->save($this->request->data)) {

            $this->Session->setFlash(
                'Book has been issued successfully.'
            );

            return $this->redirect(array(
                'controller' => 'Books',
                'action' => 'index'
            ));
        }

        $this->Session->setFlash(
            'Book could not be issued.'
        );
    }

    $members = $this->Member->find('list', array(
        'fields' => array(
            'Member.id',
            'Member.name'
        )
    ));

    $books = $this->Book->find('list', array(
        'fields' => array(
            'Book.id',
            'Book.title'
        )
    ));

    $this->set(compact('members', 'books'));
}
}