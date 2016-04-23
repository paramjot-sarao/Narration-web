 <?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Question_model extends MY_Model
{

	public function __construct()
	{
        $this->table = 'questions';
        $this->primary_key = 'question_id';
     
        //$this->has_one['scale'] = array('Scales_model','scale_id','question_id');

        //$this->has_one['scale'] = array('foreign_model'=>'Scales_model','foreign_table'=>'scales','foreign_key'=>'scale_id','local_key'=>'question_id');
        //$this->has_one['scale'] = 'Scales_model';
        $this->load->library('NarrationEngine');
		parent::__construct();

	}

	public function get_questions() 
        {
                $this->db->select('questions.*,scales.*,questionnaireone.*');
                $this->db->from('questions');
                $this->db->join('scales', 'scales.scale_id = questions.scale_id');
                $this->db->join('questionnaireone','questionnaireone.questionnaire_id = questions.questionnaire_id');
                return $this->db->get()->result();
        }

       public function get_id()
        {
                $this->db->select('questionnaire_id');
                $this->db->from('questionnaireone');
               return $this->db->get()->result();
        }


        public function qfd_one($one)                   //to collect data from qfd one table 
        {
                $result = array();
             
        for($i = 1; $i <= 93; $i++) 
        {
                $resp = array();
                for($p = 1; $p <= 5; $p++) {

                $this->db->select('user_id');
                $this->db->from('response');
                $this->db->where('question_id', $i);
                $this->db->where('response', $p);
                $resp['value'.$p]= $this->db->count_all_results();

                }
                $resp['question_id'] = $i;
                $resp['questionnaire_id'] = (int)$one->questionnaire_id;
                $result[$i] = $resp;
        }

        return $result;
        }

         public function count_user()
        {
                $this->db->distinct();                   
                $this->db->select('user_id');
                $this->db->from('response');
                $raters = $this->db->count_all_results();

                return $raters;


        }

        public function questions_count()
        {

                $this->db->distinct();                          // number of subjects
                $this->db->select('question_id');
                $this->db->from('response');
                $subjects = $this->db->count_all_results();

                return $subjects;

        }
        public function qfd_column_sum()                //to calculate the sum of all values of all columns
        {

                $sum = array();
                $final = array();
                for($i = 1; $i <=5; $i++)
                {

                        $valname = 'value'.$i;  // for variable column name, value1/value2....  

                $this->db->select_sum($valname);
                $this->db->from('qfdone');
                
              $j = $this->db->get()->result();
              $p = $j[0];
              
              $sum[$i] = (int)$p->$valname;
                $r = array(
                        'sum' => $sum[$i],              // sum of all values in particular column
                      // 'squared_sum' => pow($sum[$i], 2)       // square of sum of all values in particular column
                         );
                array_push($final, $r);
              }
              return $final;

        }
         public function qfd_rows_sum()
        
        {               
                $rows = array();
               
                $final = array();
           $rows = $this->db->select('*')
                        ->from('qfdone')
                        ->get()->result();
           
              foreach($rows as $row)
              {
                unset($row->id);
                unset($row->questionnaire_id);
                unset($row->question_id);

                $squares = array();
            
                foreach($row as $val)
                {

                        array_push($squares,pow($val,2));
                }

                $r = array_sum($squares);
               
                array_push($final, $r);
              }
                return $final;      

        }
       
        public function p_j($columnsum,$rater,$question)
        {         
                $raters = $rater;                
                $subjects = $question;
            
                echo "<br>";
                $pj = 1/($subjects*$raters);
               //$p1 = number_format($pj, 5);

                $final = array();
                foreach($columnsum as $val)
                {

                $p1 =  $pj * $val['sum'];
                  array_push($final,$p1);
                }
                return $final;
        }
    
        public function p_i($rowsum,$rater)
        {
               // echo "<br>";
               $raters = $rater;

                $p1 = 1/($raters*($raters-1));                
          // $p2 = number_format($p1, 5);

                $final = array();
                foreach($rowsum as $val)
                {
                       // array_push($final,$p1 * ($val['row_sum']-$raters));
                          array_push($final,$p1 * ($val - $raters));

                }

                return $final;
        }

        public function pbar($p_i,$question)
        {
             
                $count = $question;                              
                $sum = array_sum($p_i);
                echo "<br>";
              
                $result = $sum / $count;
               // echo 'sum of all values of p_i:'. $sum;
                return $result;

        }

        public function pe_bar($p_j)
        {
               $b = array_sum($p_j);
               echo "<br>";
              // echo $b;
                $final = array();
                 foreach($p_j as $val)
                 {

                        //array_push($final,$val['squared_sum']);
                        array_push($final,pow($val,2));
                 }
                // var_dump($p_j);
                //var_dump($final);
                $a = array_sum($final);
                return $a;

        }
       
        public function final_value($pbar,$pebar)
        {

                $k =($pbar-$pebar)/(1-$pebar);

                return $k;
        }

         public function questionnaire_id()
        {
                $this->db->select('questionnaire_id');
                $this->db->from('questionnaireone');
                $result = $this->db->get()->result();
                $result = $result[0];

                $resp = (int)$result->questionnaire_id;
              
                return $resp;
                //var_dump($resp);
               

        }

       

        
        
}