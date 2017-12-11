@extends('layout')

@section('content')



<?php 
    $_SESSION['login']=$login_name;
?>
<?php 
if(!empty($trees)){
  $tree=$trees;
  $update=1;
}else{
  $tree=NULL;
  $update=0;
}
function getData($tree,$type='',$name='',$var=NULL){
  if(empty($tree)){
    return NULL;
  }
  else if($type=='text'){
    echo $tree[$name];
  }
  else if($type=='checkbox' && $tree[$name]=='on'){
    echo "checked=''";
  }else if($type=='select' && $tree[$name]==$var && $var != NULL){
    echo "selected=''";
  }else if($type=='radio' && $tree[$name]==$var && $var !=NULL){
    echo "checked=''";
  }
}
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
<br><br><br><br>

<form action="{{ route('tree.store')}}" method="post" id="theForm" enctype="multipart/form-data" onsubmit="return confirm('คุณต้องการบันทึกข้อมูลใช่หรือไม่?');">{{ csrf_field() }}
<div class="container" >
  <?php  
    if($update==1){
      echo "<input type='hidden' name='update' value='1'>";
      echo "<input type='hidden' name='id' value='".$tree['_id']."'>";
    }
  ?>
  <div class="row" >
      <div id="accordion" class="panel-group">
        

<!--- - - - - - - - - -    1  แบบประเมินความเสี่ยงอันตรายจากต้นไม้เบื้องต้น - - - - - - - - - -  -->

        <div class="panel panel-default">
          <div style="background-color:#adebad; padding:1em; color:black;">
            <h4 class="panel-title">
              <i class="Leaf icon" ></i>
              <a href="#panel-1" data-parent="#accordion" data-toggle="collapse" >แบบประเมินความเสี่ยงอันตรายจากต้นไม้เบื้องต้น</a>
            </h4>
          </div>
          <div class="panel-collapse collapse" id="panel-1">
            <div class="panel-body">

                <div class="ui grid">

                 <div class="eight wide column">
                    <span>เจ้าของพื้นที่</span>
                    <input  type="text"  class="form-control input-md" name="ownerarea" value="<?php getData($tree,'text','ownerarea'); ?>">
                  </div>

                  <div class="eight wide column">
                    <span>ที่อยู่</span>
                    <input type="text" value="<?php getData($tree,'text','Tree_address'); ?>" class="form-control" name="Tree_address" >
                  </div>

                  <!-- <div class="eight wide column">
                    <span>ผู้ว่าจ้าง</span>
                    <input  type="text" name="hire" value="<?php getData($tree,'text','hire'); ?>" class="form-control" >
                  </div> -->

                  <div class="three wide column">
                    <span>วันที่</span>
                      <input type="date" value="<?php getData($tree,'text','Tree_date'); ?>" class="form-control" name="Tree_date" min="1990-01-02">
                  </div>

                  <div class="three wide column">
                    <span>เวลา</span>
                    <input class="form-control" type="text" value="<?php getData($tree,'text','Tree_time'); ?>" name="Tree_time" id="example-time-input" > 
                  </div>


                  <div class="two wide column">
                    <span>ต้นที่</span>
                    <input id="Tree_sequence" type="number" min="1" value="<?php getData($tree,'text','Tree_sequence'); ?>" class="form-control anti-Minus" name="Tree_sequence" >
                  </div>

                  <div class="three wide column">
                    <span>พิกัดละติจูด</span>
                    <input id="Tree_lat" type="number" min="0" step="0.000001" value="<?php if(!empty($lat)){ echo $lat; }else { getData($tree,'text','Tree_lat'); } ?>" class="form-control anti-Minus" name="Tree_lat" required>
                  </div>

                  <div class="three wide column">
                    <span>พิกัดลองจิจูด</span>
                    <input id="Tree_long" type="number" min="0" step="0.000001" value="<?php if(!empty($lng)){ echo $lng; }else { getData($tree,'text','Tree_long'); } ?>" class="form-control anti-Minus" name="Tree_long" required>
                  </div>

                  <div class="two wide column">
                    <br>
                    <button type="button" onclick="getLocation();" class="btn btn-primary">ค้นหาพิกัด</button>
                  </div> 


                  <div class="five wide column">
                    <span>ชนิด</span>
                    <input id="TreeName" type="text" value="<?php getData($tree,'text','Tree_name'); ?>" class="form-control" name="Tree_name" required>
                  </div>

                  <div class="five wide column">
                    <span>ชื่อวิทยาศาสตร์</span>
                    <input id="sciName" type="text" value="<?php getData($tree,'text','Tree_sci_name'); ?>" class="form-control" name="Tree_sci_name" >
                  </div>

                  <div class="five wide column">
                    <span>เส้นผ่านศูนย์กลางเพียงอก (ซม.)</span>
                    <input id="Tree_diameter_Trunk" type="number" min="0" step="0.01" value="<?php getData($tree,'text','Tree_diameter_Trunk'); ?>" class="form-control anti-Minus" name="Tree_diameter_Trunk" required>
                    <span id="miss_diameter_trunk" style="color: red;"></span>
                  </div>

                  <div class="five wide column">
                    <span>ความสูงทั้งหมด (ม.)</span>
                    <input id="Tree_height" type="number" min="0" step="0.01" value="<?php getData($tree,'text','Tree_height'); ?>" class="form-control anti-Minus" name="Tree_height" >
                  </div>

                  <div class="five wide column">
                    <span>เส้นผ่านศูนย์กลางเรือนยอด (ม.)</span>
                    <input id="Tree_diameter_Top" type="number" min="0" step="0.01" value="<?php getData($tree,'text','Tree_diameter_Top'); ?>" class="form-control anti-Minus" name="Tree_diameter_Top" >
                    
                  </div>

                  <div class="five wide column">
                    <span>ผู้ประเมิน</span>
                    <input type="text" value="<?php echo $userlogin['username'] ?>" class="form-control" name="User_name" required>
                    <input type="hidden" name="UserID" value="<?php echo $userlogin['_id'] ?>">
                  </div>

                  <div class="five wide column">
                    <span>หน่วยงาน</span>
                    <input type="text" value="<?php echo $userlogin['department'] ?>" class="form-control" name="agency" >
                  </div>

                 <div class="five wide column">
                    <span>โทรศัพท์</span>
                    <input  type="text"  class="form-control input-md" value="<?php echo $userlogin['phone'] ?>" name="Tree_phone" required>
                  </div>

             

                  <script type="text/javascript">
       
                      $(document).on('change', '#TreeName', function() {
                        var $Tname = document.getElementById("TreeName").value;
                        $.ajax({
                          type: 'post',
                          url: '/sci_search',
                          data: {
                            '_token': $('input[name=_token]').val(),
                            'id': $Tname
                          },
                          success: function(data) {
                            
                            // alert(data['Botanical_Name']);
                            document.getElementById("sciName").value = data['Botanical_Name'];
                            document.getElementById("Ttype").value = data['Family_Name'];
                            // console.log(data);
                            // alert('ยืนยันสำเร็จ');
                            // location.reload();
                          }
                        })
                      });
                      $(document).on('change',".anti-Minus",function(){
                        if(document.getElementById("Tree_sequence").value<0){
                          document.getElementById("Tree_sequence").value=0;
                        }
                        if(document.getElementById("Tree_lat").value<0){
                          document.getElementById("Tree_lat").value=0;
                        }
                        if(document.getElementById("Tree_long").value<0){
                          document.getElementById("Tree_long").value=0;
                        }
                        if(document.getElementById("Tree_diameter_Trunk").value<0){
                          document.getElementById("Tree_diameter_Trunk").value=0;
                        }
                        if(document.getElementById("Tree_diameter_Top").value<0){
                          document.getElementById("Tree_diameter_Top").value=0;
                        }
                        if(document.getElementById("Tree_height").value<0){
                          document.getElementById("Tree_height").value=0;
                        }
                      });
                    </script>           


                </div>

                </div>
     
            </div>
          </div>
        </div>

       
        


