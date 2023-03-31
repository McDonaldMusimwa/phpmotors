<?php
function retriveAllReviews($invId)
{

   $db = phpmotorsConnect();
   $sql = 'SELECT clients.clientFirstname, clients.clientLastname,reviews.* ,inventory.invMake, inventory.invModel
           FROM clients
           INNER JOIN reviews
           ON clients.clientId = reviews.clientId
           INNER jOIN inventory
           ON reviews.invId = inventory.invId
           WHERE reviews.invId = :invId
           ORDER BY reviewDate DESC';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
   $stmt->execute();
   $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $reviews;
}

function addReview($invId, $clientId, $reviewTxt)
{
   $db = phpmotorsConnect();
   $sql = 'INSERT INTO reviews (invId, clientId,reviewTxt) 
   VALUES (:invId, :clientId, :reviewTxt)';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   $stmt->bindValue(':reviewTxt', $reviewTxt, PDO::PARAM_STR);

   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}

function retriveEachClientReviews($clientId)
{
   $db = phpmotorsConnect();
   $sql = 'SELECT reviews.* ,inventory.invMake, inventory.invModel
           FROM reviews
           INNER JOIN inventory
           ON reviews.invId = inventory.invId
           WHERE clientId = :clientId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
   $stmt->execute();
   $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $reviews;
}


function updateReview($reviewId, $reviewTxt)
{
   $db = phpmotorsConnect();
   $sql = 'UPDATE reviews 
SET reviewTxt = :reviewTxt
WHERE reviewId= :reviewId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewTxt', $reviewTxt, PDO::PARAM_STR_CHAR);
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}


function getReviewData($reviewId)
{
   $db = phpmotorsConnect();
   $sql = 'SELECT clients.clientFirstname, clients.clientLastname,reviews.* ,inventory.invMake, inventory.invModel
    FROM clients
    INNER JOIN reviews
    ON clients.clientId = reviews.clientId
    INNER jOIN inventory
    ON reviews.invId = inventory.invId
    WHERE reviews.reviewId = :reviewId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->execute();
   $reviewData = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();

   return $reviewData;
}

function deleteReview($reviewId)
{
   $db = phpmotorsConnect();
   $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}
