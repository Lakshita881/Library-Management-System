<h2>Login</h2>

<?php
echo $this->Form->create('Member');

echo $this->Form->input(
    'email',
    array(
        'label' => 'Email'
    )
);

echo $this->Form->input(
    'password',
    array(
        'label' => 'Password'
    )
);

echo $this->Form->end('Login');
?>