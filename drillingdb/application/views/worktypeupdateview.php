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
        <?php echo form_open('tables/view/worktypeupdate/' . $record['WorkTypeID'] . '/'); ?>
        
        <h5>Work Type ID</h5>
        <input type="text" name="worktypeid" value="<?php echo $record['WorkTypeID']; ?>" size="10"/>

        <h5>Work Type Code</h5>
        <input type="text" name="worktypecode" value="<?php echo $record['WorkTypeCode']; ?>" size="60"/>

        <h5>Work Type Description</h5>
        <input type="text" name="worktypedescription" value="<?php echo $record['WorkTypeDescription']; ?>" size="60"/>


        <div><input type="submit" value="Make changes" /></div>
        
    </form>
        
    </body>
</html>