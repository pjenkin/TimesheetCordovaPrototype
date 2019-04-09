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
        <?php echo form_open('tables/view/operatorupdate/' . $record['OperatorID'] . '/'); ?>
        
        <h5>Operator ID</h5>
        <input type="text" name="operatorid" value="<?php echo $record['OperatorID']; ?>" size="10"/>

        <h5>Operator Name</h5>
        <input type="text" name="operatorname" value="<?php echo $record['OperatorName']; ?>" size="60"/>

        <div><input type="submit" value="Make changes" /></div>
        
    </form>
        
    </body>
</html>