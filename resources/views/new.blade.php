@extends('layout')

@section('content')





<?php 
    $_SESSION['login']=$login_name;
?>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color:#155115;">
  <div class="container">
    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background-color:#155115;">
        <span > Menu </span>
      </button>
      <a class="navbar-brand" href="{{ url('/backhome1') }}">MY TREE Thailand</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" >
      <ul class="nav navbar-nav navbar-right">
        <li><a onclick="hidefunc()" href="#222"><h4>แผนที่</h4></a></li>
        <?php if($_SESSION['login']!="Guest") {?><li><a onclick="hidefunc()" href="{{ route('add_form')}}"><h4>เพิ่มต้นไม้</h4></a></li><?php }?>
        <li><a onclick="hidefunc()" href="/treelist"><h4>ต้นไม้ทั้งหมด</h4></a></li>
        <li><a onclick="hidefunc()" href="#444"><h4>ติดต่อ</h4></a></li>

        <li>
            <li class="dropdown">
              <a href="" class="dropdown-toggle" data-toggle="dropdown"><h4><?php echo $_SESSION['login']; ?><?php if($_SESSION['login']!="Guest") {?><span class="caret"></span> <?php }?> </h4></a>       
              <?php if($_SESSION['login']!="Guest") {?><ul style="background-color: #155115;" class="dropdown-menu" role="menu">
                <li><a href="{{ url('profiles/'.$userlogin['_id'])}}" style="font-weight: bold; font-family: 'Kanit', cursive;">ดูโปรไฟล์</a></li>
                <li><a href="{{ url('editprofiles/'.$userlogin['_id'])}}" style="font-weight: bold;font-family: 'Kanit', cursive;">แก้ไขโปรไฟล์</a></li>

                <?php 
                  if($userlogin['position']=="admin"){
                ?>
                  <li><a href="{{ url('/approve')}}" style="font-weight: bold;font-family: 'Kanit', cursive;">จัดการผู้ใช้ทั้งหมด</a></li>

                <?php
                }
                ?>

                <li><a href="user/logout" style="font-weight: bold;font-family: 'Kanit', cursive;">ออกจากระบบ</a></li>
                
              </ul>  <?php }?>              
            </li>             
        </li> <!-- <a onclick="hidefunc()" href="#555">ออกระบบ</a> -->


      </ul>
    </div>
  </div>
</nav>

<!-- .....................................  222    .............................. --><!-- แผนที่ -->
<div id="222" style="width: 100%;  margin-top: 4em;">

  <div id="mapid" ></div>
  <div id="sideid" class="ui raised segment" style="overflow:scroll;">
    <a href="#close" style="color: #000;"><i class="remove icon" id="close"></i></a>
    <hr>
    <h2 id="headpiechart">อัตราความเสี่ยงอันตราย</h2>
    <div align="center" id='piechart'></div>
    <hr>
      <h2>ข้อมูลต้นไม้</h2>
  </div>

</div>
<!-- .....................................  222    .............................. -->


<!-- .....................................  444    .............................. --><!-- ติดต่อ -->

<div id="444" class="navbar navbar-default navbar-fixed-bottom" id="footer">
<br><br>
  <div class="container">
        <div  class="ui centered grid">       
          <div class="one wide column"> 
              <img style="width: 1.5cm; height: 1.5cm; " src="http://www.ku.ac.th/web2012/resources/upload/content/images/edu_kasetsart.jpg">  
          </div>

          <div class="ten wide column"> 
            <h4>จัดทำโดย คณะวิศวกรรมศาสตร์ศรีราชา สาขาวิศวกรรมคอมพิวเตอร์และสารสนเทศศาสตร์</h4>  
            199 หมู่ 6 ถนนสุขุมวิท ตำบลทุ่งสุขลา อำเภอศรีราชา จังหวัดชลบุรี 20230 &nbsp;&nbsp;©2017
          </div>     
        </div>
    </div>
</div>
<!-- .....................................  444    .............................. -->


