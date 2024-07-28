<?php
?>
<div class="custom-bg">
    <div class="na">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Elito Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if (!isset($_SESSION['login'])): ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                            </li>
                            
                        <?php else: ?>

                            <li class="nav-item">
                                <a class="nav-link" href="cart.php">Keranjang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        <?php 
                        
                        ?>    
                        <?php endif; ?>
                       
                    </ul>
                    <form class="d-flex" role="search" method="post">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                        <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</div>
