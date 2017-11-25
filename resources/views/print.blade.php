@extends('layout')

@section('content')


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

  <br><br>

  <span style="font-weight: bold;">ผู้ว่าจ้าง</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 5cm;" value="<?php getData($tree,'text','hire'); ?>">
    </span>
  
  <span style="font-weight: bold;">ที่อยู่</span>
    <span>
      <input type="text" class="hideme"  id="input" style="width: 7cm;" value="<?php getData($tree,'text','Tree_address'); ?>">
    </span>
  
  <span style="font-weight: bold;">วันที่</span>
    <span>
      <input type="text" class="hideme"  id="input" style="width: 3cm;" value="<?php getData($tree,'text','Tree_date'); ?>">
    </span>
  
  <span style="font-weight: bold;">ต้นที่</span>
    <span>
      <input type="text" class="hideme"  id="input" style="width: 2cm;" value="<?php getData($tree,'text','Tree_sequence'); ?>">
    </span>
  
  <span style="font-weight: bold;">พิกัด</span>
  <span style="font-weight: bold;">X:</span>  
    <span>
      <input type="text" class="hideme"  id="input" style="width: 2.5cm;" value="<?php getData($tree,'text','Tree_lat'); ?>">
    </span>
  
  <span style="font-weight: bold;">Y:</span>  
    <span>
      <input type="text" class="hideme"  id="input" style="width: 2.5cm;" value="<?php getData($tree,'text','Tree_long'); ?>">
    </span>

  <!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด -->

  <span style="font-weight: bold;">ชนิด</span>
    <span>
      <input type="text" class="hideme"  id="input" style="width: 3.5cm;" value="<?php getData($tree,'text','Tree_type'); ?>">
    </span>

  <span style="font-weight: bold;">ชื่อวิทยาศาสตร์</span>
    <span>
      <input type="text" class="hideme"  id="input" style="width: 7cm;" value="<?php getData($tree,'text','Tree_sci_name'); ?>">
    </span>

  <span style="font-weight: bold;">เส้นผ่านศูนย์กลางเพียงอก</span>
    <span>
      <input type="text" class="hideme"  id="input" style="width: 3cm;" value="<?php getData($tree,'text','Tree_diameter_Trunk'); ?>">
    </span>
  <span style="font-weight: bold;">ซม.</span>

  <span id="tab" style="font-weight: bold;">ความสูง</span>
    <span>
      <input type="text" class="hideme"  id="input" style="width: 3cm;" value="<?php getData($tree,'text','Tree_height'); ?>">
    </span>
  <span style="font-weight: bold;">ม.</span>

  <!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">เส้นผ่านศูนย์กลางเรือนยอด</span>
    <span>
      <input type="text" class="hideme"  id="input" style="width: 2.5cm;" value="<?php getData($tree,'text','Tree_diameter_Top'); ?>">
    </span>
  <span style="font-weight: bold;">ม.</span>

  <span id="tab" style="font-weight: bold;">ผู้ประเมิน</span>
    <span>
      <input type="text" class="hideme"  id="input" style="width: 6.5cm;" value="<?php echo $userlogin['username'] ?>">
    </span>

  <span style="font-weight: bold;">หน่วยงาน</span>
    <span>
      <input type="text" class="hideme"  id="input" style="width: 10cm;" value="<?php getData($tree,'text','agency'); ?>">
    </span>

