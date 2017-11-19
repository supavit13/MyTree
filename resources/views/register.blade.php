@extends('layout')

@section('content')


  

<nav class="navbar navbar-default navbar-fixed-top" style="background-color:#155115;">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ url('/')}}">MY TREE Thailand</a>
    </div>
    
  </div>
</nav>


<h1 style="margin-top: 5%; margin-bottom: 3%; font-size: 370%; color: black; text-shadow: 2px 2px back; text-align: center;">สมัครสมาชิก </h1>
<form class="ui form attached fluid segment" action="{{ url('createUser') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('คุณต้องการบันทึกข้อมูลบัญชีของคุณใช่หรือไม่?');">
{{ csrf_field() }}
<div class="container" style="width: 70%;">
  
  <div class="row">
      <div id="accordion" class="panel-group">
        <div class="panel panel-default">
          
          <div  class="panel-collapse collapse in" id="panel-1">
            <div class="panel-body">
                <form class="ui form">
                  <div class="field" id="divName">
                    <label>ชื่อ-นามสกุล</label>
                    <input type="text" name="name" id="name" placeholder="ชื่อ-นามสกุล" value="<?php if($userlogin!='Guest'){ echo $userlogin->name; } ?>" required="">
                  </div>
                 
                  <div class="field">
                    <label>เบอร์โทรศัพท์</label>
                    <input type="number" name="phone" placeholder="000-9999999" required="">
                  </div>

                  <div class="field">
                    <label>สังกัด</label>
                    <input type="text" name="department" placeholder="สังกัด" required="">
                  </div>

                  <div class="field">
                    <label>ตำแหน่ง/แผนก</label>
                    <input type="text" name="rank" placeholder="ตำแหน่ง/แผนก" required="">
                  </div>

                  <div class="field" id="divEmail">
                    <label>อีเมล</label>
                    <input type="text" name="email" id="email" placeholder="example@gmail.com" value="<?php if($userlogin!='Guest'){ echo $userlogin->email; } ?>" required="">
                  </div>

                  <div class="field">
                    <label>รหัสผ่าน</label>
                    <input type="password" name="password" id="password" placeholder="ไม่น้อยกว่า8ตัว" required="">
                  </div>

                  <div class="field" id="divPass">
                    <label>ยืนยันรหัสผ่าน</label>
                    <input type="password" name="confirmPassword" id="conpwd" required="">
                  </div>

                  <div align="center" >
                    <center id="divSubmit">
                      <button class='ui blue button' id='submit' type='submit'>บันทึก</button>
                    </center>
                  </div>
                  
                  
                </form>



              
            </div>
          </div>
        </div>
        

  
  <h4></h4>
</div>
</form>







@stop