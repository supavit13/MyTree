@extends('layout')

@section('content')


<?php 
    $_SESSION['login']=$login_name;
?>

<nav class='navbar navbar-default navbar-fixed-top' style='background-color:#155115;'>
  <div class='container'>
    <div class='navbar-header'>

      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar' style='background-color:#155115;'>
        <span > Menu </span>
      </button>
      <a class='navbar-brand' href='{{ url('/backhome1') }}'>MY TREE Thailand</a>
    </div>
    <div class='collapse navbar-collapse' id='myNavbar' >
      <ul class='nav navbar-nav navbar-right'>
        <li><a onclick='hidefunc()' href='{{ url('gohome')}}'><h4>แผนที่</h4></a></li>
        <?php if($_SESSION['login']!='Guest') {?><li><a onclick='hidefunc()' href='{{ route('add_form')}}'><h4>เพิ่มต้นไม้</h4></a></li><?php }?>
        <li><a onclick='hidefunc()' href='{{ url('treelist')}}'><h4>ต้นไม้ทั้งหมด</h4></a></li>
        <li><a onclick='hidefunc()' href='{{ url('gohome')}}'><h4>ติดต่อ</h4></a></li>

        <li>
            <li class='dropdown'>
              <a href=' class='dropdown-toggle' data-toggle='dropdown'><h4><?php echo $_SESSION['login']; ?><?php if($_SESSION['login']!='Guest') {?><span class='caret'></span> <?php }?> </h4></a>       
              <?php if($_SESSION['login']!='Guest') {?><ul style='background-color: #155115;' class='dropdown-menu' role='menu'>
                <li><a href='{{ url('profiles/'.$userlogin['_id'])}}' style='font-weight: bold; font-family: 'Kanit', cursive;'>ดูโปรไฟล์</a></li>
                <li><a href='{{ url('editprofiles/'.$userlogin['_id'])}}' style='font-weight: bold;font-family: 'Kanit', cursive;'>แก้ไขโปรไฟล์</a></li>

                <?php 
                  if($userlogin['position']=='admin'){


                ?>
                  <li><a href='{{ url('/approve')}}' style='font-weight: bold;font-family: 'Kanit', cursive;'>จัดการผู้ใช้ทั้งหมด</a></li>

                <?php
                }
                ?>

                <li><a href='{{ url('user/logout')}}' style='font-weight: bold;font-family: 'Kanit', cursive;'>ออกจากระบบ</a></li>
                
              </ul>  <?php }?>              
            </li>             
        </li> <!-- <a onclick='hidefunc()' href='#555'>ออกระบบ</a> -->


      </ul>
    </div>
  </div>
</nav>
<h1></h1>
<h1 style='margin-top: 5%; margin-bottom: 3%; font-size: 370%; color: black; text-shadow: 2px 2px back; text-align: center;'>{{$img['Tree_name']}}</h1>

<div class='container' style='width: 60%' align='center'>
  <table>
    <tr>
      <td>
        <label>ชื่อวิทยาศาสตร์ : </label><span>{{$img['Tree_sci_name']}}</span>
      </td>
    </tr>
    <tr>
      <td>
        <label>ชนิดต้นไม้ : </label><span>{{$img['Tree_type']}}</span>
      </td>
    </tr>
    <tr>
      <td>
        <label>เส้นผ่านศูนย์กลาง : </label><span>{{$img['Tree_diameter_Trunk']}} ซม.</span>
      </td>
    </tr>
    <tr>
      <td>
        <label>ที่อยู่ : </label><span>{{$img['Tree_address']}}</span>
      </td>
    </tr>
    <tr>
      <td>
        <label>พิกัด(LatLng) : </label><span>{{$img['Tree_lat']}}, {{$img['Tree_long']}}</span>
      </td>
    </tr>
    <tr>
      <td>
        <label>สำรวจโดย : </label><span><a href='/profiles/{{$users['_id']}}'>{{$users['username']}}</a></span>
      </td>
    </tr>
    

  </table>
    
    
</div>
<hr>
<div class='container' style='width: 70%'>
  
  <div class='row'>
      <div id='accordion' class='panel-group'>
        <div class='panel panel-default'>
          <center> <div  class='panel-collapse collapse in' id='panel-1'>
            <div class='panel-body'>
              <h1>รูปถ่ายต้นไม้</h1>
              <div class='ui divider'></div>
              @if($img['Tree_imgFull']!=NULL)
                @foreach($img['Tree_imgFull'] as $imgFull)
                  <img class='ui large image' src='{{asset('images/uploads/'.$imgFull)}}'>
                @endforeach
              @endif
              <span>เต็มต้น</span>
              <div class='ui divider'></div>
              @if($img['Tree_imgTruck']!=NULL)
                @foreach($img['Tree_imgTruck'] as $imgTruck)
                  <img class='ui large image' src='{{asset('images/uploads/'.$imgTruck)}}'>
                @endforeach
              @endif
              <span>ลำต้น</span>
              <div class='ui divider'></div>
              @if($img['Tree_imgLeaf']!=NULL)
                @foreach($img['Tree_imgLeaf'] as $imgLeaf)
                  <img class='ui large image' src='{{asset('images/uploads/'.$imgLeaf)}}'>
                @endforeach
              @endif
              <span>ใบ</span>
              <div class='ui divider'></div>
              @if($img['Tree_imgTop']!=NULL)
                @foreach($img['Tree_imgTop'] as $imgTop)
                  <img class='ui large image' src='{{asset('images/uploads/'.$imgTop)}}'>
                @endforeach
              @endif
              <span>เรือนยอด</span>
              <div class='ui divider'></div>
              @if($img['Tree_imgRoot']!=NULL)
                @foreach($img['Tree_imgRoot'] as $imgRoot)
                  <img class='ui large image' src='{{asset('images/uploads/'.$imgRoot)}}'>
                @endforeach
              @endif
              <span>ราก</span>
              <div class='ui divider'></div>
              
              
            </center>
        
            
              
            </div>
          </div>
        </div>

  
  <h4></h4>
</div>

@stop