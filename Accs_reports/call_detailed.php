<!DOCTYPE html>
<html lang="en">
<?php include 'config.php';?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ACC Report</title>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/select.css">
    <link rel="stylesheet" href="assets/fontawesome-6/css/all.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">

</head>

<body>
    <div id="container">
        <!-- sidemenu  -->
        <div class="main-sidebar main-sidebar-sticky side-menu ps ps--active-y">
            <div class="main-sidebar-body ">
                <ul class="nav menu-content collapse">
                    <li class="arrow1">
                        <a id="home" class="active" href="index.php"><i
                                class="fa-solid fa-house-chimney-window tx-16"></i><br>Call presentation</a>
                    </li>
                    <li class="arrow1">
                        <a id="custli" href="call_disposition.php"><i class="fa-solid fa-mobile  tx-16"></i><br>Call
                            disposition</a>
                    </li>
                    <li class="arrow1">
                        <a id="home" class="" href="call_detailed.php"><i
                                class="fa-solid fa-phone-square tx-16"></i><br>Call Detailed</a>
                    </li>
                    <li class="arrow1">
                        <a id="custli" href="agent_performance.php"><i class="fa-solid fa-user  tx-16"></i><br>Agent
                            performance</a>
                    </li>
                    <li class="arrow1">
                        <a id="home" class="" href="not_ready_reports.php"><i
                                class="fa-solid fa-user-times tx-16"></i><br>Agent Not Ready</a>
                    </li>
                    <li class="arrow1">
                        <a id="custli" href="agent_Statistics.php"><i
                                class="fa-solid fa-user-secret  tx-16"></i><br>Agent
                            Statistics </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- sidemenu end -->
        <!-- header  -->
        <div class="header fixed-top shadow ">
            <!-- Just an image -->
            <nav class="navbar navbar ">
                <a class="navbar-brand" href="#">
                    <img src="assets/images/Inaipi_Logo.png" width="50%" height="auto" alt="">
                </a>
            </nav>
        </div>
        <!-- header End -->

        <!-- main content  -->

        <!-- Content Part -->


        <div class="main-content pt-4">
            <div class="px-3 py-4">
                <div class="row ">
                    <div class="col-sm-12 home-card">
                        <div class="card mb-4 shadow mt-3 mb-3">
                            <div class="card-hed-admin card-header  p-3">
                                <p class="mb-0  text-uppercase font-weight-bolder">Call Detailed report</p>
                                <div class="col-md-3">

                                </div>


                            </div>
                            <div
                                class="card-body text-secondary d-flex justify-content-between align-items-center flex-column">
                                <div class="container-fluid">
                                    <div class="form-card mt-3 mb-3">
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail4">FromDate</label>
                                                    <input type="date" class="form-control" id="fromdate"
                                                        name="fromdate">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail4">ToDate</label>
                                                    <input type="date" class="form-control" id="todate" name="todate">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="inputState">Skillset</label>
                                                    <span style="float:right;color:blue;">
                                                        <input type="checkbox" id="checkbox">Select All
                                                    </span>
                                                    <select id="multiple" class="form-control" name="SkillsetName[]"
                                                        multiple>
                                                        <option value="">Select...</option>
                                                        <?php
                                                    $sql = "SELECT DISTINCT SkillsetName FROM eCSRStat";
                                                    $rs=odbc_exec($conn, $sql);
                                                    if (!$rs) {
                                                        exit("Error in SQL");
                                                    }
                                                    while (odbc_fetch_row($rs)) {
                                                        $SkillsetName=odbc_result($rs, "SkillsetName"); ?>

                                                        <option value="<?php echo $SkillsetName ?>">
                                                            <?php echo $SkillsetName ?> </option>
                                                        <?php
                                                    } ?>
                                                    </select>

                                                </div>

                                                <div class="form-group col-md-3 mt-4 pt-2">
                                                    <button type="submit" class="btn btn-primary w-100"
                                                        name="SubmitButton">Submit</button>
                                                </div>
                                            </div>


                                        </form>
                                    </div>
                                    <div class="card-main-dash d-flex align-items-center table-responsive mt-2">

                                        <table class="table table-bordered" id="example">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Originator</th>
                                                    <th scope="col">Originator time</th>
                                                    <th scope="col">Skillset</th>
                                                    <th scope="col">Application</th>
                                                    <th scope="col">Ring Time</th>
                                                    <th scope="col">Hold time</th>
                                                    <th scope="col">Consult time</th>
                                                    <th scope="col">Application delay</th>
                                                    <th scope="col">Skillset delay</th>
                                                    <th scope="col">Call Duration</th>
                                                    <th scope="col">Agent name</th>
                                                    <th scope="col">ACW time</th>
                                                    <th scope="col">Disconnected source</th>
                                                    <th scope="col">Start time</th>
                                                    <th scope="col">End time</th>
                                                    <th scope="col">Disposition</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                          if (isset($_POST['SubmitButton'])) {
                                              if (isset($_POST['SkillsetName'])) {
                                                  $Skillset_names = $_POST['SkillsetName'];
                                                  $Skillset_name = "('" . implode("','", $Skillset_names);
                                                  $fromdate = $_POST['fromdate'];
                                                  $todate = $_POST['todate'];
                                                  //$sql = "SELECT * FROM eCSRStat";
                                                  $sql = "SELECT * FROM eCSRStat WHERE ApplicationStartStamp BETWEEN '".$fromdate." 00:00:01' AND '".$todate." 23:59:59' AND SkillsetName IN ".$Skillset_name."')";
                                                  $result=odbc_exec($conn, $sql);
                                                  while (odbc_fetch_row($result)) {
                                                      print "<tr>\n";
                                                      print "  <td>" . odbc_result($result, "Originator") . "\n";
                                                      print "  <td>" . odbc_result($result, "OriginatedStamp") . "\n";
                                                      print "  <td>" . odbc_result($result, "SkillsetName") . "\n";
                                                      print "  <td>" . odbc_result($result, "ApplicationName") . "\n";
                                                      $WaitTimes=odbc_result($result, "WaitTime");
                                                      $HoldTimes=odbc_result($result, "HoldTime");
  
                                                      $HoldTime= gmdate("H:i:s", $HoldTimes);
                                                      $WaitTimes= gmdate("H:i:s", $WaitTimes);
                                                      print "  <td>" .$WaitTimes. "\n";
                                                      print "  <td>" .$HoldTime. "\n";
                                                      print "  <td>" . odbc_result($result, "ConsultTime") . "\n";
                                                      print "  <td>" . odbc_result($result, "AppAbandonDelay") . "\n";
                                                      print "  <td>" . odbc_result($result, "SksAbandonDelay") . "\n";
                                                   
  
                                                      $ContactOriginatedStamp=odbc_result($result, "ContactOriginatedStamp");
                                                      $FinalDispositionStamp =odbc_result($result, "FinalDispositionStamp");
                                                      $PCPTimes=odbc_result($result, "PCPTime");
                                                      $PCPTime= gmdate("H:i:s", $PCPTimes);
                                                   
                                                      $date_a = new DateTime($ContactOriginatedStamp);
                                                      $date_b = new DateTime($FinalDispositionStamp);
                                                      $interval = date_diff($date_a, $date_b);
                                                      $CallDuration1='';
                                                      $CallDuration=$interval->format('%dDays');
                                                      $CallDurations=$interval->format('%h:%i:%s');
                                                      if ($CallDuration>0) {
                                                          $CallDuration1=$CallDuration;
                                                      }
                                                      print "  <td>" .$CallDuration1.'<br>'.$CallDurations. "\n";
                                                      print "  <td>" . odbc_result($result, "AgentGivenName") . "\n";
                                                      print "  <td>" .$PCPTime. "\n";
                                                      print "  <td>" . odbc_result($result, "DisconnectSource") . "\n";
                                                      print "  <td>" . odbc_result($result, "ContactOriginatedStamp") . "\n";
                                                      print "  <td>" . odbc_result($result, "FinalDispositionStamp") . "\n";
                                                      print "  <td>" . odbc_result($result, "FinalDisposition") . "\n";
                                                      print "</tr>\n";
                                                  }
                                                  odbc_close($conn);
                                              } else {
                                                  echo '<script type ="text/JavaScript">';
                                                  echo 'alert("Please select Skillset Name")';
                                   
                                                  echo '</script>';
                                                  echo '<script>parent.window.location.reload(fales);</script>';
                                              } ?>
                                                <?php
                                          }
                                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">

                        <div class="text-center">
                            <p class="mb-0">Copyright ©2022 All rights reserved by <a href="#"
                                    target="_blank">Inaipi</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- Main content end-->
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="lib/jquery/jquery-3.6.0.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/jquery/select.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js">
</script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>


