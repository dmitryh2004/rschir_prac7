<?php 
global $language;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars(getLocalizedText("service-list-page-title", $language)); ?></title>
</head>
<style>
    table {
        text-align: center;
    }
</style>
<body>
<h1><?php echo htmlspecialchars(getLocalizedText("service-list-page-header", $language)); ?></h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th><?php echo htmlspecialchars(getLocalizedText("service-title", $language)); ?></th>
        <th><?php echo htmlspecialchars(getLocalizedText("service-desc", $language)); ?></th>
        <th><?php echo htmlspecialchars(getLocalizedText("service-cost", $language)); ?></th>
        <th><?php echo htmlspecialchars(getLocalizedText("actions", $language)); ?></th>
    </tr>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['ID']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo htmlspecialchars($row['cost']); ?></td>
            <td>
                <?php 
                    echo "<a href='/index.php?action=service_update&id=" . $row['ID'] . "'>" . getLocalizedText("edit", $language) . "</a><br>";
                    echo "<a href='/index.php?action=service_delete&id=" . $row['ID'] . "'>" . getLocalizedText("delete", $language) . "</a>";
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="5">
            <a href='/index.php?action=service_create'><button><?php echo htmlspecialchars(getLocalizedText("add-service", $language)); ?></button></a>
        </td>
    </tr>
</table>
<a href='/index.php?action=user_list'><button><?php echo htmlspecialchars(getLocalizedText("to-user-list", $language)); ?></button></a>
<a href='/index.php?action=admin_menu'><button><?php echo htmlspecialchars(getLocalizedText("to-admin-menu", $language)); ?></button></a>
<a href="/index.html"><button><?php echo htmlspecialchars(getLocalizedText("to_mainpage", $language)); ?></button></a>
</body>
</html>