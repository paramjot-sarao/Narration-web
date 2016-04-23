<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Precedence extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('NarrationEngine');
		$this->load->model('Question_model', 'qmodel');

		
	}

	public function index()
	{
		
	}
	public function priority()
	{
  	$rater = $this->qmodel->count_user();	
  	$question = $this->qmodel->questions_count();	
   	$columnsum = $this->qmodel->qfd_column_sum(); 	
   	$rowsum = $this->qmodel->qfd_rows_sum(); 	
  	$p_j = $this->qmodel->p_j($columnsum,$rater,$question); 	
  	$p_i = $this->qmodel->p_i($rowsum,$rater); 	
   	$pbar = $this->qmodel->pbar($p_i,$question); 	
  	$pebar = $this->qmodel->pe_bar($p_j);		
  	$k = $this->qmodel->final_value($pbar,$pebar);
  	$questionnaire = $this->qmodel->questionnaire_id();	 
  	$order = $this->precedence($p_i,$p_j,$questionnaire);		//$p_i is i value, $p_j is j value, calculates precedence of all questions

  	$this->db->select('*');
      $this->db->from('precedence');
      $value = $this->db->count_all_results();

      if($value == 0)
      {
    		$this->db->insert_batch('precedence', $order);
   	}
   	else
   	{
   		$this->db->update_batch('precedence', $order, 'question_id');

   	}
   	$temp = $this->table_temp($order);//calculate average,deviation to find relevant questions
  //var_dump($temp);
    $final_questions = $this->final_questions($temp);//calculates final precedence value of relevant questions
    
    $this->db->select('*');
    $this->db->from('relevant2');
    $value = $this->db->count_all_results();

      /*if($value == 0)
      {
        $this->db->insert_batch('relevant2', $final_questions);
    }
    else
    {
      $this->db->update_batch('relevant2', $final_questions, 'question_id');

    }
   */
  
   }

  public function precedence($p_i,$p_j,$questionnaire)//... to calculate the precedence of questions
        {
                $result = array();                            
                $resp = array();
                $question = array();

                $this->db->select('question_id');
                $this->db->from('qfdone');
                $subjects = $this->db->get()->result();

                $this->db->select('question_id, question_name');
                $this->db->from('questions');
                $param = $this->db->get()->result();
                //var_dump($param);
            
                foreach($subjects as $val)
                {          

                $question1 = $val->question_id;         //for converting object into array
               
                $subject = (int)$question1;             //object of std class
                array_push($question,$subject);
               
                }
           
                $count1 = 0;
                foreach($p_i as $vali)
                {
                        $count = 1;
                        $resp['questionnaire_id'] = $questionnaire;
                        $resp['question_id'] = $question[$count1];                   
                                            
                        foreach($p_j as $valj)
                        {                                
                                $r = $vali/$valj;
                                 $resp['pj'.$count]= $r;
                                 $count++;
                        }
                       
                  array_push($result,$resp);
                  $count1++;
                }
              
                return $result; 

        }
     
    public function table_temp($order) //calculate average,deviation to find rrelevant questions 
                                      //whose precedence value is gretaer than given value
        {        
        	
            $pj1 = array();
            $pj2 = array();
            $pj3 = array();
            $pj4 = array();
            $pj5 = array();
            foreach($order as $valj)
                        {       
                            array_push($pj1, $valj['pj1']);
                            array_push($pj2, $valj['pj2']);
                            array_push($pj3, $valj['pj3']);
                            array_push($pj4, $valj['pj4']);
                            array_push($pj5, $valj['pj5']);
                        }
                     
           $average = array(
                'pj1' => array_sum($pj1) / count($pj1),
                'pj2' => array_sum($pj2) / count($pj2),
                'pj3' => array_sum($pj3) / count($pj3),   
                'pj4' => array_sum($pj4) / count($pj4),   
                'pj5' => array_sum($pj5) / count($pj5)
                );
           $deviation = array(
           'pj1' => $this->narrationengine->StandardDeviation($pj1),
           'pj2' => $this->narrationengine->StandardDeviation($pj2),
           'pj3' => $this->narrationengine->StandardDeviation($pj3),
           'pj4' => $this->narrationengine->StandardDeviation($pj4),
           'pj5' => $this->narrationengine->StandardDeviation($pj5),
           );
           
          
         
           $cutt = array(
         	'pj1' => (float)bcdiv($average['pj1'] + $deviation['pj1'],1,0),
           //'pj1' => (int)$average['pj1'] + $deviation['pj1'],
           'pj2' => round($average['pj2'] + $deviation['pj2'],0)-1,
           'pj3' => (float)bcdiv($average['pj3'] + $deviation['pj3'],1,1),
           'pj4' => round($average['pj4'] + $deviation['pj4'],0),
           'pj5' => round($average['pj5'] + $deviation['pj5'],0),
           );
            
            
            //echo "Final questions:";
          	$this->db->select('question_id');
           	$this->db->from('precedence');
           	$this->db->where('pj1 <', $cutt['pj1']);
           	$column1 = $this->db->get()->result();
           	$common = array();
           	foreach($column1 as $val)
           	{
           		
           		$new = $val->question_id;
           		array_push($common,$new);
           	}
           	$this->db->select('question_id');
           	$this->db->from('precedence');
            $this->db->where('pj2 <', $cutt['pj2']);
            $column2 = $this->db->get()->result();
            $common1 = array();
            foreach($column2 as $val)
           	{
           		
           		$new = $val->question_id;
           		array_push($common1,$new);
           	}            
           	$this->db->select('question_id');
           	$this->db->from('precedence');
            $this->db->where('pj3<', $cutt['pj3']);
            $column3 = $this->db->get()->result();
            $common2 = array();
            foreach($column3 as $val)
           	{
           		
           		$new = $val->question_id;
           		array_push($common2,$new);
           	}
            
            $this->db->select('question_id');
           	$this->db->from('precedence');
            $this->db->where('pj4 <', $cutt['pj4']);
            $column4 = $this->db->get()->result();
            $common3 = array();
            foreach($column4 as $val)
           	{
           		
           		$new = $val->question_id;
           		array_push($common3,$new);
           	}
           
          	$this->db->select('question_id');
           	$this->db->from('precedence');
            $this->db->where('pj5 <', $cutt['pj5']);
            $column5 = $this->db->get()->result();
            $common4 = array();
            foreach($column4 as $val)
           	{
           		
           		$new = $val->question_id;
           		array_push($common4,$new);
           	}
           	$common_array = array_unique(array_merge($common,$common1,$common2,$common3,$common4));
          // var_dump($common_array); contains unique values of questions in each column
           $this->data['average'] = $average;
           $this->data['deviation'] = $deviation;
           $this->data['cutt']= $cutt;
           $this->render('admin/precedence_view');
           return $common_array ;   

           /* for($i =1; $i<=5; $i++)
                {
                        $query = $this->db->query('CREATE TEMPORARY TABLE precedence'.$this->db->escape($i). ' AS (SELECT question_id FROM precedence WHERE pj'.$this->db->escape($i). ' > 1.83658)');
             //   $query = $this->db->query('CREATE TEMPORARY TABLE precedence'.$this->db->escape($i). ' AS (SELECT question_id, pj'.$this->db->escape($i). ' FROM precedence WHERE pj'.$this->db->escape($i). ' > 2.03366)');
                }
            
                $this->db->select('precedence1.*,precedence2.*,precedence3.*,precedence4.*,precedence5.*');
                $this->db->from('precedence1');
                $this->db->join('precedence2', 'precedence2.question_id = precedence1.question_id');
                $this->db->join('precedence3', 'precedence3.question_id = precedence2.question_id');
                $this->db->join('precedence4', 'precedence4.question_id = precedence3.question_id');
                $this->db->join('precedence5', 'precedence5.question_id = precedence4.question_id');

               // $this->db->join('scales', 'scales.scale_id = questions.scale_id');
               // $this->db->join('questionnaireone','questionnaireone.questionnaire_id = questions.questionnaire_id');
                $data = $this->db->get()->result();
                var_dump($data);*/

        } 

    public function final_questions($final) //calculates sum of precedence of relevant questions
    {
       $iterator = new MultipleIterator;
      $this->db->select('question_id,pj1,pj2,pj3,pj4,pj5');
      $this->db->from('precedence');
      $this->db->where_in('question_id',$final);
      $result = $this->db->get()->result();
      
      $new_array = array();
      $results = array();
      foreach($result as $val)
      {
        $new['question_id']= $val->question_id;
        $new['pj1'] = $val->pj1;
        $new['pj2'] = $val->pj2;
        $new['pj3'] = $val->pj3;
        $new['pj4'] = $val->pj4;
        $new['pj5'] = $val->pj5;    
      array_push($new_array,$new);
      }
      
      foreach($new_array as $val)
      {
        unset($val['question_id']);
       
        $final = array_sum($val);
        array_push($results,$final);

      }
      /*$values = array();
      
      foreach($result as $param)
      {
        $value['question_id'] = $param->question_id;
        array_push($values,$value);

      }
      $final = array();
       $iterator->attachIterator(new ArrayIterator($values));
        $iterator->attachIterator(new ArrayIterator($results));
        foreach ($iterator as $val) 
            {
                
                $value['question_id'] = $val[0];
                $value['sum of precedence'] = $val[1];
               
                array_push($final,$value);
        }
        
     

    var_dump($final);*/
      
      return $results;


    }
	

	
}
