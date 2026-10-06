<h2>My Issued Books</h2>

<?php if (!empty($issues)): ?>

<table border="1" cellpadding="8" cellspacing="0">

    <tr>
        <th>Book</th>
        <th>Author</th>
        <th>Issue Date</th>
        <th>Due Date</th>
        <th>Status</th>
        <th>Fine</th>
    </tr>

    <?php foreach ($issues as $issue): ?>

        <tr>

            <td>
                <?php echo h($issue['Book']['title']); ?>
            </td>

            <td>
                <?php echo h($issue['Book']['author']); ?>
            </td>

            <td>
                <?php echo h($issue['BookIssue']['issue_date']); ?>
            </td>

            <td>
                <?php echo h($issue['BookIssue']['due_date']); ?>
            </td>

            <td>
                <?php echo h($issue['BookIssue']['status']); ?>
            </td>

            <td>
                ₹<?php echo h($issue['BookIssue']['fine']); ?>
            </td>

        </tr>

    <?php endforeach; ?>

</table>

<?php else: ?>

<p>No books are currently issued to you.</p>

<?php endif; ?>

<p>
    <?php
    echo $this->Html->link(
        'Back to Dashboard',
        array(
            'controller' => 'Members',
            'action' => 'dashboard'
        )
    );
    ?>
</p>