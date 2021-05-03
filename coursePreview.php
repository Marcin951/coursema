<!DOCTYPE html>
<?php

require_once "database.php";

?>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="coursePreviewStyle.css">
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/93861cd10c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
        include 'menu.php';
        $courseID = $_GET["courseID"];
       
    ?>
    <?php
                    $connection_service = ConnectionWithDatabase::getInstance();
                    $conn = $connection_service->getConnection();
                    $stmt = $conn->query("SELECT * FROM courses WHERE id = $courseID");
                    
                    while ($row = $stmt->fetch()) {
                        $id = $row['id'];
                    
                        ?>
                        <title><?=$row['title']?></title>

    <section id = "previewPanel">
        <div id = "textContener">
            <h1><?=$row['title']?></h1>
            <p><?=$row['subtitle']?><p>
            
          
            <div id = "coursePanel">
            <div id ="courseImage">
            <img src=<?=$row['thumbnailURL'];?>>
                    </div>
            <div id = "buyButtons">
                <button type = "button">Dodaj do koszyka</button>
                <button type = "button">Kup teraz</button>
            </div>
                    </div>
         </div>

    </section>
    <section id = "courseDesc">

    <h1>Opis</h1>
     
    </section>

                        <?
                            }                     
                        ?>
    <?php
        include 'footer.php';
    ?>
</body>