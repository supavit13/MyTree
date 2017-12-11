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
<link href="{{ asset('css/printPaper.css')}}" rel="stylesheet" type="text/css" />

<div class="A4">
  <br>

  <center><div>
    <span style="font-weight: bold; font-size: 18px;">
      แบบประเมินความเสี่ยงอันตรายจากต้นไม้เบื้องต้น
    </span>
  </div></center> 
  <span style="font-weight: bold;">เจ้าของพื้นที่</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 5cm;" value="<?php getData($tree,'text','ownerarea'); ?>">
    </span>
  
  <span style="font-weight: bold;">ที่อยู่</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 7cm;" value="<?php getData($tree,'text','Tree_address'); ?>">
    </span>
  
  <span style="font-weight: bold;">วันที่</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 3cm;" value="<?php getData($tree,'text','Tree_date'); ?>">
    </span>

  <span style="font-weight: bold;">&nbspเวลา</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 3cm;" value="<?php getData($tree,'text','Tree_time'); ?>">
    </span>
  <span>น.</span>

  <!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด -->
  
  <span style="font-weight: bold;">ต้นที่</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 2cm;" value="<?php getData($tree,'text','Tree_sequence'); ?>">
    </span>
  
  <span style="font-weight: bold;">พิกัด</span>
  <span style="font-weight: bold;">X:</span>  
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 2.5cm;" value="<?php getData($tree,'text','Tree_lat'); ?>">
    </span>
  
  <span style="font-weight: bold;">Y:</span>  
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 2.5cm;" value="<?php getData($tree,'text','Tree_long'); ?>">
    </span>

  <span style="font-weight: bold;">ชนิด</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 3.5cm;" value="<?php getData($tree,'text','Tree_name'); ?>">
    </span>

  <span style="font-weight: bold;">ชื่อวิทยาศาสตร์</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 7cm;" value="<?php getData($tree,'text','Tree_sci_name'); ?>">
    </span>

  <!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด -->

  <span style="font-weight: bold;">เส้นผ่านศูนย์กลางเพียงอก</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 1.5cm;" value="<?php getData($tree,'text','Tree_diameter_Trunk'); ?>">
    </span>
  <span style="font-weight: bold;">เซนติเมตร</span>

  <span id="tab" style="font-weight: bold;">ความสูงทั้งหมด</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 1.5cm;" value="<?php getData($tree,'text','Tree_height'); ?>">
    </span>
  <span style="font-weight: bold;">เมตร</span>

  <span id="tab" style="font-weight: bold;">เส้นผ่านศูนย์กลางเรือนยอด</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 1.5cm;" value="<?php getData($tree,'text','Tree_diameter_Top'); ?>">
    </span>
  <span style="font-weight: bold;">เมตร</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด -->

  <span style="font-weight: bold;">ผู้ประเมิน</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 6.5cm;" value="<?php echo $userlogin['username'] ?>">
    </span>

  <span style="font-weight: bold;">หน่วยงาน</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 10cm;" value="<?php getData($tree,'text','agency'); ?>">
    </span>

  <span style="font-weight: bold;">&nbspโทรศัพท์</span>
    <span>
      <input readonly type="text" class="hideme"  id="input" style="width: 3.5cm;" value="<?php getData($tree,'text','Tree_phone'); ?> ">
    </span>

<!-- - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
  <br><br>

  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      แบบประเมินความเสียหายที่จะเกิดขึ้น
    </span>
  </div></center> 

  <table>
    <thead>
      <tr>
        <th rowspan="2" style="text-align: center; width: 2%;">ลำดับ</th>
        <th rowspan="2" id="ten_per" style="text-align: center;">เป้าหมายของ<br>ความเสียหาย</th>
        <th rowspan="2" id="ten_per" style="text-align: center;">มาตราการ<br>ป้องกัน</th>
        <th colspan="3" style="text-align: center;">บริเวณที่อาจเกิดความเสียหาย</th>
        <th rowspan="2" id="five_per" style="text-align: center;">การปรากฎอยู่<br>ของเป้าหมาย</th>
        <th rowspan="2" id="five_per" style="text-align: center;">การ<br>เคลื่อนย้าย</th>
        <th rowspan="2" id="five_per" style="text-align: center;">การกัน<br>พื้นที่</th>
      </tr>
<!-- **************************************************เฟรินคอมเม้น *************************************************-->
      <tr>
        <th id="five_per"  style="text-align: center;">ใต้<br>เรือนยอด</th>
        <th id="five_per"  style="text-align: center;">1 เท่า<br>ของ<br>ความสูง</th>
        <th id="five_per"  style="text-align: center;">1.5เท่า<br>ของความ<br>สูง</th>
      </tr>
    </thead>
                
    <tbody>
     

