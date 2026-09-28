<h2>Book Details</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <td><?php echo h($book['Book']['id']); ?></td>
    </tr>

    <tr>
        <th>Title</th>
        <td><?php echo h($book['Book']['title']); ?></td>
    </tr>

    <tr>
        <th>Author</th>
        <td><?php echo h($book['Book']['author']); ?></td>
    </tr>

    <tr>
        <th>Category</th>
        <td><?php echo h($book['Book']['category']); ?></td>
    </tr>

    <tr>
        <th>ISBN</th>
        <td><?php echo h($book['Book']['isbn']); ?></td>
    </tr>

    <tr>
        <th>Quantity</th>
        <td><?php echo h($book['Book']['quantity']); ?></td>
    </tr>

      <tr>
        <th>Quality</th>
        <td><?php echo h($book['Book']['quality']); ?></td>
    </tr>
</table>

<br>

<?php
echo $this->Html->link(
    'Back to Books',
    array('action' => 'index')
);
?>