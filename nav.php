<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

<style>
    .navbar {
        background: white;
        border-color: #09F;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 4px 0 rgba(0, 0, 0, 0.19);

    }

    .navbar-default .navbar-toggle {
        border-color: #FFF;
        background: #fff;
    }

    #bs-example-navbar-collapse-1 li:hover {
        background: #fff;
        box-shadow: 0px 5px #51C1F1 inset;
        /*เส้นข้างบนแถบ*/
    }

    #search-input {
        border: 3px solid pink;
    }

    input:focus {
        background-color: pink;
    }
</style>
<div align="center" style="background-color: white;">
    <a href="index.php"><img src="./img/pandaralogo.png" width="20%"></a>
</div>

<div class="header123">
    <?php if (isset($_SESSION['email'])) : ?>

</div>
<nav class="navbar navbar-expand-lg navbar-light" aria-label="Ninth navbar example">
    <div class="container-xl">
        <a class="navbar-brand" href="index.php"> <img src="./img/logo.png" width="30px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample06">
            <ul class="navbar-nav me-auto mb- mb-lg-1">
                <li class="nav-item active">
                    <a class="nav-link" aria-current="page" href="ring.php">Rings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="charm.php" aria-current="page">Charm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bracelet.php" aria-current="page">Bracelet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="necklace.php" aria-current="page">Necklace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="earring.php" aria-current="page">Earings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="location.php" aria-current="page"><i class="bi bi-geo-alt-fill"></i></a>
                </li>
                <li>
                    <form action="search.php" method="GET" style="margin-top: 5px; margin-left:300px">
                        <input type="text" name="keyword" id='search-input' />
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </li>
            </ul>
            <?php if (isset($_SESSION['email'])) : ?>
                <a href="profile.php" class="navbar-brand" style="margin-right: 50px;">Profile</strong></a>
                <a class="navbar-brand" href="index.php?logout='1'" style="color: red;">Logout</a>
                <?php if ($_SESSION['email'] == 'admin@admin.com') : ?>
                    <a class="navbar-brand" style="color: red;" href="admin.php">Admin</a>
                <?php endif; ?>
                <?php
                $count = 0;
                if (isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                }
                ?>
                <a href="cart.php"> <button type="submit" class="btn btn-outline-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                        </svg>
                        <?php if ($count != 0) {
                            echo '(' . $count . ')';
                        } ?>
                        <span class="visually-hidden">Button</span>

                    </button></a>
                <p></p>
            <?php else : ?>
                <a class="navbar-brand" href="login.php">login</a>
            <?php endif ?>

        </div>
    </div>
</nav>
<?php endif; ?>
</div>