<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\MainMenu;
use App\Form;
use App\FormLinkProject;
use App\FormInstallments;
use App\FormSubInstallments;
use App\FormCutOver;
use App\FormSubCutOver;
use App\FormCutOff;
use App\FormSubCutOff;


class FormController extends Controller
{
    public function table_list(Request $reqeust)
    {
        //

 
        $offset = $reqeust->input('offset');
        $limit = $reqeust->input('limit');
          $forms_name = $reqeust->input('forms_name');

  
        
          $data_projects = Form:: where('forms_name','like','%'.$forms_name.'%') ;
        $total = $data_projects->get()->count();
        $total_not_filtered = Form::all()->count();
        $data_projects_query = $data_projects
        ->offset($offset)
        ->limit($limit)
        ->orderBy('forms_id','desc')
        ->get();
       
       
        $rows = [];
        foreach ($data_projects_query as $key => $value) {
            $forms_id = $value['forms_id'];
            $forms_status = $value['forms_status'];
            $icon_edit = asset('/img/icon_edit.svg');
            $icon_remove = asset('/img/icon_remove.svg');
            $icon_projects_acitve = asset('/img/icon_active.svg');
            $icon_projects_inactive = asset('/img/icon_inactive.svg');

            $btn_edit = "<div role='button' class='d-flex align-safe-center' id='edit_forms'
                        data-forms-id='$forms_id'
                        style='column-gap:12px;text-decoration: underline;color:#003927'
                        >
                        <img src='$icon_edit' />
                        <span   style='padding-top:5px'>แก้ไข</span>
                        </div>";
            $btn_remove ="<div role='button' class='d-flex align-safe-center'  id='remove_forms'
                        data-forms-id='$forms_id'
                        style='column-gap:12px;text-decoration: underline;color:#003927'
                        >
                        <img src='$icon_remove' />
                        <span style='padding-top:5px'>ลบโครงการ</span>
                        </div>";

            $forms_status_name = "Active";
            $forms_status_icon = $icon_projects_acitve;
            if($forms_status === 1){
            $forms_status_name = "Inactive";
            $forms_status_icon = $icon_projects_inactive;
            }

            $layout_projectstatus = "<div class='d-flex'>
                                        <img src='$forms_status_icon' />
                                        <span>$forms_status_name</span>
                                </div>";
            $col['forms_name'] = $value['forms_name'] ;
            $col['forms_status'] = $layout_projectstatus;

            $col['forms_tool'] = "<div class='d-flex flex-row'
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
    public function index()
    {
        //
     return   view('menu.setting.form.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = Project::all();
        $main_menu = MainMenu::where('id',2)
                                ->orWhere('id',3)
                                ->orWhere('id',4)->get()
                                ;
       
        return   view('menu.setting.form.create',compact('project','main_menu'));

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
            'menu_id'=>'required',
            'forms_name'=>'required|unique:forms',
        ],
        [   
            'menu_id.required'    => 'กรุณาเลือก ประเภทแบบฟอร์ม',
            'forms_name.required'    => 'กรุณากรอก ชื่อแบบฟอร์ม',
            'forms_name.unique'    => 'ชื่อแบบฟอร์มซ้ำ',

        ]
        );

        $forms_status = $request->input('forms_status');
        if($forms_status != '0'){
            $forms_status = '1';
        }

        $froms = Form::create([
            'menu_id'=>$request->input('menu_id'),
            'forms_name'=>$request->input('forms_name'),
            'forms_status'=> $forms_status,
            ]);
        $forms_id = $froms->id ;

        foreach ($request->input('project_id') as $key => $value) {
            $forms_link_projects = FormLinkProject::create([
                'projects_id'=>$value,
                'forms_id'=>$forms_id,
                ]);
        }


        $menu_id = $request->input('menu_id') ;
        if($menu_id == 2){
            for ($i=0; $i < $request->input('forms_page_no'); $i++) { 
                $forms_installments_no = $i+1;
                $froms_installments = FormInstallments::create([
                    'forms_id'=>$forms_id,
                    'forms_installments_no'=> $forms_installments_no,
                    ]);

                foreach ($request->input('project_detail') as $key => $value) {
                    if ($value['forms_page_no'] == $forms_installments_no) {
                        $forms_sub_installments_no = $key+1;
                        $forms_sub_installments_detail =$value['forms_detail'];
                        $forms_sub_installments_percent = $value['forms_percent'];
                        $forms_sub_installments_operation_cost =$value['forms_operation_cost'];
                        $froms_sub_installments = FormSubInstallments::create([
                            'forms_sub_installments_no'=>$forms_sub_installments_no,
                            'forms_sub_installments_detail'=> $forms_sub_installments_detail,
                            'forms_sub_installments_percent'=> $forms_sub_installments_percent,
                            'forms_sub_installments_operation_cost'=> $forms_sub_installments_operation_cost,
                            'forms_installments_id'=> $froms_installments->id,
                            ]);
                    }
                  
                }
            }
           
          
           
        }elseif ($menu_id == 3) {
            $date_affter_check = $request->input('date_affter_check') ;
            for ($i=0; $i < $request->input('forms_page_no'); $i++) { 
                $forms_cut_overs_no = $i+1;
                $forms_cut_amount_date_after_check		 = $date_affter_check[$i];
                $forms_cut_overs = FormCutOver::create([
                    'forms_id'=>$forms_id,
                    'forms_cut_overs_no'=> $forms_cut_overs_no,
                    'forms_cut_amount_date_after_check'=> $forms_cut_amount_date_after_check,
                    ]);

                foreach ($request->input('project_detail') as $key => $value) {
                    if ($value['forms_page_no'] == $forms_cut_overs_no) {
                        $forms_sub_cut_overs_no = $key+1;
                        $forms_sub_cut_overs_detail =$value['forms_detail'];
                        $froms_sub_cut_over = FormSubCutOver::create([
                            'forms_sub_cut_overs_no'=>$forms_sub_cut_overs_no,
                            'forms_sub_cut_overs_detail'=> $forms_sub_cut_overs_detail,
                            'forms_cut_overs_id'=>$forms_cut_overs->id
                            ]);
                    }
                
                }
            }
        }elseif ($menu_id == 4){
            $forms_cut_offs_detail = $request->input('forms_cut_offs_detail') ;
            for ($i=0; $i < count($forms_cut_offs_detail)  ; $i++) { 
                $forms_cut_offs_no = $i+1;
                $forms_cut_offs = FormCutOff::create([
                    'forms_id'=>$forms_id,
                    'forms_cut_offs_detail'=> $forms_cut_offs_no,
                    ]);
    
                foreach ($request->input('project_detail') as $key => $value) {
                    if ($value['forms_page_no'] == $forms_cut_offs_no) {
                        $form_sub_cut_offs_no = $key+1;
                        $form_sub_cut_offs_detail =$value['forms_detail'];
                        $forms_sub_cut_off = FormSubCutOff::create([
                            'form_sub_cut_offs_no'=>$form_sub_cut_offs_no,
                            'form_sub_cut_offs_detail'=> $form_sub_cut_offs_detail,
                            'forms_cut_offs_id'=>$forms_cut_offs->id
                            ]);
                    }
                
                }
            }
    
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project=Form::where('forms_id','=',$id)->delete();
        return json_encode($project);
    }
}
