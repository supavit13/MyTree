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
                    <input type="number" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" name="phone" placeholder="000-9999999" required="">
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
                    <input type="email" name="email" id="email" placeholder="example@gmail.com" value="<?php if($userlogin!='Guest'){ echo $userlogin->email; } ?>" required="">
                  </div>

                  <div class="field">
                    <label>รหัสผ่าน</label>
                    <input type="password" name="password" minlength="8" id="password" placeholder="ไม่น้อยกว่า8ตัว" required>
                  </div>

                  <div class="field" id="divPass">
                    <label>ยืนยันรหัสผ่าน</label>
                    <input type="password" minlength="8" name="confirmPassword" id="conpwd" required>
                  </div>

                  <div class="field" id="policy">
                    <h4>ข้อกำหนดและนโยบาย</h4>
                    <textarea readonly>                   
                      ขอขอบคุณที่ใช้ผลิตภัณฑ์และบริการของเรา บริการนี้จัดทำโดย นิสิตคณะวิศวกรรมศาสตร์ ศรีราชา สาขาวิศวกรรมคอมพิวเตอร์ มหาวิทยาลัยเกษตรศาสตร์ วิทยาเขตศรีราชา ซึ่งตั้งอยู่ที่ 199 ถ.สุขุมวิท ต.ทุ่งสุขลา อ.ศรีราชา จ.ชลบุรี 20230 
                      การใช้บริการของเราถือเป็นการยอมรับข้อกำหนดนี้ โปรดอ่านอย่างละเอียด
                      -การใช้บริการของเรา
                      คุณต้องปฏิบัติตามนโยบายใด ๆ ที่มีต่อคุณภายในบริการนี้
                      ห้ามใช้บริการของเราในทางมิชอบคุณต้องใช้บริการของเราเฉพาะตามที่กฎหมายอนุญาตและกฎระเบียบบังคับใช้เราอาจระงับหรือหยุดการให้บริการแก่คุณหากคุณไม่ปฏิบัติตามข้อกำหนดและนโยบายของเราหรือหากเราตรวจสอบพบพฤติกรรมที่น่าสงสัยว่าไม่ถูกต้อง
                      การใช้บริการของเราไม่ได้ทำให้คุณเป็นเจ้าของสิทธิในทรัพย์สินทางปัญญาใด ๆ ในบริการหรือเนื้อหาที่คุณเข้าถึง คุณไม่สามารถใช้เนื้อหาในบริการของเรา เว้นแต่ได้รับการอนุญาตจากเจ้าของเนื้อหาดังกล่าว 
                      เนื้อหาบางอย่างที่แสดงบนบริการ My treeอาจไม่ได้เป็นของเรา  เนื้อหานี้เป็นความรับผิดชอบแต่เพียงผู้เดียวของบุคคลที่เผยแพร่เนื้อหานั้น 
                      เราอาจตรวจสอบเนื้อหาเพื่อพิจารณาว่าเนื้อหานั้นผิดกฎหมายหรือละเมิดนโยบายของเราหรือไม่ เราอาจปฏิเสธที่จะแสดงเนื้อหาที่เราเชื่อว่ามีเหตุผลสมควร ผิดกฎหมาย และละเมิดนโยบายของเรา
                      -เนื้อหาของคุณในบริการของเรา
                      บริการบางอย่างของเราอนุญาตให้คุณอัพโหลด ส่งเนื้อหามาให้ คุณยังคงความเป็นเจ้าของสิทธิ์ในทรัพย์สินทางปัญญาใด ๆ ที่คุณถือสิทธิ์ในเนื้อหานั้น ๆ
                      เมื่อคุณอัพโหลด ส่งเนื้อหามาให้ จัดเก็บ ส่งหรือรับเนื้อหามายังหรือผ่านบริการของเรา ถือว่าคุณได้อนุญาตให้ My tree มีสิทธิ์ในเนื้อหาของคุณ ไม่ว่าที่ใดในโลกในการทำซ้ำ ดัดแปลง แก้ไข สร้างงานต่อยอดเนื้อหาของคุณหรือการเปลี่ยนแปลงอื่น ๆ
                      -เกี่ยวกับซอฟต์แวร์ในบริการของเรา
                      My tree อนุญาตให้ใช้สิทธิในซอฟต์แวร์ที่ My tree จัดหาให้คุณในฐานะส่วนหนึ่งของบริการ การอนุญาตให้ใช้สิทธินี้มีวัตถุประสงค์ คือ ให้คุณสามารถใช้งานและใช้ประโยชน์จากบริการที่จัดหาโดย My tree ตามข้อกำหนด ห้ามคุณคัดลอก ปรับเปลี่ยน แจกจ่าย จำหน่าย หรือให้เช่าส่วนหนึ่งส่วนใดของบริการของเราหรือซอฟต์แวร์ที่อยู่ใน และห้ามคุณดำเนินกระบวนการวิศวกรรมย้อนกลับหรือพยายามแยกซอร์สโค้ดของซอฟต์แวร์นั้น 
                      -การปรับเปลี่ยนและการยุติการให้บริการของเรา
                      เราทำการเปลี่ยนแปลงและปรับปรุงบริการอย่างสม่ำเสมอ เราอาจเพิ่มหรือนำระบบการทำงานหรือคุณสมบัติบางอย่างออกหรือระงับใช้บริการใดบริการหนึ่งอย่างสิ้นเชิง
                      คุณสามารถหยุดใช้บริการของเราได้ทุกเมื่อ หรือทางMy treeอาจหยุให้บริการแก่คุณหรือเพิ่มสร้างขีดจำกัดใหม่ ๆ ในบริการของเราได้ทุกเมื่อโดยไม่แจ้งให้คุณทราบ
                      เราเชื่อว่าคุณเป็นเจ้าของข้อมูลของคุณและการสงวนไว้ซึ่งการเข้าถึงข้อมูลดังกล่าวของคุณเป็นสิ่งสำคัญหากเราหยุดให้บริการในกรณีที่มีเหตุผลสมควร เราจะส่งคำเตือนที่เหมาะสมถึงคุณล่วงหน้า และให้โอกาสคุณในการนำข้อมูลออกจากบริการนั้น
                      -เกี่ยวกับข้อกำหนดนี้
                      เราอาจปรับเปลี่ยนข้อกำหนดนี้หรือข้อกำหนดเพิ่มเติมใด ๆ ที่มีผลบังคับใช้กับบริการ คุณจึงควรทบทวนข้อกำหนดนี้เป็นประจำ โดยเราจะโพสต์ประกาศแจ้งการปรับเปลี่ยนข้อกำหนดเหล่านี้ไว้ในหน้าเว็บนี้ การเปลี่ยนแปลงต่าง ๆ จะไม่มีผลย้อนหลัง และจะมีผลบังคับใช้หลังจากมีการโพสต์ประกาศแจ้งเป็นเวลาสิบสี่วันเป็นอย่างน้อย  อย่างไรก็ตาม การเปลี่ยนแปลงที่เกี่ยวกับระบบการทำงานใหม่ของบริการหรือการเปลี่ยนแปลงด้วยเหตุผลด้านกฎหมายจะมีผลบังคับใช้ทันที หากคุณไม่ยอมรับข้อกำหนดที่แก้ไขของบริการหนึ่งๆ คุณควรหยุดการใช้บริการนั้น
                      หากมีข้อขัดแย้งกันระหว่างข้อกำหนดนี้กับข้อกำหนดเพิ่มเติมให้ถือว่าข้อกำหนดเพิ่มเติมมีผลบังคับใช้
                      หากคุณไม่ปฏิบัติตามข้อกำหนดนี้ และเราไม่ได้ดำเนินการใดโดยทันที จะไม่ถือว่าเราสละสิทธิ์ใด ๆ ที่มี
                    </textarea>
                  </div>
                  <input type="checkbox" class="ui checkbox" id="policycheck" name="policycheck" onclick="showsave()"><span>&nbsp;ยอมรับ</span>

                  <p style="color: red;">*หมายเหตุ &nbsp;ปุ่มบันทึกจะขึ้นหลังจากกดยอมรับ</p>

                  

                  <div align="center" id="savediv" style="display:none;">
                    <center id="divSubmit">
                      <button class='ui blue button' id='submit' type='submit'>บันทึก</button>
                    </center>
                  </div>
                  
                  
                </form>

                <script type="text/javascript">
                    function showsave() {
                        var pFun = document.getElementById('savediv');
                        if (pFun.style.display == 'none') {
                            pFun.style.display = 'block';
                        } else {
                            pFun.style.display = 'none';
                        }
                    }
                </script>



              
            </div>
          </div>
        </div>
        

  
  <h4></h4>
</div>
</form>







@stop