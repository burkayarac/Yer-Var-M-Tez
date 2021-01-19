<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yer Var Mı - Anasayfa</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/angular.min.js"></script>
</head>
<body ng-app="loginApp" ng-controller="loginController">
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="row no-gutters justify-content-center">
                <div class="card login-card">
                    <div class="card-body">
                        <div class="brand-wrapper d-flex align-items-center">
                            <img src="../images/logo.png" alt="logo" class="logo">
                            <h3 class="pl-2">Yer Var Mı - Firma Girişi</h3>
                        </div>
                        <form ng-submit="login()">
                            <div class="form-group">
                                <label for="email" class="sr-only">E-Posta</label>
                                <input type="email" name="email" id="email" class="form-control" ng-model="user.email" placeholder="E-Posta Adresi" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password" class="sr-only">Şifre</label>
                                <input type="password" name="password" id="password" class="form-control" ng-model="user.password" placeholder="***********" required>
                            </div>
                            <button class="btn btn-block login-btn mb-4" type="submit">Giriş Yap</button>
                        </form>
                        <nav class="login-card-footer-nav">
                            <a href="#!">Kullanım Şartları.</a>
                            <a href="#!">Gizlilik Politikası</a>
                        </nav>
                    </div>
                </div>
          </div>
        </div>
      </main>
</body>
<script>
    var app = angular.module('loginApp',[]);
    app.controller('loginController',function($scope) {
        var parent = $scope;
        parent.login = function() {
            $.ajax({
                type:"POST",
                url:"../api/company/login",
                data:parent.user,
                success:function(res) {
                    console.log(res);
                    if(res.status=="success") {
                        location.href='/firma';
                    } else {
                        alert(res.message);
                    }
                },
                error:function(err) {
                    alert("Sistemde beklenmedik bir hata oluştu");
                    console.log(err);
                }
            });
        }
    });
</script>
</html>
