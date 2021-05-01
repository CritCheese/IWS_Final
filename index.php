<?php
include_once('./config.php');
$sql = "SELECT * FROM articles LEFT JOIN categories ON articles.category_article = categories.id_category ORDER BY articles.date_article DESC";
$result = $mysqli->query($sql); //trả về object || false
$rows = [];
if ($result) {
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />    <!-- style css here -->
    <style>

    </style>
</head>

<body>
    <!-- header here -->
    <header>

    </header>

    <!-- banner here(optional, but should have) -->
    <section class="banner">

    </section>

    <!-- news body here -->
    <section class="bodywork">

        <div class="container">
            <!-- search function not completed yet -->
            <form action="" method="get">
                <label for="search_el">Search by:</label>
                <select name="search_el" id="search_el">
                    <option value="name">Name</option>
                    <option value="cat">Category</option>
                </select>
                <input type="text" name="search_field" id="search_field" placeholder="Enter search key">
                <button type="submit">Search</button>
            </form>

            <div>
                <!-- news display -->
                <?php if (count($rows) == 0) : ?>
                    <p>No news</p>
                <?php else : ?>
                    <?php foreach ($rows as $row) : ?>
                        <div>
                            <h2><a href="read_one.php?id=<?php echo $row['id_article']; ?>"><?php echo $row['title_article'] ?></a></h2>
                            <p><?php echo $row['name_category'] ?></p>
                            <p><?php echo $row['date_article'] ?></p>
                            <p>created by <?php echo $row['author_article'] ?></p>
                            <p><?php echo $row['intro_article'] ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>

</html>
