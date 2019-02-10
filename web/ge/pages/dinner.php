
<?php include $_SERVER['DOCUMENT_ROOT'] . '/ge/modules/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/ge/modules/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <div class="main-area">
    <h1><?=$page_title?></h1>
        <?php if(isset($recipes) && count($recipes)) { 
            foreach($recipes as $recipe){
                echo "<a href='recipes/?recipe_id={$recipe['id']}' title='{$recipe['title']}'>{$recipe['title']}</a><br>";
            }
        }else{ ?>
        <h2>Sorry, no recipes for this category yet.</h2>
        <?php } ?>
    </div>
    <div class="main-room">
        <div class="editable-content">
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/ge/modules/footer.php'; ?>
