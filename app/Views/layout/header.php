<!-- Page Header Start-->
<div class="page-header">
  <div class="header-wrapper row m-0">
    <form class="form-inline search-full col" action="#" method="get">
      <div class="form-group w-100">
        <div class="Typeahead Typeahead--twitterUsers">
          <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
          </div>
          <div class="Typeahead-menu"></div>
        </div>
      </div>
    </form>
    <div class="header-logo-wrapper col-auto p-0">
      <div class="logo-wrapper"><a href="<?= base_url("dashboard") ?>"> <?=env('TITLE')?></a></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    <!-- <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
      <div class="notification-slider">
        <div class="d-flex h-100"> <img src="<?= base_url() ?>cuba/assets/images/giftools.gif" alt="gif">
          <h6 class="mb-0 f-w-400"><span class="font-primary">Don't Miss Out! </span><span class="f-light">Quota is limited.</span></h6><i class="icon-arrow-top-right f-light"></i>
        </div>
        <div class="d-flex h-100"><img src="<?= base_url() ?>cuba/assets/images/giftools.gif" alt="gif">
          <h6 class="mb-0 f-w-400"><span class="font-primary">ACEH JAYA</span><span class="f-light">Join us for better future</span></h6><a class="ms-1" href="#" target="_blank"></a>
        </div>
      </div>
    </div> -->
    <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
      <ul class="nav-menus">
        <li class="onhover-dropdown">
          <div class="notification-box">
            <svg>
              <use href="<?=base_url('cuba/assets/svg/icon-sprite.svg#notification')?>"></use>
            </svg><span class="badge rounded-pill badge-secondary" id="notification-count">0</span>
          </div>
          <div class="onhover-show-div notification-dropdown">
            <h6 class="f-18 mb-0 dropdown-title">Notifikasi </h6>
            <ul>
              <div class="notification-container">
              </div>
              <li><a class="f-w-700" href="#">Check all</a></li>
            </ul>
          </div>
        </li>
        <li class="profile-nav onhover-dropdown pe-0 py-0">
          <div class="media profile-media"><img class="b-r-10" src="<?php echo base_url('nubis/images/logo.png') ?>" width="35px" alt="">
            <?php if(isset($user)):?>
              <div class="media-body"><span class="text-capitalize"><?= $user->username??"" ?></span>
              <p class="mb-0 font-roboto">User <i class="middle fa fa-angle-down"></i></p>
              </div>
              <ul class="profile-dropdown onhover-show-div">
              <li><a href="<?= base_url('logout')?>"><i data-feather="log-in"> </i><span>Sign Out</span></a></li>
            </ul>
            <?php endif;?>
          </div>          
        </li>
      </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">                        
        <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
        <div class="ProfileCard-details">
          <div class="ProfileCard-realName">{{name}}</div>
        </div>
      </div>
    </script>
    <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
  </div>
</div>
<!-- Page Header Ends -->