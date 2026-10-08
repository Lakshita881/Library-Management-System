<!-- <h2>Edit Member</h2>

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

?> -->

<h2>Edit Member</h2>

<?php

echo $this->Form->create('Member', array(
    'novalidate' => true,
    'onsubmit' => 'return validateEditMemberForm();'
));

echo $this->Form->input(
    'name',
    array(
        'label' => 'Name'
    )
);
?>

<div id="nameError" class="field-error"></div>

<?php
echo $this->Form->input(
    'email',
    array(
        'label' => 'Email'
    )
);
?>

<div id="emailError" class="field-error"></div>

<?php
echo $this->Form->input(
    'phone',
    array(
        'label' => 'Phone',
        'type' => 'text',
        'maxlength' => 10,
        'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
    )
);
?>

<div id="phoneError" class="field-error"></div>

<?php
echo $this->Form->input(
    'address',
    array(
        'label' => 'Address'
    )
);
?>

<div id="addressError" class="field-error"></div>

<?php
echo $this->Form->end('Update Member');
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

function validateEditMemberForm() {

    // Clear previous errors
    document.getElementById('nameError').innerHTML = '';
    document.getElementById('emailError').innerHTML = '';
    document.getElementById('phoneError').innerHTML = '';
    document.getElementById('addressError').innerHTML = '';

    var hasError = false;

    var name = document.getElementById('MemberName').value.trim();
    var email = document.getElementById('MemberEmail').value.trim();
    var phone = document.getElementById('MemberPhone').value.trim();
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


    // Address
    if (address === '') {

        document.getElementById('addressError').innerHTML =
            'Please enter your address.';

        hasError = true;
    }


    // Stop submission if there are errors
    if (hasError) {
        return false;
    }

    return true;
}

</script>