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
    'label' => 'ISBN'
));
?>

<div id="isbnError" class="field-error"></div>


<?php
echo $this->Form->input('quantity', array(
    'label' => 'Quantity',
    'type' => 'number',
    'min' => 1
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

    // Clear previous errors
    document.getElementById('titleError').innerHTML = '';
    document.getElementById('authorError').innerHTML = '';
    document.getElementById('categoryError').innerHTML = '';
    document.getElementById('isbnError').innerHTML = '';
    document.getElementById('quantityError').innerHTML = '';

    var hasError = false;

    var title = document.getElementById('BookTitle').value.trim();
    var author = document.getElementById('BookAuthor').value.trim();
    var category = document.getElementById('BookCategory').value.trim();
    var isbn = document.getElementById('BookIsbn').value.trim();
    var quantity = document.getElementById('BookQuantity').value.trim();


    // Title
    if (title === '') {
        document.getElementById('titleError').innerHTML =
            'Please enter the book title.';
        hasError = true;
    }


    // Author
    if (author === '') {
        document.getElementById('authorError').innerHTML =
            'Please enter the author.';
        hasError = true;
    }


    // Category
    if (category === '') {
        document.getElementById('categoryError').innerHTML =
            'Please enter the category.';
        hasError = true;
    }


    // ISBN
    if (isbn === '') {
        document.getElementById('isbnError').innerHTML =
            'Please enter the ISBN.';
        hasError = true;
    }


    // Quantity
    if (quantity === '') {

        document.getElementById('quantityError').innerHTML =
            'Please enter the quantity.';

        hasError = true;

    } else if (parseInt(quantity) < 1) {

        document.getElementById('quantityError').innerHTML =
            'Quantity must be at least 1.';

        hasError = true;
    }


    // Stop form if there are errors
    if (hasError) {
        return false;
    }

    return true;
}

</script>