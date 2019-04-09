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
        <?php echo form_open('tables/view/projectinsert/'); ?>
        
        <h5>Project Code</h5>
        <input type="text" name="projectcode" value="" size="60"/>

        <h5>Project Description</h5>
        <input type="text" name="projectdescription" value="" size="60"/>

        <div><input type="submit" value="Make new record" /></div>
        
    </form>
        
    </body>
</html>