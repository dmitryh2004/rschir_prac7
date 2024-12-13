<?php 
global $language;
require_once "application/functions/graph_creator.php";
get_pie_chart();
get_amount_distribution();
get_cost_per_client();
overlay_watermarks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars(getLocalizedText("show-stats-page-title", $language)); ?></title>
    <?php applyStyle(); ?>
</head>
<style>
    table {
        text-align: center;
    }
</style>
<body>
    <h1><?php echo htmlspecialchars(getLocalizedText("show-stats-page-header", $language)); ?></h1>
    <a href="/index.php?action=admin_menu"><button><?php echo htmlspecialchars(getLocalizedText("to-admin-menu", $language)); ?></button></a><br>
<table border="1">
    <tr>
        <th>ID</th>
        <th><?php echo htmlspecialchars(getLocalizedText("customer-name", $language)); ?></th>
        <th><?php echo htmlspecialchars(getLocalizedText("service-title", $language)); ?></th>
        <th><?php echo htmlspecialchars(getLocalizedText("amount", $language)); ?></th>
        <th><?php echo htmlspecialchars(getLocalizedText("comment", $language)); ?></th>
    </tr>
    <?php foreach ($data["fixtures"] as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['entry_id']); ?></td>
            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['amount']); ?></td>
            <td><?php echo htmlspecialchars($row['comment']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2><?php echo htmlspecialchars(getLocalizedText("stats-graph1-name", $language)); ?></h2>
<img src="./storage/graphs/graph1.png"><br>
<h2><?php echo htmlspecialchars(getLocalizedText("stats-graph2-name", $language)); ?></h2>
<img src="./storage/graphs/graph2.png"><br>
<h2><?php echo htmlspecialchars(getLocalizedText("stats-graph3-name", $language)); ?></h2>
<img src="./storage/graphs/graph3.png"><br>
<br><a href="/index.php?action=admin_menu"><button><?php echo htmlspecialchars(getLocalizedText("to-admin-menu", $language)); ?></button></a>
</body>
</html>