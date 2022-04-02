    <?php 
 
        require_once(__DIR__."/users/users.php");
        $user = new Users;
        if($user->isSignIn()){
            header("Location: index.php", TRUE , 302);
        }
        $pageName = 'SignIn';

        include_once(__DIR__."/ui_components/head.php"); 
        setFileName('signIn.php');

    ?>
    <body class="authentication-bg d-flex align-items-center min-vh-100 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="index.html" class="d-block auth-logo">
                            <img src="assets/images/logo.png" alt="" height="24" class="logo logo-dark mx-auto">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="p-4">
                    <div class="card overflow-hidden mt-2">
                        <div class="auth-logo text-center bg-primary position-relative">
                            <div class="img-overlay"></div>
                            <div class="position-relative pt-4 py-5 mb-1">
                                <h5 class="text-white"><?=t('WelcomeBack')?></h5>
                            <p class="text-white-50 mb-0"><?=t('SignInToContinue')?></p>
                            </div>
                        </div>
                        <div class="card-body position-relative">
                            <div class="p-4 mt-n5 card rounded">
                                <form class="form-horizontal" action="users/usersApi.php">
                                    <input type="hidden" name="signIn">
                                    <div class="mb-3">
                                        <label for="username" class="form-label"><?=t('Username')?></label>
                                        <input type="text" class="form-control" id="username" placeholder="<?=t('EnterUsername')?>" name="username">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userpassword"><?=t('Password')?></label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="<?=t('EnterPassword')?>" name="password">        
                                    </div>
                                    
                                    <div class="form-check mt-3">
                                        <input type="checkbox" class="form-check-input" id="auth-remember-check" name="rememberMe">
                                        <label class="form-check-label" for="auth-remember-check"><?=t('RememberMe')?></label>
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit"><?=t('LogIN')?></button>
                                    </div>
                                    <?=(isset($_GET['error'])) ? '
                                    <div class="mt-3 text-center">
                                        <p class="text-danger"><?=t("WrongCred")?></p>
                                    </div> ' : ''?>
                                    <!-- <div class="mt-4 text-center">
                                        <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <!-- <p>Don't have an account ?<a href="auth-register.html" class="fw-bold"> Register</a> </p> -->
                        <p>© <script>document.write(new Date().getFullYear())</script> <?=t('CreatedWith')?> <i class="mdi mdi-heart text-danger"></i> <?=t('byOkayCode')?></p>
                    </div>
                </div>
                </div>
            </div>

        </div>

        <?php include_once(__DIR__."/ui_components/foot.php"); ?>