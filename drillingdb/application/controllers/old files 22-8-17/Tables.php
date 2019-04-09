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
//    echo '<p><a href=' . site_url('drillers/') . '">Drillers</a></p>';
    
    
    
    echo '';
    
    /* <p><a href="<?php echo site_url('news/'.$news_item['slug']); ?>">View article</a></p> */
    
    
}   // end of index function


public function drillers()
{
    
}

public function shifts()
{
    $data['records'] = $this->drillingdbmodel->getShifts();  // get all rows of shifts
}   // end of showShifts function


public function view($viewtype = NULL, $viewid = NULL, $para4 = NULL)      // called from tablesview with a parameter (read as $viewtype) in 3rd segment (e.g. site_url('tables/view/drillers') as per )
{   // perhaps $viewid shoud be $para3 or $URI3
    
    // load view depending on nature of info (drillers, shifts, etc) requested by user
    
    switch ($viewtype)      // check type of view
    {
    
    case 'drillers':
        $data['records'] = $this->drillingdbmodel->getDrillers();  // get all rows of drillers
        $this->load->view('drillersview',$data);
        break;
    case 'shifts':
        $data['records'] = $this->drillingdbmodel->getShiftsAndRelatedTables();
        //$data['records'] = $this->drillingdbmodel->getShifts();  // get all rows of shifts
        // here, should do a join on work type, project, driller & sep/rig tables to get from their id to description/name for form_dropdown, making associative array with foreach record, ID => description  eg form_dropdown('project',$ProjectAssociativeArray        
        $this->load->view('shiftsview',$data);
        break;
    case 'seprigs':
        $data['records'] = $this->drillingdbmodel->getSEPRigs();  // get all rows of SEPs/rigs
        $this->load->view('seprigsview',$data);
        break;
    case 'worktypes':
        $data['records'] = $this->drillingdbmodel->getWorkTypes();  // get all rows of drillers
        $this->load->view('worktypesview',$data);
        break;
    case 'projects':
        $data['records'] = $this->drillingdbmodel->getProjects();  // get all rows of drillers
        $this->load->view('projectsview',$data);
        break;
    
    // beginning of this database case set
    
    case 'drillerupdateview' :        
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('drillerid','Driller ID','callback_drillerid_check');
        //$this->form_validation->set_rules('drillerid','Driller ID', 'required|is_unique[tbldriller.DrillerID]');
        //$this->form_validation->set_rules('drillerid','Driller ID', 'required');
        $this->form_validation->set_rules('drillername','Driller Name', 'required');
// http://zurb.com/forrst/posts/Adding_an_is_unique_method_to_CodeIgniter_Form-9Q4        
        $data['record'] = $this->drillingdbmodel->getDrillers($viewid);  // get a particular record according to id which is passed in the 4th segment of the url (from table view)
        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('drillerupdateview',$data);   
            }
            else 
            {
                //$this->load->view('formsuccess');   
                
            }                        
        break;
    case 'drillerupdate' :
        $drillerid = $this->input->post('drillerid');
        $drillername = $this->input->post('drillername');
        $this->drillingdbmodel->setDriller($drillerid,$drillername);
//        $this->drillingdbmodel->setDriller($this->input->post('drillerid'),$this->input->post('drillername'));
        $data['records'] = $this->drillingdbmodel->getDrillers();  // get all rows of drillers
        $this->load->view('drillersview',$data);    // return to all records?
        break;

    case 'drillerinsertview' :
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('drillername','Driller Name', 'required');

        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('drillerinsertview');   
            }
            else 
            {
                //$this->load->view('formsuccess');                   
            }                        
        break;
        
    case 'drillerinsert' :
        $drillername = $this->input->post('drillername');
        $this->drillingdbmodel->insertDriller($drillername);
        $data['records'] = $this->drillingdbmodel->getDrillers();  // get all rows of drillers
        $this->load->view('drillersview',$data);    // return to all records?
        break;        
