<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;

use Illuminate\Support\Facades\Storage;
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


    function indexof($arr,$value){
  
      $list_count=count($arr);
      for($i=0;$i<$list_count;$i++)
      {
              if($arr[$i]==$value){
                        $position=$i;
              }
      
      }
      return $position;
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

        $trees->ownerarea=$request->input('ownerarea');
        $trees->Tree_name=$request->input('Tree_name');
        $trees->Tree_sci_name=$request->input('Tree_sci_name');
        $trees->Tree_type=$request->input('Tree_type');
        $trees->Tree_address=$request->input('Tree_address');
        $trees->Tree_diameter_Trunk=$request->input('Tree_diameter_Trunk');
        $trees->Tree_diameter_Top=$request->input('Tree_diameter_Top');
        $trees->Tree_height=$request->input('Tree_height');
        $trees->Tree_sequence=$request->input('Tree_sequence');
        $trees->Tree_date=$request->input('Tree_date');
        $trees->Tree_time=$request->input('Tree_time');
        $trees->Tree_lat=$request->input('Tree_lat');
        $trees->Tree_long=$request->input('Tree_long');
        $trees->User_name=$request->input('User_name');
        $trees->UserID=$request->input('UserID');
        $trees->Tree_phone=$request->input('Tree_phone');
        // $trees->hire=$request->input('hire');
        $trees->agency=$request->input('agency');




        if($request->fulltree!=NULL){
            $tree_id = Tree::find($request->input('id'));

            $full = [];
            $full[] = $request->fulltree;
    
            foreach ($request->fulltree as $value) {
                foreach ($tree_id->Tree_imgFull as $key) {
                    if($value == $key){
                        dd($this->indexof($full,$value));
                        unlink('images/uploads/'.$value);
                        
                    }

                }
                
            }
        }





        // part 2


        if($request->listDamage!=NULL){
            $listDamage=[];
            $protectTarget=[];
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
            foreach ($request->protectTarget as $value) {
                $protectTarget[$i]=$value;
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
            $trees->protectTarget=$protectTarget; 
            $trees->ch1=$ch1;
            $trees->ch2=$ch2;
            $trees->ch3=$ch3;
            $trees->damageArea=$damageArea; 
            $trees->moveArea=$moveArea; 
            $trees->noEntry=$noEntry;
        }
        //  part3

        $trees->damageInArea=$request->input('damageInArea');
        $trees->radioSlope=$request->input('radioSlope');
        $trees->slope=$request->input('slope');
        $trees->slopeDirection=$request->input('slopeDirection');
        $trees->changeArea=$request->input('changeArea');
        $trees->changeAreaDetail=$request->input('changeAreaDetail');
        // $trees->soilCh1=$request->input('soilCh1');
        $trees->soilCh2=$request->input('soilCh2');
        $trees->soilCh3=$request->input('soilCh3');
        $trees->soilCh4=$request->input('soilCh4');
        $trees->soilCh5=$request->input('soilCh5');
        $trees->soilCh6=$request->input('soilCh6');
        $trees->soilCh7=$request->input('soilCh7');
        $trees->soilDetail=$request->input('soilDetail');
        $trees->weather1=$request->input('weather1');
        $trees->weather2=$request->input('weather2');
        $trees->weather3=$request->input('weather3');
        $trees->weather_other=$request->input('weather_other');

        // part4

        $trees->strong=$request->input('strong');
        $trees->leafCh1=$request->input('leafCh1');
        $trees->leafCh2=$request->input('leafCh2');
        $trees->leafCh3=$request->input('leafCh3');
        $trees->leafCh4=$request->input('leafCh4');
        $trees->leafCh4_text=$request->input('leafCh4_text');
        $trees->leafCh5=$request->input('leafCh5');
        $trees->leafCh5_text=$request->input('leafCh5_text');
        $trees->leafCh6=$request->input('leafCh6');
        $trees->leafCh6_text=$request->input('leafCh6_text');
        $trees->monster1=$request->input('monster1');
        $trees->symptom1=$request->input('symptom1');
        $trees->monster2=$request->input('monster2');
        $trees->symptom2=$request->input('symptom2');

        


        // part 5

        $trees->windImpact=$request->input('windImpact');
        $trees->topCare=$request->input('topCare');
        $trees->topSize=$request->input('topSize');
        $trees->topThick=$request->input('topThick');
        $trees->parasite=$request->input('parasite');
        $trees->amount_of_branch=$request->input('amount_of_branch');
        $trees->changeAreaFuture=$request->input('changeAreaFuture');

        // part 6

        $trees->topBalance=$request->input('topBalance');
        $trees->liveCrownPercen=$request->input('liveCrownPercen');
        $trees->dryBranches=$request->input('dryBranches');
        $trees->limbDieSize=$request->input('limbDieSize');
        $trees->brokenBranches=$request->input('brokenBranches');
        $trees->limbBrokeSize=$request->input('limbBrokeSize');
        $trees->limbLesion=$request->input('limbLesion');
        $trees->limbHole=$request->input('limbHole');
        $trees->limbNode=$request->input('limbNode');
        $trees->limbDie=$request->input('limbDie');
        $trees->limbFungus=$request->input('limbFungus');
        $trees->limbLit=$request->input('limbLit');
        $trees->limbLitOther=$request->input('limbLitOther');
        $trees->topStayAlert=$request->input('topStayAlert');
        $trees->topHarmChance=$request->input('topHarmChance');
        $trees->trunkTwin=$request->input('trunkTwin');
        $trees->trunkTogather=$request->input('trunkTogather');
        $trees->trunkDie=$request->input('trunkDie');
        $trees->trunkAbnormal=$request->input('trunkAbnormal');
        $trees->trunkBroke=$request->input('trunkBroke');
        $trees->trunkHole=$request->input('trunkHole');
        $trees->trunkDecay=$request->input('trunkDecay');
        $trees->trunkLiquid=$request->input('trunkLiquid');
        $trees->trunkNode=$request->input('trunkNode');
        $trees->trunkDecayDamage=$request->input('trunkDecayDamage');
        $trees->trunkFungus=$request->input('trunkFungus');
        $trees->trunkThin=$request->input('trunkThin');
        $trees->trunkSlope_checkbox=$request->input('trunkSlope_checkbox');
        $trees->trunkSlope=$request->input('trunkSlope');
        $trees->trunkStayAlert=$request->input('trunkStayAlert');
        $trees->trunkHarmChance=$request->input('trunkHarmChance');
        $trees->rootDown=$request->input('rootDown');
        $trees->rootWrap=$request->input('rootWrap');
        $trees->rootUp=$request->input('rootUp');
        $trees->rootBroke=$request->input('rootBroke');
        $trees->rootLesion=$request->input('rootLesion');
        $trees->rootLiquid=$request->input('rootLiquid');
        $trees->rootNode=$request->input('rootNode');
        $trees->rootDecay=$request->input('rootDecay');
        $trees->rootCavity=$request->input('rootCavity');
        $trees->rootFungus=$request->input('rootFungus');
        $trees->rootWater=$request->input('rootWater');
        $trees->rootStayAlert=$request->input('rootStayAlert');
        $trees->rootHarmChance=$request->input('rootHarmChance');

        // part 7

        if($request->treePartName!=NULL){
            $treePartSeq=[];
            $treePartName=[];
            $treePartFactor=[];
            // $treePartSize=[];
            // $treePartTime=[];
            // $treePartAmount=[];
            // $treePartProtect=[];
            $treePartDamage=[];
            $treePartImpact=[];
            $treePartPlus=[];
            $treePartRank=[];
            $treeDamage=[];
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
            foreach ($request->treePartDamage as $value) {
                $treePartDamage[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartImpact as $value) {
                $treePartImpact[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartPlus as $value) {
                $treePartPlus[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treePartRank as $value) {
                $treePartRank[$i]=$value;
                $i++;
            }
            $i=0;
            foreach ($request->treeDamage as $value) {
                $treeDamage[$i]=$value;
                $i++;
            }
       
            $trees->treePartSeq=$treePartSeq;
            $trees->treePartName=$treePartName;
            $trees->treePartFactor=$treePartFactor;  
            $trees->treePartDamage=$treePartDamage;
            $trees->treePartImpact=$treePartImpact;
            $trees->treePartPlus=$treePartPlus;
            $trees->treePartRank=$treePartRank;
            $trees->treeDamage=$treeDamage;
        }
        
        $trees->moreDetail=$request->input('moreDetail');
        $trees->Solution1=$request->input('Solution1');
        $trees->problem1=$request->input('problem1');
        $trees->Solution2=$request->input('Solution2');
        $trees->problem2=$request->input('problem2');
        $trees->totalDamage=$request->input('totalDamage');
        $trees->operateTime=$request->input('operateTime');
        $trees->moreEvaluate=$request->input('moreEvaluate');
        $trees->needMore=$request->input('needMore');

        
        // part 8

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
        $trees = Tree::find($id);
        $users = Userlogin::where('_id',$img['UserID'])->first();
        $login_name=$request->session()->get('login_name');
        $userlogin=Userlogin::Where('username','=', $login_name)->first();
        return view('detail', compact('trees','img','users','userlogin','login_name'));
    }


    public function editdetail(Request $request,$id){
        $this->lastCheck($request);
        $trees = Tree::find($id);
        $treeall = Tree::find($id);
        $img = Tree::find($id);
        if($request->session()->has('login_name')){
            $login_name=$request->session()->get('login_name');
            $userlogin=Userlogin::Where('username','=', $login_name)->first();
            if($userlogin['email']==NULL){
                return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
            }
        }else{

            return redirect('/')->with('message', 'คุณไม่ได้รับอนุญาต');
        }
        return view('form', compact('treeall','trees','userlogin','login_name','img'));
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
