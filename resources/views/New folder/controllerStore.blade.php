public function store(Request $request){
    	$trees= new Tree;
    	$trees->Tree_name=$request->input('Tree_name');
    	$trees->Tree_sci_name=$request->input('Tree_sci_name');
    	$trees->Tree_type=$request->input('Tree_type');
    	$trees->Tree_address=$request->input('Tree_address');
    	$trees->Tree_diameter=$request->input('Tree_diameter');
    	$trees->Tree_lat=$request->input('Tree_lat');
    	$trees->Tree_long=$request->input('Tree_long');
        $file0 = $request->file('Tree_imgFull');
        $file1 = $request->file('Tree_imgTruck');
        $file2 = $request->file('Tree_imgLeaf');
        $file3 = $request->file('Tree_imgTop');
        $file4 = $request->file('Tree_imgRoot');
    	$trees->User_name=$request->input('User_name');
        $filename0 = $file0->hashName();
        $filename1 = $file1->hashName();
        $filename2 = $file2->hashName();
        $filename3 = $file3->hashName();
        $filename4 = $file4->hashName();
        $path = 'images/uploads';
        $file0->move($path,$file0->hashName());
        $file1->move($path,$file1->hashName());
        $file2->move($path,$file2->hashName());
        $file3->move($path,$file3->hashName());
        $file4->move($path,$file4->hashName());
        $trees->Tree_imgFull = $filename0;
        $trees->Tree_imgTruck = $filename1;
        $trees->Tree_imgLeaf = $filename2;
        $trees->Tree_imgTop = $filename3;
        $trees->Tree_imgRoot = $filename4;
    	$trees->save();
    	$trees = Tree::all();
    	if($request->session()->has('login_name')){
    		$login_name=$request->session()->get('login_name');
    		return view('new',compact('login_name','trees'));
    	}
    	else{
    		return view('new', compact('trees'));
    	}
    }