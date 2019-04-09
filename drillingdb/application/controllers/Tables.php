<?php

class Tables extends CI_Controller{

public function __construct()
{
    parent::__construct();
    $this->load->model('drillingdbmodel');    // load my own db model
    $this->load->helper('url_helper');
    
}   // end of __construct constructor


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

public function index() // loaded by default if '2nd segment' of controller uri left empty
{
    //$data['records'] = $this->drillingdbmodel->getShifts();  // get all rows of shifts
    // show list of tables
    echo '<h2>All tables</h2>';
    
    $this->load->view('tablesview');
//    echo '<p><a href=' . site_url('operators/') . '">Operators</a></p>';
    
    
    
    echo '';
    
    /* <p><a href="<?php echo site_url('news/'.$news_item['slug']); ?>">View article</a></p> */
    
    
}   // end of index function


public function operators()
{
    
}

public function shifts()
{
    $data['records'] = $this->drillingdbmodel->getShifts();  // get all rows of shifts
}   // end of showShifts function


public function view($viewtype = NULL, $viewid = NULL, $para4 = NULL)      // called from tablesview with a parameter (read as $viewtype) in 3rd segment (e.g. site_url('tables/view/operators') as per )
{   // perhaps $viewid shoud be $para3 or $URI3
    
    // load view depending on nature of info (operators, shifts, etc) requested by user
    
    switch ($viewtype)      // check type of view
    {
    
    case 'operators':
        $data['records'] = $this->drillingdbmodel->getOperators();  // get all rows of operators
        $this->load->view('operatorsview',$data);
        break;
    case 'shifts':
        $data['records'] = $this->drillingdbmodel->getShiftsAndRelatedTables();
        //$data['records'] = $this->drillingdbmodel->getShifts();  // get all rows of shifts
        // here, should do a join on work type, project, operator & sep/rig tables to get from their id to description/name for form_dropdown, making associative array with foreach record, ID => description  eg form_dropdown('project',$ProjectAssociativeArray        
        $this->load->view('shiftsview',$data);
        break;
    case 'rigs':
        $data['records'] = $this->drillingdbmodel->getRigs();  // get all rows of SEPs/rigs
        $this->load->view('rigsview',$data);
        break;
    case 'worktypes':
        $data['records'] = $this->drillingdbmodel->getWorkTypes();  // get all rows of operators
        $this->load->view('worktypesview',$data);
        break;
    case 'projects':
        $data['records'] = $this->drillingdbmodel->getProjects();  // get all rows of operators
        $this->load->view('projectsview',$data);
        break;
    
    // beginning of this database case set
    
    case 'operatorupdateview' :        
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('operatorid','Operator ID','callback_operatorid_check');
        //$this->form_validation->set_rules('operatorid','Operator ID', 'required|is_unique[tbloperator.OperatorID]');
        //$this->form_validation->set_rules('operatorid','Operator ID', 'required');
        $this->form_validation->set_rules('operatorname','Operator Name', 'required');
// http://zurb.com/forrst/posts/Adding_an_is_unique_method_to_CodeIgniter_Form-9Q4        
        $data['record'] = $this->drillingdbmodel->getOperators($viewid);  // get a particular record according to id which is passed in the 4th segment of the url (from table view)
        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('operatorupdateview',$data);   
            }
            else 
            {
                //$this->load->view('formsuccess');   
                
            }                        
        break;
    case 'operatorupdate' :
        $operatorid = $this->input->post('operatorid');
        $operatorname = $this->input->post('operatorname');
        $this->drillingdbmodel->setOperator($operatorid,$operatorname);
//        $this->drillingdbmodel->setOperator($this->input->post('operatorid'),$this->input->post('operatorname'));
        $data['records'] = $this->drillingdbmodel->getOperators();  // get all rows of operators
        $this->load->view('operatorsview',$data);    // return to all records?
        break;

    case 'operatorinsertview' :
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('operatorname','Operator Name', 'required');

        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('operatorinsertview');   
            }
            else 
            {
                //$this->load->view('formsuccess');                   
            }                        
        break;
        
