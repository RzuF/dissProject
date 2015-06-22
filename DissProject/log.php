<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>DissProject</title>
    <link rel="stylesheet" type="text/css" href="template/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="template/css/style.css">
</head>
<body>
    <?php include("nav.html"); ?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Logowanie</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Zarejestruj się</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="login.php" method="post" role="form" style="display: block;">
                                <div class="form-group">
                                    <input type="text" name="login" id="username" tabindex="1" class="form-control" placeholder="Login" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="psswd" id="passsword" tabindex="2" class="form-control" placeholder="Hasło">
                                </div>
                                <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3" class="" name="rem" id="remember">
                                    <label for="remember"> Zapamiętaj mnie</label>
                                    <input type="hidden" name="go" value="1">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Zaloguj">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="#" tabindex="5" class="forgot-password">Zapomniałeś hasła?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Zmiana wyglądu i walidacja danych w JS -->
                            <form id="register-form" action="#" method="post" role="form" style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Nazwa użytkownika" value="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
                                </div>
                                <div class="form-group">
                                    <!-- <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Hasło"> -->
                                    <input type="password" class="form-control" name="password" id="password" tabindex="2" placeholder="Hasło" required data-toggle="popover" title="Siła hasła" data-content="Wprowadź hasło...">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Powtórz hasło">
                                </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Rejesracja">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="template/js/angular.min.js"></script>
    <script src="template/js/bootstrap.min.js"></script>
    <script src="template/js/script.js"></script>
    <script src="template/js/password.js"></script>
</body>
</html