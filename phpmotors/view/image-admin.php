<?php  
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/small.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/large.css">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    
    <title>PHP Motors Homepage</title>

</head>
<body>
    <div id="wrapper"> 
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
    </header>

    <nav>
        <?php echo $navList; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php'; ?>
    </nav>

        <main>
            <h1>Image Management</h1> 
            <p class="vehicleImg">Welcome to the Image Management Page. Choose from the options below.</p>

            <h2 class="vehicleImg">Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
            echo $message;
            } ?>

            <form action="/phpmotors/uploads/" class="form" method="post" enctype="multipart/form-data">
                <label for="invItem">Vehicle</label>
                <?php echo $prodSelect; ?>
                <fieldset>
                    <legend>Vehicle Main Image?</legend>
                    <!-- <label></label> -->
                    <p class="radio">
                        <label for="priYes" class="pImage">Yes</label>
                        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    </p>
                    <p class="radio">
                       <label for="priNo" class="pImage">No</label>
                        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0"> 
                    </p>
                </fieldset>
                <label>Upload Image:</label>
                <p>
                    <input type="file" name="file1">
                </p>
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </form>
            <hr>
            <h2 class="vehicleImg">Existing Images</h2>
            <p class="vehicleImg">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
            echo $imageDisplay;
            } ?>
        </main>
        <footer id="site_footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>
<?php unset($_SESSION['message']); ?>