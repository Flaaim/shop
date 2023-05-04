<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <?php if(!empty($_SESSION['errors'])): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $_SESSION['errors']; unset($_SESSION['errors']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>

            <?php if(!empty($_SESSION['success'])): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success']; unset($_SESSION['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>

        </div>
    </div>
</div>