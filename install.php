<?php

// Set variables for our request
$shop = $_GET['shop'];
$api_key = "1r30mrvCFMfq2DLSadinY2veEJVgTtDD";
$scopes = "read_orders, write_products";
$redirect_uri = "https://weeklyhow.com/apps/exampleApp/generate_token.php";

// Build install or approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();