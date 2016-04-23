<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Threshold2_model extends MY_Model
{

	public function __construct()
	{
       
        //$this->load->model('Googleanalyticsdata_model', 'gmodel');
        $this->load->library('NarrationEngine');
		parent::__construct();

	}

   
    public function getnarration($currentdata,$historicaldata,$r)
    {
       
            $a = array();
            $c = array();
            $b = array();
            $val1 = array();
            $val2 = array();
            $result = array();

            $indexes_current = array('sessions','users','desktop_users',
            'mobile_users','tablet_users','pageviews','unique_pageviews',
            'sessions_with_events','exit_rate','average_session_duration','bounce_rate',
            'pathloss','visitor_Engagement_Degree','primary_content_consumption',
            'new_visitor_percentage','sessions_per_user',
            'entry_to_exit_ratio','page_depth','landing_page_users',
            'traffic_concentration',
            'conversion_rate','repeat_visitor_ratio');
           
          foreach($indexes_current as $index)
          {
            $val1[$index] = $currentdata[$index]['upper_limit'];
            $val2[$index] = $currentdata[$index]['lower_limit'];
          }
          
          foreach($indexes_current as $index2)
          {
            $a[$index2] = $historicaldata[$index2]['upper_limit'];
            $c[$index2] = $historicaldata[$index2]['lower_limit'];
            $b[$index2] =  ($a[$index2] +  $c[$index2])/2;
          }
          /* echo'<pre>';
            echo "mid.";
            print_r($b);
            echo '</pre>';*/

      
        $interpretation = '';
        foreach($indexes_current as $index)
        {
            if($val1[$index] > $a[$index] || $val1[$index] <= $a[$index] && $val1[$index] > $b[$index] 
                && $r >= 0 && $val2[$index] <= $a[$index] && $val2[$index] >= $c[$index])
            {
                
                   $interpretation = 'positive';    
                

                
            }                   
            elseif($val1[$index] < $b[$index] && $val1[$index] >= $c[$index] && $r < 0
                && $val2[$index] < $b[$index] && [$index] >= $c[$index])
            {
                
        
                    $interpretation = 'negative'; 
                
               
            }
            elseif($val1[$index] == $b[$index] && $r == 0 && $val2[$index] == $b[$index] && $val2[$index] >= $c[$index])
            {
               
                
                    $interpretation = 'equal';
                   
                
            
            }
            else
            {
                $interpretation = 'outlier';
            }
          
              $result[$index] = $interpretation;
             
        }
         

        return $result;
    }



    public function fetch($interpretation)
    {

        $result = array();
       
        
       foreach($interpretation as $key=>$value)
        {
            $final = array();
            $output = array();
            $final['impact'] = '';
        switch($value)
        {
            case 'positive':
          
            $output = $this->db->select('impact')
                    ->from('autogeneratetree')
                    ->where('nodename',$key)
                    ->where('operator','positive')
                    ->get()->result();
                     
            $final['impact'] = $output[0]->{'impact'};
                                    
            break;
            case 'negative':
            
            $output= $this->db->select('impact')
                    ->from('autogeneratetree')
                    ->where('nodename',$key)
                    ->where('operator','negative')
                    ->get()->result();
               
            $final['impact'] = $output[0]->{'impact'};
               
            break;
            case 'equal':
           
            $output = $this->db->select('impact')
                    ->from('autogeneratetree')
                    ->where('nodename',$key)
                    ->where('operator','equal')
                    ->get()->result();
                 
            $final['impact'] = $output[0]->{'impact'};
                
            break;
            case 'outlier':
            $output = $this->db->select('impact')
                    ->from('autogeneratetree')
                    ->where('nodename',$key)
                    ->where('operator','outlier')
                    ->get()->result();
                          
            $final['impact'] = $output[0]->{'impact'};
                
            break;
            
            }
          
            $result[$key]= $final['impact'];
            
         }
        //var_dump($result);
    return $result;
    
    }


   
        
}