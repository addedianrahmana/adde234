<?php
require_once('templates/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4"></h1>
    <form method="post">
        <div class="card mb-4">
            <div class="card-header">
                <button type="submit" class="btn btn-primary" id="sync" name="sync">
                    Syncronize
                </button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_SESSION['status'])) {
    ?>
        <div class="alert auto-close alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['status']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION['status']);
    }
    ?>

    <?php
    if (isset($_SESSION['gagal'])) {
    ?>
        <div class="alert auto-close alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['gagal']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION['gagal']);
    }
    ?>
</div>

<script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<?php
require_once('templates/footer.php');
?>