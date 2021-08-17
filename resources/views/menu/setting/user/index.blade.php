 
 @extends('menu.setting.index')
 @section('setting_content')

 <link href="{{ asset('/vendor/bootstrap_table/bootstrap-table.min.css') }}" rel="stylesheet">
 <script src="{{ asset('/vendor/bootstrap_table/tableExport.min.js') }}"></script>
 <script src="{{ asset('/vendor/bootstrap_table//bootstrap-table.min.js') }}"></script>
 <script src="{{ asset('/vendor/bootstrap_table/bootstrap-table-locale-all.min.js') }}"></script>
 <script src="{{ asset('/vendor/bootstrap_table/bootstrap-table-export.min.js') }}"></script>
<div class="w-100 d-flex flex-column container-user">
    <div class="w-100">
        <div class="filter-section">
            <div class="filter-ip-group">
                <img role="button" src="{{ asset('/img/icon_search.svg') }}" alt="" srcset="">
                <input type="text"  class="form-control ip-filter" name="" id="" 
                aria-describedby="helpId" placeholder="ระบุชื่อพนักงาน">
            </div>
            <div>
                <button type="button" class="btn btn-filter">ค้นหา</button>
            </div>
            <div class="">
            <select class="form-control select-filter" name="" id="" title="เลืิอกตำแหน่ง">
                <option>ตำแหน่งทัั้งหมด</option>
                <option></option>
                <option></option>
            </select>
            </div>
            <div class="ml-auto filter-btn-group">
                <a role="button" class="btn btn-filter btn-filter-add-user"
                href="{{url('setting/setting_user/create')}}">
                    <div class="icon-btn-filter">
                        <img role="button" src="{{ asset('/img/icon_plus_cycle.svg') }}" alt="" srcset="">
                    </div>
                 <span>เพิ่มผู้ใช้งาน</span>   
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

$(document).on('click',`[id="edit_users"]`,function (e) { 
  e.preventDefault();
  let usersId = $(this).data(`usersId`)
  window.location.href = `{{url('setting/setting_user/${usersId}/edit/')}}`
});

$(document).on('click',`[id="remove_users"]`,function (e) { 
  
    e.preventDefault();
    let usersId = $(this).data(`usersId`)
    console.log("🚀 ~ file: index.blade.php ~ line 93 ~ usersId", usersId)
    
   
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
          url: `{{url('setting/setting_user/${usersId}')}}`,
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
  

  function initTable() {
   
    $('#table_data').bootstrapTable('destroy').bootstrapTable({
       border:0,
     locale: 'th-TH',
     url:`{{url('/setting/setting_table_user')}}`,
     queryParams:function(params){
      let positionName = $(`#position_name`).val()
       params.position_name = positionName
       return  params
     },
     columns: [
       [{
         field: 'username',
         title: 'ชื่อ - นามสกุล',
         sortable: false,
         align: 'left'
       }, {
         field: 'position_name',
         title: 'ตำแหน่ง',
         sortable: false,
         align: 'center',
       }, {
         field: 'user_status',
         title: 'สถานะ',
         sortable: false,
         align: 'left',
       }, {
         field: 'user_tool',
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
 