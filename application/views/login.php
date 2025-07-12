<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Page - Stock App</title>
        <link href="<?= base_url() ?>css/styles.css" rel="stylesheet" />
        <link href="<?= base_url('assets/3139263.png'); ?>" rel="icon" type="image/gif" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main><br>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><img src="../assets/Stock_App-BranDW-removebg-preview.png" alt="logo" width="100%"></div>
                                    <div class="card-body">
                                        <form method="post" action="<?= base_url('login/cek_login'); ?>">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <div class="input-group">
                                                    <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                            <i class="fas fa-eye" id="eyeIcon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-dark btn-lg btn-block" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>js/scripts.js"></script>

        <!-- Show Hide Password-->
        <script>
            document.getElementById('togglePassword').addEventListener('click', function() {
                const passwordInput = document.getElementById('inputPassword');
                const eyeIcon = document.getElementById('eyeIcon');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        </script>

    </body>
</html>