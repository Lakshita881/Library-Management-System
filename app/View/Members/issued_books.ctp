
<h2>Issued Books</h2>

<?php if (!empty($member)): ?>
    <p>
        <strong>Member:</strong>
        <?php echo h($member['Member']['name']); ?>
    </p>
<?php endif; ?>

<table cellpadding="8" cellspacing="0" border="1">
    <thead>
        <tr>
            <th>Issue ID</th>
            <th>Book Title</th>
            <th>Issue Date</th>
            <th>Due Date</th>
            <th>Return Date</th>
            <th>Status</th>
            <th>Fine (₹)</th>

            <?php if (!empty($isLibrarian)): ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($issues)): ?>

            <?php foreach ($issues as $issue): ?>
                <tr>
                    <td>
                        <?php echo h($issue['BookIssue']['id']); ?>
                    </td>

                    <td>
                        <?php
                        echo !empty($issue['Book']['title'])
                            ? h($issue['Book']['title'])
                            : 'Book unavailable';
                        ?>
                    </td>

                    <td>
                        <?php echo h($issue['BookIssue']['issue_date']); ?>
                    </td>

                    <td>
                        <?php echo h($issue['BookIssue']['due_date']); ?>
                    </td>

                    <td>
                        <?php
                        echo !empty($issue['BookIssue']['return_date'])
                            ? h($issue['BookIssue']['return_date'])
                            : '-';
                        ?>
                    </td>

                    <td>
                        <?php echo h($issue['BookIssue']['status']); ?>
                    </td>

                    <td>
                        ₹<?php
                        echo number_format(
                            (float)$issue['BookIssue']['fine'],
                            2
                        );
                        ?>
                    </td>

                    <?php if (!empty($isLibrarian)): ?>
                        <td>
                            <?php
                            if (
                                $issue['BookIssue']['status'] === 'Issued'
                                && !empty($issue['Book']['id'])
                            ) {
                                echo $this->Form->postLink(
                                    'Return',
                                    array(
                                        'controller' => 'members',
                                        'action' => 'returnBook',
                                        $issue['BookIssue']['id']
                                    ),
                                    array(
                                        'class' => 'return-button'
                                    )
                                );
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="<?php echo !empty($isLibrarian) ? 8 : 7; ?>">
                    No issued books found.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
