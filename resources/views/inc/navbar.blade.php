<style>

    .container{
        right: 0;
        left: 0;
        top: 0;
    }
    .navbar {
        transition: all 0.4s;

    }
    .nav-item{
        margin-left: 0px;

    }
    .navbar .nav-link {
        font-size: 25px;
        color: rgb(63, 55, 55);
    }

    .navbar .nav-link:hover,
    .navbar .nav-link:focus {
        color:  rgb(189, 129, 129);
        text-decoration: none;

    }

    .navbar .navbar-brand {
        font-size: 40px;
        color: rgb(63, 55, 55);
        margin-right: 540px;
    }


    /* Change navbar styling on scroll */
    .navbar.active {
        background: rgb(255, 252, 252);
    }

    .navbar.active .nav-link {
        color: rgb(63, 55, 55);
    }

    .navbar.active .nav-link:hover,
    .navbar.active .nav-link:focus {
        color: #555;
        text-decoration: none;
    }

    .navbar.active .navbar-brand {
        color: rgb(255, 255, 255);
    }


    /* Change navbar styling on small viewports */
    @media (max-width: 991.98px) {
        .navbar {
            background: #fff;
        }

        .navbar .navbar-brand, .navbar .nav-link {
            color: #555;
        }
    }

    .navbar .navbar-collapse {
    width: 100%;
    padding-left: 120px;
  }

  .navbar .navbar-collapse .navbar-nav {
    width: 100%;
  }

</style>
@section('navbar')
<header class="navbar">
    <nav class="navbar navbar-expand-lg fixed-top py-3">

        <div class="container"><img src="https://image.flaticon.com/icons/png/512/290/290341.png" width="45" alt="" class="d-inline-block align-middle mr-2"><a href="/homepage" class="navbar-brand text-uppercase font-weight-bold">SHAW SHELTER</a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>

            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="/homepage" class="nav-link text-uppercase font-weight-bold">Home</a></li>
                    <li class="nav-item"><a href="/pets" class="nav-link text-uppercase font-weight-bold">Pets</a></li>
                    <li class="nav-item"><a href="/adopters" class="nav-link text-uppercase font-weight-bold">Adopters</a></li>
                    <li class="nav-item"><a href="/contact" class="nav-link text-uppercase font-weight-bold">Contact</a></li>
                    <li class="nav-item"><a href="/user/signin" class="nav-link text-uppercase font-weight-bold">Users</a></li>
                    <li class="nav-item"><a href="/login" class="nav-link text-uppercase font-weight-bold">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

