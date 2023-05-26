<?php 
require_once("inc/functions.php");

# Setting the required variable 
$requests = $_GET;
$hmac = $_GET['hmac'];
$serializeArray = serialize($requests);
$requests = array_diff_key($requests, array( 'hmac' => ''));
ksort($requests);

$token = "089u398hf7wyhe7h3872uy48uje8h93428";
$shop = "weeklyhow";

# Setting the collection variables
$collectionList = shopify_call($token, $shop, "/admin/api/20")




?>