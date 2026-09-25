<?php

class MembersController extends AppController {

    public $helpers = array('Html', 'Form');

    public $components = array('Session');


    public function index() {

        $members = $this->Member->find('all');

        $this->set('members', $members);
    }


    public function add() {

        if ($this->request->is('post')) {

            $this->Member->create();

            if ($this->Member->save($this->request->data)) {

                $this->Session->setFlash(
                    'Member has been saved.'
                );

                return $this->redirect(
                    array('action' => 'index')
                );
            }

            $this->Session->setFlash(
                'Unable to save the member.'
            );
        }
    }


    public function view($id = null) {

        if (!$id) {
            throw new NotFoundException('Invalid member');
        }

        $member = $this->Member->findById($id);

        if (!$member) {
            throw new NotFoundException('Member not found');
        }

        $this->set('member', $member);
    }


    public function edit($id = null) {

        if (!$id) {
            throw new NotFoundException('Invalid member');
        }

        if (!$this->Member->exists($id)) {
            throw new NotFoundException('Member not found');
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Member->id = $id;

            if ($this->Member->save($this->request->data)) {

                $this->Session->setFlash(
                    'Member has been updated.'
                );

                return $this->redirect(
                    array('action' => 'index')
                );
            }

            $this->Session->setFlash(
                'Unable to update the member.'
            );

        } else {

            $this->request->data =
                $this->Member->findById($id);
        }
    }
}