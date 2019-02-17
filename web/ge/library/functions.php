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
	$navList .= "<a class='pure-menu-link' href='?a=home' title='home'>Home</a>";
    foreach ($pages as $page) {
        $navList .= "<a class='pure-menu-link' href='?f=categories&a=". $page['id'] . "' title='" . $page['name'] . "'>" . $page['name'] . "</a>";
    }
    $navList .= '<a class="navIcon" onclick="showMenu()"><i class="fa fa-bars"></i></a>';
    $navList .= '</div>';
    return $navList;
}

function getCategoryPageById($id){
	$sql = "SELECT name FROM recipe_categories WHERE id = '{$id}'";
	$cat_data = runStmt($sql);
	if(!$cat_data)
		return [];
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
	$sql = "SELECT r.id, r.title, r.image_file, rc.name, rc.id category_id, rins.instructions
			FROM recipes r
			LEFT JOIN recipe_categories rc ON r.recipe_category_id = rc.id
			LEFT JOIN recipe_instructions rins ON r.id = rins.recipes_id
			WHERE r.id = '{$id}'
			";
	$recipe = runStmt($sql);
	if(!$recipe)
		return [];
	$sql2 = "SELECT ri.id recipe_ingredient_id, ri.measurement_amt, m.name mname, m.id mid, i.title ingredient, i.id ingredient_id
			FROM recipe_ingredients ri
			LEFT JOIN measurements m ON ri.measurement_id = m.id
			LEFT JOIN ingredients i ON ri.ingredient_id = i.id
			WHERE ri.recipes_id = '{$recipe[0]['id']}'";
	$recipe[0]['ingredients'] = runStmt($sql2);
	return $recipe;
}

function getIngredients(){
	$sql = "SELECT id, title ingredient FROM ingredients";
	return runStmt($sql);
}
function getIngredientTypes(){
	$sql = "SELECT id, name FROM ingredient_types";
	return runStmt($sql);
}

function getMeasurements(){
	$sql = "SELECT id, name FROM measurements";
	return runStmt($sql);
}

function getCategories(){
	$sql = "SELECT * FROM recipe_categories";
	return runStmt($sql);
}

function getIngredientsUsedByRecipeId($recipe_id){
	$sql = "SELECT m.id measurement_id, i.title ingredient_name, i.id ingredient_id, ri.measurement_amt amount 
			FROM recipe_ingredients ri
			LEFT JOIN measurements m ON ri.measurement_id = m.id
			LEFT JOIN ingredients i ON ri.ingredient_id = i.id
			WHERE ri.recipes_id = '{$recipe_id}'";
	return runStmt($sql);
}




// INSERT STATEMENTS

function insertNewIngredient($data){
	if(!$data['name'])
		return ['success' => false, 'message' => 'Error: No Ingredient Name.', 'color' => 'red'];
	
	if(!$data['ingredient_type'])
		return ['success' => false, 'message' => 'Error: No Ingredient Type.', 'color' => 'red'];
	
	$name = htmlspecialchars($data['name']);
	$type = htmlspecialchars($data['ingredient_type']);

	$sql = "INSERT INTO ingredients (title, ingredient_type_id) VALUES ('{$name}', '{$type}') RETURNING id";
	$db = get_db();
	$stmt = $db->prepare($sql);
    $stmt->execute();
    $result= $db->lastInsertId();
	$stmt->closeCursor();
	if($result)
		return ['success' => true, 'id' => $result, 'message' => 'New ingredient created successfully!', 'color' => 'green'];
	else
		return ['success' => false, 'message' => 'Error creating new ingredient.', 'color' => 'red'];
}

