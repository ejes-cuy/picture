<aside class="side-nav" style="height:auto; min-height:100vh;">
    <div class="brand">
        <img src="<?= base_url('assets/global/img/pngwing.com.png'); ?>" width="75%" height="50%" alt="">
        <h3>Lelang Tanaman</h3>
    </div>
    <br>

    <nav>
        <a href="<?= site_url('backend/dashboard') ?>">Dashboard</a>

        <?php if ($activeUser->level == "Admin") : ?>
            <a href="<?= site_url('backend/masyarakat') ?>">Masyarakat</a>
        <?php endif ?>
        <a href="<?= site_url('backend/users') ?>">User</a>

        <?php if ($activeUser->level == "Petugas") : ?>
            <a href="<?= site_url('backend/barang') ?>">Kelola Barang</a>
            <a href="<?= site_url('backend/lelang') ?>">Lelang</a>
            <a href="<?= site_url('backend/penawaran') ?>">Penawaran</a>
            <a href="<?= site_url('backend/laporan') ?>">Laporan</a>
        <?php endif ?>

        <a href="<?= site_url('backend/auth/logout') ?>">Logout</a>
    </nav>
</aside>