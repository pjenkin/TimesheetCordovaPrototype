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
        
        <!--  echo set_value('operatorname',$record['OperatorName']);  -->
        <!--  $operatorid = $record['OperatorID']; echo set_value($operatorid);   -->

        <p>Are you sure?</p>
        
        <?php /*echo form_open('form');*/ ?>
        <?php echo form_open('tables/view/operatordelete/' . $record['OperatorID'] . '/'); ?>
        
        <h5>Operator ID</h5>
        <input type="text" name="operatorid" readonly value="<?php echo $record['OperatorID']; ?>" size="10"/>
        <h5>Operator Name</h5>
        <input type="text" name="operatorname" readonly value="<?php echo $record['OperatorName']; ?>" size="60"/>

        
        <div><input type="submit" value="Delete this record." /></div>
        
        
    </form>
        
    </body>
    
</html>