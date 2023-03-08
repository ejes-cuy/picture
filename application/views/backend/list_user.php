<!DOCTYPE html>
<html Lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">
            <h4>Data User</h4>


            <!-- Start kodingan di sini -->
            <table id="users" class="table">

                <thead class="thead-dark">
                    <a class="btn btn-success mb-2" href="<?= site_url('backend/users/add') ?>">Tambah Data</a>
                    <tr>

                        <th>Username</th>
                        <th>Nip</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No hp</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u) : ?>
                        <tr>

                            <td><?= $u->username ?></td>
                            <td><?= $u->nip ?></td>
                            <td><?= $u->nama ?></td>
                            <td><?= $u->email ?></td>
                            <td><?= $u->no_hp ?></td>
                            <td><?= $u->level ?></td>

                            <td><?= $u->status == 1 ? "Aktif" : "Non-aktif" ?></td>
                            <td>
                                <?php if (($activeUser->level == "Admin" || $activeUser->id_user == $u->id_user) && $u->status <> 0) : ?>
                                    <a href="<?= site_url('backend/users/edit/' . $u->id_user) ?>">
                                        <button type="button" class="btn btn-warning" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </a>
                                    <a href="<?= site_url('backend/users/change/' . $u->id_user) ?>">
                                        <button type="button" class="btn btn-info" title="Change Password">
                                            <i class="fa-solid fa-lock"></i>
                                        </button>
                                    </a>
                                <?php endif ?>
                                <!-- hapus-->
                                <?php if ($u->status == 1 && $activeUser->level == "Admin") : ?>
                                    <a href="#" data-delete-url="<?= site_url('backend/users/blokir/' . $u->id_user) ?>" onclick="deleteConfirm(this)">
                                        <button type="button" class="btn btn-success" title="Hapus">
                                            <i class="fa-solid fa-delete-left"></i>
                                        </button>
                                    </a>
                                <?php endif ?>

                            </td>
                        </tr>

                    <?php endforeach ?>

                </tbody>

            </table>
            <!-- End -->


            <?php $this->load->view('backend/_partials/footer') ?>
        </div>
    </main>

</body>

</html>

</html>
<?php if ($this->session->flashdata('message')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
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

<script>
    $(document).ready(function() {
        var table = $('#users').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
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