<!--- - - - - - - - - -    2  การประเมินความเสียหายที่จะเกิดขึ้นกับเป้าหมาย - - - - - - - - - -  -->


        <div class="panel panel-default">
          <div style="background-color:#adebad; padding:1em; color:black;">
            <h4 class="panel-title">
              <i class="Street View icon" ></i>
              <a href="#panel-2" data-parent="#accordion" data-toggle="collapse">การประเมินความเสียหายที่จะเกิดขึ้นกับเป้าหมาย</a>
            </h4>
          </div>
          
          <div class="panel-collapse collapse" id="panel-2">
            <div class="panel-body">
              <button class="ui green button" id="add_table">เพิ่ม</button>
                <table class="ui basic celled structured table" id="table_damage">
                  <thead>
                  <tr>
           
                    <th rowspan="2" style="width: 1em;">ลำดับ</th>
                    <th rowspan="2">เป้าหมายของความเสียหาย</th>
                    <th rowspan="2">มาตรการป้องกันเป้าหมาย</th>
                    <th colspan="3">บริเวณที่อาจเกิดความเสียหาย</th>
                    <th rowspan="2">การปรากฎอยู่ของเป้าหมาย</th>
                    <th rowspan="2">การเคลือนย้าย</th>
                    <th rowspan="2">การกันพื้นที่</th>
                    <th rowspan="2"></th>
                  </tr>
                  <tr>
                    <th id="five_per">ใต้เรือนยอด</th>
                    <th id="five_per">1 เท่าของความสูง</th>
                    <th id="five_per">1.5เท่าของความสูง</th>
                  </tr>
                  </thead>
                <tbody>
                  <?php  
                    if($tree!=NULL && $tree['listDamage']!=NULL){
                      $i=0;
                        foreach ($tree['listDamage'] as $value) {
                      ?>

                  <tr>
                    <td>
                      <input class="hideme" id="tree_num" type="text" value="<?php echo $i+1; ?>">
                    </td>
                    <td><input class="form-control" type="text" name="listDamage[<?php echo $i; ?>]" value="<?php echo $tree['listDamage'][$i]; ?>">
                    </td>
                    <td>
                      <center>
                        <select class="ui dropdown" name="protectTarget[<?php echo $i; ?>]">
                          <option type="hidden">เลือก</option>
                          <option value="1" <?php if($tree['protectTarget'][$i]=="1"){ echo "selected=''";}?>>มี</option>
                          <option value="2" <?php if($tree['protectTarget'][$i]=="2"){ echo "selected=''";}?>>ไม่มี</option>
                        </select>
                      </center>
                    </td>
                    <td>
                      <input type="hidden" name="ch1[<?php echo $i; ?>]" value="off">
                      <input class="form-control" type="checkbox" name="ch1[<?php echo $i; ?>]" <?php if($tree['ch1'][$i]=="on"){ echo "checked=''";}?>>
                    </td>
                    <td>
                      <input type="hidden" name="ch2[<?php echo $i; ?>]" value="off">
                      <input class="form-control" type="checkbox" name="ch2[<?php echo $i; ?>]" <?php if($tree['ch2'][$i]=="on"){ echo "checked=''";}?>>
                    </td>
                    <td>
                      <input type="hidden" name="ch3[<?php echo $i; ?>]" value="off">
                      <input class="form-control" type="checkbox" name="ch3[<?php echo $i; ?>]" <?php if($tree['ch3'][$i]=="on"){ echo "checked=''";}?>>
                    </td>



                    <td>
                      <center><select class="ui dropdown" name="damageArea[<?php echo $i; ?>]">
                        <option type="hidden">เลือก</option>
                        <option value="1" <?php if($tree['damageArea'][$i]=="1"){ echo "selected=''";}?>>1-ไม่ค่อยปรากฎ</option>
                        <option value="2" <?php if($tree['damageArea'][$i]=="2"){ echo "selected=''";}?>>2-อยู่เป็นบางครั้ง</option>
                        <option value="3" <?php if($tree['damageArea'][$i]=="3"){ echo "selected=''";}?>>3-ค่อนข้างบ่อย</option>
                        <option value="4" <?php if($tree['damageArea'][$i]=="4"){ echo "selected=''";}?>>4-อยู่ตลอด</option>
                      </select></center>
                    </td>
                    <td>
                      <center><select class="ui dropdown" name="moveArea[<?php echo $i; ?>]">
                        <option type="hidden">เลือก</option>
                        <option value="1" <?php if($tree['moveArea'][$i]=="1"){ echo "selected=''";}?>>ได้</option>
                        <option value="2" <?php if($tree['moveArea'][$i]=="2"){ echo "selected=''";}?>>ไม่ได้</option>
                      </select></center>
                    </td>
                    <td>
                      <center><select class="ui dropdown" name="noEntry[<?php echo $i; ?>]">
                        <option type="hidden">เลือก</option>
                        <option value="1" <?php if($tree['noEntry'][$i]=="1"){ echo "selected=''";}?>>ได้</option>
                        <option value="2" <?php if($tree['noEntry'][$i]=="2"){ echo "selected=''";}?>>ไม่ได้</option>
                      </select></center>
                    </td>
                    <td><input type="button" class="ui red button delete_tr" id="delete_tr" data-id="<?php echo $i; ?>" value="ลบ"></td>
                  </tr>

                  <?php
                        $i++;
                      }
                    }
                  ?>
                  
                  
                </tbody>
              </table>
              
            </div>
          </div>
          

      </div>

      
     
       


