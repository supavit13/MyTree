<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;

use Illuminate\Support\Facades\Input;
use Auth;
use Redirect;
use Hash;
use App\Tree;
use App\Userlogin;
use App\TypeTree;


class HomeController extends Controller
{
    function regist(Request $request){
        $users=Userlogin::all();
        if($request->session()->has('userlogin')){
            $userlogin=$request->session()->get('userlogin');
            return view('register',compact('userlogin','users'));
        }
        $userlogin = "Guest";
    	return view('register',compact('userlogin','users'));
    }
    function bkhome(Request $request){
        $this->lastCheck($request);
    	$trees = Tree::all();
    	if($request->session()->has('userlogin')){
    		$login_name=$request->session()->get('login_name');
    		$userlogin=Userlogin::Where('username','=', $login_name)->first();
            if($userlogin['email']==NULL){
                return redirect('/');
            }
            return view('new',compact('userlogin','login_name','trees'));
    	}
    	else{
    		return redirect('/');
    	}
    }

    function addform(Request $request){
        $this->lastCheck($request);
        $treeall=Tree::all();
        if($request->session()->has('login_name')){
            $login_name=$request->session()->get('login_name');
            $userlogin=Userlogin::Where('username', $login_name)->first();
            if($userlogin['email']==NULL){
                return $this->regist($request);
            }
            
            return view('form',compact('treeall','userlogin','login_name'));
        }else{
            return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
        }
    }

    // public function page_reload(Request $request){

    //     if( !(Auth::check() )){
    //         Auth::logout();
    //         return redirect('/');
    //     }
    //     // $users = Userlogin::where('username',$request->session()->get('login_name'));
    //     // if($users == NULL){
    //     //     return redirect('/');
    //     // }

    // }

    public function gohome(Request $request){
        $this->lastCheck($request);
        $trees = Tree::all();
        if($request->session()->has('login_name')){
            $login_name = $request->session()->get('login_name');
            $userlogin = $request->session()->get('userlogin');
            return view('new',compact('userlogin','login_name','trees'));
        }
        else{
            $login_name = "Guest";
            $request->session()->put('login_name',"Guest");
            return view('new',compact('login_name','trees'));
        }
    }