<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
  <br><br><br>

  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      แบบประเมินความเสียหายที่จะเกิดขึ้น
    </span>
  </div></center> 
  

  <table>
    <thead>
      <tr>
        <th rowspan="2" style="text-align: center; width: 2%;">ลำดับที่</th>
        <th rowspan="2" id="ten_per" style="text-align: center;">รายละเอียดของ <br> สิ่งที่จะเกิดความเสียหาย</th>
        <th colspan="3" style="text-align: center;">บริเวณที่อาจเกิดความเสียหาย</th>
        <th rowspan="2" id="five_per" style="text-align: center;">การปรากฎอยู่<br>ของสิ่งที่จะเสียหาย</th>
        <th rowspan="2" id="five_per" style="text-align: center;">การเคลื่อนย้ายออกจากพื้นที่อันตราย</th>
        <th rowspan="2" id="five_per" style="text-align: center;">ห้ามเข้าพื้นที่อันตราย</th>
      </tr>

      <tr>
        <th id="five_per"  style="text-align: center;">ใต้เรือนยอด</th>
        <th id="five_per"  style="text-align: center;">1 เท่า<br>ของความสูง</th>
        <th id="five_per"  style="text-align: center;">1.5เท่าของความสูง</th>
      </tr>
    </thead>
                
    <tbody>
      <tr>
        <td style="text-align: center;">1</td>

        <td >รถยนต์/รถจักรยานยนต์</td> <!-- รายละเอียดของสิ่งที่จะเกิดความเสียหาย -->            
        
        <td>
          <div style="text-align: center;">
            <input type="checkbox" <?php getData($tree,'checkbox','vehCh1');?>> <!-- ใต้เรือนยอด -->
          </div>
        </td>
        <td>
          <div style="text-align: center;">
            <input type="checkbox" <?php getData($tree,'checkbox','vehCh2');?>> <!-- 1 เท่าของความสูง -->
          </div>
        </td>
        <td>
          <div style="text-align: center;">
            <input type="checkbox" <?php getData($tree,'checkbox','vehCh3');?>> <!-- 1.5เท่าของความสูง -->
          </div>
        </td>                          
                    
 
        <td style="text-align: center;">  <!-- การปรากฎอยู่ของสิ่งที่จะเสียหาย -->
          <select id="arrow">   
            <option value="0">โปรดเลือก</option>   
            <option value="1" <?php getData($tree,'select','vehDamageAppear','1');?>>1-พบน้อยมาก</option>
            <option value="2" <?php getData($tree,'select','vehDamageAppear','2');?>>2-พบบางครั้ง</option>
            <option value="3" <?php getData($tree,'select','vehDamageAppear','3');?>>3-พบบ่อย</option>
            <option value="4" <?php getData($tree,'select','vehDamageAppear','4');?>>4-อยู่บริเวณนั้น</option>
          </select>
        </td> 

        <td style="text-align: center;">  <!-- การเคลื่อนย้ายออกจากพื้นที่อันตราย -->
          <select id="arrow">   
            <option value="0" <?php getData($tree,'select','vehMoveArea','0');?>>โปรดเลือก</option>   
            <option value="1" <?php getData($tree,'select','vehMoveArea','1');?>>มีโอกาสเกิด</option>
            <option value="2" <?php getData($tree,'select','vehMoveArea','2');?>>ไม่มีโอกาสเกิด</option>
          </select>
        </td>  
                    
        <td style="text-align: center;">  <!-- ห้ามเข้าพื้นที่อันตราย -->
          <select id="arrow">   
            <option value="0" <?php getData($tree,'select','vehNoEntry','0');?>>โปรดเลือก</option>   
            <option value="1" <?php getData($tree,'select','vehNoEntry','1');?>>มีโอกาสเกิด</option>
            <option value="2" <?php getData($tree,'select','vehNoEntry','2');?>>ไม่มีโอกาสเกิด</option>
          </select>
        </td>  
      </tr> <!-- end รถยนต์ -->
      <?php 
                    if($tree!=NULL && $tree['listDamage']!=NULL){
                      $i=0;
                      foreach ($tree['listDamage'] as $value) {
                        ?>
                        <tr>
                            <td style="text-align: center;">
                              <?php echo $i+1;?>
                            </td>
                            <td>
                              <?php echo $tree['listDamage'][$i]; ?>
                            </td>
                            <td>
                              <div style="text-align: center;">
                                <input type="hidden" name="ch1[<?php echo $i; ?>]" value="off">
                                <input type="checkbox" name="ch1[<?php echo $i; ?>]" <?php if($tree['ch1'][$i]=="on"){ echo "checked=''";}?>>
                              </div>
                            </td>
                            <td >
                              <div style="text-align: center;">
                                <input type="hidden" name="ch2[<?php echo $i; ?>]" value="off">
                                <input type="checkbox" name="ch2[<?php echo $i; ?>]" <?php if($tree['ch2'][$i]=="on"){ echo "checked=''";}?>>
                              </div>
                            </td>
                            <td >
                              <div style="text-align: center;">
                                <input type="hidden" name="ch3[<?php echo $i; ?>]" value="off">
                                <input type="checkbox" name="ch3[<?php echo $i; ?>]" <?php if($tree['ch3'][$i]=="on"){ echo "checked=''";}?>>
                              </div>
                            </td>
                            <td style="text-align: center;">
                              <select id="arrow" name="damageArea[]">
                                <option value="0" <?php if($tree['damageArea'][$i]=="0"){ echo "selected=''";}?>>โปรดเลือก</option>
                                <option value="1" <?php if($tree['damageArea'][$i]=="1"){ echo "selected=''";}?>>1-พบน้อยมาก</option>
                                <option value="2" <?php if($tree['damageArea'][$i]=="2"){ echo "selected=''";}?>>2-พบบางครั้ง</option>
                                <option value="3" <?php if($tree['damageArea'][$i]=="3"){ echo "selected=''";}?>>3-พบบ่อย</option>
                                <option value="4" <?php if($tree['damageArea'][$i]=="4"){ echo "selected=''";}?>>4-อยู่บริเวณนั้น</option>
                              </select>
                            </td>
                            <td style="text-align: center;">
                              <select id="arrow" name="moveArea[]">
                                <option value="0" <?php if($tree['moveArea'][$i]=="0"){ echo "selected=''";}?>>โปรดเลือก</option>
                                <option value="1" <?php if($tree['moveArea'][$i]=="1"){ echo "selected=''";}?>>มีโอกาสเกิด</option>
                                <option value="2" <?php if($tree['moveArea'][$i]=="2"){ echo "selected=''";}?>>ไม่มีโอกาสเกิด</option>
                              </select>
                            </td>
                            <td style="text-align: center;">
                              <select id="arrow" name="noEntry[]">
                                <option value="0" <?php if($tree['noEntry'][$i]=="0"){ echo "selected=''";}?>>โปรดเลือก</option>
                                <option value="1" <?php if($tree['noEntry'][$i]=="1"){ echo "selected=''";}?>>มีโอกาสเกิด</option>
                                <option value="2" <?php if($tree['noEntry'][$i]=="2"){ echo "selected=''";}?>>ไม่มีโอกาสเกิด</option>
                              </select>
                            </td>
                          </tr>
                        <?php
                        $i++;
                      }
                    }
                  ?>      
      


    </tbody>
  </table>

