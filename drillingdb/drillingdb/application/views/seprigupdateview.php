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
        <?php echo form_open('tables/view/seprigupdate/' . $record['SEPRigID'] . '/'); ?>
        
        <h5>SEP / Rig ID</h5>
        <input type="text" name="seprigid" value="<?php echo $record['SEPRigID']; ?>" size="10"/>

        <h5>SEP / Rig Code</h5>
        <input type="text" name="seprigcode" value="<?php echo $record['SEPRigCode']; ?>" size="60"/>

        <h5>SEP / Rig Description</h5>
        <input type="text" name="seprigdescription" value="<?php echo $record['SEPRigDescription']; ?>" size="60"/>        
        
        <div><input type="submit" value="Make changes" /></div>
        
    </form>
        
    </body>
</html>