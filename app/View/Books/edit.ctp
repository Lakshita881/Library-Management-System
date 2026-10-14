
<h2>Edit Book</h2>

<?php echo $this->Form->create('Book'); ?>

<?php echo $this->Form->input('title'); ?>

<?php echo $this->Form->input('author'); ?>

<?php echo $this->Form->input('category'); ?>

<?php echo $this->Form->input('isbn'); ?>

<?php echo $this->Form->input('quantity'); ?>

<?php echo $this->Form->end('Update Book'); ?>

<script>
window.addEventListener('pageshow', function (event) {
    var navigation = performance.getEntriesByType('navigation')[0];

    if (
        event.persisted ||
        (navigation && navigation.type === 'back_forward')
    ) {
        window.location.replace(
            '<?php echo $this->Html->url(array(
                'controller' => 'Books',
                'action' => 'index'
            )); ?>'
        );
    }
});
</script>
