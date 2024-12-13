<?php
global $language;

$userID = $_GET["id"];

echo "<form method='post' action='/index.php?action=user_delete&state=post&id=" . $userID . "'>";
echo getLocalizedText("user-delete-are-you-sure", $language) . " " . $data["name"] . "?<br>
<button type='submit'>" . getLocalizedText("delete", $language) . "</button>
</form>";
echo "<a href=\"index.php?action=user_list\"><button>" . getLocalizedText("back", $language) . "</button></a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars(getLocalizedText("user-delete-page-title", $language)) ?></title>
</head>
</html>