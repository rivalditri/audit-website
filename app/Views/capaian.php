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
                        Capaian Maturitas BLU Subsatker Per Indikator
                    </h3>
                    <div class="d-flex justify-content-between">
                        <h5 class="flex-grow-1 card-title fw-semibold mb-4">
                            <?= $aspek->aspek ?>
                        </h5>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/overview">Overview Capaian</a></li>
                                <li class="breadcrumb-item active"><?= $aspek->aspek ?></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle table-bordered border-dark table-striped">
                            <thead class="text-dark fs-4">
                                <tr class="text-center">
                                    <th scope="col" class="border-bottom-0" rowspan="2" style="vertical-align: middle;">
                                        <h6 class="fw-semibold mb-0">Unit Kerja</h6>
                                    </th>
                                    <th scope="col" class="border-bottom-0" colspan="<?= count($indikators) ?>">
                                        <h6 class="fw-semibold mb-0">Indikator</h6>
                                    </th>
                                    <th scope="col" class="border-bottom-0" rowspan="2" style="vertical-align: middle;">
                                        <h6 class="fw-semibold mb-0 ">Hasil</h6>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <?php foreach ($indikators as $indikator) : ?>
                                        <th scope="col" class="border-bottom-0">
                                            <a href="#?>" class="text-decoration-underline text-black">
                                                <h6 class="fw-semibold mb-0 custom-text-color"><?= $indikator->indikator ?> <i class="ti ti-link"></i></h6>
                                            </a>
                                        </th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach ($dataUser as $user) : ?>
                                    <tr scope="row" class="border-bottom border-dark text-center">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"><?= $user->nama_unit ?></h6>
                                        </td>
                                        <?php foreach ($indikators as $indikator) : ?>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $capaianIndikator[$user->id_user][$indikator->id_indikator] ?></p>
                                            </td>
                                        <?php endforeach; ?>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"><?= $hasil[$user->id_user] ?></p>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--  Body End -->
<?= $this->endSection(); ?>