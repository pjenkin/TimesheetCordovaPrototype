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
        
        <!--  echo set_value('drillername',$record['DrillerName']);  -->
        <!--  $drillerid = $record['DrillerID']; echo set_value($drillerid);   -->

        
        <?php /*echo form_open('form');*/ ?>
        <?php echo form_open('tables/view/drillerupdate/' . $record['DrillerID'] . '/'); ?>
        
        <h5>Driller ID</h5>
        <input type="text" name="drillerid" value="<?php echo $record['DrillerID']; ?>" size="10"/>

        <h5>Driller Name</h5>
        <input type="text" name="drillername" value="<?php echo $record['DrillerName']; ?>" size="60"/>

        <div><input type="submit" value="Make changes" /></div>
        
    </form>
        
    </body>
</html>