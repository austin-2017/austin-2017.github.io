<?php
//SA 3 Jan 17  IMPORTANT ensure aria-labelledby is associated with ids otherwise assistive technology cannot associate the information

      $unitForms = '';

      $retrieveUnitForms = mysql_query(sprintf("

      SELECT DISTINCT
        id,
        id_unit,
        title,
        url,
        description,
        file_extension,
        form_number
      FROM
        ossp_forms
      WHERE
        id_unit = %d      
        
      ", $unitID));

          echo "<ul>";        
          while ($getFormsResults = mysql_fetch_array($retrieveUnitForms)) {

          $getForms .= '<li>
          <h5><a span class="glyphicon glyphicon-remove remove-unit-form" data-unit-id="'.$unitID.'"  data-id-router="'.$routerID.'"  data-form-id="'.$getFormsResults["id"].'" data-form-title="'.$getFormsResults["title"].'" aria-hidden="true"></span></a>
          <span style="color:green;">'.$getFormsResults["title"].'</span></br>
          <span style="color:#088;">'.$getFormsResults["url"].'</span></h5></li>';
          }
          //echo $getForms;
          echo "</ul><br />";

//SA unit URLS to include reference URLS associated with a unit
      $unitReports = '';

      $retrieveUnitReports = mysql_query(sprintf("

      SELECT DISTINCT
        id,
        id_unit,
        title,
        url,
        file_extension,
        report_number,
        sacs,
        aacsb, 
        ncate,
        acejmc,
        other

      FROM
        ossp_reports
      WHERE
        id_unit = %d 


      ORDER BY
        title ASC 

      ", $unitID));

          echo "<ul>";        
          while ($getReportResults = mysql_fetch_array($retrieveUnitReports)) {


                   $showSACS = '';
                    foreach ($getReportResults as $sacs) {
                      if ($getReportResults["sacs"] == '1') {
                      $showSACS = '<span style="color:green;">Yes</span>';                 
                      } else {
                      $showSACS  = '<span style="color:red;">No</span>';
                      }
                    }

                    $showAACSB = '';
                    foreach ($getReportResults as $aacsb) {
                      if ($getReportResults["aacsb"] == '1') {
                      $showAACSB = '<span style="color:green;">Yes</span>';
                      } else {
                      $showAACSB = '<span style="color:red;">No</span>';
                      }
                    }

                    $showNCATE = '';
                    foreach ($getReportResults as $ncate) {
                      if ($getReportResults["ncate"] == '1') {
                      $showNCATE = '<span style="color:green;">Yes</span>';
                      } else {
                      $showNCATE = '<span style="color:red;">No</span>';
                      }
                    }

                    $showACEJMC = '';
                    foreach ($getReportResults as $acejmc) {
                      if ($getReportResults["acejmc"] == '1') {
                      $showACEJMC = '<span style="color:green;">Yes</s[am>';
                      } else {
                      $showACEJMC = '<span style="color:red;">No</span>';
                      }
                    }


            $getReports .= '<li><a span class="glyphicon glyphicon-remove remove-unit-report" data-unit-id="'.$unitID.'"  data-id-router="'.$routerID.'"  data-report-id="'.$getReportResults["id"].'" data-report-title="'.$getReportResults["title"].'"></span></a>
            <span style="color:green;">'.$getReportResults["title"].'</span><br />
            <span style="color:#088;">'.$getReportResults["url"].'</span><br />
            <span style="color:green;">Report tagging:</span><br />
            SACS:&nbsp;'.$showSACS.'&nbsp;        
            AACSB:&nbsp;'.$showAACSB.'&nbsp;
            NCATE:&nbsp;'.$showNCATE.'&nbsp;
            ACEJMC:&nbsp;'.$showACEJMC.'&nbsp;
            OTHER:&nbsp;'.$getReportResults["other"].'
            </li>';
          }
          echo "</ul><br />";

?>

<?php
//SA 28 November below in progress
//$fileTypeExtension = explode('.', $retrieveUnitForms['file_extension']);
//SA 28 November above in progress
?>

<div class="col-md-12"><!-- open first set in tab2 -->
  <h3 style="margin-top:-50px;padding-bottom:15px;">Set Directory Information</h3>
      <section>
        <div style="padding-top:10px;padding-bottom:10px;margin-left:15px;margin-right:15px;">
      <form id="unit-directory-information" data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>'>
       
            <h4>Department Location</h4>
            <section>
              <label for="updateLocation" class="sr-only">Update the Location:</label> 
                <textarea type="textarea" style="width:100%;height:50px;" id='update-location' data-unit-location='<?=$location?>' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="textarea" name="location"><?=$location?></textarea></br >
              <br />
            </section> 

            <section><!-- unit description -->
              <h4>Department Description</h4>
                <label for="updateDescription" class="sr-only">Desciption:</label>
                <textarea type="textarea" style="width:100%;height:50px;" id='update-description'  data-unit-description='<?=$description?>' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="textarea" name="description"><?=$description?></textarea></br >
                <br />        
            </section> <!-- unit description -->

            <section>
              <h4>Home Page Link</h4>
              <label for="updateUnitURL" class="sr-only">Directory Web Link:</label>
              <textarea type="url" style="width:100%;height:20px;" id='update-unit-url' data-unit-url='<?=$theUnitURL?>' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>'><?=$theUnitURL?></textarea><br />
            </section><!-- id add-unit-url -->

          <input id="submit-directory-information" class="btn btn-success-usfsp active" type="submit" type="text" value="Submit Directory Infomation" style="margin-top:15px;">

          </form><!-- closes id unit directory information -->
        </div>
        </section>
        </div><!-- close first set col-md-12 in tab2 Made large for better visual display and easier use-->
        
        <div class="col-md-12"><h3 style="padding-top:15px;">Add Additional Important Information About This Department</h4></div>
        
        <div class='col-md-6'><!-- open second set in tab2 --> 

            <section>
              <div style="padding-top:10px;margin-left:15px;">
              <h3>Department WebLinks</h3>
              <label for="addUnitLinks">Add Web Links:</label><br />
              <input id='add-unit-link' type='url' name='addUnitLink' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' placeholder="Link...">
              <input id='add-link-label' type='text' name='addLinkLabel' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' placeholder="Link Label..."><br />
              <input id="submit-unit-link" class="btn btn-success-usfsp active" data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="submit" value="Add Web Link"> 
              <h5 id="add-link-feedback"></h5>
              <h4>Additional Department WebLinks</h4>
              <h5 style="color:teal;">Remove a weblink by checking the x mark</h5>
              <h5><span style='color:green'><?=$getLinks?></span></h5>
              </div>
            </section><br />
 
            <section>
               <div style="padding-top:10px;padding-bottom:10px;margin-left:15px;">
              <h3>Phone Numbers</h3>
              <label for="addUnitPhone">Add Contact Phone:</label><br />             
              <h5 id="update-phone-feedback"></h5>
              <input id='add-phone' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="text" name="unitPhone" placeholder="Phone...">
              <input id='add-phone-label'data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="text" name="unitPhoneLabel" placeholder="Phone Label...">
              <br />
              <input id="unit-phone-and-label-button" class="btn btn-success-usfsp active" data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="submit" value="Add Phone">
              <h4>Current Phone Numbers</h4>
              <h5 style="color:teal;">Remove a phone number by checking the x mark</h5>
              <h5><span style='color:green'><?=$getPhones?></span></h5>
              </div>
            </section><br />

            <section>
              <div style="padding-top:10px;padding-bottom:10px;margin-left:15px;">
              <h3>FAX Numbers</h3>
              <label for="addUnitFAX">Add FAX Number:</label><br /> 
              <h5 id="update-fax-feedback"></h5>
              <input id='add-fax' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="text" name="unitFax" placeholder="FAX...">
              <input id='add-fax-label'data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="text" name="unitFaxLabel" placeholder="FAX Label...">
              <br />
              <input id="unit-fax-and-label-button" class="btn btn-success-usfsp active" data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="submit" value="Add FAX Number">
              <h4>Current FAX Numbers</h4>
              <h5 style="color:teal;">Remove a phone number by checking the x mark</h5>
              <h5><span style='color:green'><?=$getFAXs?></span></h5> 
              </div>
            </section></br>

              <section>
              <div style="padding-top:10px;padding-bottom:10px;margin-left:15px;">
              <h3>Department Emails</h3>
              <label for="addUnitEmail">Add emails:</label><br />
              <h5 id="update-email-feedback"></h5>
              <input id='add-unit-email' type='email' name='addUnitEmail' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' placeholder="Email...">
              <input id='add-email-label' type="text" name='addUnitEmailLabel' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' placeholder="Email Label..."><br />
              <input id="unit-email-button" class="btn btn-success-usfsp active" data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="submit" value="Add Email">
              <h4>Current Unit Emails</h4>
              <h5 style="color:teal;">Remove an email by checking the x mark</h5>
              <h5><span style='color:green'><?=$getEmails?></span></h5>
              </div>
            </section><!-- close list emails -->

         </div><!-- col-md-6 closes first set of additional information -->   
        <div class='col-md-6'><!-- open second set of additional information for department --> 
            
            <section>
              <div style="padding-top:10px;padding-bottom:10px;margin-left:15px;padding-right:15px;">
              <h3>Department Forms</h3>
              <label for="addUnitForm">Add Department Form:</label><br /> 
              <h5 id="update-form-feedback"></h5>
              <label for="add-form-title" class="sr-only">Form title</label>
              <input id='add-form-title' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="text" name="formTitle" placeholder="Form Title" style="width:100%;" >
              <label for="add-form-description" class="sr-only">Form description.</label>
              <input id='add-form-description'data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="text" name="formDescription" placeholder="Brief Description..." style="width:100%;">
              <label for="add-form-url" class="sr-only">Form url or web link</label>
              <input id='add-form-url'data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="text" name="formURL" placeholder="Form Web Link" style="width:100%;">
              <!-- 28 Nov SA to-do for below write something to strip file extension from URL and place it in the extension field -->
              <input id='add-form-number'data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="text" name="formNumber" placeholder="Form Number,if known" style="width:100%;">

              <input id="unit-form-button" class="btn btn-success-usfsp active" data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="submit" value="Add Form">
               <h4>Current Department Forms</h4>
              <h5 style="color:teal;">Remove a form by checking the x mark</h5>
              <?=$getForms?>
            </div>
            </section><br />

<!-- SA 2 Jan 17 adding larger break user interface is confusing consult with Casey -->

            <section>
              <div style="padding-top:10px;padding-bottom:10px;margin-left:15px;padding-right:15px;">
              <h3>Department Reports</h3>
              <label for="addUnitReport">Add Department Report:</label><br /> 
  
              <h4 id="update-report-feedback"></h4>
              <label for="add-report-title" class="sr-only">Report title</label>
              <input id='add-report-title' data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="text" name="report-title" placeholder="Report Title" style="width:100%;" >
              <label for="add-report-description" class="sr-only">Report description.</label>
              <input id='add-report-description'data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="text" name="report-description" placeholder="Brief Description..." style="width:100%;">
              <label for="add-report-url" class="sr-only">Report url or web link</label>
              <input id='add-report-url'data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID;?>' type="text" name="report-URL" placeholder="Report Web Link" style="width:100%;">
              <!-- 28 Nov SA to-do for below write something to strip file extension from URL and place it in the extension field -->
              <input id='add-report-number'data-id-router='<?=$routerID;?>' data-unit-id='<?=$unitID;?>' type="text" name="report-mumber" placeholder="Report Number,if known" style="width:100%;">
              <h5 style="color:teal;">Check the options below if you want the reports to be able to be sorted</h5>
              <label for="add-for-sacs">SACS</label>
              <input id='for-sacs' class='for-sacs' name='for-sacs'  data-id-router='<?=$routerID;?>'  data-unit-id='<?=$unitID;?>'  data-sacs='<?=$sacs;?>' type='checkbox'>
              
              <label for="add-for-ncate" style="padding-left:10px;">NCATE</label>
              <input id='for-ncate' class='for-ncate' name='for-ncate'  data-id-router='<?=$routerID;?>'  data-unit-id='<?=$unitID;?>'  data-ncate='<?=$ncate;?>' type='checkbox'>

              <label for="add-for-aacsb" style="padding-left:10px;">AACSB</label>
              <input id='for-aacsb' class='for-aacsb' name='for-aacsb'  data-id-router='<?=$routerID;?>'  data-unit-id='<?=$unitID;?>'  data-aacsb='<?=$aacsb;?>' type='checkbox'>

              <label for="add-for-acejmc" style="padding-left:10px;">ACEJMC</label>
              <input id='for-acejmc' class='for-acejmc' name='for-acejmc'  data-id-router='<?=$routerID;?>'  data-unit-id='<?=$unitID;?>'  data-acejmc='<?=$acejmc;?>' type='checkbox'><br />

              <label for="add-for-legal">Other</label>
              <input id='for-legal' class='for-legal' name='for-legal'  data-id-router='<?=$routerID;?>'  data-unit-id='<?=$unitID;?>'  data-legal='<?=$legal;?>' type='text' placeholder='e.g., Title IX etc.'><br />

              <input id="unit-report-button" class="btn btn-success-usfsp active" data-id-router='<?=$routerID?>' data-unit-id='<?=$unitID?>' type="submit" value="Add Report">
              <h4>Current Department Reports</h4>
              <h5 style="color:teal;">Remove a report by checking the x mark</h5>
              <?=$getReports?>
            </div>
            </section>

        </div><!-- closes second set col-md-6 in tab2 -->
        <!-- end do not add more divs here -->