<!--- - - - - - - - - -    3  ข้อมูลสภาพพื้นที่ - - - - - - - - - -  -->
      <div class="panel panel-default">
          <div style="background-color:#adebad; padding:1em; color:black;">
            <h4 class="panel-title">
              <i class="Street View icon" ></i>
              <a href="#panel-3" data-parent="#accordion" data-toggle="collapse">ข้อมูลสภาพพื้นที่</a>
            </h4>
          </div>
          
          <div class="panel-collapse collapse" id="panel-3">
            <div class="panel-body">

              <div class="ui grid">
                  <!-- <div class="sixteen wide column">
                    <span>ร่องรอยความเสียหายของต้นไม้ที่พบในพื้นที่</span>
                    <input  type="text"  class="form-control" value="<?php getData($tree,'text','damageInArea'); ?>" name="damageInArea" >
                  </div> -->

                  <div class="sixteen wide column">
                    <span>ประวัติการล้มเหลวของต้นไม้ในอดีต</span>
                    <input  type="text"  class="form-control" value="<?php getData($tree,'text','damageInArea'); ?>" name="damageInArea" >
                  </div>

                  <!-- <div class="five wide column">
                    <span>สภาพภูมิประเทศ</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','topographyStats'); ?>" name="topographyStats" >
                  </div> -->
                
                <!-- - - - - - - - - - - - - - - - - - - -->
                  <div class="three wide column">
                    <span style="font-weight: bold;">สภาพภูมิประเทศ</span>
                  </div>

                  <div class="two wide column">
                    <input type="radio" name="radioslope" >
                    <span>ราบ</span>
                  </div>

                  <div class="four wide column">
                    <input type="radio" name="radioslope" >
                    <span>ลาดเอียง (%)</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','slope'); ?>" name="slope" >
                  </div>

                  <div class="four wide column">
                    <span>ทิศด้านลาด</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','slopeDirection'); ?>" name="slopeDirection" >
                  </div>

                   <!-- - - - - - - - - - - - - - - - - - - -->
                  <div class="five wide column">
                    <span style="font-weight: bold;">การเปลี่ยนแปลงสภาพพื้นที่</span>
                  </div>

                  <div class="two wide column">
                    <input type="radio" name="changeArea" value="ไม่มี" <?php getData($tree,'radio','changeArea','ไม่มี'); ?>>
                    <span>ไม่มี</span>

                  </div>

                  <div class="eight wide column">
                    <input type="radio" name="changeArea" value="มี" <?php getData($tree,'radio','changeArea','มี'); ?>>
                    <span>มี (รายละเอียด)</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','changeAreaDetail'); ?>" name="changeAreaDetail" >
                  </div>


                  <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="two wide column">
                    <span style="font-weight: bold;" >สภาพดิน</span>
                  </div>             

                  <div class="two wide column">
                    <input type="checkbox" name="soilCh2" <?php getData($tree,'checkbox','soilCh2');?>>
                    <span>เนื้อดินจำกัด</span>
                  </div>

                  <div class="two wide column">
                    <input type="checkbox" name="soilCh3" <?php getData($tree,'checkbox','soilCh3');?>>
                    <span>น้ำแช่ขัง</span>
                  </div>

                  <div class="two wide column">
                    <input type="checkbox" name="soilCh5" <?php getData($tree,'checkbox','soilCh5');?>>
                    <span>ดินตื้น</span>
                  </div>

                  <div class="two wide column">
                    <input type="checkbox" name="soilCh4" <?php getData($tree,'checkbox','soilCh4');?>>
                    <span>ดินแน่นขัง</span>
                  </div>

                  <div class="two wide column">
                    <input type="checkbox" name="soilCh6" <?php getData($tree,'checkbox','soilCh6');?>>
                    <span>มีวัสดุปูทับ</span>
                  </div>


                  <div class="four wide column">
                    <input type="checkbox" name="soilCh7" <?php getData($tree,'checkbox','soilCh7');?>>
                    <span>อื่นๆ รายละเอียดเพิ่มเติม</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','soilDetail'); ?>"  name="soilDetail" >
                  </div>


                   <!-- - - - - - - - - - - - - - - - - - - -->

                 <div class="two wide column">
                    <span style="font-weight: bold;" >สภาพอากาศ</span>
                  </div>             

                  <div class="two wide column" >
                    <input type="checkbox" name="weather1" <?php getData($tree,'checkbox','weather1');?>>
                    <span>ลมแรง</span>
                  </div>

                  <div class="two wide column" >
                    <input type="checkbox" name="weather2" <?php getData($tree,'checkbox','weather2');?>>
                    <span>ฝนตกหนัก</span>
                  </div>

                  <div class="four wide column" >
                    <input type="checkbox" name="weather3" <?php getData($tree,'checkbox','weather3');?>>
                    <span>อื่นๆ รายละเอียดเพิ่มเติม</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','weather_other'); ?>"  name="weather_other" >
                  </div>




            </div>
          </div>
        </div>
      </div>



<!--- - - - - - - - - -    4  สุขภาพของต้นไม้ - - - - - - - - - -  -->
        <div class="panel panel-default">
          <div style="background-color:#adebad; padding:1em; color:black;">
            <h4 class="panel-title">
              <i class="Heartbeat icon" ></i>
              <a href="#panel-4" data-parent="#accordion" data-toggle="collapse">สุขภาพของต้นไม้</a>
            </h4>
          </div>
          <div class="panel-collapse collapse" id="panel-4">
            <div class="panel-body">

                <div class="ui grid">
                  <div class="four wide column">
                    <span style="font-weight: bold;">ความเเข็งแรงโดยรวม</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="strong" value="ต่ำ" <?php getData($tree,'radio','strong','ต่ำ'); ?>>
                    <span>ต่ำ</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="strong" value="ปานกลาง" <?php getData($tree,'radio','strong','ปานกลาง'); ?>>
                    <span>ปานกลาง</span>
                  </div>

                  <div class="five wide column">
                    <input type="radio" name="strong" value="สูง" <?php getData($tree,'radio','strong','สูง'); ?>>
                    <span>สูง</span>
                  </div>

                <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="two wide column">
                    <span style="font-weight: bold;">สภาพใบ</span>
                  </div>

                  <div class="two wide column">
                    <input type="checkbox" name="leafCh1" <?php getData($tree,'checkbox','leafCh1');?>>
                    <span>ปกติ</span>
                  </div>

                  <div class="two wide column">
                    <input type="checkbox" name="leafCh2" <?php getData($tree,'checkbox','leafCh2');?>>
                    <span>ผลัดใบ</span>
                  </div>

                  <div class="two wide column">
                    <input type="checkbox" name="leafCh3" <?php getData($tree,'checkbox','leafCh3');?>>
                    <span>ผิดปกติ</span>
                  </div>

                  <div class="two wide column">
                    <input type="checkbox" name="leafCh4" <?php getData($tree,'checkbox','leafCh4');?>>
                    <span>ร่วง (%)</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','leafCh4_text'); ?>"  name="leafCh4_text" >
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="leafCh5" <?php getData($tree,'checkbox','leafCh5');?>>
                    <span>ซีดเหลือง (%)</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','leafCh5_text'); ?>"  name="leafCh5_text" >
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="leafCh6" <?php getData($tree,'checkbox','leafCh6');?>>
                    <span>แห้ง (%)</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','leafCh6_text'); ?>"  name="leafCh6_text" >
                  </div>

                  <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="eight wide column">
                    <span>ตัวการที่มีชีวิต</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','monster1'); ?>"  name="monster1" >
                  </div>

                  <div class="eight wide column">
                    <span>อาการ</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','symptom1'); ?>"  name="symptom1" >
                  </div>

                  <div class="eight wide column">
                    <span>ตัวการที่มีชีวิต</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','monster2'); ?>"  name="monster2" >
                  </div>

                  <div class="eight wide column">
                    <span>อาการ</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','symptom2'); ?>"  name="symptom2" >
                  </div>

                </div> 
       
            </div>
          </div>
        </div>


<!--- - - - - - - - - -    5  การรับแรงลมของต้นไม้ - - - - - - - - - -  -->

        <div class="panel panel-default">
          <div style="background-color:#adebad; padding:1em; color:black;">
            <h4 class="panel-title">
              <i class="Lightning icon" ></i>
              <a href="#panel-5" data-parent="#accordion" data-toggle="collapse" >การรับแรงลมของต้นไม้</a>
            </h4>
          </div>
          <div class="panel-collapse collapse" id="panel-5">
            <div class="panel-body">

                <div class="ui grid">

                  <div class="four wide column">
                    <span style="font-weight: bold;">การรับลม</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="windImpact" value="มีการป้องกัน" <?php getData($tree,'radio','windImpact','มีการป้องกัน'); ?>>
                    <span>มีการป้องกัน</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="windImpact" value="บางส่วน" <?php getData($tree,'radio','windImpact','บางส่วน'); ?>>
                    <span>บางส่วน</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="windImpact" value="เต็มที่" <?php getData($tree,'radio','windImpact','เต็มที่'); ?>>
                    <span>เต็มที่</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="windImpact" value="อุโมงค์ลม" <?php getData($tree,'radio','windImpact','อุโมงค์ลม'); ?>>
                    <span>อุโมงค์ลม</span>
                  </div>

                  

                  <!-- - - - - - - - - - - - - - - - - - - -->
                  <div class="four wide column">
                    <span style="font-weight: bold;">ขนาดเรือนยอดสัมพัทธ์</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="topSize" value="เล็ก" <?php getData($tree,'radio','topSize','เล็ก'); ?>>
                    <span>เล็ก</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="topSize" value="กลาง" <?php getData($tree,'radio','topSize','กลาง'); ?>>
                    <span>กลาง</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="topSize" value="ใหญ่" <?php getData($tree,'radio','topSize','ใหญ่'); ?>>
                    <span>ใหญ่</span>
                  </div>

                  <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="four wide column">
                    <span style="font-weight: bold;">ความหนาแน่นเรือนยอด</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="topThick" <?php getData($tree,'radio','topThick','โปร่ง'); ?> value="โปร่ง">
                    <span>โปร่ง</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="topThick" <?php getData($tree,'radio','topThick','ปานกลาง'); ?> value="ปานกลาง">
                    <span>ปานกลาง</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="topThick" <?php getData($tree,'radio','topThick','ทึบ'); ?> value="ทึบ">
                    <span>ทึบ</span>
                  </div>

                  <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="four wide column">
                    <span style="font-weight: bold;">กาฝาก/เถาวัลย์</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="parasite" <?php getData($tree,'radio','parasite','ไม่มี'); ?> value="ไม่มี">
                    <span>ไม่มี</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="parasite" <?php getData($tree,'radio','parasite','มีน้อย'); ?> value="มีน้อย">
                    <span>มีน้อย</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="parasite" <?php getData($tree,'radio','parasite','มีปานกลาง'); ?> value="มีปานกลาง">
                    <span>มีปานกลาง</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="parasite" <?php getData($tree,'radio','parasite','มีมาก'); ?> value="มีมาก">
                    <span>มีมาก</span>
                  </div>

                  <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="four wide column">
                    <span style="font-weight: bold;">ปริมาณกิ่งในเรือนยอด</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="amount_of_branch" <?php getData($tree,'radio','amount_of_branch','มี'); ?> value="มี">
                    <span>มี</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="amount_of_branch" <?php getData($tree,'radio','amount_of_branch','มาก'); ?> value="มาก">
                    <span>มาก</span>
                  </div>
                  
                  <div class="three wide column">
                    <input type="radio" name="amount_of_branch" <?php getData($tree,'radio','amount_of_branch','ปานกลาง'); ?> value="ปานกลาง">
                    <span>ปานกลาง</span>
                  </div>
                  
                  <div class="three wide column">
                    <input type="radio" name="amount_of_branch" <?php getData($tree,'radio','amount_of_branch','น้อย'); ?> value="น้อย">
                    <span>น้อย</span>
                  </div>

                  <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="seven wide column">
                    <span style="font-weight: bold;">การเปลี่ยนแปลงพื้นที่ในอนาคตที่มีผลต่อแรงลม</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="changeAreaFuture" <?php getData($tree,'radio','changeAreaFuture','มี'); ?> value="มี">
                    <span>มี</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="changeAreaFuture" <?php getData($tree,'radio','changeAreaFuture','ไม่มี'); ?> value="ไม่มี">
                    <span>ไม่มี</span>
                  </div>

                </div>
     
            </div>
          </div>
        </div>




