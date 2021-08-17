<?php

namespace App\Http\Controllers;

use App\Position;
use App\User;
use App\Project;
use App\UserLinkImg;
use App\ProjectLinkUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

// email
 
use App\Mail\UserPasswordMail;
use Illuminate\Support\Facades\Mail;
class UsersController extends Controller
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
    
    public function table_users(Request $reqeust)
    {
        //

 
        $offset = $reqeust->input('offset');
        $limit = $reqeust->input('limit');
        // $user_name = $reqeust->input('user_name');

  
        
        // $data_user = User:: where('user_name','like','%'.$user_name.'%') ;
        $data_user = User:: select('*')
        ->leftJoin('position', 'position.position_id', '=', 'users.position_id');
        $total = $data_user->get()->count();
        $total_not_filtered = User::all()->count();
        
        $data_user_query = $data_user
        ->offset($offset)
        ->limit($limit)
        ->orderBy('id','desc')
        ->get();
       
       
        $rows = [];
        foreach ($data_user_query as $key => $value) {
            $users_id = $value['id'];
            $user_status = $value['user_status'];
            $icon_edit = asset('/img/icon_edit.svg');
            $icon_remove = asset('/img/icon_remove.svg');
            $icon_user_acitve = asset('/img/icon_active.svg');
            $icon_user_inactive = asset('/img/icon_inactive.svg');

            $btn_edit = "<div role='button' class='d-flex align-safe-center' id='edit_users'
                        data-users-id='$users_id'
                        style='column-gap:12px;text-decoration: underline;color:#003927'
                        >
                        <img src='$icon_edit' />
                        <span   style='padding-top:5px'>แก้ไข</span>
                        </div>";
            $btn_remove ="<div role='button' class='d-flex align-safe-center'  id='remove_users'
                        data-users-id='$users_id'
                        style='column-gap:12px;text-decoration: underline;color:#003927'
                        >
                        <img src='$icon_remove' />
                        <span style='padding-top:5px'>ลบรายชื่อ</span>
                        </div>";

            $user_status_name = "Active";
            $user_status_icon = $icon_user_acitve;
            if($user_status === 1){
            $user_status_name = "Inactive";
            $user_status_icon = $icon_user_inactive;
            }

            $layout_userstatus = "<div class='d-flex'>
                                        <img src='$user_status_icon' />
                                        <span>$user_status_name</span>
                                </div>";
            $col['username'] = $value['user_firstname']." ".$value['user_lastname'];
            $col['position_name'] = $value['position_name'];
            $col['user_status'] = $layout_userstatus;

            $col['user_tool'] = "<div class='d-flex flex-row'
                                    style='column-gap:35px'
                                    >
                                        $btn_edit
                                        $btn_remove
                                    </div>";
            array_push($rows, $col);
           
        }
        return  ['total'=>$total,'rows'=>  $rows,'totalNotFiltered'=>$total_not_filtered];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $reqeust)
    {
        $data_position = Position::all();
        return view('menu.setting.user.index',compact(['data_position']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //
         $data = User::all();
         $data_projects = Project::all();
         $data_position = Position::all();
         return view('menu.setting.user.create',compact(['data_projects','data_position']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//         $user_id  = 1;
//  $email = 'pscons00@gmail.com';

//         $mail =  Mail::to($email )->send(new UserPasswordMail($user_id));
// dd();
      
      
        $validatedData = $this->validate( $request,[
            'user_firstname'=>'required',
            'user_lastname'=>'required',
            'position_id'=>'required',
            'email'=>'required',
            'email'=>'unique:users',
        ],
        [   
            'user_firstname.required'    => 'กรุณากรอก ชื่อผู้ใช้งาน',
            'user_lastname.required'    => 'กรุณากรอก นามสกุลผู้ใช้งาน',
            'position_id.required'    => 'กรุณาเลือก ตำแหน่ง',
            'email.required'    => 'กรุณากรอก Email',
            'email.unique'    => 'Email ซ้ำ',
        ]
        );


        $user_status = $request->input('user_status');
        if($user_status != '0'){
            $user_status = '1';
        }
        // $password = str_random(8);
        $password = "PasswOrd12345!";
        $hashed_random_password = Hash::make($password);

        $users = User::create([
            'username'=>$request->input('email'),
            'user_firstname'=>$request->input('user_firstname'),
            'name'=>$request->input('user_firstname'),
            'user_lastname'=>$request->input('user_lastname'),
            'user_status'=>$user_status,
            'position_id'=>$request->input('position_id'),
            'email'=>$request->input('email'),
            'password'=>$hashed_random_password,
            ]);
        $user_id = $users->id ;
        // add project_link_user 
        $project_link_users =  json_decode($request->input('project_link_users'),true);

        foreach ($project_link_users as $key => $value) {
            $project_detail_store = ProjectLinkUser::create([
                'users_id' => $user_id,
                'projects_id' => $value['project_id'],
                ]);
        }

        // add image  && upload 
        $get_key_request = array_keys( $request->all());
      
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
        $mail =  Mail::to($request->input('email'))->send(new UserPasswordMail($user_id,$password));
        return json_encode($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
       
        $data_users = User::where('id',$id)->get()->toArray();
        $data_position = Position::all();
        $data_projects = Project::all();
        $data_project_link_users = ProjectLinkUser::select('projects_id')->where('users_id',$id)->get()->toArray();
        $projects_id_list = [];
        foreach ($data_project_link_users as $key => $value) {
           array_push($projects_id_list,$value['projects_id']);
        }
        $data_users_link_img = UserLinkImg::where('users_id',$id)->get()->toArray();
        
        return view('menu.setting.user.edit',compact(['projects_id_list','data_users','data_position','data_users_link_img','data_projects']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user_id = $request->input('user_id');

        $users_check = User::where('id',$user_id)->get();
        $email_check = $users_check[0]['email'] ;

        $validatedData = $this->validate( $request,[
            'user_firstname'=>'required',
            'user_lastname'=>'required',
            'position_id'=>'required',
            'email'=>'required',
           
        ],
        [   
            'user_firstname.required'    => 'กรุณากรอก ชื่อผู้ใช้งาน',
            'user_lastname.required'    => 'กรุณากรอก นามสกุลผู้ใช้งาน',
            'position_id.required'    => 'กรุณาเลือก ตำแหน่ง',
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


        $user_status = $request->input('user_status');
        if($user_status != '0'){
            $user_status = '1';
        }

       
        $users = User::where('id',$user_id)->update([
            'username'=>$request->input('email'),
            'user_firstname'=>$request->input('user_firstname'),
            'name'=>$request->input('user_firstname'),
            'user_lastname'=>$request->input('user_lastname'),
            'user_status'=>$user_status,
            'position_id'=>$request->input('position_id'),
            'email'=>$request->input('email'),
            ]);



          // add project_link_user 
          $project_link_users =  json_decode($request->input('project_link_users'),true);
          ProjectLinkUser::where('users_id',$user_id)->delete();
          foreach ($project_link_users as $key => $value) {
              $project_detail_store = ProjectLinkUser::create([
                  'users_id' => $user_id,
                  'projects_id' => $value['project_id'],
                  ]);
          }


           // add image  && upload 

        if($request->input('user_img') != "undefined"){
            $get_key_request = array_keys( $request->all());
            UserLinkImg::where('users_id',$user_id)->delete();
            $folderPath = public_path('uploads_profile/'.$user_id);
            if (file_exists($folderPath)) {
                $response = $this->rmdir_recursive($folderPath);
            }
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
        $users=User::where('id','=',$id)->delete();

        $folderPath = public_path('uploads_profile/'.$id);
        $response = $this->rmdir_recursive($folderPath);

        return json_encode($users);
    }
}
