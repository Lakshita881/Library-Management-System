<?php
/**
 * CakePHP(tm) : Rapid Development Framework
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>

    <?php echo $this->Html->charset(); ?>

    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $this->fetch('title'); ?>
    </title>

    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('library.generic');

        echo $this->fetch('meta');
        echo $this->fetch('css');

        // Load jQuery
        echo $this->Html->script('jquery.min');
    ?>

</head>

<body>

    <div id="container">

        <div id="header">
            <h1>Library Management System</h1>
        </div>

        <div id="content">

            <?php echo $this->Flash->render(); ?>

            <?php echo $this->fetch('content'); ?>

        </div>

        <div id="footer">

            <p>
                Library Management System
            </p>

        </div>

    </div>

    <?php echo $this->fetch('script'); ?>

</body>
</html>