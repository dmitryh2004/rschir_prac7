<?php 
global $language;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo htmlspecialchars(getLocalizedText("admin-menu-page-title", $language)); ?></title>
    </head>
    <body>
        <h1><?php echo htmlspecialchars(getLocalizedText("admin-menu-page-header", $language)); ?></h1>
        <ul>
        <li><a href="/index.php?action=user_list"><?php echo htmlspecialchars(getLocalizedText("to-user-list", $language)); ?></a></li>
        <li><a href="/index.php?action=service_list"><?php echo htmlspecialchars(getLocalizedText("to-service-list", $language)); ?></a></li>
        <li><a href="/index.php?action=settings"><?php echo htmlspecialchars(getLocalizedText("settings", $language)); ?></a></li>
        <li><a href="/index.php?action=pdf_upload"><?php echo htmlspecialchars(getLocalizedText("upload-pdf", $language)); ?></a></li>
        <li><a href="/index.php?action=pdf_list"><?php echo htmlspecialchars(getLocalizedText("download-pdf", $language)); ?></a></li>
        <li><a href="/index.php?action=fixtures_generate"><?php echo htmlspecialchars(getLocalizedText("generate-fixtures", $language)); ?></a></li>
        <li><a href="/index.php?action=fixtures_stats"><?php echo htmlspecialchars(getLocalizedText("show-stats", $language)); ?></a></li>
        </ul>
        <a href="index.php"><button><?php echo htmlspecialchars(getLocalizedText("to_mainpage", $language)); ?></button></a>
    </body>
</html>