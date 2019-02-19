
<?php include $path . '/modules/head.php'; ?>
<?php include $path . '/modules/header.php';?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <div class="main-area">
        <h2><?=isset($_SESSION) ? 'Your Account' : 'Sign into your account'?></h2>
    </div>
    <div class="main-room">
                 <?php
                if (isset($message)) {
                    echo $message;
                }
                if(isset($_SESSION['clientData']) && $_SESSION['clientData']){?>
                    <p>Name: <?=$_SESSION['clientData']['clientfirstname']. ' '. $_SESSION['clientData']['clientlastname']?></p>
                    <p>Email: <?=$_SESSION['clientData']['clientemail']?></p>
                    <p>Access Level: <?=$_SESSION['clientData']['clientlevel']?></p>
                    <a href="?f=account&a=signOut">Sign Out</a>


                <?php } else { ?>
        <form action="?f=account&a=signin" method="POST">
                    <p><input type="email" required placeholder="Email Address" name="email" 
                           id="email"  <?php
                           if (isset($email)) {
                               echo "value='$email'";
                           }
                           ?>></p>
                    <p><input type="password" required placeholder="Password"
                           name="password"  id="password"
                           pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></p>
                    <button type="submit" >Login</button>
                    <input type="hidden" name="action" value="login">
                </form>
                <p><a href="?f=account&a=register">Create Account</a></p>

                <?php } ?>
    </div>
</main>

<?php include $path . '/modules/footer.php'; ?>
