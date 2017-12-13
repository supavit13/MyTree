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
<!-- <div style="width: 80%;"> -->
	<input class="form-control" id="myInput" type="text" placeholder="ค้นหา..">

	<table class="ui celled padded table">
		<thead>
			<tr>
				<th>ชื่อต้นไม้</th>
				<th>ที่อยู่ต้นไม้</th>
				<th>ผู้ตรวจสอบ</th>
				<th>วันที่บันทึก</th>
				<?php
						if($_SESSION['login']!="Guest"){
							?>
							<th>แก้ไขรายละเอียด</th>
							<th>การพิมพ์เอกสาร</th>
							<th>ลบต้นไม้</th>
							<?php
						}
					?>
				
				
			</tr>
		</thead>
		<tbody id="myTable">
			@foreach($trees as $tree)
				<?php
				$UTC = new DateTimeZone("UTC");
				$newTZ = new DateTimeZone("Asia/Bangkok");
				$date = new DateTime($tree['updated_at'], $UTC );
				$date->setTimezone( $newTZ ); ?>
				<tr>
					<td><a href="/detail/{{$tree['_id']}}">{{$tree['Tree_name']}}</a></td>
					<td>{{$tree['Tree_address']}}</td>
					<td><a href="/profiles/{{$tree['UserID']}}">{{$tree['User_name']}}</a></td>
					
					<td><?php echo $date->format('Y'); ?></td>
					<?php
						if($_SESSION['login']!="Guest"){
							?>
							<td><a href="/editdetail/{{$tree['_id']}}" id="editbutton" class="ui green button">แก้ไข</a></td>
							<td><button class="ui blue button" onclick="printDocs('/print/{{$tree['_id']}}')">สั่งพิมพ์</button></td>
							<td>
								<form action="{{ url('treedel') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('คุณต้องการลบข้อมูลต้นไม้นี้ถาวรใช่หรือไม่?');">{{ csrf_field() }}
									<button class="ui red button" type="submit" name="submit" value="delete">ลบ</button>
									<input type="hidden" name="id" value="{{$tree['_id']}}">
								</form>
								
							</td>
							<?php
						}
					?>
					
					
				</tr>
			@endforeach
		</tbody>
		
		
	</table>

</section>
</div>
<script type="text/javascript">
	function printDocs(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
}
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