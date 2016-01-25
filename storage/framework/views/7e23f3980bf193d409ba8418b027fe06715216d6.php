<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <?php echo session('error'); ?>

    </div>
<?php endif; ?>

<?php if(count($errors)): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <?php foreach($errors->all('<li>:message</li>') as $error): ?>
            <?php echo $error; ?>

        <?php endforeach; ?>
    </div>
<?php endif; ?>