<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<br><br>
  
  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      ข้อมูลสภาพพื้นที่
    </span>
  </div></center> 

<br>

  <span style="font-weight: bold;">ร่องรอยความเสียหายของต้นไม้ที่พบในพื้นที่</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 20cm;" value="<?php getData($tree,'text','damageInArea'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">สภาพภูมิประเทศ</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 5cm;" value="<?php getData($tree,'text','topographyStats'); ?>">
    </span>

  <span style="font-weight: bold;">ความลาดชัน</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 5cm;" value="<?php getData($tree,'text','slope'); ?>">
    </span>
  <span style="font-weight: bold;">%</span>

  <span id="tab" style="font-weight: bold;">ทิศด้านลาด</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 4.75cm;" value="<?php getData($tree,'text','slopeDirection'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">การเปลี่ยนแปลงสภาพพื้นที่</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','changeArea','ไม่มี'); ?>></span><span>ไม่มี</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','changeArea','ไม่แน่ชัด'); ?>></span><span>ไม่แน่ชัด</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','changeArea','มี'); ?>></span><span>มี</span> 
  <span>รายละเอียด</span> 
    <span>
      <input type="text" class="hideme" id="input" style="width: 13cm;" value="<?php getData($tree,'text','changeAreaDetail'); ?>">
    </span>               

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">สภาพดิน</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','soilCh1');?>></span><span>ปกติ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','soilCh2');?>></span><span>เนื้อดินจำกัด</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','soilCh3');?>></span><span>น้ำแช่ขัง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','soilCh4');?>></span><span>ดินแน่นแข็ง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','soilCh5');?>></span><span>ดินตื้น</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','soilCh6');?>></span><span>มีวัสดุปิดทับ</span> 
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','soilCh7');?>></span><span>อื่นๆ</span> 
    <span>
      <input type="text" class="hideme" id="input" style="width: 9.5cm;" value="<?php getData($tree,'text','soilDetail'); ?>">
    </span> 

<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<br><br><br>
  
  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      สุขภาพของต้นไม้
    </span>
  </div></center> 

<br>

  <span style="font-weight: bold;">ความแข็งแรงโดยรวม</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','strong','ต่ำ'); ?>></span><span>ต่ำ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','strong','ปานกลาง'); ?>></span><span>ปานกลาง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','strong','สูง'); ?>></span><span>สูง</span>



  <span id="tab" style="font-weight: bold;">สภาพใบ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','leafCh1');?>></span><span>ปกติ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','leafCh2');?>></span><span>ผลัดใบ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','leafCh3');?>></span><span>ผิดปกติ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','leafCh4');?>></span><span>ร่วง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','leafCh5');?>></span><span>ซีดเหลือง</span>
  <span><input type="radio" name="radio" ></span><span>แห้ง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','leafCh6');?>></span><span>โรค</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','leafCh7');?>></span><span>เชื้อรา</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','leafCh8');?>></span><span>แมลง</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span>บริเวณที่พบ</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 3.5cm;" value="<?php getData($tree,'text','foundArea'); ?>">
    </span>

  <span>อาการ</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 7cm;" value="<?php getData($tree,'text','symptom'); ?>">
    </span>

  <span>คิดเป็น</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 2.5cm;" value="<?php getData($tree,'text','percenSymptom'); ?>">
    </span>
  <span>%</span>

  <span id="tab" >ชนิดสาเหตุ</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 7.5cm;" value="<?php getData($tree,'text','causeType'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">ตัวการทำอันตรายที่ไม่มีชีวิต</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','Enermy1');?>></span><span>ไม่มี</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','Enermy2');?>></span><span>อากาศ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','Enermy3');?>></span><span>ดิน</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','Enermy4');?>></span><span>อุณหภูมิ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','Enermy5');?>></span><span>น้ำ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','Enermy6');?>></span><span>แร่ธาตุ</span> 
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','Enermy7');?>></span><span>มลพิษ</span> 
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','Enermy8');?>></span><span>อื่นๆ</span> 
    <span>
      <input type="text" class="hideme" id="input" style="width: 13cm;" value="<?php getData($tree,'text','enermyDetail'); ?>">
    </span> 

<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<br><br><br>
  
  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      ปัจจัยความเสี่ยงต่อการเกิดอันตรายของต้นไม้
    </span>
  </div></center> 

<br>  <!-- - - - - - -  - - - - - -  เรือนยอด  - - - - - - - - - - - - - -  -->

  <span style="font-weight: bold; background-color: yellow;">เรือนยอด</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">การปะทะลม</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','windImpact','มีสิ่งกำบังลม'); ?>></span><span>มีสิ่งกำบังลม</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','windImpact','รับลมโดยตรง'); ?>></span><span>รับลมโดยตรง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','windImpact','ร่องอุโมงค์ลม'); ?>></span><span>ร่องอุโมงค์ลม</span>



  <span id="tab" style="font-weight: bold;">การดูแลเรือนยอด</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topCare','มี'); ?>></span><span>มี</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topCare','ไม่มี'); ?>></span><span>ไม่มี</span>



  <span id="tab" style="font-weight: bold;">ขนาดเรือนยอดสัมพัทธ์</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topSize','เล็ก'); ?>></span><span>เล็ก</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topSize','กลาง'); ?>></span><span>กลาง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topSize','ใหญ่'); ?>></span><span>ใหญ่</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">ความหนาแน่นเรือนยอด</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topThick','โปร่ง'); ?>></span><span>โปร่ง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topThick','ปานกลาง'); ?> ></span><span>ปานกลาง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topThick','ทึบ'); ?>></span><span>ทึบ</span>



  <span id="tab" style="font-weight: bold;">กาฝาก/เถาวัลย์</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','parasite','ไม่มี'); ?>></span><span>ไม่มี</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','parasite','มีมาก'); ?>></span><span>มาก</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','parasite','มีปานกลาง'); ?>></span><span>ปานกลาง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','parasite','มีน้อย'); ?>></span><span>น้อย</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">ความสมดุลของเรือนยอด</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topBalance','ดี'); ?>></span><span>ดี</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topBalance','ไม่ดี'); ?>></span><span>ไม่ดี</span>


  <span id="tab" style="font-weight: bold;">Live-Crow ration</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 3cm;" value="<?php getData($tree,'text','liveCrownPercen'); ?>">
    </span>
  <span style="font-weight: bold;">%</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span><input type="radio" name="radio" ></span><span>กิ่งแห้ง</span>
   <span>
      <input type="text" class="hideme" id="input" style="width: 1cm;" value="<?php getData($tree,'text','limbDie'); ?>">
    </span>
  <span>%</span>

  <span>ขนาดใหญ่สุด</span>
   <span>
      <input type="text" class="hideme" id="input" style="width: 1.5cm;" value="<?php getData($tree,'text','limbDieSize'); ?>">
    </span>
  <span>ซม.</span>


  <span id="tab"><input type="radio" name="radio" ></span><span>กิ่งหักแขวน</span>
  <span id="tab">จำนวน</span>
   <span>
      <input type="text" class="hideme" id="input" style="width: 1.5cm;" value="<?php getData($tree,'text','limbBroke'); ?>">
    </span>
  <span>กิ่ง</span>

  <span id="tab">ขนาดใหญ่สุด</span>
   <span>
      <input type="text" class="hideme" id="input" style="width: 1.5cm;" value="<?php getData($tree,'text','limbBrokeSize'); ?>">
    </span>
  <span>ซม.</span>

  <span id="tab"><input type="radio" name="radio" <?php getData($tree,'checkbox','limbLesion');?>></span><span>รอยแผลกิ่ง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','limbHole');?>></span><span>รอยผุโพรงหรือรู</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','limbNode');?>></span><span>ปุ่มปม</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','limbDie');?>></span><span>เน่า</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','limbFungus');?>></span><span>เชื้อราเห็ด</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">การลิดกิ่ง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','limbLit','เหมาะสม'); ?>></span><span>เหมาะสม</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','limbLit','ไม่เหมาะสม'); ?>></span><span>ไม่เหมาะสม</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','limbTop');?>></span><span>Topped</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','limbLion');?>></span><span>Lion tailed</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','limbFlush');?>></span><span>Flush</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','limbOther');?>></span><span>อื่นๆ</span> 
    <span>
      <input type="text" class="hideme" id="input" style="width: 10cm;" value="<?php getData($tree,'text','limbDetail'); ?>">
    </span> 

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">สิ่งที่ต้องเฝ้าระวัง</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 15cm;" value="<?php getData($tree,'text','topStayAlert'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">โอกาสในการเกิดอันตราย</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topHarmChance','น้อย'); ?>></span><span>น้อย</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topHarmChance','มีโอกาสปานกลาง'); ?>></span><span>มีโอกาสปานกลาง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topHarmChance','มีโอกาสสูง'); ?>></span><span>มีโอกาสสูง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','topHarmChance','เกิดอันตรายแน่นอน'); ?>></span><span>เกิดอันตรายแน่นอน</span>