<!--- - - - - - - - - -    6  ปัจจัยความเสี่ยงต่อการเกิดอันตรายของต้นไม - - - - - - - - - -  -->
        <div class="panel panel-default">
          <div style="background-color:#adebad; padding:1em; color:black;">
            <h4 class="panel-title">
              <i class="Tree icon" ></i>
              <a href="#panel-6" data-parent="#accordion" data-toggle="collapse">ปัจจัยความเสี่ยงต่อการเกิดอันตรายของต้นไม้</a>
            </h4>
          </div>
          <div class="panel-collapse collapse" id="panel-6">
            <div class="panel-body">

        <!-- .......................... เรือนยอด  ............................... -->
              <br>
              <center>
                <div style="background-color: #ccf2ff; width: 25%">
                  <h1>เรือนยอด</h1>
                </div>
              </center>

              <br><br>
                <div class="ui grid">

                <!-- - - - - - - - - - - - - - - - - - - -->
                  <div class="four wide column">
                    <span style="font-weight: bold;">ความสมดุลของเรือนยอด</span>
                  </div>

                  <div class="two wide column">
                    <input type="radio" name="topBalance" <?php getData($tree,'radio','topBalance','ดี'); ?> value="ดี">
                    <span>ดี</span>
                  </div>

                  <div class="two wide column">
                    <input type="radio" name="topBalance" <?php getData($tree,'radio','topBalance','ไม่ดี'); ?> value="ไม่ดี">
                    <span>ไม่ดี</span>
                  </div>

                  <div class="five wide column">
                    <span>Live-Crown ration (เปอร์เซนต์)</span>
                    <input type="text" name="liveCrownPercen" value="<?php getData($tree,'text','liveCrownPercen'); ?>" class="form-control" >
                  </div>

                <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="four wide column">
                    <input type="checkbox" name="dryBranches" <?php getData($tree,'checkbox','dryBranches');?>>
                    <span>กิ่งแห้ง (เปอร์เซนต์)</span>
                    <input type="text" name="limbDie" value="<?php getData($tree,'text','limbDie'); ?>" class="form-control" >
                  </div>

                  <div class="four wide column">  
                    <span>ขนาดใหญ่สุด (ซม.)</span>
                    <input type="text" name="limbDieSize" value="<?php getData($tree,'text','limbDieSize'); ?>" class="form-control" >
                  </div>

                  <div class="four wide column">
                    <input type="checkbox" name="brokenBranches" <?php getData($tree,'checkbox','brokenBranches');?>>
                    <span>กิ่งหักแขวน (จำนวนกิ่ง)</span>
                    <input type="text" name="limbBroke" value="<?php getData($tree,'text','limbBroke'); ?>" class="form-control" >
                  </div>

                  <div class="four wide column">  
                    <span>ขนาดใหญ่สุด (ซม.)</span>
                    <input type="text" name="limbBrokeSize" value="<?php getData($tree,'text','limbBrokeSize'); ?>" class="form-control" >
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="limbLesion" <?php getData($tree,'checkbox','limbLesion');?> >
                    <span>รอยแผลกิ่ง</span>  
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="limbHole" <?php getData($tree,'checkbox','limbHole');?> >
                    <span>รอยผุโพรงหรือรู</span>  
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="limbNode" <?php getData($tree,'checkbox','limbNode');?> >
                    <span>ปุ่มปม</span>  
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="limbRotten" <?php getData($tree,'checkbox','limbRotten');?> >
                    <span>เน่า</span>  
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="limbFungus" <?php getData($tree,'checkbox','limbFungus');?> >
                    <span>เชื้อรา เห็ด</span>  
                  </div>

                <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="three wide column">
                    <span style="font-weight: bold;">ประวัติการลิดกิ่ง</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="limbLit" <?php getData($tree,'radio','limbLit','เหมาะสม'); ?> value="เหมาะสม">
                    <span>เหมาะสม</span>
                  </div>

                  <div class="five wide column">
                    <input type="radio" name="limbLit" <?php getData($tree,'radio','limbLit','ไม่เหมาะสม'); ?> value="ไม่เหมาะสม">
                    <span>ไม่เหมาะสม รายละเอียด</span>
                    <input type="text"  class="form-control" value="<?php getData($tree,'text','limbLitOther'); ?>"  name="limbLitOther" >
                  </div>

                  <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="sixteen wide column">
                    <span style="font-weight: bold;">สิ่งที่ต้องเฝ้าระวัง</span>
                    <input type="text" name="topStayAlert" value="<?php getData($tree,'text','topStayAlert'); ?>" class="form-control" >
                  </div>

                  <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="four wide column">
                    <span style="font-weight: bold;">โอกาสในการเกิดอันตราย</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="topHarmChance" <?php getData($tree,'radio','topHarmChance','น้อย'); ?> value="น้อย">
                    <span>น้อย</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="topHarmChance" <?php getData($tree,'radio','topHarmChance','ปานกลาง'); ?> value="ปานกลาง">
                    <span>ปานกลาง</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="topHarmChance" <?php getData($tree,'radio','topHarmChance','มาก'); ?> value="มาก">
                    <span>มาก</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="topHarmChance" <?php getData($tree,'radio','topHarmChance','มากที่สุด'); ?> value="มากที่สุด">
                    <span>มากที่สุด</span>
                  </div>

                
            </div>      



         <!-- .......................... ลำต้น  ............................... -->

              <br><br><br><br>
              <center>
                <div style="background-color: #ccf2ff; width: 25%">
                  <h1>ลำต้น</h1>
                </div>
              </center>

              <br><br>
                <div class="ui grid">
                  
                  <div class="three wide column">
                    <input type="checkbox" name="trunkTwin" <?php getData($tree,'checkbox','trunkTwin');?>>
                    <span>แตก2นาง</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="trunkTogather" <?php getData($tree,'checkbox','trunkTogather');?>>
                    <span>มีเปลือกร่วม</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="trunkDie" <?php getData($tree,'checkbox','trunkDie');?> >
                    <span>เปลือกแห้ง/หลุดร่อน</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="trunkAbnormal" <?php getData($tree,'checkbox','trunkAbnormal');?> >
                    <span>เปลือกผิดปกติ</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="trunkBroke" <?php getData($tree,'checkbox','trunkBroke');?> >
                    <span>มีรอยแตก</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="trunkHole" <?php getData($tree,'checkbox','trunkHole');?> >
                    <span>โพรง</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="trunkDecay" <?php getData($tree,'checkbox','trunkDecay');?> >
                    <span>ผุ</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="trunkLiquid" <?php getData($tree,'checkbox','trunkLiquid');?> >
                    <span>น้ำยางหรือของเหลวไหลจากเปลือก</span>
                  </div>
                  
                  <div class="three wide column">
                    <input type="checkbox" name="trunkNode" <?php getData($tree,'checkbox','trunkNode');?> >
                    <span>ปุ่มปมหรือตา</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="trunkDecayDamage" <?php getData($tree,'checkbox','trunkDecayDamage');?> >
                    <span>เนื้อไม้ผุเสียหาย</span>
                  </div>
 

                  <div class="three wide column">
                    <input type="checkbox" name="trunkFungus" <?php getData($tree,'checkbox','trunkFungus');?> >
                    <span>เช้ือรา เห็ด</span>
                  </div>
              
                  <div class="three wide column">
                    <input type="checkbox" name="trunkThin" <?php getData($tree,'checkbox','trunkThin');?> >
                    <span>ความเรียวผิดปกติผอม</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="trunkSlope_checkbox" <?php getData($tree,'checkbox','trunkSlope_checkbox');?> > 
                    <span>เอียง (องศา)</span>
                    <input type="text" name="trunkSlope" value="<?php getData($tree,'text','trunkSlope'); ?>" class="form-control" >
                  </div>

                <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="sixteen wide column">
                    <span style="font-weight: bold;">สิ่งที่ต้องเฝ้าระวัง</span>
                    <input type="text" name="trunkStayAlert" value="<?php getData($tree,'text','trunkStayAlert'); ?>" class="form-control" >
                  </div>

                <!-- - - - - - - - - - - - - - - - - - - -->
                  <div class="four wide column">
                    <span style="font-weight: bold;">โอกาสในการเกิดอันตราย</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="trunkHarmChance" <?php getData($tree,'radio','trunkHarmChance','น้อย'); ?> value="น้อย">
                    <span>น้อย</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="trunkHarmChance" <?php getData($tree,'radio','trunkHarmChance','ปานกลาง'); ?> value="ปานกลาง">
                    <span>ปานกลาง</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="trunkHarmChance" <?php getData($tree,'radio','trunkHarmChance','มาก'); ?> value="มาก">
                    <span>มาก</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="trunkHarmChance" <?php getData($tree,'radio','trunkHarmChance','มากที่สุด'); ?> value="มากที่สุด">
                    <span>มากที่สุด</span>
                  </div>

                  
                </div>

  <!-- .......................... ราก  ............................... -->
              
              <br><br><br><br>
              <center>
                <div style="background-color: #ccf2ff; width: 25%">
                  <h1>ราก</h1>
                </div>
              </center>


              <br><br>
                <div class="ui grid">
                  
                  <div class="three wide column">
                    <input type="checkbox" name="rootDown" <?php getData($tree,'checkbox','rootDown');?> >
                    <span>โคนต้นฝังดิน</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="rootWrap" <?php getData($tree,'checkbox','rootWrap');?> >
                    <span>รากพันโคนต้น</span>
                  </div>


                  <div class="three wide column">
                    <input type="checkbox" name="rootUp" <?php getData($tree,'checkbox','rootUp');?> >
                    <span>โผล่พ้นดิน</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="rootBroke" <?php getData($tree,'checkbox','rootBroke');?> >
                    <span>แตกหักหรือถูกตัด</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="rootLesion" <?php getData($tree,'checkbox','rootLesion');?> >
                    <span>เสียดสี</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="rootLiquid" <?php getData($tree,'checkbox','rootLiquid');?> >
                    <span>ของเหลวไหลจากเปลือก</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="rootNode" <?php getData($tree,'checkbox','rootNode');?> >
                    <span>มีปุ่มปมหรือตา</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="rootDecay" <?php getData($tree,'checkbox','rootDecay');?> >
                    <span>ผุ</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="rootCavity" <?php getData($tree,'checkbox','rootCavity');?>>
                    <span>โพรง</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="rootFungus" <?php getData($tree,'checkbox','rootFungus');?> >
                    <span>เชื้อรา เห็ด</span>
                  </div>

                  <div class="three wide column">
                    <input type="checkbox" name="rootWater" <?php getData($tree,'checkbox','rootWater');?> >
                    <span>น้ำแช่ขัง</span>
                  </div>
               

                <!-- - - - - - - - - - - - - - - - - - - -->

                 <div class="sixteen wide column">
                    <span style="font-weight: bold;">สิ่งที่ต้องเฝ้าระวัง</span>
                    <input type="text" name="rootStayAlert" value="<?php getData($tree,'text','rootStayAlert'); ?>" class="form-control" >
                  </div>

                  <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="four wide column">
                    <span style="font-weight: bold;">โอกาสในการเกิดอันตราย</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="rootHarmChance" <?php getData($tree,'radio','rootHarmChance','น้อย'); ?> value="น้อย">
                    <span>น้อย</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="rootHarmChance" <?php getData($tree,'radio','rootHarmChance','ปานกลาง'); ?> value="ปานกลาง">
                    <span>ปานกลาง</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="rootHarmChance" <?php getData($tree,'radio','rootHarmChance','มาก'); ?> value="มาก">
                    <span>มาก</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="rootHarmChance" <?php getData($tree,'radio','rootHarmChance','มากที่สุด'); ?> value="มากที่สุด">
                    <span>มากที่สุด</span>
                  </div>

                 
                </div>
        
            </div>
          </div>
        </div>




