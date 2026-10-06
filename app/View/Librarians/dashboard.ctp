<h1>Librarian Dashboard</h1>

<p>Welcome, Librarian.</p>

<?php
echo $this->Html->link(
    'Manage Books',
    array(
        'controller' => 'books',
        'action' => 'index'
    )
);
?>

<br><br>

<?php 
echo $this->Html->Link(
    'Manage Members',
    array(
        'controller' => 'members' ,
        'action' => 'index'
    )
);

?>

<br><br>

<?php
echo $this->Html->link(
    'Logout',
    array(
        'controller' => 'librarians',
        'action' => 'logout'
    )
);
?>