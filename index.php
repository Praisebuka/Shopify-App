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

# Displaying the Product's title and Images
$image = '';
$title = '';

# Setting the collection variables
$collectionList = shopify_call($token, $shop, "/admin/api/2019-10/custom_collections.json", array(), 'GET');
$collectionList = json_decode($collectionList['response'], JSON_PRETTY_PRINT);
$collectioni_id = $collectionList['custom_collections'] [0] ['id'];


$collects = shopify_call($token, $shop, "/admin/api/2019-10/collects.json", array("collection_id" => $collection_id), 'GET');
$collects = json_decode($collects['response'], JSON_PRETTY_PRINT);

# Making the foreach loop for looping through the collections on our APP
foreach ($collects as $collect) {
    foreach ($collect as $key => $value) {
        $products = shopify_call($token, $shop, "/admin/api/2019-10/products/". $value['product_id'] . ".json", array(), 'GET');
        $products = json_decode($products['response'], JSON_PRETTY_PRINT);

        $images = shopify_call($token, $shop, "/admin/api/2019-10/products/". $value['product_id'] . "/imags.json", array(), 'GET');
        $images = json_decode($images['response'], JSON_PRETTY_PRINT);

        $image = $images['images'] [0] ['src'];
        $title = $products['product'] ['title'];
    }
}

$theme = shopify_call($token, $shop, "/admin/api/2019-10/themes.json", array(), 'GET');
$theme = json_decode($theme['response'], JSON_PRETTY_PRINT);

foreach ($theme as $cur_theme) {
    foreach ($cur_theme as $key => $value ) {
        if ($value['role'] === 'main') {
            echo "Theme ID: " . $value['id'] . "<br />";
            echo "Theme Name: " . $value['name'] . "<br />";

            $array = array(
                'asset' => array(
                    'key' => 'templates/index.liquid',
                    'value' => '<h1>Hello Praise.....from Shopify!!!</h1>'
                )
            );

            $assets = shopify_call($token, $shop, "/admin/api/2019-10/themes/". $value['id']. "/assests.json".$array, 'PUT');
            $assets = json_decode($assets['response'], JSON_PRETTY_PRINT);

        }
    }
}








?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify App</title>
</head>
<body>
    
    <h1>Praisebuka's version of Shopify</h1>
    <img src="<?php echo $image; ?>" alt="The product image" style="width: 250px;">
    <p> <?php echo $title; ?> </p>

</body>
</html>