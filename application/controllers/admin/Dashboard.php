<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
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
     var_dump($header_names);

      $rows = $results->getRows();

      $finaldata = array();

      foreach ($rows as $row)
       {
        array_push($finaldata, array_combine(str_replace('ga:', '', $header_names), $row));
      }
       $finaldata2 = array();
      
      foreach ($finaldata as $final) {
        $convertd = date('Y-m-d', strtotime($final['date']));
        //date_format(date_create($final['date']), 'Y-m-d H:i:s');
        //date('Y-m-d H:i:s', strtotime($final['date']));
        $final['date'] = $convertd;
        array_push($finaldata2, $final);
      }
      echo '<pre>';
      print_r($finaldata2);
      echo '</pre>';

      $this->load->model('Googleanalyticsdata_model', 'analyticsmodel');
    //$this->analyticsmodel->insert($finaldata2);
    
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
      //,ga:goalConversionRateAll";
            
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
     var_dump($header_names);

      $rows = $results->getRows();

      $finaldata = array();

      foreach ($rows as $row)
       {
        array_push($finaldata, array_combine(str_replace('ga:', '', $header_names), $row));
      }
       $finaldata2 = array();
      foreach ($finaldata as $final) {
        $convertd = date('Y-m-d', strtotime($final['date']));
        //date_format(date_create($final['date']), 'Y-m-d H:i:s');
        //date('Y-m-d H:i:s', strtotime($final['date']));
        $final['date'] = $convertd;
        array_push($finaldata2, $final);
      }
       echo '<pre>';
      print_r($finaldata2);
      echo '</pre>';

      $this->load->model('Googleanalyticsdata2_model', 'analyticsmodel');
     // $this->analyticsmodel->insert($finaldata2);

  
  }

  public function ijorcsapi()
  {
    $this->load->library('analyticsapi');

    $api = new Analyticsapi();

   //Client ID
    $api->client_id ='1044240153354-s2gp3pm721gjrto80m6ia45ahj40hc1b.apps.googleusercontent.com';
   //Email Address 
   $api->service_account_name = 'ijorcs@ijorcs2.iam.gserviceaccount.com';


    $api->key_file_location = BASEPATH . '../application/third_party/google-api-php-client/src/Google/ijorcs2-4823f4b98cc5.p12';
    
    //$api->profileId = "ga:112810943";
    $api->profileId = "ga:107901685"; // main view id used in query explorer 

   for ($i= 1; $i <= 4  ; $i++) { 
  
     
    $date = '2016-04-'.$i;
      $api->startDate = date_format(date_create($date), 'Y-m-d');
  
     $end = '2016-04-'.$i;
    
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
     var_dump($header_names);

      $rows = $results->getRows();

      $finaldata = array();

      foreach ($rows as $row)
       {
        array_push($finaldata, array_combine(str_replace('ga:', '', $header_names), $row));
      }
       $finaldata2 = array();
      foreach ($finaldata as $final) {
        $convertd = date('Y-m-d', strtotime($final['date']));
        //date_format(date_create($final['date']), 'Y-m-d H:i:s');
        //date('Y-m-d H:i:s', strtotime($final['date']));
        $final['date'] = $convertd;
        array_push($finaldata2, $final);
      }
       echo '<pre>';
      print_r($finaldata2);
      echo '</pre>';
      $this->load->model('Ijorcsanalyticsdata_model', 'gmodel');
          
  // $this->gmodel->insert($finaldata2);

   }

    
  }

public function ijorcsapi2()
  {
    $this->load->library('analyticsapi');

    $api = new Analyticsapi();

   //Client ID
    $api->client_id ='1044240153354-s2gp3pm721gjrto80m6ia45ahj40hc1b.apps.googleusercontent.com';
   //Email Address 
   $api->service_account_name = 'ijorcs@ijorcs2.iam.gserviceaccount.com';
   $api->key_file_location = BASEPATH . '../application/third_party/google-api-php-client/src/Google/ijorcs2-4823f4b98cc5.p12';
    
    //$api->profileId = "ga:112810943";
    $api->profileId = "ga:107901685"; // main view id used in query explorer 
 
   for ($i= 5; $i <= 5  ; $i++) { 
  
      $date = '2016-04-'.$i;
      $api->startDate = date_format(date_create($date), 'Y-m-d');
     
      $end = '2016-04-'.$i;
    
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
      var_dump($header_names);

      $rows = $results->getRows();

      $finaldata = array();

      foreach ($rows as $row) {
        array_push($finaldata, array_combine(str_replace('ga:', '', $header_names), $row));
      }
       $finaldata2 = array();
      foreach ($finaldata as $final) {
        $convertd = date('Y-m-d', strtotime($final['date']));
        //date_format(date_create($final['date']), 'Y-m-d H:i:s');
        //date('Y-m-d H:i:s', strtotime($final['date']));
        $final['date'] = $convertd;
        array_push($finaldata2, $final);
      }

      $this->load->model('Ijorcsanalyticsdata2_model', 'gmodel');
      echo '<pre>';
      print_r($finaldata2);
      echo '</pre>';
    //$this->gmodel->insert($finaldata2);   

    }
  }


}