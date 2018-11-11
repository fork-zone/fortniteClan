<?php 
include("header.php");

//Kick the user out if they are not logged in.
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

//Get the ID, query the database for values to be used if nothing has changed.
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM clans WHERE userid = $userid";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//Check to see if we have received any information from the form.
if (isset($_POST['name'])) {

    //Assign information received from the form to variables
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $discord = filter_var($_POST['discord'], FILTER_SANITIZE_URL);
    $website = filter_var($_POST['website'], FILTER_SANITIZE_URL);

    //Check to see if the clan name is taken. If it is, don't run the rest of the code and return an error.
    $query = "SELECT name FROM clans WHERE name = '$name'";
    $query2 = "SELECT name FROM clans WHERE userid = $userid";

    $return = $conn->query($query);
    $return2 = $conn->query($query2);

    $row = $return->fetch_assoc();
    $row2 = $return2->fetch_assoc();

    if (isset($row['name']) && ($row['name'] != $row2['name'])) {
        echo '<div class="alert alert-danger col-3 col-sm-11 m-auto mt-2">Clan name is not available.</div>';
    } else {

        //Check to see if a new image was uploaded and if so upload it! Otherwise just keep the same image.
        if ($_FILES['image']['error']==0){
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            //Define the allowed file types
            $expensions= array("jpeg","jpg","png","svg");
            
            //Check to see if the image uploaded is one of the allowed file types.
            if(in_array($file_ext,$expensions)=== false){
                echo '<div class="alert alert-danger mt-2">File extension not allowed, please choose a JPEG, PNG, or SVG file.</div>';
            $errors[]="File extension not allowed, please choose a JPEG, PNG, or SVG file.";
            }

            //Check to make sure the file size is under 2MB.
            if($file_size > 2097152) {
                echo '<div class="alert alert-danger mt-2 col-3 col-sm-11 m-auto">File size must be less than 2 MB</div>';
            $errors[]='File size must be less than 2 MB';
            }

            //Check to see if there were any errors and display an alert based on the result.
            if(empty($errors)==true) {
                $file_name = rand(100,500).$file_name;
                if(move_uploaded_file($file_tmp,"images/".$file_name)) {
                    echo '<div class="alert alert-success">Image successfully uploaded.</div>';
                } else {
                    echo '<div class="alert alert-danger">Did not upload :(</div>';
                }
            }
        } else {
            //Since no new image was uploaded, use the image name currently in the database.
            $sql = "SELECT picture FROM clans WHERE userid = $userid";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $file_name = $row['picture'];
        }
        $sql1 = "UPDATE clans SET name='$name', description='$description', picture='$file_name', discord='$discord', website='$website', userid=$userid WHERE userid=$userid";
        $conn->query($sql1);
        echo '<div class="alert alert-success">The changes were successful.</div>';

        //Query the SQL database AGAIN so we can reflect the updated changes into the edit form.
        $sql = "SELECT * FROM clans WHERE userid = $userid";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
} else {
    //Since the form was not submitted, query the database to get the values to put into the edit form.
    $sql = "SELECT * FROM clans WHERE userid = $userid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

?>
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-7">
                <form action="editclan.php?" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="Text" class="form-control" name="name" value="<?=$row['name']?>" />
                        <small class="form-test text-muted">The name of the Clan goes here.</small>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description"><?=$row['description']?></textarea>
                        <small class="form-test text-muted">The description of the Clan goes here.</small>
                    </div>
                    <div class="form-group">
                        <label for="image-upload">Clan Image</label>
                        <img class="mb-3" src="images/<?=$row['picture']?>" style="height: 100px; width: auto; display: block;" />
                        <input type="file" class="form-control-file" id="image" name="image">
                        <small class="form-test text-muted">Please choose an image that is 16:9 in ratio. Larger is better.</small>
                    </div>
                    <div class="form-group">
                        <label>Discord</label>
                        <input type="Text" class="form-control" name="discord" value="<?=$row['discord']?>" />
                        <small class="form-test text-muted">A link to the Clan's Discord Server.</small>
                    </div>
                    <div class="form-group">
                        <label>Website</label>
                        <input type="Text" class="form-control" name="website" value="<?=$row['website']?>" />
                        <small class="form-test text-muted">A link to the Clan's website.</small>
                    </div>
                    <button class="btn btn-primary btn-lg mb-2">Update</button>
                </form>
            </div>
        </div>
    </div>
<?php include("footer.php"); ?>