    case 'operatorinsert' :
        $operatorname = $this->input->post('operatorname');
        $this->drillingdbmodel->insertOperator($operatorname);
        $data['records'] = $this->drillingdbmodel->getOperators();  // get all rows of operators
        $this->load->view('operatorsview',$data);    // return to all records?
        break;        
// delete confirm ?
    case 'operatordeleteview' :
        $this->load->helper(array('form', 'url'));        
        $data['record'] = $this->drillingdbmodel->getOperators($viewid);  // get selected record
                $this->load->view('operatordeleteview',$data);   
        break;

        
    case 'operatordelete' :
        $operatorid = $this->input->post('operatorid');
        $this->drillingdbmodel->deleteOperator($operatorid);
        $data['records'] = $this->drillingdbmodel->getOperators();  // get all rows of operators
        $this->load->view('operatorsview',$data);    // return to all records?    
        break;

    // end of this database case set (operators)

    
    // beginning of this database case set (shifts)
    
    case 'shiftupdateview' :        
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('shiftid','Shift ID','callback_shiftid_check');
        //$this->form_validation->set_rules('shiftid','Shift ID', 'required|is_unique[tblshift.ShiftID]');
        //$this->form_validation->set_rules('shiftid','Shift ID', 'required');
        $this->form_validation->set_rules('shiftname','Shift Name', 'required');
// http://zurb.com/forrst/posts/Adding_an_is_unique_method_to_CodeIgniter_Form-9Q4        
        $data['operatorpair'] = $this->drillingdbmodel->getOperatorIDOperatorNamePairs();
        $data['projectpair'] = $this->drillingdbmodel->getProjectIDProjectDescriptionPairs();
        $data['worktypepair'] = $this->drillingdbmodel->getWorkTypeIDWorkTypeDescriptionPairs();
        $data['rigpair'] = $this->drillingdbmodel->getRigIDRigDescriptionPairs();
        $data['record'] = $this->drillingdbmodel->getShiftsAndRelatedTables($viewid);  // get a particular record according to id which is passed in the 4th segment of the url (from table view)
        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('shiftupdateview',$data);   
            }
            else 
            {
                //$this->load->view('formsuccess');   
                
            }                        
        break;
    case 'shiftupdate' :
        $shiftid = $this->input->post('shiftid');
        //$shiftname = $this->input->post('shiftname');
        $WorkHours = $this->input->post('workhours');
        $WorkTypeID = $this->input->post('worktypeid');
        $ProjectID = $this->input->post('projectid');
        $OperatorID = $this->input->post('operatorid');
        $Product = $this->input->post('product');
        $Date = $this->input->post('date');
        $StartDateTime = $this->input->post('startdatetime');
        $EndDateTime = $this->input->post('enddatetime');
        $SeprigID = $this->input->post('rigid');            

        $this->drillingdbmodel->setShift($shiftid,$WorkHours,$WorkTypeID,$ProjectID,$OperatorID,$Product,$Date,$StartDateTime,$EndDateTime,$SeprigID);
//        $this->drillingdbmodel->setShift($this->input->post('shiftid'),$this->input->post('shiftname'));
//        $data['records'] = $this->drillingdbmodel->getShifts();  // get all rows of shifts
        $data['records'] = $this->drillingdbmodel->getShiftsAndRelatedTables();        
        $this->load->view('shiftsview',$data);    // return to all records?
        break;

    case 'shiftinsertview' :
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
//        $this->form_validation->set_rules('shiftid','Shift ID', 'required');
        $this->form_validation->set_rules('operatorid','Operator', 'required');
        $this->form_validation->set_rules('worktypeid','Work Type', 'required');
