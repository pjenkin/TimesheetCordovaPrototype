<h2>SEPs / Rigs</h2>
    

<table border ="1">
    <tr><td>SEP / Rig ID</td><td>SEP / Rig Code</td><td>SEP / Rig Description</td></tr>
    <?php

// show all SEPs'/Rigs' records in table
// $records should be passed as argument in controller (in view($viewtype) function of Tables.php)
    
foreach ($records as $record):
    echo '<tr>';
    echo '<td>' . $record['SEPRigID'] . '</td>';
    echo '<td>' . $record['SEPRigCode'] . '</td>';
    echo '<td>' . $record['SEPRigDescription'] . '</td>';
    echo '<td><a href="' . site_url('tables/view/seprigupdateview') . '/' . $record['SEPRigID'] . '/' . '">Edit record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    echo '<td><a href="' . site_url('tables/view/seprigdeleteview') . '/' . $record['SEPRigID'] . '/' . '">Delete record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    
    
    //echo 'td' . $record[''] . '/td';
    
    echo '</tr>';
endforeach;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</table>
<?php echo '<p><a href="' . site_url('tables/view/sepriginsertview/') . '">Add new record</a></p>'; ?>
<A href="../ ">Table view</A>