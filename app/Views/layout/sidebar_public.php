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
            <a class="sidebar-link sidebar-title " href="<?= url_to('/') ?>">
              <svg class="stroke-icon">

                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-home"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-home"></use>
              </svg><span>Informasi</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="<?= url_to('datamahasiswa') ?>">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-user"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-user"></use>
              </svg><span>Mahasiswa</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="<?= url_to('lowonganpublic') ?>">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-file"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-social"></use>
              </svg><span>Lowongan</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="<?= url_to('jadwal') ?>">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-social"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-social"></use>
              </svg><span>Jadwal Tes Pendaftar</span>
            </a>
          </li>
          
          <?php if(service('authentication')->check()):?>
            <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="<?= url_to('dashboard') ?>">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#stroke-user"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>cuba/assets/svg/icon-sprite.svg#fill-user"></use>
              </svg><span>Admin Dashboard</span>
            </a>
          </li>
            <?php endif;?>

        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>