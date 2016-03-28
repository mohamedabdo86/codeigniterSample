<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Recipe</title>
</head>
<body>
<h1><?php echo $name; ?> مرحبا</h1>
<h2>لقد قمت الان بتحميل وصفة وسوف يتم الرد عليك قريبا</h2>
<h3><?php echo $recipe_title; ?></h3>
<img src="<?php echo $recipe_image; ?>" />
<p>لمشاهدة الوصفة  <a href="<?php echo site_url('best_cook/your_recipes/'.$recipe_id.''); ?>">اضغط هنا</a></p>
<p>لتعديل الوصفة  <a href="<?php echo site_url('my_corner/edit_recipe/'.$recipe_id.''); ?>">اضغط هنا</a></p>
<p>اذا أردت تغيير بياناتك  <a href="<?php echo site_url('my_corner/profile'); ?>">اضغط هنا</a></p>
</body>
</html>