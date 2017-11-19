@extends('layout')

@section('content')


<div class="jumbotron text-center" style="background-color:black">
		<input type="image" src="{{asset('logolong.png')}}" name="Image" style="width: 6cm; height: 3cm;">


	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background-color: grey;" >
			             
	    	<h3> Menu </h3>

      </button>

	    
	  </div>
	  <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#bab">Add TrEE</a></li>
        <li><a href="#red">red</a></li>
        <li><a href="#portfolio">PORTFOLIO</a></li>
        <li><a href="#pricing">PRICING</a></li>
        <li><a href="#contact">CONTACT</a></li>
      </ul>
    </div>
</div>


<div id="red" class="container-fluid text-center" style="background-color: red;">

<h1> 5555555555555555555555555555555555 </h1>

</div>


<div id="bab" class="container-fluid text-center" style="background-color: #99FF66;">

	<h1 style="margin-top: 5%; margin-left: 30%; font-size: 180%; color: black;">แบบประเมินความเสี่ยงอันตรายจากต้นไม้เบื้องต้น</h1>

	<span style="font-weight: bold;">
		ผู้ว่าจ้าง
		<div class="ui input focus" style="margin-left: 2% ; width: 30%;">
  				<input type="text"  >
		</div>
	</span>

	<span style="font-weight: bold; padding-left: 5%;">
		ที่อยู่
		<div class="ui input focus" style="margin-left: 2%; width: 50%;">
  				<input type="text"  >
		</div>
		
	</span>

	<br><br>
	
	<span style="font-weight: bold;  margin-left: 2%;">
		ต้นที่
		<div class="ui input focus" style="margin-left: 2%; width: 5%;">
  				<input type="text"  >
		</div>
	</span>

	<span style="font-weight: bold;  margin-left: 2%;">พิกัด</span>
	<span style="font-weight: bold;  margin-left: 2%;">
		X
		<div class="ui input focus" style="margin-left: 2%; width: 5%;">
  				<input type="text"  >
		</div>
	</span>

	<span style="font-weight: bold;  margin-left: 2%;">
		Y
		<div class="ui input focus" style="margin-left: 2%; width: 5%;">
  				<input type="text"  >
		</div>
	</span>

	<span style="font-weight: bold; padding-left: 4%; ">
		วันที่
		<div class="ui input focus" style="margin-left: 2%; width: 50%;">
  			<form action="/action_page.php">
				<input type="date" name="bday" min="1990-01-02">
			</form>
		</div>
	</span>

	<br>
	
	<span style="font-weight: bold;  margin-left: 2%;">
		ชนิด
		<div class="ui input focus" style="margin-left: 2%; width: 8%;">
  				<input type="text"  >
		</div>
	</span>

	<span style="font-weight: bold;  margin-left: 5%;">
		ชื่อวิทยาศาสตร์
		
  			<select style="margin-left: 2%; width: 50%;" class="ui search dropdown">
			  <option value="">รายชื่อ...</option>
