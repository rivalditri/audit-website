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
                        <?= session()->get('nama_unit') ?>
                    </h3>
                    <div class="d-flex justify-content-between">
                        <h5 class="flex-grow-1 card-title fw-semibold mb-4">
                            Aspek
                        </h5>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Aspek</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle table-striped">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th scope="col" class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th scope="col" class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Aspek</h6>
                                    </th>
                                    <th scope="col" class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Maturitas</h6>
                                    </th>
                                    <th scope="col" class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php $no = 0;
                                foreach ($dataAspek as $aspek) : $no++ ?>
                                    <tr scope="row" class="border-bottom border-dark">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"><?= $no ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1"><?= $aspek->aspek ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"><?= $maturitas[$aspek->id_aspek] ?></p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="/indikator/<?= $aspek->id_aspek ?>">
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
<!--  Body End -->
<?= $this->endSection(); ?>