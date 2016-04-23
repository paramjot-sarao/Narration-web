<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->data['page_title'] = 'Narration Generation System';
 
    $this->render('admin/dashboard_view');
  }

  public function api()
  {
    $this->load->library('analyticsapi');

    $api = new Analyticsapi();

    $api->client_id = '813426099670-v9crllacjbf4egb173h2egguplelccld.apps.googleusercontent.com'; //Client ID
    $api->service_account_name = 'account-1@punjab-1146.iam.gserviceaccount.com'; //Email Address 
    $api->key_file_location = BASEPATH . '../application/third_party/google-api-php-client/src/Google/punjab-297835e0c691.p12';

   // $api->profileId = "ga:112813176";
  $api->profileId = "ga:70165606";// main view id used in query explorer
     
  $date = date('Y-m-d',strtotime("-1 day"));
    
  $api->startDate = date_format(date_create($date), 'Y-m-d');
   
  $end = date('Y-m-d',strtotime("-1 day"));
    
  $api->endDate = date_format(date_create($end), 'Y-m-d');
  
  $api->metrics = "ga:exits,ga:entrances,ga:users,ga:pageviews,ga:uniquePageviews,ga:sessions,ga:sessionDuration,ga:bounces";
  $api->optParams = array(
          "dimensions" => "ga:date,ga:landingPagePath,ga:deviceCategory",
          "max-results" => 10000
          //"output"     => 'dataTable'
          );

      $results = $api->analyticsData();
      $headers = $results->getColumnHeaders();
      $header_names = array();
      foreach ($headers as $header) {
        array_push($header_names, $header->getName());
      }
      $rows = $results->getRows();
      $finaldata = array();

      foreach ($rows as $row)
       {
        array_push($finaldata, array_combine(str_replace('ga:', '', $header_names), $row));
      }
       $finaldata2 = array();
      
      foreach ($finaldata as $final) {
        $convertd = date('Y-m-d', strtotime($final['date']));
        $final['date'] = $convertd;
        array_push($finaldata2, $final);
      }
      
    $this->load->model('Googleanalyticsdata_model', 'analyticsmodel');
    $this->analyticsmodel->insert($finaldata2);
    
  }

 public function api2()
  {
    $this->load->library('analyticsapi');

    $api = new Analyticsapi();

    $api->client_id = '813426099670-v9crllacjbf4egb173h2egguplelccld.apps.googleusercontent.com'; //Client ID
    $api->service_account_name = 'account-1@punjab-1146.iam.gserviceaccount.com'; //Email Address 
    $api->key_file_location = BASEPATH . '../application/third_party/google-api-php-client/src/Google/punjab-297835e0c691.p12';

    // $api->profileId = "ga:112813176";
    $api->profileId = "ga:70165606";//main view id used in query explorer

    
  $date = date('Y-m-d',strtotime("-1 day"));    
  $api->startDate = date_format(date_create($date), 'Y-m-d');   
  $end = date('Y-m-d',strtotime("-1 day"));    
  $api->endDate = date_format(date_create($end), 'Y-m-d');

  $api->metrics = "ga:sessionsWithEvent,ga:sessions,ga:newUsers,ga:users,ga:goalCompletionsAll";
  $api->optParams = array(       
        "dimensions" => "ga:date,ga:country",      
        "max-results" => 10000
          //"output"     => 'dataTable'
        );

      $results = $api->analyticsData();
      $headers = $results->getColumnHeaders();
      $header_names = array();
      foreach ($headers as $header) {
        array_push($header_names, $header->getName());
      }
    $rows = $results->getRows();
    $finaldata = array();

    foreach ($rows as $row)
      {
        array_push($finaldata, array_combine(str_replace('ga:', '', $header_names), $row));
      }
       $finaldata2 = array();
      foreach ($finaldata as $final) {
        $convertd = date('Y-m-d', strtotime($final['date']));
        $final['date'] = $convertd;
        array_push($finaldata2, $final);
      }
     
      $this->load->model('Googleanalyticsdata2_model', 'analyticsmodel');
     
      $this->analyticsmodel->insert($finaldata2);    
  }

}