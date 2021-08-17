<?php

namespace App\Http\Controllers;
use App\Permission;
use App\PermissionCheck;
use App\MainMenu;
use App\Position;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  
    public function position_clone(Request $reqeust)
    {
        $position_id = $reqeust->input('position_id');
        $position_name    = Position::where('position_id','=',$position_id)->value('position_name');
        $position_name_check    = Position::where('position_name','like','%'.$position_name.'%')->count();
        $position_name_check =  $position_name_check-1;
        if( $position_name_check === 0){
            $position_name_check = '';
        }
        $position_name .= ' copy'.$position_name_check;
        $position = Position::create([
            'position_name'=>$position_name,
            ]);

        $data_permission_check = PermissionCheck::where('position_id','=',$position_id)->get();
        foreach ($data_permission_check as $key => $value) {
            $permission_check = PermissionCheck::create([
                'position_id' => $position->id,
                'permisions_id' => $value->permisions_id,
             ]);
        }
        return json_encode($position);
    }
    public function index_position(Request $reqeust)
    {
        // dd($reqeust->input());
       
        $offset = $reqeust->input('offset');
        $limit = $reqeust->input('limit');
        $position_name = $reqeust->input('position_name');

  
        
        $data_position = Position:: where('position_name','like','%'.$position_name.'%') ;
        $total = $data_position->get()->count();
        $total_not_filtered = Position::all()->count();
        
        $data_position_query = $data_position
        ->offset($offset)
        ->limit($limit)
        ->orderBy('position_id','desc')
        ->get();
       
       
       
       
        $rows = [];
        foreach ($data_position_query as $key => $value) {
            $position_id = $value['position_id'];
            $icon_edit = asset('/img/icon_edit.svg');
            $icon_dup = asset('/img/icon_dup.svg');
            $icon_remove = asset('/img/icon_remove.svg');
            $btn_edit = "<div role='button' class='d-flex align-safe-center' id='edit_position'
                        data-position-id='$position_id'
                        style='column-gap:12px;text-decoration: underline;color:#003927'
                        >
                        <img src='$icon_edit' />
                        <span   style='padding-top:5px'>แก้ไข</span>
                        </div>";

            $btn_dup = "<div role='button' class='d-flex align-safe-center' id='dup_position'
                        data-position-id='$position_id'
                        style='column-gap:12px;text-decoration: underline;color:#003927'
                        >
                        <img src='$icon_dup' />
                        <span style='padding-top:5px'>คัดลอก</span>
                        </div>";

            $btn_remove ="<div role='button' class='d-flex align-safe-center'  id='remove_position'
                        data-position-id='$position_id'
                        style='column-gap:12px;text-decoration: underline;color:#003927'
                        >
                        <img src='$icon_remove' />
                        <span style='padding-top:5px'>ลบ</span>
                        </div>";

            $col['position_name'] = $value['position_name'];
            $col['position_tool'] = "<div class='d-flex flex-row'
                                    style='column-gap:35px'
                                    >
                                        $btn_edit
                                        $btn_dup
                                        $btn_remove
                                    </div>";
            array_push($rows, $col);
           
        }
        return  ['total'=>$total,'rows'=>  $rows,'totalNotFiltered'=>$total_not_filtered];
    }

    public function index_permision()
    {
        $data_permision = Permission::all();
        $data_main_menu = MainMenu::orderBy('id', 'asc')->get();
        
        $route_ref = 'setting.position.create';
        return  view('menu.setting.position.create',compact(['data_permision',
                                                'data_main_menu',
                                                'route_ref']))   ;
    }

    public function index_position_edit(Request $request)
    {
        $position_id = $request->input('position_id');
        $data_permision = Permission::all();
        $data_permission_checks = PermissionCheck::select('permisions_id')->where('position_id','=',$position_id)->get();
        $data_permission_check = [];
        foreach ($data_permission_checks as $key => $value) {
           array_push($data_permission_check,$value['permisions_id']);
        }
        $data_main_menu = MainMenu::orderBy('id', 'asc')->get();
        $data_position = Position::select('position_name','position_id')->where('position_id','=',$position_id)->get();
        
        return  view('menu.setting.position.edit',compact(['data_permision',
                                                'data_main_menu',
                                                'data_position',
                                                'data_permission_check']))   ;

    }

    public function index()
    {
        return  view('menu.setting.position.index')   ;
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
        
        // dd($request->all());
        $validatedData = $this->validate( $request,[
            'position_name'=>'required|unique:position',
        ],
        [   
            'position_name.required'    => 'กรุณากรอก ชื่อตำแหน่ง',
            'position_name.unique'    => 'ชื่อตำแหน่ง ซ้ำ',
        ]
        );

        
        $position = Position::create([
            'position_name'=>$request->input('position_name'),
            ]);
      
        $permission_id =  $request->input('permission_id');
        if(isset($permission_id)){
            foreach ($permission_id as $key => $value) {
                $permission_check = PermissionCheck::create([
                    'position_id' => $position->id,
                    'permisions_id' => $value,
                ]);
                    
            }
        }
        return  $validatedData;
        
        
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $position_name = $request->input('position_name');
        $position_id = $request->input('position_id');
        $permission_id = $request->input('permission_id');

      

    

        $validatedData = $this->validate( $request,[
            'position_name'=>'required',
            // 'position_name'=>'required|unique:position',
        ],
        [   
            'position_name.required'    => 'กรุณากรอก ชื่อตำแหน่ง',
            // 'position_name.unique'    => 'ชื่อตำแหน่ง ซ้ำ',
        ]
        );


        $position = Position::where('position_id', $position_id )
        ->update(['position_name' => $position_name]);


        $permission_checks_del = PermissionCheck::where('position_id',$position_id)
        ->delete();
        if(isset($permission_id)){
        foreach ($permission_id as $key => $value) {
            $permission_check = PermissionCheck::create([
                'position_id' => $position_id,
                'permisions_id' => $value,
             ]);
        }
        }
        
        return  $validatedData;
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($position_id)
    {
                // $permission_check=PermissionCheck::where('position_id','=',$position_id)->delete();
                $position=Position::where('position_id','=',$position_id)->delete();
                return json_encode($position);
    }
}
