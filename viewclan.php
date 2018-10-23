<?php include("header.php"); 

$id = $_GET['clan'];
$sql = "SELECT * FROM clans WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
    <div class="container-fluid minh-72">
        <div class="row bg-dark justify-content-center">
                <img src="images/<?=$row['picture'];?>"  class="clan-image"/>
        </div>
        <div class="container col-12 col-sm-6 justify-content-center align-items-center d-flex flex-column">
            <div class="row align-content-center col-12 mt-3 mb-2 p-0 clan-buttons">
                    <h1 class="clan-name"><?=$row['name'];?></h1>
                    <a href="<?=$row['discord'];?>" target="_blank"><button class="btn btn-primary btn-lg"><i class="fab fa-discord"></i> Discord</button></a> <a href="<?=$row['website'];?>" target="_blank"><button class="btn btn-info btn-lg"><i class="fas fa-globe-americas"></i> Website</button></a>
            </div>
            <p class="float-left clan-text pt-2">
                <?=$row['description'];?>
            </p>
        </div>
    </div>
<?php include('footer.php'); ?>