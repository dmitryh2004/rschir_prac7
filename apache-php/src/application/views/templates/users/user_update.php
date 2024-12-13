<?php global $language; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars(getLocalizedText("user-update-page-title", $language)); ?></title>
    <?php applyStyle(); ?>
</head>
<body>
<h1><?php echo htmlspecialchars(getLocalizedText("user-update-page-header", $language)); ?></h1>
<?php 
$userID = $_GET["id"];

if ($data) {
    echo "<form method='post' action='/index.php?action=user_update&state=post&id=" . $userID . "'>";
    echo getLocalizedText("username", $language) . ": <input name='name' value='" . $data["name"] . "' required><br>";
    echo getLocalizedText("new-password", $language) . ": <input type='password' name='password' value='' required><br>
    <button type='submit'>" . getLocalizedText("save", $language) . "</button>
    </form>";
    echo "<a href=\"index.php?action=user_list\"><button>" . getLocalizedText("back", $language) . "</button></a>";
}
else {
    echo "<p style='color: #ff0000'>" . getLocalizedText("error", $language) . ": " . getLocalizedText("user-with", $language) . "id=" . $userID . " " . getLocalizedText("not-found", $language) . ".</p>";
}
?>
</body>
</html>