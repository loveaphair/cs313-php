
<?php include $path . '/modules/head.php'; ?>
<?php include $path . '/modules/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <div class="main-area">
    <h1><?=$page_title?></h1>
        <?php if(isset($recipes) && count($recipes)) { 
            foreach($recipes as $recipe){
                echo "<div><form name='recipe-link' action='?f=categories&a=deleteRecipe' method='POST'>
                <a href='?f=recipes&a={$recipe['id']}' title='{$recipe['title']}'>{$recipe['title']}</a>";
                if(isset($_SESSION) && $_SESSION['clientData']['clientlevel'] > 0){
                echo "<a href='?f=recipes&a=updateRecipeForm&rid={$recipe['id']}' title='edit this recipe'>[edit]</a>
                <a href='javascript:void(0);' class='delete-recipe' title='delete'> [delete]</a>
                <input type='hidden' name='rid' value='{$recipe['id']}'>
                <input type='hidden' name='catid' value='{$action}'>";
                }
                echo "</form></div>";
            }
        }else{ ?>
        <h2>Sorry, no recipes for this category yet.</h2>
        <?php } ?>
        <h4><a href="?f=recipes&a=updateRecipeForm&catId=<?=$_GET['a']?>" title="Create New Recipe">Create a new recipe</a></h4>
    </div>
    <div class="main-room">
        <div class="editable-content">
        </div>
    </div>
</main>

<script>
    var question = "Are you sure you want to delete this recipe?";
    $(function(){
        $('.delete-recipe').click(function(){
            var answer = confirm(question);
            if(answer){
                $(this).parent().submit();
             }else{
                return;
             }
        })
    });
</script>

<?php include $path. '/modules/footer.php'; ?>
