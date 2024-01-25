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
                    <h3 class="fw-semibold mb-4">
                        <?= session()->get('nama_unit') ?>
                    </h3>
                    <div class="d-flex justify-content-between">
                        <h5 class="flex-grow-1 card-title fw-semibold mb-4">
                            Level Kapabilitas
                        </h5>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <?php if (session()->get('role') == 1) : ?>
                                    <li class="breadcrumb-item"><a href="/aspek/<?= session()->get('user') ?>">Aspek</a></li>
                                <?php elseif ($aspek == "Keuangan" || $aspek == "Pelayanan") : ?>
                                    <li class="breadcrumb-item"><a href="/aspek/result/<?= session()->get('user') ?>">Aspek</a></li>
                                <?php elseif ($aspek == "Kapabilitas Internal" || $aspek == "Tata Kelola dan Kepemimpinan" || $aspek == "Inovasi" || $aspek == "Lingkungan") : ?>
                                    <li class="breadcrumb-item"><a href="/aspek/process/<?= session()->get('user') ?>">Aspek</a></li>
                                <?php endif ?>
                                <li class="breadcrumb-item"><a href="/indikator/<?= explode('/', explode('.', uri_string())[0])[1] ?>"><?= $aspek ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $indikator ?></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle table-bordered border-dark  table-striped">
                            <thead class="text-dark fs-4">
                                <tr class="text-center">
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Level</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Presentase Dokumen Terisi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Presentase Dokumen Tervalidasi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach ($dataLevel as $level) : ?>
                                    <tr class="text-center border-bottom border-dark">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"><?= $level->nama_level ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"><?= $level->nama_level == 'Level 1' ? '100%' : $cpu[$level->id_level_kapabilitas] . '%' ?></p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"><?= $level->nama_level == 'Level 1' ? '100%' : $csatker[$level->id_level_kapabilitas] . '%' ?></p>
                                        </td>
                                        <?php if (session()->get('role') == '0') { ?>
                                            <td class="border-bottom-0 column-very-small">
                                                <?php
                                                $levelkapabilitas = substr($level->id_level_kapabilitas, 0, 5);
                                                $idprev = intval(explode('L', $level->id_level_kapabilitas)[1]) - 1;
                                                $id_prev_level = $levelkapabilitas . $idprev;
                                                ?>
                                                <?php if ($level->nama_level == 'Level 1' || $level->nama_level == 'Level 2' || $cpu[$id_prev_level] > 50 || session()->get('role') == '1') { ?>
                                                    <a href="/levelKriteria/<?= $level->id_level_kapabilitas ?>" class="text-white">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Detail
                                                        </button>
                                                    </a>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" disabled>
                                                        Detail
                                                    </button>
                                                <?php }  ?>
                                            </td>
                                        <?php } else if (session()->get('role') == '1') { ?>
                                            <td class="border-bottom-0 column-very-small">
                                                <?php
                                                $levelkapabilitas = substr($level->id_level_kapabilitas, 0, 5);
                                                $idprev = intval(explode('L', $level->id_level_kapabilitas)[1]) - 1;
                                                $id_prev_level = $levelkapabilitas . $idprev;
                                                ?>
                                                <?php if ($level->nama_level == 'Level 1' || $level->nama_level == 'Level 2' ||  $csatker[$id_prev_level] > 50 || session()->get('role') == '0') { ?>
                                                    <a href="/levelKriteria/<?= $level->id_level_kapabilitas ?>" class="text-white">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Detail
                                                        </button>
                                                    </a>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" disabled>
                                                        Detail
                                                    </button>
                                                <?php }  ?>
                                            </td>
                                        <?php }  ?>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <h6 class="fw-normal mt-4">
                        Silahkan lengkapi dokumen terisi hingga 50% agar dapat mengisi level capaian selanjutnya
                    </h6>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>