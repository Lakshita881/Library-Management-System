<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller');

class Member extends AppModel
{
    public function beforeSave($options = array())
    {
        if (!empty($this->data['Member']['password'])) {
            $this->data['Member']['password'] =
                AuthComponent::password(
                    $this->data['Member']['password']
                );
        }

        return true;
    }
}