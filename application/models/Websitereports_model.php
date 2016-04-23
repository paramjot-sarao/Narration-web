 <?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Websitereports_model extends MY_Model
{

	public function __construct()
	{
        $this->load->library('NarrationEngine');
		parent::__construct();
	}
	public function current_week($startdate,$enddate,$website1)   //....to calculate statistics of current week data
	{
		$table = explode(',', $website1);

		$output2['sessions'] = $this->sessions($startdate,$enddate,$table[0]);

	    $output1['sessions_t2'] = $this->sessions_table2($startdate,$enddate,$table[1]);
	    
	    $output2['users'] = $this->users($startdate,$enddate,$table[0]);
	   
	    $output1['newusers'] = $this->newusers($startdate,$enddate,$table[1]);
	    
	    $output2['mobile_users'] = $this->mobileusers($startdate,$enddate,$table[0]);
	    
	    $output2['desktop_users'] = $this->desktopusers($startdate,$enddate,$table[0]);
	    
	    $output2['tablet_users'] = $this->tabletusers($startdate,$enddate,$table[0]);
	    
	    $output1['exits'] = $this->exits($startdate,$enddate,$table[0]);
	    
	    $output1['entrances'] = $this->entrances($startdate,$enddate,$table[0]);
	    
	    $output2['pageviews'] = $this->pageviews($startdate,$enddate,$table[0]);
	    
	    $output2['unique_pageviews'] = $this->uniquepageviews($startdate,$enddate,$table[0]);
	    
	    $output2['exit_rate'] = round(($output1['exits']/$output2['pageviews'])*100,2);
	   
	   	$output1['sessionduration'] = $this->sessionduration($startdate,$enddate,$table[0]);
	    
	    $output2['average_session_duration'] = $this->avgsession($output2['sessions'],$output1['sessionduration']);
	    
	    $output1['bounces'] = $this->bounces($startdate,$enddate,$table[0]);
	    
	    $output2['bounce_rate'] = round(($output1['bounces']/$output2['sessions'])*100,2);
	    
	    $output2['pathloss'] = $this->pathloss($output1['exits'],$output1['bounces'],$output2['pageviews'],$output1['entrances']);
	    
	    $output2['sessions_with_events'] = $this->sessionwithevent($startdate,$enddate,$table[1]);
	   	
	   	$output1['goalcompletions'] = $this->conversion($startdate,$enddate,$table[1]);
	   
	   	$output2['conversion_rate'] =round((($output1['goalcompletions']/$output1['sessions_t2'])*100),2);
	    
	    $output2['sessions_per_user'] = round($output2['sessions']/$output2['users'],2);
	    
	    $output2['entry_to_exit_ratio'] = $output1['entrances']/$output1['exits'];

	    $output2['visitor_Engagement_Degree'] = $this->ved($output2['users'],$output2['pageviews']);
	    
	    $output2['primary_content_consumption'] = $this->pcc($output2['unique_pageviews'],$output1['entrances'],$output2['sessions'],$output2['pageviews']);

	    $output1['t2_users'] = $this->users_table2($startdate,$enddate,$table[1]);
	    
	    $output2['new_visitor_percentage'] = round(($output1['newusers']/$output1['t2_users'])*100,2);
	    
	    $output2['repeat_visitor_ratio'] = $this->rvr($output1['newusers'],$output1['t2_users']);
	    
	    $output2['page_depth'] = round(($output2['pageviews']/$output2['sessions']),2);
	    
	    $output2['landing_page_users'] = $this->landingpage($startdate,$enddate,$table[0]);
	    
	    $output2['traffic_concentration'] = round(($output2['landing_page_users']/$output2['users'])*100,2);
	   
	    return $output2;
	}

	public function previous_week($startdate,$enddate,$website1)   //....to calculate statistics of previous week data
	{
		$table = explode(',', $website1);

		
		$output2['sessions'] = $this->sessions($startdate,$enddate,$table[0]);

	    $output1['sessions_t2'] = $this->sessions_table2($startdate,$enddate,$table[1]);
	    
	    $output2['users'] = $this->users($startdate,$enddate,$table[0]);
	   
	    $output1['newusers'] = $this->newusers($startdate,$enddate,$table[1]);
	    
	    $output2['mobile_users'] = $this->mobileusers($startdate,$enddate,$table[0]);
	    
	    $output2['desktop_users'] = $this->desktopusers($startdate,$enddate,$table[0]);
	    
	    $output2['tablet_users'] = $this->tabletusers($startdate,$enddate,$table[0]);
	    
	    $output1['exits'] = $this->exits($startdate,$enddate,$table[0]);
	    
	    $output1['entrances'] = $this->entrances($startdate,$enddate,$table[0]);
	    
	    $output2['pageviews'] = $this->pageviews($startdate,$enddate,$table[0]);
	    
	    $output2['unique_pageviews'] = $this->uniquepageviews($startdate,$enddate,$table[0]);
	    
	    $output2['exit_rate'] = round(($output1['exits']/$output2['pageviews'])*100,2);
	   
	   	$output1['sessionduration'] = $this->sessionduration($startdate,$enddate,$table[0]);
	    
	    $output2['average_session_duration'] = $this->avgsession($output2['sessions'],$output1['sessionduration']);
	    
	    $output1['bounces'] = $this->bounces($startdate,$enddate,$table[0]);
	    
	    $output2['bounce_rate'] = round(($output1['bounces']/$output2['sessions'])*100,2);
	    
	    $output2['pathloss'] = $this->pathloss($output1['exits'],$output1['bounces'],$output2['pageviews'],$output1['entrances']);
	    
	    $output2['sessions_with_events'] = $this->sessionwithevent($startdate,$enddate,$table[1]);
	   	
	   	$output1['goalcompletions'] = $this->conversion($startdate,$enddate,$table[1]);
	   
	   	$output2['conversion_rate'] =round((($output1['goalcompletions']/$output1['sessions_t2'])*100),2);
	    
	    $output2['sessions_per_user'] = round($output2['sessions']/$output2['users'],2);
	    
	    $output2['entry_to_exit_ratio'] = $output1['entrances']/$output1['exits'];

	    $output2['visitor_Engagement_Degree'] = $this->ved($output2['users'],$output2['pageviews']);
	    
	    $output2['primary_content_consumption'] = $this->pcc($output2['unique_pageviews'],$output1['entrances'],$output2['sessions'],$output2['pageviews']);

	    $output1['t2_users'] = $this->users_table2($startdate,$enddate,$table[1]);
	    
	    $output2['new_visitor_percentage'] = round(($output1['newusers']/$output1['t2_users'])*100,2);
	    
	    $output2['repeat_visitor_ratio'] = $this->rvr($output1['newusers'],$output1['t2_users']);
	    
	    $output2['page_depth'] = round(($output2['pageviews']/$output2['sessions']),2);
	    
	    $output2['landing_page_users'] = $this->landingpage($startdate,$enddate,$table[0]);
	    
	    $output2['traffic_concentration'] = round(($output2['landing_page_users']/$output2['users'])*100,2);
	   
	    return $output2;
	}


 	public function sessions($start_date, $end_date, $website)
    {
		$this->db->select_sum('sessions');
		$this->db->from($website);
		$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
		$sessions = $this->db->get()->result_array();
		return $sessions[0]['sessions'];
    }
    public function sessions_table2($start_date, $end_date, $website)
    {
		$this->db->select_sum('sessions');
		$this->db->from($website);
		$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
		$sessions = $this->db->get()->result_array();
		return $sessions[0]['sessions'];
    }

    public function users($start_date, $end_date, $website)
    {
			$this->db->select_sum('users');
			$this->db->from($website);	
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$total = $this->db->get()->result_array();
			return $total[0]['users'];
	}
	public function users_table2($start_date, $end_date, $website)
    {
			$this->db->select_sum('users');
			$this->db->from($website);	
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$total = $this->db->get()->result_array();
			return $total[0]['users'];
	}
	public function newusers($start_date, $end_date, $website)
	{
	
			$this->db->select_sum('newUsers');	
			$this->db->from($website);
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$new = $this->db->get()->result_array();
			return $new[0]['newUsers'];
	}	
	public function mobileusers($start_date, $end_date, $website)	  
	{

			$this->db->select_sum('users');
			$this->db->from($website);	
			$this->db->where('deviceCategory', 'mobile');
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$mobileuser = $this->db->get()->result_array();
			return $mobileuser[0]['users'];

	}
	public function desktopusers($start_date, $end_date, $website)	  
	{

			$this->db->select_sum('users');
			$this->db->from($website);	
			$this->db->where('deviceCategory', 'desktop');
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$desktopuser = $this->db->get()->result_array();
			return $desktopuser[0]['users'];

	}
	public function tabletusers($start_date, $end_date, $website)	  
	{

			$this->db->select_sum('users');
			$this->db->from($website);	
			$this->db->where('deviceCategory', 'tablet');
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$tabletuser = $this->db->get()->result_array();
			return $tabletuser[0]['users'];

	}
	public function exits($start_date, $end_date, $website)
	{
			$this->db->select_sum('exits');
			$this->db->from($website);	
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$exits = $this->db->get()->result_array();
			return $exits[0]['exits'];
	}
	public function entrances($start_date, $end_date, $website)
	{
			$this->db->select_sum('entrances');
			$this->db->from($website);	
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$entrances = $this->db->get()->result_array();
			return $entrances[0]['entrances'];

	}
	public function pageviews($start_date, $end_date, $website)
	{
			$this->db->select_sum('pageviews');
			$this->db->from($website);	
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');		
			$pageviews = $this->db->get()->result_array();				
			return $pageviews[0]['pageviews'];
	}
	public function uniquepageviews($start_date, $end_date, $website)
	{
			$this->db->select_sum('uniquePageviews');
			$this->db->from($website);	
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');		
			$uniquepageviews = $this->db->get()->result_array();				
			return $uniquepageviews[0]['uniquePageviews'];
	}
	
    public function sessionduration($start_date, $end_date, $website)
    {
    	$this->db->select_sum('sessionDuration');
    	$this->db->from($website);	
		$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');		
		$duration = $this->db->get()->result_array();				
		return $duration[0]['sessionDuration'];;
    }
     public function avgsession($sessions,$duration)
    {
        $avgsession = $duration/$sessions;
        $milli = $avgsession * 1000;
        $s = round($milli,0);
        $r = $s/60000;
        $final = round($r,2);
        return $final;                      
    }
    public function bounces($start_date, $end_date, $website)
    {
    	$this->db->select_sum('bounces');
    	$this->db->from($website);	
		$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');		
		$bounce = $this->db->get()->result_array();
		return $bounce[0]['bounces'];
    }
    
    public function pathloss($exits,$bounces,$pageviews,$entrances)
    {
        $final = $exits-$bounces;
        $final2 = $pageviews-$entrances;
        $r= ($final/$final2)*100;
        $s = round($r,2);
        return $s;
    }

    public function sessionwithevent($start_date, $end_date, $website)
    {
    	$this->db->select_sum('sessionsWithEvent');	
    	$this->db->from($website);	
		$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');		
		$event = $this->db->get()->result_array();
		return $event[0]['sessionsWithEvent'];
    }
    public function conversion($start_date, $end_date, $website)
    {
    	$this->db->select_sum('goalCompletionsAll');
    	$this->db->from($website);	
		$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');		
		$goals = $this->db->get()->result_array();
		// var_dump($goals);
		return $goals[0]['goalCompletionsAll'];
    }
   
    public function ved($users,$pageviews)
    {
        $final = $pageviews/$users;
        $r = round($final,2);
        return $r;
    }
    public function pcc($unique,$entrances,$sessions,$pageviews)
    {
    	$final = ($entrances/$sessions) * $unique;
    	$final1 = $final/$pageviews;
   		$r = round($final1,2);
        return $r;
    }
    
    public function rvr($newusers,$users)
    {                
        $repeatuser = $users-$newusers;
        $final = ($repeatuser/$users)*100;
        $r = round($final,2);
        return $r;
    }
   
    public function landingpage($start_date, $end_date, $website)
    {

			$this->db->select_sum('users');
			$this->db->from($website);	
			$this->db->where('landingpagePath', '/home');
			$this->db->or_where('landingpagePath', '/');
			$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$final = $this->db->get()->result_array();
			//echo "hello".$final[0]['users'];
			return $final[0]['users'];

    }
    
	
 
}