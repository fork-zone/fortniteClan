<?php
include('adminheader.php');

//Pagination
if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}


$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;

//Query the DB to see how many rows there are to calculate the number of pages.
$total_pages_sql = "SELECT COUNT(*) FROM clans";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

//$sql2 = "SELECT * FROM clans LIMIT $offset, $no_of_records_per_page";
//$res_data = mysqli_query($conn,$sql2);

?>
    <div class="container mt-2">
        <div class="row">
            <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Clan Image</th>
                    <th scope="col">Clan Name</th>
                    <th class="text-center" scope="col">Edit</th>
                    <th class="text-center" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = "SELECT * FROM clans LIMIT $offset, $no_of_records_per_page";
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) { 
                  ?>
                  <tr>
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td><img src="images/<?php echo $row['picture'];?>" style="height: 32px; width: auto;" /></td>
                    <td><?php echo $row['name']; ?></td>
                    <td class="text-center"><a href="edit.php?id=<?php echo $row['id']; ?>" ><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button></a></td>
                    <td class="text-center"><a href="delete.php?id=<?php echo $row['id']; ?>" ><button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table> 
          </div>
          <?php

            if (isset($_GET['pageno'])) {
              $pageno = $_GET['pageno'];
            } else {
              $pageno = 1;
            }
            $no_of_records_per_page = 10;
            $offset = ($pageno-1) * $no_of_records_per_page;

            $total_pages_sql = "SELECT COUNT(*) FROM clans";
            $result = mysqli_query($conn,$total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
    
            //$sql2 = "SELECT * FROM table LIMIT $offset, $no_of_records_per_page";
            //$res_data = mysqli_query($conn,$sql2);

          ?>

          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" tabindex="-1">Previous</a>
            </li>
            <?php
              for ($x = 1; $x <= $total_pages; $x++) {
                ?>

                <li class="page-item <?php if($pageno == $x){ echo 'active'; } ?>"><a class="page-link" href="?pageno=<?=$x?>"><?=$x?></a></li>

                <?php
              }
            ?>
            <li class="page-item">
              <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
            </li>
          </ul>   
      </div>
<?php include('adminfooter.php'); ?>