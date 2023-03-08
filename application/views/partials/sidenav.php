<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->

                    <a href="<?= site_url() ?>" class="logo">
                        <img width="70px" height="70px" src="<?= base_url('assets/global/img/pngwing.com.png') ?>">

                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <form method="post" action="<?= site_url('page/cari') ?>">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari" aria-label="Cari" id="cari" name="cari" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
                                    <input type="submit" class="btn btn-dark" id="search" value="Cari">
                                </div>
                            </div>
                        </form>
                        <li class="scroll-to-section"><a href="<?= site_url() ?>" class="active">Home</a></li>
                        <?php if ($activeUser) : ?>
                            <li class="scroll-to-section"><a href="<?= site_url('page/penawaran') ?>">Riwayat </a></li>
                            <li class="scroll-to-section"><a href="<?= site_url('page/lelang') ?>">Lelang</a></li>

                            <li class="scroll-to-section"><a href="<?= site_url('page/edit') ?>">Hi, <?= $activeUser->nama ?></a></li>
                            <li class="scroll-to-section"><a href="<?= site_url('page/change') ?>">Ganti password</a></li>

                            <li class="scroll-to-section"><a href="<?= site_url('page/logout') ?>">logout</a></li>
                        <?php endif ?>
                        <?php if (!$activeUser) : ?>
                            <li class="scroll-to-section"><a href="<?= site_url('page/login') ?>">sign In</a></li>
                            <li class="scroll-to-section"><a href="<?= site_url('page/register') ?>">Registrasi</a></li>
                        <?php endif ?>

                        <!-- <li class="submenu">
                                <a href="javascript:;">Features</a>
                                <ul>
                                    <li><a href="#">Features Page 1</a></li>
                                    <li><a href="#">Features Page 2</a></li>
                                    <li><a href="#">Features Page 3</a></li>
                                    <li><a rel="nofollow" href="https://templatemo.com/page/4" target="_blank">Template Page 4</a></li>
                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="#explore">Explore</a></li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a> -->
                        <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->