<h2>Edit Member</h2>

<?php echo $this->Form->create('Member'); ?>

<?php echo $this->Form->input('name'); ?>

<?php echo $this->Form->input('email'); ?>

<?php echo $this->Form->input('phone'); ?>

<?php echo $this->Form->input('address'); ?>

<?php echo $this->Form->end('Update Member'); ?>