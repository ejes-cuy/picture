<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/header'); ?>
</head>
<br>
<br>
<br>
<br>
<br>

<body>
    <?php $this->load->view('partials/sidenav') ?>

    <div class="container col-5 m-4 mx-auto justify-content-center">
        <div class="card p-5 ">
            <div style="color:#477a7d">
                <h5 class="text-center">Sign in</h1>
                    <hr>
            </div>
            <div class="card-body">
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="email" class="form-control" name="email" required maxlength="100" />
                    </div>
                    <div class="form-group">
                        <label for="password"><strong>Password</strong></label>
                        <input type="password" class="form-control" id=" password" name="password" required maxlength="100">
                        <div class="form-group text-danger">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="submit" id="save" value="save" class="btn btn-dark"><i class="fa-regular fa-floppy-disk"></i> Lanjutkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view('partials/footer'); ?>
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