<!--- - - - - - - - - -    7  การประเมินระดับความเสี่ยงอันตราย - - - - - - - - - -  -->
        <div class="panel panel-default">
          <div style="background-color:#adebad; padding:1em; color:black;">
            <h4 class="panel-title">
              <i class="Signal icon" ></i>
              <a href="#panel-7" data-parent="#accordion" data-toggle="collapse">การประเมินระดับความเสี่ยงอันตราย</a>
            </h4>
          </div>
          <div class="panel-collapse collapse" id="panel-7">
            <div class="panel-body" style="overflow-y: auto;">
              <br>
              <button class="ui green button" id="add_table_risk">เพิ่ม</button>

              <table class="ui basic celled structured table" id="table1_risk">
                <thead>
                  <tr>
                    <th rowspan="2" style="width: 1em;">ลำดับที่</th>
                    <th rowspan="2" style="width: 2em;">ส่วนของต้นไม้ที่เป็นอันตราย</th>
                    <th rowspan="2" style="width: 3em;">รายละเอียดของความเสี่ยง</th>
                    <th colspan="3" style="text-align: center;">โอกาสในการเกิด</th>
                    <th rowspan="2" style="width: 3em;">ระดับความรุนแรงของผล<br>กระทบ</th>
                    <th rowspan="2" style="width: 2em;">ระดับความเสี่ยงอันตราย(matrix2)</th>
                    <th rowspan="2"></th>
                  </tr>
                  <tr>
                    <th>ความล้มเหลวของต้นไม้</th>
                    <th>ผลกระทบต่อเป้าหมาย</th>
                    <th>ความเสียหาย+ผลกระทบ(matrix1)</th>
                  </tr>
                  
                </thead>
                <tbody>


                  <?php  
                    if($tree!=NULL && $tree['treePartName']!=NULL){
                    $n=0;
                      foreach ($tree['treePartName'] as $value) {
                  ?>

                  <tr id="table1st" class="trRow" data-id="<?php echo $n+1; ?>">
                            <td>
                                  <input class="form-control" type="text" name="treePartSeq[<?php echo $n; ?>]" value="<?php echo $tree['treePartSeq'][$n]; ?>" ></td>
                              <td><input class="form-control" type="text" name="treePartName[<?php echo $n; ?>]" value="<?php echo $tree['treePartName'][$n]; ?>"></td>
                              <td><input  type="text" class="form-control" name="treePartFactor[<?php echo $n; ?>]" value="<?php echo $tree['treePartFactor'][$n]; ?>"></td>
                              <td>
                                <center>
                                  <select class="ui dropdown" name="treePartDamage[<?php echo $n; ?>]">
                                    <option type="hidden">เลือก</option>
                                    <option value="1" <?php if($tree['treePartDamage'][$n]=="1"){ echo "selected=''";}?>>น้อย</option>
                                    <option value="2" <?php if($tree['treePartDamage'][$n]=="2"){ echo "selected=''";}?>>ปานกลาง</option>
                                    <option value="3" <?php if($tree['treePartDamage'][$n]=="3"){ echo "selected=''";}?>>มาก</option>
                                    <option value="4" <?php if($tree['treePartDamage'][$n]=="4"){ echo "selected=''";}?>>มากที่สุด</option>
                                  </select>
                                </center>
                              </td>
                              <td>
                                <center>
                                  <select class="ui dropdown" name="treePartImpact[<?php echo $n; ?>]">
                                    <option type="hidden">เลือก</option>
                                    <option value="1" <?php if($tree['treePartImpact'][$n]=="1"){ echo "selected=''";}?>>ต่ำมาก</option>
                                    <option value="2" <?php if($tree['treePartImpact'][$n]=="2"){ echo "selected=''";}?>>ต่ำ</option>
                                    <option value="3" <?php if($tree['treePartImpact'][$n]=="3"){ echo "selected=''";}?>>ปานกลาง</option>
                                    <option value="4" <?php if($tree['treePartImpact'][$n]=="4"){ echo "selected=''";}?>>สูง</option>
                                  </select>
                                </center>
                              </td>
                              <td>
                                <center>
                                  <select class="ui dropdown" name="treePartPlus[<?php echo $n; ?>]">
                                    <option type="hidden">เลือก</option>
                                    <option value="1" <?php if($tree['treePartPlus'][$n]=="1"){ echo "selected=''";}?>>น้อย</option>
                                    <option value="2" <?php if($tree['treePartPlus'][$n]=="2"){ echo "selected=''";}?>>ค่อนข้างน้อย</option>
                                    <option value="3" <?php if($tree['treePartPlus'][$n]=="3"){ echo "selected=''";}?>>มาก</option>
                                    <option value="4" <?php if($tree['treePartPlus'][$n]=="4"){ echo "selected=''";}?>>มากที่สุด</option>
                                  </select>
                                </center>
                              </td>
                              <td>
                                <center>
                                  <select class="ui dropdown" name="treePartRank[<?php echo $n; ?>]">
                                    <option type="hidden">เลือก</option>
                                    <option value="1" <?php if($tree['treePartRank'][$n]=="1"){ echo "selected=''";}?>>ต่ำ</option>
                                    <option value="2" <?php if($tree['treePartRank'][$n]=="2"){ echo "selected=''";}?>>ปานกลาง</option>
                                    <option value="3" <?php if($tree['treePartRank'][$n]=="3"){ echo "selected=''";}?>>รุนแรง</option>
                                    <option value="4" <?php if($tree['treePartRank'][$n]=="4"){ echo "selected=''";}?>>รุนแรงมาก</option>
                                  </select>
                                </center>
                              </td>
                              <td>
                                <input class="form-control" type="text" name="treeDamage[<?php echo $n; ?>]" value="<?php echo $tree['treeDamage'][$n]; ?>" >
                              </td>
                              <td>
                                <input type="button" class="ui red button delete_tr1" id="delete_tr1" data-id="<?php echo $n; ?>" value="ลบ">
                              </td>
                            </tr>
                        <?php
                        $n++;
                      }
                    }
                  ?>


                   
                </tbody>
              </table>
              <br>
              <br>

              <br>
              <!--  - - - -  - - - - - - - - - - - - - - - - - - - - - - - -  - -->
                <div class="ui grid">
                  
                  <div class="sixteen wide column">
                    <span style="font-weight: bold;">คำอธิบายเพิ่มเติม</span>
                    <input type="text" name="moreDetail" value="<?php getData($tree,'text','moreDetail'); ?>" class="form-control" >
                  </div>
                  <br>

                <!--  - - - - - - - - - - - - - - - - - - -  - -->
                  
                  <br>
                <div class="sixteen wide column">
                  <button class="ui teal button" id="add_edit">เพิ่ม</button> 
                  <div class="ten wide column">
                    <span>วิธีแก้ไข</span>
                    <input type="text" class="form-control" name="Solution1" value="<?php getData($tree,'text','Solution1'); ?>" >
                    <span">ปัญหาที่อาจหลงเหลือ</span>
                    <input type="text" class="form-control" name="problem1" value="<?php getData($tree,'text','problem1'); ?>" >
                  </div>

                  <div class="ten wide column">
                    <span">วิธีแก้ไข</span>
                    <input type="text" class="form-control" name="Solution2" value="<?php getData($tree,'text','Solution2'); ?>" >
                    <span">ปัญหาที่อาจหลงเหลือ</span>
                    <input type="text" class="form-control" name="problem2" value="<?php getData($tree,'text','problem2'); ?>" >
                  </div>
                </div>
                <div id="edit_div" class="sixteen wide column">

                 
                </div>
                




                <!--  - - - - - - - - - - - - - - - - - - -  - -->
                  <div class="five wide column">
                    <span style="font-weight: bold;">ผลการประเมินความเสี่ยงอันตรายจากต้นไม้ในภาพรวม</span>
                  </div>

                  <div class="two wide column">
                    <input type="radio" name="totalDamage" <?php getData($tree,'radio','totalDamage','ต่ำ'); ?> value="ต่ำ">
                    <span>ต่ำ</span>
                  </div>

                  <div class="two wide column">
                    <input type="radio" name="totalDamage" <?php getData($tree,'radio','totalDamage','ปานกลาง'); ?> value="ปานกลาง">
                    <span>ปานกลาง</span>
                  </div>

                  <div class="two wide column">
                    <input type="radio" name="totalDamage" <?php getData($tree,'radio','totalDamage','สูง'); ?> value="สูง">
                    <span>สูง</span>
                  </div>
 
                  <div class="two wide column">
                    <input type="radio" name="totalDamage" <?php getData($tree,'radio','totalDamage','สูงที่สุด'); ?> value="สูงที่สุด">
                    <span>สูงที่สุด</span>
                  </div>

                  <!--  - - - - - - - - - - - - - - - - - - -  - -->

                  <div class="four wide column">
                    <span style="font-weight: bold;">ความเร่งด่วนในการดำเนินงาน</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="operateTime" <?php getData($tree,'radio','operateTime','ทันที'); ?> value="ทันที">
                    <span>ทันที</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="operateTime" <?php getData($tree,'radio','operateTime','ภายใน1เดือน'); ?> value="ภายใน1เดือน">
                    <span>ภายใน1เดือน</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="operateTime" <?php getData($tree,'radio','operateTime','ภายใน3-5เดือน'); ?> value="ภายใน3-5เดือน">
                    <span>ภายใน3-5เดือน</span>
                  </div>


                  <div class="three wide column">
                    <input type="radio" name="operateTime" <?php getData($tree,'radio','operateTime','ภายใน6-12เดือน'); ?> value="ภายใน6-12เดือน">
                    <span>ภายใน6-12เดือน</span>
                  </div>
                  <!--  - - - - - - - - - - - - - - - - - - -  - -->
                  <div class="four wide column">
                    <span style="font-weight: bold;">การประเมินเพิ่มเติม</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="moreEvaluate" <?php getData($tree,'radio','moreEvaluate','ไม่ต้องการ'); ?> value="ไม่ต้องการ">
                    <span>ไม่ต้องการ</span>
                  </div>

                  <div class="eight wide column">
                    <input type="radio" name="moreEvaluate" <?php getData($tree,'radio','moreEvaluate','ต้องการ เรื่อง'); ?> value="ต้องการ เรื่อง">
                    <span>ต้องการ เรื่อง</span>
                    <input type="text" name="needMore" value="<?php getData($tree,'text','needMore'); ?>" class="form-control" >
                  </div>
                  <div class="five wide column">
                    <span>ระยะเวลาที่ควรมีการตรวจสอบ(ทุกๆ)</span>
                    <input type="text" name="validTime" value="<?php getData($tree,'text','validTime'); ?>" class="form-control" >
                  </div>
                </div>
          </div>
        </div>
      </div>





