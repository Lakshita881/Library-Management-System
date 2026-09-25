<h2>Member Details</h2>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <td>
            <?php echo h($member['Member']['id']); ?>
        </td>
    </tr>

    <tr>
        <th>Name</th>
        <td>
            <?php echo h($member['Member']['name']); ?>
        </td>
    </tr>

    <tr>
        <th>Email</th>
        <td>
            <?php echo h($member['Member']['email']); ?>
        </td>
    </tr>

    <tr>
        <th>Phone</th>
        <td>
            <?php echo h($member['Member']['phone']); ?>
        </td>
    </tr>

    <tr>
        <th>Address</th>
        <td>
            <?php echo h($member['Member']['address']); ?>
        </td>
    </tr>

</table>

<br>

<?php
echo $this->Html->link(
    'Back to Members',
    array('action' => 'index')
);
?>