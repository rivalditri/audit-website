<!--  Body Wrapper -->
<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<!--  Main wrapper -->
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">
                        User
                    </h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle table-bordered">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Nama Unit</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Inisial</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Email</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Status</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($dataUser as $user) : $no++ ?>
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"><?= $no ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"><?= $user->nama_unit ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="fw-normal mb-0 "><?= $user->inisial ?></p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 fs-4"><?= $user->email ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 fs-4"><?= ($user->is_keuangan == 1) ? "Active" : "Non Active" ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $user->id_user ?>">
                                                        Edit
                                                    </button>
                                                    <div class="modal fade" id="editModal<?= $user->id_user ?>" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="uploadModalLabel">Edit User</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="/edituser" method="post" id="form-upload">
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="nama" class="form-label">Nama Unit</label>
                                                                            <input class="form-control" id="nama" type="text" name="nama_unit" value="<?= $user->nama_unit ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="inisial" class="form-label">Inisial</label>
                                                                            <input class="form-control" id="inisial" type="text" name="inisial" value="<?= $user->inisial ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="email" class="form-label">Email</label>
                                                                            <input class="form-control" id="email" type="text" name="email" value="<?= $user->email ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="status" class="form-label">Status</label>
                                                                            <select class="form-select" aria-label="status" name="status">
                                                                                <option value="0" <?= ($user->is_keuangan == 0) ? 'selected' : ''; ?>>Active</option>
                                                                                <option value="1" <?= ($user->is_keuangan == 0) ? 'selected' : ''; ?>>Non Active</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-primary btn-upload">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $user->id_user ?>">
                                                        Delete
                                                    </button>
                                                    <div class="modal fade" id="hapusModal<?= $user->id_user ?>" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="uploadModalLabel">Hapus User</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="overflow-auto">Apakah yakin anda ingin menghapus user <?= $user->nama_unit ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary btn-upload">Delete</button>
                                                                </div>
                                                            </div>
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
</div>
</div>
</div>

<?= $this->endSection() ?>