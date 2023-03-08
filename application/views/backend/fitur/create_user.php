<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">
            <div class="container my-4 col-6">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5>Tambah Data User</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama"><strong>Nama User</strong></label>
                                    <input type="text" class="form-control" name="nama" required maxlength="100" />
                                </div>
                                <div class="form-group">
                                    <label for="nip"><strong>NIP</strong></label>
                                    <input type="text" class="form-control" name="nip" required maxlength="20" />
                                </div>
                                <div class="form-group">
                                    <label for="email"><strong>Email</strong></label>
                                    <input type="text" class="form-control" name="email" required maxlength="100" />
                                </div>
                                <div class="form-group">
                                    <label for="no_kontak"><strong>No Kontak</strong></label>
                                    <input type="text" class="form-control" name="no_kontak" required maxlength="50" />
                                </div>
                                <div class="form-group">
                                    <label for="level"><strong>Level</strong></label>
                                    <select name="level" id="level" class="form-control" required>
                                        <option value="Petugas">Petugas</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username"><strong>Username</strong></label>
                                    <input type="text" class="form-control" id="username" name="username" required maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label for="password"><strong>Password</strong></label>
                                    <input type="password" class="form-control" id="password" name="password" required maxlength="100">
                                </div>
                                <div class="float-right">
                                    <a href="<?= site_url('backend/users'); ?>" class="btn btn-secondary">
                                        <i href="#" class="fa-solid fa-backward"></i> Kembali
                                    </a>
                                    <button type="submit" id="save" value="save" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
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
            icon: 'warning',
            title: '<?= $this->session->flashdata('message') ?>'
        })
    </script>
<?php endif ?>