<h2>Drillers</h2>
    

<table border ="1">
    <tr><td>Driller ID</td><td>Driller Name</td></tr>
    <?php

// show all drillers' records in table
// $records should be passed as argument in controller (in view($viewtype) function of Tables.php)
    
foreach ($records as $record):
    echo '<tr>';
    echo '<td>' . $record['DrillerID'] . '</td>';
    echo '<td>' . $record['DrillerName'] . '</td>';
    echo '<td><a href="' . site_url('tables/view/drillerupdateview') . '/' . $record['DrillerID'] . '/' . '">Edit record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    echo '<td><a href="' . site_url('tables/view/drillerdeleteview') . '/' . $record['DrillerID'] . '/' . '">Delete record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    //echo '<td><a href="' . site_url('tables/view/drillerdelete') . '/' . $record['DrillerID'] . '/' . '">Delete record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    //echo 'td' . $record[''] . '/td';
    
    echo '</tr>';
endforeach;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</table>
<?php echo '<p><a href="' . site_url('tables/view/drillerinsertview/') . '">Add new record</a></p>'; ?>
<A href="../ ">Table view</A>