<script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        scrollY: '500',
        scrollCollapse: true,
        scrollX: true,
        buttons: [{
            extend: 'excel',
            text: '<i class="fa fa-file-excel-o"></i> &nbsp;Export ',
            className: 'btn btn-secondary',
            footer: true

        }, {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'LEGAL',
            footer: true,
            customize: function(doc) {
                doc.content[1].table.widths = ['20%', '20%', '20%', '20%', '20%'];
            }
        }]
    });
});

$("#multiple").select2({
    placeholder: "Select Skillset..",
    allowClear: true
});

$(document).ready(function() {
    $("#checkbox").click(function() {
        if ($("#checkbox").is(':checked')) { //select all
            $("#multiple").find('option').prop("selected", true);
            $("#multiple").trigger('change');
        } else { //deselect all
            $("#multiple").find('option').prop("selected", false);
            $("#multiple").trigger('change');
        }
    });
});

$(function() {

    var url = window.location.pathname,
        urlRegExp = new RegExp(url.replace(/\/$/, '') +
            "$"
        ); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
    // now grab every link from the navigation
    $('.menu-content a').each(function() {
        // and test its normalized href against the url pathname regexp
        if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
            $(this).addClass('active');
            $(this).parent().previoussibling().find('a').removeClass('active');
        }
    });

});
</script>

</html>