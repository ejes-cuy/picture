<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">
            <div class="container my-4">
                <br>
                <div style="color:#477a7d">
                    <h4>Kelola Lelang</h4>
                </div>
                <hr>
                <a href="<?= site_url('backend/lelang/new') ?>" class="btn btn-success justify-content-end mt-2" style="width: 60px;" title="Add New"><i class="fa-solid fa-folder-plus"></i></a>
                <div class=" card-body border mt-2">
                    <table id="example" class="table table-striped table-bordered small">
                        <thead>
                            <tr>
                                <th>Tgl Mulai</th>
                                <th>Tgl Akhir</th>
                                <th>Nama Barang</th>
                                <th>Harga Awal</th>
                                <th>Penanggung jawab</th>
                                <th>Status</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lelang as $a) : ?>
                                <tr>
                                    <td><?= $a->tgl_mulai ?></td>
                                    <td><?= $a->tgl_akhir ?></td>
                                    <td><?= $a->nama_barang ?></td>
                                    <td>IDR <?= number_format($a->harga_awal, 2) ?></td>
                                    <td><?= $a->penanggungjawab ?></td>
                                    <td><?= $a->status ?></td>
                                    <td><img src="<?= empty($a->gambar) ? base_url('assets/images/no_image.png')  : base_url('upload/barang/' . $a->gambar) ?>" width="100px"></td>
                                    <td>
                                        <?php if ($a->allow_edit == 1 && $a->status == "open") : ?>
                                            <a href="<?= site_url('backend/lelang/edit/' . $a->id_lelang) ?>"><button type="button" class="btn btn-warning" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                            <a href="#" data-delete-url="<?= site_url('backend/lelang/cancel/' . $a->id_lelang) ?>" onclick="deleteConfirm(this)"><button type="button" class="btn btn-danger" title="Cancel"><i class="fa-solid fa-xmark"></i></button></a>
                                        <?php endif ?>
                                        <?php if ($a->allow_edit == 0 && $a->status == "open") : ?>
                                            <a href="#" data-closed-url="<?= site_url('backend/lelang/close/' . $a->id_lelang) ?>" onclick="closeConfirm(this)"><button type="button" class="btn btn-primary" title="Close"><i class="fa-solid fa-lock"></i></button></a>
                                        <?php endif ?>

                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php $this->load->view('backend/_partials/footer') ?>
        </div>
    </main>
</body>

</html>

<?php if ($this->session->flashdata('message')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('message') ?>'
        })
    </script>
<?php endif ?>

<!-- Datatable -->
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            buttons: ['copy', 'excel', 'pdf', 'print'],
            dom: "<'row '<'col-md-4'l> <'col-md-4'B> <'col-md-4'f>>" +
                "<'row '<'col-md-12'tr>>" +
                "<'row '<'col-md-5'i> <'col-md-7'p>>",
            lengthChange: true
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
</script>

<!-- Sweatalert JS -->
<script>
    function deleteConfirm(event) {
        Swal.fire({
            title: 'Cancel Confirmation!',
            text: 'Yakin cancel data ini?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya Cancel',
            confirmButtonColor: 'red'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.deleteUrl);
            }
        });
    }


    function closeConfirm(event) {
        Swal.fire({
            title: 'Close Confirmation!',
            text: 'Yakin close data ini?',
            icon: 'info',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya Close',
            confirmButtonColor: 'blue'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.closedUrl);
            }
        });
    }
</script>