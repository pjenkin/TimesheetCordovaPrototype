<h2>Work Types</h2>
    

<table border ="1">
    <tr><td>Work Type ID</td><td>Work Type Code</td><td>Work Type Description</td></tr>
    <?php

// show all drillers' records in table
// $records should be passed as argument in controller (in view($viewtype) function of Tables.php)
    
foreach ($records as $record):
    echo '<tr>';
    echo '<td>' . $record['WorkTypeID'] . '</td>';
    echo '<td>' . $record['WorkTypeCode'] . '</td>';
    echo '<td>' . $record['WorkTypeDescription'] . '</td>';
    echo '<td><a href="' . site_url('tables/view/worktypeupdateview') . '/' . $record['WorkTypeID'] . '/' . '">Edit record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    echo '<td><a href="' . site_url('tables/view/worktypedeleteview') . '/' . $record['WorkTypeID'] . '/' . '">Delete record</a></td>'; // (if clicked by user) pass id as parameter in 4th url segment 
    
    
    //echo 'td' . $record[''] . '/td';
    
    echo '</tr>';
endforeach;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</table>

    <?php echo '<p><a href="' . site_url('tables/view/worktypeinsertview/') . '">Add new record</a></p>'; ?>
<A href="../ ">Table view</A>