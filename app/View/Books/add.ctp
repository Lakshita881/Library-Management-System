<h2>Add Book</h2>

<?php
echo $this->Form->create('Book', array(
    'novalidate' => true,
    'onsubmit' => 'return validateBookForm();'
));
?>

<?php
echo $this->Form->input('title', array(
    'label' => 'Title'
));
?>
<div id="titleError" class="field-error"></div>

<?php
echo $this->Form->input('author', array(
    'label' => 'Author'
));
?>
<div id="authorError" class="field-error"></div>

<?php
echo $this->Form->input('category', array(
    'label' => 'Category'
));
?>
<div id="categoryError" class="field-error"></div>

<?php
echo $this->Form->input('isbn', array(
    'label' => 'ISBN',
    'type' => 'text',
    'inputmode' => 'numeric'
));
?>
<div id="isbnError" class="field-error"></div>

<?php
echo $this->Form->input('quantity', array(
    'label' => 'Quantity (1–100)',
    'type' => 'number',
    'min' => 1,
    'max' => 100,
    'step' => 1,
    'onkeydown' => "return !['e','E','+','-','.'].includes(event.key)"
));
?>
<div id="quantityError" class="field-error"></div>

<?php
echo $this->Form->end('Add Book');
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
function validateBookForm() {

    var fields = [
        'titleError',
        'authorError',
        'categoryError',
        'isbnError',
        'quantityError'
    ];

    fields.forEach(function(id) {
        document.getElementById(id).textContent = '';
    });

    var hasError = false;

    var title = document.getElementById('BookTitle').value.trim();
    var author = document.getElementById('BookAuthor').value.trim();
    var category = document.getElementById('BookCategory').value.trim();
    var isbn = document.getElementById('BookIsbn').value.trim();
    var quantity = document.getElementById('BookQuantity').value.trim();

    // Title validation
    if (title === '') {
        document.getElementById('titleError').textContent =
            'Please enter the book title.';
        hasError = true;
    }

    // Author validation: letters and spaces only
    if (author === '') {
        document.getElementById('authorError').textContent =
            'Please enter the author.';
        hasError = true;
    } else if (!/^[A-Za-z ]+$/.test(author)) {
        document.getElementById('authorError').textContent =
            'Author must contain only letters and spaces.';
        hasError = true;
    }

    // Category validation: letters and spaces only
    if (category === '') {
        document.getElementById('categoryError').textContent =
            'Please enter the category.';
        hasError = true;
    } else if (!/^[A-Za-z ]+$/.test(category)) {
        document.getElementById('categoryError').textContent =
            'Category must contain only letters and spaces.';
        hasError = true;
    }

    // ISBN validation: digits only
    if (isbn === '') {
        document.getElementById('isbnError').textContent =
            'Please enter the ISBN.';
        hasError = true;
    } else if (!/^[0-9]+$/.test(isbn)) {
        document.getElementById('isbnError').textContent =
            'ISBN must contain numbers only.';
        hasError = true;
    }

    // Quantity validation: positive whole numbers up to 100
    if (quantity === '') {
        document.getElementById('quantityError').textContent =
            'Please enter the quantity.';
        hasError = true;

    } else if (
        !/^[0-9]+$/.test(quantity) ||
        !Number.isSafeInteger(Number(quantity)) ||
        Number(quantity) < 1
    ) {
        document.getElementById('quantityError').textContent =
            'Quantity must be a whole number greater than 0.';
        hasError = true;

    } else if (Number(quantity) > 100) {
        document.getElementById('quantityError').textContent =
            'Quantity cannot be above the maximum limit of 100.';
        hasError = true;
    }

    return !hasError;
}

document.addEventListener('DOMContentLoaded', function() {

    var author = document.getElementById('BookAuthor');
    var category = document.getElementById('BookCategory');
    var isbn = document.getElementById('BookIsbn');
    var quantity = document.getElementById('BookQuantity');

    // Author: letters and spaces only
    author.addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-z ]/g, '');
    });

    // Category: letters and spaces only
    category.addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-z ]/g, '');
    });

    // ISBN: digits only
    isbn.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Quantity: remove invalid characters but do not cap the value
    quantity.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');

        var error = document.getElementById('quantityError');

        if (this.value !== '' && Number(this.value) > 100) {
            error.textContent =
                'Quantity cannot be above the maximum limit of 100.';
        } else {
            error.textContent = '';
        }
    });

});
</script>