function updateRecipe($post_data){
	$db = get_db();
	if(!$post_data['recipe_title'])
		return ['success' => false, 'message' => 'No Title Provided'];
	if(!$post_data['recipe_category'])
		return ['success' => false, 'message' => 'No Category Provided'];
	if(!$post_data['ingredient_id'])
		return ['success' => false, 'message' => 'No Ingredients Provided'];
	if(!$post_data['instructions'])
		return ['success' => false, 'message' => 'No Instructions Provided'];

	$is_added = $post_data['id'] ? 0 : 1;

	$recipe_id = !$is_added ? htmlspecialchars($post_data['id']) : "";

	$title = htmlspecialchars($post_data['recipe_title'], ENT_QUOTES);
	$category = htmlspecialchars($post_data['recipe_category']);
	$instructions = htmlspecialchars($post_data['instructions'], ENT_QUOTES);
	$datetime = date("Y-m-d H:i:s");

	if($is_added){
		$sql = "INSERT INTO recipes (title, recipe_category_id, created_ts, created_user_id) VALUES ('{$title}', '{$category}', '{$datetime}', 1) RETURNING id";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$recipe_id= $db->lastInsertId();
		$stmt->closeCursor();
	}

	if($is_added && !$recipe_id)
		return ['success' => false, 'message' => 'Could not add the recipe. Please try again later.'];

	if(!$is_added){
		$delete_sql = "DELETE FROM recipe_ingredients WHERE recipes_id = '{$recipe_id}'";
		$stmt = $db->prepare($delete_sql);
		$stmt->execute();
		$stmt->closeCursor();
	}
	
	foreach($post_data['ingredient_id'] as $key => $value){
		if(!$post_data['ingredient_amount'][$key] || !$post_data['measurement_type'][$key])
			continue;

		$ingredient = trim(htmlspecialchars($value));
		$amount = trim(htmlspecialchars($post_data['ingredient_amount'][$key]));
		$measurement = trim(htmlspecialchars($post_data['measurement_type'][$key]));

		$ingredient_sql = "INSERT INTO recipe_ingredients (recipes_id, measurement_id, ingredient_id, created_ts, created_user_id, measurement_amt)
				VALUES ('{$recipe_id}', '{$measurement}', '{$ingredient}', '{$datetime}', 1, '{$amount}' ) RETURNING id";
			
		$stmt = $db->prepare($ingredient_sql);
		$stmt->execute();
		$ingredient_id= $db->lastInsertId();
		$stmt->closeCursor();
		if(!$ingredient_id)
			return ['success' => false, 'message' => 'Could not add the recipe. Please try again later. Ingredient'];
	}

	$instruction_sql = "INSERT INTO recipe_instructions (recipes_id, instructions, created_ts, created_user_id)
						VALUES ('{$recipe_id}', '{$instructions}', '{$datetime}', 1) RETURNING id";
	if(!$is_added)
		$instruction_sql = "UPDATE recipe_instructions SET instructions = '{$instructions}' WHERE recipes_id = '{$post_data['id']}'";
		
	$stmt = $db->prepare($instruction_sql);
	$stmt->execute();
	$instruction_id= $is_added ? $db->lastInsertId() : '';
	$stmt->closeCursor();
	if($is_added && !$instruction_id)
			return ['success' => false, 'message' => 'Could not add the recipe. Please try again later. Instructions'];
	$success_message = $is_added ? 'Recipe Created Successfully!' : 'Recipe Updated Successfully!';
	return ['success' => true, 'message' => $success_message, 'id' => $recipe_id];
}

function deleteRecipeById($id){
	$db = get_db();
	$sqls[] = "DELETE FROM recipe_instructions WHERE recipes_id = '{$id}'";
	$sqls[] = "DELETE FROM recipe_ingredients WHERE recipes_id = '{$id}'";
	$sqls[] = "DELETE FROM recipes WHERE id = '{$id}'";

	foreach($sqls as $sql){
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$stmt->closeCursor();
	}
}









/**
 * THIS AREA IS FOR GROUP WORK.
 */

function getScriptureTopics(){
	$sql = "SELECT * FROM topic";
	return runStmt($sql);
}

function getScriptures(){
	$sql = "SELECT * FROM scriptures";
	return runStmt($sql);
}

function getTopicByScriptureId($scripture_id){
	$sql = "SELECT t.name FROM scripture_topic_links stl LEFT JOIN topic t ON t.id = stl.topic_id WHERE stl.scriptures_id = '{$scripture_id}'";
	return runStmt($sql);
}

function updateScripture($data){
	$sql = "INSERT INTO scriptures (book, chapter, verse, content) VALUES ('{$data['book']}','{$data['chapter']}','{$data['verse']}','{$data['content']}')";
	$db = get_db();
	$stmt = $db->prepare($sql);
    $stmt->execute();
    $result= $db->lastInsertId();
	$stmt->closeCursor();
	return $result;
}

function updateScriptureTopic($topic_id, $scripture_id){
	$sql = "INSERT INTO scripture_topic_links (scriptures_id, topic_id) VALUES ('{$scripture_id}','{$topic_id}')";
	$db = get_db();
	$stmt = $db->prepare($sql);
    $stmt->execute();
    $result= $db->lastInsertId();
	$stmt->closeCursor();
	return $result;
}

function updateTopic($topic_name){
	$sql = "INSERT INTO topic (name) VALUES ('{$topic_name}')";
	$db = get_db();
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$result= $db->lastInsertId();
	$stmt->closeCursor();
	return $result;
}