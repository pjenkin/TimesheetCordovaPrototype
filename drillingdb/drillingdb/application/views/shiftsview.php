<h2>Shifts</h2>
    

<table border ="1">
    <tr><td>Shift ID</td><td>Work Hours</td><td>Work Type Description</td><td>Project Description</td><td>Driller Name</td><td>Metres</td><td>Date</td><td>Start Date Time</td><td>End Date Time</td><td>SEP / Rig Description</td></tr>
    <?php

// show all drillers' records in table
// $records should be passed as argument in controller (in view($viewtype) function of Tables.php)

    
    
foreach ($records as $record):
    echo '<tr>';
    
    echo '<td>' . $record['ShiftID'] . '</td>';
    echo '<td>' . $record['WorkHours'] . '</td>';
//    echo '<td>' . $record['WorkTypeID'] . '</td>';
    echo '<td>' . $record['WorkTypeDescription'] . '</td>';
    echo '<td>' . $record['ProjectDescription'] . '</td>';
    echo '<td>' . $record['DrillerName'] . '</td>';
    echo '<td>' . $record['Metres'] . '</td>';
    echo '<td>' . date('d',strtotime($record['Date'])) . '-' . date('m',strtotime($record['Date'])) . '-' . date('Y',strtotime($record['Date'])) . '</td>';    
//    echo '<td>' . getdate(strtotime($record['Date']))['mday'] . '-' . getdate(strtotime($record['Date']))['month'] . '-' . getdate(strtotime($record['Date']))['year'] . '</td>';
    // date() function here with single unit (eg 'Y')instead of array dereferencing here e.g. getdate(...)['year'] for version problems (pre- PHP 5.4) ?
/*    echo '<td>' . $record['Date'] . '</td>';  */
    echo '<td>' . $record['StartDateTime'] . '</td>';
    echo '<td>' . $record['EndDateTime'] . '</td>';
    echo '<td>' . $record['SEPRigDescription'] . '</td>';
    echo '<td><a href="' . site_url('tables/view/shiftupdateview') . '/' . $record['ShiftID'] . '/' . '">Edit record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    echo '<td><a href="' . site_url('tables/view/shiftdeleteview') . '/' . $record['ShiftID'] . '/' . '">Delete record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 

// need to make the fields // DrillerID/DrillerName,ProjectID/ProjectDescription,SEPRigID/SEPRigDescription, WorkTypeID/WorkTypeDescription fields drop-down / SELECT
// perhaps fetch each full set of pairs, then index by ID value and assign pair via form_dropdown

    
//    echo 'td' . $record[''] . '/td';
    
    
    
    echo '</tr>';
endforeach;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</table>
<?php echo '<p><a href="' . site_url('tables/view/shiftinsertview/') . '">Add new record</a></p>'; ?>
<A href="../ ">Table view</a>