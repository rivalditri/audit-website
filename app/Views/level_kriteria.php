<!--  Body Wrapper -->
<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>



<!--  Main wrapper -->
<div class="container-fluid">
    <?php

    use function PHPUnit\Framework\containsEqual;

    if (session()->has('success')) { ?>
        <div class="alert alert-success">
            <?php echo session()->get('success'); ?>
        </div>
    <?php } else if (session()->has('failed')) { ?>
        <div class="alert alert-warning">
            <?php echo session()->get('failed'); ?>
        </div>
    <?php } ?>



    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h3 class="fw-semibold mb-4">
                        <?= session()->get('nama_unit') ?>
                    </h3>
                    <h4 class="fw-semibold mb-4">
                        Level Kriteria
                    </h4>
                    <div class="d-flex justify-content-between">
                        <h5 class="flex-grow-1 card-title fw-semibold mb-4">
                            <?= $level ?>
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
                                <li class="breadcrumb-item"><a href="/levelIndikator/<?= explode('/', explode('-', uri_string())[0])[1] ?>"><?= $indikator ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $level ?></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="border border-1 border-primary mb-4 p-3 rounded-2">
                        <h5 class="fw-semibold mb-2">
                            Kriteria :
                        </h5>
                        <p class="fw-semibold mb-0">
                            <?= $kriteria ?>
                        </p>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle table-bordered border-dark table-striped">
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
                                        <h6 class="fw-semibold mb-0">Status</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Keterangan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data_proses as $proses) : ?>
                                    <tr>
                                        <td class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0"><?= $proses->id_level_kriteria; ?></h6>
                                        </td>
                                        <td class="border-bottom-0 fixed-width-column">
                                            <?= $proses->kriteria_proses ?>;
                                        </td>
                                        <td class="border-bottom-0 fixed-width-column">
                                            <p class="mb-0 fw-normal"><?= $proses->deskripsi_dokumen ?></p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <?php if ($status[$proses->id_level_kriteria] == 2) { ?>
                                                <button type="button" class="btn btn-success not-allow-button">Valid</button>
                                            <?php } else if ($status[$proses->id_level_kriteria] == 3) { ?>
                                                <button type="button" class="btn btn-primary not-allow-button">Revisi</button>
                                            <?php } else if ($status[$proses->id_level_kriteria] == 4) { ?>
                                                <button type="button" class="btn btn-danger not-allow-button">Tidak Valid</button>
                                            <?php } else if ($status[$proses->id_level_kriteria] == 1) { ?>
                                                <button type="button" class="btn btn-warning not-allow-button">Under Review</button>
                                            <?php } else { ?>
                                                -
                                            <?php } ?>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <?= $komentar[$proses->id_level_kriteria] ?>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <?php if (session()->get('role') == '0') : ?>
                                                <?php if (str_contains($proses->deskripsi_dokumen, "Tidak ada work product")) : ?>
                                                    <em>None</em>
                                                <?php else : ?>
                                                    <?php if ($status[$proses->id_level_kriteria] == 2) : ?>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal<?= $proses->id_level_kriteria ?>" disabled>
                                                            <i class="ti ti-upload"></i>
                                                        </button>
                                                    <?php else : ?>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal<?= $proses->id_level_kriteria ?>">
                                                            <i class="ti ti-upload"></i>
                                                        </button>
                                                    <?php endif ?>
                                                    <div class="modal fade" id="uploadModal<?= $proses->id_level_kriteria ?>" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="uploadModalLabel">Upload Document</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="/dokumen" method="post" enctype="multipart/form-data" id="form-upload">
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <input class="form-control" type="text" name="id_level" value="<?= $proses->id_level_kriteria ?>" hidden>
                                                                            <input class="form-control" type="text" name="id_level" value="<?= $proses->id_level_kriteria ?>" disabled>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <input class="form-control" type="file" id="formFile" name="file" accept=".pdf, .doc, .docx">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-primary btn-upload">Upload</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if (str_contains($komentar[$proses->id_level_kriteria], "-")) : ?>
                                                        <a href="/download/<?= $proses->id_level_kriteria ?>" class="text-white">
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" disabled>
                                                                <i class="ti ti-download"></i>
                                                            </button>
                                                        </a>
                                                    <?php else : ?>
                                                        <a href="/download/<?= $proses->id_level_kriteria ?>" class="text-white">
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                <i class="ti ti-download"></i>
                                                            </button>
                                                        </a>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            <?php else : ?>
                                                <?php if (str_contains($proses->deskripsi_dokumen, "Tidak ada work product")) : ?>
                                                    <em>None</em>
                                                <?php elseif (str_contains($komentar[$proses->id_level_kriteria], "-")) : ?>
                                                    <em>User Belum Upload</em>
                                                <?php else : ?>
                                                    <?php if (str_contains($komentar[$proses->id_level_kriteria], "-")) : ?>
                                                        <a href="/download/<?= $proses->id_level_kriteria ?>" class="text-white">
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" disabled>
                                                                <i class="ti ti-download"></i>
                                                            </button>
                                                        </a>
                                                    <?php else : ?>
                                                        <a href="/download/<?= $proses->id_level_kriteria ?>" class="text-white">
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                <i class="ti ti-download"></i>
                                                            </button>
                                                        </a>
                                                    <?php endif ?>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#validasiModal<?= $proses->id_level_kriteria ?>">
                                                        <i class="ti ti-edit"></i>
                                                    </button>
                                                    <div class="modal fade" id="validasiModal<?= $proses->id_level_kriteria ?>" tabindex="-1" aria-labelledby="validasiModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="validasiModalLabel">Ubah Data</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="/validasi" method="post">
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <input class="form-control" type="text" name="id" value="<?= $proses->id_level_kriteria ?>" hidden>
                                                                        </div>
                                                                        <label for="status" class="mb-2 fs-5 fw-semibold">Status</label>
                                                                        <div class="mb-3">
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="status" value="1" id="status1" <?= ($status[$proses->id_level_kriteria] == 1) ? 'checked' : ''; ?>>
                                                                                <label class="form-check-label" for="status1">
                                                                                    Under Review
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="status" value="2" id="status2" <?= ($status[$proses->id_level_kriteria] == 2) ? 'checked' : ''; ?>>
                                                                                <label class="form-check-label" for="status2">
                                                                                    Valid
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="status" value="3" id="status3" <?= ($status[$proses->id_level_kriteria] == 3) ? 'checked' : ''; ?>>
                                                                                <label class="form-check-label" for="status3">
                                                                                    Revisi
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="status" value="4" id="status4" <?= ($status[$proses->id_level_kriteria] == 4) ? 'checked' : ''; ?>>
                                                                                <label class="form-check-label" for="status4">
                                                                                    Tidak Valid
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-floating">
                                                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 200px;" name="komentar"><?= str_contains($komentar[$proses->id_level_kriteria], "this document need to be reviewed") ? "" : $komentar[$proses->id_level_kriteria] ?></textarea>
                                                                            <label for="floatingTextarea">Comments</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            <?php endif ?>
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