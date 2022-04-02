<?php

   setFileName('ui_components/header.php');

?>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
            <a href="index.php" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="assets/images/logo.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo.png" alt="" height="20">
                </span>
            </a>

            <a href="index.php" class="logo logo-light">
                <span class="logo-sm">
                    <img src="assets/images/logo.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo.png" alt="" height="20">
                </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
            <i class="fa fa-fw fa-bars"></i>
        </button>

            <!-- App Search --
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form> -->

        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">
        
                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-translate-2  font-size-22"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
        
                    <!-- item-->
                    <a class="dropdown-item notify-item" onclick="setLanguage('en');">
                        <img src="assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                    </a>

                    <!-- item-->
                    <a class="dropdown-item notify-item" onclick="setLanguage('hy');">
                        <img src="assets/images/flags/hy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">հայերեն</span>
                    </a>

                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                    </a> -->

                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                    </a> -->
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    <span class="noti-dot"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> <?=t('Notifications')?> </h6>
                            </div>
                            <!-- <div class="col-auto">
                                <a href="pages-starter.html#!" class="small"> <?//=t('View All')?></a>
                            </div> -->
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;" id="addNotifications">
                        <!-- <a href="" class="text-reset notification-item">
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs me-3 mt-1">
                                    <span class="rounded-circle font-size-16">
                                        <i class="ri-notification-3-fill"></i>
                                    </span>
                                    <!-- <div class="noti-top-icon">
                                        <i class="mdi mdi-heart text-white bg-danger"></i>
                                    </div> --
                                </div>
                                <div class="flex-grow-1 text-truncate">
                                    <h6 class="mt-0 mb-1">Order placed <span
                                            class="mb-1 text-muted fw-normal">If several languages the
                                            grammar</span></h6>
                                    <p class="mb-0 font-size-12"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                </div>
                            </div>
                        </a> -->
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="notifications.php">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> <?=t('ViewAll')?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-2.jpg"
                        alt="Header Avatar"> -->
                    <i class="ri-account-circle-line font-size-22"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> <?=$_COOKIE['fullName']?> </h6>
                            </div>
                            <!-- <div class="col-auto">
                                <a href="pages-starter.html#!" class="small"> Available</a>
                            </div> -->
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                    <!-- item-->
                    <!-- <a href="" class="text-reset notification-item">
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs me-3 mt-1">
                                <span class="avatar-title bg-soft-primary rounded-circle font-size-16">
                                    <i class="ri-user-line text-primary font-size-16"></i> 
                                </span>
                            </div>
                            <div class="flex-grow-1 text-truncate">
                                <h6 class="mb-1">Profile</h6>
                                <p class="mb-0 font-size-12">View personal profile details.</p>
                            </div>
                        </div>
                    </a>
                    <!-- item--
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs me-3 mt-1">
                                <span class="avatar-title bg-soft-warning rounded-circle font-size-16">
                                    <i class="ri-wallet-2-line text-warning font-size-16"></i> 
                                </span>
                            </div>
                            <div class="flex-grow-1 text-truncate">
                                <h6 class="mb-1">My Wallet</h6>
                                <p class="mb-0 font-size-12">Modify your personal details.</p>
                            </div>
                        </div>
                    </a>
                    <!-- item--
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs me-3 mt-1">
                                <span class="avatar-title bg-soft-secondary rounded-circle font-size-16">
                                    <i class="ri-settings-2-line text-secondary"></i> 
                                </span>
                            </div>
                            <div class="flex-grow-1 text-truncate">
                                <h6 class="mb-1">Settings <span class="badge bg-success float-end mt-1">11</span></h6>
                                <p class="mb-0 font-size-12">Manage your account parameters.</p>
                            </div>
                        </div>
                    </a>
                    <!-- item--
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs me-3 mt-1">
                                <span class="avatar-title bg-soft-primary rounded-circle font-size-16">
                                    <i class="ri-lock-unlock-line text-primary"></i> 
                                </span>
                            </div>
                            <div class="flex-grow-1 text-truncate">
                                <h6 class="mb-1">Lock screen </h6>
                                <p class="mb-0 font-size-12">Control your privacy parameters..</p>
                            </div>
                        </div>
                    </a> -->
                </div>
                    <!-- item-->
                    <div class="pt-2 border-top">
                    <div class="d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="../users/usersApi.php?signOut">
                            <i class="ri-shut-down-line align-middle me-1"></i> <?=t('Logout')?>
                        </a>
                    </div>
                </div>
                </div>
            </div>

            <!-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="ri-settings-2-line"></i>
                </button>
            </div> -->

        </div>
    </div>
    <script>
        let loc = window.location.pathname;
        let dir = loc.substring(0, loc.lastIndexOf('/'));
        function setLanguage(langCode){
            (async () => {
                let loc = window.location.pathname;
                let dir = loc.substring(0, loc.lastIndexOf('/'));
                const data = await fetch(`${dir}/translation_service/coreApi/languageApi.php?setLanguage&langCode=${langCode}`);
                const response = await data.text();
                // console.log(response);
                location.reload();
            })();
        };

        function timeSince(date) {

            var seconds = Math.floor(((new Date()/1000) - date));

            var interval = seconds / 31536000;

            if (interval > 1) {
                return Math.floor(interval) + " <?=t('year')?> <?=t('ago')?>";
            }
            interval = seconds / 2592000;
            if (interval > 1) {
                return Math.floor(interval) + " <?=t('months')?> <?=t('ago')?>";
            }
            interval = seconds / 86400;
            if (interval > 1) {
                return Math.floor(interval) + " <?=t('days')?> <?=t('ago')?>";
            }
            interval = seconds / 3600;
            if (interval > 1) {
                return Math.floor(interval) + " <?=t('hours')?> <?=t('ago')?>";
            }
            interval = seconds / 60;
            if (interval > 1) {
                return Math.floor(interval) + " <?=t('minutes')?> <?=t('ago')?>";
            }
            return Math.floor(seconds) + " <?=t('seconds')?> <?=t('ago')?>";
        }
        function truncate(input, length) {
            if (input.length > length) {
                return input.substring(0, length-3) + '...';
            }
            return input;
        };
        (function getUnreadMessages(){
            (async () => {
                const data = await fetch(`${dir}/notifications/internal/internalApi.php?getNotificationsByUserId&user_id=<?=$user_id?>&unread=1&from=0&count=6`);
                const notifications = await data.json();
                // console.log(notifications);

                let notificationsDiv = document.getElementById('addNotifications');
                notifications.forEach(value => {
                    notificationsDiv.insertAdjacentHTML('beforebegin', `
                        <a href="${dir}/notifications.php?message_id=${value.notification_id}&message=${value.message}" class="text-reset notification-item">
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs me-3 mt-1">
                                    <span class="rounded-circle font-size-22">
                                        <i class="ri-notification-3-fill"></i>
                                    </span>
                                    <div class="noti-top-icon">
                                        <i class="mdi mdi-heart text-white bg-danger"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-truncate">
                                    <h6 class="mt-0 mb-1">${truncate(value.message, 30)}</h6>
                                    <p class="mb-0 font-size-12"><i class="mdi mdi-clock-outline"></i> ${timeSince(value.date,30)}</p>
                                </div>
                            </div>
                        </a>
                    `);
                
                });
            })();
        })();
    </script>
</header>