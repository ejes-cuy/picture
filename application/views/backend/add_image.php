<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">

            <div class="card-header bg-dark text-white">
                <h5>Tambah Gambar Barang</h5>
            </div>
            <br>
            <div class="col-md-12">
                <div mb-2>
                    <!-- Menampilkan flashh data (pesan saat data berhasil disimpan)-->
                    <?php if ($this->session->flashdata('message')) :
                        echo $this->session->flashdata('message');
                    endif; ?>
                </div>
                <div class="ibox-body">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="nama_barang" value="<?= $barang->nama_barang ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="gambar" name="gambar" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button type="submit" name="upadate" class="button button-primary" value="upadate">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class=" card-body border mt-2">
                <table id="example" class="table table-striped table-bordered small">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Gambar</th>
                            <th>Gambar</th>
                            <?php if ($barang->status <> "Sold") : ?>
                                <th>Action</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($gambar as $b) : ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $b->nama_gambar ?></td>
                                <td><img src="<?= empty($b->gambar) ? base_url('assets/images/no_image.png')  : base_url('upload/barang/' . $b->gambar) ?>" width="100px"></td>
                                <?php if ($barang->status <> "Sold") : ?>
                                    <td>
                                        <!-- Delete -->
                                        <a href="#" data-delete-url="<?= site_url('backend/barang/hapus_gambar/' . $b->id_gambar) ?>" onclick="deleteConfirm(this)"><button type="button" class="btn btn-danger" title="Hapus"><i class=" fa-solid fa-trash"></i></button></a>
                                    </td>
                                <?php endif ?>
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


<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>


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
            icon: 'info',
            title: '<?= $this->session->flashdata('message') ?>'
        })
    </script>
<?php endif ?>

<!-- Datatable -->
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            buttons: [],
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
            title: 'Delete Confirmation!',
            text: 'Yakin hapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya Hapus',
            confirmButtonColor: 'red'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.deleteUrl);
            }
        });
    }
</script>