<br><br> <!-- - - - - - - - - - -  ลำต้น  - - - - - - - - - - - - - -  -->

  <span style="font-weight: bold; background-color: yellow;">ลำต้น</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','trunkNormal');?>></span><span>ปกติ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','trunkDie');?>></span><span>เปลือกแห้ง/หลุดร่อน</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','trunkAbnormal');?>></span><span>สีเปลือก/พื้นผิวผิดปกติ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','trunkBroke');?>></span><span>มีรอยแตก</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','trunkLiquid');?>></span><span>มีน้ำยางหรือของเหลวไหลออกจากเปลือก</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','trunkNode');?>></span><span>มีปุ่มปม</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','trunkDecay');?>></span><span>เนื้อไม้ผุ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','trunkFungus');?>></span><span>มีเชื้อรา เห็ด</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','trunkHole');?>></span><span>มีรูโพรง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','trunkThin');?>></span><span>ความเรียวผิดปกติ ผอม</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span><input type="radio" name="radio" ></span><span>โน้มหรือเอียงจากแนวดิ่ง</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 2cm;" value="<?php getData($tree,'text','trunkSlope'); ?>">
    </span>
  <span>องศา</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">สิ่งที่ต้องเฝ้าระวัง</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 15cm;" value="<?php getData($tree,'text','trunkStayAlert'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">โอกาสในการเกิดอันตราย</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','trunkHarmChance','น้อย'); ?> ></span><span>น้อย</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','trunkHarmChance','มีโอกาสปานกลาง'); ?>></span><span>มีโอกาสปานกลาง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','trunkHarmChance','มีโอกาสสูง'); ?>></span><span>มีโอกาสสูง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','trunkHarmChance','เกิดอันตรายแน่นอน'); ?>></span><span>เกิดอันตรายแน่นอน</span>


