Download Analyticsapi library from the folder named .......
Place the downloaded Analyticsapi library in the libraries folder.   
Download google-api-php-client library package from https://github.com/google/google-api-php-client.
Place the google-api-php-client library in the third party/Google folder to access the analytics data.
write the following code in the function defined to access analytics data under controller file.

    $this->load->library('analyticsapi');

    $api = new Analyticsapi();
    // CLient id, service account name and .p12 file all will be generated in google developer console to enable APIs.

    $api->client_id = 'YOUR_CLIENT_ID'; 
    $api->service_account_name = 'YOUR_SERVICE_ACCOUNT_NAME'; 
    $api->key_file_location = 'PATH OF .p12 FILE';

    $api->profileId = " YOUR_VIEW_ID"; // eg. ga:**********

   
     $api->startDate = 'starting date of fetching data';
     
     $api->endDate = 'ending date upto which data is to be fetched';

     $api->metrics = " used metrics"; //example: ga:users,ga:pageviews etc.
      $api->optParams = array(
          "dimensions" => "dimensions to be used with above said metrics",// example: ga:date,ga:sessionCountetc.
          "max-results" => "number of results you want to receive, maximum limit of result is 10000");

      $results = $api->analyticsData(); // $results variable holds analytics data
    
      $headers = $results->getColumnHeaders(); // fetches column headers of the data
     
     
      $rows = $results->getRows(); // contains analytics data.

    
  