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

                  <!-- <div class="eight wide column">
                    <span>ผู้ว่าจ้าง</span>
                    <input  type="text" name="hire" value="<?php getData($tree,'text','hire'); ?>" class="form-control" >
                  </div> -->

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
                      <input type="date" id="dateform" value="<?php getData($tree,'text','Tree_date'); ?>" class="form-control" name="Tree_date" min="1990-01-02">
                  </div>

                  <div class="three wide column">
                    <span>เวลา</span>
                    <input class="form-control timestamp" type="text" value="<?php getData($tree,'text','Tree_time'); ?>" name="Tree_time" id="example-time-input" disabled> 
                  </div>


                  <div class="two wide column">
                    <span>ต้นที่</span>
                    <input id="Tree_sequence" type="number" value="<?php getData($tree,'text','Tree_sequence'); ?>" class="form-control anti-Minus" name="Tree_sequence" >
                  </div>

                  <div class="three wide column">
                    <span>พิกัดละติจูด</span>
                    <input id="Tree_lat" type="number" step="0.000001" value="<?php if(!empty($lat)){ echo $lat; }else { getData($tree,'text','Tree_lat'); } ?>" class="form-control anti-Minus" name="Tree_lat" require="">
                  </div>

                  <div class="three wide column">
                    <span>พิกัดลองจิจูด</span>
                    <input id="Tree_long" type="number" step="0.000001" value="<?php if(!empty($lng)){ echo $lng; }else { getData($tree,'text','Tree_long'); } ?>" class="form-control anti-Minus" name="Tree_long" require="">
                  </div>

                  <div class="two wide column">
                    <br>
                    <button type="button" onclick="getLocation();" class="btn btn-primary">ค้นหาพิกัด</button>
                  </div> 


                  <div class="five wide column">
                    <span>ชนิด</span>
                    <input id="TreeName" type="text" value="<?php getData($tree,'text','Tree_name'); ?>" class="form-control" name="Tree_name" require="">
                  </div>

                  <div class="five wide column">
                    <span>ชื่อวิทยาศาสตร์</span>
                    <input id="sciName" type="text" value="<?php getData($tree,'text','Tree_sci_name'); ?>" class="form-control" name="Tree_sci_name" >
                  </div>

                  <div class="five wide column">
                    <span>เส้นผ่านศูนย์กลางเพียงอก (ซม.)</span>
                    <input id="Tree_diameter_Trunk" type="number" step="0.01" value="<?php getData($tree,'text','Tree_diameter_Trunk'); ?>" class="form-control anti-Minus" name="Tree_diameter_Trunk" require="">
                    <span id="miss_diameter_trunk" style="color: red;"></span>
                  </div>

                  <div class="five wide column">
                    <span>ความสูงทั้งหมด (ม.)</span>
                    <input id="Tree_height" type="number" step="0.01" value="<?php getData($tree,'text','Tree_height'); ?>" class="form-control anti-Minus" name="Tree_height" >
                  </div>

                  <div class="five wide column">
                    <span>เส้นผ่านศูนย์กลางเรือนยอด (ม.)</span>
                    <input id="Tree_diameter_Top" type="number" step="0.01" value="<?php getData($tree,'text','Tree_diameter_Top'); ?>" class="form-control anti-Minus" name="Tree_diameter_Top" >
                    
                  </div>

                  <div class="five wide column">
                    <span>ผู้ประเมิน</span>
                    <input type="text" value="<?php echo $userlogin['username'] ?>" class="form-control" name="User_name" require="">
                    <input type="hidden" name="UserID" value="<?php echo $userlogin['_id'] ?>">
                  </div>

                  <div class="five wide column">
                    <span>หน่วยงาน</span>
                    <input type="text" value="<?php echo $userlogin['department'] ?>" class="form-control" name="agency" >
                  </div>

                 <div class="five wide column">
                    <span>โทรศัพท์</span>
                    <input  type="number"  class="form-control input-md" value="<?php getData($tree,'text','Tree_phone'); ?>" name="Tree_phone" require="">
                  </div>

             

                  <script type="text/javascript">
                    var d = new Date();
                    var str = d.toString();
                    document.getElementsByClassName("timestamp").innerHTML = d.toUTCString().split(' ')[4];
                    document.getElementById("dateform").innerHTML = month()+'/'+str.split(' ')[2]+'/'+str.split(' ')[3];

                    function month(){
                      switch(str.split(' ')[1]){
                          case "Jan" : return "01";
                            case "Feb" : return "02";
                            case "Mar" : return "03";
                            case "Apr" : return "04";
                            case "May" : return "05";
                            case "Jun" : return "06";
                            case "Jul" : return "07";
                            case "Aug" : return "08";
                            case "Sep" : return "09";
                            case "Oct" : return "10";
                            case "Nov" : return "11";
                            case "Dec" : return "12";
                        }
                    }
       
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
                <table class="ui basic celled structured table" id="table_damage">
                  <thead>
                  <tr>
           
                    <th rowspan="2" class="center aligned" id="ten_per">รายละเอียดของสิ่งที่จะเกิดความเสียหาย</th>
                    <th colspan="3" class="center aligned">บริเวณที่อาจเกิดความเสียหาย</th>
                    <th rowspan="2" class="center aligned" id="five_per">การปรากฎอยู่ของสิ่งที่จะเสียหาย</th>
                    <th rowspan="2" class="center aligned" id="five_per">การเคลื่อนย้ายออกจากพื้นที่อันตราย</th>
                    <th rowspan="2" class="center aligned" id="five_per">ห้ามเข้าพื้นที่อันตราย</th>
                    <th rowspan="2" id="five_per"></th>
                  </tr>
                  <tr>
                    <th id="five_per">ใต้เรือนยอด</th>
                    <th id="five_per">1 เท่าของความสูง</th>
                    <th id="five_per">1.5เท่าของความสูง</th>
                  </tr>
                  </thead>
                <tbody>
                  <tr>
                    
                    <!-- <td><input type="text" class="hideme" name="vehicle" value="รถยนต์/รถจักรยานยนต์" readonly></td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="vehCh1" <?php getData($tree,'checkbox','vehCh1');?>>
                      </div>
                    </td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="vehCh2" <?php getData($tree,'checkbox','vehCh2');?>>
                      </div>
                    </td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="vehCh3" <?php getData($tree,'checkbox','vehCh3');?>>
                      </div>
                    </td>  
                    <td class="center aligned">
                        <select name="vehDamageAppear">   
                          <option value="0">โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','vehDamageAppear','1');?>>1-พบน้อยมาก</option>
                          <option value="2" <?php getData($tree,'select','vehDamageAppear','2');?>>2-พบบางครั้ง</option>
                          <option value="3" <?php getData($tree,'select','vehDamageAppear','3');?>>3-พบบ่อย</option>
                          <option value="4" <?php getData($tree,'select','vehDamageAppear','4');?>>4-อยู่บริเวณนั้น</option>
                        </select>
                    </td> 
                    <td class="center aligned">
                        <select name="vehMoveArea">   
                          <option value="0" <?php getData($tree,'select','vehMoveArea','0');?> >โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','vehMoveArea','1');?>>มีโอกาสเกิด</option>
                          <option value="2" <?php getData($tree,'select','vehMoveArea','2');?>>ไม่มีโอกาสเกิด</option>
                        </select>
                    </td>  
                    <td class="center aligned">
                        <select name="vehNoEntry">   
                          <option value="0" <?php getData($tree,'select','vehNoEntry','0');?>>โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','vehNoEntry','1');?>>มีโอกาสเกิด</option>
                          <option value="2" <?php getData($tree,'select','vehNoEntry','2');?>>ไม่มีโอกาสเกิด</option>
                        </select>
                    </td>  
                    <td class="center aligned"></td>
                  </tr>
                  <tr>
                    
                    <td><input type="text" class="hideme" name="building" value="อาคาร" readonly></td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="builCh1" <?php getData($tree,'checkbox','builCh1');?>>
                      </div>
                    </td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="builCh2" <?php getData($tree,'checkbox','builCh2');?>>
                      </div>
                    </td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="builCh3" <?php getData($tree,'checkbox','builCh3');?>>
                      </div>
                    </td>  
                    <td class="center aligned">
                        <select name="builDamageAppear">   
                          <option value="0" <?php getData($tree,'select','builDamageAppear','0');?>>โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','builDamageAppear','1');?>>1-พบน้อยมาก</option>
                          <option value="2" <?php getData($tree,'select','builDamageAppear','2');?>>2-พบบางครั้ง</option>
                          <option value="3" <?php getData($tree,'select','builDamageAppear','3');?>>3-พบบ่อย</option>
                          <option value="4" <?php getData($tree,'select','builDamageAppear','4');?>>4-อยู่บริเวณนั้น</option>
                        </select>
                    </td> 
                    <td class="center aligned">
                        <select name="builMoveArea">   
                          <option value="0" <?php getData($tree,'select','builMoveArea','0');?>>โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','builMoveArea','1');?>>มีโอกาสเกิด</option>
                          <option value="2" <?php getData($tree,'select','builMoveArea','2');?>>ไม่มีโอกาสเกิด</option>
                        </select>
                    </td>  
                    <td class="center aligned">
                        <select name="builNoEntry">   
                          <option value="0" <?php getData($tree,'select','builNoEntry','0');?>>โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','builNoEntry','1');?>>มีโอกาสเกิด</option>
                          <option value="2" <?php getData($tree,'select','builNoEntry','2');?>>ไม่มีโอกาสเกิด</option>
                        </select>
                    </td>
                    <td class="center aligned"></td>
                  </tr>
                  <tr>
                   
                    <td><input type="text" class="hideme" name="man" value="คน" readonly></td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="manCh1" <?php getData($tree,'checkbox','manCh1');?>>
                      </div>
                    </td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="manCh2" <?php getData($tree,'checkbox','manCh2');?>>
                      </div>
                    </td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="manCh3" <?php getData($tree,'checkbox','manCh3');?>>
                      </div>
                    </td>  
                    <td class="center aligned">
                        <select name="manDamangeArea">   
                          <option value="0" <?php getData($tree,'select','manDamangeArea','0');?>>โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','manDamangeArea','1');?>>1-พบน้อยมาก</option>
                          <option value="2" <?php getData($tree,'select','manDamangeArea','2');?>>2-พบบางครั้ง</option>
                          <option value="3" <?php getData($tree,'select','manDamangeArea','3');?>>3-พบบ่อย</option>
                          <option value="4" <?php getData($tree,'select','manDamangeArea','4');?>>4-อยู่บริเวณนั้น</option>
                        </select>
                    </td> 
                    <td class="center aligned">
                        <select name="manMoveArea">   
                          <option value="0" <?php getData($tree,'select','manMoveArea','0');?>>โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','manMoveArea','1');?>>มีโอกาสเกิด</option>
                          <option value="2" <?php getData($tree,'select','manMoveArea','2');?>>ไม่มีโอกาสเกิด</option>
                        </select>
                    </td>  
                    <td class="center aligned">
                        <select name="manNoEntry">   
                          <option value="0" <?php getData($tree,'select','manNoEntry','0');?>>โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','manNoEntry','1');?>>มีโอกาสเกิด</option>
                          <option value="2" <?php getData($tree,'select','manNoEntry','2');?>>ไม่มีโอกาสเกิด</option>
                        </select>
                    </td>
                    <td class="center aligned"></td>
                  </tr>
                  <tr>
                    
                    <td><input type="text" class="hideme" name="pillar" value="เสาไฟฟ้า" readonly></td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="pillCh1" <?php getData($tree,'checkbox','pillCh1');?>>
                      </div>
                    </td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="pillCh2" <?php getData($tree,'checkbox','pillCh2');?>>
                      </div>
                    </td>
                    <td class="center aligned">
                      <div>
                        <input type="checkbox" name="pillCh3" <?php getData($tree,'checkbox','pillCh3');?>>
                      </div>
                    </td>  
                    <td class="center aligned">
                        <select name="pillDamageAppear">   
                          <option value="0" <?php getData($tree,'select','pillDamageAppear','0');?>>โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','pillDamageAppear','1');?>>1-พบน้อยมาก</option>
                          <option value="2" <?php getData($tree,'select','pillDamageAppear','2');?>>2-พบบางครั้ง</option>
                          <option value="3" <?php getData($tree,'select','pillDamageAppear','3');?>>3-พบบ่อย</option>
                          <option value="4" <?php getData($tree,'select','pillDamageAppear','4');?>>4-อยู่บริเวณนั้น</option>
                        </select>
                    </td> 
                    <td class="center aligned">
                        <select name="pillMoveArea">   
                          <option value="0" <?php getData($tree,'select','pillMoveArea','0');?>>โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','pillMoveArea','1');?>>มีโอกาสเกิด</option>
                          <option value="2" <?php getData($tree,'select','pillMoveArea','2');?>>ไม่มีโอกาสเกิด</option>
                        </select>
                    </td>  
                    <td class="center aligned">
                        <select name="pillNoEntry">   
                          <option value="0" <?php getData($tree,'select','pillNoEntry','0');?>>โปรดเลือก</option>   
                          <option value="1" <?php getData($tree,'select','pillNoEntry','1');?>>มีโอกาสเกิด</option>
                          <option value="2" <?php getData($tree,'select','pillNoEntry','2');?>>ไม่มีโอกาสเกิด</option>
                        </select>
                    </td>
                    <td class="center aligned"></td>
                  </tr> -->
                  
                  <?php 
                    if($tree!=NULL && $tree['listDamage']!=NULL){
                      $i=0;
                      foreach ($tree['listDamage'] as $value) {
                        ?>
                        <tr>
                            <td>
                              <input class="hideme" name="listDamage[<?php echo $i; ?>]" type="text" value="<?php echo $tree['listDamage'][$i]; ?>">
                            </td>
                            <td class="center aligned">
                              <div>
                                <input type="hidden" name="ch1[<?php echo $i; ?>]" value="off">
                                <input type="checkbox" name="ch1[<?php echo $i; ?>]" <?php if($tree['ch1'][$i]=="on"){ echo "checked=''";}?>>
                              </div>
                            </td>
                            <td class="center aligned">
                              <div>
                                <input type="hidden" name="ch2[<?php echo $i; ?>]" value="off">
                                <input type="checkbox" name="ch2[<?php echo $i; ?>]" <?php if($tree['ch2'][$i]=="on"){ echo "checked=''";}?>>
                              </div>
                            </td>
                            <td class="center aligned">
                              <div>
                                <input type="hidden" name="ch3[<?php echo $i; ?>]" value="off">
                                <input type="checkbox" name="ch3[<?php echo $i; ?>]" <?php if($tree['ch3'][$i]=="on"){ echo "checked=''";}?>>
                              </div>
                            </td>
                            <td class="center aligned">
                              <select name="damageArea[]">
                                <option value="0" <?php if($tree['damageArea'][$i]=="0"){ echo "selected=''";}?>>โปรดเลือก</option>
                                <option value="1" <?php if($tree['damageArea'][$i]=="1"){ echo "selected=''";}?>>1-พบน้อยมาก</option>
                                <option value="2" <?php if($tree['damageArea'][$i]=="2"){ echo "selected=''";}?>>2-พบบางครั้ง</option>
                                <option value="3" <?php if($tree['damageArea'][$i]=="3"){ echo "selected=''";}?>>3-พบบ่อย</option>
                                <option value="4" <?php if($tree['damageArea'][$i]=="4"){ echo "selected=''";}?>>4-อยู่บริเวณนั้น</option>
                              </select>
                            </td>
                            <td class="center aligned">
                              <select name="moveArea[]">
                                <option value="0" <?php if($tree['moveArea'][$i]=="0"){ echo "selected=''";}?>>โปรดเลือก</option>
                                <option value="1" <?php if($tree['moveArea'][$i]=="1"){ echo "selected=''";}?>>มีโอกาสเกิด</option>
                                <option value="2" <?php if($tree['moveArea'][$i]=="2"){ echo "selected=''";}?>>ไม่มีโอกาสเกิด</option>
                              </select>
                            </td>
                            <td class="center aligned">
                              <select name="noEntry[]">
                                <option value="0" <?php if($tree['noEntry'][$i]=="0"){ echo "selected=''";}?>>โปรดเลือก</option>
                                <option value="1" <?php if($tree['noEntry'][$i]=="1"){ echo "selected=''";}?>>มีโอกาสเกิด</option>
                                <option value="2" <?php if($tree['noEntry'][$i]=="2"){ echo "selected=''";}?>>ไม่มีโอกาสเกิด</option>
                              </select>
                            </td>
                            <td>
                              <button class="ui red button delete_tr" id="delete_tr">ลบ</button>
                            </td>
                          </tr>
                        <?php
                        $i++;
                      }
                    }
                  ?>
                  <button class="ui green button" id="add_table">เพิ่ม</button>
                  
                  
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
                    <input type="radio" name="radio" >
                    <span>ราบ</span>
                  </div>

                  <div class="four wide column">
                    <input type="radio" name="radio" >
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
                    <input type="radio" name="amount_of_branch" <?php getData($tree,'radio','parasite','มี'); ?> value="มี">
                    <span>มี</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="amount_of_branch" <?php getData($tree,'radio','parasite','มาก'); ?> value="มาก">
                    <span>มาก</span>
                  </div>
                  
                  <div class="three wide column">
                    <input type="radio" name="amount_of_branch" <?php getData($tree,'radio','parasite','ปานกลาง'); ?> value="ปานกลาง">
                    <span>ปานกลาง</span>
                  </div>
                  
                  <div class="three wide column">
                    <input type="radio" name="amount_of_branch" <?php getData($tree,'radio','parasite','น้อย'); ?> value="น้อย">
                    <span>น้อย</span>
                  </div>

                  <!-- - - - - - - - - - - - - - - - - - - -->

                  <div class="seven wide column">
                    <span style="font-weight: bold;">การเปลี่ยนแปลงพื้นที่ในอนาคตที่มีผลต่อแรงลม</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="changeAreaFuture" <?php getData($tree,'radio','parasite','มี'); ?> value="มี">
                    <span>มี</span>
                  </div>

                  <div class="three wide column">
                    <input type="radio" name="changeAreaFuture" <?php getData($tree,'radio','parasite','ไม่มี'); ?> value="ไม่มี">
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
                    <input type="checkbox" name="limbDie" <?php getData($tree,'checkbox','limbDie');?> >
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
                    <input type="checkbox" name="trunkDecay" <?php getData($tree,'checkbox','trunkDecay');?> >
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
                    <input type="radio" name="rootHarmChance" <?php getData($tree,'radio','strong','มากที่สุด'); ?> value="มากที่สุด">
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
                    <th rowspan="3" class="rotate">ลำดับที่</th>
                    <th rowspan="3" class="rotate">ส่วนของต้นไม้ที่อันตราย</th>
                    <th rowspan="3" class="rotate">ปัจจัยเสี่ยงอันตราย</th>
                    <th rowspan="3" class="rotate">ขนาด(ซม.)</th>
                    <th rowspan="3" class="rotate">ระยะอันตราย(ซม.)</th>
                    <th rowspan="3" class="rotate">จำนวนความเสียหายที่อาจเกิดขึ้น</th>
                    <th rowspan="3" class="rotate">มาตราการ์ณป้องกัน</th>
                    
                  </tr>
                  
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>กิ่ง</td>
                    <td>
                       <input  type="text" class="form-control" value="<?php getData($tree,'text','damangeRiskFactorPill'); ?>" name="damangeRiskFactorPill">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskPillSize'); ?>" name="riskPillSize">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskPillTime'); ?>" name="riskPillTime">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskPillAmount'); ?>" name="riskPillAmount">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskPillProtect'); ?>" name="riskPillProtect">
                    </td>
                  </tr>
                 <tr>
                    <td>2</td>
                    <td>ลำต้น</td>
                   <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','damangeRiskFactorTrunk'); ?>" name="damangeRiskFactorTrunk">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskTrunkSize'); ?>" name="riskTrunkSize">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskTrunkTime'); ?>" name="riskTrunkTime">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskTrunkAmount'); ?>" name="riskTrunkAmount">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskTrunkProtect'); ?>" name="riskTrunkProtect">
                    </td>
                  </tr>

                  <tr>
                    <td>3</td>
                    <td>ราก</td>
                   <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','damangeRiskFactorRoot'); ?>" name="damangeRiskFactorRoot">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskRootSize'); ?>" name="riskRootSize">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskRootTime'); ?>" name="riskRootTime">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskRootAmount'); ?>" name="riskRootAmount">
                    </td>
                    <td>
                      <input  type="text"  class="form-control" value="<?php getData($tree,'text','riskRootProtect'); ?>" name="riskRootProtect">
                    </td>
                    <?php  if($tree!=NULL && $tree['treePartName']!=NULL){
                        $i=0;
                        foreach ($tree['treePartName'] as $value) {
                        
                        ?>
                        <tr id="table1">
                          <td>
                            <input class="hideme" name="treePartSeq[<?php echo $i; ?>]" type="text" value="<?php echo $tree['treePartSeq'][$i]; ?>">
                          </td>
                          <td>
                            <input class="hideme" type="text" name="treePartName[<?php echo $i; ?>]" value="<?php echo $tree['treePartName'][$i]; ?>">
                          </td>
                          <td>
                            <input  type="text" class="form-control" name="treePartFactor[<?php echo $i; ?>]" value="<?php echo $tree['treePartFactor'][$i]; ?>">
                          </td>
                          <td>
                            <input  type="text" class="form-control" name="treePartSize[<?php echo $i; ?>]" value="<?php echo $tree['treePartSize'][$i]; ?>">
                          </td>
                          <td>
                            <input  type="text" name="treePartTime[<?php echo $i; ?>]" class="form-control" value="<?php echo $tree['treePartTime'][$i]; ?>">
                          </td>
                          <td>
                            <input  type="text" name="treePartAmount[<?php echo $i; ?>]" class="form-control" value="<?php echo $tree['treePartAmount'][$i]; ?>">
                          </td>
                            <td>
                              <input  type="text" name="treePartProtect[<?php echo $i; ?>]" class="form-control" value="<?php echo $tree['treePartProtect'][$i]; ?>">
                            </td>
                            <td>
                              <input type="button" class="ui red button delete_tr1" id="delete_tr1" value="ลบ">
                            </td>
                          </tr>
                        <?php
                        $i++;
                        }
                      }
                      ?>
                  </tr>
                  
                  
                </tbody>
              </table>
              <br>
              <br>


              <!-- Table 2 -->
              <table class="ui basic celled structured table" id="table2_risk">
                <thead>
                  <tr>
                    <th rowspan="2" class="rotate">ลำดับที่</th>
                    <th rowspan="2" class="rotate">ส่วนของต้นไม้ที่อันตราย</th>
                    <th colspan="3" style="text-align: center;">โอกาสในการเกิด</th>
                    <th rowspan="2">ระดับความรุนแรงของความเสียหาย</th>
                    <th rowspan="3" class="rotate">ระดับความอันตราย</th>
                  </tr>
                  <tr>
                    <th>ความเสียหาย</th>
                    <th>ผลกระทบ</th>
                    <th>ความเสียหาย+ผลกระทบ</th>
                  </tr>

                </thead>
                <tbody>
                    <tr>
                      <td>1</td>
                      <td>กิ่ง</td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="pillDamageRate">
                            <option type="hidden">เลือก</option>
                            <option value="1" <?php getData($tree,'select','pillDamageRate','1');?>>น้อย</option>
                            <option value="2" <?php getData($tree,'select','pillDamageRate','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','pillDamageRate','3');?>>ค่อนข้างมาก</option>
                            <option value="4" <?php getData($tree,'select','pillDamageRate','4');?>>มาก</option>
                          </select>                        
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="pillDamageEffect">
                            <option type="hidden">เลือก</option>
                            <option value="1" <?php getData($tree,'select','pillDamageEffect','1');?>>ต่ำมาก</option>
                            <option value="2" <?php getData($tree,'select','pillDamageEffect','2');?>>ต่ำ</option>
                            <option value="3" <?php getData($tree,'select','pillDamageEffect','3');?>>ปานกลาง</option>
                            <option value="4" <?php getData($tree,'select','pillDamageEffect','4');?>>สูง</option>
                          </select>
                        </center>
                      </td>
                     <td>
                        <center>
                          <select class="ui dropdown" name="pillDamageEffectRate">
                            <option value="1" <?php getData($tree,'select','pillDamageEffectRate','1');?>>น้อย</option>
                            <option value="2" <?php getData($tree,'select','pillDamageEffectRate','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','pillDamageEffectRate','3');?>>มาก</option>
                            <option value="4" <?php getData($tree,'select','pillDamageEffectRate','4');?>>มากที่สุด</option>
                          </select>
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="pillLevelDamage">
                            <option type="hidden">เลือก</option>
                            <option value="1" <?php getData($tree,'select','pillLevelDamage','1');?>>ต่ำ</option>
                            <option value="2" <?php getData($tree,'select','pillLevelDamage','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','pillLevelDamage','3');?>>สูง</option>
                            <option value="4" <?php getData($tree,'select','pillLevelDamage','4');?>>สูงที่สุด</option>
                          </select>
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="pillLevelDanger">
                            <option value="1" <?php getData($tree,'select','pillLevelDanger','1');?>>น้อย</option>
                            <option value="2" <?php getData($tree,'select','pillLevelDanger','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','pillLevelDanger','3');?>>มาก</option>
                            <option value="4" <?php getData($tree,'select','pillLevelDanger','4');?>>มากที่สุด</option>
                          </select>
                        </center>
                      </td>
                    </tr>

                    <tr>
                      <td>2</td>
                      <td>ลำต้น</td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="trunkDamageRate">
                            <option type="hidden">เลือก</option>
                            <option value="1" <?php getData($tree,'select','trunkDamageRate','1');?>>น้อย</option>
                            <option value="2" <?php getData($tree,'select','trunkDamageRate','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','trunkDamageRate','3');?>>ค่อนข้างมาก</option>
                            <option value="4" <?php getData($tree,'select','trunkDamageRate','4');?>>มาก</option>
                          </select>
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="trunkDamageEffect">
                            <option type="hidden">เลือก</option>
                            <option value="1" <?php getData($tree,'select','trunkDamageEffect','1');?>>ต่ำมาก</option>
                            <option value="2" <?php getData($tree,'select','trunkDamageEffect','2');?>>ต่ำ</option>
                            <option value="3" <?php getData($tree,'select','trunkDamageEffect','3');?>>ปานกลาง</option>
                            <option value="4" <?php getData($tree,'select','trunkDamageEffect','4');?>>สูง</option>
                          </select>
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="trunkDamageEffectRate">
                            <option value="1" <?php getData($tree,'select','trunkDamageEffectRate','1');?>>น้อย</option>
                            <option value="2" <?php getData($tree,'select','trunkDamageEffectRate','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','trunkDamageEffectRate','3');?>>มาก</option>
                            <option value="4" <?php getData($tree,'select','trunkDamageEffectRate','4');?>>มากที่สุด</option>
                          </select>
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="trunkLevelDamage">
                            <option type="hidden">เลือก</option>
                            <option value="1" <?php getData($tree,'select','trunkLevelDamage','1');?>>ต่ำ</option>
                            <option value="2" <?php getData($tree,'select','trunkLevelDamage','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','trunkLevelDamage','3');?>>สูง</option>
                            <option value="4" <?php getData($tree,'select','trunkLevelDamage','4');?>>สูงที่สุด</option>
                          </select>
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="trunkLevelDanger">
                            <option value="1" <?php getData($tree,'select','trunkLevelDanger','1');?>>น้อย</option>
                            <option value="2" <?php getData($tree,'select','trunkLevelDanger','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','trunkLevelDanger','3');?>>มาก</option>
                            <option value="4" <?php getData($tree,'select','trunkLevelDanger','4');?>>มากที่สุด</option>
                          </select>
                        </center>
                      </td>
                    </tr>

                     <tr>
                      <td>3</td>
                      <td>ราก</td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="rootDamageRate">
                            <option type="hidden">เลือก</option>
                            <option value="1" <?php getData($tree,'select','rootDamageRate','1');?>>น้อย</option>
                            <option value="2" <?php getData($tree,'select','rootDamageRate','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','rootDamageRate','3');?>>ค่อนข้างมาก</option>
                            <option value="4" <?php getData($tree,'select','rootDamageRate','4');?>>มาก</option>
                          </select>
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="rootDamageEffect">
                            <option type="hidden">เลือก</option>
                            <option value="1" <?php getData($tree,'select','rootDamageEffect','1');?>>ต่ำมาก</option>
                            <option value="2" <?php getData($tree,'select','rootDamageEffect','2');?>>ต่ำ</option>
                            <option value="3" <?php getData($tree,'select','rootDamageEffect','3');?>>ปานกลาง</option>
                            <option value="4" <?php getData($tree,'select','rootDamageEffect','4');?>>สูง</option>
                          </select>
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="rootDamageEffectRate">
                            <option value="1" <?php getData($tree,'select','rootDamageEffectRate','1');?>>น้อย</option>
                            <option value="2" <?php getData($tree,'select','rootDamageEffectRate','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','rootDamageEffectRate','3');?>>มาก</option>
                            <option value="4" <?php getData($tree,'select','rootDamageEffectRate','4');?>>มากที่สุด</option>
                          </select>
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="rootLevelDamage">
                            <option type="hidden">เลือก</option>
                            <option value="1" <?php getData($tree,'select','rootLevelDamage','1');?>>ต่ำ</option>
                            <option value="2" <?php getData($tree,'select','rootLevelDamage','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','rootLevelDamage','3');?>>สูง</option>
                            <option value="4" <?php getData($tree,'select','rootLevelDamage','4');?>>สูงที่สุด</option>
                          </select>
                        </center>
                      </td>
                      <td>
                        <center>
                          <select class="ui dropdown" name="rootLevelDanger">
                            <option value="1" <?php getData($tree,'select','rootLevelDanger','1');?>>น้อย</option>
                            <option value="2" <?php getData($tree,'select','rootLevelDanger','2');?>>ปานกลาง</option>
                            <option value="3" <?php getData($tree,'select','rootLevelDanger','3');?>>มาก</option>
                            <option value="4" <?php getData($tree,'select','rootLevelDanger','4');?>>มากที่สุด</option>

                          </select>
                        </center>
                      </td>
                      <?php  if($tree!=NULL && $tree['treePartName']!=NULL){
                        $i=0;
                        foreach ($tree['treePartName'] as $value) {
                        
                        ?>
                        <tr id="table2">
                          <td>
                            <input class="hideme" name="treePartSeq[<?php echo $i; ?>]" type="text" value="<?php echo $tree['treePartSeq'][$i]; ?>">
                          </td>
                          <td>
                            <input class="hideme" type="text" name="treePartName[<?php echo $i; ?>]" value="<?php echo $tree['treePartName'][$i]; ?>">
                          </td>
                          <td>
                            <center>
                              <select class="ui dropdown" name="treePartDamage[<?php echo $i; ?>]">
                                <option type="hidden">เลือก</option>
                                <option value="1" <?php if($tree['treePartDamage'][$i]=="1"){ echo "selected=''"; }?> >น้อย</option>
                                <option value="2" <?php if($tree['treePartDamage'][$i]=="2"){ echo "selected=''"; }?>>ปานกลาง</option>
                                <option value="3" <?php if($tree['treePartDamage'][$i]=="3"){ echo "selected=''"; }?>>ค่อนข้างมาก</option>
                                <option value="4" <?php if($tree['treePartDamage'][$i]=="4"){ echo "selected=''"; }?>>มาก</option>
                              </select>
                            </center>
                          </td>
                          <td>
                            <center>
                              <select class="ui dropdown" name="treePartEffect[<?php echo $i; ?>]">
                                <option type="hidden">เลือก</option>
                                <option value="1" <?php if($tree['treePartEffect'][$i]=="1"){ echo "selected=''"; }?>>ต่ำมาก</option>
                                <option value="2" <?php if($tree['treePartEffect'][$i]=="2"){ echo "selected=''"; }?>>ต่ำ</option>
                                <option value="3" <?php if($tree['treePartEffect'][$i]=="3"){ echo "selected=''"; }?>>ปานกลาง</option>
                                <option value="4" <?php if($tree['treePartEffect'][$i]=="4"){ echo "selected=''"; }?>>สูง</option>
                              </select>
                            </center>
                          </td>
                          <td>
                            <center>
                              <select class="ui dropdown" name="treePartEffectDamage[<?php echo $i; ?>]">
                                <option value="1" <?php if($tree['treePartEffectDamage'][$i]=="1"){ echo "selected=''"; }?>>น้อย</option>
                                <option value="2" <?php if($tree['treePartEffectDamage'][$i]=="2"){ echo "selected=''"; }?>>ปานกลาง</option>
                                <option value="3" <?php if($tree['treePartEffectDamage'][$i]=="3"){ echo "selected=''"; }?>>มาก</option>
                                <option value="4" <?php if($tree['treePartEffectDamage'][$i]=="4"){ echo "selected=''"; }?>>มากที่สุด</option>
                              </select>
                            </center>
                          </td>
                          <td>
                            <center>
                              <select class="ui dropdown" name="treePartLDamage[<?php echo $i; ?>]">
                                <option type="hidden">เลือก</option>
                                <option value="1" <?php if($tree['treePartLDamage'][$i]=="1"){ echo "selected=''"; }?>>ต่ำ</option>
                                <option value="2" <?php if($tree['treePartLDamage'][$i]=="2"){ echo "selected=''"; }?>>ปานกลาง</option>
                                <option value="3" <?php if($tree['treePartLDamage'][$i]=="3"){ echo "selected=''"; }?>>สูง</option>
                                <option value="4" <?php if($tree['treePartLDamage'][$i]=="4"){ echo "selected=''"; }?>>สูงที่สุด</option>
                              </select>
                            </center>
                          </td>
                          <td>
                            <center>
                              <select class="ui dropdown" name="treePartLDanger[<?php echo $i; ?>]">
                                <option value="1" <?php if($tree['treePartLDanger'][$i]=="1"){ echo "selected=''"; }?>>น้อย
                                </option>
                                <option value="2" <?php if($tree['treePartLDanger'][$i]=="2"){ echo "selected=''"; }?>>ปานกลาง
                                </option>
                                <option value="3" <?php if($tree['treePartLDanger'][$i]=="3"){ echo "selected=''"; }?>>มาก
                                </option>
                                <option value="4" <?php if($tree['treePartLDanger'][$i]=="4"){ echo "selected=''"; }?>>มากที่สุด
                                </option>
                              </select>
                            </center>
                          </td>
                            <td>
                              <input type="button" class="ui red button delete_tr1" id="delete_tr1" value="ลบ">
                            </td>
                          </tr>
                        <?php
                        $i++;
                        }
                      }
                      ?>
                    </tr>
                </tbody>
              </table>







              <br>
              <!--  - - - -  - - - - - - - - - - - - - - - - - - - - - - - -  - -->
                <div class="ui grid">
                  
                  <div class="sixteen wide column">
                    <span style="font-weight: bold;">คำอธิบายเพิ่มเติม</span>
                    <input type="text" name="moreDetail" value="<?php getData($tree,'text','moreDetail'); ?>" class="form-control" >
                  </div>

                <!--  - - - - - - - - - - - - - - - - - - -  - -->
                  
                  <div class="eight wide column">
                    <span">วิธีแก้ไข</span>
                    <input type="text" class="form-control" name="Solution1" value="<?php getData($tree,'text','Solution1'); ?>" >
                  </div>

                  <div class="eight wide column">
                    <span">ปัญหาที่อาจหลงเหลือ</span>
                    <input type="text" class="form-control" name="problem1" value="<?php getData($tree,'text','problem1'); ?>" >
                  </div>

                  <div class="eight wide column">
                    <span">วิธีแก้ไข</span>
                    <input type="text" class="form-control" name="Solution2" value="<?php getData($tree,'text','Solution2'); ?>" >
                  </div>

                  <div class="eight wide column">
                    <span">ปัญหาที่อาจหลงเหลือ</span>
                    <input type="text" class="form-control" name="problem2" value="<?php getData($tree,'text','problem2'); ?>" >
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
                        <div id="full_tree"></div>                       
                        <br>
                        <button class="ui teal button" id="addfull_img">เพิ่ม</button>
                        <!-- <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Full" src="#" width="50%"/>
                        </div>
                         -->
                         <br>
                         <br>
                        <label style="">ลำต้น : </label><br>
                        <div id="truck_tree"></div>
                        <br>
                        <button class="ui teal button" id="addtruck_img">เพิ่ม</button>
                        <!-- <input class="ui teal button" type="file" accept="image/*" name="Tree_imgTruck" capture="camera" id="imgTruck" > -->

                        
                       <!--  <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Truck" src="#" width="50%"/>
                        </div> -->
                        <br>
                        <br>
                        <label style="">ใบ : </label><br>
                        <div id="leaf_tree"></div>
                        <br>
                        <button class="ui teal button" id="addleaf_img">เพิ่ม</button>
                        <!-- <input class="ui teal button" type="file" accept="image/*" name="Tree_imgLeaf" capture="camera" id="imgLeft" > -->
                        
                        <!-- <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Left" src="#" width="50%"/>
                        </div> -->
                        <br>
                        <br>
                        <label style="">เรือนยอด : </label><br>
                        <div id="top_tree"></div>
                        <br>
                        <button class="ui teal button" id="addtop_img">เพิ่ม</button>
                        <!-- <input class="ui teal button" type="file" accept="image/*" name="Tree_imgTop" capture="camera" id="imgTop" > -->

                        <!-- <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Top" src="#" width="50%"/>
                        </div> -->
                        <br>
                        <br>
                        <label style="">ราก : </label><br>
                        <div id="root_tree"></div>
                        <br>
                        <button class="ui teal button" id="addroot_img">เพิ่ม</button>
                        <!-- <input class="ui teal button" type="file" accept="image/*" name="Tree_imgRoot" capture="camera" id="imgRoot" > -->

                        <!-- <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Root" src="#" width="50%"/>
                        </div> -->
                        
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
        
        <input type="submit" class="ui green button" id="buttonDel" value="บันทึกข้อมูล">
        
    </center>
  </form>

      </div>

    </div>
  
  
  <h4></h4>
</div>
<script type="text/javascript">


</script>





<!-- 444 -->

@stop