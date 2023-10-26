@extends('admin.client.client_app')
@section('page_title')
{{ __('Remediation Report') }}
@endsection
@section('content')
<style>
    body{
        color:black;
    }
</style>
<div class="container-fluid" style="background-color: white;" id="myDiv">
    <div class="row align-items-end">
        <input type="hidden" class="group" value="{{ $group_id }}">
        <div class="col-6">
            <h4 class="mt-3" style="color:black;"><b>{{$group[0]->group_name}} - Remediation Report</b></h4>
        </div>
        <div class="col d-flex justify-content-end">
            <img class="d-none" id="report-logo" src="{{ url('img/' . $company_logo) }}" alt="logo">
            <a class="btn btn-secondary report-change mr-2"  style="padding: 6px 30px;border-radius:30px;font-size:18px;" href="{{ url('/report/asset/' . $group_id) }}">Audit Report</a>
            <button id="screenshotButton" class="buton mr-2">Download Report</button>
            <div>
                <input type="hidden" id="fav_id" name="fav_id" value="{{$group_id}}">
                @php
                    $fav=DB::table('forms')->where('group_id', $group_id)->pluck('is_fav');
                    //echo $fav[0];
                @endphp
                <button id="add_favorite" class="buton"><img src="{{url('assets-new/rstar.png')}}" style="width: 22px;" alt=""></button>
                <button id="rem_favorite" class="buton"><img src="{{url('assets-new/star.png')}}" style="width:22px;" alt=""></button>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div id="chart"></div>
        </div>
        <div class="col-md-3">
            <div id="chart-container"></div>
        </div>
        <div class="col-md-2 p-2">
            <span style="font-size: 14px;"><b>Business Unit</b></span>
            @php
                $existingUnits = [];
            @endphp
            @foreach ($remediation_plans as $plans)
                
                    @if (!in_array($plans->business_unit, $existingUnits) && $plans->business_unit!=null)
                        <div class="place">
                            <input type="checkbox" class="checkbox-group" value="{{$plans->business_unit}}"><span style="font-size: 14px;"> {{$plans->business_unit}}</span><br>
                        </div>
                        @php
                            $existingUnits[] = $plans->business_unit;
                        @endphp
                    @endif
                
                
            @endforeach
        </div>
        <div class="col-md-4">
            <div id="chart-status"></div>
        </div>
        
        
    </div>
    <div class="row mt-3 overflow-auto">
        <table id="datatable" class="table table-striped table-sm text-dark border" cellspacing="0" width="100%">
            <thead class="border">
                    <th>Name</th>
                    <th>Control Name</th>
                    <th>Initial Rating</th>
                    <th>POST Rating</th>
                    <th>Proposed Remediation</th>
                    <th>Completed Actions</th>
                    <th>ETA</th>
                    <th>Remediation status</th>
                    <th>Person In Charge</th>
                    <th>Business Unit</th>
                </thead>
            <tbody>
                @foreach($remediation_plans as $plan)
                    <tr class="border">
                        <td>
                            @if($plan->asset_name)
                                {{$plan->asset_name}}
                            @else
                                {{$plan->other_id}}
                            @endif
                        </td>
                        <td>{{$plan->question_short}}</td>
                        @php
                            $check=DB::table('evaluation_rating')->where('rate_level', $plan->rating)->where('owner_id', $client_id)->first();
                        @endphp
                        <td style="background:{{$check->color}} !important;color:{{$check->text_color}} !important;">
                            {{$check->rating}}
                        </td>
                        <?php
                            $var = DB::table('evaluation_rating')->where('id', $plan->post_remediation_rating)->first();
                        ?>
                        <td style="background:<?php
                            if ($var) {
                                echo $var->color;
                            }
                            ?> !important; color:<?php
                            if ($var) {
                                echo $var->text_color;
                            }
                            ?> !important;">
                        <?php
                            if ($var) {
                                echo $var->rating;
                            }
                            ?>
                        </td>
                        <td>
                            @if($plan->proposed_remediation)
                                {{$plan->proposed_remediation}}
                            @else
                                <span style="margin-left:47%;">--</span>
                            @endif
                        </td>
                        <td>
                            @if($plan->completed_actions)
                                {{$plan->completed_actions}}
                            @else
                                <span style="margin-left:47%;">--</span>
                            @endif
                        </td>
                        <td>
                            @if($plan->eta)
                                {{$plan->eta}}
                            @else
                                <span style="margin-left:47%;">--</span>
                            @endif
                        </td>
                        <td>
                            @if($plan->status == "0")
                                <span style="margin-left:47%;">--</span>
                            @else
                                {{$plan->status}}
                            @endif
                        </td>
                        <td>{{$plan->user_name}}</td>
                        <td>@if($plan->business_unit)
                                {{$plan->business_unit}}
                            @else
                                <span style="margin-left:47%;">--</span>
                            @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- counts -->
