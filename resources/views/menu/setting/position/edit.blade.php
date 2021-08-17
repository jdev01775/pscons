@extends('menu.menu_sub.index')
@section('content_sub') 
<link rel="stylesheet" href="{{asset('css/setting/style.css')}}">
<link rel="stylesheet" href="{{ asset('/css/setting/position/style.css') }}">
<div class="setting-header">
    <span class="setting-title text-bold">เพิ่มตำแหน่งงาน</span>
</div>


   <div class="container-setting setting-create-container">
    <div class="settiing-postion-name-layout">
        <span class="text-bold">ชื่อตำแหน่ง</span>
       <input type="text" class="form-control position-name" name="position_name" value="{{$data_position[0]['position_name']}}" />
    </div>
    <div class="setting-create-permision">
        <span class="text-bold">สิทธิ์ในการเข้าถึง</span>
        @foreach ($data_main_menu as $item)
        <div class="setting-permision-container">
            <label class="container-checkbox"> 
                <span>
                {{$item->main_menu_name}}
                </span> 
                <input type="checkbox" id="check_main_menu" >
                <span class="checkmark"></span>
              </label>
              
           

            @foreach ($data_permision as $item2)
            @if ($item2->main_menu_id === $item->id)
             
            <div class="setting-permision-list">
                <label class="container-checkbox"> 
                    <span>
                        {{$item2->permission_name}}
                    </span> 
                    <input type="checkbox" name="permission_id"  value="{{$item2->id}}" 
                    @if (in_array($item2->id, $data_permission_check)) checked @endif >
                    <span class="checkmark"></span>
                  </label>
            </div>
            @endif
            @endforeach

        </div>
        
        @endforeach
    </div>
   

   </div>  
   <div class="setting-create-footer">
    <a role="button" class="btn btn-accept"
           {{-- href="{{url('setting?page=position_create')}}" --}}
           onclick="save_data()"
           >
               <div class="icon-btn-accept">
                   <img role="button" src="{{ asset('/img/icon_plus_cycle.svg') }}" alt="" srcset="">
               </div>
            <span>บันทึก</span>   
    </a>

    <a role="button" class="btn btn-cancel"
    href="{{url('setting/setting_position')}}"
    >
        <div class="icon-btn-cancel">
            <img role="button" src="{{ asset('/img/icon_cancel_cycle.svg') }}" alt="" srcset="">
        </div>
     <span>ยกเลิก</span>   
    </a>

   
</div>


<script>
    $(function(){
    $(`.setting-permision-container`).map(function(){
        let permissionId = $(this).find(`[name=permission_id]`).length
        let permissionIdChecked = $(this).find(`[name=permission_id]:checked`).length
        if(permissionId === permissionIdChecked){
            $(this).find(`#check_main_menu`).prop(`checked`,true)
        }
        if(permissionIdChecked === 0){
            $(this).find(`.setting-permision-list`).addClass(`d-none`)
        }
    })
})

$(`[name="permission_id"]`).click(function(){
    let countAllPermisionId =    $(this).closest(`.setting-permision-container`)
           .find(`[name="permission_id"]`).length
    let countPermisionIdChecked =    $(this).closest(`.setting-permision-container`)
           .find(`[name="permission_id"]:checked`).length
    let mainMenuChecked = false
     if(countPermisionIdChecked === countAllPermisionId){
        mainMenuChecked = true
     }
     $(this).closest(`.setting-permision-container`).find(`#check_main_menu`).prop(`checked`,mainMenuChecked)
    console.log({countAllPermisionId,countPermisionIdChecked})
})



$(`[id="check_main_menu"]`).click(function(){  
    let isChecked = $(this).prop(`checked`)
    if(isChecked){
    $(this).closest(`.setting-permision-container`)
            .find(`.setting-permision-list`)
            .removeClass(`d-none`)
    }else{
    $(this).closest(`.setting-permision-container`)
            .find(`.setting-permision-list`)
            .addClass(`d-none`)
    }
    $(this).closest(`.setting-permision-container`)
           .find(`[name="permission_id"]`)
           .prop(`checked`,isChecked)
})

 
    const save_data =()=>{
        let position_name = $(`[name=position_name]`).val()
        let permission_id = $(`[name=permission_id]:checked`).map(function(){return $(this).val()}).get()
        console.log("🚀 ~ file: create.blade.php ~ line 81 ~ permission_id", permission_id)
     
       
        Swal.fire({
            imageUrl: `{{ asset('/img/icon_alert_question.svg') }}`,
            html:`<span>คุณต้องการเพิ่มตำแหน่งงาน ?</span>`,
            showDenyButton: true,
            allowOutsideClick: false,
            confirmButtonText,
            denyButtonText,
            showCloseButton: true,
        }).then((res)=>{
            if(res.isConfirmed){
                $.ajax({
                    type: "PATCH",
                    url: `{{url('setting/setting_position/{setting_position}')}}`,
                    data: {
                        position_name ,
                        permission_id,
                        position_id: `{{$data_position[0]['position_id']}}`,
                    },
                    headers: {
                            'X-CSRF-TOKEN': `{{ csrf_token() }}`
                        },
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                        imageUrl: `{{ asset('/img/icon_alert_success.svg') }}`,
                        html:`<span>คุณได้ทำการแก้ไขตำแหน่งงานเรียบร้อยแล้ว</span>`,
                        showDenyButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: `ตกลง`,
                        denyButtonText: `ยกเลิก`,
                        }).then(function(res){
                            if(res.isConfirmed){
                                window.location.href = `{{url('setting/setting_position')}}`
                            }
                        })
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
       
    }
</script>
 @endsection
