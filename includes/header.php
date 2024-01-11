<script src="https://kit.fontawesome.com/2cf2b179fe.js" crossorigin="anonymous"></script>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/">TICKETASTIC</a>
        <div class="menu" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/"><span class="fa-solid fa-house"></span> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/events"><span class="fa-solid fa-calendar-days"></span> Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register"><span class="fa-solid fa-file-invoice"></span> Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact"><span class="fa-solid fa-address-book"></span> Contact Us</a>
                </li>
                <?php
                    if(isset($_SESSION['username'])){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/profile"><span class="fa-solid fa-user"></span> <?php echo htmlspecialchars($_SESSION['username'])?>'s profile</a>
                </li>
                        <?php
                        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                            ?>  <li class="nav-item">
                                <a class="nav-link" href="/adminDashboard"><span class="fa-solid fa-user-tie"></span> Admin dashboard</a>
                            </li> <?php }  ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout.php"><span class="fa-solid fa-right-from-bracket"></span> Log Out [<?php echo htmlspecialchars($_SESSION['username'])?>]</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cart"><span class="fa-solid fa-cart-shopping"></span> Cart</a>
                        </li>

                <?php } else {?>
                <li class="nav-item">
                    <a class="nav-link" href="/login"><span class="fa-solid fa-right-to-bracket"></span> Log In</a>
                </li> <?php }?>
                <?php
                if(isset($_SESSION['username'])){
                ?> <li class="nav-item">
                    <a class="nav-link" href="/shoppingCart/<?php echo htmlspecialchars($_SESSION['username'])?>"></a>
                </li> <?php } ?>
            </ul>
        </div>
    </nav>
</header>
