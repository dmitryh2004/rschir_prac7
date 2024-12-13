<?php
require_once 'application/core/session_reader.php';
require_once 'application/core/localizator.php';
require_once "application/models/service.php";

$serviceModel = new Service();
$services = $serviceModel->get_all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars(getLocalizedText("service-page-title", $language)); ?></title>
    <?php applyStyle(); ?>
    <style>
        span {
            margin: 10px;
        }
        .list {
            display: flex;
            flex-direction: column;
        }
        .item {
            display: flex;
            flex-direction: row;
            cursor: pointer;
            text-decoration: underline;
            color: blue;
        }

        .item:hover { background-color: cadetblue; color: blueviolet }
        </style>

</head>
<body>
<h1><?php echo htmlspecialchars(getLocalizedText("service-page-header", $language)); ?></h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th><?php echo htmlspecialchars(getLocalizedText("service-title", $language)); ?></th>
        <th><?php echo htmlspecialchars(getLocalizedText("service-desc", $language)); ?></th>
        <th><?php echo htmlspecialchars(getLocalizedText("service-cost", $language)); ?></th>
    </tr>
    <?php foreach ($services as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['ID']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo htmlspecialchars($row['cost']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.html"><button><?php echo htmlspecialchars(getLocalizedText("to_mainpage", $language)); ?></button></a>
</body>
</html>