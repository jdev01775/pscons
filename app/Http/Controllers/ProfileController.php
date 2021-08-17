<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Position;
use App\ProjectLinkUser;
use App\UserLinkImg;
use App\User;

class ProfileController extends Controller
{
    public function rmdir_recursive($dir) {
        foreach(scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$dir/$file")) $this->rmdir_recursive("$dir/$file");
            else unlink("$dir/$file");
        }
        rmdir($dir);

        return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    { 
        $position = Position::where('position_id',Auth::user()->position_id)->get();
        $project_link_users = ProjectLinkUser::where('users_id',Auth::user()->id)->leftJoin('projects','projects.projects_id','project_link_users.projects_id')->get();
        $users_link_img = UserLinkImg::where('users_id',Auth::user()->id)->get();
       return view('menu.setting.profile.show',compact('position','project_link_users','users_link_img'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = Position::where('position_id',Auth::user()->position_id)->get();
        $project_link_users = ProjectLinkUser::where('users_id',Auth::user()->id)->leftJoin('projects','projects.projects_id','project_link_users.projects_id')->get();
        $users_link_img = UserLinkImg::where('users_id',Auth::user()->id)->get();
        return view('menu.setting.profile.edit',compact('position','project_link_users','users_link_img'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
       
        $user_id = $request->input('user_id');
        $users_check = User::where('id',$user_id)->get();
        $email_check = $users_check[0]['email'] ;

        $validatedData = $this->validate( $request,[
            'user_firstname'=>'required',
            'user_lastname'=>'required',
            'email'=>'required',
           
        ],
        [   
            'user_firstname.required'    => 'กรุณากรอก ชื่อผู้ใช้งาน',
            'user_lastname.required'    => 'กรุณากรอก นามสกุลผู้ใช้งาน',
            'email.required'    => 'กรุณากรอก Email',
         
        ]
        );

        if($email_check != $request->input('email')){
            $validatedData = $this->validate( $request,[
                'email'=>'unique:users',
            ],
            [   
                'email.unique'    => 'Email ซ้ำ',
            ]
            );
        }

        $users = User::where('id',$user_id)->update([
            'username'=>$request->input('email'),
            'user_firstname'=>$request->input('user_firstname'),
            'name'=>$request->input('user_firstname'),
            'user_lastname'=>$request->input('user_lastname'),
            'email'=>$request->input('email'),
            ]);
        
          // add image  && upload 

          if($request->input('user_img') != "undefined"){
            $get_key_request = array_keys( $request->all());
            UserLinkImg::where('users_id',$user_id)->delete();
            $folderPath = public_path('uploads_profile/'.$user_id);
            $response = $this->rmdir_recursive($folderPath);
            foreach ($get_key_request as $key => $value) {
                if ($request->hasFile($value)) {
    
                    $image = new UserLinkImg;
                    $imagePath = $request->file($value);
                    $imageName = $imagePath->getClientOriginalName();
                
                    $path_dir = $request->file($value)->storeAs('uploads_profile/'.$user_id, $imageName, 'public');
                    $path_stroe = $imagePath->move('uploads_profile/'.$user_id,$imageName);
                    
                    $image->users_link_img_name = $imageName;
                    $image->users_link_img_name_new = 'new_'.$imageName;
                    $image->users_link_img_path = $path_dir ;
                    $image->users_id  =$user_id; 
                    
                    
                    $image->save();
                
                }
            }
        }

        return json_encode($validatedData);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