<br><br> <!-- - - - - - - - - - -  ราก  - - - - - - - - - - - - - -  -->

  <span style="font-weight: bold; background-color: yellow;">ราก</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','rootUp');?>></span><span>โผล่พ้นดิน</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','rootBroke');?>></span><span>แตกหักหรือถูกตัด</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','rootLesion');?>></span><span>มีร่องรอยเสียดสี</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','rootLiquid');?>></span><span>มีของเหลวไหลจากเปลือก</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','rootNode');?>></span><span>มีปุ่มปมหรือตา</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','rootDecay');?>></span><span>เนื้อไม่ผุเสียหาย</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','rootFungus');?>></span><span>มีเชื้อรา เห็ด</span>
  <span><input type="radio" name="radio" <?php getData($tree,'checkbox','rootWater');?>></span><span>มีน้ำแช่ขัง</span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">สิ่งที่ต้องเฝ้าระวัง</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 15cm;" value="<?php getData($tree,'text','rootStayAlert'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">โอกาสในการเกิดอันตราย</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','rootHarmChance','น้อย'); ?> ></span><span>น้อย</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','rootHarmChance','มีโอกาสปานกลาง'); ?>></span><span>มีโอกาสปานกลาง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','rootHarmChance','มีโอกาสสูง'); ?>></span><span>มีโอกาสสูง</span>
  <span><input type="radio" name="radio"  <?php getData($tree,'radio','strong','เกิดอันตรายแน่นอน'); ?> ></span><span>เกิดอันตรายแน่นอน</span>



