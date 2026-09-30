
<div class="dashboard">

    <h1>Welcome to LibraryHub</h1>

    <p>
        Welcome to your library dashboard.
    </p>

    <div class="dashboard-links">

        <h2>Library Management</h2>

        <ul>
            <li>
                <?php
                echo $this->Html->link(
                    'Browse Books',
                    array(
                        'controller' => 'members',
                        'action' => 'view_books'
                    )
                );
                ?>
            </li>

            <li>
                <?php
                echo $this->Html->link(
                    'My Profile',
                    array(
                        'controller' => 'members',
                        'action' => 'profile'
                    )
                );
                ?>
            </li>

            <li>
                <?php
                    echo $this->Html->link(
                        'My Issued Books',
                        array(
                            'controller' => 'Members',
                            'action' => 'issuedBooks'
                        )
                    );
                    ?>
            </li>

            <li>
                <?php
                echo $this->Html->link(
                    'Logout',
                    array(
                        'controller' => 'members',
                        'action' => 'logout'
                    )
                );
                ?>
            </li>
        </ul>

    </div>

</div>
```
