<div class="jumbotron text-center" style="margin-bottom:0">
    <a href="/news"><h1><b>Tech News</b></h1></a>
    <p>Tüm Teknoloji haberleri burada</p>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="/news">Haberler</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <?php if (!isset($_SESSION['username'])): ?>
                <li class="nav-item active">
                    <a class="nav-link" href="/users/login">Giriş Yap </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/users/register">Kayıt Ol </a>
                </li>
            <?php else: ?>
                <li class="nav-item active">
                    <a class="nav-link" href="/users"> Profil </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/users/logout">Çıkış Yap </a>
                </li>
            <?php endif ?>
        </ul>
    </div>
</nav>