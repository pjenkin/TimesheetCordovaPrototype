
<h1>Shifts
</h1>
<table>
<?php
foreach ($records as $record): ?>
    <tr>
<?php echo $record[''] ?>

        <td><?php echo $record['shiftid'] ?></td>
        <td><?php echo $record['workhours'] ?></td>
        <td><?php echo $record['worktypeid'] ?></td>
        <td><?php echo $record['projectid'] ?></td>
        <td><?php echo $record['drillerid'] ?></td>
        <td><?php echo $record['metres'] ?></td>
        <td><?php echo $record['date'] ?></td>
        <td><?php echo $record['startdatetime'] ?></td>
        <td><?php echo $record['enddatetime'] ?></td>
        <td><?php echo $record['seprigid'] ?></td>

    <?php echo $record[''] ?>
<?php echo $record[''] ?>

</tr>        
        
<?php endforeach ?>
</table>


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