<!--- - - - - - - - - -    8  ภาพประกอบการด าเนินงานโดยสังเขป - - - - - - - - - -  -->
        <div class="panel panel-default">
          <div style="background-color:#adebad; padding:1em; color:black;">
            <h4 class="panel-title">
              <i class="Photo icon" ></i>
              <a href="#panel-8" data-parent="#accordion" data-toggle="collapse">ภาพประกอบการดำเนินงานโดยสังเขป</a>
            </h4>
          </div>
          <div class="panel-collapse collapse" id="panel-8">
            <div class="panel-body">

              <div class="col-md-12" style="margin-top: 3%;">
                        <label class="control-label" >แนบรูป</label>
                        <br>
                        <label>เต็มต้น : </label><br>                       
                        <div id="full_tree">


                          <?php if($update==1): ?>
                            @if($img['Tree_imgFull']!=NULL)
                              @foreach($img['Tree_imgFull'] as $imgFull)
                                <img class='ui large image' id="imagefull" data-id="{{ $imgFull }}" src='{{asset('images/uploads/'.$imgFull)}}'>
                                <input type="button" data-id="{{ $imgFull }}" class="ui red button delete_imgfull" id="delete_imgfull" value="ลบ">

                              @endforeach
                            @endif 
                          <?php endif ?>                                

                        </div> 

                         

                        <br>
                        <button class="ui teal button" id="addfull_img">เพิ่ม</button>
                        <!-- <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Full" src="#" width="50%"/>
                        </div>
                         -->
                         <br>
                         <br>
                        <label style="">ลำต้น : </label><br>
                        <div id="truck_tree">
                            
                          <?php if($update==1): ?>
                              @if($img['Tree_imgTruck']!=NULL)
                                @foreach($img['Tree_imgTruck'] as $imgTruck)
                                  <img class='ui large image' id="imagetruck" data-id="{{ $imgTruck }}" src='{{asset('images/uploads/'.$imgTruck)}}'>
                                  <input type="button" data-id="{{ $imgTruck }}" class="ui red button delete_imgtruck" id="delete_imgtruck" value="ลบ">
                                @endforeach
                              @endif
                          <?php endif ?>

                        </div>

                        <br>
                        <button class="ui teal button" id="addtruck_img">เพิ่ม</button>
                        <!-- <input class="ui teal button" type="file" accept="image/*" name="Tree_imgTruck" capture="camera" id="imgTruck" > -->

                        
                       <!--  <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Truck" src="#" width="50%"/>
                        </div> -->
                        <br>
                        <br>
                        <label style="">ใบ : </label><br>
                        <div id="leaf_tree">
                          <?php if($update==1): ?>
                              @if($img['Tree_imgLeaf']!=NULL)
                                @foreach($img['Tree_imgLeaf'] as $imgLeaf)
                                  <img class='ui large image' id="imageleaf" data-id="{{ $imgLeaf }}" src='{{asset('images/uploads/'.$imgLeaf)}}'>
                                  <input type="button" data-id="{{ $imgLeaf }}" class="ui red button delete_imgleaf" id="delete_imgleaf" value="ลบ">
                                @endforeach
                              @endif
                          <?php endif ?>
                        </div>

                        <br>
                        <button class="ui teal button" id="addleaf_img">เพิ่ม</button>
                        <!-- <input class="ui teal button" type="file" accept="image/*" name="Tree_imgLeaf" capture="camera" id="imgLeft" > -->
                        
                        <!-- <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Left" src="#" width="50%"/>
                        </div> -->
                        <br>
                        <br>
                        <label style="">เรือนยอด : </label><br>
                        <div id="top_tree">
                          <?php if($update==1): ?>
                              @if($img['Tree_imgTop']!=NULL)
                                @foreach($img['Tree_imgTop'] as $imgTop)
                                  <img class='ui large image' id="imagetop" data-id="{{ $imgTop }}" src='{{asset('images/uploads/'.$imgTop)}}'>
                                  <input type="button" data-id="{{ $imgTop }}" class="ui red button delete_imgtop" id="delete_imgtop" value="ลบ">
                                @endforeach
                              @endif
                          <?php endif ?>
                        </div>

                        <br>
                        <button class="ui teal button" id="addtop_img">เพิ่ม</button>
                        <!-- <input class="ui teal button" type="file" accept="image/*" name="Tree_imgTop" capture="camera" id="imgTop" > -->

                        <!-- <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Top" src="#" width="50%"/>
                        </div> -->
                        <br>
                        <br>
                        <label style="">ราก : </label><br>
                        <div id="root_tree">
                          <?php if($update==1): ?>
                              @if($img['Tree_imgRoot']!=NULL)
                                @foreach($img['Tree_imgRoot'] as $imgRoot)
                                  <img class='ui large image' id="imageroot" data-id="{{ $imgRoot }}" src='{{asset('images/uploads/'.$imgRoot)}}'>
                                  <input type="button" data-id="{{ $imgRoot }}" class="ui red button delete_imgroot" id="delete_imgroot" value="ลบ">
                                @endforeach
                              @endif
                          <?php endif ?>
                        </div>
                        <br>
                        <button class="ui teal button" id="addroot_img">เพิ่ม</button>
                        <!-- <input class="ui teal button" type="file" accept="image/*" name="Tree_imgRoot" capture="camera" id="imgRoot" > -->

                        <!-- <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Root" src="#" width="50%"/>
                        </div> -->


                        <script>
                              $(document).on('click', '#delete_imgfull', function() {
                                  var imgfullId = $(this).data('id');
                                  // alert("ยืนยันการลบรูปภาพ");
                                  $('#imagefull[data-id="'+imgfullId+'"]').remove();
                                  $('#delete_imgfull[data-id="'+imgfullId+'"]').remove();

                                  var addfull = '<input type="hidden" name="fulltree[]" value="'+imgfullId+'">';

                                  $('#full_tree').append(addfull);    

                              });

                              $(document).on('click', '#delete_imgtruck', function() {
                                  var imgtruckId = $(this).data('id');
                                  // alert("ยืนยันการลบรูปภาพ");
                                  $('#imagetruck[data-id="'+imgtruckId+'"]').remove();
                                  $('#delete_imgtruck[data-id="'+imgtruckId+'"]').remove();

                                  var addtruck = '<input type="hidden" name="fulltree[]" value="'+imgtruckId+'">';

                                  $('#truck_tree').append(addtruck);    

                              });

                              $(document).on('click', '#delete_imgleaf', function() {
                                  var imgleafId = $(this).data('id');
                                  // alert("ยืนยันการลบรูปภาพ");
                                  $('#imageleaf[data-id="'+imgleafId+'"]').remove();
                                  $('#delete_imgleaf[data-id="'+imgleafId+'"]').remove();

                                  var addleaf = '<input type="hidden" name="fulltree[]" value="'+imgleafId+'">';

                                  $('#leaf_tree').append(addleaf);    

                              });

                              $(document).on('click', '#delete_imgtop', function() {
                                  var imgtopId = $(this).data('id');
                                  // alert("ยืนยันการลบรูปภาพ");
                                  $('#imagetop[data-id="'+imgtopId+'"]').remove();
                                  $('#delete_imgtop[data-id="'+imgtopId+'"]').remove();

                                  var addtop = '<input type="hidden" name="fulltree[]" value="'+imgtopId+'">';

                                  $('#top_tree').append(addtop);    

                              });

                              $(document).on('click', '#delete_imgroot', function() {
                                  var imgrootId = $(this).data('id');
                                  // alert("ยืนยันการลบรูปภาพ");
                                  $('#imageroot[data-id="'+imgrootId+'"]').remove();
                                  $('#delete_imgroot[data-id="'+imgrootId+'"]').remove();

                                  var addroot = '<input type="hidden" name="fulltree[]" value="'+imgrootId+'">';

                                  $('#root_tree').append(addroot);    

                              });

                          </script>
                        
                </div>  
                
                <script type="text/javascript">

                  $("#addfull_img").click(function(event){
                    event.preventDefault();
                    var add_full = '<div id="remove_photo">'+'<br>'+'<br>'+'<input class="ui teal button" type="file" accept="image/*" name="Tree_imgFull[]" capture="camera" id="imgFull" >'+'<input type="button" id="remove_add" class="ui red button" value="ลบ">'+'</div>';

                     $('#full_tree').append(add_full); 
                  });

                  $("#addtruck_img").click(function(event){
                    event.preventDefault();
                    var add_full = '<div id="remove_photo">'+'<br>'+'<br>'+'<input class="ui teal button" type="file" accept="image/*" name="Tree_imgTruck[]" capture="camera" id="imgTruck" > '+'<input type="button" id="remove_add" class="ui red button" value="ลบ">'+'</div>';

                     $('#truck_tree').append(add_full); 
                  });

                  $("#addleaf_img").click(function(event){
                    event.preventDefault();
                    var add_full = '<div id="remove_photo">'+'<br>'+'<br>'+'<input class="ui teal button" type="file" accept="image/*" name="Tree_imgLeaf[]" capture="camera" id="imgLeft" > '+'<input type="button" id="remove_add" class="ui red button" value="ลบ">'+'</div>';

                     $('#leaf_tree').append(add_full); 
                  });

                  $("#addtop_img").click(function(event){
                    event.preventDefault();
                    var add_full = '<div id="remove_photo">'+'<br>'+'<br>'+'<input class="ui teal button" type="file" accept="image/*" name="Tree_imgTop[]" capture="camera" id="imgTop" > '+'<input type="button" id="remove_add" class="ui red button" value="ลบ">'+'</div>';

                     $('#top_tree').append(add_full); 
                  });

                  $("#addroot_img").click(function(event){
                    event.preventDefault();
                    var add_full = '<div id="remove_photo">'+'<br>'+'<br>'+'<input class="ui teal button" type="file" accept="image/*" name="Tree_imgRoot[]" capture="camera" id="imgRoot" > '+'<input type="button" id="remove_add" class="ui red button" value="ลบ">'+'</div>';

                     $('#root_tree').append(add_full); 
                  });

                  $(document).on('click','#remove_add',function() {
                    $("#remove_photo").remove();
                  });
                </script>

            </div>
          </div>
          
        </div>



        </div>
      </div>
    </div>



      <center>
        
        <input type="submit" class="ui green button" id="buttonDel" value="บันทึกข้อมูล" style="display: none;">
        
    </center>
  </form>

      </div>

    </div>
  
  
  <h4></h4>
