<?php
//    if(session_status() === PHP_SESSION_NONE){
//        session_start();
//    }
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/tickets">PHP TICKETS</a>
        <div class="menu" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/tickets">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tickets/register">Register</a>
                </li>
                <?php
                    if(isset($_SESSION['username'])){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/tickets/profile"><?php echo htmlspecialchars($_SESSION['username'])?>'s profile</a>
                </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/tickets/logout">Log Out [<?php echo htmlspecialchars($_SESSION['username'])?>]</a>
                        </li>
                <?php } else {?>
                <li class="nav-item">
                    <a class="nav-link" href="/tickets/login">Log In</a>
                </li> <?php }?>
            </ul>
        </div>
    </nav>
</header>