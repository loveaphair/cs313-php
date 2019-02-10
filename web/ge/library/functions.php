<?php

function runStmt($sql){
	$db = get_db();
	$stmt = $db->prepare($sql);
    $stmt->execute();
    $result= $stmt->fetchAll(PDO::FETCH_NAMED);
	$stmt->closeCursor();
	return $result;
}

function getPages(){
    $sql = "SELECT * FROM recipe_categories";
    return runStmt($sql);
}

function buildNav($pages) {
	$navList = '<div class="mainNav" id="main_nav">';
	$navList .= "<a class='pure-menu-link' href='?cat=home' title='home'>Home</a>";
    foreach ($pages as $page) {
        $navList .= "<a class='pure-menu-link' href='/cs/ge/?cat=". $page['id'] . "' title='" . $page['name'] . "'>" . $page['name'] . "</a>";
    }
    $navList .= '<a class="navIcon" onclick="showMenu()"><i class="fa fa-bars"></i></a>';
    $navList .= '</div>';
    return $navList;
}

function getCategoryPageById($id){
	$sql = "SELECT name FROM recipe_categories WHERE id = '{$id}'";
	$cat_data = runStmt($sql);
	$page = ['file' => 'pages/'.(strtolower(array_column($cat_data, 'name')[0])).'.php',
			'name' => array_column($cat_data, 'name')[0]
			];
	return $page;
}

function getRecipesByCategoryId($id){
	$sql = "SELECT id, title FROM recipes WHERE recipe_category_id = '{$id}'";
	return runStmt($sql);
}

function getRecipeById($id){
	$sql = "SELECT r.id, r.title, r.image_file, rc.name, rins.instructions
			FROM recipes r
			LEFT JOIN recipe_categories rc ON r.recipe_category_id = rc.id
			LEFT JOIN recipe_instructions rins ON r.id = rins.recipes_id
			WHERE r.id = '{$id}'
			";
	$recipe = runStmt($sql);
	$sql2 = "SELECT ri.measurement_amt, m.name mname, i.title ingredient
			FROM recipe_ingredients ri
			LEFT JOIN measurements m ON ri.measurement_id = m.id
			LEFT JOIN ingredients i ON ri.ingredient_id = i.id
			WHERE ri.recipes_id = '{$recipe[0]['id']}'";
	$recipe[0]['ingredients'] = runStmt($sql2);
	return $recipe;
}

