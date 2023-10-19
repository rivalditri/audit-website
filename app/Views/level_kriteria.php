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
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                                    Upload
                                                </button>
                                                <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="uploadModalLabel">Upload Document</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="/dokumen" method="post" enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <input class="form-control" type="text" name="id_level">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <input class="form-control" type="file" id="formFile" name="file" accept=".pdf, .doc, .docx">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Download
                                                </button>
                                            <?php endif ?>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#validasiModal">
                                                validasi
                                            </button>
                                            <div class="modal fade" id="validasiModal" tabindex="-1" aria-labelledby="validasiModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="validasiModalLabel">Validasi</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe src="./uploads/index.html" width="100%" height="200px"></iframe>
                                                            <form action="" method="post">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="radioValidation" id="radioValidation1" checked>
                                                                    <label class="form-check-label" for="radioValidation1">
                                                                        Under Review
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="radioValidation" id="radioValidation2">
                                                                    <label class="form-check-label" for="radioValidation2">
                                                                        Valid
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="radioValidation" id="radioValidation3">
                                                                    <label class="form-check-label" for="radioValidation3">
                                                                        Tidak Valid
                                                                    </label>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="detailModalLabel">Detail</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe src="./uploads/index.html" width="100%" height="200px"></iframe>
                                                            <form action="" method="post">
                                                                <input class="form-control mb-3" type="file" id="formFile" name="document_file" hidden>
                                                                <input class="form-control mb-3" type="text" id="formFile" name="validation_file" value="Valid" disabled>
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 200px;"></textarea>
                                                                    <label for="floatingTextarea">Comments</label>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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