<?php 
include("header.php");
    
$query = new Query;
$featuredClans = $query->featuredClans();
$listClans = $query->clansLimited();
$numClans = $query->clansByNum();
$totalPages = ceil($numClans / $query->no_of_records_per_page);
$x = 0;
?>
<div class="container-fluid">
    <div class="row justify-content-center align-items-center bg-secondary outter-jumbotron">
        <div class="container-fluid justify-content-center d-flex inner-jumbotron">
            <div id="carouselExampleIndicators" class="carousel slide d-flex align-items-center" data-ride="carousel">
                <a class="carousel-control-prev position-relative" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <ol class="carousel-indicators p-1 m-1 force-btm">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner justify-content-center">
                    <?php while ($queryRow = $featuredClans->fetch_assoc()):?>
                        <div class="carousel-item <?php echo $x == 0 ? 'active' : ''; ?>">
                            <div class="flex-sm-row flex-column justify-content-center d-flex">
                                <div class="text-white d-flex flex-column m-auto p-2 mb-3 carousel-claninfo">
                                    <h3 class="font-weight-bold text-center"><?=$queryRow['name']; ?></h3>
                                    <p><?=$queryRow['description']; ?></p>
                                    <a class="m-auto" href="viewclan.php?clan=<?=$queryRow['id']; ?>"><button class="btn btn-primary btn-lg m-auto">View Clan</button></a>
                                </div>
                                <img src="images/<?=$queryRow['picture']; ?>" class="img-fluid m-auto carousel-image" alt="...">
                                <a class=" d-sm-none" href="viewclan.php?clan=<?=$queryRow['id']; ?>"><button class="btn btn-primary btn-block d-sm-none mt-2">View Clan</button></a>
                            </div>
                        </div>
                    <?php $x++; endwhile;  ?>
                </div>
                <a class="carousel-control-next position-relative" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <?php while ($row = $listClans->fetch_assoc()):
            $description = strlen($row['description']) > 110 ? substr($row['description'], 0, 110).'...' : $row['description'];
        ?>
            <div class="card m-2 card-size">
                <img class="card-img-top max-190" src="images/<?=$row['picture']; ?>" alt="<?=$row['name']; ?> Fortnite Clan">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?=$row['name']; ?></h5>
                    <p class="card-text"><?=$description ?></p>
                    <a href="viewclan.php?clan=<?=$row['id'];?>" class="btn btn-primary align-self-center mt-auto">View Clan</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="<?php echo $query->pageno <= 1 ? '#' : '?pageno='.($query->pageno -1); ?>" tabindex="-1">Previous</a>
        </li>
        <?php for ($x = 1; $x <= $totalPages; $x++): ?>
            <li class="page-item <?php echo $query->pageno == $x ? 'active' : ''; ?>"><a class="page-link" href="?pageno=<?=$x?>"><?=$x?></a></li>
        <?php endfor; ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $query->pageno >= $totalPages ? '#' : '?pageno='.($query->pageno + 1) ?>">Next</a>
        </li>
    </ul>   

</div>
  <?php include('footer.php'); ?>