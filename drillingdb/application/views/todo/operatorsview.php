<h2>Operators</h2>
    

<table border ="1">
    <tr><td>Operator ID</td><td>Operator Name</td></tr>
    <?php

// show all operators' records in table
// $records should be passed as argument in controller (in view($viewtype) function of Tables.php)
    
foreach ($records as $record):
    echo '<tr>';
    echo '<td>' . $record['OperatorID'] . '</td>';
    echo '<td>' . $record['OperatorName'] . '</td>';
    echo '<td><a href="' . site_url('tables/view/operatorupdateview') . '/' . $record['OperatorID'] . '/' . '">Edit record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    echo '<td><a href="' . site_url('tables/view/operatordeleteview') . '/' . $record['OperatorID'] . '/' . '">Delete record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    //echo '<td><a href="' . site_url('tables/view/operatordelete') . '/' . $record['OperatorID'] . '/' . '">Delete record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    //echo 'td' . $record[''] . '/td';
    
    echo '</tr>';
endforeach;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</table>
<?php echo '<p><a href="' . site_url('tables/view/operatorinsertview/') . '">Add new record</a></p>'; ?>
<A href="../ ">Table view</A>