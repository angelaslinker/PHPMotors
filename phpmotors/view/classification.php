
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/small.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/large.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/inventory.css">

    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>

</head>
<body>
    <div id="wrapper"> 
    <header>
    <header>

        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
    </header>

    <nav>
        <?php echo $navList; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php'; ?>
    </nav>
 

    <main>
        <h1><?php echo $classificationName; ?> vehicles</h1>
        <?php if(isset($message)){echo $message; } ?>
        <?php if(isset($vehicleDisplay)){echo $vehicleDisplay;} ?>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
    <script src="/phpmotors/js/main.js"></script>
</body>
</html>