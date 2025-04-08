<?PHP
include('../connection.php');




$grade='["Grade 9"]';

$sqlgrade9="SELECT COUNT(*) as totalpayedpromo FROM( SELECT id FROM `transaction_bank_new` WHERE `promo` IS NOT NULL AND `promo` !='Null' AND  `promo` NOT IN ( 'telegram','whatsapp','facebook','friends','others') AND status=2 AND `course_name`=? UNION ALL SELECT id FROM checkout_new WHERE `promo` IS NOT NULL AND `promo` !='Null' AND  `promo` NOT IN ( 'telegram','whatsapp','facebook','friends','others') AND status=1 AND `course_name`=? ) AS combined_tables";


$stmtgrade=$conn3->prepare($sqlgrade9);

$stmtgrade->bind_param('ss', $grade, $grade);
$stmtgrade->execute();


$resultgrade=$stmtgrade->get_result();


if($resultgrade->num_rows>0){

   $row=$resultgrade->fetch_assoc();
   echo $row['totalpayedpromo'];
}




?>