//        $this->form_validation->set_rules('shiftname','Shift Name', 'required');

                
        if ($this->form_validation->run() == FALSE)
            {
                $data['operatorpair'] = $this->drillingdbmodel->getOperatorIDOperatorNamePairs();
                $data['projectpair'] = $this->drillingdbmodel->getProjectIDProjectDescriptionPairs();
                $data['worktypepair'] = $this->drillingdbmodel->getWorkTypeIDWorkTypeDescriptionPairs();
                $data['rigpair'] = $this->drillingdbmodel->getRigIDRigDescriptionPairs();

                $this->load->view('shiftinsertview',$data);   
            }
            else 
            {
                //$this->load->view('formsuccess');                   
            }                        
        break;
        
    case 'shiftinsert' :
        $WorkHours = $this->input->post('workhours');
        $WorkTypeID = $this->input->post('worktypeid');
        $ProjectID = $this->input->post('projectid');
        $OperatorID = $this->input->post('operatorid');
        $Product = $this->input->post('product');
        $Date = $this->input->post('date');
        $StartDateTime = $this->input->post('startdatetime');
        $EndDateTime = $this->input->post('enddatetime');
        $SeprigID = $this->input->post('rigid');            

        $this->drillingdbmodel->insertShift($WorkHours,$WorkTypeID,$ProjectID,$OperatorID,$Product,$Date,$StartDateTime,$EndDateTime,$SeprigID);
        //$data['records'] = $this->drillingdbmodel->getShifts();  // get all rows of shifts
        $data['records'] = $this->drillingdbmodel->getShiftsAndRelatedTables();
        $this->load->view('shiftsview',$data);    // return to all records?
        break;        
// delete confirm ?
    case 'shiftdeleteview' :
        $this->load->helper(array('form', 'url'));        
  //      $data['record'] = $this->drillingdbmodel->getShifts($viewid);  // get selected record
        $data['record'] = $this->drillingdbmodel->getShiftsAndRelatedTables($viewid);                
                $this->load->view('shiftdeleteview',$data);   
        break;

        
    case 'shiftdelete' :
        $shiftid = $this->input->post('shiftid');
        $this->drillingdbmodel->deleteShift($shiftid);
//        $data['records'] = $this->drillingdbmodel->getShifts();  // get all rows of shifts
        $data['records'] = $this->drillingdbmodel->getShiftsAndRelatedTables();     // haha! res o dhodho bos "records" yn le "record" !
            $this->load->view('shiftsview',$data);    // return to all records?    
        break;

    // end of this database case set (shifts)
    
    // beginning of this database case set (projects)
    
    case 'projectupdateview' :        
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('projectid','Project ID','callback_projectid_check');
        //$this->form_validation->set_rules('projectid','Project ID', 'required|is_unique[tblproject.ProjectID]');
        //$this->form_validation->set_rules('projectid','Project ID', 'required');
        $this->form_validation->set_rules('projectname','Project Name', 'required');
// http://zurb.com/forrst/posts/Adding_an_is_unique_method_to_CodeIgniter_Form-9Q4        
        $data['record'] = $this->drillingdbmodel->getProjects($viewid);  // get a particular record according to id which is passed in the 4th segment of the url (from table view)
        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('projectupdateview',$data);   
            }
            else 
            {
                //$this->load->view('formsuccess');   
                
            }                        
        break;
    case 'projectupdate' :
        $projectid = $this->input->post('projectid');
        $projectcode = $this->input->post('projectcode');
        $projectdescription = $this->input->post('projectdescription');
        $this->drillingdbmodel->setProject($projectid,$projectcode,$projectdescription);
//        $this->drillingdbmodel->setProject($this->input->post('projectid'),$this->input->post('projectname'));
        $data['records'] = $this->drillingdbmodel->getProjects();  // get all rows of projects
        $this->load->view('projectsview',$data);    // return to all records?
        break;

    case 'projectinsertview' :
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('projectname','Project Name', 'required');

        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('projectinsertview');   
            }
            else 
            {
                //$this->load->view('formsuccess');                   
            }                        
        break;
        
    case 'projectinsert' :
        $projectcode = $this->input->post('projectcode');
        $projectdescription = $this->input->post('projectdescription');
        $this->drillingdbmodel->insertProject($projectcode,$projectdescription);
        $data['records'] = $this->drillingdbmodel->getProjects();  // get all rows of projects
        $this->load->view('projectsview',$data);    // return to all records?
        break;        
