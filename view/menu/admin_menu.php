<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar1">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Zaposleni</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/employee/insert/"><i class="fa fa-plus" aria-hidden="true"></i>
                        Unos novog</a>
                    <a class="dropdown-item" href="/employee/"><i class="fa fa-table" aria-hidden="true"></i> Prikaz svih</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Dobavljač</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/supplier/insert/"><i class="fa fa-plus" aria-hidden="true"></i>
                         Unos novog</a>
                    <a class="dropdown-item" href="/supplier/"><i class="fa fa-table" aria-hidden="true"></i> Prikaz svih</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Mesto</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/place/insert/"><i class="fa fa-plus" aria-hidden="true"></i>
                         Unos novog</a>
                    <a class="dropdown-item" href="/place/"><i class="fa fa-table" aria-hidden="true"></i> Prikaz svih</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Pozicija</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/position/insert/"><i class="fa fa-plus" aria-hidden="true"></i>
                        Unos nove</a>
                    <a class="dropdown-item" href="/position/"><i class="fa fa-table" aria-hidden="true"></i> Prikaz svih</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Statistika</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/statistic/orderForm/"><i class="fa fa-pie-chart" aria-hidden="true"></i> Narudžbenica</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false"><?= $_SESSION['user']['username']; ?></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/user/profile/"><i class="fa fa-user" aria-hidden="true"></i>
                        Profil</a>
                    <a class="dropdown-item" href="/login/logout/"><i class="fa fa-sign-out" aria-hidden="true"></i>
                        Odjava</a>
                </div>
            </li>
        </ul>
    </div>
</nav>