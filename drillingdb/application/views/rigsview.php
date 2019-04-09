<h2>SEPs / Rigs</h2>
    

<table border ="1">
    <tr><td>Rig ID</td><td>Rig Code</td><td>Rig Description</td></tr>
    <?php

// show all Rigs' records in table
// $records should be passed as argument in controller (in view($viewtype) function of Tables.php)
    
foreach ($records as $record):
    echo '<tr>';
    echo '<td>' . $record['RigID'] . '</td>';
    echo '<td>' . $record['RigCode'] . '</td>';
    echo '<td>' . $record['RigDescription'] . '</td>';
    echo '<td><a href="' . site_url('tables/view/rigupdateview') . '/' . $record['RigID'] . '/' . '">Edit record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    echo '<td><a href="' . site_url('tables/view/rigdeleteview') . '/' . $record['RigID'] . '/' . '">Delete record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    
    
    //echo 'td' . $record[''] . '/td';
    
    echo '</tr>';
endforeach;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</table>
<?php echo '<p><a href="' . site_url('tables/view/riginsertview/') . '">Add new record</a></p>'; ?>
<A href="../ ">Table view</A>