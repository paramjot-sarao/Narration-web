<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Threshold_model extends MY_Model
{

    public function __construct()
    {
       
        //$this->load->model('Googleanalyticsdata_model', 'gmodel');
        $this->load->library('NarrationEngine');
        parent::__construct();

    }

    public function current_threshold($startdate,$enddate,$website1)  //..current threshold
    {
        $table = explode(',', $website1);
      
        $data1['sessions'] = $this->sessions($startdate,$enddate,$table[0]);
        $data1['users'] = $this->users($startdate,$enddate,$table[0]);
        $data1['desktop_users'] = $this->desktopusers($startdate,$enddate,$table[0]);
        $data1['mobile_users'] = $this->mobileusers($startdate,$enddate,$table[0]);
        $data1['tablet_users'] = $this->tabletusers($startdate,$enddate,$table[0]);
        $data1['pageviews'] = $this->pageviews($startdate,$enddate,$table[0]);
        $data1['unique_pageviews'] = $this->unique($startdate,$enddate,$table[0]);
        $data1['sessions_with_events'] = $this->sessionwithevent($startdate,$enddate,$table[1]);           
        $data1['exit_rate'] = $this->exitrate($startdate,$enddate,$table[0]);
        $data1['average_session_duration'] = $this->sessionduration($startdate,$enddate,$table[0]);
        $data1['bounce_rate'] = $this->bouncerate($startdate,$enddate,$table[0]);
        $data1['pathloss'] = $this->pathloss($startdate,$enddate,$table[0]);
        $data1['visitor_Engagement_Degree'] = $this->ved($startdate,$enddate,$table[0]);
        $data1['primary_content_consumption'] = $this->pcc($startdate,$enddate,$table[0]);
        $data1['new_visitor_percentage'] = $this->newvisitorper($startdate,$enddate,$table[1]);
        $data1['sessions_per_user'] = $this->spuser($startdate,$enddate,$table[0]);
        $data1['entry_to_exit_ratio'] = $this->entrytoexit($startdate,$enddate,$table[0]);
        $data1['page_depth'] = $this->pagedepth($startdate,$enddate,$table[0]);
        $data1['landing_page_users'] = $this->landingpage($startdate,$enddate,$table[0]);
        $data1['traffic_concentration'] = $this->traffic($startdate,$enddate,$table[0]);
        $data1['conversion_rate'] = $this->conversions($startdate,$enddate,$table[1]);
        $data1['repeat_visitor_ratio'] = $this->repeatvisitor($startdate,$enddate,$table[1]);
        return $data1;
    }

    public function historic_threshold($startdate,$enddate,$website1) //....historic data threshold
    {
        $table = explode(',', $website1);
       
        $data1['sessions'] = $this->sessions($startdate,$enddate,$table[0]);
        $data1['users'] = $this->users($startdate,$enddate,$table[0]);
        $data1['desktop_users'] = $this->desktopusers($startdate,$enddate,$table[0]);
        $data1['mobile_users'] = $this->mobileusers($startdate,$enddate,$table[0]);
        $data1['tablet_users'] = $this->tabletusers($startdate,$enddate,$table[0]);
        $data1['pageviews'] = $this->pageviews($startdate,$enddate,$table[0]);
        $data1['unique_pageviews'] = $this->unique($startdate,$enddate,$table[0]);
        $data1['sessions_with_events'] = $this->sessionwithevent($startdate,$enddate,$table[1]);           
        $data1['exit_rate'] = $this->exitrate($startdate,$enddate,$table[0]);
        $data1['average_session_duration'] = $this->sessionduration($startdate,$enddate,$table[0]);
        $data1['bounce_rate'] = $this->bouncerate($startdate,$enddate,$table[0]);
        $data1['pathloss'] = $this->pathloss($startdate,$enddate,$table[0]);
        $data1['visitor_Engagement_Degree'] = $this->ved($startdate,$enddate,$table[0]);
        $data1['primary_content_consumption'] = $this->pcc($startdate,$enddate,$table[0]);
        $data1['new_visitor_percentage'] = $this->newvisitorper($startdate,$enddate,$table[1]);
        $data1['sessions_per_user'] = $this->spuser($startdate,$enddate,$table[0]);
        $data1['entry_to_exit_ratio'] = $this->entrytoexit($startdate,$enddate,$table[0]);
        $data1['page_depth'] = $this->pagedepth($startdate,$enddate,$table[0]);
        $data1['landing_page_users'] = $this->landingpage($startdate,$enddate,$table[0]);
        $data1['traffic_concentration'] = $this->traffic($startdate,$enddate,$table[0]);
        $data1['conversion_rate'] = $this->conversions($startdate,$enddate,$table[1]);
        $data1['repeat_visitor_ratio'] = $this->repeatvisitor($startdate,$enddate,$table[1]);
        return $data1;
    }

    public function sessions($start_date,$end_date,$website)
    {
       
        $this->db->select('sessions');
        $this->db->from($website);
       
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $p = $this->db->get()->result();
      
       $result = array();
        foreach($p as $val)
        {
            $new = $val->sessions;
            array_push($result,$new);
        }
       
        $mean_session = $this->narrationengine->mean($result);
        $dev_session = $this->narrationengine->StandardDeviation($result);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value['upper_limit'] = $cutt_upper;
        $value['lower_limit'] = $cutt_lower;
       
        return $value;
    }
   
    
    public function users($start_date,$end_date,$website)
    {
        $this->db->select('users');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $users = $this->db->get()->result();
        $result = array();
        
        foreach($users as $val)
        {
            $new = $val->users;
            array_push($result,$new);
        }
       
        $mean_session = $this->narrationengine->mean($result);
        $dev_session = $this->narrationengine->StandardDeviation($result);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value['upper_limit'] = $cutt_upper;
        $value['lower_limit'] = $cutt_lower;
        
        return $value;
    }
     public function landingpage($start_date, $end_date, $website)
    {

            $this->db->select('users');
            $this->db->from($website);  
            $this->db->where('landingpagePath', '/home');
            $this->db->or_where('landingpagePath', '/');
            $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
            $users = $this->db->get()->result();
            $result = array();
        
        foreach($users as $val)
        {
            $new = $val->users;
            array_push($result,$new);
        }
       
        $mean_session = $this->narrationengine->mean($result);
        $dev_session = $this->narrationengine->StandardDeviation($result);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value['upper_limit'] = $cutt_upper;
        $value['lower_limit'] = $cutt_lower;
        
        return $value;

    }
    public function mobileusers($start_date, $end_date, $website)     
    {

        $this->db->select('users');
        $this->db->from($website);
        $this->db->where('deviceCategory', 'mobile');
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $users = $this->db->get()->result();
    
        $result = array();
        
        foreach($users as $val)
        {
            $new = $val->users;
            array_push($result,$new);
        }
       
        $mean_session = $this->narrationengine->mean($result);
        $dev_session = $this->narrationengine->StandardDeviation($result);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value['upper_limit'] = $cutt_upper;
        $value['lower_limit'] = $cutt_lower;
        
        return $value;
    }
    public function desktopusers($start_date, $end_date, $website)    
    {

        $this->db->select('users');
        $this->db->from($website);
        $this->db->where('deviceCategory', 'desktop');
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $users = $this->db->get()->result();
    
        $result = array();
        
        foreach($users as $val)
        {
            $new = $val->users;
            array_push($result,$new);
        }
       
        $mean_session = $this->narrationengine->mean($result);
        $dev_session = $this->narrationengine->StandardDeviation($result);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value['upper_limit'] = $cutt_upper;
        $value['lower_limit'] = $cutt_lower;
        
        return $value;

    }
    public function tabletusers($start_date, $end_date, $website)     
    {

        $this->db->select('users');
        $this->db->from($website);
        $this->db->where('deviceCategory', 'tablet');
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $users = $this->db->get()->result();
    
        $result = array();
        
        foreach($users as $val)
        {
            $new = $val->users;
            array_push($result,$new);
        }
       
        $mean_session = $this->narrationengine->mean($result);
        $dev_session = $this->narrationengine->StandardDeviation($result);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value['upper_limit'] = $cutt_upper;
        $value['lower_limit'] = $cutt_lower;
        
        return $value;
    }
    public function pageviews($start_date,$end_date,$website)
    {
        $this->db->select('pageviews');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $pageviews = $this->db->get()->result();
        $result = array();
        foreach($pageviews as $val)
        {
            $new = $val->pageviews;
            array_push($result,$new);
        }
        $mean_session = $this->narrationengine->mean($result);
        $dev_session = $this->narrationengine->StandardDeviation($result);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value['upper_limit'] = $cutt_upper;
        $value['lower_limit'] = $cutt_lower;
      
        return $value;
    }
    public function unique($start_date,$end_date,$website)
    {
        $this->db->select('uniquePageviews');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $pageviews = $this->db->get()->result();
        $result = array();
        foreach($pageviews as $val)
        {
            $new = $val->uniquePageviews;
            array_push($result,$new);
        }
        $mean_session = $this->narrationengine->mean($result);
        $dev_session = $this->narrationengine->StandardDeviation($result);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value['upper_limit'] = $cutt_upper;
        $value['lower_limit'] = $cutt_lower;
       
        return $value;
    }
    public function sessionwithevent($start_date,$end_date,$website)
    {
        $this->db->select('sessionsWithEvent');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $result = array();
        foreach($swe as $val)
        {
            $new = $val->sessionsWithEvent;
            array_push($result,$new);

        }
        $mean_session = $this->narrationengine->mean($result);
        $dev_session = $this->narrationengine->StandardDeviation($result);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value['upper_limit'] = $cutt_upper;
        $value['lower_limit'] = $cutt_lower;
        
        return $value;
    }
    public function exitrate($start_date,$end_date,$website)
    {   
        $iterator = new MultipleIterator;
        $this->db->select('exits,pageviews');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $result = array();
        $result1 = array();
        $final = array();
        //var_dump($swe);

        foreach($swe as $val)
        {
            $new = (float)$val->exits;
            $new1 = (float)$val->pageviews;
            array_push($result,$new);
            array_push($result1,$new1);

        }
        
        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));

        $value = 0.0;
            foreach ($iterator as $values) 
            {
                        
            try{

                $value = ($values[0]/$values[1])*100;
                
            }
            catch (Exception $e)
            {
                $value = 0;
            }

            array_push($final,$value);
        }
        
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value1['upper_limit'] = $cutt_upper;
        $value1['lower_limit'] = $cutt_lower;
        
        return $value1;
    }
    public function sessionduration($start_date,$end_date,$website)
    {   
        $iterator = new MultipleIterator;
        $this->db->select('sessions,sessionDuration');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $result = array();
        $result1 = array();
        $final = array();
        //var_dump($swe);

        foreach($swe as $val)
        {
            $new = (float)$val->sessions;
            array_push($result,$new);
            $new1 = (float)$val->sessionDuration;
            array_push($result1,$new1);

        }
        
        $iterator->attachIterator(new ArrayIterator($result1));
        $iterator->attachIterator(new ArrayIterator($result));
        foreach ($iterator as $values) 
            {
                
                $value = $values[0]/$values[1];
                $milli = $value * 1000;
                $r = $milli/60000;
                $param = round($r,2);
                array_push($final,$param);
        }
        
        
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value1['upper_limit'] = $cutt_upper;
        $value1['lower_limit'] = $cutt_lower;
        
        return $value1;
    }
    public function bouncerate($start_date,$end_date,$website)
    {   
        $iterator = new MultipleIterator;
        $this->db->select('sessions,bounces');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $result = array();
        $result1 = array();
        $final = array();
        //var_dump($swe);

        foreach($swe as $val)
        {
            $new = (float)$val->sessions;
            array_push($result,$new);
            $new1 = (float)$val->bounces;
            array_push($result1,$new1);

        }
        $iterator->attachIterator(new ArrayIterator($result1));
        $iterator->attachIterator(new ArrayIterator($result));
        foreach ($iterator as $values) 
            {
                
                $value = ($values[0]/$values[1])*100;   
                array_push($final,$value);
        }
                
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $value1['upper_limit'] = $cutt_upper;
        $value1['lower_limit'] = $cutt_lower;
        
        return $value1;
    }
    public function pathloss($start_date,$end_date,$website)
    {   
        $iterator = new MultipleIterator;
        
        $this->db->select('exits,bounces,entrances,pageviews');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $result = array();
        $result1 = array();
        $result2 = array();
        $result3 = array();
        $final = array();
        //var_dump($swe);
        foreach($swe as $val)
        {
            $new = (float)$val->exits;
            array_push($result,$new);
            $new1 = (float)$val->bounces;
            array_push($result1,$new1);
            $new2 = (float)$val->entrances;
            array_push($result2,$new2);
            $new3 = (float)$val->pageviews;
            array_push($result3,$new3);

        }
        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));
        $iterator->attachIterator(new ArrayIterator($result3));
        $iterator->attachIterator(new ArrayIterator($result2));

        foreach ($iterator as $values) 
            {
                
                $value = $values[0]-$values[1];
                $value1 = $values[2]-$values[3];
                $value2 = ($value/$value1)*100;     
                
                array_push($final,$value2);
        }
        //var_dump($final);
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $r['upper_limit'] = $cutt_upper;
        $r['lower_limit'] = $cutt_lower;
        
        
        return $r;
    }
    public function ved($start_date,$end_date,$website)
    {
        $iterator = new MultipleIterator;
        $this->db->select('users,pageviews');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $result = array();
        $result1 = array();
        $final = array();
        foreach($swe as $val)
        {
            $new = (float)$val->pageviews;
            array_push($result,$new);
            $new1 = (float)$val->users;
            array_push($result1,$new1);
        }
      
        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));
        foreach ($iterator as $values) 
            {
                
                $value = $values[0]/$values[1];
                array_push($final,$value);
        }
        
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $r['upper_limit'] = $cutt_upper;
        $r['lower_limit'] = $cutt_lower;
        
        
        return $r;
    }
    public function pcc($start_date,$end_date,$website)
    {
        $iterator = new MultipleIterator;
        $this->db->select('uniquePageviews,entrances,sessions,pageviews');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $result = array();
        $result1 = array();
        $result2 = array();
        $result3 = array();
        $final = array();
        foreach($swe as $val)
        {
            $new = (float)$val->uniquePageviews;
            array_push($result,$new);
            $new1 = (float)$val->entrances;
            array_push($result1,$new1);
            $new2 = (float)$val->sessions;
            array_push($result2,$new2);
            $new3 = (float)$val->pageviews;
            array_push($result3,$new3);
        }
        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));
        $iterator->attachIterator(new ArrayIterator($result2));
        $iterator->attachIterator(new ArrayIterator($result3));
        foreach ($iterator as $values) 
            {
                
                $value = (($values[1]/$values[2])*$values[0]);
                $value1 = $values[3];
                $value2 = $value/$value1;
                array_push($final,$value2);
        }
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $r['upper_limit'] = $cutt_upper;
       $r['lower_limit'] = $cutt_lower;
            
        return $r;
    }
    
    

    public function spuser($start_date,$end_date,$website)
    {

        $iterator = new MultipleIterator;
        $this->db->select('sessions,users');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $final = array();
        $result = array();
        $result1 = array();
        foreach($swe as $val)
        {
            $new = (float)$val->sessions;
            array_push($result,$new);
            $new1 = (float)$val->users;
            array_push($result1,$new1);
        }
        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));
        foreach ($iterator as $values) 
            {
                
                $value = $values[0]/$values[1];
                
                
                array_push($final,$value);
        }
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $r['upper_limit'] = $cutt_upper;
        $r['lower_limit'] = $cutt_lower;
        
        
        return $r;
    }
    public function entrytoexit($start_date,$end_date,$website)
    {
        $iterator = new MultipleIterator;
        $this->db->select('entrances,exits');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $final = array();
        $result = array();
        $result1 = array();
        foreach($swe as $val)
        {
            $new = (float)$val->entrances;
            array_push($result,$new);
            $new1 = (float)$val->exits;
            array_push($result1,$new1);
        }
        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));
        foreach ($iterator as $values) 
            {
                
                $value = $values[0]/$values[1];
                
                
                array_push($final,$value);
        }
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $r['upper_limit'] = $cutt_upper;
        
            $r['lower_limit'] = $cutt_lower;
        
        
        return $r;
    }
    public function pagedepth($start_date,$end_date,$website)
    {
        $iterator = new MultipleIterator;
        $this->db->select('pageviews,sessions');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $final = array();
        $result = array();
        $result1 = array();
        foreach($swe as $val)
        {
            $new = (float)$val->pageviews;
            array_push($result,$new);
            $new1 = (float)$val->sessions;
            array_push($result1,$new1);
        }
        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));
        foreach ($iterator as $values) 
            {
                
                $value = $values[0]/$values[1];
                        
                array_push($final,$value);
            }
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $r['upper_limit'] = $cutt_upper;
        $r['lower_limit'] = $cutt_lower;
        
        
        return $r;
    }
    public function traffic($start_date,$end_date,$website)
    {
        $iterator = new MultipleIterator;
        $this->db->select('users');
        $this->db->from($website);
        $this->db->where('landingpagePath', '/home');
        $this->db->or_where('landingpagePath', '/');
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        $size_landing = sizeof($swe);
        $this->db->select('users');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $this->db->limit($size_landing);
        $swe1 = $this->db->get()->result();
        

        $final = array();
        $result = array();
        $result1 = array();
        foreach($swe as $val_landing)
        {
            $new = (float)$val_landing->users;
            array_push($result,$new);
            
        }
        
        foreach($swe1 as $val)
        {
            $new = (float)$val->users;
            array_push($result1,$new);
            
        }
        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));
        foreach ($iterator as $values) 
            {
                
                $value = ($values[0]/$values[1]);
                              
                array_push($final,$value);
            }
            //var_dump($final);
        $mean_session = $this->narrationengine->mean($final);
        
        $dev_session = $this->narrationengine->StandardDeviation($final);
        
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        
        $r['upper_limit'] = $cutt_upper;
        $r['lower_limit'] = $cutt_lower;
        
        
        return $r;
    }
    public function conversions($start_date,$end_date,$website)
    {
        $iterator = new MultipleIterator;
        $this->db->select('sessions,goalCompletionsAll');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
                
        $result = array();
        $result1 = array();
        $final = array();
        foreach($swe as $val)
        {
            $new = (float)$val->goalCompletionsAll;
            array_push($result,$new);
            $new1 = (float)$val->sessions;
            array_push($result1,$new1);
        }
        
        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));
        foreach ($iterator as $values) 
            {
                
                $value = ($values[0]/$values[1])*100;
                
                
                array_push($final,$value);
            }
        
        $mean_session = $this->narrationengine->mean($final);
        
        $dev_session = $this->narrationengine->StandardDeviation($final);
        
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        
        $r['upper_limit'] = $cutt_upper;
        $r['lower_limit'] = $cutt_lower;
           
        return $r;
    }
    public function newusers($start_date,$end_date,$website)
    {
        $this->db->select('newUsers,users');
        $this->db->from($website);
        $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
        $swe = $this->db->get()->result();
        return $swe;
    }
    public function newvisitorper($start_date,$end_date,$website)
    {
        $iterator = new MultipleIterator;
        $start_date2 = $start_date;
        $end_date2 = $end_date;
        $website2 = $website;
        $users_two = $this->newusers($start_date2,$end_date2,$website2);
        //var_dump($users_two);
        $final = array();
        $result = array();
        $result1 = array();
        foreach($users_two as $user)
        {
            $user = (float)$user->users;
            array_push($result1,$user);
        }
     
        foreach($users_two as $val)
        {
            $new = (float)$val->newUsers;
            array_push($result,$new);
        }
      
        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));
        foreach ($iterator as $values) 
            {
                
                $value = ($values[0]/$values[1]*100);
                array_push($final,$value);
        }
       
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $r['upper_limit'] = $cutt_upper;
        $r['lower_limit'] = $cutt_lower;
        
                
        return $r;
    }
    public function repeatvisitor($start_date,$end_date,$website)
    {
        $iterator = new MultipleIterator;
        $iterator1 = new MultipleIterator;
        $start_date2 = $start_date;
        $end_date2 = $end_date;
        $website2 = $website;
        $users_two = $this->newusers($start_date2,$end_date2,$website2);
        //var_dump($users_two);
        $repeat = array();
        $final = array();
        $result = array();
        $result1 = array();
        foreach($users_two as $user)
        {
            $user = (float)$user->users;
            array_push($result,$user);
        }
        
        foreach($users_two as $val)
        {
            $new = (float)$val->newUsers;
            array_push($result1,$new);
        }


        $iterator->attachIterator(new ArrayIterator($result));
        $iterator->attachIterator(new ArrayIterator($result1));
        foreach ($iterator as $values) 
        {
                $repeatuser = $values[0]-$values[1];
                array_push($repeat,$repeatuser);
        }
        $iterator1->attachIterator(new ArrayIterator($repeat));
        $iterator1->attachIterator(new ArrayIterator($result));
        foreach ($iterator1 as $values) 
        {
                $rusers = $values[0]/$values[1]*100;
                array_push($final,$rusers);
        }
        
       
        $mean_session = $this->narrationengine->mean($final);
        $dev_session = $this->narrationengine->StandardDeviation($final);
        $cutt_upper = round($mean_session + $dev_session,0);
        $cutt_lower = round($mean_session - $dev_session,0);
        $r['upper_limit'] = $cutt_upper;
        $r['lower_limit'] = $cutt_lower;
                      
        return $r;
    }

        
}