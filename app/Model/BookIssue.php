<?php

App::uses('AppModel', 'Model');

class BookIssue extends AppModel
{
    public $name = 'BookIssue';

    public $belongsTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id'
        ),

        'Book' => array(
            'className' => 'Book',
            'foreignKey' => 'book_id'
        )
    );
}