<?php


if (isset($_SESSION["Admin"])) {
$AdminQuery  = $DatabaseConnect->prepare("SELECT * FROM members WHERE EmailAddress = ? LIMIT 1");
$AdminQuery->execute([$_SESSION["Admin"]]);
$AdminCount  = $AdminQuery->rowCount();
$Admin       = $AdminQuery->fetch(PDO::FETCH_ASSOC);

if ($AdminCount > 0) {
$AdminID                 =    $Admin["id"];
$AdminName               =    $Admin["AdminName"];
$AdminEmailAddress       =    $Admin["Email"];
$AdminPassword           =    $Admin["Password"];
$AdminNameSurname        =    $Admin["NameSurname"];
$AdminPhoneNumber        =    $Admin["Phone"];

} else {
echo "ERROR";
die();
}
}
