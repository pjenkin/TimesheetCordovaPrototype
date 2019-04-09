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
        
        <!--  echo set_value('drillername',$record['DrillerName']);  -->
        <!--  $drillerid = $record['DrillerID']; echo set_value($drillerid);   -->

        <p>Are you sure?</p>
        
        <?php /*echo form_open('form');*/ ?>
        <?php echo form_open('tables/view/drillerdelete/' . $record['DrillerID'] . '/'); ?>
        
        <h5>Driller ID</h5>
        <input type="text" name="drillerid" readonly value="<?php echo $record['DrillerID']; ?>" size="10"/>
        <h5>Driller Name</h5>
        <input type="text" name="drillername" readonly value="<?php echo $record['DrillerName']; ?>" size="60"/>

        
        <div><input type="submit" value="Delete this record." /></div>
        
        
    </form>
        
    </body>
    
</html>