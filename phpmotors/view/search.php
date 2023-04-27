<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/small.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/large.css">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <title>PHP Motors Search Bar</title>
    
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

        <div id="header-search-bar">

        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>

        <form method="post" action="/phpmotors/search/index.php" id="search-bar-form">
            <label>
            <input type="search" id="search-bar" name="search" required 

            <?php if(isset($search)){ echo "value='$search'"; }; ?> ></label>
            <button type="submit" name="submit" value="Search" id="search-btn">Search</button>
            <input type="hidden" name="action" value="search">
            
        </form>
        </div>

            <div id="content-title">
                <h1>Search Results</h1>
            </div>

            <?php
                if (isset($searchMessage)) {
                    echo $searchMessage;
                }
            ?>

            <div id="search-results">
                <?php if(isset($searchDisplay)){
                    echo $searchDisplay;
                } ?>
            </div>

        </main>
        <aside></aside>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/snippets/footer.php'; ?>
    </footer>
    </div>
    <script src="/phpmotors/js/main.js"></script>
        
    </div>
    </body>
    </div>
</html>