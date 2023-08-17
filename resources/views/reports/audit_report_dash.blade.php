<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="gb18030">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <style>
        body{
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    }
    footer{
        margin-top: auto;   
    }
        #datatable {
            border: none;
        }
        #datatable-container {
            width: 100%; /* Adjust this as needed */
            overflow-x: scroll; /* Use "scroll" to always show the scrollbar */
            white-space: nowrap; /* Prevent text wrapping */
        }
        #datatable td {
            border: none;
        }
        #datatable th {
            border: none;
        }
        .dataTables_wrapper .dataTables_length {
            float: right !important;
            margin-right: 10px;
        }
        .dataTables_wrapper .dataTables_length select{
            border-radius: 20px;
            border: 1px solid #DADADA;
            background: #FEFEFE;
            width: 72px;
            height: 66px;
            color: #343434;
            font-size: 16px;
            text-align: center;
            margin: 0 5px;
        }
        
        .dataTables_wrapper .dataTables_filter {
            float: left !important;
        }
        #datatable_filter input {
            /* Your styling properties go here */
            border: 1px solid #ccc;
            padding: 15px 50px;
            border-radius: 35px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        .button{
            padding: 12px 30px 12px 22px;
            border-radius: 110px;
            background: #0F75BD;
            color: #FFF;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            line-height: 20px;
        }
        .button:hover{
            color: #FFF;
        }
        .buton{
            padding: 5px 15px;
            border-radius: 110px;
            border: 1px solid #0F75BD;
            background: #0F75BD;
            color: #FFF;
            text-align: center;
            font-size: 15px;
            font-weight: 500;
            line-height: 20px;
        }
        .buton:hover{
            color: #FFF;
            background: #71BA4F;
            border: 1px solid #71BA4F;
        }
        
        
    </style>
    <title>
        @if (View::hasSection('title'))
        @yield('title')
        @else
        Consentio | {{ __('We Manage Compliance') }}
        @endif

    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href=" {{ url('assets-new/img/favicon.png') }}" type="image/png">
    <script src="{{ url('backend/js/sweetalert.js') }}"></script>
    <link rel="stylesheet" href="{{ url('backend/css/sweetalert.css') }}">
    <!--  -->
    <!--  -->
    <!-- Custom fonts for this template-->
    <link href="{{ url('frontend/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
    <!-- Custom styles for this template-->
    <!-- <link href="{{ url('frontend/css/sb-admin-2.min.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!--///////////////mycss////////-->

    <link href="{{ url('frontend/css/table.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/datatables.min.css" />
    <?php
    // load this css in client to match admin form style
    if (isset($load_admin_css) && $load_admin_css == true) : ?>
        <link rel="stylesheet" type="text/css" href="{{ url('backend/css/main.css') }}">
    <?php endif; ?>


    <!-- BOXicon -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets-new/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets-new/css/style.css') }}">
</head>

<body class="dashboard">



<script src="{{ url('frontend/js/jquery.min.js') }}"></script>