<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
  <br><br><br>

  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      การประเมินระดับความเสี่ยงอันตราย
    </span>
  </div></center> 

  <br>  

  
          <table>
                <thead>
                  <tr>
                    <!-- <th rowspan="3" class="center aligned">ลำดับที่</th> -->
                    <th rowspan="3" class="rotate1"><div style="width: 30px;"><span>ลำดับที่</span></div></th>

                    <th rowspan="3" class="rotate1"><div style="width: 50px;"><span>ส่วนของต้นไม้ที่อันตราย</span></div></th>
      
                    <th rowspan="3" class="rotate1"><div style="width: 50px;"><span>ปัจจัยเสี่ยงอันตราย</span></div></th>
                    
                    <th rowspan="3" class="rotate1"><div style="width: 50px;"><span>ขนาด(ซม.)</span></div></th>
                    
                    <th rowspan="3" class="rotate1"><div style="width: 50px;"><span>ระยะอันตราย(ซม.)</span></div></th>
                    
                    <th rowspan="3" class="rotate1"><div style="width: 50px;"><span>จำนวนความเสียหายที่อาจเกิดขึ้น</span></div></th>
                    
                    <th rowspan="3" class="rotate1"><div style="width: 50px;"><span>มาตราการณ์ป้องกัน</span></div></th>

                    <th colspan="12" style="text-align: center;">โอกาสในการเกิด</th>
                    <th colspan="4" style="text-align: center;">ระดับความรุนแรงของความเสียหาย</th>
                    <th rowspan="3" class="rotate1"><div style="width: 50px;"><span>ระดับความอันตราย(matrix2)</span></div></th>
                  </tr>

                  <tr>
                    <th colspan="4" style="text-align: center;">ความเสียหาย</th>
                    <th colspan="4" style="text-align: center;">ผลกระทบ</th>
                    <th colspan="4" style="text-align: center;">ความเสียหาย + ผลกระทบ(matrix1)</th>
                    
                    <th rowspan="2" class="rotate2"><div style="width: 30px;"><span>ต่ำ</span></div></th>
                    <th rowspan="2" class="rotate2"><div style="width: 30px;"><span>ปานกลาง</span></div></th>
                    <th rowspan="2" class="rotate2"><div style="width: 30px;"><span>สูง</span></div></th>
                    <th rowspan="2" class="rotate2"><div style="width: 30px;"><span>สูงที่สุด</span></div></th>
                  </tr>

                  <tr>
                    <th class="rotate2"><div style="width: 30px;"><span>น้อย</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ปานกลาง</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ค่อนข้างมาก</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>มาก</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ต่ำ</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ตำ่มาก</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ปานกลาง</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>สูง</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>น้อย</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>ปานกลาง</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>มาก</span></div></th>
                    <th class="rotate2"><div style="width: 30px;"><span>มากที่สุด</span></div></th> 
                  </tr>
                </thead>
                
                <tbody>
                  <tr>  <!-- กิ่ง -->
                    
                    <td style="text-align: center;">1</td>

                    <td style="text-align: center;">กิ่ง</td>
                    
                    <td>    <!-- ปัจจัยเสี่ยงอันตราย -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','damangeRiskFactorPill'); ?> </p> 
                    </td>

                    <td>    <!-- ขนาด(ซม.) -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskPillSize'); ?> </p> 
                    </td>

                    <td>   <!--  ระยะอันตราย(ซม.) -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskPillTime'); ?> </p> 
                    </td>

                    <td>    <!-- จำนวนความเสียหายที่อาจเกิดขึ้น -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskPillAmount'); ?> </p>
                    </td>

                    <td>    <!-- มาตราการณ์ป้องกัน -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskPillProtect'); ?> </p>
                    </td>
                    
                   <!--  ความเสียหาย -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','pillDamageRate','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','pillDamageRate','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','pillDamageRate','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','pillDamageRate','4');?>>
                      </div>
                    </td>

                    <!-- ผลกระทบ -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','pillDamageEffect','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','pillDamageEffect','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','pillDamageEffect','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','pillDamageEffect','4');?>>
                      </div>
                    </td>

                    <!-- ความเสียหาย+ผลกระทบ(matrix1) -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','pillDamageEffectRate','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','pillDamageEffectRate','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','pillDamageEffectRate','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','pillDamageEffectRate','4');?>>
                      </div>
                    </td>

                    <!-- ระดับความรุนแรงของความเสียหาย -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','pillLevelDamage','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','pillLevelDamage','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','pillLevelDamage','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','pillLevelDamage','4');?>>
                      </div>
                    </td>

                    <!-- ระดับความอันตราย(matrix2) -->
                      <!-- <p class="bigtable_wordwrap1">ปานกลาง</p> -->
                    <td style="text-align: center;">
                      <select id="arrow">   
                        <option value="1" <?php getData($tree,'select','pillLevelDanger','1');?>>ต่ำ</option>   
                        <option value="2" <?php getData($tree,'select','pillLevelDanger','2');?>>ปานกลาง</option>
                        <option value="3" <?php getData($tree,'select','pillLevelDanger','3');?>>สูง</option>
                        <option value="4" <?php getData($tree,'select','pillLevelDanger','4');?>>สูงที่สุด</option>
                      </select>
                    </td>
                  </tr> <!-- end กิ่ง -->

                  <tr>  <!-- ลำต้น -->
                    
                    <td style="text-align: center;">1</td>

                    <td style="text-align: center;">กิ่ง</td>
                    
                    <td>    <!-- ปัจจัยเสี่ยงอันตราย -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','damangeRiskFactorTrunk'); ?> </p> 
                    </td>

                    <td>    <!-- ขนาด(ซม.) -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskTrunkSize'); ?> </p> 
                    </td>

                    <td>   <!--  ระยะอันตราย(ซม.) -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskTrunkTime'); ?> </p> 
                    </td>

                    <td>    <!-- จำนวนความเสียหายที่อาจเกิดขึ้น -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskTrunkAmount'); ?> </p>
                    </td>

                    <td>    <!-- มาตราการณ์ป้องกัน -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskTrunkProtect'); ?> </p>
                    </td>
                    
                   <!--  ความเสียหาย -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','trunkDamageRate','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','trunkDamageRate','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','trunkDamageRate','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','trunkDamageRate','4');?>>
                      </div>
                    </td>

                    <!-- ผลกระทบ -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffect','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffect','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffect','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffect','4');?>>
                      </div>
                    </td>

                    <!-- ความเสียหาย+ผลกระทบ(matrix1) -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffectRate','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffectRate','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffectRate','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffectRate','4');?>>
                      </div>
                    </td>

                    <!-- ระดับความรุนแรงของความเสียหาย -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','trunkLevelDamage','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','trunkLevelDamage','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','trunkLevelDamage','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','trunkLevelDamage','4');?>>
                      </div>
                    </td>

                    <!-- ระดับความอันตราย(matrix2) -->
                      <!-- <p class="bigtable_wordwrap1">ปานกลาง</p> -->
                    <td style="text-align: center;">
                      <select id="arrow">   
                        <option value="1" <?php getData($tree,'select','trunkLevelDanger','1');?>>ต่ำ</option>   
                        <option value="2" <?php getData($tree,'select','trunkLevelDanger','2');?>>ปานกลาง</option>
                        <option value="3" <?php getData($tree,'select','trunkLevelDanger','3');?>>สูง</option>
                        <option value="4" <?php getData($tree,'select','trunkLevelDanger','4');?>>สูงที่สุด</option>
                      </select>
                    </td>
                  </tr> <!-- end ลำต้น -->

                  <tr>  <!-- ลำต้น -->
                    
                    <td style="text-align: center;">1</td>

                    <td style="text-align: center;">กิ่ง</td>
                    
                    <td>    <!-- ปัจจัยเสี่ยงอันตราย -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','damangeRiskFactorTrunk'); ?> </p> 
                    </td>

                    <td>    <!-- ขนาด(ซม.) -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskTrunkSize'); ?> </p> 
                    </td>

                    <td>   <!--  ระยะอันตราย(ซม.) -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskTrunkTime'); ?> </p> 
                    </td>

                    <td>    <!-- จำนวนความเสียหายที่อาจเกิดขึ้น -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskTrunkAmount'); ?> </p>
                    </td>

                    <td>    <!-- มาตราการณ์ป้องกัน -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskTrunkProtect'); ?> </p>
                    </td>
                    
                   <!--  ความเสียหาย -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','trunkDamageRate','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','trunkDamageRate','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','trunkDamageRate','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','trunkDamageRate','4');?>>
                      </div>
                    </td>

                    <!-- ผลกระทบ -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffect','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffect','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffect','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffect','4');?>>
                      </div>
                    </td>

                    <!-- ความเสียหาย+ผลกระทบ(matrix1) -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffectRate','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffectRate','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffectRate','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','trunkDamageEffectRate','4');?>>
                      </div>
                    </td>

                    <!-- ระดับความรุนแรงของความเสียหาย -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','trunkLevelDamage','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','trunkLevelDamage','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','trunkLevelDamage','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','trunkLevelDamage','4');?>>
                      </div>
                    </td>

                    <!-- ระดับความอันตราย(matrix2) -->
                      <!-- <p class="bigtable_wordwrap1">ปานกลาง</p> -->
                    <td style="text-align: center;">
                      <select id="arrow">   
                        <option value="1" <?php getData($tree,'select','trunkLevelDanger','1');?>>ต่ำ</option>   
                        <option value="2" <?php getData($tree,'select','trunkLevelDanger','2');?>>ปานกลาง</option>
                        <option value="3" <?php getData($tree,'select','trunkLevelDanger','3');?>>สูง</option>
                        <option value="4" <?php getData($tree,'select','trunkLevelDanger','4');?>>สูงที่สุด</option>
                      </select>
                    </td>
                  </tr> <!-- end ลำต้น -->

                  <tr>  <!-- ราก -->
                    
                    <td style="text-align: center;">1</td>

                    <td style="text-align: center;">กิ่ง</td>
                    
                    <td>    <!-- ปัจจัยเสี่ยงอันตราย -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','damangeRiskFactorRoot'); ?> </p> 
                    </td>

                    <td>    <!-- ขนาด(ซม.) -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskRootSize'); ?> </p> 
                    </td>

                    <td>   <!--  ระยะอันตราย(ซม.) -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskRootTime'); ?> </p> 
                    </td>

                    <td>    <!-- จำนวนความเสียหายที่อาจเกิดขึ้น -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskRootAmount'); ?> </p>
                    </td>

                    <td>    <!-- มาตราการณ์ป้องกัน -->
                      <p class="bigtable_wordwrap1"> <?php getData($tree,'text','riskRootProtect'); ?> </p>
                    </td>
                    
                   <!--  ความเสียหาย -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','rootDamageRate','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','rootDamageRate','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','rootDamageRate','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio1" <?php getData($tree,'select','rootDamageRate','4');?>>
                      </div>
                    </td>

                    <!-- ผลกระทบ -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','rootDamageEffect','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','rootDamageEffect','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','rootDamageEffect','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','rootDamageEffect','4');?>>
                      </div>
                    </td>

                    <!-- ความเสียหาย+ผลกระทบ(matrix1) -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','rootDamageEffectRate','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','rootDamageEffectRate','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','rootDamageEffectRate','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio2" <?php getData($tree,'select','rootDamageEffectRate','4');?>>
                      </div>
                    </td>

                    <!-- ระดับความรุนแรงของความเสียหาย -->
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','rootLevelDamage','1');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','rootLevelDamage','2');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','rootLevelDamage','3');?>>
                      </div>
                    </td>
                    <td style="text-align: center;">
                      <div>
                        <input type="radio" name="radio7" <?php getData($tree,'select','rootLevelDamage','4');?>>
                      </div>
                    </td>

                    <!-- ระดับความอันตราย(matrix2) -->
                      <!-- <p class="bigtable_wordwrap1">ปานกลาง</p> -->
                    <td style="text-align: center;">
                      <select id="arrow">   
                        <option value="1" <?php getData($tree,'select','rootLevelDanger','1');?>>ต่ำ</option>   
                        <option value="2" <?php getData($tree,'select','rootLevelDanger','2');?>>ปานกลาง</option>
                        <option value="3" <?php getData($tree,'select','rootLevelDanger','3');?>>สูง</option>
                        <option value="4" <?php getData($tree,'select','rootLevelDanger','4');?>>สูงที่สุด</option>
                      </select>
                    </td>
                  </tr> <!-- end ราก -->


                  
                </tbody>
          </table>




  <br><br>

  <div class="ui grid">
      <div class="eight wide column"> <!-- - - -  matrix1 - - - - - -->
          
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
                  <td style="font-weight: bold; text-align: center;">มาก</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">ปานกลาง</td>
                  <td style="text-align: center;">มาก</td>
                  <td style="text-align: center;">มากที่สุด</td>
                </tr>

                <tr>
                  <td  style="font-weight: bold; text-align: center">ค่อนข้างมาก</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">ปานกลาง</td>
                  <td style="text-align: center;">มาก</td>
                </tr>

                <tr>
                  <td style="font-weight: bold; text-align: center">ปานกลาง</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">น้อย</td>
                  <td style="text-align: center;">ปานกลาง</td>
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


      <div class="eight wide column">  <!-- matrix 2 -->

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
                    <th style="text-align: center;">สูง</th>
                    <th style="text-align: center;">สูงที่สุด</th>
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
                  <td style="font-weight: bold; text-align: center;">ปานกลาง</td>
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


  <br><br>

  <span style="font-weight: bold;">คำอธิบายเพิ่มเติม</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 25cm;" value="<?php getData($tree,'text','moreDetail'); ?>">
    </span>

