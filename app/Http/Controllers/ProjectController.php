<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectDetail;
use App\User;
use App\ProjectPlotImg;
class ProjectController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index_position_edit(Request $request)
    {
        $projects_id = $request->input('project_id');
       $data_projects = Project::select('*')->where('projects_id','=',$projects_id)->get();
       $data_projects_details = ProjectDetail::select('*')->where('projects_id','=',$projects_id)->get();
       $data_project_plot_imgs = ProjectPlotImg::select('*')->where('projects_id','=',$projects_id)->get();
        
        return  view('menu.setting.project.edit',compact(['data_projects',
                                                'data_projects_details',
                                                'data_project_plot_imgs']))   ;

    }


    public function table_projects(Request $reqeust)
    {
        //

 
        $offset = $reqeust->input('offset');
        $limit = $reqeust->input('limit');
          $projects_name = $reqeust->input('projects_name');

  
        
          $data_projects = Project:: where('projects_name','like','%'.$projects_name.'%') ;
        $total = $data_projects->get()->count();
        $total_not_filtered = Project::all()->count();
        $data_projects_query = $data_projects
        ->offset($offset)
        ->limit($limit)
        ->orderBy('projects_id','desc')
        ->get();
       
       
        $rows = [];
        foreach ($data_projects_query as $key => $value) {
            $projects_id = $value['projects_id'];
            $projects_status = $value['projects_status'];
            $icon_edit = asset('/img/icon_edit.svg');
            $icon_remove = asset('/img/icon_remove.svg');
            $icon_projects_acitve = asset('/img/icon_active.svg');
            $icon_projects_inactive = asset('/img/icon_inactive.svg');

            $btn_edit = "<div role='button' class='d-flex align-safe-center' id='edit_position'
                        data-projects-id='$projects_id'
                        style='column-gap:12px;text-decoration: underline;color:#003927'
                        >
                        <img src='$icon_edit' />
                        <span   style='padding-top:5px'>แก้ไข</span>
                        </div>";
            $btn_remove ="<div role='button' class='d-flex align-safe-center'  id='remove_position'
                        data-projects-id='$projects_id'
                        style='column-gap:12px;text-decoration: underline;color:#003927'
                        >
                        <img src='$icon_remove' />
                        <span style='padding-top:5px'>ลบโครงการ</span>
                        </div>";

            $projects_status_name = "Active";
            $projects_status_icon = $icon_projects_acitve;
            if($projects_status === 1){
            $projects_status_name = "Inactive";
            $projects_status_icon = $icon_projects_inactive;
            }

            $layout_projectstatus = "<div class='d-flex'>
                                        <img src='$projects_status_icon' />
                                        <span>$projects_status_name</span>
                                </div>";
            $col['projects_name'] = $value['projects_name'] ;
            $col['projects_status'] = $layout_projectstatus;

            $col['projects_tool'] = "<div class='d-flex flex-row'
                                    style='column-gap:35px'
                                    >
                                        $btn_edit
                                        $btn_remove
                                    </div>";
            array_push($rows, $col);
           
        }
        return  ['total'=>$total,'rows'=>  $rows,'totalNotFiltered'=>$total_not_filtered];
    }

    public function index()
    {

        return view('menu.setting.project.create');
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
        
        
       
        $validatedData = $this->validate( $request,[
            'projects_name'=>'required|unique:projects',
            'projects_budget'=>'required',
            'projects_detail.*.project_details_plot_from'=>'required',
            'projects_detail.*.project_details_plot_to'=>'required',
            'projects_detail.*.project_details_unit_amount'=>'required',
            'projects_detail.*.project_details_type_home'=>'required',
        ],
        [   
            'projects_name.required'    => 'กรุณากรอก ชื่อโครงการ',
            'projects_name.unique'      => 'ชื่อโครงการ ซ้ำ',
            'projects_budget.required' =>  'งบประมานโครงการ ชื่อโครงการ',
            'projects_detail.*.project_details_plot_from.required' =>  'กรุณากรอก รายละเอียดการแบ่งแปลง',
            'projects_detail.*.project_details_plot_to.required' =>  'กรุณากรอก รายละเอียดการแบ่งแปลง',
            'projects_detail.*.project_details_unit_amount.required' =>  'กรุณากรอก จำนวนยูนิต',
            'projects_detail.*.project_details_type_home.required' =>  'กรุณากรอก Type บ้าน',
        ]
        );
       
       
        $projects_status = $request->input('projects_status');
        if($projects_status != '0'){
            $projects_status = '1';
        }
        $project = Project::create([
            'projects_name'=>$request->input('projects_name'),
            'projects_budget'=>$request->input('projects_budget'),
            'projects_status'=>$projects_status,
            ]);

        // add detail for project
        $project_detail =  json_decode($request->input('projects_detail'),true);
        foreach ($project_detail as $key => $value) {
            $project_detail_store = ProjectDetail::create([
                'projects_id' => $project->id,
                'project_details_plot_from' => $value['project_details_plot_from'],
                'project_details_plot_to' => $value['project_details_plot_to'],
                'project_details_unit_amount' => $value['project_details_unit_amount'],
                'project_details_type_home' => $value['project_details_type_home'],
                ]);
        }
      
        // add image  && upload for project
        $get_key_request = array_keys( $request->all());
        foreach ($get_key_request as $key => $value) {
            if ($request->hasFile($value)) {

                $image = new ProjectPlotImg;
                $imagePath = $request->file($value);
                $imageName = $imagePath->getClientOriginalName();
                $path_dir = $request->file($value)->storeAs('uploads_project/'.$project->id, $imageName, 'public');
                $path_stroe = $imagePath->move('uploads_project/'.$project->id,$imageName);
               
                $image->project_plot_imgs_name = $imageName;
                $image->project_plot_imgs_name_new = 'new_'.$imageName;
                $image->project_plot_imgs_path = $path_dir ;
                $image->projects_id  =$project->id; 
                
                
                $image->save();
             
            }
        }


        return json_encode($validatedData);
        //
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
    public function update(Request $request)
    {

       
        $projects_id = $request->input('projects_id');
        $projects_check = Project::where('projects_id',$projects_id)->get();
        $projects_name_check = $projects_check[0]['projects_name'] ;
       
        $validatedData = $this->validate( $request,[
            'projects_name'=>'required',
            'projects_budget'=>'required',
            'projects_detail.*.project_details_plot_from'=>'required',
            'projects_detail.*.project_details_plot_to'=>'required',
            'projects_detail.*.project_details_unit_amount'=>'required',
            'projects_detail.*.project_details_type_home'=>'required',
        ],
        [   
            'projects_name.required'    => 'กรุณากรอก ชื่อโครงการ',
            'projects_budget.required' =>  'งบประมานโครงการ ชื่อโครงการ',
            'projects_detail.*.project_details_plot_from.required' =>  'กรุณากรอก รายละเอียดการแบ่งแปลง',
            'projects_detail.*.project_details_plot_to.required' =>  'กรุณากรอก รายละเอียดการแบ่งแปลง',
            'projects_detail.*.project_details_unit_amount.required' =>  'กรุณากรอก จำนวนยูนิต',
            'projects_detail.*.project_details_type_home.required' =>  'กรุณากรอก Type บ้าน',
        ]
        );

        if($projects_name_check != $request->input('projects_name')){
            $validatedData = $this->validate( $request,[
                'projects_name'=>'unique:projects',
            ],
            [   
                'projects_name.unique'      => 'ชื่อโครงการ ซ้ำ',
            ]
            );
        }
       

         
        $projects_status = $request->input('projects_status');
        if($projects_status != '0'){
            $projects_status = '1';
        }

        $project = Project::where('projects_id',$projects_id)->update([
            'projects_name'=>$request->input('projects_name'),
            'projects_budget'=>$request->input('projects_budget'),
            'projects_status'=>$projects_status,
            ]);
           



         // update detail for project
         ProjectDetail::where('projects_id',$projects_id)->delete();
         $project_detail =  json_decode($request->input('projects_detail'),true);
        foreach ($project_detail as $key => $value) {
            $project_detail_store = ProjectDetail::create([
                'projects_id' => $projects_id,
                'project_details_plot_from' => $value['project_details_plot_from'],
                'project_details_plot_to' => $value['project_details_plot_to'],
                'project_details_unit_amount' => $value['project_details_unit_amount'],
                'project_details_type_home' => $value['project_details_type_home'],
                ]);
        }


         // add image  && upload for project
        ProjectPlotImg::where('projects_id',$projects_id)->delete();
        $folderPath = public_path('uploads_project/'.$projects_id);
        $response = $this->rmdir_recursive($folderPath);

        $get_key_request = array_keys( $request->all());
        foreach ($get_key_request as $key => $value) {
            if ($request->hasFile($value)) {

                $image = new ProjectPlotImg;
                $imagePath = $request->file($value);
                $imageName = $imagePath->getClientOriginalName();
                $path_dir = $request->file($value)->storeAs('uploads_project/'.$projects_id, $imageName, 'public');
                $path_stroe = $imagePath->move('uploads_project/'.$projects_id,$imageName);
               
                $image->project_plot_imgs_name = $imageName;
                $image->project_plot_imgs_name_new = 'new_'.$imageName;
                $image->project_plot_imgs_path = $path_dir ;
                $image->projects_id  =$projects_id; 
                
                
                $image->save();
             
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

    public function rmdir_recursive($dir) {
        foreach(scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$dir/$file")) $this->rmdir_recursive("$dir/$file");
            else unlink("$dir/$file");
        }
        rmdir($dir);

        return true;
    }

    public function destroy($id)
    {
       
      
        $project=Project::where('projects_id','=',$id)->delete();

        $folderPath = public_path('uploads_project/'.$id);
        $response = $this->rmdir_recursive($folderPath);

        return json_encode($project);
    }
}