<script src="{{ url('frontend/js/bootstrap.bundle.min.js') }}"></script>


    
<div class="container-fluid mt-5" style="background-color: white;" id="myDiv">
    <div class="row align-items-end">
        <div class="col-6">
            <h4 class="mt-3" style="color:black;"><b>{{$company->name}} {{$group[0]->group_name}} - Security Assessment</b></h4>
        </div>
        <div class="col d-flex justify-content-end">
            <a class="report-change mr-2" href="{{ url('/dash/remediation/' . $group_id) }}"><button class="btn btn-secondary" style="border-radius:30px;font-weight: 500;font-size: 15px;">Remediation Report</button></a>
            <button id="screenshotButton" class="buton">Download Report</button>
        </div>
    </div>
    <input type="hidden" class="group_id" value="{{$group_id}}">
    <div class="row">
        <div class="col-md-3">
            <div id="chart"></div>
        </div>
        <div class="col-md-5 pt-2">
            <div class="row">
            <div class="col">
                <span style="font-size: 14px;"><b>Data Classification</b></span><br>
                @php
                    $existingUnits = [];
                @endphp
                @foreach ($remediation_plans as $subform => $plans)
                @if (count($plans) > 0)
                @if (!in_array($plans[0]->classification_name_en, $existingUnits) && $plans[0]->classification_name_en!=null)
                <input type="checkbox" id="checkbox-group" class="class-group change" value="{{$plans[0]->classification_name_en}}"><span style="font-size: 14px;"> {{$plans[0]->classification_name_en}}</span><br>
                @php
                $existingUnits[] = $plans[0]->classification_name_en;
                @endphp
                @endif
                @endif

                @endforeach
            </div>
            <div class="col">
                <span style="font-size: 14px;"><b>Impact</b></span><br>
                @php
                $existingUnits = [];
                $counter = 1;
                @endphp
                @foreach ($remediation_plans as $subform => $plans)
                @if (count($plans) > 0)
                @if($plans[0]->impact_name_en)
                @if (!in_array($plans[0]->impact_name_en, $existingUnits) && $plans[0]->impact_name_en!=null)
                <input type="checkbox" id="checkbox-group" class="impact-group change" value="{{$plans[0]->impact_name_en}}"><span style="font-size: 14px;"> {{$counter}} - {{$plans[0]->impact_name_en}}</span><br>
                @php
                $existingUnits[] = $plans[0]->impact_name_en;
                $counter++;
                @endphp
                @endif
                @endif
                @endif

                @endforeach
            </div>
            <div class="col">
                <span style="font-size: 14px;"><b>Business Unit</b></span><br>
                @php
                $existingUnits = [];
                @endphp
                @foreach ($remediation_plans as $subform => $plans)
                @if (count($plans) > 0)
                @if($plans[0]->business_unit)
                @if (!in_array($plans[0]->business_unit, $existingUnits) && $plans[0]->business_unit!=null)
                <input type="checkbox" id="checkbox-group" class="business-group change" value="{{$plans[0]->business_unit}}"><span style="font-size: 14px;"> {{$plans[0]->business_unit}}</span><br>
                @php
                $existingUnits[] = $plans[0]->business_unit;
                @endphp
                @endif
                @endif
                @endif
                @endforeach
            </div>
            </div>
        </div>
        <div class="col-md-2">
            <div id="chart-container"></div>
        </div>
        <div class="col-md-2">
            <div id="bus-chart"></div>
        </div>

    </div>
    <div class="row mt-3 overflow-auto">
        <div class="col-12">
            <table id="datatable" class="table table-striped table-sm text-dark border" width="100%">
                <thead>
                    <tr class="border">
                        <th>Asset Name</th>
                        <th>Asset Tier</th>
                        @foreach($data as $question)
                        <th>C{{$loop->iteration}} - {{$question->question_short}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($remediation_plans as $subform => $plans)
                    @if (count($plans) == 0)
                    @continue;
                    @endif
                    <tr class="border">
                        <td>{{$plans[0]->name}}</td>
                        <td>{{$plans[0]->tier}}</td>
                        @foreach ($plans as $plan)
                        <td style="color:{{$plan->text_color}} !important; background-color:{{$plan->color}} !important;">{{$plan->rating}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                    <!-- @foreach($remediation_plans as $plan)
                            {{-- <th style="color:{{$plan->text_color}}; background-color:{{$plan->color}};">{{$plan->rating}}</th> --}}
                    @endforeach -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- counts -->
<?php
// Assuming you have an array of data in your Laravel controller
$chartData = [
    ['Tier', 'Value'],
];
$impData = [
    ['hosting', 'Value'],
];
$busData = [
    ['business', 'Value'],
];
?>

<!-- For Tier Chart -->
@foreach ($remediation_plans as $subform => $plans)
    @if (count($plans) > 0 && isset($plans[0]->tier))
        @php
            $name = $plans[0]->tier;
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
            @foreach ($remediation_plans as $count)
                @if (isset($count[0]->tier) && $name == $count[0]->tier)
                    @php
                        $datacount++;
                    @endphp
                @endif
            @endforeach
            @php
                $chartData[] = [$name, $datacount];
            @endphp
        @endif
    @endif
@endforeach

<!-- For Hosting Type -->
@foreach ($remediation_plans as $subform => $plans)
    @if (count($plans) > 0 && isset($plans[0]->hosting_type))
        @php
            $name = $plans[0]->hosting_type;
            $datacount = 0;
        @endphp

        @foreach ($impData as $entry)
            @if ($entry[0] == $name)
                @php
                    $datacount = $entry[1];
                    break;
                @endphp
            @endif
        @endforeach

        @if ($datacount == 0)
            @foreach ($remediation_plans as $count)
                @if (isset($count[0]->hosting_type) && $name == $count[0]->hosting_type)
                    @php
                        $datacount++;
                    @endphp
                @endif
            @endforeach
            @php
                $impData[] = [$name, $datacount];
            @endphp
        @endif
    @endif
@endforeach

<!-- For Business Location -->
@foreach ($remediation_plans as $subform => $plans)
    @if (count($plans) > 0 && isset($plans[0]->country))
        @php
            $name = $plans[0]->country;
            $datacount = 0;
        @endphp

        @foreach ($busData as $entry)
            @if ($entry[0] == $name)
                @php
                    $datacount = $entry[1];
                    break;
                @endphp
            @endif
        @endforeach

        @if ($datacount == 0)
            @foreach ($remediation_plans as $count)
                @if (isset($count[0]->country) && $name == $count[0]->country)
                    @php
                        $datacount++;
                    @endphp
                @endif
            @endforeach
            @php
                $busData[] = [$name, $datacount];
            @endphp
        @endif
    @endif
@endforeach


<!-- @php
    echo json_encode($busData);
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
            filename: 'Asset_Report.pdf',
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

            // Reinitialize the DataTable after capturing the screenshot
            initializeDataTable();
        });
    }

    function initializeDataTable() {
        $('#datatable').DataTable({
            searching: false,
            lengthChange: false,
        });
    }
