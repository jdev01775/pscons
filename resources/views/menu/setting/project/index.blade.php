@extends('menu.setting.index')
@section('setting_content')

<link href="{{ asset('/vendor/bootstrap_table/bootstrap-table.min.css') }}" rel="stylesheet">
<script src="{{ asset('/vendor/bootstrap_table/tableExport.min.js') }}"></script>
<script src="{{ asset('/vendor/bootstrap_table//bootstrap-table.min.js') }}"></script>
<script src="{{ asset('/vendor/bootstrap_table/bootstrap-table-locale-all.min.js') }}"></script>
<script src="{{ asset('/vendor/bootstrap_table/bootstrap-table-export.min.js') }}"></script>

<style>
   
</style>
<div class="w-100 d-flex flex-column container-user">
   <div class="w-100">
       <div class="filter-section">
           <div class="filter-ip-group">
               <img class="icon-filter" role="button" src="{{ asset('/img/icon_search.svg') }}" alt="" srcset="">
               <input type="text"  class="form-control ip-filter" name="project_name" id="project_name" 
               aria-describedby="helpId" placeholder="ระบุชื่อโครงการ">
           </div>
           <div>
               <button type="button" class="btn btn-filter">ค้นหา</button>
           </div>
           <div class="ml-auto filter-btn-group">
               <a role="button" class="btn btn-filter btn-filter-add-user"
               href="{{url('setting/setting_project_create')}}"
               >
                   <div class="icon-btn-filter">
                       <img role="button" src="{{ asset('/img/icon_plus_cycle.svg') }}" alt="" srcset="">
                   </div>
                <span>เพิ่มโครงการ</span>   
                  </a>
           </div>
   </div>
   <div class="w-100 table-section">
       <table
        class="table table-bordered table-haeder-bold"
         id="table_data"
         data-pagination="true"
         data-id-field="id"
         data-page-list="[10, 25, 50, 100,all]"
         data-side-pagination="server"
         >
       </table>
   

 
<script>


$(document).on('click',`[id="edit_position"]`,function (e) { 
  e.preventDefault();
  let projectsId = $(this).data(`projectsId`)
  window.location.href = `{{url('setting/setting_project_edit?project_id=${projectsId}')}}`
});

 

$(document).on('click',`[id="remove_position"]`,function (e) { 
    e.preventDefault();
    let projectsId = $(this).data(`projectsId`)
    console.log("🚀 ~ file: index.blade.php ~ line 93 ~ projectsId", projectsId)
    
   
    Swal.fire({
    imageUrl: `{{ asset('/img/icon_alert_delete.svg') }}`,
    html:`<span>คุณต้องการลบรายการนี้ ?</span>`,  
    showDenyButton: true,
    allowOutsideClick: false,
    confirmButtonText,
    denyButtonText,
    showCloseButton: true,

      }).then((res)=>{
      if(res.isConfirmed){
        $.ajax({
          type: "DELETE",
          url: `{{url('setting/setting_project/${projectsId}')}}`,
          data: {
            _token: "{{ csrf_token() }}",
          },
          dataType: "json",
          success: function (response) {
          console.log("🚀 ~ file: index.blade.php ~ line 112 ~ response", response)
            if(response === 1){
              Swal.fire({
                            imageUrl: `{{ asset('/img/icon_alert_success.svg') }}`,
                            html:`<span>คุณได้ทำการลบเรียบร้อยแล้ว</span>`,
                            showDenyButton: false,
                            allowOutsideClick: false,
                            confirmButtonText: `ตกลง`,
                            denyButtonText: `ยกเลิก`,
                            }).then(function(res){
                                if(res.isConfirmed){
                                  initTable()
                                 $('#locale').change(initTable)
                                    // window.location.href = `{{url('setting/setting_position')}}`
                                }
              })
            }
          },
          error:function(error){
                        let res = JSON.parse(error.responseText)
                        let errorMsg = Object.values(res.errors)
                        
                        Swal.fire({
                        imageUrl: `{{ asset('/img/icon_alert_warning.svg') }}`,
                        html:errorMsg[0] ??= res,
                        showDenyButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: `ตกลง`,
                        denyButtonText: `ยกเลิก`,
                        }) 
          }
        });
      }
      
    })
});

$(`.btn-filter , .icon-filter `).on(`click`,function(){
  initTable()
   $('#locale').change(initTable)
})

$(`#project_name`).on(`keyup`,function(){
  initTable()
   $('#locale').change(initTable)
})

 function initTable() {
   
  $('#table_data').bootstrapTable('destroy').bootstrapTable({
       border:0,
     locale: 'th-TH',
     url:`{{url('/setting/setting_table_projects')}}`,
     queryParams:function(params){
      let projectName = $(`#project_name`).val()
       params.projects_name = projectName
       return  params
     },
     columns: [
       [{
         field: 'projects_name',
         title: 'โครงการ',
         sortable: false,
         align: 'left'
       },{
         field: 'projects_status',
         title: 'สถานะ',
         sortable: false,
         align: 'left'
       }, {
         field: 'projects_tool',
         title: '',
         sortable: false,
         align: 'center',
       }]
     ]
   })
 }

 $(function() {
   initTable()
   $('#locale').change(initTable)
 })

</script>
   </div>
</div>

@endsection


