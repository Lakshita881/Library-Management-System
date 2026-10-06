<h2>Member Login</h2>

<?php
echo $this->Form->create('Member');

echo $this->Form->input('email', array(
    'label' => 'Email'
));

echo $this->Form->input('password', array(
    'label' => 'Password'
));

echo $this->Form->end('Login');
?>

<p>
    <?php
    echo $this->Html->link(
        'Create an account',
        array(
            'controller' => 'members',
            'action' => 'register'
        )
    );
    ?>
</p>