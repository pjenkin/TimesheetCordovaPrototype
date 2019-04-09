<?php

class Drillingdbmodel extends CI_Model {
    
    public function __construct() {
        parent::__construct();  // ??
        $this->load->database();
    }
    
    public function getDrillers($id = FALSE)
    {
        // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $query = $this->db->get('tbldriller'); // get all rows
            return $query->result_array();          // return in array
              
        }
        // else, if id argument supplied, try to find the 1 result by id
        $query = $this->db->get_where('tbldriller',array('DrillerID' => $id));  // try to match the id
        // http://www.codeigniter.com/userguide3/tutorial/news_section.html
        return $query->row_array();     // return a single (id matching) row
        //return $query->result_array(); // not this one!!!
    }       // end of getDrillers function
    
    
    public function getSEPRigs($id = FALSE)
    {
        // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $query = $this->db->get('tblseprig'); // get all rows
            return $query->result_array();          // return in array
              
        }
        // else, if id argument supplied, try to find the 1 result by id
        $query = $this->db->get_where('tblseprig',array('SEPRigID' => $id));  // try to match the id
        return $query->row_array();     // return a single (id matching) row
                
    }       // end of getSEPRigs function
    
    public function getShifts($id = FALSE)
    {
        // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $query = $this->db->get('tblshift'); // get all rows
            return $query->result_array();          // return in array
              
        }
        // else, if id argument supplied, try to find the 1 result by id
        $query = $this->db->get_where('tblshift',array('ShiftID' => $id));  // try to match the id
        return $query->row_array();     // return a single (id matching) row
                
    }       // end of getShifts function
    
    public function getProjects($id = FALSE)
    {
        // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $query = $this->db->get('tblproject'); // get all rows
            return $query->result_array();          // return in array
              
        }
        // else, if id argument supplied, try to find the 1 result by id
        $query = $this->db->get_where('tblproject',array('ProjectID' => $id));  // try to match the id
        return $query->row_array();     // return a single (id matching) row
                
    }       // end of getProjects function
    
    public function getWorkTypes($id = FALSE)
    {
        // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $query = $this->db->get('tblworktype'); // get all rows
            return $query->result_array();          // return in array
              
        }
        // else, if id argument supplied, try to find the 1 result by id
        $query = $this->db->get_where('tblworktype',array('WorkTypeID' => $id));  // try to match the id
        return $query->row_array();     // return a single (id matching) row
                
    }       // end of getWorkTypes function
    
    
    
    public function setDriller($id, $name)
    {
        $data = array(
             'DrillerID' => $id,    // field values in here - probably no need for ID to be changed
            //'DrillerName' => $this->input->post($name)
            'DrillerName' => $name
        );

        $this->db->where('DrillerID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->update('tbldriller',$data);  // UPDATE that record
    }       // end of setDriller function
    
    
    public function setSEPRig($id, $seprigCode, $seprigDescription)
    {
        $data = array(
             'SEPRigID' => $id,    // field values in here - probably no need for ID to be changed
//            'seprigCode' => $this->input->post($seprigCode), 
//            'SEPRigDescription' => $this->input->post($seprigDescription)
            'seprigCode' => $seprigCode, 
            'SEPRigDescription' => $seprigDescription
            
        );

        $this->db->where('SEPRigID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->update('tblseprig',$data);  // UPDATE that record
        
    }       // end of setSEPRig function
    
    public function setShift($id, $workHours, $workTypeID, $projectID, $drillerID, $metres, $date, $startDateTime, $endDateTime, $seprigID)
    {
        $data = array(
             'ShiftID' => $id,    // field values in here - probably no need for ID to be changed
/*            'WorkHours' => $this->input->post($workHours),
            'WorkTypeID' => $this->input->post($workTypeID),
            'ProjectID' => $this->input->post($projectID),
            'DrillerID' => $this->input->post($drillerID),
            'Metres' => $this->input->post($metres),
            'Date' => $this->input->post($date),
            'StartDateTime' => $this->input->post($startDateTime),
            'EndDateTime' => $this->input->post($endDateTime),
            'SeprigID' => $this->input->post($seprigID) */
            'WorkHours' => $workHours,
            'WorkTypeID' => $workTypeID,
            'ProjectID' => $projectID,
            'DrillerID' => $drillerID,
            'Metres' => $metres,
            'Date' => $date,
            'StartDateTime' => $startDateTime,
            'EndDateTime' => $endDateTime,
            'SeprigID' => $seprigID
        );

        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->update('tblshift',$data);  // UPDATE that record
                
    }       // end of setShift function
    
    public function setProject($id, $projectCode, $projectDescription)
    {
        $data = array(
             'ProjectID' => $id,    // field values in here - probably no need for ID to be changed
//            'ProjectCode' => $this->input->post($name),
//            'ProjectDescription'=> $this->input->post($projectDescription)
            'ProjectCode' => $projectCode,
            'ProjectDescription'=> $projectDescription
        );

        $this->db->where('ProjectID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->update('tblproject',$data);  // UPDATE that record

    }       // end of setProject function
    
    public function setWorkType($id, $workTypeCode, $workTypeDescription)
    {
        $data = array(
             'WorkTypeID' => $id,    // field values in here - probably no need for ID to be changed
//            'WorkTypeCode' => $this->input->post($workTypeCode),
//            'WorkTypeDescription'=> $this->input->post($workTypeDescription)
            'WorkTypeCode' => $workTypeCode,
            'WorkTypeDescription'=> $workTypeDescription            
        );

        $this->db->where('WorkTypeID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->update('tblworktype',$data);  // UPDATE that record

    }       // end of setWorkType function
        
    
    public function insertDriller( $name)
    {
        $data = array(
                // field values in here 
//            'DrillerName' => $this->input->post($name)
              'DrillerName' => $name
        );

        return $this->db->insert('tbldriller',$data);  // INSERT a record
    }       // end of insertDriller function
    
    
    public function insertSEPRig($seprigCode, $seprigDescription)
    {
        $data = array(
                // field values in here
//            'seprigCode' => $this->input->post($seprigCode), 
//            'SEPRigDescription' => $this->input->post($seprigDescription)
            'seprigCode' => $seprigCode, 
            'SEPRigDescription' => $seprigDescription
            
        );

        return $this->db->insert('tblseprig',$data);  // INSERT a record
        
    }       // end of insertSEPRig function
    
    public function insertShift($workHours, $workTypeID, $projectID, $drillerID, $metres, $date, $startDateTime, $endDateTime, $seprigID)
    {
        $data = array(
               // field values in here
/*            'WorkHours' => $this->input->post($workHours),
            'WorkTypeID' => $this->input->post($workTypeID),
            'ProjectID' => $this->input->post($projectID),
            'DrillerID' => $this->input->post($drillerID),
            'Metres' => $this->input->post($metres),
            'Date' => $this->input->post($date),
            'StartDateTime' => $this->input->post($startDateTime),
            'EndDateTime' => $this->input->post($endDateTime),
            'SeprigID' => $this->input->post($seprigID) */
            'WorkHours' => $workHours,
            'WorkTypeID' => $workTypeID,
            'ProjectID' => $projectID,
            'DrillerID' => $drillerID,
            'Metres' => $metres,
            'Date' => $date,
            'StartDateTime' => $startDateTime,
            'EndDateTime' => $endDateTime,
            'SeprigID' => $seprigID            
        );

        return $this->db->insert('tblshift',$data);  // INSERT a record
                
    }       // end of insertShift function
    
    public function insertProject($projectCode, $projectDescription)
    {
        $data = array(
                 // field values in here
//            'ProjectCode' => $this->input->post($name),
//            'ProjectDescription'=> $this->input->post($projectDescription)
            'ProjectCode' => $projectCode,
            'ProjectDescription'=> $projectDescription            
        );

        return $this->db->insert('tblproject',$data);  // INSERT a record

    }       // end of insertProject function
    
    public function insertWorkType($workTypeCode, $workTypeDescription)
    {
        $data = array(
               // field values in here 
//            'WorkTypeCode' => $this->input->post($workTypeCode),
//            'WorkTypeDescription'=> $this->input->post($workTypeDescription)
            'WorkTypeCode' => $workTypeCode,
            'WorkTypeDescription'=> $workTypeDescription
        );

        return $this->db->insert('tblworktype',$data);  // INSERT a record

    }       // end of insertWorkType function
        
    public function deleteDriller( $id)
    {

        $this->db->where('DrillerID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->delete('tbldriller');  // DELETE that record
    }       // end of deleteDriller function
    
    
    public function deleteSEPRig($id)     // delete a record by its ID
    {

        $this->db->where('SEPRigID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->delete('tblseprig');  // UPDATE that record
        
    }       // end of deleteSEPRig function
    
    public function deleteShift($id)     // delete a record by its ID
    {

        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->delete('tblshift');  // UPDATE that record
                
    }       // end of deleteShift function
    
    public function deleteProject( $id)     // delete a record by its ID
    {

        $this->db->where('ProjectID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->delete('tblproject');  // UPDATE that record

    }       // end of deleteProject function
    
    public function deleteWorkType($id)     // delete a record by its ID
    {

        $this->db->where('WorkTypeID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->delete('tblworktype');  // UPDATE that record

    }       // end of deleteWorkType function
        
    
    public function getShiftsReport()
    {
        /* this: SELECT * from tblshift INNER JOIN tbldriller ON tblshift.DrillerID = tbldriller.DrillerID INNER JOIN tblproject 
         * ON tblproject.ProjectID = tblshift.ProjectID INNER JOIN tblseprig ON tblshift.SEPRigID = tblseprig.SEPRigID INNER JOIN tblworktype 
         * ON tblshift.WorkTypeID = tblworktype.WorkTypeID ORDER BY tbldriller.DrillerName */
        
        // i.e. a report of shifts worked, by who, when, on what, for how long, with which equipment
        
        $this->db->select('*');
        $this->db->from('tblshift');
        $this->db->join('tbldriller','tblshift.DrillerID = tbldriller.DrillerID');
        $this->db->join('tblproject','tblproject.ProjectID = tblshift.ProjectID');
        $this->db->join('tblseprig','tblshift.SEPRigID = tblseprig.SEPRigID');
        $this->db->join('tblworktype','tblshift.WorkTypeID = tblworktype.WorkTypeID');
        $this->db->order_by('tbldriller.DrillerName','asc');
        $this->db->order_by('Date','desc');
        
        $query = $this->db->get();              // since query is by now defined, simply fetch the result
        return $query->result_array();          // and return array of results
    }   // end of getShiftsReport function

    
        public function getSumAllShiftsMetresGroupedByDriller()
    {
        
        // i.e. returns an array, grouped by driller ID and ordered by driller name, for use in sub-report
        // array 1 x N where N is number of drillers with shifts recorded in tblshifts

// SELECT SUM(Metres) from tblshift JOIN tbldriller on tblshift.DrillerID = tbldriller.DrillerID GROUP BY tblshift.DrillerID ORDER BY tbldriller.DrillerName
            $strSQL = "SUM(Metres) AS SumMetres from tblshift JOIN tbldriller on tblshift.DrillerID = tbldriller.DrillerID GROUP BY tblshift.DrillerID ORDER BY tbldriller.DrillerName";    

// NB no date selected yet        
        
        $this->db->select($strSQL,FALSE);       // NB 2nd parameter value 'FALSE' (to avoid escaping names) d'seem necessary else SQL syntax error
        $query = $this->db->get();              // since query is by now defined, simply fetch the result
 
        return $query->result_array();          // and return array of results
    }   // end of getSumAllShiftsMetresGroupedByDriller function


    public function getSumAllShiftsMetres()
    {
        // SELECT SUM(tblshift.Metres) AS SumMetres FROM tblshift
        
        $strSQL = "ShiftID, SUM(tblshift.Metres) AS SumMetres FROM tblshift";
        
        $this->db->select($strSQL);
        $query = $this->db->get();
        
        return $query->row_array();      // returns a 1x1 array  (have to use row_array because single row result)
        
    }       // end of getSumAllShiftsMetres function


    public function getShiftsReportByDate($startDate,$endDate)
    {
        /* this: SELECT * from tblshift INNER JOIN tbldriller ON tblshift.DrillerID = tbldriller.DrillerID INNER JOIN tblproject 
         * ON tblproject.ProjectID = tblshift.ProjectID INNER JOIN tblseprig ON tblshift.SEPRigID = tblseprig.SEPRigID INNER JOIN tblworktype 
         * ON tblshift.WorkTypeID = tblworktype.WorkTypeID ORDER BY tbldriller.DrillerName */
        
        //SELECT * from tblshift INNER JOIN tbldriller ON tblshift.DrillerID = tbldriller.DrillerID INNER JOIN tblproject  ON tblproject.ProjectID = tblshift.ProjectID INNER JOIN tblseprig ON tblshift.SEPRigID = tblseprig.SEPRigID INNER JOIN tblworktype  ON tblshift.WorkTypeID = tblworktype.WorkTypeID  WHERE tblshift.Date BETWEEN CAST('2016-02-28' AS DATE) AND CAST('2016-05-05' AS DATE) ORDER BY tbldriller.DrillerName
        
        // i.e. a report of shifts worked, by who, when, on what, for how long, with which equipment
        
        $strSQL = "* from tblshift INNER JOIN tbldriller ON tblshift.DrillerID = tbldriller.DrillerID INNER JOIN tblproject  ON tblproject.ProjectID = tblshift.ProjectID INNER JOIN tblseprig ON tblshift.SEPRigID = tblseprig.SEPRigID INNER JOIN tblworktype  ON tblshift.WorkTypeID = tblworktype.WorkTypeID  WHERE tblshift.Date BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate . "' AS DATE) ORDER BY tbldriller.DrillerName";

/*                
        $this->db->select('*');
        $this->db->from('tblshift');
        $this->db->join('tbldriller','tblshift.DrillerID = tbldriller.DrillerID');
        $this->db->join('tblproject','tblproject.ProjectID = tblshift.ProjectID');
        $this->db->join('tblseprig','tblshift.SEPRigID = tblseprig.SEPRigID');
        $this->db->join('tblworktype','tblshift.WorkTypeID = tblworktype.WorkTypeID');
        $this->db->order_by('tbldriller.DrillerName','asc');
        $this->db->order_by('Date','desc');
  
 
 */      
                

                $this->db->select($strSQL,FALSE);
                
        $query = $this->db->get();              // since query is by now defined, simply fetch the result
        return $query->result_array();          // and return array of results
    }   // end of getShiftsReportByDate function
    
    
    
    public function getSumAllShiftsMetresGroupedByDrillerByDate($startDate,$endDate)
    {
        
        // i.e. returns an array, grouped by driller ID and ordered by driller name, for use in sub-report
        // array 1 x N where N is number of drillers with shifts recorded in tblshifts
        // report limited to between 2 dates

// SELECT SUM(Metres) from tblshift JOIN tbldriller on tblshift.DrillerID = tbldriller.DrillerID GROUP BY tblshift.DrillerID ORDER BY tbldriller.DrillerName

                // SELECT ShiftID, SUM(tblshift.Metres) AS SumMetres FROM tblshift WHERE tblshift.Date BETWEEN CAST('2016-02-01' AS DATE) AND CAST('2016-05-05' AS DATE)
                $strSQL = "SUM(Metres) AS SumMetres from tblshift JOIN tbldriller on tblshift.DrillerID = tbldriller.DrillerID WHERE tblshift.Date BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate . "' AS DATE) GROUP BY tblshift.DrillerID ORDER BY tbldriller.DrillerName";    

// NB no date selected yet        
        
        $this->db->select($strSQL,FALSE);       // NB 2nd parameter value 'FALSE' (to avoid escaping names) d'seem necessary else SQL syntax error
        $query = $this->db->get();              // since query is by now defined, simply fetch the result
 
        return $query->result_array();          // and return array of results
    }   // end of getSumAllShiftsMetresGroupedByDriller function


    public function getSumAllShiftsMetresByDate($startDate,$endDate)
    {
        // SELECT SUM(tblshift.Metres) AS SumMetres FROM tblshift
        // report limited to between 2 dates
        
        $strSQL = "ShiftID, SUM(tblshift.Metres) AS SumMetres FROM tblshift WHERE tblshift.Date BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate . "' AS DATE)";

// ??  SELECT ShiftID, SUM(tblshift.Metres) AS SumMetres FROM tblshift WHERE tblshift.Date >=STR_TO_DATE('2016-02-01','%d') AND tblshift.Date <=STR_TO_DATE('2016-05-05','%d')        
        
        $this->db->select($strSQL);
        $query = $this->db->get();
        
        return $query->row_array();      // returns a 1x1 array  (have to use row_array because single row result)
        
    }       // end of getSumAllShiftsMetres function
    
    
    public function getSumAllShiftsMetresEachDate()
    {
        // get each day's sum of metres drilled
        
        $strSQL = "ShiftID, Date, SUM(tblshift.Metres) AS SumMetres FROM tblshift GROUP BY Date ORDER BY Date";
        
        $this->db->select($strSQL);
        $query = $this->db->get();
        
        //return $query->row_array();      // returns a 1x1 array  (have to use row_array because single row result)
        return $query->result_array();      // returns an array  

        
    }       // end of getSumAllShiftsMetresEachDate function
    
    public function getSumAllShiftsMetresEachDateByDate($startDate, $endDate)
    {
        $strSQL = "ShiftID, Date, SUM(tblshift.Metres) AS SumMetres FROM tblshift  WHERE tblshift.Date BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate . "' AS DATE) GROUP BY Date ORDER BY Date";
        
        $this->db->select($strSQL);
        $query = $this->db->get();
        
        //return $query->row_array();      // returns a 1x1 array  (have to use row_array because single row result)
        return $query->result_array();      // returns an array  
        
        
    }       // end of getSumAllShiftsMetresEachDateByDate function

    public function getShiftsAndRelatedTables($id = FALSE)
    {
        
                // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $this->db->select('*');
            $this->db->from('tblshift');
            $this->db->join('tbldriller','tblshift.DrillerID = tbldriller.DrillerID');
            $this->db->join('tblproject','tblproject.ProjectID = tblshift.ProjectID');
            $this->db->join('tblseprig','tblshift.SEPRigID = tblseprig.SEPRigID');
            $this->db->join('tblworktype','tblshift.WorkTypeID = tblworktype.WorkTypeID');

            $query = $this->db->get();              // since query is by now defined, simply fetch the result
            return $query->result_array();          // and return array of results
            
            $query = $this->db->get('tblshift'); // get all rows
            return $query->result_array();          // return in array
              
        }
        else        // else if a specific ID supplied - get that record (with joined fields)
        {
            $this->db->select('*');
            $this->db->from('tblshift');
            $this->db->join('tbldriller','tblshift.DrillerID = tbldriller.DrillerID');
            $this->db->join('tblproject','tblproject.ProjectID = tblshift.ProjectID');
            $this->db->join('tblseprig','tblshift.SEPRigID = tblseprig.SEPRigID');
            $this->db->join('tblworktype','tblshift.WorkTypeID = tblworktype.WorkTypeID');
            //$this->db->where('tblshift',array('ShiftID' => $id);
            $this->db->where('ShiftID', $id);
            //$query = $this->db->get_where('tblshift',array('ShiftID' => $id));  // try to match the id
            $query = $this->db->get();              // since query is by now defined, simply fetch the result
            return $query->row_array();     // return a single (id matching) row
            

            //$query = $this->db->get();              // since query is by now defined, simply fetch the result
        // else, if id argument supplied, try to find the 1 result by id
        //$query = $this->db->get_where('tblshift',array('ShiftID' => $id));  // try to match the id
        //return $query->row_array();     // return a single (id matching) row

        }
        // return joined tables - pick out wanted fields 
        
    }
    
    public function getDrillerIDDrillerNamePairs()
    {
        // return a set of pairs - ID value vs 'human' description (e.g. for use in dropdown select controls)
        // ID is unique-value field    
        // DrillerID/DrillerName,ProjectID/ProjectDescription,SEPRigID/SEPRigDescription, WorkTypeID/WorkTypeDescription

        $query = $this->db->get('tbldriller'); // get all rows
        $records = $query->result_array();          // return in array//
        
        foreach ($records as $record):
            $pair[$record['DrillerID']] = $record['DrillerName'];       //form associative array, ID/value => description/text as per https://www.codeigniter.com/userguide3/helpers/form_helper.html                        
        endforeach;

        return $pair;       // return associative array of id/description pairs
        
    }   // end of getDrillerIDDrillerNamePairs function
    
    
    public function getProjectIDProjectDescriptionPairs()
    {
        // return a set of pairs - ID value vs 'human' description
        // ID is unique-value field    
        // DrillerID/DrillerName,ProjectID/ProjectDescription,SEPRigID/SEPRigDescription, WorkTypeID/WorkTypeDescription

        $query = $this->db->get('tblproject'); // get all rows
        $records = $query->result_array();          // return in array//
        
        foreach ($records as $record):
            $pair[$record['ProjectID']] = $record['ProjectDescription'];       //form associative array, ID/value => description/text as per https://www.codeigniter.com/userguide3/helpers/form_helper.html                        
        endforeach;

        return $pair;       // return associative array of id/description pairs
                
    }   // end of getProjectIDProjectDescriptionPairs function

        
    public function getSEPRigIDSEPRigDescriptionPairs()
    {
        // return a set of pairs - ID value vs 'human' description
        // ID is unique-value field    
        // DrillerID/DrillerName,ProjectID/ProjectDescription,SEPRigID/SEPRigDescription, WorkTypeID/WorkTypeDescription
        // SELECT * FROM tblseprig
        
        $query = $this->db->get('tblseprig'); // get all rows
        $records = $query->result_array();          // return in array//
        
        foreach ($records as $record):
            $pair[$record['SEPRigID']] = $record['SEPRigDescription'];       //form associative array, ID/value => description/text as per https://www.codeigniter.com/userguide3/helpers/form_helper.html                        
        endforeach;

        return $pair;       // return associative array of id/description pairs
        
        
    }   // end of getSEPRigIDSEPRigDescriptionPairs function

        
    public function getWorkTypeIDWorkTypeDescriptionPairs()
    {
        // return a set of pairs - ID value vs 'human' description
        // ID is unique-value field    
        // DrillerID/DrillerName,ProjectID/ProjectDescription,SEPRigID/SEPRigDescription, WorkTypeID/WorkTypeDescription

        $query = $this->db->get('tblworktype'); // get all rows
        $records = $query->result_array();          // return in array//
        
        foreach ($records as $record):
            $pair[$record['WorkTypeID']] = $record['WorkTypeDescription'];       //form associative array, ID/value => description/text as per https://www.codeigniter.com/userguide3/helpers/form_helper.html                        
        endforeach;

        return $pair;       // return associative array of id/description pairs
                
    }   // end of getWorkTypeIDWorkTypeDescriptionPairs function

    
            
    
}       // end of FogruDemo_model class
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
