<?php
include("connect.php");
session_start();

$sql = "Select * FROM clans";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fortnite Clan - Find your next clan here!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <style>
        .carousel-claninfo {
            width: 500px;
        }
        .outter-jumbotron {
            height: 420px;
            background:linear-gradient(#000000a0, #000000a0), url('images/jumbobg3.jpeg');
            background-position-y: -250px;
        }
        .inner-jumbotron {
            height: 320px;
            background: rgba(0,0,0,0.5);
        }
        .logo {
            height: 30px; 
            width: auto;
        }
        .carousel-image {
            height: 280px; width: auto;
        }
        @media only screen and (max-width: 1000px) {
            .carousel-claninfo {
                display: none !important;
            }

        }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-2">
        <a class="navbar-brand" href="#"><img src="images/logo.png" class="logo"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="test.php"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="addclan.php"><i class="fas fa-plus"></i> Add Clan</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="signup.php"><i class="fas fa-user-plus"></i> Sign Up</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0" action="#">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fas fa-user-circle"></i> Sign In</button>
          </form>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center bg-secondary outter-jumbotron">
            <div class="container-fluid justify-content-center d-flex inner-jumbotron">
                <div id="carouselExampleIndicators" class="carousel slide d-flex justify-content-center" data-ride="carousel">
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
                        <div class="carousel-item active d-flex">
                            
                            <div class="text-white d-flex flex-column m-auto p-2 mb-3 carousel-claninfo">
                                <h3 class="font-weight-bold text-center">No Limits</h3>
                                <p>A really awesome freaking great clan! Everyone should definitely join!</p>
                                <button class="btn btn-primary btn-lg m-auto">View Clan</button>
                            </div>

                            <img src="images/nolimits.jpg" class="img-fluid d-flex m-auto carousel-image" alt="...">

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
            <div class="card m-2" style="width: 18rem;">
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
    <footer class="container-fluid row bg-dark text-light justify-content-center p-3">
        <div class="row justify-content-center col-5">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <h5>Site Map</h5>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Add Clan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sign In</a>
                </li>
            </ul>
        </div>
        <div class="col justify-content-start col-5">
            <h3>Fortnite Clans</h3>
            <p>Welcome to Fortnite Clan, the best place to find Clans and Communities to join to take your Fortnite experience to the next level. If you are a Clan owner you can submit your clan to this website and tell the Fortnite community that you exist! Don't get caught out in Tilted Towers without your Clan mates!</p>
        </div>
    </footer>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123158934-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-123158934-1');
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>    
</body>
</html>