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
        

        
        <?php echo form_open('tables/view/shiftupdate/' . $record['ShiftID'] . '/'); ?>
        
        <h5>Shift ID</h5>
        <input type="text" name="shiftid" value="<?php echo $record['ShiftID']; ?>" size="10"/>

        <h5>Work Hours</h5>
            <input type="text" name="workhours" value="<?php echo $record['WorkHours']; ?>" size="60"/>
<!--            <h5>Work Type ID</h5>
            <input type="text" name="worktypeid" value="<php echo $record['WorkTypeID']; >" size="60"/> -->
            <h5>Work Type</h5>
<?php echo form_dropdown('worktypeid',$worktypepair,$record['WorkTypeID']); ?>            
<!--            <h5>Project ID</h5>
            <input type="text" name="projectid" value="<php echo $record['ProjectID']; >" size="60"/> -->
<h5>Project</h5>
<?php echo form_dropdown('projectid',$projectpair,$record['ProjectID']); ?>            
<!--            <h5>Operator ID</h5>
            <input type="text" name="operatorid" value="<php echo $record['OperatorID']; >" size="60"/>   -->
<h5>Operator Name</h5>
<?php echo form_dropdown('operatorid',$operatorpair,$record['OperatorID']); ?>
            <h5>Product</h5>
            <input type="text" name="product" value="<?php echo $record['Product']; ?>" size="60"/>
            <h5>Date</h5>
            <input type="date" name="date" value="<?php echo $record['Date']; ?>" size="60"/>
            <h5>Start Date Time</h5>
            <input type="datetime" name="startdatetime" value="<?php echo $record['StartDateTime']; ?>" size="60"/> NB careful at the mo with date/time format (could break things) yyyy-mm-dd hh:mm:ss.0
            <h5>End Date Time</h5>
            <input type="datetime" name="enddatetime" value="<?php echo $record['EndDateTime']; ?>" size="60"/> NB careful at the mo with date/time format (could break things) yyyy-mm-dd hh:mm:ss.0
<!--             <h5>SEP / Rig ID</h5>
            <input type="text" name="rigid" value="<php echo $record['RigID']; >" size="60"/> -->
<h5>SEP / Rig</h5>
<?php echo form_dropdown('rigid',$rigpair,$record['RigID']); ?>

        <div><input type="submit" value="Make changes" /></div>
        
    </form>
        
    </body>
</html>