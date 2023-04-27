<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/small.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/large.css">

    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <title>PHP Motors Add Classification</title>

</head>
<body>
    <div id="wrapper"> 
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>

    <nav>
        <?php echo $navList; ?>
        <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/snippets/nav.php'; ?>
    </nav>

    <main>
        <h1>Add A Classification</h1>  
        <?php if (isset($message)) {echo $message;} ?>        

        <form action="/phpmotors/vehicles/index.php" method="post">
            <label>Enter a new classification (max 30 characters):</label><br>    
            <input required type="text" name="classificationName" maxlength="30"><br>
            <input type="submit" name="submit" id="subbtn" value="Submit Classification">
            <input type="hidden" name="action" value="addClassification">
        </form>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
    <script src="/phpmotors/js/main.js"></script>
</body>
</html>