@extends('admin.client.client_app')

@section('content')
@section('page_title')
{{ __('DASHBOARD') }}
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />

<style>
  .card_is_ban {
      -webkit-filter: blur(3px);
      -moz-filter: blur(3px);
      -o-filter: blur(3px);
      -ms-filter: blur(3px);
      filter: blur(3px);
  }

  .table_is_ban {
      -webkit-filter: blur(3px);
      -moz-filter: blur(3px);
      -o-filter: blur(3px);
      -ms-filter: blur(3px);
      filter: blur(3px);
  }

  .Critical {
      background-color: red;
  }

  .Low {
      background-color: #0CC673;

  }

  .High {
      background-color: #FFC100;

  }

  .Medium {
      background-color: yellow;

  }

  < !-- table style -->table.stats-table,
  .stats-table th,
  .stats-table td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 6px;
      text-align: center;
  }

  .table-bordered td,
  .table-bordered th {
      /*border: 1px solid #00000047;*/
      background: #fff;
      border: none;
      border-bottom: 1px solid #efefef;
  }

  .stats-table {
      border: none;
  }

  .stats-table tr {
      border: 1px dotted dashed #bbbbbbbb;
  }

  .stats-table table {
      border-collapse: collapse !important;
  }

  .stats-table tr {
      border: none !important;
  }

  .stats-table td {
      /*border-right: dotted 1.5px #000 !important;
            border-left: dotted 1px #000 !important;*/
      text-align: center;
  }

  .table p {
      margin-bottom: 0;
      margin-left: 2px;
      font-size: 12px;
      color: rgba(74, 74, 76, 1);
      /*margin-top: 14px;*/
      font-weight: 400;
  }

  .not_cmplt {
      color: #f26925;
      font-weight: 400;
  }

  .cmplt {
      color: #1cc88a;
      font-weight: 400;
  }

  #map_wrapper {
      height: 400px;
      margin-bottom: 2rem;
  }

  #map_canvas {
      width: 100%;
      height: 100%;
  }

  .set_bg {
      background: #fff;
  }

  .top_table h4 {
      margin: 0;
      padding: 15px;
      font-size: 20px;
      font-weight: 700;
  }

  .set_bg .table thead th {
      border-top: 0;
  }

  .mapouter {
      margin-bottom: 2rem;
  }

  .mapouter,
  .gmap_canvas {
      width: auto !important;
      height: 100% !important;
  }

  .mapouter iframe {
      width: 100% !important;

  }

  .mapouter {
      position: relative;
      text-align: right;
      height: 500px;
  }

  .gmap_canvas {
      overflow: hidden;
      background: none !important;
      height: 500px;
      width: 600px;
      border-radius: 20px;
      /*-webkit-filter: grayscale(100%) !important;*/
      /* -moz-filter: grayscale(100%)!important;
                -ms-filter: grayscale(100%) !important;
                -o-filter: grayscale(100%) !important;*/
      /*filter: grayscale(100%) !important;*/
  }

  .gm-style-iw {
      text-align: center;
  }

  .main_paginated {
      position: relative;
      margin-bottom: 3rem;
  }

  .first_table {
      margin-bottom: 37px !important;
  }

  .over_main_div.no_scroll {
      overflow-x: scroll !important;
  }

  .add_margin_space_bt {
      margin: 20px 0 50px !important;
  }

  .card_earnings {
      border-radius: 30px;
      background-color: #0f75bd;
      color: #fff;
  }

  .icon_num {
      display: flex;
      align-items: center;
  }

  .card_earnings:hover {
      background-color: #73b84d;
      transition: .2s;
  }

  a:hover {
      text-decoration: none !important;
  }

  .card_earnings a {
      color: #fff;
  }

  .parent_main_cards.mb-4 {
      width: 13.3%;
      margin: 0 .7% 16px 0 !important;
      height: 137.16px;
  }

  .main_top_boxes {
      display: flex;
      flex-wrap: wrap;
  }

  .parent_main_cards .text-xs.font-weight-bold.text-uppercase.mt-2 {

      margin-top: 6px !important;
      font-size: 10px !important;
  }

  @media screen and (max-width: 767px) {
      .gmap_canvas {
          height: 500px !important;
          margin-top: 20px;
      }

      .add_space_on_bottom {
          margin-bottom: 20px;
      }
  }
</style>