@php
    // Assuming you have an array of data in your Laravel controller
    $chartStatus = [
        ['Tier', 'Tier Value'],
    ];
    $chartData = [
        ['Rating', 'Value'],
    ];
    $impData = [
        ['Postrat', 'Value'],
    ];
@endphp
<!-- For Pre-Remediation -->
@foreach ($remediation_plans as $plans)
    @if (isset($plans->status))
        @php
            $name = ($plans->status === '0' || $plans->status === null) ? 'Blank' : $plans->status;
            $datacount = 0;
            $exists = false;
        @endphp

        @foreach ($chartStatus as $entry)
            @if ($entry[0] == $name)
                @php
                    $exists = true;
                    break;
                @endphp
            @endif
        @endforeach

        @if (!$exists)
            @foreach ($chartData as $entry)
                @if ($entry[0] == $name)
                    @php
                        $datacount = $entry[1];
                        break;
                    @endphp
                @endif
            @endforeach

            @if ($datacount == 0)
                @php
                    $remediation_plans_count = $remediation_plans->where('status', $plans->status)->count();
                    $chartStatus[] = [$name, $remediation_plans_count];
                @endphp
            @endif
        @endif
    @endif
@endforeach


<!-- @php
    echo json_encode($chartStatus);
@endphp -->

<!-- For Pre-Remediation -->
@foreach ($remediation_plans as $plans)
    @if (isset($plans->rating))
        @php
            $check = DB::table('evaluation_rating')->where('id', $plans->rating)->first();
        @endphp
        @php
            $name = $check->rating;
            $datacount = 0;
        @endphp

        @foreach ($chartData as $entry)
            @if ($entry[0] == $name)
                @php
                    $datacount = $entry[1];
                    break;
                @endphp
            @endif
        @endforeach

        @if ($datacount == 0)
            @php
                $remediation_plans_count = $remediation_plans->where('rating', $plans->rating)->count();
                $chartData[] = [$name, $remediation_plans_count];
            @endphp
        @endif
    @endif
@endforeach

<!-- @php
    echo json_encode($chartData);
@endphp -->

<!-- For Post-Remediation -->
@foreach ($remediation_plans as $plans)
    @php
        $postRating = isset($plans->post_remediation_rating) ? $plans->post_remediation_rating : null;
    @endphp

    @php
        $check = DB::table('evaluation_rating')->where('id', $postRating)->first();
    @endphp

    @php
        $name = $check ? $check->rating : 'Blank';
        $datacount = 0;
        $exists = false;
    @endphp

    @foreach ($impData as $entry)
        @if ($entry[0] == $name)
            @php
                $exists = true;
                break;
            @endphp
        @endif
    @endforeach

    @if (!$exists)
        @php
            $datacount = $remediation_plans->where('post_remediation_rating', $postRating)->count();
            $impData[] = [$name, $datacount];
        @endphp
    @endif
@endforeach




<!-- @php
    echo json_encode($impData);
@endphp -->

<!-- Google Charts library -->
<script src="https://www.gstatic.com/charts/loader.js"></script>

<!-- html2pdf.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>


