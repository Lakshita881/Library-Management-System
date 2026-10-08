<h2>Member Registration</h2>

<?php echo $this->Session->flash('auth'); ?>

<?php
echo $this->Form->create('Member', array(
    'novalidate' => true,
    'onsubmit' => 'return validateRegisterForm();'
));
?>

<?php
echo $this->Form->input('name', array(
    'label' => 'Name'
));
?>

<div id="nameError" class="field-error"></div>


<?php
echo $this->Form->input('email', array(
    'label' => 'Email'
));
?>

<div id="emailError" class="field-error"></div>


<?php
echo $this->Form->input('phone', array(
    'label' => 'Phone',
    'type' => 'text',
    'maxlength' => 10,
    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
));
?>

<div id="phoneError" class="field-error"></div>


<?php
echo $this->Form->input('password', array(
    'label' => 'Password'
));
?>

<div id="passwordError" class="field-error"></div>


<?php
echo $this->Form->input('address', array(
    'label' => 'Address'
));
?>

<div id="addressError" class="field-error"></div>


<?php
echo $this->Form->end('Register');
?>


<style>

.field-error {
    color: red;
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 10px;
}

</style>


<script>

function validateRegisterForm() {

    // Clear previous errors
    document.getElementById('nameError').innerHTML = '';
    document.getElementById('emailError').innerHTML = '';
    document.getElementById('phoneError').innerHTML = '';
    document.getElementById('passwordError').innerHTML = '';
    document.getElementById('addressError').innerHTML = '';

    var hasError = false;

    var name = document.getElementById('MemberName').value.trim();
    var email = document.getElementById('MemberEmail').value.trim();
    var phone = document.getElementById('MemberPhone').value.trim();
    var password = document.getElementById('MemberPassword').value.trim();
    var address = document.getElementById('MemberAddress').value.trim();


    // Name
    if (name === '') {

        document.getElementById('nameError').innerHTML =
            'Please enter your name.';

        hasError = true;

    } else if (!/^[A-Za-z]+( [A-Za-z]+)*$/.test(name)) {

        document.getElementById('nameError').innerHTML =
            'Name must contain letters only.';

        hasError = true;
    }


    // Email
    if (email === '') {

        document.getElementById('emailError').innerHTML =
            'Please enter your email.';

        hasError = true;

    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {

        document.getElementById('emailError').innerHTML =
            'Please enter a valid email address.';

        hasError = true;
    }


    // Phone
    if (phone === '') {

        document.getElementById('phoneError').innerHTML =
            'Please enter your phone number.';

        hasError = true;

    } else if (phone.length !== 10) {

        document.getElementById('phoneError').innerHTML =
            'Phone number must be exactly 10 digits.';

        hasError = true;
    }


    // Password
    if (password === '') {

        document.getElementById('passwordError').innerHTML =
            'Please enter your password.';

        hasError = true;

    } else if (password.length < 6) {

        document.getElementById('passwordError').innerHTML =
            'Password must be at least 6 characters.';

        hasError = true;
    }


    // Address
    if (address === '') {

        document.getElementById('addressError').innerHTML =
            'Please enter your address.';

        hasError = true;
    }


    // Stop form if there are errors
    if (hasError) {
        return false;
    }

    return true;
}

</script>