<section class="section dashboard"> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row completed-audits-box5">
                    @php
                        $user_type = Auth::user()->role;
                        $user_id = Auth::user()->id;
                        $client_id = Auth::user()->client_id;
                    @endphp
                    <div class="col-xs-2 col-half-offset active">
                        <span class="number">{{$forms}}</span>
                        <img src="{{url('assets-new/img/write.png')}}">
                        <p>Completed Assessments</p>
                    </div>
                    <div class="col-xs-2 col-half-offset">
                        <span class="number">{{$pen_forms}}</span>
                        <img src="{{url('assets-new/img/paper.png')}}">
                        <p>Pending Assessments</p>
                    </div>
                    
                    <div class="col-xs-2 col-half-offset">
                        <span class="number">{{$audits}}</span>
                        <img src="{{url('assets-new/img/audit.png')}}">
                        <p>Completed Audits</p>
                    </div>
                    <div class="col-xs-2 col-half-offset">
                        <span class="number">{{$pen_audits}}</span>
                        <img src="{{url('assets-new/img/roll.png')}}">
                        <p>Pending Audits</p>
                    </div>
                    <div class="col-xs-2 col-half-offset">
                        <span class="number">{{$remediation}}</span>
                        <img src="{{url('assets-new/img/plan.png')}}">
                        <p>Remediation Plans</p>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-12">
                        <div class="card card-full-content">
                            <div class="card-body" style="height:80vh;">

                            </div>
                        </div>
                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-8 col-xs-12">
                        <div class="card card-full-content">
                            <div class="card-table">
                            <h3 class="card-title-h3  text-center">{{ __('ASSET LIST') }}</h3>
                            <table class="table fixed_header manage-assessments-table">
                                <thead>
                                <tr>
                                    <th class="align-middle" scope="col">#</th>
                                    <th class="align-middle" scope="col">{{ __('Asset Type') }}</th>
                                    <th class="align-middle" scope="col">{{ __('Asset Name') }}</th> 
                                    <th class="align-middle" scope="col">{{ __('Hosting Type') }}</th>
                                    <th class="align-middle" scope="col">{{ __('Hosting Provider') }}</th>
                                    <th class="align-middle" scope="col">{{ __('Country') }}</th>
                                    <th class="align-middle" scope="col">{{ __('City') }}</th> 
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                            $count = 1;
                            foreach ($assets as $ass): ?>
                                    <tr>
                                        <td>{{$count}}</td> <?php $count++; ?>
                                        <td>{{$ass->asset_type}}</td>
                                        <td>{{$ass->name}}</td>
                                        <td>{{$ass->hosting_type}}</td>
                                        <td>{{$ass->hosting_provider}}</td>
                                        <td>{{$ass->country}}</td>
                                        <td>{{$ass->city}}</td>
                                        <!-- <td style="text-align:center">{{$ass->state}}</td> -->
                                    </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                            
                            </div>
                        </div>
                        </div>
                        <!-- <div class="col-sm-4 col-xs-12">
                            <div class="map-image card card-full-content">
                                <img src="assets/img/map.png">
                                <div class="map_canvas"></div>
                            </div>
                        </div> -->
                        <div class="col-sm-4 col-xs-12">
                            <div class="mapouter">
                                <div class="gmap_canvas">
                                    <div id='map_canvas' style="position:relative; width:auto; height:100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php  
                        $incident_type = DB::table('incident_type')->orderBy('id' , 'desc')->get();
                        $organization  = DB::table('users')->where('role',4)->get();
                        $user_type = Auth::user()->role;
                        $currentuserid = Auth::user()->id;
                        if ($user_type == 2 || Auth::user()->user_type == 1){
                            $incident_front = DB::table('incident_register')->where('organization_id',Auth::user()->client_id)->where('incident_status' , '!=', 'Resolved')
                            ->orderBy('date_discovered', 'DESC')
                            ->get();
                        }
                        else {
                            $incident_front = DB::table('incident_register')->where('created_by',$currentuserid)->where('incident_status' , '!=', 'Resolved')
                            ->orderBy('date_discovered', 'DESC')
                            ->get();

                        }


                        $incident_register = DB::table('incident_register')->where('incident_status' , '!=', 'Resolved')->orderBy('date_discovered', 'DESC')->get();
                        $assigned_permissions =array();
                        $data = DB::table('module_permissions_users')->where('user_id' , Auth::user()->id)->pluck('allowed_module');

                                if($data != null){
                                    foreach ($data as $value) {
                                    $assigned_permissions = explode(',',$value);
                                    
                                }
                                }


                    ?>

                    <div class="row">
                        <div class="col-12">
                        <div class="card card-full-content">
                            <div class="card-table">
                            <h3 class="card-title-h3  text-center">Incident List</h3>
                            <table class="table fixed_header manage-assessments-table">
                                <thead>
                                <tr>
                                    <th class="align-middle" scope="col">#</th>
                                    <th class="align-middle" scope="col">Incident Name</th>
                                    <th class="align-middle" scope="col">Type</th> 
                                    <th class="align-middle" scope="col">Organization</th>
                                    <th class="align-middle" scope="col">Assignee</th>
                                    <th class="align-middle" scope="col">Root Cause</th>
                                    <th class="align-middle" scope="col">Date Discovered</th>
                                    <th class="align-middle" scope="col">Deadline Date</th>
                                    <th class="align-middle" scope="col">Status</th>
                                    <th class="align-middle" scope="col">Severity</th>  
                                </tr>
                                </thead>
                                @if($user_type=='1')
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($incident_register as $row)
                                    <tr>
                                        <td>{{$count}}</td> <?php $count++; ?>
                                        <td>{{$row->name}}</td>
                                        <td><?php $incident  = DB::table('incident_type')->where('id',$row->incident_type)->first();?>
                                            {{ $incident->name}}</td>
                                        <td><?php $org  = DB::table('users')->where('id',$row->organization_id)->first();?>
                                            {{ $org->company}}</td>
                                        <td>{{$row->assignee}}</td>
                                        <td>{{$row->root_cause}}</td>
                                        <td><a href="" class="btn seet_detail_btn" data-toggle="modal"
                                                data-val="{{$row->root_cause}}" data-target='#practice_modal'><i
                                                    class="bx bx-show-alt"></i>{{ __('See Detail') }}</a></td>
                                        <td>{{$row->date_discovered}}</td>
                                        <td>{{$row->deadline_date}}</td>
                                        <td>{{$row->incident_status}}</td>
                                        <td class="{{$row->incident_severity}}"><strong>{{$row->incident_severity}}</strong></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                @else
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($incident_front as $row)
                                    <tr>
                                        <td>{{$count}}</td> <?php $count++; ?>
                                        <td>{{$row->name}}</td>
                                        <td><?php $incident  = DB::table('incident_type')->where('id',$row->incident_type)->first();?>
                                            {{ $incident->name}}</td>
                                        <td><?php $org  = DB::table('users')->where('id',$row->organization_id)->first();?>
                                            {{ $org->company}}</td>
                                        <td>{{$row->assignee}}</td>
                                        <td><a href="" class="btn seet_detail_btn" data-toggle="modal"
                                                data-val="{{$row->root_cause}}" data-target='#practice_modal'><i
                                                    class="bx bx-show-alt"></i>{{ __('See Detail') }}</a></td>
                                        <td>{{$row->date_discovered}}</td>
                                        <td>{{$row->deadline_date}}</td>
                                        <td>{{ __($row->incident_status) }}</td>
                                        <td class="{{$row->incident_severity}}"><strong>{{ __($row->incident_severity)}}</strong>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                            
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="practice_modal" role="dialog" aria-labelledby="my-modal" aria-hidden="true">
    <div class="modal-dialog mt-5 pt-5" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Root Cause') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>



