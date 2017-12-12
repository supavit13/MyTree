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
<section class="nine wide column">


<div class="ui raised segments">
  <div style="background-color: #8cd9b3;" class="ui segment">
    <h1>ข้อมูลผู้ใช้</h1>
  </div>
  	<br>
  	<center><div class="ui card">
	  	<a class="image" href="#">
	  		<?php
				if($users['photo']==NULL){
			?>
					<img src="{{asset('images/profiles/profile-none.jpg')}}">
			<?php
				}else{
			?>
					<img src="{{asset('images/profiles/'.$users['photo'])}}">
			<?php
				}
			?>
	    	
	  	</a>
	</div></center> <br><br>



	<center>

	<table style="height: 50%; ">
		<tbody >
			<tr >
				<td style="font-weight: bold;">ชื่อ-นามสกุล</td>
				<td style="width: 10%;">:</td>
				<td>{{ $users['username'] }}</td>
			</tr>
			<tr>
				<td style="font-weight: bold;">เบอร์โทรศัพท์</td>
				<td>:</td>
				<td>{{ $users['phone'] }}</td>
			</tr>
			<tr>
				<td style="font-weight: bold;">อีเมล</td>
				<td>:</td>
				<td>{{ $users['email'] }}</td>
			</tr>
			<tr>
				<td style="font-weight: bold;">สถานะ</td>
				<td>:</td>
				<td>{{ $users['position'] }}</td>
			</tr>
			<tr>
				<td style="font-weight: bold;">การอัพเดตล่าสุด</td>
				<td>:</td>
				<td>{{ $users['updated_at'] }}</td>
			</tr>
			<tr>
				<td style="font-weight: bold;">การตรวจสอบ</td>
				<td>:</td>
				<td>
					<?php if($users['approve']==1){
						echo "ตรวจสอบแล้ว";
					}else{
						echo "รอการตรวจสอบ";
					} ?>
						
				</td>
			</tr>
		</tbody>
	</table>	
  	</center><br><br>


  <div  class="ui segment">
  		<center><div class="ui blue button" onclick="window.location='/gohome'">ปิด</div></center>
  </div>
</div>


</section>
</div>


@stop