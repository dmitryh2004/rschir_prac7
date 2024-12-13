<?php global $language; $userID = $data["user_id"]; ?>
<?php if ($userID != null): ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(getLocalizedText("upload-pdf-page-title", $language)); ?></title>
    <?php applyStyle(); ?>
</head>
<body>
    <h1><?php echo htmlspecialchars(getLocalizedText("upload-pdf-page-header", $language)); ?></h1>
    <form action="/index.php?action=pdf_upload&state=post" method="post" enctype="multipart/form-data">
        <label for="file"><?php echo htmlspecialchars(getLocalizedText("choose-pdf", $language)); ?></label><br>
        <input type="file" name="pdf_file" id="file" accept=".pdf" required><br>
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($result["ID"]); ?>"><br>
        <button type="submit"><?php echo htmlspecialchars(getLocalizedText("upload", $language)); ?></button>
    </form>
    <a href='/index.php?action=admin_menu'><button><?php echo htmlspecialchars(getLocalizedText("to-admin-menu", $language)); ?></button></a>
    <a href="/index.html"><button><?php echo htmlspecialchars(getLocalizedText("to_mainpage", $language)); ?></button></a>
</body>
</html>
<?php else: ?>
<?php echo("Пользователь не найден.") ?>
<?php endif; ?>