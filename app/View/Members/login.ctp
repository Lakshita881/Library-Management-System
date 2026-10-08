<!-- <h2>Login</h2>

<?php
echo $this->Form->create('Member');

echo $this->Form->input('email', array(
    'label' => 'Email'
));

echo $this->Form->input('password', array(
    'label' => 'Password'
));

// Define Your Role 
// echo $this->Form->input('role', array(
//     'label' => 'Role'
// ));

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
</p> -->

<h2>Login</h2>

<?php
echo $this->Form->create('Member', array(
    'novalidate' => true,
    'onsubmit' => 'return validateLoginForm();'
));
?>

<?php
echo $this->Form->input('email', array(
    'label' => 'Email'
));
?>

<div id="emailError" class="field-error"></div>


<?php
echo $this->Form->input('password', array(
    'label' => 'Password'
));
?>

<div id="passwordError" class="field-error"></div>


<?php
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


<style>

.field-error {
    color: red;
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 10px;
}

</style>


<script>

function validateLoginForm() {

    // Clear previous errors
    document.getElementById('emailError').innerHTML = '';
    document.getElementById('passwordError').innerHTML = '';

    var hasError = false;

    var email = document.getElementById('MemberEmail').value.trim();
    var password = document.getElementById('MemberPassword').value.trim();


    // Email validation
    if (email === '') {

        document.getElementById('emailError').innerHTML =
            'Please enter your email.';

        hasError = true;

    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {

        document.getElementById('emailError').innerHTML =
            'Please enter a valid email address.';

        hasError = true;
    }


    // Password validation
    if (password === '') {

        document.getElementById('passwordError').innerHTML =
            'Please enter your password.';

        hasError = true;
    }


    // Stop form if there are errors
    if (hasError) {
        return false;
    }

    return true;
}

</script>