<script>
    document.getElementById('screenshotButton').addEventListener('click', function() {
        // Destroy the DataTable
        if ($.fn.DataTable.isDataTable("#datatable")) {
            $("#datatable").DataTable().destroy();
        }

        // Add the d-none class to the button
        $(this).addClass('d-none');
        $('.report-change').addClass('d-none');

        // Add Logo
        $('#report-logo').removeClass('d-none');
        $('#myDiv').attr("style", "padding:7%;")

        // Capture screenshot and download report
        captureScreenshot();
    });

    function captureScreenshot() {
        // Get the screen dimensions
        const screenWidth = 500;
        const screenHeight = 650;

        // Specify the ID of the div you want to capture
        const divId = 'myDiv';

        // Get the target div element
        const targetDiv = document.getElementById(divId);

        // Create a container element to hold the target div temporarily
        const container = document.createElement('div');
        container.appendChild(targetDiv.cloneNode(true));

        // Convert the container element to PDF
        const options = {
            filename: 'Rem_Report.pdf',
            image: { type: 'jpeg', quality: 0.99 },
            html2canvas: { scale: 1 },
            jsPDF: {
                format: [screenWidth, screenHeight] // Set the page size to the screen dimensions
            }
        };

        html2pdf().set(options).from(container).save().then(function() {

            // Remove the d-none class from the button
            $('#screenshotButton').removeClass('d-none');
            $('.report-change').removeClass('d-none');

            // Remove Logo
            $('#report-logo').addClass('d-none');
            $('#myDiv').attr("style", "padding:0;")

            // Reinitialize the DataTable after capturing the screenshot
            initializeDataTable();
        });
    }

    function initializeDataTable() {
        $('#datatable').DataTable({
            "order": [],
            "language": {
            "search": "",
            "searchPlaceholder": "Search Here"
        }
        });
    }
</script>







<!-- jQuery -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- <script>
$(document).ready(function() {
    $('#datatable').DataTable({
        "order": [],
        "language": {
        "search": "",
        "searchPlaceholder": "Search Here"
    }
    });
});
</script> -->

