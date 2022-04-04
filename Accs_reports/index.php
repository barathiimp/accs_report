<!DOCTYPE html>
<?php include 'config.php';?>
<html lang="en">

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
<script>
$(document).ready(function() {
    // $(window).load(function() {
    $(".pageloader").hide();
});
</script>
<style>
.pageloader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('https://miro.medium.com/max/882/1*9EBHIOzhE1XfMYoKz1JcsQ.gif') 50% 50% no-repeat rgb(249, 249, 249);
    opacity: .8;
}
</style>
<style>
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}

.tr {
    font-size: 15px;
}
</style>


<body>
    <div class="pageloader"></div>
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
        <div class="main-content pt-4">
            <div class="px-3 py-4">
                <div class="row ">
                    <div class="col-sm-12 home-card">
                        <div class="card mb-4 shadow mt-3 mb-3">
                            <div class="card-hed-admin card-header  p-3">
                                <p class="mb-0  text-uppercase font-weight-bolder">Call presentation reports</p>
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
                                                    <span style="float:right">
                                                        <input type="checkbox" id="checkbox">Select All
                                                    </span>
                                                    <select id="multiple" class="form-control" name="Skillset[]"
                                                        multiple>
                                                        <?php
                                                    $sql = "SELECT DISTINCT Skillset FROM iskillsetstat";
                                                    $rs=odbc_exec($conn, $sql);
                                                    if (!$rs) {
                                                        exit("Error in SQL");
                                                    }
                                                    while (odbc_fetch_row($rs)) {
                                                        $Skillset=odbc_result($rs, "Skillset"); ?>

                                                        <option value="<?php echo $Skillset ?>"><?php echo $Skillset ?>
                                                        </option>
                                                        <?php
                                                    } ?>
                                                    </select>

                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="inputState">Record Type</label>
                                                    <select id="recort_tipe" class="form-control" name="recort_tipe">
                                                        <option value="day" selected>Day</option>
                                                        <option value="overall">Overall</option>

                                                    </select>

                                                </div>


                                            </div>
                                            <div class="form-group" style="width: 12%;float: right;">
                                                <button type="submit" class="btn btn-primary w-100"
                                                    name="SubmitButton">Submit</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="card-main-dash d-flex align-items-center table-responsive mt-2">

                                        <table class="table table-bordered" id="example" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col-2">Skillset</th>
                                                    <th scope="col-9">Date</th>
                                                    <th scope="col-9">Total calls</th>
                                                    <th scope="col">Calls Answered</th>
                                                    <th scope="col">Ans calls after</th>
                                                    <th scope="col">Ans calls before</th>
                                                    <th scope="col">Abandoned calls</th>
                                                    <th scope="col">Abandoned after</th>
                                                    <th scope="col">Abandoned before</th>
                                                    <th scope="col">Service level</th>
                                                    <th scope="col">Avg. Talk time</th>
                                                    <th scope="col">Average handle time</th>
                                                    <th scope="col">Average Abandoned time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            if (isset($_POST['SubmitButton'])) {
                                                if (isset($_POST['Skillset'])) {
                                                    $Skillset_names = $_POST['Skillset'];
                                                    $recort_tipe= $_POST['recort_tipe'];
                                                    $Skillset_name = "('" . implode("','", $Skillset_names) . "')";
                                                    $fromdate = $_POST['fromdate'];
                                                    $todate = $_POST['todate'];
                                                    if ($recort_tipe=='day') {
                                                        $sql = "SELECT Skillset,cast(Timestamp as date) as currentdate,sum(CallsOffered) CallsOffered,sum(CallsAnswered) CallsAnswered,sum(VirtualCallsAbandoned) Abandonedcalls,sum(CallsAnswered+VirtualCallsAbandoned) Totalcalls,
                                                    sum(CallsAnsweredAfterThreshold) CallsAnsweredAfterThreshold,sum(CallsAnsweredDelay) CallsAnsweredDelay,sum(SkillsetAbandonedAftThreshold) SkillsetAbandonedAftThreshold,sum((CallsAnswered+SkillsetAbandoned)-(CallsAnsweredAfterThreshold+SkillsetAbandonedAftThreshold)*100/(NULLIF(CallsAnswered,0)+NULLIF(SkillsetAbandoned,0))) Servicelevel,
                                                    sum(SkillsetAbandonedDelay) SkillsetAbandonedDelay,
                                                    sum(TalkTime) AVGTalkTime,
                                                    sum(TalkTime+PostCallProcessingTime/NULLIF(CallsAnswered,0)) Averagehandletime,sum(VirtualCallsAbandoned/NULLIF(SkillsetAbandoned,0)) AverageAbandonedtime FROM iskillsetstat WHERE Timestamp BETWEEN '".$fromdate." 00:00:01' AND '".$todate." 23:59:59' AND Skillset IN".$Skillset_name." GROUP BY cast(Timestamp as date),Skillset order by cast(Timestamp as date) desc
                                                    ";
                                                    } else {
                                                        $sql = "SELECT Skillset,cast(Timestamp as date) as currentdate,sum(CallsOffered) CallsOffered,sum(CallsAnswered) CallsAnswered,sum(VirtualCallsAbandoned) Abandonedcalls,sum(CallsAnswered+VirtualCallsAbandoned) Totalcalls,
                                                        sum(CallsAnsweredAfterThreshold) CallsAnsweredAfterThreshold,sum(CallsAnsweredDelay) CallsAnsweredDelay,sum(SkillsetAbandonedAftThreshold) SkillsetAbandonedAftThreshold,sum((CallsAnswered+SkillsetAbandoned)-(CallsAnsweredAfterThreshold+SkillsetAbandonedAftThreshold)*100/(NULLIF(CallsAnswered,0)+NULLIF(SkillsetAbandoned,0))) Servicelevel,
                                                        sum(SkillsetAbandonedDelay) SkillsetAbandonedDelay,
                                                        sum(TalkTime) AVGTalkTime,
                                                        sum(TalkTime+PostCallProcessingTime/NULLIF(CallsAnswered,0)) Averagehandletime,sum(VirtualCallsAbandoned/NULLIF(SkillsetAbandoned,0)) AverageAbandonedtime FROM iskillsetstat WHERE Timestamp BETWEEN '".$fromdate." 00:00:01' AND '".$todate." 23:59:59' AND Skillset IN".$Skillset_name." GROUP BY Skillset
                                                        ";
                                                    }
                                                    $rs=odbc_exec($conn, $sql);
                                                    while (odbc_fetch_row($rs)) {
                                                        $Skillset=odbc_result($rs, "Skillset");
                                                        $Timestamp=odbc_result($rs, "currentdate");
                                                        $Abandonedcalls=odbc_result($rs, "Abandonedcalls");
                                                        $Abandonedcallss= gmdate("H:i:s", $Abandonedcalls);
                                                        $CallsOffered=odbc_result($rs, "CallsOffered");
                                                        $CallsAnswered=odbc_result($rs, "CallsAnswered");
                                                        $Totalcalls=odbc_result($rs, "Totalcalls");
                                                        $CallsAnsweredAfterThreshold=odbc_result($rs, "CallsAnsweredAfterThreshold");
                                                        $CallsAnsweredAfterThresholds= gmdate("H:i:s", $CallsAnsweredAfterThreshold);
                                                        $CallsAnsweredDelay=odbc_result($rs, "CallsAnsweredDelay");
                                                        $CallsAnsweredDelays= gmdate("H:i:s", $CallsAnsweredDelay);
                                                        $Servicelevel=odbc_result($rs, "Servicelevel");
                                                        if (isset($Servicelevel)) {
                                                            $Servicelevels= gmdate("H:i:s", $Servicelevel);
                                                        } else {
                                                            $Servicelevel='0';
                                                            $Servicelevels= gmdate("H:i:s", $Servicelevel);
                                                        }
                                                        $SkillsetAbandonedAftThreshold=odbc_result($rs, "SkillsetAbandonedAftThreshold");
                                                        $SkillsetAbandonedAftThresholds= gmdate("H:i:s", $SkillsetAbandonedAftThreshold);
                                                        $SkillsetAbandonedDelay=odbc_result($rs, "SkillsetAbandonedDelay");
                                                        $SkillsetAbandonedDelays= gmdate("H:i:s", $SkillsetAbandonedDelay);
                                                        $AVGTalkTime=odbc_result($rs, "AVGTalkTime");
                                                        $AVGTalkTimes= gmdate("H:i:s", $AVGTalkTime);
                                                        $Averagehandletime=odbc_result($rs, "Averagehandletime");
                                                        
                                                        if (isset($Averagehandletime)) {
                                                            $Averagehandletimes= gmdate("H:i:s", $Averagehandletime);
                                                        } else {
                                                            $Averagehandletime='0';
                                                            $Averagehandletimes= gmdate("H:i:s", $Averagehandletime);
                                                        }
                                                        $AverageAbandonedtime=odbc_result($rs, "AverageAbandonedtime");
                                                     
                                                        if (isset($AverageAbandonedtime)) {
                                                            $AverageAbandonedtimes= gmdate("H:i:s", $AverageAbandonedtime);
                                                        } else {
                                                            $AverageAbandonedtime='0';
                                                            $AverageAbandonedtimes= gmdate("H:i:s", $AverageAbandonedtime);
                                                        }
                                                        
                                                        echo "<tr>";
                                                        echo "<td>$Skillset</td>";
                                                        echo "<td>$Timestamp</td>";
                                                        echo "<td>$Totalcalls</td>";
                                                        echo "<td>$CallsAnswered</td>";
                                                        echo "<td>$CallsAnsweredAfterThresholds</td>";
                                                        echo "<td>$CallsAnsweredDelays</td>";
                                                        echo "<td> $Abandonedcallss</td>";
                                                        echo "<td>$SkillsetAbandonedAftThresholds</td>";
                                                        echo "<td>$SkillsetAbandonedDelays</td>";
                                                        echo "<td>$Servicelevels</td>";
                                                        echo "<td>$AVGTalkTimes</td>";
                                                        echo "<td>$Averagehandletimes</td>";
                                                        echo "<td>$AverageAbandonedtimes</td>";
                                                        echo "</tr>";
                                                    }
                                                    //}
                                                    odbc_close($conn);
                                                } else {
                                                    echo '<script type ="text/JavaScript">';
                                                    echo 'alert("Please select Agent Name")';
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
</script>

</html>