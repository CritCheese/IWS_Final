<?php
include_once('./config.php');
$id = $_GET['id'];
$sql = "SELECT * FROM articles LEFT JOIN categories ON articles.category_article = categories.id_category WHERE id_article = $id"; //select query
$result = $mysqli->query($sql);
$article = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <style>
        /* css here */
    </style>
</head>

<body>

    <div class="container">
        <!-- title -->
        <h2><?php echo $article['title_article'] ?></h2> 
        <!-- category -->
        <p><?php echo $article['name_category'] ?></p>
        <!-- date created -->
        <p><?php echo $article['date_article'] ?></p>
        <!-- author -->
        <p>created by <?php echo $article['author_article'] ?></p>
        <!-- intro -->
        <p><?php echo $article['intro_article'] ?></p>
        <!-- content -->
        <p><?php echo $article['content_article'] ?></p>
    </div>
    
    <!-- comment section -->
    <section class="comments">
        <div class="container">
        
            <!-- comment creator -->
            <div class="creator">
                <form action="" method="post">
                    <h3>Write a comment</h3>
                    <label for="writer">Enter your name (Optional)</label>
                    <input type="text" name="writer" id="writer" placeholder="anon"><br>
                    <textarea name="write_comment" id="write_comment" cols="100" rows="6" placeholder="Write your comment here" required></textarea><br>
                    <button type="submit" class="btn btn-primary" name="save">Submit</button>
                </form>
                <?php
                if (isset($_POST['save'])) {
                    error_reporting(0);
                    $writer = $_POST['writer'];
                    $c0 = $_POST['write_comment'];
                    if (strlen($writer) == 0) {
                        $writer = 'anon';
                    }
                    if (strlen($c0) != 0) {
                        $sql_c0 = "INSERT INTO comments(id_article, author_comment, content_comment) VALUES ('$id', '$writer', '$c0')";
                        $result_c0 = $mysqli->query($sql_c0); //true / false

                        if ($result_c0) {
                            //refresh page if success
                            //echo "alert(Success!)";
                            header("Refresh:0");
                        } else {
                            //return to index.php if fail
                            //echo "alert(Failed!)";
                            header("location: index.php");
                        }
                    } else {
                        //return to index.php if there is no comment where pressing submit button
                        header("location: index.php");
                    }
                }


                ?>
            </div>
            <!-- comments viewer -->
            <div class="viewer">
                <h3>Comments</h3>
                <?php

                $sql_c1 = "SELECT * FROM comments WHERE id_article = $id";
                $result_c1 = $mysqli->query($sql_c1);
                $comments = [];
                if ($result_c1) {
                    $comments = $result_c1->fetch_all(MYSQLI_ASSOC);
                }
                ?>
                <?php if (count($comments) == 0) : ?>
                    <p>No comments</p>
                <?php else : ?>
                    <?php foreach ($comments as $row) : ?>
                        <div>
                            <h4><?php echo $row['author_comment'] ?></a></h4>
                            <p><?php echo $row['date_created'] ?></p>
                            <p><?php echo $row['content_comment'] ?></p>
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