<script>
$('#practice_modal').on('show.bs.modal', function(event) {
    var myVal = $(event.relatedTarget).data('val');
    $(this).find(".modal-body").html(myVal);
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $('#example').DataTable();

    $('#orgs').DataTable({

        "order": [
            [5, "asc"]
        ]

    });

});
</script>

<!-- end of incident -->
<!-- <div class="set_bg">
              <div class="top_table">
                <h4>Sources</h4>
              </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
          </div> -->

<!-- Content Row -->
<!--  <div class="row">-->

<!-- Content Column -->
<!--    <div class="col-lg-6 mb-4">-->

<!-- Project Card Example -->
<!--      <div class="card shadow mb-4">-->
<!--        <div class="card-header py-3">-->
<!--          <h6 class="m-0 font-weight-bold text-primary">Projects</h6>-->
<!--        </div>-->
<!--        <div class="card-body">-->
<!--          <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>-->
<!--          <div class="progress mb-4">-->
<!--            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--          </div>-->
<!--          <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>-->
<!--          <div class="progress mb-4">-->
<!--            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--          </div>-->
<!--          <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>-->
<!--          <div class="progress mb-4">-->
<!--            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--          </div>-->
<!--          <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>-->
<!--          <div class="progress mb-4">-->
<!--            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--          </div>-->
<!--          <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>-->
<!--          <div class="progress">-->
<!--            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->