// delete confirm ?
    case 'drillerdeleteview' :
        $this->load->helper(array('form', 'url'));        
        $data['record'] = $this->drillingdbmodel->getDrillers($viewid);  // get selected record
                $this->load->view('drillerdeleteview',$data);   
        break;

        
    case 'drillerdelete' :
        $drillerid = $this->input->post('drillerid');
        $this->drillingdbmodel->deleteDriller($drillerid);
        $data['records'] = $this->drillingdbmodel->getDrillers();  // get all rows of drillers
        $this->load->view('drillersview',$data);    // return to all records?    
        break;

    // end of this database case set (drillers)

    
    // beginning of this database case set (shifts)
    
    case 'shiftupdateview' :        
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('shiftid','Shift ID','callback_shiftid_check');
        //$this->form_validation->set_rules('shiftid','Shift ID', 'required|is_unique[tblshift.ShiftID]');
        //$this->form_validation->set_rules('shiftid','Shift ID', 'required');
        $this->form_validation->set_rules('shiftname','Shift Name', 'required');
// http://zurb.com/forrst/posts/Adding_an_is_unique_method_to_CodeIgniter_Form-9Q4        
        $data['drillerpair'] = $this->drillingdbmodel->getDrillerIDDrillerNamePairs();
        $data['projectpair'] = $this->drillingdbmodel->getProjectIDProjectDescriptionPairs();
        $data['worktypepair'] = $this->drillingdbmodel->getWorkTypeIDWorkTypeDescriptionPairs();
        $data['seprigpair'] = $this->drillingdbmodel->getSEPRigIDSEPRigDescriptionPairs();
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
        $DrillerID = $this->input->post('drillerid');
        $Metres = $this->input->post('metres');
        $Date = $this->input->post('date');
        $StartDateTime = $this->input->post('startdatetime');
        $EndDateTime = $this->input->post('enddatetime');
        $SeprigID = $this->input->post('seprigid');            

        $this->drillingdbmodel->setShift($shiftid,$WorkHours,$WorkTypeID,$ProjectID,$DrillerID,$Metres,$Date,$StartDateTime,$EndDateTime,$SeprigID);
//        $this->drillingdbmodel->setShift($this->input->post('shiftid'),$this->input->post('shiftname'));
//        $data['records'] = $this->drillingdbmodel->getShifts();  // get all rows of shifts
        $data['records'] = $this->drillingdbmodel->getShiftsAndRelatedTables();        
        $this->load->view('shiftsview',$data);    // return to all records?
        break;

    case 'shiftinsertview' :
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
//        $this->form_validation->set_rules('shiftid','Shift ID', 'required');
        $this->form_validation->set_rules('drillerid','Driller', 'required');
        $this->form_validation->set_rules('worktypeid','Work Type', 'required');
//        $this->form_validation->set_rules('shiftname','Shift Name', 'required');

                
        if ($this->form_validation->run() == FALSE)
            {
                $data['drillerpair'] = $this->drillingdbmodel->getDrillerIDDrillerNamePairs();
                $data['projectpair'] = $this->drillingdbmodel->getProjectIDProjectDescriptionPairs();
                $data['worktypepair'] = $this->drillingdbmodel->getWorkTypeIDWorkTypeDescriptionPairs();
                $data['seprigpair'] = $this->drillingdbmodel->getSEPRigIDSEPRigDescriptionPairs();

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
        $DrillerID = $this->input->post('drillerid');
        $Metres = $this->input->post('metres');
        $Date = $this->input->post('date');
        $StartDateTime = $this->input->post('startdatetime');
        $EndDateTime = $this->input->post('enddatetime');
        $SeprigID = $this->input->post('seprigid');            

        $this->drillingdbmodel->insertShift($WorkHours,$WorkTypeID,$ProjectID,$DrillerID,$Metres,$Date,$StartDateTime,$EndDateTime,$SeprigID);
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
        $data['record'] = $this->drillingdbmodel->getShiftsAndRelatedTables();                $this->load->view('shiftsview',$data);    // return to all records?    
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
    
    case 'seprigupdateview' :        
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('seprigid','SEPRig ID','callback_seprigid_check');
        //$this->form_validation->set_rules('seprigid','SEPRig ID', 'required|is_unique[tblseprig.SEPRigID]');
        //$this->form_validation->set_rules('seprigid','SEPRig ID', 'required');
        $this->form_validation->set_rules('seprigname','SEPRig Name', 'required');
// http://zurb.com/forrst/posts/Adding_an_is_unique_method_to_CodeIgniter_Form-9Q4        
        $data['record'] = $this->drillingdbmodel->getSEPRigs($viewid);  // get a particular record according to id which is passed in the 4th segment of the url (from table view)
        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('seprigupdateview',$data);   
            }
            else 
            {
                //$this->load->view('formsuccess');   
                
            }                        
        break;
    case 'seprigupdate' :
        $seprigid = $this->input->post('seprigid');
        $seprigcode = $this->input->post('seprigcode');
        $seprigdescription = $this->input->post('seprigdescription');

        $this->drillingdbmodel->setSEPRig($seprigid,$seprigcode,$seprigdescription);