<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">ผลการประเมินความเสี่ยงอันตรายจากต้นไม้ในภาพรวม</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','totalDamage','ต่ำ'); ?> ></span><span>ต่ำ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','totalDamage','ปานกลาง'); ?>></span><span>ปานกลาง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','totalDamage','สูง'); ?>></span><span>สูง</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','totalDamage','สูงที่สุด'); ?>></span><span>สูงที่สุด</span>

  <span id="tab" style="font-weight: bold;">ระยะเวลาที่อาจเกิดความเสียหายขึ้น</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 7.5cm;" value="<?php getData($tree,'text','timeDamage'); ?>">
    </span>


<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">ความเร่งด่วนในการดำเนินงาน</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','operateTime','ทันที'); ?>></span><span>ทันที</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','operateTime','ภายใน1เดือน'); ?>></span><span>ภายใน1เดือน</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','operateTime','ภายใน3-5เดือน'); ?>></span><span>ภายใน3-5เดือน</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','operateTime','ภายใน6-12เดือน'); ?>></span><span>ภายใน6-12เดือน</span>
  
<!-- เว้นบรรทัด --> <div style="margin-top: 1%;"></div> <!-- เว้นบรรทัด --> 

  <span style="font-weight: bold;">การประเมินเพิ่มเติม</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','moreEvaluate','ไม่ต้องการ'); ?>></span><span>ไม่ต้องการ</span>
  <span><input type="radio" name="radio" <?php getData($tree,'radio','moreEvaluate','ต้องการ เรื่อง'); ?>></span><span>ต้องการ</span>
  <span>เรื่อง</span>
    <span>
      <input type="text" class="hideme" id="input" style="width: 20.25cm;" value="<?php getData($tree,'text','needMore'); ?>">
    </span>