<!--    </div>-->

<!--    <div class="col-lg-6 mb-4">-->

<!-- Illustrations -->
<!--      <div class="card shadow mb-4">-->
<!--        <div class="card-header py-3">-->
<!--          <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>-->
<!--        </div>-->
<!--        <div class="card-body">-->
<!--          <div class="text-center">-->
<!--            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="frontend/images/undraw_posting_photo.svg" alt="">-->
<!--          </div>-->
<!--          <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>-->
<!--          <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>-->
<!--        </div>-->
<!--      </div>-->



<!--    </div>-->
<!--  </div>-->

<!--</div>-->

<script type="text/javascript" src="//www.gstatic.com/charts/loader.js"></script>
<script src="https://knockoutjs.com/downloads/knockout-2.2.1.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false&.js"></script>
<script src="https://rawgit.com/kangax/fabric.js/master/dist/fabric.js"></script>
<script src="https://knockoutjs.com/downloads/jquery.tmpl.min.js"></script>





<input type="hidden" id="lat_value" value="<?php echo htmlentities(json_encode($lat_value)); ?>">
<input type="hidden" id="lat_detail" value="<?php echo htmlentities(json_encode($lat_detail)); ?>">

<script>
var lat_value = [];
var lat_detail = [];
jQuery(function($) {

    lat_value = JSON.parse(document.getElementById("lat_value").value);
    lat_detail = JSON.parse(document.getElementById("lat_detail").value);
    console.log({
        "lat_value": lat_value
    });


    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src =
        "//maps.googleapis.com/maps/api/js?key=AIzaSyDaCml5EZAy3vVRySTNP7_GophMR8Niqmg&callback=initialize&libraries=&v=beta&map_ids=66b6b123dade7a4d";
    document.body.appendChild(script);
});

function initialize() {


    //above lines were put for var map, for api key


    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'

    };



    map = new google.maps.Map(document.getElementById("map_canvas"), {
        mapId: "66b6b123dade7a4d",

    });








    var markers = lat_value;
    var html = '';
    var windowArray = [];

    var ct = "";

    var windowArray = [];

    for (var r = 0; r < lat_detail.length; r++) {
        ct = "";

        if (lat_detail[r][1] != null) {
            ct += '<p class="info_content"><strong>City :</strong>  ' + lat_detail[r][1] + '</p>';
        }


        if (lat_detail[r][2] != null) {
            ct += '<p class="info_content"><strong>State :</strong> ' + lat_detail[r][2] + '</p></div>';
        }




        // var html = [''. $string];

        var html = ['<div class="info_content"><p> <strong>Country :</strong> ' + lat_detail[r][0] + '</p>' +
            '<p><strong>Asset Name :</strong> ' + lat_detail[r][3] + '</p>' +
            '<p class="info_content"><strong>Hosting provider  :</strong> ' + lat_detail[r][4] + '</p>' +
            '<p class="info_content"><strong>Asset type :</strong> ' + lat_detail[r][5] + '</p>' + ct
        ];
        // html+=string;

        windowArray.push(html);

    }

    console.log(windowArray);



    for (var r = 0; r < markers.length; r++) {

        bounds = new google.maps.LatLngBounds();



        var position = new google.maps.LatLng(markers[r][1], markers[r][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[r][0]
        });




        var infoWindow = new google.maps.InfoWindow(),
            marker, r;

        google.maps.event.addListener(marker, 'click', (function(marker, r) {
            return function() {
                infoWindow.setContent(windowArray[r][0]);
                infoWindow.open(map, marker);
            }
        })(marker, r));

        console.log(bounds);

        map.fitBounds(bounds);

    }



    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(1.7);
        // this.setTilt('africa');
        google.maps.event.removeListener(boundsListener);
    });


}
</script>



@endsection