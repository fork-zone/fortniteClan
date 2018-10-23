<?php include("header.php");?>
    <?php
    $sql = "Select * FROM clans";
    $result = $conn->query($sql);
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center bg-secondary outter-jumbotron">
            <div class="container-fluid justify-content-center d-flex inner-jumbotron">
                <div id="carouselExampleIndicators" class="carousel slide d-flex align-items-center" data-ride="carousel">
                    <a class="carousel-control-prev position-relative" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    
                    <ol class="carousel-indicators p-1 m-1">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner justify-content-center">
                        <div class="carousel-item flex-sm-row flex-column justify-content-center active d-flex">
                            
                            <div class="text-white d-flex flex-column m-auto p-2 mb-3 carousel-claninfo">
                                <h3 class="font-weight-bold text-center">No Limits</h3>
                                <p>A really awesome freaking great clan! Everyone should definitely join!</p>
                                <button class="btn btn-primary btn-lg m-auto">View Clan</button>
                            </div>

                            <img src="images/nolimits.jpg" class="img-fluid m-auto carousel-image" alt="...">
                            <button class="btn btn-primary btn-block d-sm-none mt-2">View Clan</button>
                        </div>
                    </div>
                    <a class="carousel-control-next position-relative" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center mt-2">
        <?php 
            while ($row = $result->fetch_assoc()) { 
                if (strlen($row['description']) > 110) {
                    $description = substr($row['description'], 0, 110).'...';
                }
        ?>
            <div class="card m-2 card-size">
                <img class="card-img-top" src="images/<?=$row['picture']; ?>" alt="<?=$row['name']; ?> Fortnite Clan">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?=$row['name']; ?></h5>
                    <p class="card-text"><?=$description ?></p>
                    <a href="viewclan.php?clan=<?=$row['id'];?>" class="btn btn-primary align-self-center mt-auto">View Clan</a>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
  <?php include('footer.php'); ?>