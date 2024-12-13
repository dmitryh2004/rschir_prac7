<?php 
global $language;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars(getLocalizedText("user-create-page-title", $language)); ?></title>
</head>
<body>
<h1><?php echo htmlspecialchars(getLocalizedText("user-create-page-header", $language)); ?></h1>
<?php 
echo "<form method='post' action='index.php?action=user_create&state=post'>";
echo getLocalizedText("username", $language) . ": <input name='name' required><br>";
echo getLocalizedText("password", $language) . ": <input type='password' name='password' required><br>
<button type='submit'>" . getLocalizedText("save", $language) . "</button>
</form>";
echo "<a href=\"index.php?action=user_list\"><button>" . getLocalizedText("back", $language) . "</button></a>";
?>
</body>
</html>