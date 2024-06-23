<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
  <div>
    <div class="logo-wrapper"><a href="<?= base_url("/") ?>"><img class="img-fluid for-light" src="<?= base_url() ?>assets/img/logo/nse.png" alt=""><img class="img-fluid for-dark" src="<?= base_url() ?>assets/img/logo/nse-dark.png" alt=""></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="<?= base_url("/") ?>"><img class="img-fluid" src="<?= base_url() ?>assets/img/logo/nse-icon.png" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn">
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title " href="<?=url_to('dashboard')?>">
              <svg class="stroke-icon">
                
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-home"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-home"></use>
              </svg><span>Profile</span>
            </a>
          </li>
              <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="<?=url_to('user')?>">
                  <svg class="stroke-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-user"></use>
                  </svg>
                  <svg class="fill-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-social"></use>
                  </svg><span>Data User</span>
                </a>
              </li>
          <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="<?=url_to('mahasiswa')?>">
                  <svg class="stroke-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-user"></use>
                  </svg>
                  <svg class="fill-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-social"></use>
                  </svg><span>Data Siswa</span>
                </a>
              </li>
              <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="<?=url_to('perusahaan')?>">
                  <svg class="stroke-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-file"></use>
                  </svg>
                  <svg class="fill-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-social"></use>
                  </svg><span>Relasi</span>
                </a>
              </li>
              <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="<?=url_to('lowongan')?>">
                  <svg class="stroke-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-social"></use>
                  </svg>
                  <svg class="fill-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-social"></use>
                  </svg><span>Lowongan</span>
                </a>
              </li>
              <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="<?=url_to('jadwaltes')?>">
                  <svg class="stroke-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#clock"></use>
                  </svg>
                  <svg class="fill-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-social"></use>
                  </svg><span>Jadwal Tes</span>
                </a>
              </li>
              <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="<?=url_to('informasi')?>">
                  <svg class="stroke-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#notification"></use>
                  </svg>
                  <svg class="fill-icon">
                    <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-social"></use>
                  </svg><span>Informasi</span>
                </a>
              </li>
          <?php if($user):?>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title" href="<?=url_to('logout')?>">
                <svg class="stroke-icon">
                  <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-faq"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-faq"></use>
                </svg><span>Sign Out</span>
              </a>
            </li>
          <?php endif;?>
          
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>