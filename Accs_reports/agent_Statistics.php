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
                                <p class="mb-0  text-uppercase font-weight-bolder">Agent Perormance & Statistics</p>
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
                                                    <label for="inputState">Agent Name</label>
                                                    <span style="float:right;color:blue;">
                                                        <input type="checkbox" id="checkbox">Select All
                                                    </span>
                                                    <select id="multiple" class="form-control" name="AgentGivenName[]"
                                                        multiple>
                                                        <option value="">Select...</option>

                                                        <?php
                                                    $sql = "SELECT DISTINCT AgentGivenName FROM iAgentPerformanceStat";
                                                    $rs=odbc_exec($conn, $sql);
                                                    if (!$rs) {
                                                        exit("Error in SQL");
                                                    }
                                                    while (odbc_fetch_row($rs)) {
                                                        $AgentGivenName=odbc_result($rs, "AgentGivenName"); ?>

                                                        <option value="<?php echo $AgentGivenName ?>">
                                                            <?php echo $AgentGivenName ?> </option>
                                                        <?php
                                                    } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputState">Record Type</label>
                                                    <select id="recort_tipe" class="form-control" name="recort_tipe">
                                                        <option value="day" selected>Day</option>
                                                        <option value="overall">Overall</option>

                                                    </select>

                                                </div>
                                                <div class="form-group col-md-1 mt-4 pt-2">
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
                                                    <th scope="col">Agent name</th>
                                                    <th scope="col">Agent ID</th>
                                                    <th scope="col">Timestamp</th>
                                                    <th scope="col">Total logged in</th>
                                                    <th scope="col">Not ready time</th>
                                                    <th scope="col">Idle time</th>
                                                    <th scope="col">Ring time</th>
                                                    <th scope="col">Total Talk time</th>
                                                    <th scope="col">Total Hold time</th>
                                                    <th scope="col">ACW</th>
                                                    <th scope="col">Total handle time</th>
                                                    <th scope="col">Call answered</th>
                                                    <th scope="col">DN In calls</th>
                                                    <th scope="col">DN out calls</th>
                                                    <th scope="col">DN talk time</th>
                                                    <th scope="col">Avg. talk time</th>
                                                    <th scope="col">Avg. Hold time</th>
                                                    <th scope="col">Avg. ACW</th>
                                                    <th scope="col">Avg. AHT</th>
                                                    <th scope="col">Longest Hold</th>
                                                    <th scope="col">Longest Talk time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            if (isset($_POST['SubmitButton'])) {
                                                if (isset($_POST['AgentGivenName'])) {
                                                    $AgentGivenNames = $_POST['AgentGivenName'];
                                                    $AgentGivenName = "('" . implode("','", $AgentGivenNames);
                                                    $fromdate = $_POST['fromdate'];
                                                    $todate = $_POST['todate'];
                                                    $recort_tipe= $_POST['recort_tipe'];
                                                    if ($recort_tipe=='day') {
                                                        $sql = "SELECT cast(Timestamp as date) as currentdate,AgentGivenName,AgentLogin,sum(LoggedInTime) LoggedInTime,sum(NotReadyTime) NotReadyTime,sum(MaxCapacityIdleTime) MaxCapacityIdleTime, sum(RingTime) RingTime,
                                                                sum(Talktime+ACDCallsTalkTime+NACDCallsTalkTime+HoldTime) TotalTalktime,sum(HoldTime) HoldTime,sum(PostCallProcessingTime) ACW,
                                                                sum(Talktime+PostCallProcessingTime+ACDCallsTalktime+NACDCallsTalktime) Totalhandletime,sum(CallsAnswered) CallsAnswered,sum(DNInExtCalls) DNInExtCalls,
                                                                sum(DNOutExtCalls) DNOutExtCalls, sum(DNInExtCallsTalkTime) DNInExtCallsTalkTime,sum(Talktime+CallsAnswered) AvgTalkTime ,sum(PostCallProcessingTime) AvgACW,
                                                                sum(HoldTime+callsAnswered) AvgHoldTime,sum(Talktime+PostCallProcessingTime+ACDCallsTalkTime+NACDCallsTalkTime) AvgAHT,sum(HoldTime) LongestHold,
                                                                sum(Talktime+ACDCallsTalkTime+NACDCallsTalkTime+HoldTime) LongestTalktime FROM iAgentPerformanceStat WHERE Timestamp BETWEEN '".$fromdate." 00:00:01' AND '".$todate." 23:59:59' AND AgentGivenName IN ".$AgentGivenName."') GROUP BY cast(Timestamp as date),AgentGivenName,AgentLogin";
                                                    } else {
                                                        $sql = "SELECT cast(Timestamp as date) as currentdate,AgentGivenName,AgentLogin,sum(LoggedInTime) LoggedInTime,sum(NotReadyTime) NotReadyTime,sum(MaxCapacityIdleTime) MaxCapacityIdleTime, sum(RingTime) RingTime,
                                                                sum(Talktime+ACDCallsTalkTime+NACDCallsTalkTime+HoldTime) TotalTalktime,sum(HoldTime) HoldTime,sum(PostCallProcessingTime) ACW,
                                                                sum(Talktime+PostCallProcessingTime+ACDCallsTalktime+NACDCallsTalktime) Totalhandletime,sum(CallsAnswered) CallsAnswered,sum(DNInExtCalls) DNInExtCalls,
                                                                sum(DNOutExtCalls) DNOutExtCalls, sum(DNInExtCallsTalkTime) DNInExtCallsTalkTime,sum(Talktime+CallsAnswered) AvgTalkTime ,sum(PostCallProcessingTime) AvgACW,
                                                                sum(HoldTime+callsAnswered) AvgHoldTime,sum(Talktime+PostCallProcessingTime+ACDCallsTalkTime+NACDCallsTalkTime) AvgAHT,sum(HoldTime) LongestHold,
                                                                sum(Talktime+ACDCallsTalkTime+NACDCallsTalkTime+HoldTime) LongestTalktime FROM iAgentPerformanceStat WHERE Timestamp BETWEEN '".$fromdate." 00:00:01' AND '".$todate." 23:59:59' AND AgentGivenName IN ".$AgentGivenName."') GROUP BY AgentGivenName,AgentLogin";
                                                    }
                                                
                                                            
                                                    $rs=odbc_exec($conn, $sql);
                                                    while (odbc_fetch_row($rs)) {
                                                        $AgentGivenName=odbc_result($rs, "AgentGivenName");
                                                        $currentdate =odbc_result($rs, "currentdate");
                                                        $agentLogin=odbc_result($rs, "AgentLogin");
                                                        $totalPositive=odbc_result($rs, "LoggedInTime");
                                                        $NotReadyTime=odbc_result($rs, "NotReadyTime");
                                                        $MaxCapacityIdleTime=odbc_result($rs, "MaxCapacityIdleTime");
                                                        $RingTime=odbc_result($rs, "RingTime");
                                                        $TotalTalktime=odbc_result($rs, "TotalTalktime");
                                                        $HoldTime=odbc_result($rs, "HoldTime");
                                                        $ACW=odbc_result($rs, "ACW");
                                                        $Totalhandletime=odbc_result($rs, "Totalhandletime");
                                                        $CallsAnswered=odbc_result($rs, "CallsAnswered");
                                                        $DNInExtCalls=odbc_result($rs, "DNInExtCalls");
                                                        $DNOutExtCalls=odbc_result($rs, "DNOutExtCalls");
                                                        $DNInExtCallsTalkTime=odbc_result($rs, "DNInExtCallsTalkTime");
                                                        $AvgTalkTime=odbc_result($rs, "AvgTalkTime");
                                                        $AvgHoldTime=odbc_result($rs, "AvgHoldTime");
                                                        $AvgACW=odbc_result($rs, "AvgACW");
                                                        $LongestHold=odbc_result($rs, "LongestHold");
                                                        $AvgAHT=odbc_result($rs, "AvgAHT");
                                                        $LongestTalktime=odbc_result($rs, "LongestTalktime");
                                                        $totalPositives= gmdate("H:i:s", $totalPositive);
                                                        $NotReadyTimes= gmdate("H:i:s", $NotReadyTime);
                                                        $MaxCapacityIdleTimes= gmdate("H:i:s", $MaxCapacityIdleTime);
                                                        $RingTimes= gmdate("H:i:s", $RingTime);
                                                        $TotalTalktimes= gmdate("H:i:s", $TotalTalktime);
                                                        $HoldTimes= gmdate("H:i:s", $HoldTime);
                                                        $Totalhandletimes= gmdate("H:i:s", $Totalhandletime);
                                                        $AvgTalkTimes= gmdate("H:i:s", $AvgTalkTime);
                                                        $AvgHoldTimes= gmdate("H:i:s", $AvgHoldTime);
                                                        $AvgACWs= gmdate("H:i:s", $AvgACW);
                                                        $AvgAHTs= gmdate("H:i:s", $AvgAHT);
                                                        $AvgAHTs= gmdate("H:i:s", $AvgAHT);
                                                        $LongestHolds= gmdate("H:i:s", $LongestHold);
                                                        $LongestTalktimes= gmdate("H:i:s", $LongestTalktime);
                                                        
                                                        echo "<tr><td>$AgentGivenName</td>";
                                                        echo "<td>$agentLogin</td>";
                                                        echo "<td>$currentdate</td>";
                                                        echo "<td>$totalPositives</td>";
                                                        echo "<td>$NotReadyTimes</td>";
                                                        echo "<td>$MaxCapacityIdleTimes</td>";
                                                        echo "<td>$RingTimes</td>";
                                                        echo "<td>$TotalTalktimes</td>";
                                                        echo "<td>$HoldTimes</td>";
                                                        echo "<td>$ACW</td>";
                                                        echo "<td>$Totalhandletimes</td>";
                                                        echo "<td>$CallsAnswered</td>";
                                                        echo "<td>$DNInExtCalls</td>";
                                                        echo "<td>$DNOutExtCalls</td>";
                                                        echo "<td>$DNInExtCallsTalkTime</td>";
                                                        echo "<td>$AvgTalkTimes</td>";
                                                        echo "<td>$AvgHoldTimes</td>";
                                                        echo "<td>$AvgACWs</td>";
                                                        echo "<td>$AvgAHTs</td>";
                                                        echo "<td>$LongestHolds</td>";
                                                        echo "<td>$LongestTalktimes</td>";
                                                        echo "</tr>";
                                                    }
                                                    ///}
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