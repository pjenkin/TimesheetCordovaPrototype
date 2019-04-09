<html>
    <head>
        <script type="text/javascript">        
        
            function setDateRange ()
            {
                //strURLSegments = document.getElementById(' . chr(39) . 'startdate' . chr(39). ').value' .  ' + ' . chr(39) . '/' . chr(39)  . ' + document.getElementById(' . chr(39) . 'enddate' . chr(39). ').value;alert(strURLSegments);document.getElementById(' . chr(39) . 'shiftsdatereportanchor' . chr(39) .').href += strURLSegments; alert(document.getElementById(' . chr(39) . 'shiftsdatereportanchor' . chr(39) .').href);  
                strURLSegments = document.getElementById('startdate').value + '/' + document.getElementById('enddate').value;
                //alert(strURLSegments);
                //document.getElementById('shiftsdatereportanchor').href += strURLSegments;
                document.getElementById('shiftsdatereportanchor').href ='tables/view/shiftsetcreportbydate/' + strURLSegments;
                //alert(document.getElementById('shiftsdatereportanchor').href);  
                /*self.location.href=strURL;*/                                
            }
        
        </script>
        
    </head>
    <body onload="setDateRange()">
<?php

/*
echo '<p><a href=' . site_url('drillersview/') . '">Drillers</a></p>';
echo '<p><a href=' . site_url('shiftsview/') . '">Shifts</a></p>';
echo '<p><a href=' . site_url('seprigsview/') . '">SEPs/Rigs</a></p>';
echo '<p><a href=' . site_url('worktypesview/') . '">Work types</a></p>';
echo '<p><a href=' . site_url('projectsview/') . '">Projects</a></p>';
*/

echo '<p><a href="' . site_url('tables/view/drillers') . '">Drillers</a></p>';
echo '<p><a href="' . site_url('tables/view/shifts/') . '">Shifts</a></p>';
echo '<p><a href="' . site_url('tables/view/seprigs/') . '">SEPs/Rigs</a></p>';
echo '<p><a href="' . site_url('tables/view/worktypes/') . '">Work types</a></p>';
echo '<p><a href="' . site_url('tables/view/projects/') . '">Projects</a></p>';
echo '<p></p>';
echo '<p><a href="' . site_url('tables/view/shiftsetcreport/') . '">Report on shifts</a></p>';
//echo '<p><a href="' . site_url('tables/view/shiftsetcreportbydate/') . '">Report on shifts - enter beginning and end dates of report</a>';
//echo '<p><a click="self.location.href=' . chr(39) . '/view/shiftsetcreportbydate/' . chr(39) . '+ document.getElementById("startdate").value + ' . chr(39) . '/' . chr(39) . ' + document.getElementById("enddate").value' . chr(39) . '">Report on shifts - enter beginning and end dates of report</a>';
//echo '<p><a id="shiftsdatereportanchor" HREF="view/shiftsetcreportbydate/">Click here</a><a onclick="strURL=' .  chr(39) . 'view/shiftsetcreportbydate/' . chr(39) . ' + document.getElementById(' . chr(39) . 'startdate' . chr(39). ').value' .  ' + ' . chr(39) . '/' . chr(39)  . ' + document.getElementById(' . chr(39) . 'enddate' . chr(39). ').value;alert(strURL);document.getElementById' . chr(39) . 'shiftsdatereportanchor' . chr(39) .').href = strURL; alert(document.getElementById(' . chr(39) . 'shiftsdatereportanchor' . chr(39) .').href);  /*self.location.href=strURL;*/">Report on shifts - enter beginning and end dates of report</a>';
//echo '<p><a id="shiftsdatereportanchor" HREF="tables/view/shiftsetcreportbydate/">Click here</a><a onclick="strURL=' .  chr(39) . '/tables/view/shiftsetcreportbydate/' . chr(39) . ' + document.getElementById(' . chr(39) . 'startdate' . chr(39). ').value' .  ' + ' . chr(39) . '/' . chr(39)  . ' + document.getElementById(' . chr(39) . 'enddate' . chr(39). ').value;alert(strURL);document.getElementById(' . chr(39) . 'shiftsdatereportanchor' . chr(39) .').href = strURL; alert(document.getElementById(' . chr(39) . 'shiftsdatereportanchor' . chr(39) .').href);  /*self.location.href=strURL;*/">Report on shifts - enter beginning and end dates of report</a>';
//echo '<p><a id="shiftsdatereportanchor" HREF="tables/view/shiftsetcreportbydate/">Click here</a><a onclick="strURLSegments = document.getElementById(' . chr(39) . 'startdate' . chr(39). ').value' .  ' + ' . chr(39) . '/' . chr(39)  . ' + document.getElementById(' . chr(39) . 'enddate' . chr(39). ').value;alert(strURLSegments);document.getElementById(' . chr(39) . 'shiftsdatereportanchor' . chr(39) .').href += strURLSegments; alert(document.getElementById(' . chr(39) . 'shiftsdatereportanchor' . chr(39) .').href);  /*self.location.href=strURL;*/">Report on shifts - enter beginning and end dates of report</a>';
echo '<p><a id="shiftsdatereportanchor" HREF="tables/view/shiftsetcreportbydate/">Click here</a><a onclick="setDateRange()">Report on shifts - enter beginning and end dates of report</a>';
echo 'Start Date <input id="startdate" type="date" value="' . date('Y-m-d') . '" onchange="setDateRange()" />End Date <input id="enddate" type="date" value="' . date('Y-m-d') . '" onchange="setDateRange()" /></p>';
// click= self.location.href=  chr(39) / document.getElementById("startdate").value  / 

// pass parameter - info type requested (drillers, shifts, &c) - in 3rd segment - so use view function of Tables controller class - file:///C:/Users/pnjenkin/Downloads/CodeIgniter-3.0.6-userguide/user_guide/general/controllers.html#passing-uri-segments-to-your-methods 

?>
    </body>
</html>