<!-- **************************************************เฟรินคอมเม้น *************************************************-->


      @if($tree!=NULL and $tree['listDamage']!=NULL)
        <?php $i=0; ?>
        @foreach($tree['listDamage'] as $value)
          <tr>
            <td style="text-align: center;"><?php echo $i+5; ?></td>
            <td ><input readonly class="hideme" name="listDamage[<?php echo $i; ?>]" type="text" value="<?php echo $tree['listDamage'][$i]; ?>"></td> <!-- รายละเอียดของสิ่งที่จะเกิดความเสียหาย -->            
            
            <td style="text-align: center;">  <!-- การปรากฎอยู่ของสิ่งที่จะเสียหาย -->
              <select id="arrow">   
                <option value="0" <?php if($tree['protection'][$i]=="0"){ echo "selected=''";}?>>โปรดเลือก</option>
                <option value="1" <?php if($tree['protection'][$i]=="1"){ echo "selected=''";}?>>มี</option>
                <option value="2" <?php if($tree['protection'][$i]=="2"){ echo "selected=''";}?>>ไม่มี</option>
              </select>
            </td> 
            <td>
              <div style="text-align: center;">
                <input readonly type="checkbox" name="ch1[<?php echo $i; ?>]" <?php if($tree['ch1'][$i]=="on"){ echo "checked=''";}?>>
              </div>
            </td>
            <td>
              <div style="text-align: center;">
                <input readonly type="checkbox" name="ch2[<?php echo $i; ?>]" <?php if($tree['ch2'][$i]=="on"){ echo "checked=''";}?>>
              </div>
            </td>
            <td>
              <div style="text-align: center;">
                <input readonly type="checkbox" name="ch3[<?php echo $i; ?>]" <?php if($tree['ch3'][$i]=="on"){ echo "checked=''";}?>>
              </div>
            </td>                          
                        

            <td style="text-align: center;">  <!-- การปรากฎอยู่ของสิ่งที่จะเสียหาย -->
              <select id="arrow">   
                <option value="0" <?php if($tree['damageArea'][$i]=="0"){ echo "selected=''";}?>>โปรดเลือก</option>
                <option value="1" <?php if($tree['damageArea'][$i]=="1"){ echo "selected=''";}?>>1-พบน้อยมาก</option>
                <option value="2" <?php if($tree['damageArea'][$i]=="2"){ echo "selected=''";}?>>2-พบบางครั้ง</option>
                <option value="3" <?php if($tree['damageArea'][$i]=="3"){ echo "selected=''";}?>>3-พบบ่อย</option>
                <option value="4" <?php if($tree['damageArea'][$i]=="4"){ echo "selected=''";}?>>4-อยู่บริเวณนั้น</option>
              </select>
            </td> 

            <td style="text-align: center;">  <!-- การเคลื่อนย้ายออกจากพื้นที่อันตราย -->
              <select id="arrow">   
                <option value="0" <?php if($tree['moveArea'][$i]=="0"){ echo "selected=''";}?>>โปรดเลือก</option>
                <option value="1" <?php if($tree['moveArea'][$i]=="1"){ echo "selected=''";}?>>มีโอกาสเกิด</option>
                <option value="2" <?php if($tree['moveArea'][$i]=="2"){ echo "selected=''";}?>>ไม่มีโอกาสเกิด</option>
              </select>
            </td>  
                        
            <td style="text-align: center;">  <!-- ห้ามเข้าพื้นที่อันตราย -->
              <select id="arrow">   
                <option value="0" <?php if($tree['noEntry'][$i]=="0"){ echo "selected=''";}?>>โปรดเลือก</option>
                <option value="1" <?php if($tree['noEntry'][$i]=="1"){ echo "selected=''";}?>>มีโอกาสเกิด</option>
                <option value="2" <?php if($tree['noEntry'][$i]=="2"){ echo "selected=''";}?>>
              </select>
            </td>  
          </tr>

          <?php $i++; ?>
        @endforeach
      @endif


    </tbody>
  </table>

<!-- - - - - - - - - - - - -3 ข้อมูลสภาพพื้นที่- - - - - - - - - - - - - - - - - - -  -->

