<?php

# Documentation available here: https://api.rarecarat.com/#method-get

require '../vendor/autoload.php';

# The API Key to use in all Rare Carat API requests.
# Use your *sandbox* access token if you're just testing things out.
$api_key = 'REPLACEME';

$data = file('./data/create.csv');

$status_code =  0;
$body = "";

$chunk_size = 100;

$total_records = count($data);

$successful_records = 0;

if ($total_records > 1)
{
	$csv_header = $data[0];
	$current_record = 1;
	
	$success = true;
	
	while ($success && $current_record < $total_records)
	{
		
		$chunk = array_slice($data, $current_record, $chunk_size);
		
		try
		{
		  
		  $response = \Httpful\Request::post("http://localhost:5000/v1/diamonds")
			->authenticateWithBasic($api_key, '')
			->addHeader('Accept', 'text/csv') 
			->addHeader('Content-Type', 'text/csv') 
			->body($csv_header . implode($chunk)) 
			->send(); 

		  $status_code = $response->code;
		  $body = $response->raw_body;
		  
		  $success =  ($status_code >= 200 && $status_code < 300);
		}
		catch (Httpful\Exception $e)
		{
			$status_code = $e->getCode();
			$body = $e->getMessage();
			$success = false;
		}
		
		if ($success)
		{
			$current_record += $chunk_size;
			$successful_records += count($chunk);
		}
		
		//die('successful_records='.$successful_records. ' - status_code='. $status_code);
	}
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
          <h1>PHP - Chunked POST with CSV</h1>
          <p>
            This page executes several POSTS to /diamonds to create resources in chunks. Feel free to email us at <a href="mailto:api@rarecarat.com">api@rarecarat.com</a>.
          </p>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="">
          <section>
            <h2 class="page-header">Records Successfully Created</h2>
            <p>
              <code><?php echo $successful_records; ?></code>
            </p>
            <h2 class="page-header">Last HTTP Response Code</h2>
            <p>
              <code><?php echo $status_code; ?></code>
            </p>
            <h2 class="page-header">Last HTTP Response Body</h2>
            <pre><?php echo $body; ?></pre>
          </section>
        </div>
      </div>
    </div>

  </body>
</html>