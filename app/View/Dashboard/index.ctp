<h1>Library Dashboard</h1>

<p>Welcome to the Library Management System.</p>

<?php
echo $this->Html->link(
    'Logout',
    array('controller' => 'users', 'action' => 'logout')
);
?>