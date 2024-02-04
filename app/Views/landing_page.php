<!--  Body Wrapper -->
<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>
<!--  Main wrapper -->
<!--  Header End -->
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h3 class="fw-semibold mb-4">
                        Selamat Datang di Maturity BLU - <?= session()->get('login_unit') ?>
                    </h3>
                    <img src="<?= base_url('') ?>/img/landing-page.jpg" class="img-fluid" alt="Maturity-BLU">
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Body End -->
<?= $this->endSection(); ?>