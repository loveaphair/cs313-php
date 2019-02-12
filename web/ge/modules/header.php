<div class="boss-containing-box">
<header>
    <a href="/"><img src="images/ge_banner.jpg" title="Gourmet Escape" alt="Gourmet Escape" class="header-img" ></a>
    <div class="pure-g">
        <div class="pure-u-2-3 header-left">
            
        </div>
        <div class="pure-u-1-3">
            <div class="header-right">
                <?php if(!isset($_SESSION['loggedin'])){ ?>
                    <div class="header-icons"><a href="#"><i class="fas fa-user"></i><br><span style="font-size:70%">login</span></a></div>
                <?php }else {?>
                    <div class="header-icons"><a href="#"><i class="far fa-user"></i><br><span style="font-size:70%"><?=$_SESSION['first_name']?></span></a></div>
                <?php } ?>
            </div>
        </div>
    </div>
</header>
