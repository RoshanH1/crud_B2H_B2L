<?php
include 'db.php';
global $db;

$query = $db->prepare('SELECT * FROM categorie');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    if (!empty($_POST['type']) && !empty($_POST['price']) && !empty($_POST['category'])) {
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $category = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);

        if (!$price || !$category) {
            $alert = "vul geldige getallen in";
        } else {
            $query = $db->prepare('INSERT INTO fietsen (type, prijs, categorie_id) VALUES (:type, :price, :category)');
            $query->bindParam('type', $_POST['type']);
            $query->bindParam('price', $price);
            $query->bindParam('category', $category);
            if ($query->execute()) {
                header('location: index.php');
            } else {
                $alert = "Er is iets mis gegaan";
            }
        }
    } else {
        $alert = "Vul alle velden in";
    }
} else {
    $alert = "";
}
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
<form method="post">
    <label for="type">Type</label>
    <input type="text" name="type" id="type"><br>
    <label for="price">Prijs</label>
    <input type="number" name="price" id="price" step="0.01"><br>
    <label for="category">Categorie</label>
    <select name="category" id="category">
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>"><?= $category['naam'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <button name="submit">verzenden</button>
</form>
<?= $alert ?>
</body>
</html>
