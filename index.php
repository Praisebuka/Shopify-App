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
$collectionList = shopify_call($token, $shop, "/admin/api/2019-10/custom_collections.json", array(), 'GET');
$collectionList = json_decode($collectionList['response'], JSON_PRETTY_PRINT);
$collectioni_id = $collectionList['custom_collections'] [0] ['id'];

echo $collection_id;

$collects = shopify_call($token, $shop, "/admin/api/2019-10/collects.json", array("collection_id" => $collection_id), 'GET');
$collects = json_decode($collects['response'], JSON_PRETTY_PRINT);

# Making the foreach loop for looping through the collections on our APP
foreach ($collects as $collect) {
    foreach ($collect as $key => $value) {
        $products = shopify_call($token, $shop, "/admin/api/2019-10/products/". $value['product_id'] . ".json", array(), 'GET');
        $products = json_decode($products['response'], JSON_PRETTY_PRINT);

        echo $products['product'] ['title'] . '<br />';
    }
}




?>