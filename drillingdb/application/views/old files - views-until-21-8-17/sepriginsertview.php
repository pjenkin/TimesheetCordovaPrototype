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
        <?php echo form_open('tables/view/sepriginsert/'); ?>
        
        <h5>SEP / Rig Code</h5> 
        <input type="text" name="seprigcode" value="" size="60"/>
        
        <h5>SEP / Rig Description</h5> 
        <input type="text" name="seprigdescription" value="" size="60"/>

        
        <div><input type="submit" value="Make new record" /></div>
        
    </form>
        
    </body>
</html>