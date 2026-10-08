
<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller');

class Member extends AppModel
{
    public $validate = array(

        // NAME VALIDATION


        'name' => array(

            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Name is required.'
            ),

            'validName' => array(
                'rule' => array('custom', '/^[A-Za-z]+( [A-Za-z]+)*$/'),
                'message' => 'Name must contain letters only.'
            )
        ),





        // EMAIL VALIDATION
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

        // PASSWORD VALIDATION
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

        // PHONE VALIDATION
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

        // ADDRESS VALIDATION
        'address' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Address is required.'
            )
        )
    );


    // PASSWORD HASHING
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