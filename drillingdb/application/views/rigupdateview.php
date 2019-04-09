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
        

        
        <?php /*echo form_open('form');*/ ?>
        <?php echo form_open('tables/view/rigupdate/' . $record['RigID'] . '/'); ?>
        
        <h5>SEP / Rig ID</h5>
        <input type="text" name="rigid" value="<?php echo $record['RigID']; ?>" size="10"/>

        <h5>SEP / Rig Code</h5>
        <input type="text" name="rigcode" value="<?php echo $record['RigCode']; ?>" size="60"/>

        <h5>SEP / Rig Description</h5>
        <input type="text" name="rigdescription" value="<?php echo $record['RigDescription']; ?>" size="60"/>        
        
        <div><input type="submit" value="Make changes" /></div>
        
    </form>
        
    </body>
</html>