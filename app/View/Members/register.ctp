<h2>Member Registration</h2>

<?php
echo $this->Form->create('Member');
?>

<?php
echo $this->Form->input('name', array(
    'label' => 'Name'
));

echo $this->Form->input('email', array(
    'label' => 'Email'
));

echo $this->Form->input('phone', array(
    'label' => 'Phone'
));

echo $this->Form->input('password', array(
    'label' => 'Password'
));

echo $this->Form->input('address', array(
    'label' => 'Address'
));



echo $this->Form->end('Register');
?>