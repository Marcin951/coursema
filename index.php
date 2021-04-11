<!DOCTYPE html>
<?php

    require_once "database.php";

?>

<head>
    <title>Coursema</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/93861cd10c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="glide-3.4.1/dist/css/glide.core.min.css">
</head>

<body>
    <section id="menu">
        <div id="logo">
            <img src="logo.png">
        </div>
        <div id="searchbar">
            <div id="searchIcon">
                <a href=""><span style="font-size: 16px; color: #27325f;"><i class="fas fa-search"></i></span></a>
            </div>
            <input id="serchText" type="text" placeholder="Czego chcesz się nauczyć?">
        </div>
        <div id="userTools">
            <a href=""><span style="font-size: 24px; color: #27325f;"><i class="far fa-heart"></i></span></a>
            <a href=""><span style="font-size: 24px; color: #27325f;"><i class="far fa-shopping-cart"></i></span></a>
            <a href=""><span style="font-size: 24px; color: #27325f;"><i class="far fa-bell"></i></span></a>
            <a href=""><span style="font-size: 50px; color: gray;"><i class="fas fa-user"></i></span></a>
        </div>
    </section>

    <section id="background">
        <div id="textPanel">
            <div id="textBox">
                <h1>Czego dzisiaj się nauczysz?</h1>
                <br>
                <p>Eksperci z praktycznym doświadczeniem pomogą Ci zdobyć cenną wiedzę. Realna wiedza przekłada się na wyniki w karierze zawodowej, pozwól ekspertom zadbać o Twoją przyszłość.
                </p>
            </div>
        </div>
        <div id="imagePanel">
            <img src="man.png">
        </div>
    </section>

    <section id="categories">
        <h1>Najpopularniejsze kursy w ostatnim czasie</h1>
        <div id="slider">
            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                
                    <ul class="glide__slides">
                    
                        
                   
                    <?
                    $connection_service = ConnectionWithDatabase::getInstance();
                    $conn = $connection_service->getConnection();
                    $stmt = $conn->query("SELECT * FROM courses");
                    while ($row = $stmt->fetch()) {
                        $id = $row['id'];
                        $result = $conn->query("SELECT * FROM opinions WHERE courseID = $id");
                        $avgRate = 0;
                        while ($opinion = $result->fetch()) {
                            $rate = $opinion['rate'];
                            $avgRate += $rate;
                        }
                        if ($result->rowCount()>0){
                            $avgRate = $avgRate / $result->rowCount();
                        }
                     
                        ?>
                        <div class = "coursePreview">
                           <li class="glide__slide">
                            <img src=<?=$row['thumbnailURL'];?>>
                            <h4><?= $row['title']; ?> </h4>
                            <p><?= $row['author']; ?> </p>
                            <p>
                            
                            <div class = "rate">
                            <span style="font-size: 12px; color: #e59819;">
                            <i class="fas fa-star"></i>
                            </span>
                            <?= $avgRate; ?>
                            /5 (
                             
                            )
                            </div>
                            <div class = "price">
                            <?= $row['price']/100; ?> zł
                            </div>
                            </p>
                            </li>
                        </div>
                        <?
                    }
                    ?>
                        
                        
                    </ul>
                  
                </div>
            </div>
        </div>
    </section>

    <section id="footer">

    </section>
    
    <script src="glide-3.4.1/dist/glide.min.js"></script>
    <script src="script.js"></script>
</body>