<?php 
global $language;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars(getLocalizedText("service-create-page-title", $language)); ?></title>
</head>
<body>
<h1><?php echo htmlspecialchars(getLocalizedText("service-create-page-header", $language)); ?></h1>
<?php 
echo "<form method='post' action='index.php?action=service_create&state=post'>";
echo getLocalizedText("service-title", $language) . ": <input name='title' required><br>";
echo getLocalizedText("service-desc", $language) . ": <input name='description' required><br>";
echo getLocalizedText("service-cost", $language) . ": <input type='number' name='cost' required><br>
<button type='submit'>" . getLocalizedText("save", $language) . "</button>
</form>";
echo "<a href=\"index.php?action=service_list\"><button>" . getLocalizedText("back", $language) . "</button></a>";
?>
</body>
</html>