@extends('layout')

@section('content')

<div id="222" style=" width: 100%; margin-top: auto;"><!-- 222 --> 
<center>
<h2 class="ui image center aligned header">
  <img src="{{asset('logoblack.png')}}" style="width: 20em; ">
</h2>
</center>

</div><!-- 222 -->


<div>
  <center>
    <a href="{{route('go_home')}}"><button class="ui green button">หน้าหลัก</button></a>
    <button class="ui primary button" id="signin_forever">เข้าสู่ระบบ</button>
  </center>

</div>



<script>
      $("#signin_forever").click(function(event){
          event.preventDefault();
          $("#333").css("display", "block");
      });

</script> 
 



<div id="333" style="display: none; margin-top: 1em;"><!--  333  -->

  <center>
          <br><a href="{{ url('auth/login/facebook') }}" class="ui facebook button" ><i class="facebook icon"></i>เข้าสู่ระบบโดย Facebook</a>
          <div class="column" style="width: 10%; height: 0.1cm;"></div>
          <a href="{{ url('auth/login/google') }}" class="ui google plus button"><i class="mail icon"></i>เข้าสู่ระบบโดย G-Mail</a>
          <br><a style="color:gray;">-------------------or-------------------</a></br> 
          <form action="{{ url('auth/login/mytree') }}" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="email" placeholder="ที่อยู่อีเมล">
          </div>
          <div class="column" style="width: 10%; height: 0.2cm;"></div>
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" placeholder="รหัสผ่าน">
          </div>
          <div class="column" style="width: 10%; height: 0.2cm;"></div>
          <button type="submit" class="ui fluid large teal submit button" style="width: 35%;">เข้าสู่ระบบ</button>
          </form>
          <div class="column" style="width: 10%; height: 0.2cm;"></div>
          <div > คุณเป็นสมาชิกหรือยัง <a href="{{ route('regist') }}" >สมัครสมาชิก</a></div>

                 
  </center>



</div>

  <div class="navbar-fixed-bottom" id="footer" style="width: 100%; background-color: #e6ffee;">
        <div  class="ui centered grid">       
          <div class="one wide column"> 
              <img style="width: 1.5cm; height: 1.5cm; " src="http://www.ku.ac.th/web2012/resources/upload/content/images/edu_kasetsart.jpg">  
          </div>

          <div class="ten wide column"> 
            <h4>จัดทำโดย คณะวิศวกรรมศาสตร์ศรีราชา สาขาวิศวกรรมคอมพิวเตอร์และสารสนเทศศาสตร์</h4>  
            <p>199 หมู่ 6 ถนนสุขุมวิท ตำบลทุ่งสุขลา อำเภอศรีราชา จังหวัดชลบุรี 20230 &nbsp;&nbsp;©2017</p>
          </div>     
        </div>
  </div>

@stop