<option value="1">Abelmoschus esculentus (L.) Moench</option>
<option value="2">Acacia confusa Merr.</option>
<option value="3">Acacia farnesiana Willd.</option>
<option value="4">Acer oblongum Wall.ex DC.</option>
<option value="5">Acer calcaratum Gagnep.</option>
<option value="6">Acer chiangdaoense Santisuk</option>
<option value="7">Acer laurinum Hassk.</option>
<option value="8">Acronychia pedunculata (L.) Miq.</option>
<option value="9">Actinidia deliciosa (A. Chev.) Liang & A.R.Ferg.</option>
<option value="10">Adiantum membranifolium S.Linds. & Suksathan</option>
<option value="11">Aerides houlletiana Rchb.f.</option>
<option value="12">Afgekia mahidolae Burtt et Chermsirivathana</option>
<option value="13">Afgekia sericea Craib</option>
<option value="14">Aglaomorpha coronans Copel.</option>
<option value="15">Albizia chinensis(Osb.)Merr.</option>
<option value="16">Albizia chinensis (Osbeck) Merr.</option>
<option value="17">Albizia crassiramea Lace</option>
<option value="18">Albizia odoratissima (L.f.) Benth.</option>
<option value="19">Alpinia blepharocalyx K. Schum.</option>
<option value="20">Alpinia blepharocalyx K. Schum. var. glabrior (Handel-Mazzetii) T.L. Wu</option>
<option value="21">Altingia excelsa Noronha</option>
<option value="22">Amomum testaceum Ridl.</option>
<option value="23">Amomum verum Blackw. (syn. A. krervanh Pierre ex Gagnep)</option>
<option value="24">Anacolosa ilicoides Mast.</option>
<option value="25">Anaxagorea luzonensis A.Gray</option>
<option value="26">Anthocephalus chinensis (Lamk.) A. Rich. ex Walp.</option>
<option value="27">Aquilaria crassna Pierre ex Lecomte</option>
<option value="28">Argyreia osyrensis (Roth) Choisy</option>
<option value="29">Aristolochia arenicola Hance</option>
<option value="30">Aristolochia tagala Cham.</option>
<option value="31">Artabotrys hexapetalus (Linn.f.) Bhandari</option>
<option value="32">Balanophora latisepala (Tiegh.) Lecomte</option>
<option value="33">Bauhinia acuminata L.</option>
<option value="34">Bauhinia acuminata Linn.</option>
<option value="35">Betula alnoides Buch. Ham.</option>
<option value="36">Betula alnoides Buch.-Ham. ex G.Don</option>
<option value="37">Blechnum brasiliense Besv.</option>
<option value="38">Blechnum moorei C.Chr.</option>
<option value="39">Blechnum orientale L.</option>
<option value="40">Boesenbergia baimaii Saensouk & K.Larsen</option>
<option value="41">Boesenbergia maxwellii Mood, L.M.Prince & Triboun</option>
<option value="42">Boesenbergia rotunda (L.) Mansf.</option>
<option value="43">Brainea insignis Hook. f.</option>
<option value="44">Bulbophyllum reclusum Seidenf.</option>
<option value="45">Butea superba Roxb.</option>
<option value="46">Casearia grewiifolia Vent.</option>
<option value="47">Callerya atropurpurea (Wall.) A.M.Schot</option>
<option value="48">Calophyllum inophyllum L.</option>
<option value="49">Careya arborea Roxb.</option>
<option value="50">Careya sphaerica Roxb.</option>
<option value="51">Cassia agnes Brenan</option>
<option value="52">Cassia bakeriana Craib</option>
<option value="53">Cassia grandis L.f.</option>
<option value="54">Castanopsis argyrophylla King ex Hook.f.</option>
<option value="55">Castanopsis diversifolia (Kurz) King ex Hook.f.</option>
<option value="56">Castanopsis echinocarpa Miq.</option>
<option value="57">Castanopsis tribuloides (Sm.) A.DC.</option>
<option value="58">Cattleya 'Queen Sirikit'</option>
<option value="59">Celastrus paniculatus Willd.</option>
<option value="60">Ceratopteris thalictroides (L.) Brongn.</option>
<option value="61">Chrysothemis pulchella (Donn ex Sims) Decne.</option>
<option value="62">Cinnamomum camphora (L.) J.Presl</option>
<option value="63">Clematis buchananiana DC.</option>
<option value="64">Clematis subumbellata Kurz</option>
<option value="65">Coffea arabica L.</option>
<option value="67">Crateva magna ( Lour. ) DC.</option>
<option value="68">Curcuma bicolor J. Mood & K. Larsen</option>
<option value="69">Curcuma bicolor Mood & K.Larsen</option>
<option value="70">Curcuma ecomata Craib</option>
<option value="71">Curcuma flaviflora S.Q. Tong</option>
<option value="72">Curcuma gracillima Gagnep.</option><option value="GA">Curcuma bella C. Maknoi, P. Sirirugsa & K. Larsen</option>
<option value="73">Curcuma larsenii C. Maknoi & T. Jenjittikul</option>
<option value="74">Curcuma parviflora Wall.</option>
<option value="75">Curcuma rhomba J. Mood & K. Larsen</option>
<option value="76">Curcuma rhomba Mood & K.Larsen</option>
<option value="77">Curcuma rhadota Sirirugsa & M.F. Newman</option>
<option value="78">Curcuma roscoeana Wall.</option>
<option value="79">Curcuma rubescens Roxb.</option>
<option value="80">Curcuma sessilis Gage.</option>
<option value="81">Curcuma singularis Gagnep.</option>
<option value="82">Curcuma sparganiifolia Gagnep.</option>
<option value="83">Cyanotis axillaris Roem. & Schult.</option>
<option value="84">Cyathea spinulosa Wall. ex. Hook.</option>
<option value="85">Cymbidium bicolor Lindl.</option>
<option value="86">Cymbidium lowianum Rchb.f.</option>
<option value="87">Cymbodium sinense (Jacks.) Willd.</option>
<option value="88">Cymbidium traceyanum O'Brien</option>
<option value="89">Dalbergia cultrata Graham ex Benth.</option>
<option value="90">Dendrobium acerosum Lindl.</option>
<option value="91">Dendrobium indivisum var. pallidum Seidenf.</option>
<option value="92">Dendrocnide sinuata (Blume) Chew</option>
<option value="93">Didymoplexiella siamensis (Rolfe) Seidenf.</option>
<option value="94">Diospyros glandulosa Lace</option>
<option value="95">Diospyros undulata Wall. ex G. Don var. cratericalyx (Craib) Bakh.</option>
<option value="96">Diplazium esculentum Sw.</option>
<option value="97">Ecipta prostrate L.</option>
<option value="98">Endocomia macrocoma (Miq.) W.J. de Wilde</option>
<option value="99">Epipactis flava Seidenf.</option>
<option value="100">Euonymus cochinchinensis Pierre</option>
<option value="101">Fagraea fragrans Roxb.</option>
<option value="102">Ficus capillipes Gagnep.</option>
<option value="103">Geodorum attenuatum Griff.</option>
<option value="104">Globba schomburgkii Hook.f.</option>
<option value="105">Gymnopetalum chinense (Lour.) Merr.</option>
<option value="106">Haldina cordifolia (Roxb.) Ridsdale</option>
<option value="107">Helixanthera parasitica Lour.</option>
<option value="108">Hibiscus sabdariffa L.</option>
<option value="109">Hibiscus sabdariffa Linn.</option>
<option value="110">Hiptage benghalensis (L.) Kurz subsp. candicans (Hook.f.) Sirirugsa</option>
<option value="111">Hiptage benghalensis (Linn.) Kurz</option>
<option value="112">Hydnocarpus antelminthica Pierre ex Laness</option>
<option value="113">Irvingia malayana Oliv. ex a. Benn.</option>
<option value="114">Kaempferia parviflora Wall. ex Baker</option>
<option value="115">Lannea coromandelica (Houtt.) Merr.</option>
<option value="116">Lithocarpus polystachyus (Wall.) Rehd.</option>
<option value="117">Mitragyna diversifolia (Wall. ex G. Don) Havil</option>
<option value="118">Mitragyna parvifolia Korth.</option>
<option value="119">Mitragyna rotundifolia (Roxb.) Kuntze</option>
<option value="120">Mitrephora keithii Ridl.</option>
<option value="121">Monomeria barbata Lindl.</option>
<option value="122">Murdannia nudiflora (L.) Brenan</option>
<option value="123">Musa (AAA) ‘Nak’</option>
<option value="124">Musa (ABB Group) ‘Thepanom’</option>
<option value="125">Musa (ABBB Group) ‘Theparod’</option>
<option value="126">Musa balbisiana Colla</option>
<option value="127">Musa chiliocarpa Back.</option>
<option value="128">Musa gracilis Holttum</option>
<option value="129">Musa laterita cheeseman</option>
<option value="130">Musa superba Roxb.</option>
<option value="131">Naravelia laurifolia Wall. ex Hook.f.& Th.</option>
<option value="132">Nauclea orientalis (L.) L.</option>
<option value="133">Pachyptera hymenaea (DC.) A. Gentry</option>
<option value="134">Passiflorra foetida Linn.</option>
<option value="135">Pegia nitida Colebr.</option>
<option value="136">Picrasma javanica Bl.</option>
<option value="137">Pteris biaurita Linn.</option>
<option value="138">Pterospermum acerifolium Willd.</option>
<option value="139">Polyalthia cerasoides (Roxb.) Benth. ex Bedd.</option>
<option value="140">Polyalthia suberosa (Roxb.) Thwaites</option>
<option value="141">Polygonatum kingianum Coll. & Hemsl.</option>
<option value="142">Quercus kingiana Craib</option>
<option value="143">Quercus ramsbottomii A. Camus</option>
<option value="144">Quercus rex (Hemsl.) Schottky</option>
<option value="145">Radermachera ignea (Kurz) Steenis</option>
<option value="146">Ravenala madagascariensis F.J. Gmel.</option>
<option value="147">Rhododendron arboreum ssp. Delavayi (Franch.) Chamberlain</option>
<option value="148">Rhododendron microphyton Franch.</option>
<option value="149">Rhododendron simsii Planch</option>
<option value="150">Rosa 'Queen Sirikit'</option>
<option value="151">Salacia chinensis L.</option>
<option value="152">Schizomussaenda dehiscens Craib</option>
<option value="153">Scoparia dulcis Linn.</option>
<option value="154">Stenochlaena palustris.</option>
<option value="155">Stephania venosa (Blume) Spreng.</option>
<option value="156">Styrax benzoides Craib</option>
<option value="157">Thelypteris spp.</option>
<option value="158">Tristaniopsis burmanica (Griff.) Peter G.Wilson & J.T.Waterh</option>
<option value="159">Tristaniopsis burmanica (Griff.) Peter G.Wilson & J.T.Waterh. var. rufescens (Hance) J.Parn. & Nic Lughada</option>
<option value="160">Uvaria grandiflora Roxb. ex Hornem</option>
<option value="161">Viscum articulatum Burm.f.</option>
<option value="162">Vitex peduncularis Wall.ex Schauer</option>
<option value="163">Zingiber spectabile Griff.</option>
			</select>
	</span>	
	
	<br><br>

	<span style="font-weight: bold;  margin-left: 2%;">
		เส้นผ่านศูนย์กลางเพียงอก
		<div class="ui input focus" style="margin-left: 2%; width: 8%;">
  				<input type="text"  >
		</div>
	</span>

	<span style="font-weight: bold;  margin-left: 1%;">
		เซนติเมตร
	</span>
		
	<span style="font-weight: bold;  margin-left: 5%;">
		ความสูง
		<div class="ui input focus" style="margin-left: 2%; width: 8%;">
  				<input type="text"  >
		</div>
	</span>

	<span style="font-weight: bold;  margin-left: 1%;">
		เมตร
	</span>
	
	<span style="font-weight: bold;  margin-left: 5%;">
		เส้นผ่านศูนย์กลางเรือนยอด
		<div class="ui input focus" style="margin-left: 2%; width: 8%;">
  				<input type="text"  >
		</div>
	</span>

	<span style="font-weight: bold;  margin-left: 1%;">
		เมตร
	</span>

	<br><br>

	<span style="font-weight: bold; ">
		ผู้ประเมิน
		<div class="ui input focus" style="margin-left: 2%; width: 8%;">
  				<input type="text"  >
		</div>
	</span>

	
	
</div>




<div>
	
</div>





@stop