</script>



<!-- jQuery -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        
    });
});
</script>

<script type="text/javascript">
    // First Chart 
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(function() {
        // Call drawChart with the chartData array as a parameter

        drawChart(@json($chartData));
        drawCharts(@json($impData));
        drawChartsz(@json($busData));
    });

    function drawChart(chartData) {
        // var chartData = @json($chartData);

        // Create an empty array to hold the dynamic data
        var dynamicData = [];

        // Add each row of data to the dynamicData array using a foreach loop
        chartData.forEach(function(row) {
            dynamicData.push(row);
        });

        // Create the data table using the dynamicData array
        var data = google.visualization.arrayToDataTable(dynamicData);

        var options = {
            title: 'Assets Tier',
            titleTextStyle: {
                fontSize: 14
            },
            pieHole: 0.5,
            backgroundColor: 'transparent',
            is3D: true,
            chartArea: {
                left: 0,
                top: 40,
                width: '100%',
                height: '100%'
            }, // Add this line to remove margin and padding
            margin: 0, // Add this line to remove margin
            padding: 0
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart'));
        chart.draw(data, options);
    }

    //   Second Charts
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

        var options = {
            title: 'Hosting Type',
            titleTextStyle: {
                fontSize: 14
            },
            pieHole: 0.4,
            backgroundColor: 'transparent',
            colors: ['#6aa7f8', '#fdab89', '#3599b8', '#deee91', '#f6c7b6'],
            chartArea: {
                left: 0,
                top: 40,
                width: '100%',
                height: '100%'
            }, // Add this line to remove margin and padding
            margin: 0, // Add this line to remove margin
            padding: 0
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart-container'));
        chart.draw(data, options);
    }

    //   For Business Unit Chart
    function drawChartsz(busData) {
        // var chartData = @json($impData);

        // Create an empty array to hold the dynamic data
        var dynamicData = [];

        // Add each row of data to the dynamicData array using a foreach loop
        busData.forEach(function(row) {
            dynamicData.push(row);
        });

        // Create the data table using the dynamicData array
        var data = google.visualization.arrayToDataTable(dynamicData);

        var options = {
            title: 'Asset Hosting Location',
            titleTextStyle: {
                fontSize: 14
            },
            pieHole: 0.4,
            backgroundColor: 'transparent',
            colors: ['#3599b8', '#6aa7f8', '#bbd53b', '#fdab89', '#ff5500'],
            chartArea: {
                left: 0,
                top: 40,
                width: '100%',
                height: '100%'
            }, // Add this line to remove margin and padding
            margin: 0, // Add this line to remove margin
            padding: 0
        };

        var chart = new google.visualization.PieChart(document.getElementById('bus-chart'));
        chart.draw(data, options);
    }

    //   Other JS Code
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable("#datatable")) {
            $("#datatable").DataTable().destroy();
        }
        // Initialize DataTable
        var dataTable = $("#datatable").DataTable({
            // Configure DataTable options and settings here
        });
        // Listen for change event on checkboxes with class "checkbox-group"
        $(".change").change(function() {
            var classUnits = [];
            var impactUnits = [];
            var businessUnits = [];
            var id = $(".group_id").val();
            // Iterate over each checkbox with class "checkbox-group" that is checked
            $(".class-group:checked").each(function() {
                // Add the value (business unit) to the selectedUnits array
                classUnits.push($(this).val());
            });
            $(".impact-group:checked").each(function() {
                // Add the value (business unit) to the selectedUnits array
                impactUnits.push($(this).val());
            });
            $(".business-group:checked").each(function() {
                // Add the value (business unit) to the selectedUnits array
                businessUnits.push($(this).val());
            });

            // Retrieve CSRF token from meta tag
            var token = $('meta[name="csrf-token"]').attr('content');

            // Make the AJAX call
            $.ajax({
                url: "/your-ajax-endpoints/" + id,
                method: "POST",
                data: {
                    class: classUnits,
                    impact: impactUnits,
                    business: businessUnits,
                    _token: token // Include the CSRF token in the data
                },
                dataType: "json",
                success: function(response) {
                    // Handle the response from the server
                    // console.log(response);

                    // Clear existing table rows except the first one (header row)
                    dataTable.clear().draw();
                    // // Clear existing table rows except the first one (header row)
                    // $("tbody tr:not(:first)").remove();

                    // Iterate over the response and append data to the table
                    $.each(response, function(index, plan) {

                        if (plan.length === 0) {
                            return true; // Skip to the next iteration
                        }
                        // Create a new table row
                        var newRow = $("<tr>");

                        // Append table cells with data
                        newRow.append("<td>" + plan[0].name + "</td>");
                        newRow.append("<td>" + plan[0].tier + "</td>");

                        $.each(plan, function(key, plans) {
                            newRow.append("<td style='background:" + plans.color + " !important; color:" + plans.text_color + " !important'>" + plans.rating + "</td>");
                        });


                        // Append the new row to the DataTable
                        dataTable.row.add(newRow).draw();
                    });


                    // For Tier
                    let tier1 = 0;
                    let tier2 = 0;
                    let tier3 = 0;

                    var tierchart = [
                        ['Tier', 'Count'],
                    ];
                    const arrays = Object.values(response);

                    arrays?.forEach((item) => {
                        // console.log('jjjj', item)
                        if (item?.length) {
                            // console.log('tierrrrrrr', item[0].tier)
                            if (item[0].tier == 'tier 1') {
                                tier1 += 1;
                                // console.log("9---------", tier1)
                            }
                            if (item[0].tier == 'tier 2') {
                                tier2 += 1;
                            }
                            if (item[0].tier == 'tier 3') {
                                tier3 += 1;
                            }
                        }
                    })
                    const tier = {
                        tier1: tier1,
                        tier2: tier2,
                        tier3: tier3,
                    };
                    // console.log('zetiertiertieree', tier)

                    tierchart.push(['Tier 1', tier.tier1]);
                    tierchart.push(['Tier 2', tier.tier2]);
                    tierchart.push(['Tier 3', tier.tier3]);


                    //for hosting

                    let cloud = 0;
                    let premise = 0;
                    let nsure = 0;
                    let hybrid = 0;

                    var hostchart = [
                        ['Hosting', 'Count'],
                    ];

                    arrays?.forEach((item) => {
                        // console.log('jjjj', item)
                        if (item?.length) {
                            // console.log('tierrrrrrr', item[0].hosting_type)
                            if (item[0].hosting_type == 'Cloud') {
                                cloud += 1;
                                // console.log("9---------", tier1)
                            }
                            if (item[0].hosting_type == 'On-Premise') {
                                premise += 1;
                            }
                            if (item[0].hosting_type == 'Not Sure') {
                                nsure += 1;
                            }
                            if (item[0].hosting_type == 'Hybrid') {
                                hybrid += 1;
                            }
                        }
                    })
                    const host = {
                        cloud: cloud,
                        premise: premise,
                        nsure: nsure,
                        hybrid: hybrid,
                    };
                    // console.log('zetiertiertieree', tier)

                    hostchart.push(['Cloud', host.cloud]);
                    hostchart.push(['On-Premise', host.premise]);
                    hostchart.push(['Not Sure', host.nsure]);
                    hostchart.push(['Hybrid', host.hybrid]);

                    const dataArray = Object.values(response)
                    const countriesObject = {}
                    dataArray?.forEach((item) => {
                        if (item?.length) {
                            countriesObject[item[0]?.country] = 0
                        }
                    })
                    dataArray?.forEach((item) => {
                        if (item?.length) {
                            countriesObject[item[0]?.country] += 1
                        }
                    })
                    var country = [
                        ['Country', 'Value']
                    ];
                    Object.keys(countriesObject)?.forEach((item) => {
                        country.push([item, countriesObject[item]])
                    })
                    console.log('edfs', country)
                    drawChart(tierchart);
                    drawCharts(hostchart);
                    drawChartsz(country);

                },
                error: function(xhr, status, error) {
                    // Handle the error
                    console.error(error);
                }
            });
        });
    });
