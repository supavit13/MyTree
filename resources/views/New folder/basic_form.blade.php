<div id="333" style="background-color:white; width: 100%; height: 10cm;"$>

<div class="container">
    <br><br>
    
  <div class="row">
      <div id="accordion" class="panel-group">

        <div class="panel panel-default">
          <div style="background-color:#009933; padding:1em; color:white;">
            <h4 class="panel-title">
              <a href="#panel-2" data-parent="#accordion" data-toggle="collapse">
                  <center>
            <h1 style="color: white;" class="ui icon header"><br>
                <i class="File Text icon"></i>
                  <br>
                  <div class="content">แบบฟอร์มเบื้องต้น </div>
            </h1>   
          </center>
              </a>
            </h4>
          </div>

          <form action="{{ route('tree.store')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="panel-collapse collapse" id="panel-2">
            <div class="panel-body">
              
              <div class="col-md-12">
                        <label class="control-label" >ชื่อต้นไม้</label>
                        <input  type="text"  class="form-control input-md" name="Tree_name">
                </div>

                 <div class="col-md-12" style="margin-top: 3%; ">
                        <label class="control-label" >ชื่อวิทยาศาสตร์</label><br>
                        <select style="width: 100%; " class="ui search dropdown" name="Tree_sci_name">
         <option value="">รายชื่อ...</option>
        <option value="Abelmoschus esculentus (L.) Moench">Abelmoschus esculentus (L.) Moench</option>
        <option value="Acacia confusa Merr.">Acacia confusa Merr.</option>
        <option value="Acacia farnesiana Willd.">Acacia farnesiana Willd.</option>
        <option value="Acer oblongum Wall.ex DC.">Acer oblongum Wall.ex DC.</option>
        <option value="Acer calcaratum Gagnep.">Acer calcaratum Gagnep.</option>
        <option value="Acer chiangdaoense Santisuk">Acer chiangdaoense Santisuk</option>
        <option value="Acer laurinum Hassk.">Acer laurinum Hassk.</option>
        <option value="Acronychia pedunculata (L.) Miq.">Acronychia pedunculata (L.) Miq.</option>
        <option value="Actinidia deliciosa (A. Chev.) Liang & A.R.Ferg.">Actinidia deliciosa (A. Chev.) Liang & A.R.Ferg.</option>
        <option value="Adiantum membranifolium S.Linds. & Suksathan">Adiantum membranifolium S.Linds. & Suksathan</option>
        <option value="Aerides houlletiana Rchb.f.">Aerides houlletiana Rchb.f.</option>
        <option value="Afgekia mahidolae Burtt et Chermsirivathana">Afgekia mahidolae Burtt et Chermsirivathana</option>
        <option value="Afgekia sericea Craib">Afgekia sericea Craib</option>
        <option value="Aglaomorpha coronans Copel.">Aglaomorpha coronans Copel.</option>
        <option value="Albizia chinensis(Osb.)Merr.">Albizia chinensis(Osb.)Merr.</option>
        <option value="Albizia chinensis (Osbeck) Merr.">Albizia chinensis (Osbeck) Merr.</option>
        <option value="Albizia crassiramea Lace">Albizia crassiramea Lace</option>
        <option value="Albizia odoratissima (L.f.) Benth.">Albizia odoratissima (L.f.) Benth.</option>
        <option value="Alpinia blepharocalyx K. Schum.">Alpinia blepharocalyx K. Schum.</option>
        <option value="Alpinia blepharocalyx K. Schum. var. glabrior (Handel-Mazzetii) T.L. Wu">Alpinia blepharocalyx K. Schum. var. glabrior (Handel-Mazzetii) T.L. Wu</option>
        <option value="Altingia excelsa Noronha">Altingia excelsa Noronha</option>
        <option value="Amomum testaceum Ridl.">Amomum testaceum Ridl.</option>
        <option value="Amomum verum Blackw. (syn. A. krervanh Pierre ex Gagnep)">Amomum verum Blackw. (syn. A. krervanh Pierre ex Gagnep)</option>
        <option value="Anacolosa ilicoides Mast.">Anacolosa ilicoides Mast.</option>
        <option value="Anaxagorea luzonensis A.Gray">Anaxagorea luzonensis A.Gray</option>
        <option value="Anthocephalus chinensis (Lamk.) A. Rich. ex Walp.">Anthocephalus chinensis (Lamk.) A. Rich. ex Walp.</option>
        <option value="Aquilaria crassna Pierre ex Lecomte">Aquilaria crassna Pierre ex Lecomte</option>
        <option value="Argyreia osyrensis (Roth) Choisy">Argyreia osyrensis (Roth) Choisy</option>
        <option value="Aristolochia arenicola Hance">Aristolochia arenicola Hance</option>
        <option value="Aristolochia tagala Cham.">Aristolochia tagala Cham.</option>
        <option value="Artabotrys hexapetalus (Linn.f.) Bhandari">Artabotrys hexapetalus (Linn.f.) Bhandari</option>
        <option value="Balanophora latisepala (Tiegh.) Lecomte">Balanophora latisepala (Tiegh.) Lecomte</option>
        <option value="Bauhinia acuminata L.">Bauhinia acuminata L.</option>
        <option value="Bauhinia acuminata Linn.">Bauhinia acuminata Linn.</option>
        <option value="Betula alnoides Buch. Ham.">Betula alnoides Buch. Ham.</option>
        <option value="Betula alnoides Buch.-Ham. ex G.Don">Betula alnoides Buch.-Ham. ex G.Don</option>
        <option value="Blechnum brasiliense Besv.">Blechnum brasiliense Besv.</option>
        <option value="Blechnum moorei C.Chr.">Blechnum moorei C.Chr.</option>
        <option value="Blechnum orientale L.">Blechnum orientale L.</option>
        <option value="Boesenbergia baimaii Saensouk & K.Larsen">Boesenbergia baimaii Saensouk & K.Larsen</option>
        <option value="Boesenbergia maxwellii Mood, L.M.Prince & Triboun">Boesenbergia maxwellii Mood, L.M.Prince & Triboun</option>
        <option value="Boesenbergia rotunda (L.) Mansf.">Boesenbergia rotunda (L.) Mansf.</option>
        <option value="Brainea insignis Hook. f.">Brainea insignis Hook. f.</option>
        <option value="Bulbophyllum reclusum Seidenf.">Bulbophyllum reclusum Seidenf.</option>
        <option value="Butea superba Roxb.">Butea superba Roxb.</option>
        <option value="Casearia grewiifolia Vent.">Casearia grewiifolia Vent.</option>
        <option value="Callerya atropurpurea (Wall.) A.M.Schot">Callerya atropurpurea (Wall.) A.M.Schot</option>
        <option value="Calophyllum inophyllum L.">Calophyllum inophyllum L.</option>
        <option value="Careya arborea Roxb.">Careya arborea Roxb.</option>
        <option value="Careya sphaerica Roxb.">Careya sphaerica Roxb.</option>
        <option value="Cassia agnes Brenan">Cassia agnes Brenan</option>
        <option value="Cassia bakeriana Craib">Cassia bakeriana Craib</option>
        <option value="Cassia grandis L.f.">Cassia grandis L.f.</option>
        <option value="Castanopsis argyrophylla King ex Hook.f.">Castanopsis argyrophylla King ex Hook.f.</option>
        <option value="Castanopsis diversifolia (Kurz) King ex Hook.f.">Castanopsis diversifolia (Kurz) King ex Hook.f.</option>
        <option value="Castanopsis echinocarpa Miq.">Castanopsis echinocarpa Miq.</option>
        <option value="Castanopsis tribuloides (Sm.) A.DC.">Castanopsis tribuloides (Sm.) A.DC.</option>
        <option value="Cattleya 'Queen Sirikit'">Cattleya 'Queen Sirikit'</option>
        <option value="Celastrus paniculatus Willd.">Celastrus paniculatus Willd.</option>
        <option value="Ceratopteris thalictroides (L.) Brongn.">Ceratopteris thalictroides (L.) Brongn.</option>
        <option value="Chrysothemis pulchella (Donn ex Sims) Decne.">Chrysothemis pulchella (Donn ex Sims) Decne.</option>
        <option value="Cinnamomum camphora (L.) J.Presl">Cinnamomum camphora (L.) J.Presl</option>
        <option value="Clematis buchananiana DC.">Clematis buchananiana DC.</option>
        <option value="Clematis subumbellata Kurz">Clematis subumbellata Kurz</option>
        <option value="Coffea arabica L.">Coffea arabica L.</option>
        <option value="Crateva magna ( Lour. ) DC.">Crateva magna ( Lour. ) DC.</option>
        <option value="Curcuma bella C. Maknoi, P. Sirirugsa & K. Larsen">Curcuma bella C. Maknoi, P. Sirirugsa & K. Larsen</option>
        <option value="Curcuma bicolor J. Mood & K. Larsen">Curcuma bicolor J. Mood & K. Larsen</option>
        <option value="Curcuma bicolor Mood & K.Larsen">Curcuma bicolor Mood & K.Larsen</option>
        <option value="Curcuma ecomata Craib">Curcuma ecomata Craib</option>
        <option value="Curcuma flaviflora S.Q. Tong">Curcuma flaviflora S.Q. Tong</option>
        <option value="Curcuma gracillima Gagnep.">Curcuma gracillima Gagnep.</option>

        <option value="Curcuma larsenii C. Maknoi & T. Jenjittikul">Curcuma larsenii C. Maknoi & T. Jenjittikul</option>
        <option value="Curcuma parviflora Wall.">Curcuma parviflora Wall.</option>
        <option value="Curcuma rhomba J. Mood & K. Larsen">Curcuma rhomba J. Mood & K. Larsen</option>
        <option value="Curcuma rhomba Mood & K.Larsen">Curcuma rhomba Mood & K.Larsen</option>
        <option value="Curcuma rhadota Sirirugsa & M.F. Newman">Curcuma rhadota Sirirugsa & M.F. Newman</option>
        <option value="Curcuma roscoeana Wall.">Curcuma roscoeana Wall.</option>
        <option value="Curcuma rubescens Roxb.">Curcuma rubescens Roxb.</option>
        <option value="Curcuma sessilis Gage.">Curcuma sessilis Gage.</option>
        <option value="Curcuma singularis Gagnep.">Curcuma singularis Gagnep.</option>
        <option value="Curcuma sparganiifolia Gagnep.">Curcuma sparganiifolia Gagnep.</option>
        <option value="Cyanotis axillaris Roem. & Schult.">Cyanotis axillaris Roem. & Schult.</option>
        <option value="Cyathea spinulosa Wall. ex. Hook.">Cyathea spinulosa Wall. ex. Hook.</option>
        <option value="Cymbidium bicolor Lindl.">Cymbidium bicolor Lindl.</option>
        <option value="Cymbidium lowianum Rchb.f.">Cymbidium lowianum Rchb.f.</option>
        <option value="Cymbodium sinense (Jacks.) Willd.">Cymbodium sinense (Jacks.) Willd.</option>
        <option value="Cymbidium traceyanum O'Brien">Cymbidium traceyanum O'Brien</option>
        <option value="Dalbergia cultrata Graham ex Benth.">Dalbergia cultrata Graham ex Benth.</option>
        <option value="Dendrobium acerosum Lindl.">Dendrobium acerosum Lindl.</option>
        <option value="Dendrobium indivisum var. pallidum Seidenf.">Dendrobium indivisum var. pallidum Seidenf.</option>
        <option value="Dendrocnide sinuata (Blume) Chew">Dendrocnide sinuata (Blume) Chew</option>
        <option value="Didymoplexiella siamensis (Rolfe) Seidenf.">Didymoplexiella siamensis (Rolfe) Seidenf.</option>
        <option value="Diospyros glandulosa Lace">Diospyros glandulosa Lace</option>
        <option value="Diospyros undulata Wall. ex G. Don var. cratericalyx (Craib) Bakh.">Diospyros undulata Wall. ex G. Don var. cratericalyx (Craib) Bakh.</option>
        <option value="Diplazium esculentum Sw.">Diplazium esculentum Sw.</option>
        <option value="Ecipta prostrate L.">Ecipta prostrate L.</option>
        <option value="Endocomia macrocoma (Miq.) W.J. de Wilde">Endocomia macrocoma (Miq.) W.J. de Wilde</option>
        <option value="Epipactis flava Seidenf.">Epipactis flava Seidenf.</option>
        <option value="Euonymus cochinchinensis Pierre">Euonymus cochinchinensis Pierre</option>
        <option value="Fagraea fragrans Roxb.">Fagraea fragrans Roxb.</option>
        <option value="Ficus capillipes Gagnep.">Ficus capillipes Gagnep.</option>
        <option value="Geodorum attenuatum Griff.">Geodorum attenuatum Griff.</option>
        <option value="Globba schomburgkii Hook.f.">Globba schomburgkii Hook.f.</option>
        <option value="Gymnopetalum chinense (Lour.) Merr.">Gymnopetalum chinense (Lour.) Merr.</option>
        <option value="Haldina cordifolia (Roxb.) Ridsdale">Haldina cordifolia (Roxb.) Ridsdale</option>
        <option value="Helixanthera parasitica Lour.">Helixanthera parasitica Lour.</option>
        <option value="Hibiscus sabdariffa L.">Hibiscus sabdariffa L.</option>
        <option value="Hibiscus sabdariffa Linn.">Hibiscus sabdariffa Linn.</option>
        <option value="Hiptage benghalensis (L.) Kurz subsp. candicans (Hook.f.) Sirirugsa">Hiptage benghalensis (L.) Kurz subsp. candicans (Hook.f.) Sirirugsa</option>
        <option value="Hiptage benghalensis (Linn.) Kurz">Hiptage benghalensis (Linn.) Kurz</option>
        <option value="Hydnocarpus antelminthica Pierre ex Laness">Hydnocarpus antelminthica Pierre ex Laness</option>
        <option value="Irvingia malayana Oliv. ex a. Benn.">Irvingia malayana Oliv. ex a. Benn.</option>
        <option value="Kaempferia parviflora Wall. ex Baker">Kaempferia parviflora Wall. ex Baker</option>
        <option value="Lannea coromandelica (Houtt.) Merr.">Lannea coromandelica (Houtt.) Merr.</option>
        <option value="Lithocarpus polystachyus (Wall.) Rehd.">Lithocarpus polystachyus (Wall.) Rehd.</option>
        <option value="Mitragyna diversifolia (Wall. ex G. Don) Havil">Mitragyna diversifolia (Wall. ex G. Don) Havil</option>
        <option value="Mitragyna parvifolia Korth.">Mitragyna parvifolia Korth.</option>
        <option value="Mitragyna rotundifolia (Roxb.) Kuntze">Mitragyna rotundifolia (Roxb.) Kuntze</option>
        <option value="Mitrephora keithii Ridl.">Mitrephora keithii Ridl.</option>
        <option value="Monomeria barbata Lindl.">Monomeria barbata Lindl.</option>
        <option value="Murdannia nudiflora (L.) Brenan">Murdannia nudiflora (L.) Brenan</option>
        <option value="Musa (AAA) ‘Nak’">Musa (AAA) ‘Nak’</option>
        <option value="Musa (ABB Group) ‘Thepanom’">Musa (ABB Group) ‘Thepanom’</option>
        <option value="Musa (ABBB Group) ‘Theparod’">Musa (ABBB Group) ‘Theparod’</option>
        <option value="Musa balbisiana Colla">Musa balbisiana Colla</option>
        <option value="Musa chiliocarpa Back.">Musa chiliocarpa Back.</option>
        <option value="Musa gracilis Holttum">Musa gracilis Holttum</option>
        <option value="Musa laterita cheeseman">Musa laterita cheeseman</option>
        <option value="Musa superba Roxb.">Musa superba Roxb.</option>
        <option value="Naravelia laurifolia Wall. ex Hook.f.& Th.">Naravelia laurifolia Wall. ex Hook.f.& Th.</option>
        <option value="Nauclea orientalis (L.) L.">Nauclea orientalis (L.) L.</option>
        <option value="Pachyptera hymenaea (DC.) A. Gentry">Pachyptera hymenaea (DC.) A. Gentry</option>
        <option value="Passiflorra foetida Linn.">Passiflorra foetida Linn.</option>
        <option value="Pegia nitida Colebr.">Pegia nitida Colebr.</option>
        <option value="Picrasma javanica Bl.">Picrasma javanica Bl.</option>
        <option value="Pteris biaurita Linn.">Pteris biaurita Linn.</option>
        <option value="Pterospermum acerifolium Willd.">Pterospermum acerifolium Willd.</option>
        <option value="Polyalthia cerasoides (Roxb.) Benth. ex Bedd.">Polyalthia cerasoides (Roxb.) Benth. ex Bedd.</option>
        <option value="Polyalthia suberosa (Roxb.) Thwaites">Polyalthia suberosa (Roxb.) Thwaites</option>
        <option value="Polygonatum kingianum Coll. & Hemsl.">Polygonatum kingianum Coll. & Hemsl.</option>
        <option value="Quercus kingiana Craib">Quercus kingiana Craib</option>
        <option value="Quercus ramsbottomii A. Camus">Quercus ramsbottomii A. Camus</option>
        <option value="Quercus rex (Hemsl.) Schottky">Quercus rex (Hemsl.) Schottky</option>
        <option value="Radermachera ignea (Kurz) Steenis">Radermachera ignea (Kurz) Steenis</option>
        <option value="Ravenala madagascariensis F.J. Gmel.">Ravenala madagascariensis F.J. Gmel.</option>
        <option value="Rhododendron arboreum ssp. Delavayi (Franch.) Chamberlain">Rhododendron arboreum ssp. Delavayi (Franch.) Chamberlain</option>
        <option value="Rhododendron microphyton Franch.">Rhododendron microphyton Franch.</option>
        <option value="Rhododendron simsii Planch">Rhododendron simsii Planch</option>
        <option value="Rosa 'Queen Sirikit'">Rosa 'Queen Sirikit'</option>
        <option value="Salacia chinensis L.">Salacia chinensis L.</option>
        <option value="Schizomussaenda dehiscens Craib">Schizomussaenda dehiscens Craib</option>
        <option value="Scoparia dulcis Linn.">Scoparia dulcis Linn.</option>
        <option value="Stenochlaena palustris.">Stenochlaena palustris.</option>
        <option value="Stephania venosa (Blume) Spreng.">Stephania venosa (Blume) Spreng.</option>
        <option value="Styrax benzoides Craib">Styrax benzoides Craib</option>
        <option value="Thelypteris spp.">Thelypteris spp.</option>
        <option value="Tristaniopsis burmanica (Griff.) Peter G.Wilson & J.T.Waterh">Tristaniopsis burmanica (Griff.) Peter G.Wilson & J.T.Waterh</option>
        <option value="Tristaniopsis burmanica (Griff.) Peter G.Wilson & J.T.Waterh. var. rufescens (Hance) J.Parn. & Nic Lughada">Tristaniopsis burmanica (Griff.) Peter G.Wilson & J.T.Waterh. var. rufescens (Hance) J.Parn. & Nic Lughada</option>
        <option value="Uvaria grandiflora Roxb. ex Hornem">Uvaria grandiflora Roxb. ex Hornem</option>
        <option value="Viscum articulatum Burm.f.">Viscum articulatum Burm.f.</option>
        <option value="Vitex peduncularis Wall.ex Schauer">Vitex peduncularis Wall.ex Schauer</option>
        <option value="Zingiber spectabile Griff.">Zingiber spectabile Griff.</option>
      </select>
                </div>

                <div class="col-md-12" style="margin-top: 3%;">
                        <label class="control-label" >ชนิด</label>
                        <input  type="text"  class="form-control input-md" name="Tree_type">
                </div>

                <div class="col-md-12" style="margin-top: 3%;">
                        <label class="control-label" >เส้นผ่านศูนย์กลาง (เซนติเมตร)</label>
                        <input  type="text"  class="form-control input-md" name="Tree_diameter">
                </div>

                <div class="col-md-12" style="margin-top: 3%;">
                        <label class="control-label" >พิกัด</label>
                        <br>
                        <label class="control-label" >Latitude</label>
                        <input  type="text" id="lat" class="form-control input-md"  value="" name="Tree_lat">
                        <label class="control-label" >Longitude</label>
                        <input  type="text" id="lng" class="form-control input-md" value="" name="Tree_long">
                        <br>
                        <p style="color:red;" id="demo"></p>
                        <div  class="ui teal button" onclick="getLocation()">ค้นหา</div>
                </div>

                <div class="col-md-12" style="margin-top: 3%;">
                        <label class="control-label" >ที่อยู่</label>
                        <input  type="text"  class="form-control input-md" name="Tree_address">
                        <br>
                </div>

                <div class="col-md-12" style="margin-top: 3%;">
                        <label class="control-label" >แนบรูป</label>
                        <br>
                        <label style="">เต็มต้น : </label><br>
                        <input class="ui teal button" type="file" accept="image/*" name="Tree_imgFull" capture="camera" id="imgFull" >
                        <br>
                        <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Full" src="#" width="50%"/>
                        </div>
                        
                        <label style="">ลำต้น : </label><br>
                        <input class="ui teal button" type="file" accept="image/*" name="Tree_imgTruck" capture="camera" id="imgTruck" >
                        <br>
                        <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Truck" src="#" width="50%"/>
                        </div>
                        <label style="">ใบ : </label><br>
                        <input class="ui teal button" type="file" accept="image/*" name="Tree_imgLeaf" capture="camera" id="imgLeft" >
                        <br>
                        <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Left" src="#" width="50%"/>
                        </div>
                        <label style="">เรือนยอด : </label><br>
                        <input class="ui teal button" type="file" accept="image/*" name="Tree_imgTop" capture="camera" id="imgTop" >
                        <br>
                        <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Top" src="#" width="50%"/>
                        </div>
                        <label style="">ราก : </label><br>
                        <input class="ui teal button" type="file" accept="image/*" name="Tree_imgRoot" capture="camera" id="imgRoot" >
                        <br>
                        <div>
                          <img style="border: solid; margin-top: 3%; display: none;" id="Root" src="#" width="50%"/>
                        </div>
                        
                </div>
                <div class="col-md-12" style="margin-top: 3%;">
                        <label class="control-label" >ลงชื่อผู้สำรวจ</label>
                        <input  type="text"  class="form-control input-md" name="User_name" value="<?php echo $_SESSION['login']; ?>">
                </div>
                <div class="col-md-12" style="margin-top: 3%;">
                        <input  type="submit"  class="ui teal button" onclick="window.location='{{ route('go_home2') }}'">
                </div>

            </div>
          </div>
          </form>
        </div>
        
  
  <h4></h4>
</div>
</div>

</div>