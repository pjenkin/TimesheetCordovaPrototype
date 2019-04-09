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
        <?php echo form_open('tables/view/rigdelete/' . $record['RigID'] . '/'); ?>
        
        <h5>SEP / Rig ID</h5>
        <input type="text" name="rigid" readonly value="<?php echo $record['RigID']; ?>" size="10"/>

        <h5>SEP / Rig Code</h5>
        <input type="text" name="rigcode" readonly value="<?php echo $record['RigCode']; ?>" size="60"/>

        <h5>SEP / Rig Description</h5>
        <input type="text" name="rigdescription" readonly value="<?php echo $record['RigDescription']; ?>" size="60"/>        

        
        <div><input type="submit" value="Delete this record." /></div>
        
        
    </form>
        
    </body>
    
</html>