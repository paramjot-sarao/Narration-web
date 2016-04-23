<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/google-api-php-client/src/Google/autoload.php';

class Analyticsapi 
{

  public $client_id; //Client ID
  public $service_account_name; //Email Address 
  public $key_file_location;

  public $client;
  public $analytics;

  public $metrics;
  // "ga:users,ga:pageviews,ga:bouncerate,ga:uniquePageviews,ga:avgTimeOnPage,ga:exits,ga:entrances,ga:totalEvents,ga:sessions,ga:newUsers,ga:searchSessions,ga:searchDepth";
  public $optParams = array();
  //$optParams = array("dimensions" => "ga:date,ga:date,ga:sessionCount,ga:screenColors,ga:screenResolution,ga:pageDepth,ga:exitPagePath");

  public $profileId;
  public $startDate; // ming_useconstants(use) given number of days from now
  public $endDate; // todays date

  public function __construct() {

  }
  
  public function analyticsData()
  {
   $this->client = new Google_Client();
   $this->client->setApplicationName("ApplicationName");

   if (isset($_SESSION['service_token'])) {
      $this->client->setAccessToken($_SESSION['service_token']);
   }

   $key = file_get_contents($this->key_file_location);
   $cred = new Google_Auth_AssertionCredentials(
            $this->service_account_name,
              array(
                'https://www.googleapis.com/auth/analytics.readonly',
              ),
              $key,
             'notasecret'
          );

    $this->client->setAssertionCredentials($cred);
   
    if($this->client->getAuth()->isAccessTokenExpired()) {
      $this->client->getAuth()->refreshTokenWithAssertion($cred);
    }

    $_SESSION['service_token'] = $this->client->getAccessToken();

   

    $this->analytics = new Google_Service_Analytics($this->client);

    return $this->analytics->data_ga->get($this->profileId, $this->startDate, $this->endDate, $this->metrics, $this->optParams);

  }

  

}