</script>


    <!-- Core plugin JavaScript-->

    <script src="{{ url('frontend/js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->

    <script src="{{ url('frontend/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->

    <script src="{{ url('frontend/js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->

    <script src="{{ url('frontend/js/chart-area-demo.js') }}"></script>

    <script src="{{ url('frontend/js/chart-pie-demo.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js"></script>
    <script src="{{ url('assets-new/js/main.js') }}"></script>

    <!-- Datatables scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js"></script>
    

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/datatables.min.js"></script>
<!-- @if(Request::segment(1) != 'report') -->
<script>
    $(document).ready(function() {

        if ($.fn.DataTable.isDataTable('#datatable')) {
        // If DataTable is already initialized, destroy it
        $('#datatable').DataTable().destroy();
        }
        
        $('#datatable').DataTable({
        "order": [],
        "language": {
            "search": "",
            "searchPlaceholder": "Search Here"
        }
        });
    });
    </script>
<!-- @endif -->

    <script>
        // JavaScript function to toggle the collapse
        function toggleCollapse(targetId) {
            var targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.classList.toggle('show');
            }
        }
    </script>
    <script>
        window.addEventListener("load", function() {
            var imgs = document.querySelectorAll("img");
            for (var a = 0; a < imgs.length; a++) {
                var src = imgs[a].getAttribute("src");
                imgs[a].setAttribute("onerror", src);
                imgs[a].setAttribute("src", imgs[a].getAttribute("src").replace("/img/", "/public/img/"));
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.overlay_sidebar').click(function() {
                $('.sidebar').removeClass('toggled');
                $('body').removeClass('sidebar-toggled');
            });
        });
    </script>
    @stack('scripts')
</body>



</html>