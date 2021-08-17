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
               <input type="text"  class="form-control ip-filter" name="forms_name" id="forms_name" 
               aria-describedby="helpId" placeholder="ชื่อแบบฟอร์ม">
           </div>
           <div>
               <button type="button" class="btn btn-filter">ค้นหา</button>
           </div>
           <div class="ml-auto filter-btn-group">
               <a role="button" class="btn btn-filter btn-filter-add-user"
               href="{{url('setting/setting_form/create')}}"
               >
                   <div class="icon-btn-filter">
                       <img role="button" src="{{ asset('/img/icon_plus_cycle.svg') }}" alt="" srcset="">
                   </div>
                <span>เพิ่มแบบฟอร์ม</span>   
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


$(document).on('click',`[id="edit_forms"]`,function (e) { 
  e.preventDefault();
  let formsId = $(this).data(`formsId`)
  window.location.href = `{{url('  setting/setting_form/${formsId}/edit')}}`

});

 

$(document).on('click',`[id="remove_forms"]`,function (e) { 
    e.preventDefault();
    let formsId = $(this).data(`formsId`)
    
   
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
          url: `{{url('setting/setting_form/${formsId}')}}`,
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
                                    // window.location.href = `{{url('setting/setting_forms')}}`
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

$(`#forms_name`).on(`keyup`,function(){
  initTable()
   $('#locale').change(initTable)
})

 function initTable() {
   
  $('#table_data').bootstrapTable('destroy').bootstrapTable({
       border:0,
     locale: 'th-TH',
     url:`{{url('/setting/setting_form_table_list')}}`,
     queryParams:function(params){
      let forms_name = $(`#forms_name`).val()
       params.forms_name = forms_name
       return  params
     },
     columns: [
       [{
         field: 'forms_name',
         title: 'แบบฟอร์ม',
         sortable: false,
         align: 'left'
       },{
         field: 'forms_status',
         title: 'สถานะ',
         sortable: false,
         align: 'left'
       }, {
         field: 'forms_tool',
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


