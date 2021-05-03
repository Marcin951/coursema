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
    <link rel="icon" href="img/fav.png" type="image/x-icon"/>
</head>

<body>
   
    <?php
        include 'menu.php';
    ?>

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

    <section id="coursesSlider">
        <h1>Najpopularniejsze kursy w ostatnim czasie</h1>
        <div id="slider">
            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                
                    <ul class="glide__slides">
                    
                        
                   
                    <?php
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
                            $avgRate = number_format((float)$avgRate, 1, '.', '');
                        }
                     
                        ?>
                       
                        <div class = "coursePreview">
                        <a href = "coursePreview.php?courseID=<?=$id?>">
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
                                <?= $result->rowCount(); ?>
                           
                            )
                            </div>
                            <div class = "price">
                            <?= $row['price']/100; ?> zł
                            </div>
                            </p>
                            </li>
                            </a>
                        </div>
                         
                        <?php
                    }
                    ?>
                        
                        
                    </ul>
                  
                </div>
            </div>
        </div>
    </section>

    <section id="categories">
       <h1>Tematy polecane dla Ciebie</h1>
       <div class="glideCategory">
       <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    
                    <ul class="glide__slides">
                    
                    
                   
                    <?php
                    $categoryR = $conn->query("SELECT * FROM recomendedcategories JOIN categories ON categories.id = recomendedcategories.categoryID");
                    $categories = array();
                    while ($row = $categoryR->fetch()) {
                        array_push($categories,$row['name']);
                    }
                    for ($i = 0; $i < count($categories)/2; $i++) {
                        ?>
                        <div class = "categorySlide"> 
                        <li class="glide__slide">
                            <div class = "categoryBlock">
                                <h4>
                        <?= $categories[$i];?>
                    </h4>
                    </div>
                        <br>
                        <div class = "categoryBlock">
                            <h4>
                        <?= $categories[$i+4];?>
                        </h4>
                    </div>
                        </li>
                        </div>
                        <?php
                        
                    }
                  
                    ?>
                   
                        
                    </ul>
                  
                </div>
            </div>
       </div>
    </section>

    <?php
        include 'footer.php';
    ?>
    
    <script src="glide-3.4.1/dist/glide.min.js"></script>
    <script src="script.js"></script>
</body>