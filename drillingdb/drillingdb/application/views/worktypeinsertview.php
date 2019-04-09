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
        <?php echo form_open('tables/view/worktypeinsert/'); ?>
        

        <h5>Work Type Code</h5>
        <input type="text" name="worktypecode" value="" size="60"/>

        <h5>Work Type Description</h5>
        <input type="text" name="worktypedescription" value="" size="60"/>

        <div><input type="submit" value="Make new record" /></div>
        
    </form>
        
    </body>
</html>