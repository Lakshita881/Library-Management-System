<h2>Issue Book</h2>

<?php
echo $this->Form->create('BookIssue');
?>

<?php
echo $this->Form->input('member_id', array(
    'label' => 'Select Member',
    'options' => $members,
    'empty' => 'Select Member'
));
?>

<?php
echo $this->Form->input('book_id', array(
    'label' => 'Select Book',
    'options' => $books,
    'empty' => 'Select Book'
));
?>

<?php
echo $this->Form->input('issue_date', array(
    'label' => 'Issue Date',
    'type' => 'date'
));
?>

<?php
echo $this->Form->input('due_date', array(
    'label' => 'Due Date',
    'type' => 'date'
));
?>

<?php
echo $this->Form->hidden('status', array(
    'value' => 'Issued'
));
?>

<?php
echo $this->Form->hidden('fine', array(
    'value' => 0
));
?>

<?php
echo $this->Form->end('Issue Book');
?>