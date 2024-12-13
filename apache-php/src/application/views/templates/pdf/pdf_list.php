<?php 
global $language;
$directory = $data["directory"];
$userID = $data["user_id"];
$files = [];
if (file_exists($directory) && is_dir($directory)) {
    $files = array_diff(scandir($directory), array('..', '.'));
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(getLocalizedText("download-pdf-page-title", $language)); ?></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
    <?php applyStyle(); ?>
</head>
<body>

<h1><?php echo htmlspecialchars(getLocalizedText("download-pdf-page-header", $language)); ?></h1>

<?php if(empty($files)): ?>
    <p><?php echo htmlspecialchars(getLocalizedText("no-pdfs", $language)); ?></p>
<?php else: ?>
<table>
    <thead>
        <tr>
            <th><?php echo htmlspecialchars(getLocalizedText("filename", $language)); ?></th>
            <th><?php echo htmlspecialchars(getLocalizedText("size", $language)); ?></th>
            <th><?php echo htmlspecialchars(getLocalizedText("actions", $language)); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($files as $file): ?>
            <?php if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf'): ?>
                <?php $filePath = "$directory$file"; ?>
                <?php $fileSize = filesize($filePath); ?>
                <tr>
                    <td><?php echo htmlspecialchars($file); ?></td>
                    <td><?php echo round($fileSize / 1024, 2) . ' KB'; ?></td> <!-- Размер в КБ -->
                    <td>
                        <a href="<?php echo $filePath; ?>" download><button><?php echo htmlspecialchars(getLocalizedText("download", $language)); ?></button></a>
                        <?php echo "<a href=\"/index.php?action=pdf_delete&filepath=$filePath\"><button>" . htmlspecialchars(getLocalizedText("delete", $language)); ?></button></a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
<a href='/index.php?action=admin_menu'><button><?php echo htmlspecialchars(getLocalizedText("to-admin-menu", $language)); ?></button></a>
<a href="/index.html"><button><?php echo htmlspecialchars(getLocalizedText("to_mainpage", $language)); ?></button></a>
</body>
</html>