</div>
<script>
    // var checkedit=0;
    <?php if($update==1): ?>
      $("#buttonDel").show(); 
    <?php endif ?>
    // if(checkedit>0){
    //   $("#buttonDel").show();
    // }
</script>
<script type="text/javascript">
    
            var i=1;
            $("#add_table").click(function(event){
              event.preventDefault();
              $("#buttonDel").show();

             var data_dam = '<tr>'+
                            '<td><input class="hideme" id="tree_num" type="text" value="'+i+'"></td>'+'<td><input class="form-control" type="text" name="listDamage['+i+']" required></td>'+'<td><center><select class="ui dropdown" name="protectTarget['+i+']"><option type="hidden">เลือก</option><option value="1">มี</option><option value="2">ไม่มี</option></select></center></td>'+'<td><input type="hidden" name="ch1['+i+']" value="off"><input class="form-control" name="ch1['+i+']" type="checkbox"></td>'+'<td><input type="hidden" name="ch2['+i+']" value="off"><input class="form-control" name="ch2['+i+']" type="checkbox"></td>'+'<td><input type="hidden" name="ch3['+i+']" value="off"><input class="form-control" name="ch3['+i+']" type="checkbox"></td>'+'<td><center><select required class="ui dropdown" name="damageArea['+i+']"><option type="hidden" value="">เลือก</option><option value="1">1-ไม่ค่อยปรากฎ</option><option value="2">2-อยู่เป็นบางครั้ง</option><option value="3">3-ค่อนข้างบ่อย</option><option value="4">4-อยู่ตลอด</option></select></center></td>'+'<td><center><select class="ui dropdown" name="moveArea['+i+']"><option type="hidden" value="">เลือก</option><option value="1">ได้</option><option value="2">ไม่ได้</option>></select></center></td>'+'<td><center><select class="ui dropdown" name="noEntry['+i+']"><option type="hidden">เลือก</option><option value="1">ได้</option><option value="2">ไม่ได้</option>></select></center></td>'+'<td><input type="button" class="ui red button delete_tr" id="delete_tr" data-id="'+i+'" value="ลบ"></td>'+'</tr>';
              $('#table_damage').append(data_dam);
              i++;
            });

            $(document).on('click', '#delete_tr', function() {
      
                $(this).closest('tr').remove();

                i = i-1;

                if(i == 1){
                  $("#buttonDel").hide();
                }

                  

            });
                
