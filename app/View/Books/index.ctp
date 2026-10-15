<h2>Library Books</h2>

<!-- <?php
echo $this->Html->link(
    '← Back to Dashboard',
    array(
        'controller' => 'librarians',
        'action' => 'dashboard'
    ),
    array(
        'class' => 'back-dashboard-button'
    )
);
?> -->

<br><br>

<input
    type="text"
    id="searchBook"
    placeholder="Search books..."
>
<br><br>

<table>
    <tr>
        <th>
            <?php
            echo $this->Html->link(
                'Add Book',
                array(
                    'action' => 'add'
                )
            );
            ?>
        </th>
        <th></th>
    </tr>
</table>

<br>

<table id="booksTable" border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>ISBN</th>
        <th>Quantity</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($books as $book): ?>

    <tr>
        <td>
            <?php echo h($book['Book']['id']); ?>
        </td>

        <td>
            <?php echo h($book['Book']['title']); ?>
        </td>

        <td>
            <?php echo h($book['Book']['author']); ?>
        </td>

        <td>
            <?php echo h($book['Book']['category']); ?>
        </td>

        <td>
            <?php echo h($book['Book']['isbn']); ?>
        </td>

        <td>
            <?php echo h($book['Book']['quantity']); ?>
        </td>

        <td>
            <?php
            echo $this->Html->link(
                'View',
                array(
                    'action' => 'view',
                    $book['Book']['id']
                )
            );
            ?>

            |

            <?php
            echo $this->Html->link(
                'Delete',
                array(
                    'action' => 'delete',
                    $book['Book']['id']
                ),
                array(
                    'confirm' => 'Are you sure you want to delete this book?'
                )
            );
            ?>

            |

            <?php if ((int)$book['Book']['quantity'] > 0): ?>

                <?php
                echo $this->Html->link(
                    'Issue Book',
                    array(
                        'controller' => 'Books',
                        'action' => 'issue',
                        $book['Book']['id']
                    ),
                    array(
                        'class' => 'issue-button'
                    )
                );
                ?>

            <?php else: ?>

                <span class="issue-disabled">
                    Out of Stock
                </span>

            <?php endif; ?>

        </td>
    </tr>

    <?php endforeach; ?>

</table>

<?php
echo $this->Html->link(
    '← Back to Dashboard',
    array(
        'controller' => 'librarians',
        'action' => 'dashboard'
    ),
    array(
        'class' => 'back-dashboard-button'
    )
);
?>

<style>
.back-dashboard-button {
    display: inline-block;
    padding: 10px 16px;
    background-color: #34495e;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 15px;
}

.back-dashboard-button:hover {
    background-color: #2c3e50;
    color: #ffffff;
}

.issue-disabled {
    color: #cc0000;
    font-weight: bold;
}
</style>

<!-- jQuery Search -->
<script>
$(document).ready(function() {

    $('#searchBook').keyup(function() {

        var search = $(this).val().toLowerCase();

        $('#booksTable tr:gt(0)').each(function() {

            var rowText = $(this).text().toLowerCase();

            if (rowText.indexOf(search) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }

        });

    });

});
</script>
