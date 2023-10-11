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
                    <h2 class="card-title fw-semibold mb-4">
                        <?= session()->get('nama_unit') ?>
                    </h2>
                    <h3 class="fw-semibold mb-4">
                        <?= $aspek ?>
                    </h3>
                    <h5 class="fw-semibold mb-4">
                        <span class="text-primary"> Indikator</span>
                        <span><i class="ti ti-arrow-right"></i></span>
                        <?= $indikator ?>
                    </h5>
                    <h5 class="fw-semibold mb-4">
                        <?= $level ?>
                    </h5>
                    <div class="border border-1 border-primary mb-4 p-3 rounded-2">
                        <h5 class="fw-semibold mb-2">
                            Kriteria :
                        </h5>
                        <p class="fw-semibold mb-0">
                            <?= $kriteria ?>
                        </p>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle table-bordered">
                            <thead class="text-dark fs-4">
                                <tr class="text-center">
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Proses</h6>
                                    </th>
                                    <th class="border-bottom-0 fixed-width-column">
                                        <h6 class="fw-semibold mb-0">Kriteria Per Proses</h6>
                                    </th>
                                    <th class="border-bottom-0 fixed-width-column">
                                        <h6 class="fw-semibold mb-0">Dokumen</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">File Dokumen</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Validasi</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Keterangan</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_proses as $proses) : ?>
                                    <tr>
                                        <td class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0"><?= $no++; ?></h6>
                                        </td>
                                        <td class="border-bottom-0 fixed-width-column">
                                            <?= $proses->kriteria_proses ?>;
                                        </td>
                                        <td class="border-bottom-0 fixed-width-column">
                                            <p class="mb-0 fw-normal"><?= $proses->deskripsi_dokumen ?></p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <?php if (session()->get('role') == '0') : ?>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Upload
                                                </button>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Download
                                                </button>
                                            <?php endif ?>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                validasi
                                            </button>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Detail
                                            </button>
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