// delete confirm ?
    case 'projectdeleteview' :
        $this->load->helper(array('form', 'url'));        
        $data['record'] = $this->drillingdbmodel->getProjects($viewid);  // get selected record
                $this->load->view('projectdeleteview',$data);   
        break;

        
    case 'projectdelete' :
        $projectid = $this->input->post('projectid');
        $this->drillingdbmodel->deleteProject($projectid);
        $data['records'] = $this->drillingdbmodel->getProjects();  // get all rows of projects
        $this->load->view('projectsview',$data);    // return to all records?    
        break;

    // end of this database case set (projects)
    
    // beginning of this database case set (work types)
    
    case 'worktypeupdateview' :        
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('worktypeid','WorkType ID','callback_worktypeid_check');
        //$this->form_validation->set_rules('worktypeid','WorkType ID', 'required|is_unique[tblworktype.WorkTypeID]');
        //$this->form_validation->set_rules('worktypeid','WorkType ID', 'required');
        $this->form_validation->set_rules('worktypename','WorkType Name', 'required');
// http://zurb.com/forrst/posts/Adding_an_is_unique_method_to_CodeIgniter_Form-9Q4        
        $data['record'] = $this->drillingdbmodel->getWorkTypes($viewid);  // get a particular record according to id which is passed in the 4th segment of the url (from table view)
        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('worktypeupdateview',$data);   
            }
            else 
            {
                //$this->load->view('formsuccess');   
                
            }                        
        break;
    case 'worktypeupdate' :
        $worktypeid = $this->input->post('worktypeid');
        $worktypecode = $this->input->post('worktypecode');
        $worktypedescription = $this->input->post('worktypedescription');
        $this->drillingdbmodel->setWorkType($worktypeid,$worktypecode,$worktypedescription);
//        $this->drillingdbmodel->setWorkType($this->input->post('worktypeid'),$this->input->post('worktypename'));
        $data['records'] = $this->drillingdbmodel->getWorkTypes();  // get all rows of worktypes
        $this->load->view('worktypesview',$data);    // return to all records?
        break;

    case 'worktypeinsertview' :
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('worktypename','WorkType Name', 'required');

        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('worktypeinsertview');   
            }
            else 
            {
                //$this->load->view('formsuccess');                   
            }                        
        break;
        
    case 'worktypeinsert' :
        $worktypecode = $this->input->post('worktypecode');
        $worktypedescription = $this->input->post('worktypedescription');
        $this->drillingdbmodel->insertWorkType($worktypecode,$worktypedescription);
        $data['records'] = $this->drillingdbmodel->getWorkTypes();  // get all rows of worktypes
        $this->load->view('worktypesview',$data);    // return to all records?
        break;        
// delete confirm ?
    case 'worktypedeleteview' :
        $this->load->helper(array('form', 'url'));        
        $data['record'] = $this->drillingdbmodel->getWorkTypes($viewid);  // get selected record
                $this->load->view('worktypedeleteview',$data);   
        break;

        
    case 'worktypedelete' :
        $worktypeid = $this->input->post('worktypeid');
        $this->drillingdbmodel->deleteWorkType($worktypeid);
        $data['records'] = $this->drillingdbmodel->getWorkTypes();  // get all rows of worktypes
        $this->load->view('worktypesview',$data);    // return to all records?    
        break;

    // end of this database case set (work types)
    
    
    // beginning of this database case set (SEPs / Rigs)
    
    case 'rigupdateview' :        
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('rigid','Rig ID','callback_rigid_check');
        //$this->form_validation->set_rules('rigid','Rig ID', 'required|is_unique[tblrig.RigID]');
        //$this->form_validation->set_rules('rigid','Rig ID', 'required');
        $this->form_validation->set_rules('rigname','Rig Name', 'required');