<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<br><br><br>
  
  <center><div>
    <span style="font-weight: bold; background-color: yellow; font-size: 18px;">
      ภาพประกอบการดำเนินงานโดยสังเขป
    </span>
      @if($tree['Tree_imgFull']!=NULL)
        @foreach($tree['Tree_imgFull'] as $imgFull)
          <img class='ui large image' src='{{asset('images/uploads/'.$imgFull)}}'>
        @endforeach
      @endif
      <span>เต็มต้น</span>
      @if($tree['Tree_imgTruck']!=NULL)
        @foreach($tree['Tree_imgTruck'] as $imgTruck)
          <img class='ui large image' src='{{asset('images/uploads/'.$imgTruck)}}'>
        @endforeach
              @endif
              <span>ลำต้น</span>
              <div class='ui divider'></div>
              @if($tree['Tree_imgLeaf']!=NULL)
                @foreach($tree['Tree_imgLeaf'] as $imgLeaf)
                  <img class='ui large image' src='{{asset('images/uploads/'.$imgLeaf)}}'>
                @endforeach
              @endif
              <span>ใบ</span>
              <div class='ui divider'></div>
              @if($tree['Tree_imgTop']!=NULL)
                @foreach($tree['Tree_imgTop'] as $imgTop)
                  <img class='ui large image' src='{{asset('images/uploads/'.$imgTop)}}'>
                @endforeach
              @endif
              <span>เรือนยอด</span>
              <div class='ui divider'></div>
              @if($tree['Tree_imgRoot']!=NULL)
                @foreach($tree['Tree_imgRoot'] as $imgRoot)
                  <img class='ui large image' src='{{asset('images/uploads/'.$imgRoot)}}'>
                @endforeach
              @endif
              <span>ราก</span>
              <div class='ui divider'></div>
  </div></center> 

<br>







<br>
</div> <!-- end A4 -->



@stop
