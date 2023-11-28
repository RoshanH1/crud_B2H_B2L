<?php
include 'db.php';

global $db;

$query = $db->prepare('SELECT * FROM fietsen');
$query->execute();
$bikes = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="insert.php">Toevoegen</a>
<table>
    <thead>
    <tr>
        <th scope="col">type</th>
        <th scope="col">prijs</th>
        <th scope="col">categorie</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($bikes as $bike) :?>
        <?php
            $query = $db->prepare('SELECT naam FROM categorie WHERE id = :id');
            $query->bindParam('id', $bike['categorie_id']);
            $query->execute();
            $category = $query->fetch(PDO::FETCH_ASSOC);
        ?>
        <tr>
            <td><?= $bike['type']?></td>
            <td><?= $bike['prijs']?></td>
            <td><?= $category['naam'] ?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
</body>
</html>
