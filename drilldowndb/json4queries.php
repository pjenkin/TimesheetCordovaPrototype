<?php
// after https://codesundar.com/lesson/phonegap-php-mysql-example/ - PHP step 5
// aiming to retrieve all operator, rig, worktype and project information associated with a particular shift 
// using 4 separate queries
// need to make sure SQL injection / proper escaping is carried out
// bind parameters http://bobby-tables.com/php

// XML instead??

//TODO - use POST (or GET??) to get shiftid
// $shiftID = 
include "drilldowndbconnect.php";

 
mysqli_set_charset($connection,"utf8");        // need UTF-8 charset for json_encode (eg Windows data entry can leave Windows-1250 charset)



 if(isset($_GET['shiftid']))        // if HTTP request is of type POST 
 {
     $shiftID=$_GET['shiftid'];

    $data=array();
     
     
    $q1=mysqli_query($connection,"SELECT tblShift.ShiftID, tblOperator.OperatorName, tblShift.Product, tblShift.WorkHours, tblShift.StartDateTime, tblShift.EndDateTime FROM tblShift INNER JOIN (tblOperatorShift INNER JOIN tblOperator ON tblOperator.OperatorID = tblOperatorShift.OperatorID) ON tblShift.ShiftID = tblOperatorShift.ShiftID WHERE tblShift.ShiftID=$shiftID");

 /* $statement = $connection->prepare("SELECT tblShift.ShiftID, tblOperator.OperatorName FROM tblShift INNER JOIN (tblOperatorShift     INNER JOIN tblOperator ON tblOperator   .OperatorID = tblOperatorShift.OperatorID) ON tblShift.ShiftID = tblOperatorShift.ShiftID WHERE tblShift.ShiftID=?")
     $statement->bind_param(i,$shiftid)    // bind integer as argument (against SQL injection)
     $statement->execute();
//      bound parameters not suitable for    SELECT statements ??  http://php.net/manual/en/mysqli-stmt.execute.php
     */
     
    $q2=mysqli_query($connection,"SELECT tbl    Shift.ShiftID, tblProject.ProjectDescription, tblProject.ProjectID FROM tblShift INNER JOIN (tblProjectShift INNER JOIN tblProject ON tblProject.ProjectID = tblProjectShift.ProjectID) ON tblShift.ShiftID = tblProjectShift.ShiftID WHERE tblShift.ShiftID=$shiftID");
     
    $q3=mysqli_query($connection,"SELECT tblShift.ShiftID, tblRig.RigDescription FROM tblShift INNER JOIN (tblRigShift INNER JOIN tblRig ON tblRig.RigID = tblRigShift.RigID) ON tblShift.ShiftID = tblRigShift.ShiftID WHERE tblShift.ShiftID=$shiftID");
     
    $q4=mysqli_query($connection,"SELECT tblShift.ShiftID, tblWorkType.WorkTypeDescription FROM tblShift INNER JOIN (tblWorkTypeShift INNER JOIN tblWorkType ON tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID) ON tblShift.ShiftID = tblWorkTypeShift.ShiftID WHERE tblShift.ShiftID=$shiftID");
     
     
     // ORDER BY ShiftId ??
     
     // https://www.w3schools.com/js/js_json_php.asp
     

     
     // Start XML file, create parent node
     //$doc = domxml_new_doc("1.0");
     $doc = new DOMDocument("1.0",'utf-8'); // domxml_new_doc deprecated since PHP4 https://stackoverflow.com/questions/19455626/php-domxml-error-with-google-map / https://stackoverflow.com/questions/4753171/fatal-error-call-to-undefined-function-domxml-new-doc
     //$node = $doc->create_element("Shifts");
     
     
     /*
     
     // try to create a DTD for the shifts XML data (in case this may be required for any processing)
     
     $implementation = new DOMImplementation();
    $dom->appendChild($implementation->createDocumentType('shifts'));   // append shifts declaration in the DTD
    $domShiftsElem = $dom->createElement('shifts');
    $domShiftElem = $dom->createElement('shift');
     
     $shiftidElem = dom->createElement('shiftid');
     $shiftidElem->appendChid( $dom->createCDATASection('') );
 
     $productElem = dom->createElement('product');
     $productElem->appendChid( $dom->createCDATASection('') );
 
     $startdatetimeElem = dom->createElement('StartDateTime');
     $startdatetimeElem->appendChid( $dom->createCDATASection('') );
 
     $enddatetimeElem = dom->createElement('EndDateTime');        // may end up as lower case anyhow
     $enddatetimeElem->appendChid( $dom->createCDATASection('') );
 
     
     $dom->appendChild()
     
       */  
         
         
     $parnode = $doc->appendChild($doc->createElement("Shifts"));

         while ($row = @mysqli_fetch_assoc($q1)){
             // Add to XML document node
      $node = $doc->createElement("Shift");
      $newnode = $parnode->appendChild($node);

      $newnode->setAttribute("ShiftID", $row['ShiftID']);
      $newnode->setAttribute("Product", $row['Product']);
      $newnode->setAttribute("StartDateTime", $row['StartDateTime']);
      $newnode->setAttribute("EndDateTime", $row['EndDateTime']);
             
             
             // not got these working yet
    $node = $doc->createElement("ShiftID");
    $shiftIDNode = $newnode->appendChild($node);
    $shiftIDNode->setAttribute("shiftid", $row['ShiftID']);
    $shiftIDNode->nodeValue = $row['ShiftID'];      // very obscure is PHP forum/Google help online sometimes

    $node = $doc->createElement("Product");
    $productNode = $newnode->appendChild($node);
    $productNode->setAttribute("product", $row['Product']);             
    $productNode->nodeValue = $row['Product'];      // ->/:: nodeValue is the solution (could prefix with item[0], item[1]... to index)

    $node = $doc->createElement("StartDateTime");
    $startDateTimeNode = $newnode->appendChild($node);
    $startDateTimeNode->nodeValue = $row['StartDateTime'];
             
    $node = $doc->createElement("EndDateTime");
    $endDateTimeNode = $newnode->appendChild($node);
    $endDateTimeNode->nodeValue = $row['EndDateTime'];
             
             
             // good old https://developers.google.com/maps/documentation/javascript/mysql-to-maps#domxml
}   // end of XML while


     
     
     
     
//$xmlfile = $doc->dump_mem();
/*

    /////////////// coda of XML output code
     $xmlfile = $doc->saveXML();
     echo $xmlfile;
*/
     

     
   /*  $q1=mysqli_query($connection,"SELECT tblShift.ShiftID, tblOperator.OperatorName, tblShift.* FROM tblShift INNER JOIN (tblOperatorShift INNER JOIN tblOperator ON tblOperator.OperatorID = tblOperatorShift.OperatorID) ON tblShift.ShiftID = tblOperatorShift.ShiftID WHERE tblShift.ShiftID=$shiftID OR tblShift.ShiftID=($shiftID+1) ");   */
     // need to restate query after use!!
     
       $q1=mysqli_query($connection,"SELECT tblShift.ShiftID, tblOperator.OperatorName, tblShift.Product, tblShift.WorkHours, tblShift.StartDateTime, tblShift.EndDateTime FROM tblShift INNER JOIN (tblOperatorShift INNER JOIN tblOperator ON tblOperator.OperatorID = tblOperatorShift.OperatorID) ON tblShift.ShiftID = tblOperatorShift.ShiftID WHERE tblShift.ShiftID=$shiftID");

          // need to restate query after use!!

     
   
     //$statement->execute();
//      bound parameters not suitable for    SELECT statements ??  http://php.net/manual/en/mysqli-stmt.execute.php
     // bind integer as argument (against SQL injection)
     
    $q2=mysqli_query($connection,"SELECT tblShift.ShiftID, tblProject.ProjectDescription, tblProject.ProjectID, tblProject.ProjectDescription FROM tblShift INNER JOIN (tblProjectShift INNER JOIN tblProject ON tblProject.ProjectID = tblProjectShift.ProjectID) ON tblShift.ShiftID = tblProjectShift.ShiftID WHERE tblShift.ShiftID=$shiftID");
     
    $q3=mysqli_query($connection,"SELECT tblShift.ShiftID, tblRig.RigDescription, tblRig.RigID FROM tblShift INNER JOIN (tblRigShift INNER JOIN tblRig ON tblRig.RigID = tblRigShift.RigID) ON tblShift.ShiftID = tblRigShift.ShiftID WHERE tblShift.ShiftID=$shiftID");
     
    $q4=mysqli_query($connection,"SELECT tblShift.ShiftID, tblWorkType.WorkTypeDescription, tblWorkType.WorkTypeID FROM tblShift INNER JOIN (tblWorkTypeShift INNER JOIN tblWorkType ON tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID) ON tblShift.ShiftID = tblWorkTypeShift.ShiftID WHERE tblShift.ShiftID=$shiftID");
     

     // can't figure out the SQL joins for a complicated shifts + projects + rig + worktype + operator query - will do programatically for now

     
    /*    //while ($row = @mysqli_fetch_assoc($q1)){            }       */
     
     $output = array();
     //$output = mysqli_fetch_all($q1,MYSQLI_ASSOC);    // mysqli_fetch_all not available with this server's PHP
////////////     $output = @mysqli_fetch_assoc($q1);     // fetch results in associative array
/*     
     $output->name="Peter";
     $output->age="43";
     $output->favefood="pasty";
*/   
     
     $rowcount=mysqli_num_rows($q1);
/*     
     while($row = mysqli_fetch_assoc($q1)){
        $rows[] = array_map('utf8_encode', $row);
     }
*/     

     // can be json_encode()'d either using while loop and adding rows to array or with single associative msqli_fetch_assoc

     //while($row = $q1->fetch_array(MYSQLI_ASSOC)) 
     while($row = mysqli_fetch_assoc($q1))      // need this if more than 1 row in result
                
      {
            $output[] = $row;       // push this shift query row to the output array
              // for every row in result ()
//             $output[count($output)-1]['Projects'] = array();       // add a projects field to this row of the shift record
                
             while($projectRow = mysqli_fetch_assoc($q2))  // for every record in the projeccount($output)-1ts query
             {  // NB - i used @ at start of @mysql_fetch_assoc to avoid warning in output stream: "Warning: mysqli_fetch_assoc() expects parameter 1 to be mysqli_result, boolean given"
                 // for every row in q2 (project)
                 $output[count($output)-1]['Projects'][] = $projectRow;  // push data of this this row of project query as an element of the projects field (sub-record in the projects field of the shift record)
                     // NB in PHP $someArray[] = $x is the same as array_push($someArray,$x)
             }      // end of project query while

             while($rigRow = mysqli_fetch_assoc($q3))  // for every record in the projeccount($output)-1ts query
             {  // NB - i used @ at start of @mysql_fetch_assoc to avoid warning in output stream: "Warning: mysqli_fetch_assoc() expects parameter 1 to be mysqli_result, boolean given"
                 // for every row in q2 (project)
                 $output[count($output)-1]['Rigs'][] = $rigRow;  // push data of this this row of project query as an element of the projects field (sub-record in the projects field of the shift record)
                     // NB in PHP $someArray[] = $x is the same as array_push($someArray,$x)
             }      // end of project query while

             while($workTypeRow = mysqli_fetch_assoc($q4))  // for every record in the projeccount($output)-1ts query
             {  // NB - i used @ at start of @mysql_fetch_assoc to avoid warning in output stream: "Warning: mysqli_fetch_assoc() expects parameter 1 to be mysqli_result, boolean given"
                 // for every row in q2 (project)
                 $output[count($output)-1]['WorkTypes'][] = $workTypeRow;  // push data of this this row of project query as an element of the projects field (sub-record in the projects field of the shift record)
                     // NB in PHP $someArray[] = $x is the same as array_push($someArray,$x)
             }      // end of project query while


      } // end of shift query while
     
     //redo q2(project), q3(rig) & q4(worktype)
     

//     echo json_encode($myArray);
     
     echo json_encode($output);
//     echo json_last_error();
//     echo $rowcount;
//     echo $output[0]["Product"];

     
     // what a huge pity, jquery on mobile falling down somewhere around $(parsedXML), might have to do this in JSON instead of lovely XML because a jquery function on my Android seems to not work :-(
     
     // Use this as a starter https://www.w3schools.com/js/js_json_php.asp

     
     
     
     // XMLWriter ??
     // <shift>
     //    <operatorid><operatorname> 0..*
     //     <projectid><projectname> 1
     //     <rigid><rigdescription> 0..*
     //     <worktype><worktypedescription> 1
     //     <shiftid><starttimedate><endtimedate><product> 1
     
     
     // exchange mysqli for PDO?
     
    // while ($row=mysqli_fetch_object($q1)){   // from phonegap example
     //$data[]=$row;
    }       // end of ISSET(GET)
     
     // multiple rows? appended rows? object?
    // echo json_encode($data);         // from phonegap example
 //}    // from phonegap example

