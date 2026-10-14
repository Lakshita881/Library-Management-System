<!-- 
<h2>Issue Book</h2>

<?php
echo $this->Form->create('BookIssue');
?>

<?php
echo $this->Form->input('member_id', array(
    'label' => 'Select Member',
    'options' => $members,
    'empty' => 'Select Member',
    'required' => true
));

echo $this->Form->input('book_id', array(
    'label' => 'Select Book',
    'options' => $books,
    'empty' => 'Select Book',
    'required' => true
));
?>

<label for="issue_date">Issue Date</label>

<?php
echo $this->Form->input('issue_date', array(
    'type' => 'date',
    'label' => false,
    'min' => date('Y-m-d'),
    'id' => 'issue_date',
    'required' => true
));
?>

<label for="due_date">Due Date</label>

<?php
echo $this->Form->input('due_date', array(
    'type' => 'date',
    'label' => false,
    'min' => date('Y-m-d'),
    'id' => 'due_date',
    'required' => true
));
?>

<?php
echo $this->Form->hidden('status', array(
    'value' => 'Issued'
));

echo $this->Form->hidden('fine', array(
    'value' => 0
));
?>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var issueDate = document.getElementById('issue_date');
    var dueDate = document.getElementById('due_date');
    var form = issueDate.closest('form');

    function getToday() {
        var today = new Date();
        var year = today.getFullYear();
        var month = String(today.getMonth() + 1).padStart(2, '0');
        var day = String(today.getDate()).padStart(2, '0');

        return year + '-' + month + '-' + day;
    }

    function updateDateRestrictions() {

        var today = getToday();

        // Issue Date cannot be before today.
        issueDate.min = today;

        // Due Date cannot be before today or Issue Date.
        dueDate.min = issueDate.value && issueDate.value > today
            ? issueDate.value
            : today;

        // Clear invalid Issue Date.
        if (issueDate.value && issueDate.value < today) {
            issueDate.value = '';
        }

        // Clear invalid Due Date.
        if (dueDate.value && dueDate.value < dueDate.min) {
            dueDate.value = '';
        }
    }

    issueDate.addEventListener('change', updateDateRestrictions);

    dueDate.addEventListener('change', function () {
        updateDateRestrictions();
    });

    form.addEventListener('submit', function (event) {

        updateDateRestrictions();

        var today = getToday();

        if (
            !issueDate.value ||
            !dueDate.value ||
            issueDate.value < today ||
            dueDate.value < today ||
            dueDate.value < issueDate.value
        ) {
            event.preventDefault();

            alert(
                'Please select valid dates. ' +
                'Issue Date cannot be in the past, and ' +
                'Due Date cannot be before Issue Date.'
            );
        }
    });

    // Apply restrictions when the page loads.
    updateDateRestrictions();

});
</script>

<?php
echo $this->Form->end('Issue Book');
?> -->



<h2>Issue Book</h2>

<?php echo $this->Session->flash(); ?>

<?php echo $this->Form->create('BookIssue'); ?>

<p>
    <strong>Book:</strong>
    <?php echo h($book['Book']['title']); ?>
</p>

<p>
    <strong>Book ID:</strong>
    <?php echo h($book['Book']['id']); ?>
</p>

<p>
    <strong>Available Quantity:</strong>
    <?php echo h($book['Book']['quantity']); ?>
</p>

<p>
    <strong>Issue Date:</strong>
    <?php echo h(date('d-m-Y', strtotime($issueDate))); ?>
</p>

<p>
    <strong>Due Date:</strong>
    <?php echo h(date('d-m-Y', strtotime($dueDate))); ?>
</p>

<?php
echo $this->Form->input('member_id', array(
    'label' => 'Select Member',
    'options' => $members,
    'empty' => 'Select Member',
    'required' => true
));
?>

<?php if ((int)$book['Book']['quantity'] > 0): ?>
    <?php echo $this->Form->end('Issue Book'); ?>
<?php else: ?>
    <p style="color: red;">
        This book is out of stock and cannot be issued.
    </p>
    <?php echo $this->Form->end(); ?>
<?php endif; ?>
