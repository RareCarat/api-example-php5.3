<?php

# Documentation available here: https://api.rarecarat.com/#method-get

require '../vendor/autoload.php';

# The API Key to use in all Rare Carat API requests.
# Use your *sandbox* access token if you're just testing things out.
$api_key = 'REPLACEME';

$data = file_get_contents('./data/create.csv');

$status_code =  0;
$body = "";

try
{
  
  $response = \Httpful\Request::post("https://api.rarecarat.com/v1/diamonds")
    ->authenticateWithBasic($api_key, '')
	->addHeader('Accept', 'text/csv') 
	->addHeader('Content-Type', 'text/csv') 
	->body($data) 
    ->send(); 

  $status_code = $response->code;
  $body = $response->raw_body;
}
catch (Httpful\Exception $e)
{
    $status_code = $e->getCode();
    $body = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Rare Carat API Example - PHP</title>
    <link rel="stylesheet" href="https://api.rarecarat.com/css/site.min.css" asp-append-version="true" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link rel="stylesheet" href="/style.css" asp-append-version="true" />
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <a class="navbar-brand" href="/">Rare Carat API</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="https://api.rarecarat.com">API Documentation</a>
        </li>
      </ul>
    </nav>

    <div class="hero">
      <div class="container">
        <div class="">
          <h1>PHP - POST with CSV</h1>
          <p>
            This page executes a POST to /diamonds to create resources. Feel free to email us at <a href="mailto:api@rarecarat.com">api@rarecarat.com</a>.
          </p>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="">
          <section>
            <h2 class="page-header">HTTP Response Code</h2>
            <p>
              <code><?php echo $status_code; ?></code>
            </p>
            <h2 class="page-header">HTTP Response Body</h2>
            <pre><?php echo $body; ?></pre>
          </section>
        </div>
      </div>
    </div>

  </body>
</html>