// http://zurb.com/forrst/posts/Adding_an_is_unique_method_to_CodeIgniter_Form-9Q4        
        $data['record'] = $this->drillingdbmodel->getRigs($viewid);  // get a particular record according to id which is passed in the 4th segment of the url (from table view)
        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('rigupdateview',$data);   
            }
            else 
            {
                //$this->load->view('formsuccess');   
                
            }                        
        break;
    case 'rigupdate' :
        $rigid = $this->input->post('rigid');
        $rigcode = $this->input->post('rigcode');
        $rigdescription = $this->input->post('rigdescription');

        $this->drillingdbmodel->setRig($rigid,$rigcode,$rigdescription);
//        $this->drillingdbmodel->setRig($this->input->post('rigid'),$this->input->post('rigname'));
        $data['records'] = $this->drillingdbmodel->getRigs();  // get all rows of rigs
        $this->load->view('rigsview',$data);    // return to all records?
        break;

    case 'riginsertview' :
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('rigname','Rig Name', 'required');

        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('riginsertview');   
            }
            else 
            {
                //$this->load->view('formsuccess');                   
            }                        
        break;
        
    case 'riginsert' :
        $rigcode = $this->input->post('rigcode');
        $rigdescription = $this->input->post('rigdescription');

        $this->drillingdbmodel->insertRig($rigcode,$rigdescription);
        $data['records'] = $this->drillingdbmodel->getRigs();  // get all rows of rigs
        $this->load->view('rigsview',$data);    // return to all records?
        break;        
// delete confirm ?
    case 'rigdeleteview' :
        $this->load->helper(array('form', 'url'));        
        $data['record'] = $this->drillingdbmodel->getRigs($viewid);  // get selected record
                $this->load->view('rigdeleteview',$data);   
        break;

        
    case 'rigdelete' :
        $rigid = $this->input->post('rigid');
        $this->drillingdbmodel->deleteRig($rigid);
        $data['records'] = $this->drillingdbmodel->getRigs();  // get all rows of rigs
        $this->load->view('rigsview',$data);    // return to all records?    
        break;

    // end of this database case set (SEPs / Rigs)
    
    case 'shiftsetcreport' :        // JOIN-ed report on shifts - who, what, where, when &c (i.e. shifts etc)
        $data['records'] = $this->drillingdbmodel->getShiftsReport();  // fetch shifts report data
//        $data['records'] = $this->drillingdbmodel->getShiftsProductSummedByOperatorReport();  // fetch shifts report data
        $data['operatorproductsum'] = $this->drillingdbmodel->getSumAllShiftsProductGroupedByOperator() ;
        $data['dateproductsum'] = $this->drillingdbmodel->getSumAllShiftsProductEachDate();
        $data['producttotal'] = $this->drillingdbmodel->getSumAllShiftsProduct() ;
        
        $this->load->view('shiftsetcreport',$data);        
    break;

    case 'shiftsetcreportbydate' :
        $data['records'] = $this->drillingdbmodel->getShiftsReportByDate($viewid,$para4);  // fetch shifts report data
//        $data['records'] = $this->drillingdbmodel->getShiftsProductSummedByOperatorReport();  // fetch shifts report data
        $data['operatorproductsum'] = $this->drillingdbmodel->getSumAllShiftsProductGroupedByOperatorByDate($viewid,$para4);   // $viewid - 3rd URI segment, para4 - 4th URI segment
        $data['dateproductsum'] = $this->drillingdbmodel->getSumAllShiftsProductEachDateByDate($viewid,$para4);
        $data['producttotal'] = $this->drillingdbmodel->getSumAllShiftsProductByDate($viewid,$para4);   // $viewid - 3rd URI segment, para4 - 4th URI segment
        $data['startdate'] = $viewid;       // 3rd URI segment - should be start date
        $data['enddate'] = $para4;  // parameter 4 - 4th URI segment - should be end date
        $this->load->view('shiftsetcreport',$data);        
        
    break;

    
    default:        // in case none of the above
        
    }
    
}   // end of view function

public function operatorid_check($str)
{
    if ($str == test)
    {
        $this->form_validation->set_message('operatorid_check','The {field} field must not have a value already used by another record - it must be unique.');
                return FALSE;
        
    }
    else
    {
        return TRUE;
    }
    
}

}   // end of Tables controller class definition
?>
