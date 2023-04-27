<?php

//create drop list
$dropList = '<select name="classificationId" id="classificationId">';
foreach ($classifications as $classification) {
    $dropList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)) {
        if($classification['classificationId'] == $classificationId) {
            $dropList .= ' selected ';
        }
    }
    $dropList .= ">$classification[classificationName]</option>";
}
$dropList .= "</select>";

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/small.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/large.css">

    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <title>PHP Motors Add Vehicle</title>

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
        <h1>Add A Vehicle</h1>
        <?php if (isset($message)) {echo $message;} ?>        
        <p>Note: all fields are required.</p>
        <form action="phpmotors/vehicles/index.php" method="post">   
            <label>Classification</label><br>
            <?php echo $dropList; ?><br>
            <label>Make</label><br>
            <input required type="text" name="invMake" id="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} ?> ><br>
            <label>Model</label><br>
            <input required type="text" name="invModel" id="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} ?> ><br>
            <label>Description</label><br>
            <textarea required name="invDescription" id="invDescription"><?php if(isset($invDescription)){echo $invDescription;}?></textarea><br>
            <label for="invImage">Image Path</label>
            <input type="text" name="invImage" value="/phpmotors/images/no-images.png"><br>
            <label for="invThumbnail">Image Path</label>
            <input type="text" name="invThumbnail" value="/phpmotors/images/no-images.png"><br>
            <label>Price ($x.xx)</label><br>        
            <input required type="text" name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> pattern="^\$[\d,]+(\.\d{2})?$" ><br>
            <label>Quantity in Stock</label><br>
            <input required type="number" name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> ><br>
            <label>Color</label><br>        
            <input required type="text" name="invColor" id="invColor" maxlength="15" <?php if(isset($invColor)){echo "value='$invColor'";} ?> ><br>
            <input type="submit" name="submit" id="regbtn" value="Add Vehicle">
            <input type="hidden" name="action" value="addVehicle">
        </form>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
    <script src="/phpmotors/js/main.js"></script>
</body>
</html>