<h2>Library Books</h2>

<table border="1" cellpadding="8" cellspacing="0">


<tr>
    <th>Title</th>
    <th>Author</th>
    <th>Category</th>
    <th>ISBN</th>
    <th>Quantity</th>
</tr>

<?php foreach ($books as $book): ?>

    <tr>
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
    </tr>

<?php endforeach; ?>

</table>