    public function sci_search(Request $request){
        $Tname = TypeTree::where('Local_Name_Thai',$request->id)->first();

        return response()->json($Tname);
    }
    public function lastCheck(Request $request){
        if($request->session()->has('login_name')){
            $login_name=$request->session()->get('login_name');
            $current_userlogin=$request->session()->get('userlogin');
            $db_userlogin=Userlogin::Where('username', $login_name)->first();
            // dd($db_userlogin);
            if($login_name=="Guest"){

            }
            else if($db_userlogin==null){
                $request->session()->flush();
                $request->session()->put('userlogin',"Guest");
                $request->session()->put('login_name',"Guest");
                return redirect('/')->with('message', 'มีการเปลี่ยนแปลงข้อมูลโดยผู้ดูแลระบบ');
            }
            else if($db_userlogin['approve']!=$current_userlogin['approve'] || $db_userlogin['position']!=$current_userlogin['position']){
                    $request->session()->flush();
                    $request->session()->put('userlogin',"Guest");
                    $request->session()->put('login_name',"Guest");
                    return redirect('/')->with('message', 'มีการเปลี่ยนแปลงข้อมูลโดยผู้ดูแลระบบ');
                }
            
            $request->session()->put('userlogin',$current_userlogin);
        }
    }
    public function store(Request $request){

        if($request->session()->has('login_name')){
            $login_name=$request->session()->get('login_name');
            $userlogin=Userlogin::Where('username','=', $login_name)->first();
            if($userlogin['email']==NULL){
                return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
            }
        }else{

            return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
        }
        if(!empty($request->input('update')) && $request->input('update')==1){
            $trees = Tree::find($request->input('id'));
        }else{
            $trees= new Tree;
        }

        

        // part 1

        $trees->Tree_name=$request->input('Tree_name');
        $trees->Tree_sci_name=$request->input('Tree_sci_name');
        $trees->Tree_type=$request->input('Tree_type');
        $trees->Tree_address=$request->input('Tree_address');
        $trees->Tree_diameter_Trunk=$request->input('Tree_diameter_Trunk');
        $trees->Tree_diameter_Top=$request->input('Tree_diameter_Top');
        $trees->Tree_height=$request->input('Tree_height');
        $trees->Tree_sequence=$request->input('Tree_sequence');
        $trees->Tree_date=$request->input('Tree_date');
        $trees->Tree_lat=$request->input('Tree_lat');
        $trees->Tree_long=$request->input('Tree_long');
        $trees->User_name=$request->input('User_name');
        $trees->UserID=$request->input('UserID');
        $trees->hire=$request->input('hire');
        $trees->agency=$request->input('agency');
        // part 2

        $trees->vehicle=$request->input('vehicle');
        $trees->vehCh1=$request->input('vehCh1');
        $trees->vehCh2=$request->input('vehCh2');
        $trees->vehCh3=$request->input('vehCh3');
        $trees->vehDamageAppear=$request->input('vehDamageAppear');
        $trees->vehMoveArea=$request->input('vehMoveArea');
        $trees->vehNoEntry=$request->input('vehNoEntry');
        $trees->building=$request->input('building');
        $trees->builCh1=$request->input('builCh1');
        $trees->builCh2=$request->input('builCh2');
        $trees->builCh3=$request->input('builCh3');
        $trees->builDamageAppear=$request->input('builDamageAppear');
        $trees->builMoveArea=$request->input('builMoveArea');
        $trees->builNoEntry=$request->input('builNoEntry');
        $trees->man=$request->input('man');
        $trees->manCh1=$request->input('manCh1');
        $trees->manCh2=$request->input('manCh2');
        $trees->manCh3=$request->input('manCh3');
        $trees->manDamangeArea=$request->input('manDamangeArea');
        $trees->manMoveArea=$request->input('manMoveArea');
        $trees->manNoEntry=$request->input('manNoEntry');
        $trees->pillar=$request->input('pillar');
        $trees->pillCh1=$request->input('pillCh1');
        $trees->pillCh2=$request->input('pillCh2');
        $trees->pillCh3=$request->input('pillCh3');
        $trees->pillDamageAppear=$request->input('pillDamageAppear');
        $trees->pillMoveArea=$request->input('pillMoveArea');
        $trees->pillNoEntry=$request->input('pillNoEntry');

        if($request->listDamage!=NULL){
            $listDamage=[];
            $ch1=[];
            $ch2=[];
            $ch3=[];
            $damageArea=[];
            $moveArea=[];
            $noEntry=[];
            $i=0;
            foreach ($request->listDamage as $value) {
                $listDamage[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->ch1 as $value) {
                $ch1[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->ch2 as $value) {
                $ch2[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->ch3 as $value) {
                $ch3[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->damageArea as $value) {
                $damageArea[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->moveArea as $value) {
                $moveArea[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->noEntry as $value) {
                $noEntry[$i]=$value;
                $i++;
            }
            $trees->listDamage=$listDamage; 
            $trees->ch1=$ch1;
            $trees->ch2=$ch2;
            $trees->ch3=$ch3;
            $trees->damageArea=$damageArea; 
            $trees->moveArea=$moveArea; 
            $trees->noEntry=$noEntry;
        }
        //  part3

        $trees->damageInArea=$request->input('damageInArea');
        $trees->topographyStats=$request->input('topographyStats');
        $trees->slope=$request->input('slope');
        $trees->slopeDirection=$request->input('slopeDirection');
        $trees->changeArea=$request->input('changeArea');
        $trees->changeAreaDetail=$request->input('changeAreaDetail');
        $trees->soilCh1=$request->input('soilCh1');
        $trees->soilCh2=$request->input('soilCh2');
        $trees->soilCh3=$request->input('soilCh3');
        $trees->soilCh4=$request->input('soilCh4');
        $trees->soilCh5=$request->input('soilCh5');
        $trees->soilCh6=$request->input('soilCh6');
        $trees->soilCh7=$request->input('soilCh7');
        $trees->soilDetail=$request->input('soilDetail');

        // part4

        $trees->strong=$request->input('strong');
        $trees->leafCh1=$request->input('leafCh1');
        $trees->leafCh2=$request->input('leafCh2');
        $trees->leafCh3=$request->input('leafCh3');
        $trees->leafCh4=$request->input('leafCh4');
        $trees->leafCh5=$request->input('leafCh5');
        $trees->leafCh6=$request->input('leafCh6');
        $trees->leafCh7=$request->input('leafCh7');
        $trees->leafCh8=$request->input('leafCh8');
        $trees->foundArea=$request->input('foundArea');
        $trees->symptom=$request->input('symptom');
        $trees->percenSymptom=$request->input('percenSymptom');
        $trees->causeType=$request->input('causeType');
        $trees->Enermy1=$request->input('Enermy1');
        $trees->Enermy2=$request->input('Enermy2');
        $trees->Enermy3=$request->input('Enermy3');
        $trees->Enermy4=$request->input('Enermy4');
        $trees->Enermy5=$request->input('Enermy5');
        $trees->Enermy6=$request->input('Enermy6');
        $trees->Enermy7=$request->input('Enermy7');
        $trees->Enermy8=$request->input('Enermy8');
        $trees->enermyDetail=$request->input('enermyDetail');

        // part 5

        $trees->windImpact=$request->input('windImpact');
        $trees->topCare=$request->input('topCare');
        $trees->topSize=$request->input('topSize');
        $trees->topThick=$request->input('topThick');
        $trees->parasite=$request->input('parasite');
        $trees->topBalance=$request->input('topBalance');
        $trees->limbDie=$request->input('limbDie');
        $trees->limbDieSize=$request->input('limbDieSize');
        $trees->limbBroke=$request->input('limbBroke');
        $trees->limbBrokeSize=$request->input('limbBrokeSize');
        $trees->limbLesion=$request->input('limbLesion');
        $trees->limbHole=$request->input('limbHole');
        $trees->limbNode=$request->input('limbNode');
        $trees->limbDie=$request->input('limbDie');
        $trees->limbFungus=$request->input('limbFungus');
        $trees->limbLit=$request->input('limbLit');
        $trees->limbTop=$request->input('limbTop');
        $trees->limbLion=$request->input('limbLion');
        $trees->limbFlush=$request->input('limbFlush');
        $trees->limbOther=$request->input('limbOther');
        $trees->limbDetail=$request->input('limbDetail');
        $trees->topHarmChance=$request->input('topHarmChance');
        $trees->liveCrownPercen=$request->input('liveCrownPercen');
        $trees->topStayAlert=$request->input('topStayAlert');
        $trees->trunkNormal=$request->input('trunkNormal');
        $trees->trunkBroke=$request->input('trunkBroke');
        $trees->trunkNode=$request->input('trunkNode');
        $trees->trunkDecay=$request->input('trunkDecay');
        $trees->trunkFungus=$request->input('trunkFungus');
        $trees->trunkHole=$request->input('trunkHole');
        $trees->trunkLiquid=$request->input('trunkLiquid');
        $trees->trunkDie=$request->input('trunkDie');
        $trees->trunkAbnormal=$request->input('trunkAbnormal');
        $trees->trunkThin=$request->input('trunkThin');
        $trees->trunkSlope=$request->input('trunkSlope');
        $trees->trunkHarmChance=$request->input('trunkHarmChance');
        $trees->trunkStayAlert=$request->input('trunkStayAlert');
        $trees->rootUp=$request->input('rootUp');
        $trees->rootDecay=$request->input('rootDecay');
        $trees->rootFungus=$request->input('rootFungus');
        $trees->rootWater=$request->input('rootWater');
        $trees->rootLesion=$request->input('rootLesion');
        $trees->rootBroke=$request->input('rootBroke');
        $trees->rootLiquid=$request->input('rootLiquid');
        $trees->rootNode=$request->input('rootNode');
        $trees->rootHarmChance=$request->input('rootHarmChance');
        $trees->rootStayAlert=$request->input('rootStayAlert');

        // part6
        $trees->damangeRiskFactorPill=$request->input('damangeRiskFactorPill');
        $trees->riskPillSize=$request->input('riskPillSize');
        $trees->riskPillTime=$request->input('riskPillTime');
        $trees->riskPillAmount=$request->input('riskPillAmount');
        $trees->riskPillProtect=$request->input('riskPillProtect');
        $trees->damangeRiskFactorTrunk=$request->input('damangeRiskFactorTrunk');
        $trees->riskTrunkSize=$request->input('riskTrunkSize');
        $trees->riskTrunkTime=$request->input('riskTrunkTime');
        $trees->riskTrunkAmount=$request->input('riskTrunkAmount');
        $trees->riskTrunkProtect=$request->input('riskTrunkProtect');
        $trees->damangeRiskFactorRoot=$request->input('damangeRiskFactorRoot');
        $trees->riskRootSize=$request->input('riskRootSize');
        $trees->riskRootTime=$request->input('riskRootTime');
        $trees->riskRootAmount=$request->input('riskRootAmount');
        $trees->riskRootProtect=$request->input('riskRootProtect');
        $trees->pillDamageRate=$request->input('pillDamageRate');
        $trees->pillDamageEffect=$request->input('pillDamageEffect');
        $trees->pillDamageEffectRate=$request->input('pillDamageEffectRate');
        $trees->pillLevelDamage=$request->input('pillLevelDamage');
        $trees->pillLevelDanger=$request->input('pillLevelDanger');
        $trees->trunkDamageRate=$request->input('trunkDamageRate');
        $trees->trunkDamageEffect=$request->input('trunkDamageEffect');
        $trees->trunkDamageEffectRate=$request->input('trunkDamageEffectRate');
        $trees->trunkLevelDamage=$request->input('trunkLevelDamage');
        $trees->trunkLevelDanger=$request->input('trunkLevelDanger');
        $trees->rootDamageRate=$request->input('rootDamageRate');
        $trees->rootDamageEffect=$request->input('rootDamageEffect');
        $trees->rootDamageEffectRate=$request->input('rootDamageEffectRate');
        $trees->rootLevelDamage=$request->input('rootLevelDamage');
        $trees->rootLevelDanger=$request->input('rootLevelDanger');
        if($request->treePartName!=NULL){
            $treePartSeq=[];
            $treePartName=[];
            $treePartFactor=[];
            $treePartSize=[];
            $treePartTime=[];
            $treePartAmount=[];
            $treePartProtect=[];
            $treePartDamage=[];
            $treePartEffect=[];
            $treePartEffectDamage=[];
            $treePartLDamage=[];
            $treePartLDanger=[];
            $i=0;
            foreach ($request->treePartSeq as $value) {
                $treePartSeq[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartName as $value) {
                $treePartName[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartFactor as $value) {
                $treePartFactor[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartSize as $value) {
                $treePartSize[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartTime as $value) {
                $treePartTime[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartAmount as $value) {
                $treePartAmount[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartProtect as $value) {
                $treePartProtect[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartDamage as $value) {
                $treePartDamage[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartEffect as $value) {
                $treePartEffect[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartEffectDamage as $value) {
                $treePartEffectDamage[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartLDamage as $value) {
                $treePartLDamage[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartLDanger as $value) {
                $treePartLDanger[$i]=$value;
                $i++;
            }
       
            $trees->treePartSeq=$treePartSeq;
            $trees->treePartName=$treePartName;
            $trees->treePartFactor=$treePartFactor; 
            $trees->treePartSize=$treePartSize;
            $trees->treePartTime=$treePartTime;
            $trees->treePartAmount=$treePartAmount; 
            $trees->treePartProtect=$treePartProtect; 
            $trees->treePartDamage=$treePartDamage;
            $trees->treePartEffect=$treePartEffect;
            $trees->treePartEffectDamage=$treePartEffectDamage;
            $trees->treePartLDamage=$treePartLDamage;
            $trees->treePartLDanger=$treePartLDanger;
        }
        
        $trees->moreDetail=$request->input('moreDetail');
        $trees->totalDamage=$request->input('totalDamage');
        $trees->timeDamage=$request->input('timeDamage');
        $trees->operateTime=$request->input('operateTime');
        $trees->moreEvaluate=$request->input('moreEvaluate');
        $trees->needMore=$request->input('needMore');
        
        // part7

        $fileListFull=$request->Tree_imgFull;
        $fileListTruck=$request->Tree_imgTruck;
        $fileListLeaf=$request->Tree_imgLeaf;
        $fileListRoot=$request->Tree_imgRoot;
        $fileListTop=$request->Tree_imgTop;
        $filename=[];
        $i=0;
        $path = 'images/uploads';
        if($fileListFull!=NULL){
            foreach ($fileListFull as $file){
                $filename[]=$file->hashName();
                $file->move($path,$filename[$i]);
                $i++;
            }
            $trees->Tree_imgFull= $filename;  
        }
        $filename=[];
        $i=0;
        if($fileListTruck!=NULL){
            foreach ($fileListTruck as $file){
                $filename[]=$file->hashName();
                $file->move($path,$filename[$i]);
                $i++;
            }
            $trees->Tree_imgTruck= $filename;
        }
        
        $filename=[];
        $i=0;
        if($fileListLeaf!=NULL){
            foreach ($fileListLeaf as $file){
                $filename[]=$file->hashName();
                $file->move($path,$filename[$i]);
                $i++;
            }
            $trees->Tree_imgLeaf= $filename;
        }
        
        $filename=[];
        $i=0;
        if($fileListRoot!=NULL){
            foreach ($fileListRoot as $file){
                $filename[]=$file->hashName();
                $file->move($path,$filename[$i]);
                $i++;
            }
            $trees->Tree_imgRoot= $filename;
        }
        
        $filename=[];
        $i=0;
        if($fileListTop!=NULL){
            foreach ($fileListTop as $file){
                $filename[]=$file->hashName();
                $file->move($path,$filename[$i]);
                $i++;
            }
            $trees->Tree_imgTop= $filename;
        }
        // dd($trees);
        $trees->save();
        $trees = Tree::all();
        return redirect('/gohome')->with('message', 'การบันทึกเสร็จสมบูรณ์');
        
    }

    public function index(Request $request){
        $this->lastCheck($request);
    	$trees = Tree::all();
        $login_name=$request->session()->get('login_name');
    	if($request->session()->has('login_name')){
    		$login_name=$request->session()->get('login_name');
    		$userlogin=Userlogin::Where('username','=', $login_name)->first();
            if($userlogin['email']==NULL){
                return redirect('/register')->with('message', 'โปรดสมัครสมาชิก');
            }
            return view('new',compact('userlogin','login_name','trees'));
    	}
    	else{
    		return view('new', compact('trees','login_name'));
    	}
    	
    }
    public function detail(Request $request,$id)
    {
        $this->lastCheck($request);
        $img = Tree::find($id);
        $users = Userlogin::where('_id',$img['UserID'])->first();
        $login_name=$request->session()->get('login_name');
        $userlogin=Userlogin::Where('username','=', $login_name)->first();
        return view('detail', compact('img','users','userlogin','login_name'));
    }
    public function editdetail(Request $request,$id){
        $this->lastCheck($request);
        $trees = Tree::find($id);
        $treeall = Tree::find($id);
        if($request->session()->has('login_name')){
            $login_name=$request->session()->get('login_name');
            $userlogin=Userlogin::Where('username','=', $login_name)->first();
            if($userlogin['email']==NULL){
                return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
            }
        }else{

            return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
        }
        return view('form', compact('treeall','trees','userlogin','login_name'));
    }
    public function treedel(Request $request){
        $this->lastCheck($request);
        $trees=Tree::all();
        $login_name=$request->session()->get('login_name');
        if($request->session()->has('userlogin')){
            $userlogin=$request->session()->get('userlogin');
            Tree::destroy($request->input('id'));
            return redirect('/treelist')->with('message','การลบต้นไม้เสร็จสมบูรณ์');
        }
        return redirect('/gohome')->with('message', 'คุณไม่ได้รับอนุญาต');
    }
    public function profiles(Request $request,$id)
    {
        $this->lastCheck($request);
        $login_name=$request->session()->get('login_name');
        $users = Userlogin::where('_id', $id)->first();
        $userlogin=Userlogin::Where('username','=', $login_name)->first();
        return view('showprofile', compact('users','userlogin','login_name'));
    }
    public function editprofiles(Request $request,$id)
    {
        $this->lastCheck($request);
        $userlogin = Userlogin::where('_id', $id)->first();
        if($request->session()->has('login_name')){
            $login_name=$request->session()->get('login_name');
            $person = Userlogin::where('username', $login_name)->first();
            if($login_name==$userlogin['username']||$person['position']=='admin'){
                $request->session()->put('userID',$id);
                return view('editprofile', compact('userlogin','login_name')); 
            }else{
                return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต'); 
            }
        }else{
            return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
        } 
    }
    public function saveProfile(Request $request){
        $this->lastCheck($request);
        $userlogin=$request->session()->get('userlogin');
        $id=$userlogin['_id'];
        $users = Userlogin::where('_id', $id)->first();
        if($request->session()->has('login_name')){
            $login_name=$request->session()->get('login_name');
            $person = Userlogin::where('username', $login_name)->first();
            if($login_name==$users['username']||$person['position']=='admin'){
                $pwd=$request->input('password');
                $newPwd=$request->input('newPassword');
                $conNewPwd=$request->input('ConfirmNewPassword');
                // dd($users['password']);
                // dd($pwd= Hash::make($newPwd));
                // !Hash::check($pwd,$users['password']
                // $pwd!=$users['password']
                if($pwd==NULL){
                    return redirect('/editprofiles/'.$id)->with('message', 'กรุณายืนยันรหัสผ่าน'); 
                }
                if(!Hash::check($pwd,$users['password'])){
                    // dd(Hash::check($pwd,$users['password']));
                    return redirect('/editprofiles/'.$id)->with('message', 'พาสเวิร์ดผิดพลาด'); 
                }


                $users = Userlogin::where('_id', $id)->first();
                if($newPwd!=NULL){
                    if($newPwd!=$conNewPwd){
                        return redirect('/editprofiles/'.$id)->with('message', 'พาสเวิร์ดไม่ตรงกัน'); 
                    }
                    else{
                        $newPwd = Hash::make($newPwd);
                        $users->password = $newPwd;
                    }
                }
                $users->username=$request->input('username');
                $users->phone=$request->input('phone');
                $users->email=$request->input('email');
                $users->department=$request->input('department');
                $users->rank=$request->input('rank');
                $file=$request->file('picprofile');
                if($file!=NULL){
                    $path = 'images/profiles';
                    $filename=$file->hashName();
                    $file->move($path,$filename);
                    $users->photo= $filename; 
                }
                $users->save();
                $users = Userlogin::where('_id', $id)->first();
                $request->session()->put('userlogin',$users);
                $request->session()->put('login_name',$users['username']);
                return redirect('/editprofiles/'.$id)->with('message', 'บันทึกเสร็จสมบูรณ์');  
            }else{
                return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต'); 
            }
        }else{
            return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
        } 
    }
    public function createUser(Request $request){

        $request->session()->flush();
        $pwd=$request->input('password');
        $confirmpwd=$request->input('confirmPassword');
        if($pwd!=$confirmpwd){
            return redirect('/register')->with('message', 'พาสเวิร์ดไม่ตรงกัน');
        }else{
            $pwd = Hash::make($pwd);
        }
        $users=new Userlogin;
        $users->username=$request->input('name');
        $users->phone=$request->input('phone');
        $users->department=$request->input('department');
        $users->rank=$request->input('rank');
        $users->email=$request->input('email');
        $users->password=$pwd;
        $users->position="user";
        $users->approve=0;
        $users->save();
        $request->session()->flush();
        return redirect('/')->with('message', 'รอการตรวจสอบ');
    }
    public function getlatlng(Request $request,$lat,$lng)
    {
        $this->lastCheck($request);
        if($request->session()->has('userlogin')){
            $userlogin=$request->session()->get('userlogin');
            $request->session()->put('lat',$lat);
            $request->session()->put('lng',$lng);
            $login_name=$request->session()->get('login_name');
            return view('form',compact('lat','lng','userlogin','login_name'));
        }else{
            return redirect('/gohome')->with('message', 'คุณไม่ได้รับอนุญาต');
        }
    }

    public function facebookAuthRedirect(Request $request) {
        $request->session()->put('login_with','facebook');
        return Socialite::with('facebook')->redirect();
    }
    public function googleAuthRedirect(Request $request) {
        $request->session()->put('login_with','google');
        return Socialite::with('google')->redirect();
    }
    public function emaillogin(Request $request) {
        $email=$request->input('email');
        $rawpwd=$request->input('password');
        $request->session()->put('login_with','email');
        $userlogin=Userlogin::Where('email', $email)->first();
        if($userlogin['email']!=NULL){
            if(!Hash::check($rawpwd,$userlogin['password'])){
                $request->session()->flush();
                return redirect('/')->with('message', 'พาสเวิร์ดผิดพลาด');
            }
            if($userlogin['approve']==0){
                $request->session()->flush();
                return redirect('/')->with('message', 'รอการตรวจสอบ');
            }
            $request->session()->put('login_name',$email);
            $login_name=$request->session()->get('login_name');
            if($userlogin['username']!=NULL){
                $login_name=$userlogin['username'];
                $request->session()->put('login_name',$login_name);
            }
            $request->session()->put('userlogin',$userlogin);
            return redirect('/gohome');
        }else{
            $request->session()->flush();
            return redirect('/')->with('message', 'อีเมลผิดพลาด');
        }
        // $rawpwd!=$userlogin['password']
        // return redirect('gohome');
        // $password = Hash::make($rawpwd);
        // !Hash::check($rawpwd,$userlogin['password'])
    }
    public function validation(Request $request){
        $login_with=$request->session()->get('login_with');
        if($request->session()->has('login_with')){
            if($login_with=='facebook'||$login_with=='google'){
                $provider = Socialite::with($login_with);
                if (Input::has('code')){
                    $user = $provider->stateless()->user();
                    $request->session()->put('login_name',$user->name);
                    $login_name=$request->session()->get('login_name');
                    $userlogin=Userlogin::Where('username', $login_name)->first();
                    if($userlogin['email']!=NULL&&$userlogin['approve']==0){
                        $request->session()->flush();
                        return redirect('/')->with('message', 'รอการตรวจสอบ');
                    }
                    if($userlogin['email']==NULL||$userlogin['approve']==NULL||$userlogin['approve']==0){
                        $request->session()->flush();
                        $request->session()->put('userlogin',$user);
                        return redirect('/register')->with('message', 'โปรดสมัครสมาชิก'); 
                    }else{
                        $request->session()->put('userlogin',$userlogin);
                        return redirect('/gohome'); 
                    }
                }
            }
        }else{
            $request->session()->flush();
            return redirect('/');
        }
    }
    public function approve(Request $request){
        $this->lastCheck($request);
        if($request->session()->has('userlogin')){
            $userlogin=$request->session()->get('userlogin');
            $login_name=$request->session()->get('login_name');
            if($userlogin['position']!='admin'){
                return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
            }else{
                $users=Userlogin::all();
                return view('approve',compact('users','userlogin','login_name'));
            }
        }else{
            return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
        }
    }
    public function treelist(Request $request){
        $this->lastCheck($request);
        $trees=Tree::all();
        $login_name=$request->session()->get('login_name');
        if($request->session()->has('userlogin')){
            $userlogin=$request->session()->get('userlogin');

            return view('treelist',compact('trees','userlogin','login_name'));
        }
        return view('treelist',compact('trees','login_name'));
    }
    public function printPaper(Request $request,$id){
        $this->lastCheck($request);
        $trees = Tree::find($id);
        if($request->session()->has('login_name')){
            $login_name=$request->session()->get('login_name');
            $userlogin=Userlogin::Where('username','=', $login_name)->first();
            if($userlogin['email']==NULL){
                return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
            }
        }else{

            return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
        }
        return view('print', compact('trees','userlogin','login_name'));
    }
    public function manageUser(Request $request){
        $this->lastCheck($request);
        if($request->session()->has('userlogin')){
            $userlogin=$request->session()->get('userlogin');
            if($userlogin['position']!='admin'){
                return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
            }else{
                $submit=$request->input('submit');
                $id=$request->input('id');
                if($submit=='approve'){
                    $user=Userlogin::where('_id',$id)->first();
                    $approving=$request->input('approve');
                    if($approving==0){
                        $user->approve=1;
                    }else{
                        $user->approve=0;
                    }
                    $user->save();
                }elseif($submit=='delete'){
                    Userlogin::destroy($id);
                }elseif($submit=='admin'){
                    $user=Userlogin::where('_id',$id)->first();
                    $user->position=$request->input('submit');
                    $user->save();
                }elseif($submit=='user'){
                    $user=Userlogin::where('_id',$id)->first();
                    $user->position=$request->input('submit');
                    $user->save();
                }
                $users=Userlogin::all();
                $userlogin=Userlogin::where('_id',$userlogin['_id'])->first();
                $request->session()->put('userlogin',$userlogin);
                return redirect('/approve')->with('users');
            }
        }else{
            return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
        }
        

    }
	public function deleteSessionData(Request $request){
		$request->session()->flush();
		return redirect('/');
	}
}