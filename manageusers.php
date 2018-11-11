<?php
include('adminheader.php');
$query = new Query;
$numUsers = $query->usersByNum();
$listUsers = $query->usersLimited();
$totalPages = ceil($numUsers / $query->no_of_records_per_page);


 ?>
<div class="container-fluid col-11 col-md-9 mt-2 minh-72">
  <div class="row mt-2">
    <table class="table table-hover table-striped">
        <thead class="text-white bg-dark">
          <tr>

            <th scope="col">User Name</th>
            <th class="text-center" scope="col">Edit</th>
            <th class="text-center" scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $listUsers->fetch_assoc()): ?>
            <tr>
              <th scope="row"><?=$row['username'];?></th>
              <td class="text-center"><a href="edituser.php?id=<?=$row['id']; ?>"><button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button></a></td>
              <td class="text-center"><a href="deleteuser.php?id=<?=$row['id']; ?>"><button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></a></td>
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

<?php include('adminfooter.php'); ?>
