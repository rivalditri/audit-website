<!--  Body Wrapper -->
<?=$this->extend('templates/layout');?>

<?=$this->section('content');?>

<!--  Main wrapper -->
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h2 class="card-title fw-semibold mb-4">
                            <?= session()->get('nama_unit') ?>
                        </h2>
                        <h3 class="fw-semibold mb-4">
                            <?= $aspek?>
                        </h3>
                        <h5 class="fw-semibold mb-4">
                            <?= $indikator?>
                        </h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Level</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Capaian Unit</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Presentase Capaian Unit</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Capaian Satker</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Presentase Capaian Satker</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataLevel as $level) : ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $level->nama_level ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                tercapai
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">50%</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                tercapai
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">50%</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="/levelKriteria/<?=$level->id_level_kapabilitas?>">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Detail
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?= $this->endSection(); ?>