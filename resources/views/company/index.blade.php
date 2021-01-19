<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yer Var Mı - Anasayfa</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/angular.min.js"></script>
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body ng-app="indexApp" ng-controller="indexController">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/firma">
                <img src="../images/logo.png" width="40" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/firma">Anasayfa <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
            <a href="../api/company/logout" class="btn btn-danger ml-auto" name="cikisyap" type="button">Çıkış Yap</a>
          </nav>
    </header>
    <div class="container-fluid mt-2">
        <div class="card card-rounded">
            <h5 class="card-header">
                Mevcut Rezervasyonlar
            </h5>
            <div class="card-body">
                <div class="d-flex justify-content-center" ng-show="loading">
                    <img src="../images/loading.svg" width="80" alt="Loader">
                </div>
                <div class="alert alert-warning ng-hide" ng-show="!companyState && !loading" role="alert">
                    Firmanızın Bütün Bilgilerini Doldurmadığınızdan (İletişim,Kroki ve Masa) Firmanız Müşteri Tarafından Listelenmemektedir.
                </div>
                <table class="table table-borderless ng-hide" ng-show="companyState && !loading">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Müşteri Adı</th>
                            <th>Masa No</th>
                            <th>Rezervasyon Başlangıç Tarihi</th>
                            <th>Rezervasyon Bitiş Tarihi</th>
                            <th>Toplam Fiyat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Aykut Kalaz</td>
                            <td>1</td>
                            <td>20.01.2021 - 09:00</td>
                            <td>20.01.2021 - 11:00</td>
                            <td>100 TL</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    var app = angular.module('indexApp',[]);
    app.controller('indexController',function($scope) {
        var parent = $scope;
        parent.loading = true;
        parent.companyState = false;
        parent.compState = function() {
            $.ajax({
                type:"GET",
                url:"../api/company/state",
                xhrFields: {withCredentials: true},
                success:function(res) {
                    console.log(res);
                    if(res == 1)
                        parent.companyState = true;
                },
                error:function(err) {
                    console.log(err);
                }
            }).done(function() {
                parent.loading = false;
                parent.$apply();
            })
        }
        parent.compState();
    });
</script>
</html>
