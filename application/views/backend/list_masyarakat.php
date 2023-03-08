<!DOCTYPE html>
<html Lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>
<body>    
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>
        
        <div class="content">
            <h4>Data Masyarakat</h4>
            
            <!-- Start kodingan di sini -->
            <table id="masyarakat" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Tgl Register</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($masyarakat as $m) : ?>
                        <tr>
                            <th><?= $m->nik ?></th>
                            <td><?= $m->nama ?></td>
                            <td><?= $m->jk ?></td>
                            <td><?= $m->email ?></td>
                            <td><?= $m->no_hp ?></td>
                            <td><?= $m->alamat ?></td>
                            <td><?= $m->tgl_join ?></td>
                            <td><?= $m->status == 1 ? "Aktif" : "Non-aktif" ?></td>
                            <td>
                            <?php if ($m->status == 1 && $activeUser->level == "Admin") : ?>
                           <a href="<?= base_url('backend/masyarakat/blokir/'. $m->id_masyarakat) ?>" data="#" class="btn btn-danger"><i class="fa-solid fa-user-lock" aria-hidden="true" title="blok"></i></a>
                           <?php endif?>
                           <?php if ($m->status == 0 && $activeUser->level == "Admin") : ?>
                            <a href="<?= base_url('backend/masyarakat/aktifkan/'. $m->id_masyarakat) ?>" data="#" class="btn btn-success "><i class="fa-solid fa-lock-open" title="aktifkan"></i> </a>
                            
                            <?php endif?>
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
        var table = $('#masyarakat').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy','csv','excel','pdf','print'
            ]
        });
    });
</script>