<!-- Map -->
  <script>

    var mymap = L.map('mapid').setView([13.1192, 100.92066], 16);

    // mymap = bounds[],s
      mymap.setMaxBounds([
          [21.22794, 90.79102],
          [21.30985, 115.00488],
          [3.73271, 90.79102],
          [4.82826, 115.00488]
        ]);
    var countTree=0;
    var arrayGraph = [];

    // L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
      // L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    // L.tileLayer('https://a.tiles.mapbox.com/v3/mi.0ad4304c/{z}/{x}/{y}.png', {
    // L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',{

    L.esri.basemapLayer("Topographic",{
      maxZoom: 20,
      minZoom: 6,
      attribution: 'Develop by MyTreeTeam.'
    }).addTo(mymap);

    

    @foreach ($trees as $tree)
      var totalRisk = 0;
      <?php if ($tree['damageArea']!=NULL): ?>
        <?php foreach ($tree['damageArea'] as $value): ?>
          totalRisk += parseInt({{ $value }});
        <?php endforeach ?>
      <?php else: ?>
        strOfListDamage = "NONE,";
        numberOfDamageArea = "0,";
      <?php endif ?>
      var colorRisk="green";
      var sizePoint=2; // 2 4 6
      if(totalRisk>7){
        colorRisk="red";
      }
      else if(totalRisk>5){
        colorRisk="orange";
      }
      else if(totalRisk<=4){
        colorRisk="green";
      }
      if(parseInt({{ $tree{'Tree_diameter_Trunk'} }}) >=50){
        sizePoint=6;
      }else if(parseInt({{ $tree{'Tree_diameter_Trunk'} }}) >=20){
        sizePoint=4;
      }else if(parseInt({{ $tree{'Tree_diameter_Trunk'} }}) <=15){
        sizePoint=2;
      }
      var marker;
      var circle=L.circle([{{ $tree{'Tree_lat'} }}, {{ $tree{'Tree_long'} }}], sizePoint, {
        color: colorRisk,
        fillColor: colorRisk,
        fillOpacity: 0.3
      }).addTo(mymap).on('mouseover click',function(){
                var detail="<div class='detail'><label>ชื่อต้นไม้</label> : {{ $tree{'Tree_name'} }}<br> <label>ชื่อวิทยาศาสตร์</label> : {{ $tree{'Tree_sci_name'} }}<br><label>ชนิดต้นไม้</label> : {{ $tree{'Tree_type'} }}<br><label>เส้นผ่านศูนย์กลาง</label> : {{ $tree{'Tree_diameter_Trunk'} }} นิ้ว <br><label>ที่อยู่</label> : {{ $tree{'Tree_address'} }}<br><label>พิกัด</label>({{ $tree{'Tree_lat'} }}, {{ $tree{'Tree_long'} }})<br> <label>โดย</label> <a href='/profiles/{{$tree['UserID']}}'>{{$tree['User_name']}}</a><hr><div align='center' class='showPic'><h2>รูปถ่ายต้นไม้</h2></div></div></div>";
                if(marker){
                  marker.remove();
                }
                
                marker=L.marker([{{ $tree{'Tree_lat'} }}, {{ $tree{'Tree_long'} }}]).addTo(mymap);
                
                $(".detail").remove();
                $("#piechart").show();
                $("#headpiechart").show();
                $("#mapid").css({"width": "65%"});
                $("#sideid").css({"display": "inline-block"});
                $("#sideid").append(detail);

                arrayGraph = [['Task', 'the risk per a tree']];
                
                <?php if ($tree['listDamage']!=NULL): ?>
                  <?php for($i=0; $i<sizeof($tree['damageArea']); $i++): ?>
                    var first = "<?php echo $tree['listDamage'][$i]; ?>";
                    arrayGraph.push([first ,parseInt({{ $tree['damageArea'][$i] }})]);
                  <?php endfor ?>
                  drawChart();
                <?php else: ?>
                    $("#piechart").hide();
                    $("#headpiechart").hide();
                    
                <?php endif ?>


                @if($tree['Tree_imgFull']!=NULL)
                  @foreach($tree['Tree_imgFull'] as $imgFull)
                   @if($imgFull !="")
                    $(".showPic").append("<img class='ui large image' src='{{asset('images/uploads/'.$imgFull)}}'><span>เต็มต้น</span><div class='ui divider'></div>");
                   @endif
                  @endforeach
                @endif
                @if($tree['Tree_imgTruck']!=NULL)
                  @foreach($tree['Tree_imgTruck'] as $imgFull)
                    @if($imgFull !="")
                     $(".showPic").append("<img class='ui large image' src='{{asset('images/uploads/'.$imgFull)}}'><span>ลำต้น</span><div class='ui divider'></div>");
                     @endif
                  @endforeach
                @endif
                @if($tree['Tree_imgLeaf']!=NULL)
                  @foreach($tree['Tree_imgLeaf'] as $imgFull)
                    @if($imgFull !="")
                      $(".showPic").append("<img class='ui large image' src='{{asset('images/uploads/'.$imgFull)}}'><span>ใบ</span><div class='ui divider'></div>");
                    @endif
                  @endforeach
                @endif
                @if($tree['Tree_imgTop']!=NULL)
                  @foreach($tree['Tree_imgTop'] as $imgFull)
                    @if($imgFull !="")
                      $(".showPic").append("<img class='ui large image' src='{{asset('images/uploads/'.$imgFull)}}'><span>เรือนยอด</span><div class='ui divider'></div>");
                    @endif
                  @endforeach
                @endif
                @if($tree['Tree_imgRoot']!=NULL)
                  @foreach($tree['Tree_imgRoot'] as $imgFull)
                    @if($imgFull !="")
                      $(".showPic").append("<img class='ui large image' src='{{asset('images/uploads/'.$imgFull)}}'><span>ราก</span><div class='ui divider'></div>");
                    @endif
                  @endforeach
                @endif
            });

      countTree++;
      @endforeach


      L.control.locate({
      drawCircle : false,

      markerStyle : {
        fillOpacity : 1.0,
        color : 'blue',
        stroke : true,
        fillColor : 'blue',
        weight : 3
      },
      // drawMarker : false,
      locateOptions: {
               maxZoom: 18,
               enableHighAccuracy: true
             }
    }).addTo(mymap);


      var contents = [
                    "<h2>สัญลักษณ์ในแผนที่</h2>",
                    "<b>ขนาดของจุดแบ่งตามขนาดเส้นผ่านศูนย์กลาง</b> มี 3 ระดับดังนี้<br>",
                    '<font size="1">•</font><b><font> เล็ก </font></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="3">•</font><b><font> กลาง </font></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="5">•</font><b><font> ใหญ่ </font></b><br>',
                    "<b>สีของจุดแบ่งตามความเสี่ยง</b> มี 3 ระดับดังนี้<br>",
                    '<b><font color="green"> ปลอดภัย </font></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font color="orange"> เสี่ยง </font></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font color="red"> อันตราย </font></b><br>',
                    '<font size="6" color="blue">•</font> ตำแหน่งของคุณ<br>',
                    '<b>จำนวนต้นไม้ : <font id="countTree"></font> ต้น</b><br>',
                    "<a style='float:left;' onclick='dialog.freeze()'><font size='4' color='gray'><i class='lock icon'></i></font></a>",
                    "<a style='float:right;' onclick='dialog.unfreeze()'><font size='4' color='gray'><i class='unlock alternate icon'></i></font></a>",
                    ].join('');


      var dialog = L.control.dialog()
              .setContent(contents)
              .addTo(mymap);
    dialog.setSize( [ 700, 700 ] );
    dialog.freeze();
    dialog.setLocation( [ 2,50 ] ); 
      
    document.getElementById('countTree').innerHTML=countTree;
    var popup = L.popup();
    var lat="";
    var lng="";




      L.control.custom({
      position: 'topleft',
      content : '<button id="desbut" type="button" style="border-style:solid; border-color:#BEBEBE; border-width: 2px;" class="btn btn-default">'+
                '    <font size="4"><i class="fa fa-question"></i></font>'+
                '</button>',
      classes : 'btn-group-vertical btn-group-sm',
      style   :
      {
          margin: '10px',
          padding: '0px 0 0 0',
          cursor: 'pointer',
      },
  }).addTo(mymap);


    $('#desbut').click(function(data){
              dialog.open();
              dialog.setSize( [ 700, 700 ] );
              dialog.freeze();
              dialog.setLocation( [ 2,50 ] );
      });


    var SearchButton = ["<div class='ui search' style='float: right;'>","<div class='ui icon input'>","<input id='SearchThai' data-token='{{ csrf_token() }}' class='prompt' type='text' placeholder='ค้นหา...' style='width: 20em;'>","<i class='search icon'></i>","</div><div class='results'></div></div>",
                    ].join('');

    var dialogSearch = L.control.dialog()
              .setContent(SearchButton)
              .addTo(mymap);
      dialogSearch.setSize( [ 270, 100 ] );
      dialogSearch.freeze();
      dialogSearch.setLocation( [ 2,500 ] );
      dialogSearch.close();

      $('#searchbut').click(function(data){
        dialogSearch.open();
        dialogSearch.setSize( [ 270, 100 ] );
      dialogSearch.freeze();
      dialogSearch.setLocation( [ 2,500 ] );
      });
      

    function onMapClick(e) {
      popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString() + "<br><a href='#333' onclick='fillLocation();'>รับพิกัดนี้</a>")
        .openOn(mymap);
        lat=e.latlng.lat;
        lng=e.latlng.lng;
        $(".detail").remove();
        $("#sideid").css({"display": "none"});
      $("#mapid").css({"width": "100%"});

    
    }

   
          // Load google charts
      
    function fillLocation(e){
        window.location.href="form/"+lat+"/"+lng;
    }
    mymap.on('contextmenu', onMapClick);
    // mymap.dragging.disable();

  
  // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
      var data = google.visualization.arrayToDataTable(arrayGraph);

      // Optional; add a title and set the width and height of the chart
      var options = {
        'title':'', 
        'width':300, 
        'height':300,
        'chartArea': {'width': '100%', 'height': '80%'},
        'legend': {'position': 'bottom'}
        };

      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }

    $(document).on('click','.remove.icon',function() {
        $("#sideid").css({"display": "none"});
        $("#mapid").css({"width": "100%"});
    });
  </script>


@stop


        