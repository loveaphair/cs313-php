
<?php include $_SERVER['DOCUMENT_ROOT'] . '/ge/modules/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/ge/modules/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <div class="main-area">
		<?php $recipe_html = '';
		if(isset($recipe_data)) {
			$ri = $recipe_data[0];
			$recipe_html = "<h2>{$ri['title']}</h2>";
			$recipe_html .= "<img src='../images/recipe_images/{$ri['image_file']}' width='100px'><h3>Ingredients</h3><ul>";
			foreach($ri['ingredients'] as $ing){
				$recipe_html .= "<li>{$ing['measurement_amt']} {$ing['mname']} {$ing['ingredient']}</li>";
			}
			$recipe_html .= "</ul>";
			$recipe_html .= "<p>" . str_replace('---', '</p><p>', $ri['instructions']) . "</p>";
        }else{ 
		$recipe_html = "<h2>Sorry, this recipe must be missing.</h2>";
		}
		echo $recipe_html;
		 ?>
    </div>
    <div class="main-room">
        <div class="editable-content">
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/ge/modules/footer.php'; ?>