<script type="text/javascript">
    
    // Status Chart 
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(function() {
            // Call drawChart with the chartData array as a parameter
            
            drawChartstatus(@json($chartStatus));
            drawChart(@json($chartData));
            drawCharts(@json($impData));
        });
        
      function drawChartstatus(chartStatus) {
        // var chartData = @json($chartStatus);

        // Create an empty array to hold the dynamic data
        var dynamicData = [];

        // Add each row of data to the dynamicData array using a foreach loop
        chartStatus.forEach(function(row) {
            dynamicData.push(row);
        });

        // Create the data table using the dynamicData array
        var data = google.visualization.arrayToDataTable(dynamicData);

        var options = {
          title: 'Remediation Status',
          titleTextStyle: { fontSize: 14 },
          pieHole: 0.4,
          backgroundColor: 'transparent',
          colors: ['#deee91', '#ed2938', '#037428', '#ff8c01', '#f6c7b6'],
          chartArea: { left: 0, top: 40, width: '100%', height: '100%' }, // Add this line to remove margin and padding
          margin: 0, // Add this line to remove margin
          padding: 0 
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart-status'));
        chart.draw(data, options);
      }

    // First Chart function
    
      function drawChart(chartData) {
        // Create an empty array to hold the dynamic data
        var dynamicData = [];

        // Add each row of data to the dynamicData array using a foreach loop
        chartData.forEach(function(row) {
            dynamicData.push(row);
        });

        // Create the data table using the dynamicData array
        var data = google.visualization.arrayToDataTable(dynamicData);

        var colors = [];
        var colorMap = {
            'Weak': '#ED2938',
            'Marginal': '#FF8C01'
        }
        for (var i = 0; i < data.getNumberOfRows(); i++) {
            colors.push(colorMap[data.getValue(i, 0)]);
        }

        var options = {
          title: 'Initial Rating',
          titleTextStyle: { fontSize: 14 },
        //   pieHole: 0.5,
        //   is3D: true,
          backgroundColor: 'transparent',
          colors: colors,
          chartArea: { left: 0, top: 40, width: '100%', height: '100%' }, // Add this line to remove margin and padding
          margin: 0, // Add this line to remove margin
          padding: 0 
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart'));
        chart.draw(data, options);
      }

    // Second Charts Function
      function drawCharts(impData) {
        // var chartData = @json($impData);

        // Create an empty array to hold the dynamic data
        var dynamicData = [];

        // Add each row of data to the dynamicData array using a foreach loop
        impData.forEach(function(row) {
            dynamicData.push(row);
        });

        // Create the data table using the dynamicData array
        var data = google.visualization.arrayToDataTable(dynamicData);

        var colors = [];
        var colorMap = {
            'Good': '#037428',
            'Satisfactory': '#DEEE91',
            'Weak': '#ED2938',
            'Marginal': '#FF8C01',
            'Blank': '#808080'
        }
        for (var i = 0; i < data.getNumberOfRows(); i++) {
            colors.push(colorMap[data.getValue(i, 0)]);
        }

        var options = {
          title: 'Post Remediation Rating',
          titleTextStyle: { fontSize: 14 },
        //   pieHole: 0.5,
        //   is3D: true,
          backgroundColor: 'transparent',
          colors: colors,
          chartArea: { left: 0, top: 40, width: '100%', height: '100%' }, // Add this line to remove margin and padding
          margin: 0, // Add this line to remove margin
          padding: 0 
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart-container'));
        chart.draw(data, options);
      }


      ///other js Code
    
$(document).ready(function() {
    
    // Get the value of $fav[0] from PHP
    var favValue = <?php echo $fav[0]; ?>;

    // Get references to the elements by their IDs
    var addFavoriteButton = document.getElementById('add_favorite');
    var remFavoriteButton = document.getElementById('rem_favorite');

    // Check the value and add/remove the d-none class accordingly
    if (favValue === null || favValue === 0) {
        addFavoriteButton.classList.remove('d-none'); // Show add favorite button
        remFavoriteButton.classList.add('d-none');    // Hide remove favorite button
    } else {
        addFavoriteButton.classList.add('d-none');    // Hide add favorite button
        remFavoriteButton.classList.remove('d-none'); // Show remove favorite button
    }

    if ($.fn.DataTable.isDataTable("#datatable")) {
        $("#datatable").DataTable().destroy();
    }
    // Initialize DataTable
    var dataTable = $("#datatable").DataTable({
        // Configure DataTable options and settings here
        "order": [],
        "language": {
        "search": "",
        "searchPlaceholder": "Search Here"
    }
    });

    // js code for report favorite
    $("#add_favorite").click(function(){
            var group_id= $("#fav_id").val();
            console.log(group_id);
            // Retrieve CSRF token from meta tag
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/make-favorite",
                method: "POST",
                data: {
                    group_id: group_id,
                    _token: token
                },
                datatype: "json",
                success: function(response){
                    console.log(response)
                    $("#add_favorite").addClass("d-none");
                    $("#rem_favorite").removeClass("d-none");
                }
            })
        })
        $("#rem_favorite").click(function(){
            var group_id= $("#fav_id").val();
            console.log(group_id);
            // Retrieve CSRF token from meta tag
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/remove-favorite",
                method: "POST",
                data: {
                    group_id: group_id,
                    _token: token
                },
                datatype: "json",
                success: function(response){
                    console.log(response)
                    $("#rem_favorite").addClass("d-none");
                    $("#add_favorite").removeClass("d-none");
                }
            })
        })
    
    // Listen for change event on checkboxes with class "checkbox-group"
    $(".checkbox-group").change(function() {
        var selectedUnits = [];
        // Iterate over each checkbox with class "checkbox-group" that is checked
        $(".checkbox-group:checked").each(function() {
            // Add the value (business unit) to the selectedUnits array
            selectedUnits.push($(this).val());
        });
        var group = $(".group").val();

        // Retrieve CSRF token from meta tag
        var token = $('meta[name="csrf-token"]').attr('content');

        // Make the AJAX call
        $.ajax({
            url: "/your-ajax-endpointz",
            method: "POST",
            data: {
                group: group,
                units: selectedUnits,
                _token: token // Include the CSRF token in the data
            },
            dataType: "json",
            success: function(response)  {
                // console.log(response);
                // Clear existing table rows except the first one (header row)
                dataTable.clear().draw();
                // Clear existing table rows except the first one (header row)
                // $("tbody").html("");
                // Iterate over the response and append data to the table
                $.each(response, function(index, plan) {
                    // Create a new table row
                    var newRow = $("<tr>");
                    // Append table cells with data
                    newRow.append("<td>" + (plan.asset_name ? plan.asset_name : plan.other_id) + "</td>");
                    newRow.append("<td>" + plan.question_short + "</td>");
                    newRow.append("<td style='background:" + plan.bg_icolor +" !important; color:" + plan.t_icolor + " !important'>" + (plan.irating ? plan.irating : '') + "</td>");
                    newRow.append("<td style='background:" + plan.bg_pcolor +" !important; color:" + plan.t_pcolor + " !important'>" + (plan.prating ? plan.prating : '') + "</td>");
                    newRow.append("<td>" + (plan.proposed_remediation ? plan.proposed_remediation : "<span style='margin-left:47%;'>--</span>") + "</td>");
                    newRow.append("<td>" + (plan.completed_actions ? plan.completed_actions : "<span style='margin-left:47%;'>--</span>") + "</td>");
                    newRow.append("<td>" + (plan.eta ? plan.eta : "<span style='margin-left:47%;'>--</span>") + "</td>");
                    newRow.append("<td>" + (plan.status == "0" ? "<span style='margin-left:47%;'>--</span>" : plan.status) + "</td>");
                    newRow.append("<td>" + plan.user_name + "</td>");
                    newRow.append("<td>" + (plan.business_unit ? plan.business_unit : "<span style='margin-left:47%;'>--</span>") + "</td>");
                    // Append the new row to the DataTable
                    dataTable.row.add(newRow).draw();
                });

                
                // For initial Rating
                var irating = [];
                const ratings = {
                    Marginal: 0,
                    Weak: 0,
                }
                var preRatting = [
                    ['Ratings', 'count'],
                ];

                $.each(response, function(key, value) {
                    ratings[`${value.irating}`] += 1 
                });
                preRatting.push(['Marginal', ratings.Marginal]);
                preRatting.push(['Weak', ratings.Weak]);
                // console.log(preRatting);

                // For Post Rating
                var prating = [];
                const postratings = {
                    Marginal: 0,
                    Weak: 0,
                    Good: 0,
                    Satisfactory: 0,
                    Blank: 0
                }
                var postRatting = [
                    ['Ratings', 'count'],
                ];

                $.each(response, function(key, value) {
                    const KeyVa = value.prating? value?.prating : 'Blank'
                    postratings[`${KeyVa}`] += 1 
                });
                postRatting.push(['Marginal', postratings.Marginal]);
                postRatting.push(['Weak', postratings.Weak]);
                postRatting.push(['Good', postratings.Good]);
                postRatting.push(['Satisfactory', postratings.Satisfactory]);
                postRatting.push(['Blank', postratings.Blank]);
                // console.log(postRatting);

                // For Remediation Status
                var status = [];
                const remstatus = {
                    RemediationinProgress: 0,
                    RemediationApplied: 0,
                    RiskAcceptance: 0,
                    AnalysisinProgress: 0,
                    Other: 0,
                    Blank: 0,       
                };
                var rstatus = [
                ['Status', 'Count'],
                ];

                $.each(response, function(key, value) {
                    const updateStatuswithoutSpace =  value.status.replaceAll(' ', '')
                    const keyValue = updateStatuswithoutSpace=="0" ? 'Blank' : updateStatuswithoutSpace
                remstatus[keyValue] += 1;
                });

                rstatus.push(['Remediation in Progress', remstatus.RemediationinProgress]);
                rstatus.push(['Remediation Applied', remstatus.RemediationApplied]);
                rstatus.push(['Risk Acceptance', remstatus.RiskAcceptance]);
                rstatus.push(['Analysis in Progress', remstatus.AnalysisinProgress]);
                rstatus.push(['Other', remstatus.Other]);
                rstatus.push(['Blank', remstatus.Blank]);
                // console.log(rstatus);

                
                // Redraw the charts
                drawChart(preRatting);
                drawCharts(postRatting);    
                drawChartstatus(rstatus);
            },
            
            error: function(xhr, status, error) {
                // Handle the error
                console.error(error);
            }
        });
    });
});




</script>
@endsection