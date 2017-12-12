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
        <li><a onclick="hidefunc()" href="{{ url('gohome')}}"><h4>แผนที่</h4></a></li>
        <?php if($_SESSION['login']!="Guest") {?><li><a onclick="hidefunc()" href="{{ route('add_form')}}"><h4>เพิ่มต้นไม้</h4></a></li><?php }?>
        <li><a onclick="hidefunc()" href="{{ url('treelist')}}"><h4>ต้นไม้ทั้งหมด</h4></a></li>
        <li><a onclick="hidefunc()" href="{{ url('gohome')}}"><h4>ติดต่อ</h4></a></li>

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

                <li><a href="{{ url('user/logout')}}" style="font-weight: bold;font-family: 'Kanit', cursive;">ออกจากระบบ</a></li>
                
              </ul>  <?php }?>              
            </li>             
        </li> <!-- <a onclick="hidefunc()" href="#555">ออกระบบ</a> -->


      </ul>
    </div>
  </div>
</nav>

<br><br><br><br><br><br>

<div class="ui grid centered">
<section class="fourteen wide column">



<div class="ui attached message">
  <div>
    <h1>แก้ไขข้อมูลส่วนตัว</h1>
  </div>
  <!-- <p>Fill out the form below to sign-up for a new account</p> -->
</div>

<form class="ui form attached fluid segment" action="{{ url('saveProfile') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('คุณต้องการบันทึกข้อมูลบัญชีของคุณใช่หรือไม่?');">
{{ csrf_field() }}

  <center><div>
    <div class="eight wide column">
      <?php
        if($userlogin['photo']==NULL){
      ?>
          <img id="picProfiles" class="ui medium image" src="{{asset('images/profiles/profile-none.jpg')}}">
      <?php
        }else{
      ?>
          <img id="picProfiles" class="ui medium image" src="{{asset('images/profiles/'.$userlogin['photo'])}}">
      <?php
        }
      ?>
    </div>
    <br>
    <div class="eight wide column">
      <div class="ui  button" onclick="document.getElementById('selectedFile').click();">อัพโหลดรูปภาพโปรไฟล์<input type="file" id="selectedFile" accept="image/*" name="picprofile" capture="camera" style="display: none;"></div>
    </div>

  </div></center>

  <br><br>
  <div class="two fields">
    <div class="field">
      <label>ชื่อ-นามสกุล</label>
      <input placeholder="ชื่อ-นามสกุล" type="text" name="username" value="{{ $userlogin['username'] }}" >
    </div>
    <div class="field">
      <label>อีเมล</label>
      <input placeholder="อีเมล" type="text" name="email" value="{{ $userlogin['email'] }}">
    </div>
  </div>

  <div class="two fields">
    <div class="field">
      <label>เบอร์โทรศัพท์</label>
      <input placeholder="เบอร์โทรศัพท์" type="number" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" name="phone" value="{{ $userlogin['phone'] }}">
    </div>
    <div class="field">
      <label>ยืนยันรหัสผ่าน</label>
      <input placeholder="รหัสผ่าน" type="password" name="password">
    </div>
  </div>
<div class="two fields">
  <div class="field">
    <label>หน่วยงาน</label>
    <input placeholder="สังกัด/หน่วยงาน" type="text" name="department" value="{{ $userlogin['department'] }}">
  </div>
  <div class="field">
    <label>รหัสผ่านใหม่</label>
    <input placeholder="รหัสผ่าน" type="password" name="newPassword" >
  </div>
</div>
<div class="two fields">
  <div class="field">
    <label>แผนก</label>
    <input placeholder="แผนก" type="text" name="rank" value="{{ $userlogin['rank'] }}">
  </div>
  <div class="field">
    <label>ยืนยันรหัสผ่านใหม่</label>
    <input placeholder="รหัสผ่าน" type="password" name="ConfirmNewPassword">
  </div>
</div>

  
  <center><div class="ui blue button" onclick="document.getElementById('submit').click();">บันทึก<input id="submit" type="submit" name="" style="display: none;"></div></center>
</form>

<!-- </div> -->
</section>
</div>



@stop