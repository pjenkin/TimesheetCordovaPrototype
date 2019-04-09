<html>
    <head></head>
    
    <body>    
<?php
echo validation_errors();

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
        
        <!--  echo set_value('drillername',$record['DrillerName']);  -->
        <!--  $drillerid = $record['DrillerID']; echo set_value($drillerid);   -->

        
        <?php /*echo form_open('form');*/ ?>
        <?php echo form_open('tables/view/shiftinsert/'); ?>
        
        <h5>Work Hours</h5>
            <input type="text" name="workhours" value="" size="60"/>
<!--            <h5>Work Type ID</h5>
            <input type="text" name="worktypeid" value="" size="60"/>   -->
            <h5>Work Type</h5>
<?php echo form_dropdown('worktypeid',$worktypepair); ?>            
<!--            <h5>Project ID</h5>
            <input type="text" name="projectid" value="" size="60"/>    -->
<h5>Project</h5>
<?php echo form_dropdown('projectid',$projectpair); ?>            
<!--            <h5>Driller ID</h5>
            <input type="text" name="drillerid" value="" size="60"/>    -->
<h5>Driller Name</h5>
<?php echo form_dropdown('drillerid',$drillerpair); ?>
            <h5>Metres</h5>
            <input type="text" name="metres" value="" size="60"/>
            <h5>Date</h5>
            <input type="date" name="date" value="" size="60"/>
            <h5>Start Date Time</h5>
            <input type="datetime" name="startdatetime" value="" size="60"/>
            <h5>End Date Time</h5>
            <input type="datetime" name="enddatetime" value="" size="60"/>
<!--            <h5>SEP / Rig ID</h5>
            <input type="text" name="seprigid" value="" size="60"/> -->
<h5>SEP / Rig</h5>
<?php echo form_dropdown('seprigid',$seprigpair); ?>

        <div><input type="submit" value="Make new record" /></div>
        
    </form>
        
    </body>
</html>