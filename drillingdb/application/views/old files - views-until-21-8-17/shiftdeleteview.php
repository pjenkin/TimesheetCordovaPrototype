<html>
    <head></head>
    
    <body>    
<?php
//echo validation_errors();

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
        
        <!--  echo set_value('drillername',$record['DrillerName']);  -->
        <!--  $drillerid = $record['DrillerID']; echo set_value($drillerid);   -->

        <p>Are you sure?</p>
        
        <?php /*echo form_open('form');*/ ?>
        <?php echo form_open('tables/view/shiftdelete/' . $record['ShiftID'] . '/'); ?>
        
        <h5>Shift ID</h5>
        <input type="text" name="shiftid" readonly value="<?php echo $record['ShiftID']; ?>" size="10"/>
        <h5>Work Hours</h5>
            <input type="text" name="workhours" readonly value="<?php echo $record['WorkHours']; ?>" size="60"/>
            <h5>Work Type </h5>
            <input type="text" name="worktypedescription" readonly value="<?php echo $record['WorkTypeDescription']; ?>" size="60"/>  
            <input type="hidden" name="worktypeid" readonly value="<?php echo $record['WorkTypeID']; ?>" size="60"/>  
            <h5>Project </h5>
            <input type="text" name="projectdescription" readonly value="<?php echo $record['ProjectDescription']; ?>" size="60"/>
            <input type="hidden" name="projectid" readonly value="<?php echo $record['ProjectID']; ?>" size="60"/>
            <h5>Driller ID</h5>
            <input type="text" name="drillername" readonly value="<?php echo $record['DrillerName']; ?>" size="60"/>
            <input type="hidden" name="drillerid" readonly value="<?php echo $record['DrillerID']; ?>" size="60"/>
            <h5>Metres</h5>
            <input type="text" name="metres" readonly value="<?php echo $record['Metres']; ?>" size="60"/>
            <h5>Date</h5>
            <input type="date" name="date" readonly value="<?php echo $record['Date']; ?>" size="60"/>
            <h5>Start Date Time</h5>
            <input type="datetime" name="startdatetime" readonly value="<?php echo $record['StartDateTime']; ?>" size="60"/>
            <h5>End Date Time</h5>
            <input type="datetime" name="enddatetime" readonly value="<?php echo $record['EndDateTime']; ?>" size="60"/>
            <h5>SEP / Rig ID</h5>
            <input type="text" name="seprigdescription" readonly value="<?php echo $record['SEPRigDescription']; ?>" size="60"/>
            <input type="hidden" name="seprigid" readonly value="<?php echo $record['SEPRigID']; ?>" size="60"/>

        
        <div><input type="submit" value="Delete this record." /></div>
        
        
    </form>
        
    </body>
    
</html>