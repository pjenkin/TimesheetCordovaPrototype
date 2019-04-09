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
        
        <!--  echo set_value('operatorname',$record['OperatorName']);  -->
        <!--  $operatorid = $record['OperatorID']; echo set_value($operatorid);   -->

        
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
<!--            <h5>Operator ID</h5>
            <input type="text" name="operatorid" value="" size="60"/>    -->
<h5>Operator Name</h5>
<?php echo form_dropdown('operatorid',$operatorpair); ?>
            <h5>Product</h5>
            <input type="text" name="product" value="" size="60"/>
            <h5>Date</h5>
            <input type="date" name="date" value="" size="60"/>
            <h5>Start Date Time</h5>
            <input type="datetime" name="startdatetime" value="" size="60"/>
            <h5>End Date Time</h5>
            <input type="datetime" name="enddatetime" value="" size="60"/>
<!--            <h5>SEP / Rig ID</h5>
            <input type="text" name="rigid" value="" size="60"/> -->
<h5>SEP / Rig</h5>
<?php echo form_dropdown('rigid',$rigpair); ?>

        <div><input type="submit" value="Make new record" /></div>
        
    </form>
        
    </body>
</html>