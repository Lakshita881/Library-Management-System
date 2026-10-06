<h2>Edit Member</h2>

<?php

echo $this->Form->create('Member');

echo $this->Form->input(
    'name',
    array(
        'label' => 'Name'
    )
);

echo $this->Form->input(
    'email',
    array(
        'label' => 'Email'
    )
);

echo $this->Form->input(
    'phone',
    array(
        'label' => 'Phone'
    )
);

echo $this->Form->input(
    'address',
    array(
        'label' => 'Address'
    )
);

echo $this->Form->end('Update Member');

?>