<?php
include('header.php');

//Kick the user out if they are not logged in.
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

//Check to see if the user already has a clan and kick them out if so.
$userid = $_SESSION['userid'];
$query = "SELECT * FROM clans WHERE userid = '$userid'";
$return = $conn->query($query);
$row = $return->fetch_assoc();

if (isset($row['name'])) {
    header('Location: editclan.php');
    exit;
}

//Check to see if the form was submitted.
if (isset($_POST['name'])) {
    //Assign information received from the form to variables
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $discord = filter_var($_POST['discord'], FILTER_SANITIZE_URL);
    $website = filter_var($_POST['website'], FILTER_SANITIZE_URL);

    //Check to see if the clan name is taken. If it is, don't run the rest of the code and return an error.
    $query = "SELECT * FROM clans WHERE name = '$name'";
    $return = $conn->query($query);
    $row = $return->fetch_assoc();

    if (isset($row['name'])) {
        echo '<div class="alert alert-danger col-3 col-sm-11 m-auto mt-2">Clan name is not available.</div>';
    } else if ($name == "") {
        echo '<div class="alert alert-danger col-3 col-sm-11 m-auto mt-2">Please complete all fields.</div>';
    } else {

        //Handle the image received from the form.
        if(isset($_FILES['image'])){
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            //Define the allowed file types and check to see if the uploaded file is of those types.
            $expensions= array("jpeg","jpg","png","svg");

            if(in_array($file_ext,$expensions)=== false){
                echo '<div class="alert alert-danger mt-2">File extension not allowed, please choose a JPEG, PNG, or SVG file.</div>';
                $errors[]="File extension not allowed, please choose a JPEG, PNG, or SVG file.";
            }

            //Check to make sure the file size is under 2MB.
            if($file_size > 2097152) {
                echo '<div class="alert alert-danger mt-2 col-3 col-sm-11 m-auto">File size must be less than 2 MB</div>';
                $errors[]='File size must be less than 2 MB';
            }

            //If the type and size are correct, move the file ionto the images directory.
            if(empty($errors)==true) {
                $file_name = rand(100,500).$file_name;
                if(move_uploaded_file($file_tmp,"images/".$file_name)) {
                    echo '<div class="alert alert-success col-3 col-sm-11 m-auto">Image successfully uploaded as '.$file_name.'</div>';
                } else {
                    echo '<div class="alert alert-danger mt-2 col-3 col-sm-11 m-auto">Image upload failed.</div>';
                }

            }
        }
        $sql = "INSERT INTO clans (name, description, picture, discord, website, userid) VALUES ('$name','$description','$file_name','$discord','$website',$userid)";
        $conn->query($sql);
        echo '<div class="alert alert-success col-3 col-sm-11 m-auto">Data successfully posted to the database.</div>';
        header('Location: editclan.php');
    }
}


?>

<div class="container mt-2 mb-2">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-7">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label>
                    <input type="Text" class="form-control" name="name" />
                    <small class="form-test text-muted">The name of the Clan goes here.</small>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="description"></textarea>
                    <small class="form-test text-muted">The description of the Clan goes here.</small>
                </div>
                <div class="form-group">
                    <label for="image-upload">Clan Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <small class="form-test text-muted">Please choose an image that is 16:9 in ratio (The larger the better.)</small>
                </div>
                <div class="form-group">
                    <label>Discord</label>
                    <input type="Text" class="form-control" name="discord" />
                    <small class="form-test text-muted">A link to the Clan's Discord Server.</small>
                </div>
                <div class="form-group">
                    <label>Website</label>
                    <input type="Text" class="form-control" name="website" />
                    <small class="form-test text-muted">A link to the Clan's website.</small>
                </div>
                <button class="btn btn-primary btn-lg">Add Clan</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
