<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller');

class Librarian extends AppModel
{
    public $name = 'Librarian';

    public function beforeSave($options = array())
    {
        if (!empty($this->data['Librarian']['password'])) {

            $this->data['Librarian']['password'] =
                AuthComponent::password(
                    $this->data['Librarian']['password']
                );
        }

        return true;
    }
}