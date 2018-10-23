<?php 
include("adminheader.php"); 

if (isset($_POST['name'])) {
    //Assign information received from the form to variables
    $name = $_POST['name'];
    $description = $_POST['description'];
    $discord = $_POST['discord'];
    $website = $_POST['website'];
    $userid = 1;
    echo '<div class="alert alert-success">Received POST variables</div>';

    if(isset($_FILES['image'])){
        echo '<div class="alert alert-success">FILES is set.</div>';
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
        
        $expensions= array("jpeg","jpg","png","svg");
        
        if(in_array($file_ext,$expensions)=== false){
           $errors[]="File extension not allowed, please choose a JPEG, PNG, or SVG file.";
        }
        
        if($file_size > 2097152) {
           $errors[]='File size must be less than 2 MB';
        }
        
        if(empty($errors)==true) {
            if(move_uploaded_file($file_tmp,"images/".$file_name)) {
                echo '<div class="alert alert-success">Image successfully uploaded.</div>';
            } else {
                echo "nope. didnt upload";
            }
            
           
           //echo '<div class="alert alert-success">The temp directory is showing as '.$file_tmp.'</div>';
           //print_r($errors);
        }else{
            print_r($errors);
        }
    }
    $sql = "INSERT INTO clans (name, description, picture, discord, website, userid) VALUES ('$name','$description','$file_name','$discord','$website',$userid)";
    $conn->query($sql);
    echo '<div class="alert alert-success">Data successfully posted to the database.</div>';
}
?>
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-7">
                <form action="add.php" method="POST" enctype="multipart/form-data">
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
                        <small class="form-test text-muted">Please choose an image that is 16:9 in ratio (480x320)</small>
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
<?php include("adminfooter.php"); ?>