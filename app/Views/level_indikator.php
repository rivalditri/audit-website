<!--  Body Wrapper -->
<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<!--  Main wrapper -->
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <h5 class="flex-grow-1 card-title fw-semibold mb-4">
                            <?= session()->get('nama_unit') ?>
                        </h5>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/aspek/<?= session()->get('id_user') ?>">Aspek</a></li>
                                <li class="breadcrumb-item"><a href="/indikator/<?= explode('/', explode('.', uri_string())[0])[1] ?>">Indikator</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $aspek ?></li>
                            </ol>
                        </nav>
                    </div>
                    <h3 class="fw-semibold mb-4">
                        <?= $aspek ?>
                    </h3>
                    <h5 class="fw-semibold mb-4">
                        <span class="text-primary"> Indikator</span>
                        <span><i class="ti ti-arrow-right"></i></span>
                        <?= $indikator ?>
                    </h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle table-bordered">
                            <thead class="text-dark fs-4">
                                <tr class="text-center">
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Level</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 column-small">Capaian Unit</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 column-small">Presentase Capaian Unit</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 column-small">Capaian Satker</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 column-small">Presentase Capaian Satker</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataLevel as $level) : ?>
                                    <tr class="text-center">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"><?= $level->nama_level ?></h6>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <?php if ($level->nama_level == 'Level 1' || $cpu[$level->id_level_kapabilitas] >= 1) : ?>
                                                <button type="button" class="btn btn-primary not-allow-button">
                                                    <span>
                                                        <i class="ti ti-check"></i>
                                                    </span>
                                                </button>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-danger not-allow-button">
                                                    <span>
                                                        <i class="ti ti-x"></i>
                                                    </span>
                                                </button>
                                            <?php endif ?>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"><?= $level->nama_level == 'Level 1' ? '100%' : $cpu[$level->id_level_kapabilitas] . '%' ?></p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <?php if ($level->nama_level == 'Level 1') { ?>
                                                <button type="button" class="btn btn-primary not-allow-button">
                                                    <span>
                                                        <i class="ti ti-check"></i>
                                                    </span>
                                                </button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-danger not-allow-button">
                                                    <span>
                                                        <i class="ti ti-x"></i>
                                                    </span>
                                                </button>
                                            <?php }  ?>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"><?= $level->nama_level == 'Level 1' ? '100%' : "50%" ?></p>
                                        </td>
                                        <td class="border-bottom-0 column-very-small">
                                            <a href="/levelKriteria/<?= $level->id_level_kapabilitas ?>">
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