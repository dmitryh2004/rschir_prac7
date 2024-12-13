<?php
global $language;

$serviceID = $_GET["id"];

echo "<form method='post' action='/index.php?action=service_delete&state=post&id=" . $serviceID . "'>";
echo getLocalizedText("service-delete-are-you-sure", $language) . " " . $data["title"] . "?<br>
<button type='submit'>" . getLocalizedText("delete", $language) . "</button>
</form>";
echo "<a href=\"index.php?action=service_list\"><button>" . getLocalizedText("back", $language) . "</button></a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars(getLocalizedText("service-delete-page-title", $language)) ?></title>
</head>
</html>