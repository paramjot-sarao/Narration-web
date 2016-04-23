<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardijorcs extends MY_Controller
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

  

  public function ijorcsapi()
  {
    $this->load->library('analyticsapi');

    $api = new Analyticsapi();

    
    $api->client_id ='1044240153354-s2gp3pm721gjrto80m6ia45ahj40hc1b.apps.googleusercontent.com';
    $api->service_account_name = 'ijorcs@ijorcs2.iam.gserviceaccount.com';
    $api->key_file_location = BASEPATH . '../application/third_party/google-api-php-client/src/Google/ijorcs2-4823f4b98cc5.p12';
    
    //$api->profileId = "ga:112810943";
    $api->profileId = "ga:107901685"; // main view id used in query explorer 
 
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

      foreach ($rows as $row) {
        array_push($finaldata, array_combine(str_replace('ga:', '', $header_names), $row));
      }
      $finaldata2 = array();
      foreach ($finaldata as $final) {
        $convertd = date('Y-m-d', strtotime($final['date']));
        
        $final['date'] = $convertd;
        array_push($finaldata2, $final);
      }
      $this->load->model('Ijorcsanalyticsdata_model', 'gmodel');
      
      $this->gmodel->insert($finaldata2);

   }


public function ijorcsapi2()
  {
    $this->load->library('analyticsapi');

    $api = new Analyticsapi();

    $api->client_id ='1044240153354-s2gp3pm721gjrto80m6ia45ahj40hc1b.apps.googleusercontent.com';
    $api->service_account_name = 'ijorcs@ijorcs2.iam.gserviceaccount.com';
    $api->key_file_location = BASEPATH . '../application/third_party/google-api-php-client/src/Google/ijorcs2-4823f4b98cc5.p12';
    
    //$api->profileId = "ga:112810943";
    $api->profileId = "ga:107901685"; // main view id used in query explorer 
 
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

      foreach ($rows as $row) {
        array_push($finaldata, array_combine(str_replace('ga:', '', $header_names), $row));
      }
       $finaldata2 = array();
      foreach ($finaldata as $final) {
        $convertd = date('Y-m-d', strtotime($final['date']));
       
        $final['date'] = $convertd;
        array_push($finaldata2, $final);
      }

      $this->load->model('Ijorcsanalyticsdata2_model', 'gmodel');
      
    $this->gmodel->insert($finaldata2);   

    
  }


}