<h2>Projects</h2>
    

<table border ="1">
    <tr><td>Project ID</td><td>Project Code</td><td>Project Description</td></tr>
    <?php

// show all drillers' records in table
// $records should be passed as argument in controller (in view($viewtype) function of Tables.php)
    
foreach ($records as $record):
    echo '<tr>';
    echo '<td>' . $record['ProjectID'] . '</td>';
    echo '<td>' . $record['ProjectCode'] . '</td>';
    echo '<td>' . $record['ProjectDescription'] . '</td>';
    echo '<td><a href="' . site_url('tables/view/projectupdateview') . '/' . $record['ProjectID'] . '/' . '">Edit record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    echo '<td><a href="' . site_url('tables/view/projectdeleteview') . '/' . $record['ProjectID'] . '/' . '">Delete record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    
    
    //echo 'td' . $record[''] . '/td';
    
    echo '</tr>';
endforeach;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</table>
<?php echo '<p><a href="' . site_url('tables/view/projectinsertview/') . '">Add new record</a></p>'; ?>
<A href="../ ">Table view</A>