<?PHP
include('../connection.php');




$duration='["12"]';

$sqlgrade9="SELECT COUNT(*) as totalpayedpromo FROM( SELECT id FROM `transaction_bank_new` WHERE `promo` IS NOT NULL AND JSON_CONTAINS(`duration`, ?, '$') AND promo != 'Null' AND `promo` NOT IN ( 'telegram','whatsapp','facebook','friends','others') AND status=2  UNION ALL SELECT id FROM checkout_new WHERE `promo` IS NOT NULL AND promo != 'Null' AND JSON_CONTAINS(`duration`, ?, '$') AND  `promo` NOT IN ( 'telegram','whatsapp','facebook','friends','others') AND status=1 ) AS combined_tables";

$stmtgrade=$conn3->prepare($sqlgrade9);

$stmtgrade->bind_param('ss', $duration, $duration);
$stmtgrade->execute();


$resultgrade=$stmtgrade->get_result();


if($resultgrade->num_rows>0){

   $row=$resultgrade->fetch_assoc();
   echo $row['totalpayedpromo'];
}
else{
    echo "0";
}




?>