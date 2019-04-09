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
        

        <p>Are you sure?</p>
        
        <?php /*echo form_open('form');*/ ?>
        <?php echo form_open('tables/view/seprigdelete/' . $record['SEPRigID'] . '/'); ?>
        
        <h5>SEP / Rig ID</h5>
        <input type="text" name="seprigid" readonly value="<?php echo $record['SEPRigID']; ?>" size="10"/>

        <h5>SEP / Rig Code</h5>
        <input type="text" name="seprigcode" readonly value="<?php echo $record['SEPRigCode']; ?>" size="60"/>

        <h5>SEP / Rig Description</h5>
        <input type="text" name="seprigdescription" readonly value="<?php echo $record['SEPRigDescription']; ?>" size="60"/>        

        
        <div><input type="submit" value="Delete this record." /></div>
        
        
    </form>
        
    </body>
    
</html>