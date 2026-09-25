<h2>Library Members</h2>

<input
    type="text"
    id="searchMember"
    placeholder="Search members..."
>

<br><br>

<?php
echo $this->Html->link(
    'Add Member',
    array('action' => 'add')
);
?>

<br><br>

<table id="membersTable" border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($members as $member): ?>

    <tr>

        <td>
            <?php echo h($member['Member']['id']); ?>
        </td>

        <td>
            <?php echo h($member['Member']['name']); ?>
        </td>

        <td>
            <?php echo h($member['Member']['email']); ?>
        </td>

        <td>
            <?php echo h($member['Member']['phone']); ?>
        </td>

        <td>
            <?php echo h($member['Member']['address']); ?>
        </td>

        <td>

            <?php
            echo $this->Html->link(
                'View',
                array(
                    'action' => 'view',
                    $member['Member']['id']
                )
            );
            ?>

            |

            <?php
            echo $this->Html->link(
                'Edit',
                array(
                    'action' => 'edit',
                    $member['Member']['id']
                )
            );
            ?>

        </td>

    </tr>

    <?php endforeach; ?>

</table>

</table>

<script>

$(document).ready(function() {

    $('#searchMember').keyup(function() {

        var search = $(this).val().toLowerCase();

        $('#membersTable tr:gt(0)').each(function() {

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