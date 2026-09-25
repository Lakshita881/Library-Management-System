<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Name is required'
            )
        ),
        'mobile' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Mobile number is required'
            ),
            'numeric' => array(
                'rule' => array('custom', '/^[0-9]{10}$/'),
                'message' => 'Enter a valid 10-digit mobile number'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Email is required'
            ),
            'valid' => array(
                'rule' => 'email',
                'message' => 'Enter a valid email'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'That email is already registered'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Password is required'
            ),
            /*'minLength' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password must be at least 6 characters'
            )*/
        ),
        'confirm_password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Please confirm your password'
            ),
            'compare' => array(
                'rule' => array('confirmPassword'),
                'message' => 'Passwords do not match'
            )
        )
    );

    // Custom rule: compares confirm_password to password 
    public function confirmPassword($check) {
        if ($this->data[$this->alias]['password'] !== $this->data[$this->alias]['confirm_password']) {
            return false;
        }
        return true;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    public function beforeValidate($options = array()) {
        parent::beforeValidate($options);
        return true;
    }
}