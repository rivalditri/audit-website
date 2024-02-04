<!--  Body Wrapper -->
<?php $this->extend('templates/layout'); ?>

<?php $this->section('content'); ?>
<!--  Main wrapper -->
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">
                        Fakultas
                    </h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle  table-bordered border-dark table-striped">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Fakultas</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tahun</h6>
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
                                            <h6 class="fw-semibold mb-1"><?= $user->nama_unit ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"><?= date('Y', strtotime($user->created_at)) ?></p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="/aspek/<?= $user->id_user ?>">
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
</div>
</div>
</div>

<?php $this->endSection(); ?>