<?php global $language; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars(getLocalizedText("service-update-page-title", $language)); ?></title>
    <?php applyStyle(); ?>
</head>
<body>
<h1><?php echo htmlspecialchars(getLocalizedText("service-update-page-header", $language)); ?></h1>
<?php 
$userID = $_GET["id"];

if ($data) {
    echo "<form method='post' action='/index.php?action=service_update&state=post&id=" . $userID . "'>";
    echo getLocalizedText("service-title", $language) . ": <input name='title' value='" . $data["title"] . "' required><br>";
    echo getLocalizedText("service-desc", $language) . ": <input name='description' value='" . $data["description"] . "' required><br>";
    echo getLocalizedText("service-cost", $language) . ": <input type='number' name='cost' value='" . $data["cost"] . "' required><br>
    <button type='submit'>" . getLocalizedText("save", $language) . "</button>
    </form>";
    echo "<a href=\"index.php?action=service_list\"><button>" . getLocalizedText("back", $language) . "</button></a>";
}
else {
    echo "<p style='color: #ff0000'>" . getLocalizedText("error", $language) . ": " . getLocalizedText("service-with", $language) . "id=" . $userID . " " . getLocalizedText("not-found", $language) . ".</p>";
}
?>
</body>
</html>