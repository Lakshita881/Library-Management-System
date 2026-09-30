<h2>Register Your Self</h2>

<?php echo $this->Form->create('Member'); ?>

<?php echo $this->Form->input('name'); ?>

<?php echo $this->Form->input('email'); ?>

<?php echo $this->Form->input('phone'); ?>


<?php echo $this->Form->input('address'); ?>

<?php echo $this->Form->end('Register'); ?>