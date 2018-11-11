<?php
include('adminheader.php');

$query = new Query;
$numClans = $query->clansByNum();
$numUsers = $query->usersByNum();
$numFeatured = $query->featuredByNum();
$listClans = $query->clansLimited();
$totalPages = ceil($numClans / $query->no_of_records_per_page);
?>
    <div class="container-fluid col-11 col-md-9 mt-2">
      <div class="container-fluid col-10 col-md-10">
        <div class="row text-white">
          <div class="container-fluid col-4 pl-0 pr-1">
            <div class="card bg-primary-gradient col-12">
              <div class="card-header row">Users</div>
              <div class="card-body row">
                <i class="fas fa-users my-auto display-4"></i>
                <h2 class="display-4 my-auto ml-auto"><?=$numUsers ?></h2>
              </div>
            </div>
          </div>
          <div class="container-fluid col-4 px-1">
            <div class="card bg-info-gradient col-12">
              <div class="card-header row">Clans</div>
              <div class="card-body row">
                <i class="fas fa-gopuram my-auto display-4"></i>
                <h2 class="display-4 my-auto ml-auto"><?=$numClans; ?></h2>
              </div>
            </div>
          </div>
          <div class="container-fluid col-4 pr-0 pl-1">
            <div class="card bg-success-gradient col-12">
              <div class="card-header row">Featured</div>
              <div class="card-body row">
                <i class="fas fa-star my-auto display-4"></i>
                <h2 class="display-4 my-auto ml-auto"><?=$numFeatured; ?></h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-2">
            <table class="table table-hover table-striped">
                <thead class="text-white bg-dark">
                  <tr>
                    <th scope="col">Clan Image</th>
                    <th scope="col">Clan Name</th>
                    <th class="text-center" scope="col">Edit</th>
                    <th class="text-center" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $listClans->fetch_assoc()): ?>
                    <tr>
                      <th scope="row"><img src="images/<?=$row['picture'];?>" style="height: 32px; width: auto;" /></td>
                      <td><?=$row['name']; ?></td>
                      <td class="text-center"><a href="edit.php?id=<?=$row['id']; ?>"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button></a></td>
                      <td class="text-center"><a href="delete.php?id=<?=$row['id']; ?>"><button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></a></td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table> 
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
  </div>
<?php include('adminfooter.php'); ?>