//        $this->drillingdbmodel->setSEPRig($this->input->post('seprigid'),$this->input->post('seprigname'));
        $data['records'] = $this->drillingdbmodel->getSEPRigs();  // get all rows of seprigs
        $this->load->view('seprigsview',$data);    // return to all records?
        break;

    case 'sepriginsertview' :
        $this->load->helper(array('form', 'url'));        
        $this-> load->library('form_validation');
        $this->form_validation->set_rules('seprigname','SEPRig Name', 'required');

        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('sepriginsertview');   
            }
            else 
            {
                //$this->load->view('formsuccess');                   
            }                        
        break;
        
    case 'sepriginsert' :
        $seprigcode = $this->input->post('seprigcode');
        $seprigdescription = $this->input->post('seprigdescription');

        $this->drillingdbmodel->insertSEPRig($seprigcode,$seprigdescription);
        $data['records'] = $this->drillingdbmodel->getSEPRigs();  // get all rows of seprigs
        $this->load->view('seprigsview',$data);    // return to all records?
        break;        
// delete confirm ?
    case 'seprigdeleteview' :
        $this->load->helper(array('form', 'url'));        
        $data['record'] = $this->drillingdbmodel->getSEPRigs($viewid);  // get selected record
                $this->load->view('seprigdeleteview',$data);   
        break;

        
    case 'seprigdelete' :
        $seprigid = $this->input->post('seprigid');
        $this->drillingdbmodel->deleteSEPRig($seprigid);
        $data['records'] = $this->drillingdbmodel->getSEPRigs();  // get all rows of seprigs
        $this->load->view('seprigsview',$data);    // return to all records?    
        break;

    // end of this database case set (SEPs / Rigs)
    
    case 'shiftsetcreport' :        // JOIN-ed report on shifts - who, what, where, when &c (i.e. shifts etc)
        $data['records'] = $this->drillingdbmodel->getShiftsReport();  // fetch shifts report data
//        $data['records'] = $this->drillingdbmodel->getShiftsMetresSummedByDrillerReport();  // fetch shifts report data
        $data['drillermetressum'] = $this->drillingdbmodel->getSumAllShiftsMetresGroupedByDriller() ;
        $data['datemetressum'] = $this->drillingdbmodel->getSumAllShiftsMetresEachDate();
        $data['metrestotal'] = $this->drillingdbmodel->getSumAllShiftsMetres() ;
        
        $this->load->view('shiftsetcreport',$data);        
    break;

    case 'shiftsetcreportbydate' :
        $data['records'] = $this->drillingdbmodel->getShiftsReportByDate($viewid,$para4);  // fetch shifts report data
//        $data['records'] = $this->drillingdbmodel->getShiftsMetresSummedByDrillerReport();  // fetch shifts report data
        $data['drillermetressum'] = $this->drillingdbmodel->getSumAllShiftsMetresGroupedByDrillerByDate($viewid,$para4);   // $viewid - 3rd URI segment, para4 - 4th URI segment
        $data['datemetressum'] = $this->drillingdbmodel->getSumAllShiftsMetresEachDateByDate($viewid,$para4);
        $data['metrestotal'] = $this->drillingdbmodel->getSumAllShiftsMetresByDate($viewid,$para4);   // $viewid - 3rd URI segment, para4 - 4th URI segment
        $data['startdate'] = $viewid;       // 3rd URI segment - should be start date
        $data['enddate'] = $para4;  // parameter 4 - 4th URI segment - should be end date
        $this->load->view('shiftsetcreport',$data);        
        
    break;

    
    default:        // in case none of the above
        
    }
    
}   // end of view function

public function drillerid_check($str)
{
    if ($str == test)
    {
        $this->form_validation->set_message('drillerid_check','The {field} field must not have a value already used by another record - it must be unique.');
                return FALSE;
        
    }
    else
    {
        return TRUE;
    }
    
}

}   // end of Tables controller class definition
?>
