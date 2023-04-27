<img id="logo" src="/phpmotors/images/site/logo.png" alt="Company Logo">
<a id="search-logo" href="/phpmotors/view/search.php"> <img src="/phpmotors/images/search-icon.png"></a>


<?php 


if(isset($_SESSION['loggedin'])) {
    if ($_SESSION['loggedin'] === TRUE) {
        if(isset($cookieFirstname)){
            echo "<a href=\"/phpmotors/view/admin.php\"><span>Welcome, $cookieFirstname</span></a>";
        }
        echo '<a id="acctLink" href="/phpmotors/accounts/index.php/?action=Logout">Logout</a>';
    }


} else {
    echo '<a id="acctLink" href="/phpmotors/accounts/index.php/?action=login-page">My Account</a>';}

?>