<br><br>
  
  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      ข้อมูลสภาพพื้นที่
    </span>
  </div></center> 

  <span style="font-weight: bold;">ประวัติการล้มเหลวของต้นไม้ในอดีต</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 20cm;" value="<?php getData($tree,'text','damageInArea'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">สภาพภูมิประเทศ</span>
  <span>
        <input readonly type="radio" name="radioSlope" >
        <span>&nbspราบ&nbsp</span>
  </span>

  <input readonly type="radio" name="radioSlope" >
  <span style="font-weight: bold;">ลาดเอียง</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 5cm;" value="<?php getData($tree,'text','slope'); ?>">
    </span>
  <span style="font-weight: bold;">%</span>

  <span id="tab" style="font-weight: bold;">ทิศด้านลาด</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 4.75cm;" value="<?php getData($tree,'text','slopeDirection'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">การเปลี่ยนแปลงสภาพพื้นที่</span>
  
  <span>
    <input readonly type="radio" name="changeArea" value="ไม่มี" <?php getData($tree,'radio','changeArea','ไม่มี'); ?>>
  </span>
  <span>ไม่มี</span>

  <span>
    <input readonly type="radio" name="changeArea" value="มี" <?php getData($tree,'radio','changeArea','มี'); ?>>
  </span>
  <span>มี</span> 

  <span>รายละเอียด</span> 
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 13cm;" value="<?php getData($tree,'text','changeAreaDetail'); ?>">
    </span>               


<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">สภาพดิน</span>
  
  <span>
    <input readonly type="checkbox" name="soilCh2" <?php getData($tree,'checkbox','soilCh2');?>>
  </span>
  <span>เนื้อดินจำกัด</span>

  <span>
    <input readonly type="checkbox" name="soilCh3" <?php getData($tree,'checkbox','soilCh3');?>>
  </span>
  <span>น้ำแช่ขัง</span>

  <span>
    <input readonly type="checkbox" name="soilCh5" <?php getData($tree,'checkbox','soilCh5');?>>
  </span>
  <span>ดินตื้น</span>

  <span>
    <input readonly type="checkbox" name="soilCh4" <?php getData($tree,'checkbox','soilCh4');?>>
  </span>
  <span>ดินแน่นแข็ง</span>

  <span>
    <input readonly type="checkbox" name="soilCh6" <?php getData($tree,'checkbox','soilCh6');?>>
  </span>
  <span>มีวัสดุปิดทับ</span> 

  <span>
    <input readonly type="checkbox" name="soilCh7" <?php getData($tree,'checkbox','soilCh7');?>>
  </span>
  <span>อื่นๆ รายละเอียดเพิ่มเติม</span> 
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 9.5cm;" value="<?php getData($tree,'text','soilDetail'); ?>">
    </span> 

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;" >สภาพอากาศ</span> 
    <span>
      <input readonly type="checkbox" name="weather1" <?php getData($tree,'checkbox','weather1');?>>
    </span>
    <span  >ลมแรง</span>
    <span>
      <input readonly type="checkbox" name="weather2" <?php getData($tree,'checkbox','weather2');?>>
    </span>
    <span>ฝนตกหนัก</span>
    <span>
      <input readonly type="checkbox" name="weather3" <?php getData($tree,'checkbox','weather3');?>>
    </span>
    <span>อื่นๆ รายละเอียดเพิ่มเติม</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 28%;" value="<?php getData($tree,'text','weather_other'); ?>">
    </span> 

<!-- - - - - - - - - - - - - สุขภาพของต้นไม้ - - - - - -  - - - - - - - - - - -  -->

<br><br>
  
  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      สุขภาพของต้นไม้
    </span>
  </div></center> 


  <span style="font-weight: bold;">ความแข็งแรงโดยรวม</span>
  <span>
    <input readonly type="radio" name="strong" value="ต่ำ" <?php getData($tree,'radio','strong','ต่ำ'); ?>>
  </span>
  <span>ต่ำ</span>

  <span>
    <input readonly type="radio" name="strong" value="ปานกลาง" <?php getData($tree,'radio','strong','ปานกลาง'); ?>>
  </span>
  <span>ปานกลาง</span>

  <span>
    <input readonly type="radio" name="strong" value="สูง" <?php getData($tree,'radio','strong','สูง'); ?>>
  </span>
  <span>สูง</span>



  <span id="tab" style="font-weight: bold;">สภาพใบ</span>
    <span>
      <input readonly type="checkbox" name="leafCh1" <?php getData($tree,'checkbox','leafCh1');?>>
    </span>
    <span>ปกติ</span>
  
    <span>
      <input readonly type="checkbox" name="leafCh2" <?php getData($tree,'checkbox','leafCh2');?>>
    </span>
    <span>ผลัดใบ</span>
  
    <span>
      <input readonly type="checkbox" name="leafCh3" <?php getData($tree,'checkbox','leafCh3');?>>
    </span>
    <span>ผิดปกติ</span>
  
    <span>
      <input readonly type="checkbox" name="leafCh4" <?php getData($tree,'checkbox','leafCh4');?>>
    </span>
    <span>ร่วง</span>
    <span>
      <input readonly type="text"  class="hideme" id="input" style="width: 4%;" value="<?php getData($tree,'text','leafCh4_text'); ?>">
    </span>
    <span>%</span>

    <span>
      <input readonly type="checkbox" name="leafCh5" <?php getData($tree,'checkbox','leafCh5');?>>
    </span>
    <span>ซีดเหลือง</span>
    <span>
      <input readonly type="text"  class="hideme" id="input" style="width: 4%;" value="<?php getData($tree,'text','leafCh5_text'); ?>">
    </span>
    <span>%</span>

    <span>
      <input readonly type="checkbox" name="leafCh5_5" <?php getData($tree,'checkbox','leafCh5_5');?>>
    </span>
    <span>แห้ง</span>
    <span>
      <input readonly type="text"  class="hideme" id="input" style="width: 4%;" value="<?php getData($tree,'text','leafCh6_text'); ?>">
    </span>
    <span>%</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">ตัวการที่มีชีวิต</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 7cm;" value="<?php getData($tree,'text','monster1'); ?>">
    </span>
  <span>อาการ</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 14cm;" value="<?php getData($tree,'text','symptom1'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 
  <span style="font-weight: bold;">ตัวการที่ไม่มีชีวิต</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 7cm;" value="<?php getData($tree,'text','monster2'); ?>">
    </span>
  <span>อาการ</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 14cm;" value="<?php getData($tree,'text','symptom2'); ?>">
    </span>

<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<br><br>

  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      การรับแรงกระทำจากลมของต้นไม้
    </span>
  </div></center>

<span style="font-weight: bold;">การรับลม</span>
<span>
  <input readonly type="radio" name="windImpact" <?php getData($tree,'radio','windImpact','มีการป้องกัน'); ?> >
</span>
<span>มีการป้องกัน</span>

<span>
  <input readonly type="radio" name="windImpact" <?php getData($tree,'radio','windImpact','บางส่วน'); ?>>
</span>
<span>บางส่วน</span>

<span>
  <input readonly type="radio" name="windImpact" <?php getData($tree,'radio','windImpact','เต็มที่'); ?>>
</span>
<span>เต็มที่</span>

<span>
  <input readonly type="radio" name="windImpact" <?php getData($tree,'radio','windImpact','อุโมงค์ลม'); ?>>
</span>
<span>อุโมงค์ลม</span>


<!-- - - - - - - - - - - - -  - - - - - - - - - - - - - - - - - - -  -->
  <span id="tab" style="font-weight: bold;">ขนาดเรือนยอดสัมพัทธ์</span>
  <span>
    <input readonly type="radio" name="topSize" <?php getData($tree,'radio','topSize','เล็ก'); ?>>
  </span>
  <span>เล็ก</span>

  <span>
    <input readonly type="radio" name="topSize" <?php getData($tree,'radio','topSize','กลาง'); ?>>
  </span>
  <span>กลาง</span>

  <span>
    <input readonly type="radio" name="topSize" <?php getData($tree,'radio','topSize','ใหญ่'); ?>>
  </span>
  <span>ใหญ่</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
  <span style="font-weight: bold;">ความหนาแน่นเรือนยอด</span>
  <span>
    <input readonly type="radio" name="topThick" <?php getData($tree,'radio','topThick','โปร่ง'); ?>>
  </span>
  <span>โปร่ง</span>

  <span>
    <input readonly type="radio" name="topThick" <?php getData($tree,'radio','topThick','ปานกลาง'); ?> >
  </span>
  <span>ปานกลาง</span>

  <span>
    <input readonly type="radio" name="topThick" <?php getData($tree,'radio','topThick','ทึบ'); ?>>
  </span>
  <span>ทึบ</span>


<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
  <span id="tab" style="font-weight: bold;">กาฝาก/เถาวัลย์</span>
  <span>
    <input readonly type="radio" name="parasite" <?php getData($tree,'radio','parasite','ไม่มี'); ?>>
  </span>
  <span>ไม่มี</span>

  <span>
    <input readonly type="radio" name="parasite" <?php getData($tree,'radio','parasite','มาก'); ?>>
  </span>
  <span>มาก</span>

  <span>
    <input readonly type="radio" name="parasite" <?php getData($tree,'radio','parasite','ปานกลาง'); ?>>
  </span>
  <span>ปานกลาง</span>

  <span>
    <input readonly type="radio" name="parasite" <?php getData($tree,'radio','parasite','น้อย'); ?>>
  </span>
  <span>น้อย</span>

  <!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
<span style="font-weight: bold;">ปริมาณกิ่งในเรือนยอด</span>
<span>
  <input readonly type="radio" name="amount_of_branch" <?php getData($tree,'radio','amount_of_branch','มาก'); ?>>
</span>
<span>มาก</span>

<span>
  <input readonly type="radio" name="amount_of_branch" <?php getData($tree,'radio','amount_of_branch','ปานกลาง'); ?>>
</span>
<span>ปานกลาง</span>

<span>
  <input readonly type="radio" name="amount_of_branch" <?php getData($tree,'radio','amount_of_branch','น้อย'); ?>>
</span>
<span>น้อย</span>

<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
<span id="tab" style="font-weight: bold;">การเปลี่ยนแปลงพื้นที่ในอนาคตที่มีผลต่อแรงลม</span>
<span>
  <input readonly type="radio" name="changeAreaFuture" <?php getData($tree,'radio','changeAreaFuture','มี'); ?>>
</span>
<span>มี</span>

<span>
  <input readonly type="radio" name="changeAreaFuture" <?php getData($tree,'radio','changeAreaFuture','ไม่มี'); ?>>
</span>
<span>ไม่มี</span>



<!-- - - - - - - - -ปัจจัยเสี่ยงและโอกาสในการเกิดอันตรายของต้นไม้ - - - - - - - - - - - -  -->

<br><br>
  
  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      ปัจจัยเสี่ยงและโอกาสในการเกิดอันตรายของต้นไม้
    </span>
  </div></center>
  

<span style="font-weight: bold; background-color: yellow;">เรือนยอดและกิ่ง</span> 

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">ความสมดุลของเรือนยอด</span>
  <span>
    <input readonly type="radio" name="topBalance" <?php getData($tree,'radio','topBalance','ดี'); ?>>
  </span>
  <span>ดี</span>

  <span>
    <input readonly type="radio" name="topBalance" <?php getData($tree,'radio','topBalance','ไม่ดี'); ?>>
  </span>
  <span>ไม่ดี</span>


  <span id="tab" style="font-weight: bold;">Live-Crown ration</span>
    <span>
      <input readonly type="text" class="hideme" name="liveCrownPercen" id="input" style="width: 3cm;" value="<?php getData($tree,'text','liveCrownPercen'); ?>">
    </span>
  <span style="font-weight: bold;">%</span>
  <span>
    <input readonly type="checkbox">
  </span>
  <span>มีร่องรอยความเสียหายของกิ่ง</span>


<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span>
    <input readonly type="checkbox" name="dryBranches" <?php getData($tree,'checkbox','dryBranches');?>>
  </span>
  <span>กิ่งแห้ง</span>
   <span>
      <input readonly type="text" name="limbDie" class="hideme" id="input" style="width: 1cm;" value="<?php getData($tree,'text','limbDie'); ?>">
    </span>
  <span>%</span>

  <span>ขนาดใหญ่สุด</span>
   <span>
      <input readonly type="text" class="hideme" name="limbDieSize" id="input" style="width: 1.5cm;" value="<?php getData($tree,'text','limbDieSize'); ?>">
    </span>
  <span>ซม.</span>


  <span id="tab">
    <input readonly type="checkbox" name="brokenBranches" <?php getData($tree,'checkbox','brokenBranches');?>>
  </span>
  <span>กิ่งหักแขวน</span>

  <span id="tab">จำนวน</span>
   <span>
      <input readonly type="text" class="hideme" name="limbBroke" id="input" style="width: 1.5cm;" value="<?php getData($tree,'text','limbBroke'); ?>">
    </span>
  <span>กิ่ง</span>

  <span id="tab">ขนาดใหญ่สุด</span>
   <span>
      <input readonly type="text" class="hideme" name="limbBrokeSize" id="input" style="width: 1.5cm;" value="<?php getData($tree,'text','limbBrokeSize'); ?>">
    </span>
  <span>ซม.</span>

    <!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด -->

  <span>
    <input readonly type="checkbox" name="limbLesion" <?php getData($tree,'checkbox','limbLesion');?>>
  </span>
  <span>รอยแผลกิ่ง</span>

  <span>
    <input readonly type="checkbox" name="limbHole" <?php getData($tree,'checkbox','limbHole');?>>
  </span>
  <span>รอยผุโพรงหรือรู</span>

  <span>
    <input readonly type="checkbox" name="limbNode" <?php getData($tree,'checkbox','limbNode');?>>
  </span>
  <span>ปุ่มปม</span>

  <span>
    <input readonly type="checkbox" name="limbRotten" <?php getData($tree,'checkbox','limbRotten');?>>
  </span>
  <span>เน่า</span>

  <span>
    <input readonly type="checkbox" name="limbFungus" <?php getData($tree,'checkbox','limbFungus');?>>
  </span>
  <span>เชื้อราเห็ด</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">ประวัติการลิดกิ่ง</span>
  
  <span>
    <input readonly type="radio" name="limbLit" <?php getData($tree,'radio','limbLit','เหมาะสม'); ?>>
  </span>
  <span>เหมาะสม</span>

  <span>
    <input readonly type="radio" name="limbLit" <?php getData($tree,'radio','limbLit','ไม่เหมาะสม'); ?>>
  </span>
  <span>ไม่เหมาะสม</span>

  <span>&nbspรายละเอียด</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 10cm;" value="<?php getData($tree,'text','limbLitOther'); ?>" >
    </span> 


<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">สิ่งที่ต้องเฝ้าระวัง</span>
    <span>
      <input readonly type="text" class="hideme" name="topStayAlert" id="input" style="width: 15cm;" value="<?php getData($tree,'text','topStayAlert'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">โอกาสในการเกิดอันตราย</span>
  
  <span>
    <input readonly type="radio" name="topHarmChance" <?php getData($tree,'radio','topHarmChance','น้อย'); ?>>
  </span>
  <span>น้อย</span>

  <span>
    <input readonly type="radio" name="topHarmChance" <?php getData($tree,'radio','topHarmChance','ปานกลาง'); ?>>
  </span>
  <span>ปานกลาง</span>

  <span>
    <input readonly type="radio" name="topHarmChance" <?php getData($tree,'radio','topHarmChance','มาก'); ?>>
  </span>
  <span>มาก</span>

  <span>
    <input readonly type="radio" name="topHarmChance" <?php getData($tree,'radio','topHarmChance','มากที่สุด'); ?>>
  </span>
  <span>มากที่สุด</span>

<br><br> <!-- - - - - - - - - - -  ลำต้น  - - - - - - - - - - - - - -  -->

  

  <span style="font-weight: bold; background-color: yellow;">ลำต้น</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkTwin');?>>
  </span>
  <span>&nbspแตก2นาง</span>

  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkTogather');?>>
  </span>
  <span>&nbspมีเปลือกร่วม</span>

  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkDie');?>> 
  </span>
  <span>&nbspเปลือกแห้ง/หลุดร่อน</span>

  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkAbnormal');?>>
  </span>
  <span>&nbspเปลือกผิดปกติ</span>

  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkBroke');?>>
  </span>
  <span>&nbspมีรอยแตก</span>
  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkHole');?>>
  </span>
  <span>&nbspโพรง</span>
  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkDecay');?>>
  </span>
  <span>&nbspผุ</span>

  <!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkLiquid');?>>
  </span>
  <span>&nbspมีน้ำยางหรือของเหลวไหลออกจากเปลือก</span>

  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkNode');?>>
  </span>
  <span>มีปุ่มปมหรือตา</span>

  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkDecayDamage');?>>
  </span>
  <span>&nbspเนื้อไม้ผุเสียหาย</span>

  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkFungus');?>>
  </span>
  <span>&nbspมีเชื้อราเห็ด</span>


  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkThin');?>>
  </span>
  <span>&nbspความเรียวผิดปกติ</span>

  <span>
    <input readonly type="checkbox" <?php getData($tree,'checkbox','trunkSlope_checkbox');?>>
  </span>
  <span>&nbspเอียง</span>
    <span>
      <input readonly type="text" class="hideme" name="trunkSlope" id="input" style="width: 2cm;" value="<?php getData($tree,'text','trunkSlope'); ?>">
    </span>
  <span>องศา</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">สิ่งที่ต้องเฝ้าระวัง</span>
    <span>
      <input readonly type="text" class="hideme" name="trunkStayAlert" id="input" style="width: 15cm;" value="<?php getData($tree,'text','trunkStayAlert'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">โอกาสในการเกิดอันตราย</span>
  <span>
    <input readonly type="radio" name="trunkHarmChance" <?php getData($tree,'radio','trunkHarmChance','น้อย'); ?> >
  </span>
  <span>น้อย</span>

  <span>
    <input readonly type="radio" name="trunkHarmChance" <?php getData($tree,'radio','trunkHarmChance','ปานกลาง'); ?>>
  </span>
  <span>ปานกลาง</span>

  <span>
    <input readonly type="radio" name="trunkHarmChance" <?php getData($tree,'radio','trunkHarmChance','มาก'); ?>>
  </span><span>มาก</span>

  <span>
    <input readonly type="radio" name="trunkHarmChance" <?php getData($tree,'radio','trunkHarmChance','มากที่สุด'); ?>>
  </span>
  <span>มากที่สุด</span>


<br><br> <!-- - - - - - - - - - -  ราก  - - - - - - - - - - - - - -  -->

  <span style="font-weight: bold; background-color: yellow;">ราก</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 
  <span>
    <input readonly type="checkbox" name="rootDown" <?php getData($tree,'checkbox','rootDown');?> >
    <span>โคนต้นฝังดิน</span>
  </span> 
  
  <span>
    <input readonly type="checkbox" name="rootWrap" <?php getData($tree,'checkbox','rootWrap');?> >
    <span>รากพันโคนต้น</span>
  </span>

  <span>
    <input readonly type="checkbox" name="rootUp" <?php getData($tree,'checkbox','rootUp');?>></span>
    <span>โผล่พ้นดิน</span>
  </span>
  
  <span>
    <input readonly type="checkbox" name="rootBroke" <?php getData($tree,'checkbox','rootBroke');?>>
  </span>
  <span>แตกหักหรือถูกตัด</span>

  <span>
    <input readonly type="checkbox" name="rootLesion" <?php getData($tree,'checkbox','rootLesion');?>>
  </span>
  <span>เสียดสี</span>

  <span>
    <input readonly type="checkbox" name="rootLiquid" <?php getData($tree,'checkbox','rootLiquid');?>>
  </span>
  <span>มีของเหลวไหลจากเปลือก</span>

  <span>
    <input readonly type="checkbox" name="rootNode" <?php getData($tree,'checkbox','rootNode');?>>
  </span>
  <span>มีปุ่มปมหรือตา</span>

  <span>
    <input readonly type="checkbox" name="rootDecay" <?php getData($tree,'checkbox','rootDecay');?>>
  </span>
  <span>ผุ</span>
 
 <!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 
<span>
  <input readonly type="checkbox" name="rootCavity" <?php getData($tree,'checkbox','rootCavity');?>>
  <span>โพรง</span>
<span>
  <input readonly type="checkbox" name="rootFungus" <?php getData($tree,'checkbox','rootFungus');?> >
  <span>เชื้อรา เห็ด</span>
<span>
  <input readonly type="checkbox" name="rootWater" <?php getData($tree,'checkbox','rootWater');?> >
  <span>น้ำแช่ขัง</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">สิ่งที่ต้องเฝ้าระวัง</span>
    <span>
      <input readonly type="text" class="hideme" name="rootStayAlert" id="input" style="width: 15cm;" value="<?php getData($tree,'text','rootStayAlert'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">โอกาสในการเกิดอันตราย</span>
  
  <span>
    <input readonly type="radio" name="rootHarmChance" <?php getData($tree,'radio','rootHarmChance','น้อย'); ?> >
  </span>
  <span>น้อย</span>

  <span>
    <input readonly type="radio" name="rootHarmChance" <?php getData($tree,'radio','rootHarmChance','ปานกลาง'); ?>>
  </span>
  <span>มีโอกาสปานกลาง</span>

  <span>
    <input readonly type="radio" name="rootHarmChance" <?php getData($tree,'radio','rootHarmChance','มาก'); ?>>
  </span>
  <span>มาก</span>

  <span>
    <input readonly type="radio" name="rootHarmChance"  <?php getData($tree,'radio','strong','มากที่สุด'); ?> >
  </span>
  <span>มากที่สุด</span>



<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
  <br><br>

  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      การประเมินระดับความเสี่ยงอันตราย
    </span>
  </div></center> 


  
          <table>
                <thead>
                  <tr>
                    <!-- <th rowspan="3" class="center aligned">ลำดับที่</th> -->
                    <th rowspan="3" class="rotate1"><div style="width: 30px;"><span>ลำดับของเป้าหมาย</span></div></th>

                    <th rowspan="3" class="rotate1"><div style="width: 50px;"><span>ส่วนที่อันตราย</span></div></th>
      
                    <th rowspan="3" class="rotate1"><div style="width: 50px;"><span>รายละเอียดของปัจจัยเสี่ยง</span></div></th>
                 

                    <th colspan="12" style="text-align: center;">โอกาสในการเกิด</th>
                    <th colspan="4" style="text-align: center;">ระดับความรุนแรงของความผลกระทบ</th>
                    <th rowspan="3" class="rotate1"><div style="width: 50px;"><span>ระดับความเสี่ยงอันตราย<br>(matrix2)</span></div></th>
                  </tr>

                  <tr>
                    <th colspan="4" style="text-align: center;">ความล้มเหลวของต้นไม้</th>
                    <th colspan="4" style="text-align: center;">ผลกระทบต่อเป้าหมาย</th>
                    <th colspan="4" style="text-align: center;">ความเสียหาย + ผลกระทบ(matrix1)</th>
                    
                    <th rowspan="2" class="rotate2"><div style="width: 30px;"><span>ต่ำ</span></div></th>
                    <th rowspan="2" class="rotate2"><div style="width: 30px;"><span>ปานกลาง</span></div></th>
                    <th rowspan="2" class="rotate2"><div style="width: 30px;"><span>รุนแรง</span></div></th>
                    <th rowspan="2" class="rotate2"><div style="width: 30px;"><span>รุนแรงมาก</span></div></th>
                  </tr>

                  <tr>
                    <th class="rotate2"><div style="width: 30px;"><span>น้อย</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ปานกลาง</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>มาก</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>มากที่สุด</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ต่ำมาก</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ตำ่</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ปานกลาง</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>สูง</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>น้อย</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ค่อนข้างน้อย</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>มาก</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>มากที่สุด</span></div></th> 
                  </tr>
                </thead>
   
                <tbody>
                  
                @if($tree!=NULL and $tree['treePartName']!=NULL)
                  <?php $n=0; ?>
                  @foreach($tree['treePartName'] as $value)
                  <tr>  <!-- ราก -->
                    
                    <td style="text-align: center;"><?php echo $n+1; ?></td>

                    <td class="bigtable_wordwrap1" style="text-align: center;"><?php echo $tree['treePartName'][$n]; ?></td>
                    
                    <td>    <!-- ปัจจัยเสี่ยงอันตราย -->
                      <p class="bigtable_wordwrap1"><?php echo $tree['treePartFactor'][$n]; ?></p> 
                    </td>

                    
                    
                   <!--  ความเสียหาย -->
                   <td>
                      <center>
                        <select id="arrow" name="treePartDamage[<?php echo $n; ?>]">
                          <option type="hidden">เลือก</option>
                          <option value="1" <?php if($tree['treePartDamage'][$n]=="1"){ echo "selected=''";}?>>น้อย</option>
                          <option value="2" <?php if($tree['treePartDamage'][$n]=="2"){ echo "selected=''";}?>>ปานกลาง</option>
                          <option value="3" <?php if($tree['treePartDamage'][$n]=="3"){ echo "selected=''";}?>>มาก</option>
                          <option value="4" <?php if($tree['treePartDamage'][$n]=="4"){ echo "selected=''";}?>>มากที่สุด</option>
                        </select>
                      </center>
                    </td>

                    <!-- ผลกระทบ -->
                    <td>
                        <center>
                          <select id="arrow" name="treePartImpact[<?php echo $n; ?>]">
                            <option type="hidden">เลือก</option>
                            <option value="1" <?php if($tree['treePartImpact'][$n]=="1"){ echo "selected=''";}?>>ต่ำมาก</option>
                            <option value="2" <?php if($tree['treePartImpact'][$n]=="2"){ echo "selected=''";}?>>ต่ำ</option>
                            <option value="3" <?php if($tree['treePartImpact'][$n]=="3"){ echo "selected=''";}?>>ปานกลาง</option>
                            <option value="4" <?php if($tree['treePartImpact'][$n]=="4"){ echo "selected=''";}?>>สูง</option>
                          </select>
                        </center>
                      </td>

                    <!-- ความเสียหาย+ผลกระทบ(matrix1) -->
                    <td>
                      <center>
                        <select id="arrow" name="treePartPlus[<?php echo $n; ?>]">
                          <option type="hidden">เลือก</option>
                          <option value="1" <?php if($tree['treePartPlus'][$n]=="1"){ echo "selected=''";}?>>น้อย</option>
                          <option value="2" <?php if($tree['treePartPlus'][$n]=="2"){ echo "selected=''";}?>>ค่อนข้างน้อย</option>
                          <option value="3" <?php if($tree['treePartPlus'][$n]=="3"){ echo "selected=''";}?>>มาก</option>
                          <option value="4" <?php if($tree['treePartPlus'][$n]=="4"){ echo "selected=''";}?>>มากที่สุด</option>
                        </select>
                      </center>
                    </td>
                    

                    <!-- ระดับความรุนแรงของความเสียหาย -->
                    <td>
                      <center>
                        <select id="arrow" name="treePartRank[<?php echo $n; ?>]">
                          <option type="hidden">เลือก</option>
                          <option value="1" <?php if($tree['treePartRank'][$n]=="1"){ echo "selected=''";}?>>ต่ำ</option>
                          <option value="2" <?php if($tree['treePartRank'][$n]=="2"){ echo "selected=''";}?>>ปานกลาง</option>
                          <option value="3" <?php if($tree['treePartRank'][$n]=="3"){ echo "selected=''";}?>>รุนแรง</option>
                          <option value="4" <?php if($tree['treePartRank'][$n]=="4"){ echo "selected=''";}?>>รุนแรงมาก</option>
                        </select>
                      </center>
                    </td>

                    <!-- ระดับความอันตราย(matrix2) -->
                      <!-- <p class="bigtable_wordwrap1">ปานกลาง</p> -->
                    <td style="text-align: center;">
                    <input readonly class="hideme" id="input" type="text" name="treeDamage[<?php echo $n; ?>]" value="<?php echo $tree['treeDamage'][$n]; ?>" >
                    </td>
                  </tr> <!-- end ราก -->
                  <?php $i++; ?>
                  @endforeach
                @endif

                  
                </tbody>
          </table>



<!-- - - - - - - - - - - - - matrix1 - - - - - - - - - - - - - - -->
  <br>

  <div class="ui grid">
      <div class="nine wide column"> <!-- - - -  matrix1 - - - - - -->
          
          <center>
              <span style="font-weight: bold;">ตารางประเมินโอกาสในการเกิด (matrix1)</span>
          </center>

          <table style="width: 100%;">
              <thead>
                  <tr>
                    <th rowspan="2" style="text-align: center; height: 80px;">โอกาสในการเกิดความเสียหาย</th>
                    <th colspan="4" style="text-align: center; ">โอกาสในการเกิดผลกระทบ</th>
                  </tr>

                  <tr>
                    <th style="text-align: center;">ต่ำมาก</th>
                    <th style="text-align: center;">ต่ำ</th>
                    <th style="text-align: center;">ปานกลาง</th>
                    <th style="text-align: center;">สูง</th>
                  </tr>
              </thead>

              <tbody>
                <tr>
                  <td style="font-weight: bold; text-align: center;">มากที่สุด</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">ค่อนข้างน้อย</td>
                  <td style="text-align: center;">เป็นไปได้</td>
                  <td style="text-align: center;">มากที่สุด</td>
                </tr>

                <tr>
                  <td  style="font-weight: bold; text-align: center">มาก</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">ค่อนข้างน้อย</td>
                  <td style="text-align: center;">มาก</td>
                </tr>

                <tr>
                  <td style="font-weight: bold; text-align: center">ปานกลาง</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">ค่อนข้างน้อย</td>
                </tr>

                <tr>
                  <td style="font-weight: bold; text-align: center;">น้อย</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">น้อย</td>
                </tr>
          </table>
      </div>  <!--  end matrix 1 -->


<!-- - - - - - - - - - - - - matrix2 - - - - - - - - - - - - - - -->
      <div class="seven wide column">  <!-- matrix 2 -->

          <center>
              <span style="font-weight: bold; width: ">ตารางประเมินระดับความอันตราย (matrix2)</span>
          </center>

          <table style="width: 100%;">
              <thead>
                  <tr>
                    <th rowspan="2" style="text-align: center; height:  80px;">โอกาสในการเกิด ความเสียหาย<br>และผลกระทบ (matrix1)</th>
                    <th colspan="4" style="text-align: center; ">ระดับความรุนแรงของความเสียหาย</th>
                  </tr>

                  <tr>
                    <th style="text-align: center;">ต่ำ</th>
                    <th style="text-align: center;">ปานกลาง</th>
                    <th style="text-align: center;">รุนแรง</th>
                    <th style="text-align: center;">รุนแรงมาก</th>
                  </tr>
              </thead>

              <tbody>
                <tr>
                  <td style="font-weight: bold; text-align: center;">มากที่สุด</td>
                  <td style="text-align: center;">ต่ำ</td>
                  <td style="text-align: center;">ปานกลาง</td>
                  <td style="text-align: center;">สูง</td>
                  <td style="text-align: center;">สูงที่สุด</td>
                </tr>

                <tr>
                  <td style="font-weight: bold; text-align: center;">มาก</td>
                  <td style="text-align: center;">ต่ำ</td>
                  <td style="text-align: center;">ปานกลาง</td>
                  <td style="text-align: center;">สูง</td>
                  <td style="text-align: center;">สูง</td>
                </tr>

                <tr>
                  <td style="font-weight: bold; text-align: center;">ค่อนข้างน้อย</td>
                  <td style="text-align: center;">ต่ำ</td>
                  <td style="text-align: center;">ต่ำ</td>
                  <td style="text-align: center;">ปานกลาง</td>
                  <td style="text-align: center;">ปานกลาง</td>
                </tr>

                <tr>
                  <td style="font-weight: bold; text-align: center;">น้อย</td>
                  <td style="text-align: center;">ต่ำ</td>
                  <td style="text-align: center;">ต่ำ</td>
                  <td style="text-align: center;">ต่ำ</td>
                  <td style="text-align: center;">ต่ำ</td>
                </tr>
          </table>
      </div>  <!--  end matrix 2 -->
  </div>  <!--  end grid -->


  <br>

  <span style="font-weight: bold;">คำอธิบายเพิ่มเติม</span>
    <span>
      <input readonly type="text" class="hideme" name="moreDetail" id="input" style="width: 25cm;" value="<?php getData($tree,'text','moreDetail'); ?>">
    </span>
    
    <!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 
  <span style="font-weight: bold;">วิธีแก้ไข</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 10cm;" value=" <?php getData($tree,'text','Solution1'); ?> ">
    </span>
  <span style="font-weight: bold;">ปัญหาที่เหลือ</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 11cm;" value=" <?php getData($tree,'text','problem1'); ?> ">
    </span>

        <!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 
  <span style="font-weight: bold;">วิธีแก้ไข</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 10cm;" value=" <?php getData($tree,'text','Solution2'); ?> ">
    </span>
  <span style="font-weight: bold;">ปัญหาที่เหลือ</span>
    <span>
      <input readonly type="text" class="hideme" id="input" style="width: 11cm;" value=" <?php getData($tree,'text','problem2'); ?> ">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">ผลการประเมินความเสี่ยงอันตรายจากต้นไม้ในภาพรวม</span>
  
  <span>
    <input readonly type="radio" name="totalDamage" <?php getData($tree,'radio','totalDamage','ต่ำ'); ?> >
  </span>
  <span>ต่ำ</span>

  <span>
    <input readonly type="radio" name="totalDamage" <?php getData($tree,'radio','totalDamage','ปานกลาง'); ?>>
  </span>
  <span>ปานกลาง</span>

  <span>
    <input readonly type="radio" name="totalDamage" <?php getData($tree,'radio','totalDamage','สูง'); ?>>
  </span>
  <span>สูง</span>

  <span>
    <input readonly type="radio" name="totalDamage" <?php getData($tree,'radio','totalDamage','สูงที่สุด'); ?>>
  </span>
  <span>สูงที่สุด</span>



<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">ความเร่งด่วนในการดำเนินงาน</span>
  <span>
    <input readonly type="radio" name="operateTime" <?php getData($tree,'radio','operateTime','ทันที'); ?>>
  </span>
  <span>ทันที</span>

  <span>
    <input readonly type="radio" name="operateTime" <?php getData($tree,'radio','operateTime','ภายใน1เดือน'); ?>>
  </span>
  <span>ภายใน1เดือน</span>

  <span>
    <input readonly type="radio" name="operateTime" <?php getData($tree,'radio','operateTime','ภายใน3-5เดือน'); ?>>
  </span>
  <span>ภายใน3-5เดือน</span>

  <span>
    <input readonly type="radio" name="operateTime" <?php getData($tree,'radio','operateTime','ภายใน6-12เดือน'); ?>>
  </span>
  <span>ภายใน6-12เดือน</span>
  
<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">การประเมินเพิ่มเติม</span>
  <span>
    <input readonly type="radio" name="moreEvaluate" <?php getData($tree,'radio','moreEvaluate','ไม่ต้องการ'); ?>>
  </span>
  <span>ไม่ต้องการ</span>

  <span>
    <input readonly type="radio" name="moreEvaluate" <?php getData($tree,'radio','moreEvaluate','ต้องการ เรื่อง'); ?>>
  </span>
  <span>ต้องการ</span>
  <span>เรื่อง</span>
    <span>
      <input readonly type="text" class="hideme" name="needMore" id="input" style="width: 20%;" value="<?php getData($tree,'text','needMore'); ?>">
    </span>

  <span style="font-weight: bold;">ระยะเวลาที่ควรมีการตรวจสอบ(ทุกๆ)</span>
  <span>
      <input readonly type="text" class="hideme" id="input" style="width: 15%;" value="<?php getData($tree,'text','validTime'); ?>">
    </span>
@stop