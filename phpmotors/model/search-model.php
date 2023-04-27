<?php
function searchInventory($search) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invMake LIKE ? OR invModel LIKE ? OR invDescription LIKE ? OR invPrice LIKE ? OR invColor LIKE ?';
    $stmt = $db->prepare($sql);
    $searchTerm = "%{$search}%";
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
    $searchOutcome = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $searchOutcome;
}
?>