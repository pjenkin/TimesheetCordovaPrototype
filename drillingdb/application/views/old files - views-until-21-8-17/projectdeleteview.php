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
        <?php echo form_open('tables/view/projectdelete/' . $record['ProjectID'] . '/'); ?>
        
        <h5>Project ID</h5>
        <input type="text" name="projectid" value="<?php echo $record['ProjectID']; ?>" size="10"/>

        <h5>Project Code</h5>
        <input type="text" name="projectcode" value="<?php echo $record['ProjectCode']; ?>" size="60"/>

        <h5>Project Description</h5>
        <input type="text" name="projectdescription" value="<?php echo $record['ProjectDescription']; ?>" size="60"/>

        
        <div><input type="submit" value="Delete this record." /></div>
        
        
    </form>
        
    </body>
    
</html>