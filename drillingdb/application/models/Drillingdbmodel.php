<?php

// could do with securing this against injection etc

class Drillingdbmodel extends CI_Model {
    
    public function __construct() {
        parent::__construct();  // ??
        $this->load->database();
    }
    
    public function getOperators($id = FALSE)
    {
        // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $query = $this->db->get('tblOperator'); // get all rows
            return $query->result_array();          // return in array
              
        }
        // else, if id argument supplied, try to find the 1 result by id
        $query = $this->db->get_where('tblOperator',array('OperatorID' => $id));  // try to match the id
        // http://www.codeigniter.com/userguide3/tutorial/news_section.html
        return $query->row_array();     // return a single (id matching) row
        //return $query->result_array(); // not this one!!!
    }       // end of getOperators function
    
    
    public function getRigs($id = FALSE)
    {
        // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $query = $this->db->get('tblRig'); // get all rows
            return $query->result_array();          // return in array
              
        }
        // else, if id argument supplied, try to find the 1 result by id
        $query = $this->db->get_where('tblRig',array('RigID' => $id));  // try to match the id
        return $query->row_array();     // return a single (id matching) row
                
    }       // end of getRigs function
    
    public function getShifts($id = FALSE)
    {
        // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $query = $this->db->get('tblShift'); // get all rows
            return $query->result_array();          // return in array
              
        }
        // else, if id argument supplied, try to find the 1 result by id
        $query = $this->db->get_where('tblShift',array('ShiftID' => $id));  // try to match the id
        return $query->row_array();     // return a single (id matching) row
                
    }       // end of getShifts function
    
    public function getProjects($id = FALSE)
    {
        // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $query = $this->db->get('tblProject'); // get all rows
            return $query->result_array();          // return in array
              
        }
        // else, if id argument supplied, try to find the 1 result by id
        $query = $this->db->get_where('tblProject',array('ProjectID' => $id));  // try to match the id
        return $query->row_array();     // return a single (id matching) row
                
    }       // end of getProjects function
    
    public function getWorkTypes($id = FALSE)
    {
        // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            $query = $this->db->get('tblWorkType'); // get all rows
            return $query->result_array();          // return in array
              
        }
        // else, if id argument supplied, try to find the 1 result by id
        $query = $this->db->get_where('tblWorkType',array('WorkTypeID' => $id));  // try to match the id
        return $query->row_array();     // return a single (id matching) row
                
    }       // end of getWorkTypes function
    
    
    
    public function setOperator($id, $name)
    {
        $data = array(
             'OperatorID' => $id,    // field values in here - probably no need for ID to be changed
            //'OperatorName' => $this->input->post($name)
            'OperatorName' => $name
        );

        $this->db->where('OperatorID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->update('tblOperator',$data);  // UPDATE that record
    }       // end of setOperator function
    
    
    public function setRig($id, $rigCode, $rigDescription)
    {
        $data = array(
             'RigID' => $id,    // field values in here - probably no need for ID to be changed
//            'rigCode' => $this->input->post($rigCode), 
//            'RigDescription' => $this->input->post($rigDescription)
            'RigCode' => $rigCode, 
            'RigDescription' => $rigDescription
            
        );

        $this->db->where('RigID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->update('tblRig',$data);  // UPDATE that record
        
    }       // end of setRig function
    

    
    public function setShift($id, $workHours, $workTypeID, $projectID, $operatorID, $product, $date, $startDateTime, $endDateTime, $rigID)
    //public function setShift($id, $workHours, $product, $date, $startDateTime, $endDateTime)    // $workTypeID, $projectID, $operatorID, $rigID + shift?
    {

// NB 21/8/17 - might need to have separate set queries (projectshift, operatorshift, worktypeshift, rigshift)        
// NB 22/8/17 - may work ok if 1:1 relationship shift:project/operator/rig/worktype - but might need to use key of (projectshift, operatorshift, worktypeshift, rigshift) if 1: many implemented in future
        
        // set associated tables - 22/8/17 - projectshift, work typeshift, operatorshift & rigshift
        // 22/8/17 ogh! this is relying on 1:1 - changing operator etc otherwise would require relational key to be known...
        // ... which would mean easier to delete all relational tables for that shift id & create anew
        // - leave as 1:1 edits on shiftid (without deleting/recreating) for now
/*        

        // REMmed code below deletes relational tables' records for this shift then recreates them with latest values
        // if required in future

        // delete relational tables
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        $this->db->delete('tblOperatorShift');
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        $this->db->delete('tblProjectShift');
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        $this->db->delete('tblWorkTypeShift');
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        $this->db->delete('tblRigShift');       // delete relational tables' records for this shiftID

        $data = array(
               // field values in here
            'ShiftID' => $shiftID,
            'OperatorID' => $operatorID
        );
        $this->db->insert('tblOperatorShift',$data);  // INSERT a tblOperatorShift record (don't return yet)
        
        $data = array(
               // field values in here
            'ShiftID' => $shiftID,
            'WorkTypeID' => $workTypeID
        );
        $this->db->insert('tblWorkTypeShift',$data);  // INSERT a tblOperatorShift record (don't return yet)

        $data = array(
               // field values in here
            'ShiftID' => $shiftID,
            'ProjectID' => $projectID
        );
        $this->db->insert('tblProjectShift',$data);  // INSERT a tblOperatorShift record (don't return yet)
        
        $data = array(
               // field values in here
            'ShiftID' => $shiftID,
            'RigID' => $rigID    
        );
        $this->db->insert('tblRigShift',$data);  // INSERT a tblOperatorShift record (don't return yet)
                

*/        
        // field values in here - probably no need for ID to be changed
        $data = array(
             'ShiftID' => $id,    
            'ProjectID' => $projectID            
//            'ProjectID' => $this->input->post($projectid)
            );
        
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
//        $this->db->update('tblProjectShift',$data);  // UPDATE that record
        
        $data = array(
             'ShiftID' => $id,    
            'WorkTypeID' => $workTypeID            
//            'WorkTypeID' => $this->input->post($workTypeid)
            );
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        $this->db->update('tblWorkTypeShift',$data);  // UPDATE that record

        $data = array(
             'ShiftID' => $id,    
                'OperatorID' => $operatorID
//            'OperatorID' => $this->input->post($operatorid)
            );
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        $this->db->update('tblOperatorShift',$data);  // UPDATE that record
        
        $data = array(
             'ShiftID' => $id,    
            'RigID' => $rigID
//            'RigID' => $this->input->post($rigid)
            );
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record) (if still 1:1)
        $this->db->update('tblRigShift',$data);  // UPDATE that record

        $data = array(
             'ShiftID' => $id,    // field values in here - probably no need for ID to be changed
/*            'WorkHours' => $this->input->post($workHours),
            'WorkTypeID' => $this->input->post($workTypeID),
            'ProjectID' => $this->input->post($projectID),
            'OperatorID' => $this->input->post($operatorID),
            'Product' => $this->input->post($product),
            'Date' => $this->input->post($date),
            'StartDateTime' => $this->input->post($startDateTime),
            'EndDateTime' => $this->input->post($endDateTime),
            'RigID' => $this->input->post($rigID) */
            'WorkHours' => $workHours,
//            'WorkTypeID' => $workTypeID,
//            'ProjectID' => $projectID,
//            'OperatorID' => $operatorID,
//            'Product' => $product,
            'Product' => $product,            
            'Date' => $date,
            'StartDateTime' => $startDateTime,
            'EndDateTime' => $endDateTime,
//            'RigID' => $rigID
        );
        
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->update('tblShift',$data);  // UPDATE that record (and return updated)
                
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
        return $this->db->update('tblProject',$data);  // UPDATE that record

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
        return $this->db->update('tblWorkType',$data);  // UPDATE that record

    }       // end of setWorkType function
        
    
    public function insertOperator( $name)
    {
        $data = array(
                // field values in here 
//            'OperatorName' => $this->input->post($name)
              'OperatorName' => $name
        );

        return $this->db->insert('tblOperator',$data);  // INSERT a record
    }       // end of insertOperator function
    
    
    public function insertRig($rigCode, $rigDescription)
    {
        $data = array(
                // field values in here
//            'rigCode' => $this->input->post($rigCode), 
//            'RigDescription' => $this->input->post($rigDescription)
            'rigCode' => $rigCode, 
            'RigDescription' => $rigDescription
            
        );

        return $this->db->insert('tblRig',$data);  // INSERT a record
        
    }       // end of insertRig function
    
    public function insertShift($workHours, $workTypeID, $projectID, $operatorID, $product, $date, $startDateTime, $endDateTime, $rigID)
    {
        $data = array(
               // field values in here
/*            'WorkHours' => $this->input->post($workHours),
            'WorkTypeID' => $this->input->post($workTypeID),
            'ProjectID' => $this->input->post($projectID),
            'OperatorID' => $this->input->post($operatorID),
            'Product' => $this->input->post($product),
            'Date' => $this->input->post($date),
            'StartDateTime' => $this->input->post($startDateTime),
            'EndDateTime' => $this->input->post($endDateTime),
            'RigID' => $this->input->post($rigID) */
            'WorkHours' => $workHours,
//            'WorkTypeID' => $workTypeID,
//            'ProjectID' => $projectID,
//            'OperatorID' => $operatorID,
            'Product' => $product,
            'Date' => $date,
            'StartDateTime' => $startDateTime,
            'EndDateTime' => $endDateTime,
        );


        // need to find out tblShift.ShiftID resulting from shift record insert and use this in new relational tables records
        
        //return $this->db->insert('tblShift',$data);  // INSERT a record
        $this->db->insert('tblShift',$data);  // INSERT a tblShift record (don't return yet)
        
        $shiftID = mysqli_insert_id($this->db->conn_id);    // refer to connection to get the latest ID number inserted using this db connection
        // (hopefully)
        
        $data = array(
               // field values in here
            'ShiftID' => $shiftID,
            'OperatorID' => $operatorID
        );
        $this->db->insert('tblOperatorShift',$data);  // INSERT a tblOperatorShift record (don't return yet)
        
        $data = array(
               // field values in here
            'ShiftID' => $shiftID,
            'WorkTypeID' => $workTypeID
        );
        $this->db->insert('tblWorkTypeShift',$data);  // INSERT a tblOperatorShift record (don't return yet)

        $data = array(
               // field values in here
            'ShiftID' => $shiftID,
            'ProjectID' => $projectID
        );
        $this->db->insert('tblProjectShift',$data);  // INSERT a tblOperatorShift record (don't return yet)
        
        $data = array(
               // field values in here
            'ShiftID' => $shiftID,
            'RigID' => $rigID    
        );
        $this->db->insert('tblRigShift',$data);  // INSERT a tblOperatorShift record (don't return yet)
                
                
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

        return $this->db->insert('tblProject',$data);  // INSERT a record

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

        return $this->db->insert('tblWorkType',$data);  // INSERT a record

    }       // end of insertWorkType function
        
    public function deleteOperator($id)
    {

        $this->db->where('OperatorID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->delete('tblOperator');  // DELETE that record
    }       // end of deleteOperator function
    
    
    public function deleteRig($id)     // delete a record by its ID
    {

        $this->db->where('RigID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->delete('tblRig');  // UPDATE that record
        
    }       // end of deleteRig function
    
    public function deleteShift($id)     // delete a record by its ID
    {

        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        //return $this->db->delete('tblShift');  // UPDATE that record
        $shiftDelete = $this->db->delete('tblShift');  // UPDATE that record (but don't return yet)
        
        // also delete relational tables
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        $this->db->delete('tblOperatorShift');
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        $this->db->delete('tblProjectShift');
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        $this->db->delete('tblWorkTypeShift');
        $this->db->where('ShiftID',$id);          // WHERE clause on ID value (to get 1 record)
        $this->db->delete('tblRigShift');       // delete relational tables' records for this shiftID
        
        return $shiftDelete;
        
    }       // end of deleteShift function
    
    public function deleteProject( $id)     // delete a record by its ID
    {

        $this->db->where('ProjectID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->delete('tblProject');  // UPDATE that record

    }       // end of deleteProject function
    
    public function deleteWorkType($id)     // delete a record by its ID
    {

        $this->db->where('WorkTypeID',$id);          // WHERE clause on ID value (to get 1 record)
        return $this->db->delete('tblWorkType');  // UPDATE that record

    }       // end of deleteWorkType function
        
    
    public function getShiftsReport()
    {
        /* this: SELECT * from tblShift INNER JOIN tblOperator ON tblShift.OperatorID = tblOperator.OperatorID INNER JOIN tblProject 
         * ON tblProject.ProjectID = tblShift.ProjectID INNER JOIN tblRig ON tblShift.RigID = tblRig.RigID INNER JOIN tblWorkType 
         * ON tblShift.WorkTypeID = tblWorkType.WorkTypeID ORDER BY tblOperator.OperatorName */
        
        // i.e. a report of shifts worked, by who, when, on what, for how long, with which equipment
        
        $this->db->select('*');

/*
    // 22/8/17 - previous code REMmed below
        
        $this->db->from('tblShift');
        $this->db->join('tblOperator','tblShift.OperatorID = tblOperator.OperatorID');
        $this->db->join('tblProject','tblProject.ProjectID = tblShift.ProjectID');
        $this->db->join('tblRig','tblShift.RigID = tblRig.RigID');
        $this->db->join('tblWorkType','tblShift.WorkTypeID = tblWorkType.WorkTypeID');
        $this->db->order_by('tblOperator.OperatorName','asc');
        $this->db->order_by('Date','desc');
*/
// SQL relational equivalent:
/*
$q1=mysqli_query($connection,"SELECT DISTINCT tblShift.ShiftID, tblProject.ProjectDescription, tblProject.ProjectID, tblProject.ProjectDescription, tblRig.RigDescription, tblRig.RigID, tblWorkType.WorkTypeDescription, tblWorkType.WorkTypeID, tblShift.StartDateTime, tblShift.EndDateTime, tblShift.WorkHours, tblShift.Product, tblOperator.OperatorID, tblOperator.OperatorName, tblOperatorShift.OperatorShiftID, tblProjectShift.ProjectShiftID, tblRigShift.RigShiftID, tblWorkTypeShift.WorkTypeShiftID FROM tblOperator INNER JOIN (tblWorkType INNER JOIN ( tblWorkTypeShift INNER JOIN ( tblRig INNER JOIN ( tblRigShift INNER JOIN ( tblOperatorShift INNER JOIN (tblShift INNER JOIN (tblProjectShift INNER JOIN tblProject ON tblProject.ProjectID = tblProjectShift.ProjectID) ON tblShift.ShiftID = tblProjectShift.ShiftID) ON tblOperatorShift.ShiftID = tblShift.ShiftID) ON tblRigShift.ShiftID = tblOperatorShift.ShiftID) ON tblRig.RigID = tblRigShift.RigID) ON tblWorkTypeShift.ShiftID = tblOperatorShift.ShiftID) ON tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID) ON tblOperatorShift.OperatorID = tblOperator.OperatorID WHERE tblOperatorShift.ShiftID=$shiftID");
// jsonshiftquerybyshiftid.php
*/

            // try to join relational tables to tblShift via keys
/*
// not unique table/alias error - trying SQL string instead 22/8/17
            $this->db->from('tblShift');
            $this->db->join('tblOperatorShift','tblShift.ShiftID = tblOperatorShift.ShiftID');
            $this->db->from('tblOperatorShift');
            $this->db->join('tblOperator','tblOperatorShift.OperatorID = tblOperator.OperatorID');

            $this->db->from('tblShift');
            $this->db->join('tblProjectShift','tblProjectShift.ShiftID = tblShift.ShiftID');
            $this->db->from('tblProjectShift');
            $this->db->join('tblProject','tblProject.ProjectID = tblProjectShift.ProjectID');

            $this->db->from('tblShift');
            $this->db->join('tblWorkTypeShift','tblWorkTypeShift.ShiftID = tblShift.ShiftID');
            $this->db->from('tblWorkTypeShift');
            $this->db->join('tblWorkType','tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID');

            $this->db->from('tblShift');
            $this->db->join('tblRigShift','tblRigShift.ShiftID = tblShift.ShiftID');
            $this->db->from('tblRigShift');
            $this->db->join('tblRig','tblRig.RigID = tblRigShift.RigID');
*/

//            $this->db->join('tblRig','tblShift.RigID = tblRig.RigID');
//            $this->db->join('tblWorkType','tblShift.WorkTypeID = tblWorkType.WorkTypeID');


// if this doesn't work, try 4+1 x separate queries and push into an array of row_arrays (5x1)
        
        $strSQL = "tblShift.ShiftID, tblProject.ProjectDescription, tblProject.ProjectID, tblProject.ProjectDescription, tblRig.RigDescription, tblRig.RigID, tblWorkType.WorkTypeDescription, tblWorkType.WorkTypeID, tblShift.Date, tblShift.StartDateTime, tblShift.EndDateTime, tblShift.WorkHours, tblShift.Product, tblOperator.OperatorID, tblOperator.OperatorName, tblOperatorShift.OperatorShiftID, tblProjectShift.ProjectShiftID, tblRigShift.RigShiftID, tblWorkTypeShift.WorkTypeShiftID FROM tblOperator INNER JOIN (tblWorkType INNER JOIN ( tblWorkTypeShift INNER JOIN ( tblRig INNER JOIN ( tblRigShift INNER JOIN ( tblOperatorShift INNER JOIN (tblShift INNER JOIN (tblProjectShift INNER JOIN tblProject ON tblProject.ProjectID = tblProjectShift.ProjectID) ON tblShift.ShiftID = tblProjectShift.ShiftID) ON tblOperatorShift.ShiftID = tblShift.ShiftID) ON tblRigShift.ShiftID = tblOperatorShift.ShiftID) ON tblRig.RigID = tblRigShift.RigID) ON tblWorkTypeShift.ShiftID = tblOperatorShift.ShiftID) ON tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID) ON tblOperatorShift.OperatorID = tblOperator.OperatorID ORDER BY tblOperator.OperatorName ASC";
        // doesn't like ", tblShift.Date DESC" at end for some reason?? 22/8/17
                                                                        // try without DISTINCT 22/8/17
        $this->db->select($strSQL);
                    
        $query = $this->db->get();              // since query is by now defined, simply fetch the result
        return $query->result_array();          // and return array of results
    }   // end of getShiftsReport function

    
        public function getSumAllShiftsProductGroupedByOperator()
    {
        
        // i.e. returns an array, grouped by operator ID and ordered by operator name, for use in sub-report
        // array 1 x N where N is number of operators with shifts recorded in tblShifts

// SELECT SUM(Product) from tblShift JOIN tblOperator on tblShift.OperatorID = tblOperator.OperatorID GROUP BY tblShift.OperatorID ORDER BY tblOperator.OperatorName
//            $strSQL = "SUM(Product) AS SumProduct from tblShift JOIN tblOperator on tblShift.OperatorID = tblOperator.OperatorID GROUP BY tblShift.OperatorID ORDER BY tblOperator.OperatorName";    
// 22/8/17 - relational table            
            $strSQL = "SUM(Product) AS SumProduct from tblShift JOIN (tblOperatorShift JOIN tblOperator on tblOperatorShift.OperatorID = tblOperator.OperatorID) on tblShift.ShiftID = tblOperatorShift.ShiftID GROUP BY tblOperator.OperatorID ORDER BY tblOperator.OperatorName";    
// NB no date selected yet        
        
        $this->db->select($strSQL,FALSE);       // NB 2nd parameter value 'FALSE' (to avoid escaping names) d'seem necessary else SQL syntax error
        $query = $this->db->get();              // since query is by now defined, simply fetch the result
 
        return $query->result_array();          // and return array of results
    }   // end of getSumAllShiftsProductGroupedByOperator function


    public function getSumAllShiftsProduct()
    {
        // SELECT SUM(tblShift.Product) AS SumProduct FROM tblShift
        
        $strSQL = "ShiftID, SUM(tblShift.Product) AS SumProduct FROM tblShift";
        
        $this->db->select($strSQL);
        $query = $this->db->get();
        
        return $query->row_array();      // returns a 1x1 array  (have to use row_array because single row result)
        
    }       // end of getSumAllShiftsProduct function


    public function getShiftsReportByDate($startDate,$endDate)
    {
        /* this: SELECT * from tblShift INNER JOIN tblOperator ON tblShift.OperatorID = tblOperator.OperatorID INNER JOIN tblProject 
         * ON tblProject.ProjectID = tblShift.ProjectID INNER JOIN tblRig ON tblShift.RigID = tblRig.RigID INNER JOIN tblWorkType 
         * ON tblShift.WorkTypeID = tblWorkType.WorkTypeID ORDER BY tblOperator.OperatorName */
        
        //SELECT * from tblShift INNER JOIN tblOperator ON tblShift.OperatorID = tblOperator.OperatorID INNER JOIN tblProject  ON tblProject.ProjectID = tblShift.ProjectID INNER JOIN tblRig ON tblShift.RigID = tblRig.RigID INNER JOIN tblWorkType  ON tblShift.WorkTypeID = tblWorkType.WorkTypeID  WHERE tblShift.Date BETWEEN CAST('2016-02-28' AS DATE) AND CAST('2016-05-05' AS DATE) ORDER BY tblOperator.OperatorName
        
        // i.e. a report of shifts worked, by who, when, on what, for how long, with which equipment
        
        //$strSQL = "* from tblShift INNER JOIN tblOperator ON tblShift.OperatorID = tblOperator.OperatorID INNER JOIN tblProject  ON tblProject.ProjectID = tblShift.ProjectID INNER JOIN tblRig ON tblShift.RigID = tblRig.RigID INNER JOIN tblWorkType  ON tblShift.WorkTypeID = tblWorkType.WorkTypeID  WHERE tblShift.Date BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate . "' AS DATE) ORDER BY tblOperator.OperatorName";
        // 22/8/17
        $strSQL = "SELECT DISTINCT tblShift.ShiftID, tblProject.ProjectDescription, tblProject.ProjectID, tblProject.ProjectDescription, tblRig.RigDescription, tblRig.RigID, tblWorkType.WorkTypeDescription, tblWorkType.WorkTypeID, tblShift.StartDateTime, tblShift.EndDateTime, tblShift.WorkHours, tblShift.Product, tblOperator.OperatorID, tblOperator.OperatorName, tblOperatorShift.OperatorShiftID, tblProjectShift.ProjectShiftID, tblRigShift.RigShiftID, tblWorkTypeShift.WorkTypeShiftID FROM tblOperator INNER JOIN (tblWorkType INNER JOIN ( tblWorkTypeShift INNER JOIN ( tblRig INNER JOIN ( tblRigShift INNER JOIN ( tblOperatorShift INNER JOIN (tblShift INNER JOIN (tblProjectShift INNER JOIN tblProject ON tblProject.ProjectID = tblProjectShift.ProjectID) ON tblShift.ShiftID = tblProjectShift.ShiftID) ON tblOperatorShift.ShiftID = tblShift.ShiftID) ON tblRigShift.ShiftID = tblOperatorShift.ShiftID) ON tblRig.RigID = tblRigShift.RigID) ON tblWorkTypeShift.ShiftID = tblOperatorShift.ShiftID) ON tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID) ON tblOperatorShift.OperatorID = tblOperator.OperatorID WHERE tblShift.Date BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate . "' AS DATE) ORDER BY tblOperator.OperatorName";
/*
$q1=mysqli_query($connection,"SELECT DISTINCT tblShift.ShiftID, tblProject.ProjectDescription, tblProject.ProjectID, tblProject.ProjectDescription, tblRig.RigDescription, tblRig.RigID, tblWorkType.WorkTypeDescription, tblWorkType.WorkTypeID, tblShift.StartDateTime, tblShift.EndDateTime, tblShift.WorkHours, tblShift.Product, tblOperator.OperatorID, tblOperator.OperatorName, tblOperatorShift.OperatorShiftID, tblProjectShift.ProjectShiftID, tblRigShift.RigShiftID, tblWorkTypeShift.WorkTypeShiftID FROM tblOperator INNER JOIN (tblWorkType INNER JOIN ( tblWorkTypeShift INNER JOIN ( tblRig INNER JOIN ( tblRigShift INNER JOIN ( tblOperatorShift INNER JOIN (tblShift INNER JOIN (tblProjectShift INNER JOIN tblProject ON tblProject.ProjectID = tblProjectShift.ProjectID) ON tblShift.ShiftID = tblProjectShift.ShiftID) ON tblOperatorShift.ShiftID = tblShift.ShiftID) ON tblRigShift.ShiftID = tblOperatorShift.ShiftID) ON tblRig.RigID = tblRigShift.RigID) ON tblWorkTypeShift.ShiftID = tblOperatorShift.ShiftID) ON tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID) ON tblOperatorShift.OperatorID = tblOperator.OperatorID WHERE tblOperatorShift.ShiftID=$shiftID");
// jsonshiftquerybyshiftid.php
*/
        
        
        
/*                
        $this->db->select('*');
        $this->db->from('tblShift');
        $this->db->join('tblOperator','tblShift.OperatorID = tblOperator.OperatorID');
        $this->db->join('tblProject','tblProject.ProjectID = tblShift.ProjectID');
        $this->db->join('tblRig','tblShift.RigID = tblRig.RigID');
        $this->db->join('tblWorkType','tblShift.WorkTypeID = tblWorkType.WorkTypeID');
        $this->db->order_by('tblOperator.OperatorName','asc');
        $this->db->order_by('Date','desc');
  
 
 */      
                

                $this->db->select($strSQL,FALSE);
                
        $query = $this->db->get();              // since query is by now defined, simply fetch the result
        return $query->result_array();          // and return array of results
    }   // end of getShiftsReportByDate function
    
    
    
    public function getSumAllShiftsProductGroupedByOperatorByDate($startDate,$endDate)
    {
        
        // i.e. returns an array, grouped by operator ID and ordered by operator name, for use in sub-report
        // array 1 x N where N is number of operators with shifts recorded in tblShifts
        // report limited to between 2 dates

// SELECT SUM(Product) from tblShift JOIN tblOperator on tblShift.OperatorID = tblOperator.OperatorID GROUP BY tblShift.OperatorID ORDER BY tblOperator.OperatorName

                // SELECT ShiftID, SUM(tblShift.Product) AS SumProduct FROM tblShift WHERE tblShift.Date BETWEEN CAST('2016-02-01' AS DATE) AND CAST('2016-05-05' AS DATE)
//                $strSQL = "SUM(Product) AS SumProduct from tblShift JOIN tblOperator on tblShift.OperatorID = tblOperator.OperatorID WHERE tblShift.Date BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate . "' AS DATE) GROUP BY tblShift.OperatorID ORDER BY tblOperator.OperatorName";    
// 22/8/17
                $strSQL = "SUM(Product) AS SumProduct from tblShift JOIN (tblOperatorShift JOIN tblOperator on tblOperatorShift.OperatorID = tblOperator.OperatorID) on tblShift.ShiftID = tblOperatorShift.ShiftID  WHERE tblShift.Date BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate . "' AS DATE) GROUP BY tblOperator.OperatorID ORDER BY tblOperator.OperatorName";
        
        
// NB no date selected yet        
        
        $this->db->select($strSQL,FALSE);       // NB 2nd parameter value 'FALSE' (to avoid escaping names) d'seem necessary else SQL syntax error
        $query = $this->db->get();              // since query is by now defined, simply fetch the result
 
        return $query->result_array();          // and return array of results
    }   // end of getSumAllShiftsProductGroupedByOperator function


    public function getSumAllShiftsProductByDate($startDate,$endDate)
    {
        // SELECT SUM(tblShift.Product) AS SumProduct FROM tblShift
        // report limited to between 2 dates
        
        $strSQL = "ShiftID, SUM(tblShift.Product) AS SumProduct FROM tblShift WHERE tblShift.Date BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate . "' AS DATE)";

// ??  SELECT ShiftID, SUM(tblShift.Product) AS SumProduct FROM tblShift WHERE tblShift.Date >=STR_TO_DATE('2016-02-01','%d') AND tblShift.Date <=STR_TO_DATE('2016-05-05','%d')        
        
        $this->db->select($strSQL);
        $query = $this->db->get();
        
        return $query->row_array();      // returns a 1x1 array  (have to use row_array because single row result)
        
    }       // end of getSumAllShiftsProduct function
    
    
    public function getSumAllShiftsProductEachDate()
    {
        // get each day's sum of product drilled
        
        $strSQL = "ShiftID, Date, SUM(tblShift.Product) AS SumProduct FROM tblShift GROUP BY Date ORDER BY Date";
        
        $this->db->select($strSQL);
        $query = $this->db->get();
        
        //return $query->row_array();      // returns a 1x1 array  (have to use row_array because single row result)
        return $query->result_array();      // returns an array  

        
    }       // end of getSumAllShiftsProductEachDate function
    
    public function getSumAllShiftsProductEachDateByDate($startDate, $endDate)
    {
        $strSQL = "ShiftID, Date, SUM(tblShift.Product) AS SumProduct FROM tblShift  WHERE tblShift.Date BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate . "' AS DATE) GROUP BY Date ORDER BY Date";
        
        $this->db->select($strSQL);
        $query = $this->db->get();
        
        //return $query->row_array();      // returns a 1x1 array  (have to use row_array because single row result)
        return $query->result_array();      // returns an array  
        
        
    }       // end of getSumAllShiftsProductEachDateByDate function

    public function getShiftsAndRelatedTables($id = FALSE)
    {
        
                // get all records if id supplied, else only the 1 id-matching record
        if ($id == FALSE)   // if no id supplied (value stays FALSE)
        {
            //$this->db->select('*');       // REMmed after explicit SQL string used 22/8/17

/*            
        // original code up til 22/8/17 REMmed out below
            $this->db->from('tblShift');
            $this->db->join('tblOperator','tblShift.OperatorID = tblOperator.OperatorID');
            $this->db->join('tblProject','tblProject.ProjectID = tblShift.ProjectID');
            $this->db->join('tblRig','tblShift.RigID = tblRig.RigID');
            $this->db->join('tblWorkType','tblShift.WorkTypeID = tblWorkType.WorkTypeID');
*/
            // try to join relational tables to tblShift via keys
/*
            $this->db->from('tblShift');
            $this->db->join('tblOperatorShift','tblShift.ShiftID = tblOperatorShift.ShiftID');
            $this->db->from('tblOperatorShift');
            $this->db->join('tblOperator','tblOperatorShift.OperatorID = tblOperator.OperatorID');

//            $this->db->from('tblShift');
            $this->db->join('tblProjectShift','tblProjectShift.ShiftID = tblShift.ShiftID');
            $this->db->from('tblProjectShift');
            $this->db->join('tblProject','tblProject.ProjectID = tblProjectShift.ProjectID');

//            $this->db->from('tblShift');
            $this->db->join('tblWorkTypeShift','tblWorkTypeShift.ShiftID = tblShift.ShiftID');
            $this->db->from('tblWorkTypeShift');
            $this->db->join('tblWorkType','tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID');

//            $this->db->from('tblShift');
            $this->db->join('tblRigShift','tblRigShift.ShiftID = tblShift.ShiftID');
            $this->db->from('tblRigShift');
            $this->db->join('tblRig','tblRig.RigID = tblRigShift.RigID');
*/

//            $this->db->join('tblRig','tblShift.RigID = tblRig.RigID');
//            $this->db->join('tblWorkType','tblShift.WorkTypeID = tblWorkType.WorkTypeID');

            $shiftID = 

            $strSQL = "tblShift.ShiftID, tblProject.ProjectDescription, tblProject.ProjectID, tblProject.ProjectDescription, tblRig.RigDescription, tblRig.RigID, tblWorkType.WorkTypeDescription, tblWorkType.WorkTypeID, tblShift.Date, tblShift.StartDateTime, tblShift.EndDateTime, tblShift.WorkHours, tblShift.Product, tblOperator.OperatorID, tblOperator.OperatorName, tblOperatorShift.OperatorShiftID, tblProjectShift.ProjectShiftID, tblRigShift.RigShiftID, tblWorkTypeShift.WorkTypeShiftID FROM tblOperator INNER JOIN (tblWorkType INNER JOIN ( tblWorkTypeShift INNER JOIN ( tblRig INNER JOIN ( tblRigShift INNER JOIN ( tblOperatorShift INNER JOIN (tblShift INNER JOIN (tblProjectShift INNER JOIN tblProject ON tblProject.ProjectID = tblProjectShift.ProjectID) ON tblShift.ShiftID = tblProjectShift.ShiftID) ON tblOperatorShift.ShiftID = tblShift.ShiftID) ON tblRigShift.ShiftID = tblOperatorShift.ShiftID) ON tblRig.RigID = tblRigShift.RigID) ON tblWorkTypeShift.ShiftID = tblOperatorShift.ShiftID) ON tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID) ON tblOperatorShift.OperatorID = tblOperator.OperatorID ORDER BY tblOperator.OperatorName";
                                                                            // try without DISTINCT 22/8/17
            $this->db->select($strSQL);
            
            
// if this doesn't work, try 4+1 x separate queries and push into an array of row_arrays (5x1)
            
            $query = $this->db->get();              // since query is by now defined, simply fetch the result
            return $query->result_array();          // and return array of results
            
            $query = $this->db->get('tblShift'); // get all rows (no id specified)
            return $query->result_array();          // return in array
              
        }
        else        // else if a specific ID supplied - get that record (with joined fields)
        {
            $this->db->select('*');
            
            // try to join relational tables to tblShift via keys
/*

// Error Number: 1066

//Not unique table/alias: 'tblShift'

            $this->db->from('tblShift');
            $this->db->join('tblOperatorShift','tblShift.ShiftID = tblOperatorShift.ShiftID');
            $this->db->from('tblOperatorShift');
            $this->db->join('tblOperator','tblOperatorShift.OperatorID = tblOperator.OperatorID');

            $this->db->from('tblShift');
            $this->db->join('tblProjectShift','tblProjectShift.ShiftID = tblShift.ShiftID');
            $this->db->from('tblProjectShift');
            $this->db->join('tblProject','tblProject.ProjectID = tblProjectShift.ProjectID');

            $this->db->from('tblShift');
            $this->db->join('tblWorkTypeShift','tblWorkTypeShift.ShiftID = tblShift.ShiftID');
            $this->db->from('tblWorkTypeShift');
            $this->db->join('tblWorkType','tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID');

            $this->db->from('tblShift');
            $this->db->join('tblRigShift','tblRigShift.ShiftID = tblShift.ShiftID');
            $this->db->from('tblRigShift');
            $this->db->join('tblRig','tblRig.RigID = tblRigShift.RigID');
*/

//            $this->db->join('tblRig','tblShift.RigID = tblRig.RigID');
//            $this->db->join('tblWorkType','tblShift.WorkTypeID = tblWorkType.WorkTypeID');


// if this doesn't work, try 4+1 x separate queries and push into an array of row_arrays (5x1)            
/*

        // 22/8/17 - original code REMmed below
            $this->db->from('tblShift');        
            $this->db->join('tblOperator','tblShift.OperatorID = tblOperator.OperatorID');
            $this->db->join('tblProject','tblProject.ProjectID = tblShift.ProjectID');
            $this->db->join('tblRig','tblShift.RigID = tblRig.RigID');
            $this->db->join('tblWorkType','tblShift.WorkTypeID = tblWorkType.WorkTypeID');
*/            
            //$this->db->where('tblShift',array('ShiftID' => $id);

            $strSQL = "tblShift.ShiftID, tblProject.ProjectDescription, tblProject.ProjectID, tblProject.ProjectDescription, tblRig.RigDescription, tblRig.RigID, tblWorkType.WorkTypeDescription, tblWorkType.WorkTypeID, tblShift.Date, tblShift.StartDateTime, tblShift.EndDateTime, tblShift.WorkHours, tblShift.Product, tblOperator.OperatorID, tblOperator.OperatorName, tblOperatorShift.OperatorShiftID, tblProjectShift.ProjectShiftID, tblRigShift.RigShiftID, tblWorkTypeShift.WorkTypeShiftID FROM tblOperator INNER JOIN (tblWorkType INNER JOIN ( tblWorkTypeShift INNER JOIN ( tblRig INNER JOIN ( tblRigShift INNER JOIN ( tblOperatorShift INNER JOIN (tblShift INNER JOIN (tblProjectShift INNER JOIN tblProject ON tblProject.ProjectID = tblProjectShift.ProjectID) ON tblShift.ShiftID = tblProjectShift.ShiftID) ON tblOperatorShift.ShiftID = tblShift.ShiftID) ON tblRigShift.ShiftID = tblOperatorShift.ShiftID) ON tblRig.RigID = tblRigShift.RigID) ON tblWorkTypeShift.ShiftID = tblOperatorShift.ShiftID) ON tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID) ON tblOperatorShift.OperatorID = tblOperator.OperatorID WHERE tblShift.ShiftID = $id;";
                                                                            // try without DISTINCT 22/8/17
            // use specified shift id to filter
            $this->db->select($strSQL);
            
            
            //$this->db->where('ShiftID', $id);       // use id specified   // REMmed 22/8/17 as in SQL string added above
            //$query = $this->db->get_where('tblShift',array('ShiftID' => $id));  // try to match the id
            $query = $this->db->get();              // since query is by now defined, simply fetch the result
            return $query->row_array();     // return a single (id matching) row

// NB 21/8/17 - tables now related to tblShift via relational tables - tblProjectShift, tblOperatorShift, tbl WorkTypeShift, tblRigShift
            

            //$query = $this->db->get();              // since query is by now defined, simply fetch the result
        // else, if id argument supplied, try to find the 1 result by id
        //$query = $this->db->get_where('tblShift',array('ShiftID' => $id));  // try to match the id
        //return $query->row_array();     // return a single (id matching) row

        }
        // return joined tables - pick out wanted fields 
        
    }
    
    public function getOperatorIDOperatorNamePairs()
    {
        // return a set of pairs - ID value vs 'human' description (e.g. for use in dropdown select controls)
        // ID is unique-value field    
        // OperatorID/OperatorName,ProjectID/ProjectDescription,RigID/RigDescription, WorkTypeID/WorkTypeDescription

        $query = $this->db->get('tblOperator'); // get all rows
        $records = $query->result_array();          // return in array//
        
        foreach ($records as $record):
            $pair[$record['OperatorID']] = $record['OperatorName'];       //form associative array, ID/value => description/text as per https://www.codeigniter.com/userguide3/helpers/form_helper.html                        
        endforeach;

        return $pair;       // return associative array of id/description pairs
        
    }   // end of getOperatorIDOperatorNamePairs function
    
    
    public function getProjectIDProjectDescriptionPairs()
    {
        // return a set of pairs - ID value vs 'human' description
        // ID is unique-value field    
        // OperatorID/OperatorName,ProjectID/ProjectDescription,RigID/RigDescription, WorkTypeID/WorkTypeDescription

        $query = $this->db->get('tblProject'); // get all rows
        $records = $query->result_array();          // return in array//
        
        foreach ($records as $record):
            $pair[$record['ProjectID']] = $record['ProjectDescription'];       //form associative array, ID/value => description/text as per https://www.codeigniter.com/userguide3/helpers/form_helper.html                        
        endforeach;

        return $pair;       // return associative array of id/description pairs
                
    }   // end of getProjectIDProjectDescriptionPairs function

        
    public function getRigIDRigDescriptionPairs()
    {
        // return a set of pairs - ID value vs 'human' description
        // ID is unique-value field    
        // OperatorID/OperatorName,ProjectID/ProjectDescription,RigID/RigDescription, WorkTypeID/WorkTypeDescription
        // SELECT * FROM tblRig
        
        $query = $this->db->get('tblRig'); // get all rows
        $records = $query->result_array();          // return in array//
        
        foreach ($records as $record):
            $pair[$record['RigID']] = $record['RigDescription'];       //form associative array, ID/value => description/text as per https://www.codeigniter.com/userguide3/helpers/form_helper.html                        
        endforeach;

        return $pair;       // return associative array of id/description pairs
        
        
    }   // end of getRigIDRigDescriptionPairs function

        
    public function getWorkTypeIDWorkTypeDescriptionPairs()
    {
        // return a set of pairs - ID value vs 'human' description
        // ID is unique-value field    
        // OperatorID/OperatorName,ProjectID/ProjectDescription,RigID/RigDescription, WorkTypeID/WorkTypeDescription

        $query = $this->db->get('tblWorkType'); // get all rows
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
