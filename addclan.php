<?php include('header.php'); ?>

<div class="container mt-2 mb-2 minh-72" style="min-height: 72vh;">
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