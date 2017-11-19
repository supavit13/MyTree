@extends('layout')

@section('content')


<?php 
    $_SESSION['login']=$login_name;
?>
@if(Session::has('message')) 
  <script type="text/javascript">
    alert('<?php echo Session::get('message'); ?>');
  </script>
@endif
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
<input class="form-control" id="myInput" type="text" placeholder="ค้นหา..">
<table class="ui celled padded table">
  	<thead>
	    <tr>
	    	<th>ชื่อ-นามสกุล</th>
		    <th>อีเมล</th>
		    <th>เบอร์โทรศัพท์</th>
		    <th>การตรวจสอบ</th>
		    <th>สถานะผู้ดูแล</th>
		    <th>ลบบัญชี</th>
	  	</tr>
	</thead>
  	<tbody id="myTable">
  		@foreach($users as $user)
	    <tr>
	      <td><a href="/profiles/{{$user['_id']}}">{{$user['username']}}</a></td>
	       
	      <td>{{$user['email']}}</td>
	      
	      <td>{{$user['phone']}}</td>

	      <td><?php 
					if($user['approve']==0){
						?>	
							<form action="{{ url('manageUser') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('คุณต้องการอนุมัติบัญชีผู้ใช้นี้ใช่หรือไม่?');">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{$user['_id']}}">
								<input type="hidden" name="approve" value="{{$user['approve']}}">
								<button class="ui red button" type="submit" name="submit" value="approve" >รอการตรวจสอบ</button>
							</form>
							
						<?php
					}else{
						?>	
							<form action="{{ url('manageUser') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('คุณต้องการถอนการอนุมัติบัญชีผู้ใช้นี้ใช่หรือไม่?');">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{$user['_id']}}">
								<input type="hidden" name="approve" value="{{$user['approve']}}">
								<button class="ui green button" type="submit" name="submit" value="approve">ตรวจสอบแล้ว</button>
							</form>
							
						<?php
					}
				?>
			</td>
			<td>
				<form action="{{ url('manageUser') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('คุณต้องการเปลี่ยนแปลงสถานภาพบัญชีผู้ใช้นี้ใช่หรือไม่?');">
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{{$user['_id']}}">
					<?php
						if($user['position']=="admin"){
							?>
								<button type="submit" name="submit" value="user" style=" outline:none; background-color: Transparent; border: none;"><i class="toggle on icon" style="color: black;font-size:3em;"></i></button>
								<!-- <button class="ui green button" type="submit" name="submit" value="admin"></button>
								<button class="ui gray button" type="submit" name="submit" value="user">user</button> -->
							<?php
						}else{
							?>
								<button type="submit" name="submit" value="admin" style="outline:none; background-color: Transparent; border: none;"><i class="toggle off icon" style="color: black;font-size:3em;"></i></button>
							<?php
						}
					?>
				</form>
			</td>
			<td>
				<form action="{{ url('manageUser') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('คุณต้องการลบบัญชีผู้ใช้นี้ถาวรใช่หรือไม่?');">
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{{$user['_id']}}">
					<button class="ui red button" type="submit" name="submit" value="delete">ลบ</button>
				</form>
			</td>
	    </tr>

		@endforeach
  	</tbody>
</table>

</section>
</div>
<script type="text/javascript">
	$(document).ready(function(){
	  $("#myInput").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#myTable tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });
	});
</script>



@stop