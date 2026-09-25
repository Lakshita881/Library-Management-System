<h2>Library Books</h2>

<input
    type="text"
    id="searchBook"
    placeholder="Search books..."
>
<br><br>
<table >
<tr>
<th>
<?php
echo $this->Html->link(
    'Add Book',
    array('action' => 'add')
);
?>
</th>
<th>
<!-- <br><br> -->

<!-- <br><br> -->
</tr>
</table>

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
                'Edit',
                array(
                    'action' => 'edit',
                    $book['Book']['id']
                )
            );
            ?>

        </td>

    </tr>

    <?php endforeach; ?>

</table>


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