
<?php include $path . '/modules/head.php'; ?>
<?php include $path . '/modules/header.php'; ?>

<script>
	var i = 1;
	$(function(){
		$('#recipe_ingredient').SumoSelect({
			search: true,
			placeholder: 'Select Ingredients...',
			searchText: 'Type to Search...',
		});

		$('#recipe_category').SumoSelect({
			search: true,
			placeholder: 'Select Category...',
			searchText: 'Type to Search...',
		});

		$('.measurement-type').SumoSelect({
			search: true,
			placeholder: 'Select Measurement...',
			searchText: 'Type to Search...',
		});

		$('#new_ingredient_type').SumoSelect({
			search: true,
			placeholder: 'Select Ingredient Type...',
			searchText: 'Type to Search...',
		});

		$('#createNewRecipe').on('click', '.close-ingredient', function(){
			var id = $(this).attr("data-id");
			var name = $(this).parent().text().split(':')[0];
			var value = $(this).parent().find('input').val();
			putIngredientBackInList(name, value);
			$('#ingredient'+id).remove();
		})

		$('#addNewIngredient').click(function(){
			$('#addNewIngredientForm').toggle();
			$('.fa-minus-square').toggle();
			$('.fa-plus-square').toggle();
		});

		$('#recipe_ingredient').change(function(){
			var name = $(this).find('option:selected').text();
			var value = $(this).val();
			insertNewIngredientRow(name, value);
		});

		$('#new_ingredient_submit').click(function(){
			$.post("?f=recipes&a=addNewIngredient", {'name': $('input[name="new_ingredient_title"]').val(), 'ingredient_type': $('select[name="new_ingredient_type"]').val()}, function(data){
				if(data.success){
					insertNewIngredientRow($('input[name="new_ingredient_title"]').val(), data.id);
					$('input[name="new_ingredient_title"]').val("");
					$('#new_ingredient_type').val("");
				}
				$('#new_ingredient_status').css({"color": data.color});
				$('#new_ingredient_status').empty();
				$('#new_ingredient_status').append(data.message);
				setTimeout(function(){$('#new_ingredient_status').empty()}, 3000);
			}, "json");
		});
	});

	function insertNewIngredientRow(name, value){
		$('#ingredient_area').append("<div id='ingredient" + i + "'>");
		$('#ingredient'+i).append("<br><input type='hidden' name='ingredient_id[]' value="+value+">")
		.append("<span class='input-ingredient'>" + name + ": </span>")
		.append("<input type='text' required name='ingredient_amount[]' placeholder='Amount (number)'>")
		.append("<select class='measurement-type SlectBox' name='measurement_type[]'><?=$measurement_html?></select><a href='javascript:void(0);' class='close-ingredient no-decor' data-id='"+i+"'><i class='fas fa-times-circle'></i></a>")
		.append("</div>");
		i++;
		$("#recipe_ingredient option[value='"+value+"']").remove();
		$('#recipe_ingredient').val("");
		$('#recipe_ingredient')[0].sumo.reload();
		$('.measurement-type').SumoSelect({
			search: true,
			placeholder: 'Select Measurement...',
			searchText: 'Type to Search...',
		});
	}

	function putIngredientBackInList(name, val){
		$('#recipe_ingredient').append("<option name='ingredient' value='"+val+"'>"+name+"</option>");
		$('#recipe_ingredient')[0].sumo.reload();
	}
</script>

<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <div class="main-area">
		<?=isset($message) && $message ? "<h1>{$message}</h1>" : ""?>
		<?php $recipe_html = '';
		if(isset($recipe_data)) {
			$ri = $recipe_data[0];
			$recipe_html = "<h2>{$ri['title']}</h2>";
			if($ri['image_file'])
				$recipe_html .= "<img src='images/recipe_images/{$ri['image_file']}' width='100px'>";
				$recipe_html .= "<h3>Ingredients</h3><ul>";
			foreach($ri['ingredients'] as $ing){
				$recipe_html .= "<li>{$ing['measurement_amt']} {$ing['mname']} {$ing['ingredient']}</li>";
			}
			$recipe_html .= "</ul>";
			$recipe_html .= "<p>" . str_replace('---', '</p><p>', $ri['instructions']) . "</p>";
        }else if((isset($create_new) && $create_new) || $_GET['rid']){ ?>
			<form name="createNewRecipe" id="createNewRecipe" action="?f=recipes&a=updateRecipe" METHOD="POST">
				<h2><?=$create_new ? 'Create New Recipe' : 'Update Recipe'?></h2>
				<p><span class="input-title" style="font-size:130%'">Title: </span><input type="text" style="width:80%;font-size:130%" name="recipe_title" value="<?=$recipe_info['title']?>"></p>
				<p><span class="input-title">Category: </span><select style="width:100%;" name="recipe_category" id="recipe_category">
				<?=$category_html?>
				</select></p>
				<h4>Ingredients</h4>
				<p><span class="input-title">Ingredient: </span><select style="width:100%" name="recipe_ingredient" id="recipe_ingredient">
					<?=$ingredient_html?>
				</select>
				<span class="removeable-add-button"><a href="javascript:void(0);" id="addNewIngredient" class="no-decor"> 
					<i style="margin-left:20px;display:inline-block;" class="fas fa-plus-square"></i><i style="margin-left:20px;display:none;" class="fas fa-minus-square"></i> Add Ingredient To List</a>
				<div id="addNewIngredientForm" style="display:none">
						<input type="text" name="new_ingredient_title" style="min-width:30%">
						<select name="new_ingredient_type" id="new_ingredient_type">
							<?=$ingredient_type_html?>
						</select>
						<button type="button" id="new_ingredient_submit">Add New Ingredient</button><div style="display:inline-block;padding-left:10px;" id="new_ingredient_status"></div>
				</div>
				</span></p>
				<div style="margin-bottom:15px;" id="ingredient_area"><?=$existing_ingredient_info?></div>
				<h4>Instructions</h4>
				<p><textarea name="instructions" style="vertical-align:top" cols="100" rows="10"><?=$recipe_info['instructions']?></textarea></p>
				<?php if($_GET['rid']){ ?>
					<input type="hidden" name="id" value="<?=$_GET['rid']?>">
				<?php } ?>
				<input type="submit" value="<?=$create_new ? 'Create Recipe' : 'Update Recipe'?>";>
			</form>
			<?php }else{ 
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

<?php include $path . '/modules/footer.php'; ?>