</script>

<script type="text/javascript">

    var n=1;
            $("#add_table_risk").click(function(event){
              event.preventDefault();

              var data_risk1 = '<tr id="table1st" class="trRow" data-id="'+n+'">'+
                            '<td><input class="form-control" type="text" name="treePartSeq['+n+']" value="'+n+'"></td>'+'<td><input class="form-control" type="text" name="treePartName['+n+']"></td>'+'<td><input  type="text" class="form-control" name="treePartFactor['+n+']"></td>'+'<td><center><select class="ui dropdown" name="treePartDamage['+n+']"><option type="hidden">เลือก</option><option value="1">น้อย</option><option value="2">ปานกลาง</option><option value="3">มาก</option><option value="4">มากที่สุด</option></select></center></td>'+'<td><center><select class="ui dropdown" name="treePartImpact['+n+']"><option type="hidden">เลือก</option><option value="1">ต่ำมาก</option><option value="2">ต่ำ</option><option value="3">ปานกลาง</option><option value="4">สูง</option></select></center></td>'+'<td><center><select class="ui dropdown" name="treePartPlus['+n+']"><option type="hidden">เลือก</option><option value="1">น้อย</option><option value="2">ค่อนข้างน้อย</option><option value="3">มาก</option><option value="4">มากที่สุด</option></select></center></td>'+'<td><center><select class="ui dropdown" name="treePartRank['+n+']"><option type="hidden">เลือก</option><option value="1">ต่ำ</option><option value="2">ปานกลาง</option><option value="3">รุนแรง</option><option value="4">รุนแรงมาก</option></select></center></td>'+'<td><input class="form-control" type="text" name="treeDamage['+n+']"></td>'+'<td><input type="button" class="ui red button delete_tr1" id="delete_tr1" data-id="'+n+'" value="ลบ"></td>'+'</tr>';
              $('#table1_risk').append(data_risk1);
              n++;


            });

              $(document).on('click', '#delete_tr1', function() {
                  var trId = $(this).data('id');

                  $('.trRow[data-id="'+trId+'"]').remove();
                

              });
</script>




<!-- 444 -->

@stop