<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Ops!</strong> <?= $_SESSION['error'] ?>
         <?php unset($_SESSION['error']); ?>
    </div>
<?php elseif (isset($_SESSION['success'])) : ?>
    <div class="alert alert-warning alert-dismissible fade in" role="alert">
        <button class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
         <?= $_SESSION['success'] ?>
         <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>