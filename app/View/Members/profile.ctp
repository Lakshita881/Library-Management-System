<div class="profile-page">

<h2>My Profile</h2>


<div class="profile-details">

    <p>
        <strong>Name:</strong>
        <?php echo h($member['Member']['name']); ?>
    </p>

    <p>
        <strong>Email:</strong>
        <?php echo h($member['Member']['email']); ?>
    </p>

    <p>
        <strong>Phone:</strong>
        <?php echo h($member['Member']['phone']); ?>
    </p>

    <p>
        <strong>Membership ID:</strong>
        <?php echo h($member['Member']['id']); ?>
    </p>

    <p>
        <strong>Registered On:</strong>
        <?php echo h($member['Member']['created']); ?>
    </p>

</div>

<div class="profile-actions">
    <?php
    echo $this->Html->link(
        'Back to Dashboard',
        array(
            'controller' => 'Members',
            'action' => 'dashboard'
        )
    );
    ?>
</div>


</div>
