<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller');

class Member extends AppModel
{
    public $validate = array(

        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Name is required.'
            )
        ),

        'email' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Email is required.'
            ),
            'validEmail' => array(
                'rule' => 'email',
                'message' => 'Please enter a valid email address.'
            ),
            'uniqueEmail' => array(
                'rule' => 'isUnique',
                'message' => 'Email is already registered.'
            )
        ),

        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Password is required.'
            ),
            'minimumLength' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password must be at least 6 characters.'
            )
        ),

        // 'phone' => array(
        //     'required' => array(
        //         'rule' => 'notBlank',
        //         'message' => 'Phone number is required.'
        //     ),
        //     'uniquePhone' => array(
        //         'rule' => 'isUnique',
        //         'message' => 'Phone number is already registered.'
        //     )
        // ),

        'phone' => array(

            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Phone number is required.'
            ),

            'digitsOnly' => array(
                'rule' => array('custom', '/^[0-9]+$/'),
                'message' => 'Phone number must contain only digits.'
            ),

            'tenDigits' => array(
                'rule' => array('custom', '/^[0-9]{10}$/'),
                'message' => 'Phone number must be exactly 10 digits.'
            ),

            'uniquePhone' => array(
                'rule' => 'isUnique',
                'message' => 'Phone number is already registered.'
            )
        ),

        'address' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Address is required.'
            )
        )
    );


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