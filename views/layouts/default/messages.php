<?php
if (isset($_SESSION['messages'])) :
    foreach ($_SESSION['messages'] as $message) :
        // Convert error type to bootstrap's 'danger' class
        if ($message['type'] == 'error') {
            $message['type'] = 'danger';
        }; ?>
<div class="alert alert-<?php echo $message['type'] ?>" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <?php echo $message['text'] ?>
</div>
<?php
endforeach;
unset($_SESSION['messages']);
endif;
?>