/*

1) SELECT tblShift.ShiftID, tblOperator.OperatorName FROM tblShift INNER JOIN (tblOperatorShift INNER JOIN tblOperator ON tblOperator.OperatorID = tblOperatorShift.OperatorID) ON tblShift.ShiftID = tblOperatorShift.ShiftID
2)  SELECT tblShift.ShiftID, tblProject.ProjectDescription FROM tblShift INNER JOIN (tblProjectShift INNER JOIN tblProject ON tblProject.ProjectID = tblProjectShift.ProjectID) ON tblShift.ShiftID = tblProjectShift.ShiftID
3) SELECT tblShift.ShiftID, tblRig.RigDescription FROM tblShift INNER JOIN (tblRigShift INNER JOIN tblRig ON tblRig.RigID = tblRigShift.RigID) ON tblShift.ShiftID = tblRigShift.ShiftID
4) SELECT tblShift.ShiftID, tblWorkType.WorkTypeDescription FROM tblShift INNER JOIN (tblWorkTypeShift INNER JOIN tblWorkType ON tblWorkType.WorkTypeID = tblWorkTypeShift.WorkTypeID) ON tblShift.ShiftID = tblWorkTypeShift.ShiftID

SELECT 'tblShift'.'ShiftID', 'tblOperator'.'OperatorName' FROM 'tblShift' INNER JOIN ('tblOperatorShift' INNER JOIN 'tblOperator' ON 'tblOperator'.'OperatorID' = 'tblOperatorShift'.'OperatorID') ON 'tblShift'.'ShiftID' = 'tblOperatorShift'.'ShiftID'

SELECT 'tblShift'.'ShiftID', 'tblProject'.'ProjectDescription' FROM 'tblShift' INNER JOIN ('tblProjectShift' INNER JOIN 'tblProject' ON 'tblProject'.'ProjectID' = 'tblProjectShift'.'ProjectID') ON 'tblShift'.'ShiftID' = 'tblProjectShift'.'ShiftID'

SELECT 'tblShift'.'ShiftID', 'tblRig'.'RigDescription' FROM 'tblShift' INNER JOIN ('tblRigShift' INNER JOIN 'tblRig' ON 'tblRig'.'RigID' = 'tblRigShift'.'RigID') ON 'tblShift'.'ShiftID' = 'tblRigShift'.'ShiftID'

SELECT 'tblShift'.'ShiftID', 'tblWorkType'.'WorkTypeDescription' FROM 'tblShift' INNER JOIN ('tblWorkTypeShift' INNER JOIN 'tblWorkType' ON 'tblWorkType'.'WorkTypeID' = 'tblWorkTypeShift'.'WorkTypeID') ON 'tblShift'.'ShiftID' = 'tblWorkTypeShift'.'ShiftID'
*/


?>
