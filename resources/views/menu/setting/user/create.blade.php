@extends('menu.menu_sub.index')
@section('content_sub') 
 
 
<link rel="stylesheet" href="{{asset('css/setting/style.css')}}">
<link rel="stylesheet" href="{{asset('css/setting/user/style.css')}}">
<div class="setting-header">
    <span class="setting-title text-bold">เพิ่มผู้ใช้งาน</span>
</div>


<div class="container-user-create">
     <div class="user-profile-img-contrainer">
         <div class="profile-img">
            <div class="circle">
                <img class="profile-pic" src="{{ asset('img/profile_img.svg') }}">
              </div>
              <div class="p-image" role="button">
                <img class="img-camera upload-button" src="{{asset('img/icon_camera.svg')}}" alt="" srcset="">
                <input class="file-upload" type="file" id="user_img" accept="image/*"/>
            </div>
         </div>

         <div class="profile-delete">
            <button disabled type="button" class="btn btn-profile-delete">
                ลบข้อมูล
            </button>
        </div>
     </div>
     <div class="user-profile-detail-contrainer">
            <div class="row-detail">
                <div class="w-50 mt-1">
                    <span class="text-bold">ชื่อ</span>
                    <input class="form-control form-control-custom" type="text" placeholder="โปรดระบุ" name="user_firstname">
                </div>
                <div class="w-50 mt-1">
                   <span class="text-bold">นามสกุล</span>
                   <input class="form-control form-control-custom" type="text" placeholder="โปรดระบุ" name="user_lastname">
               </div>
            </div>  
            <div class="row-detail">
                <div class="w-50 mt-1">
                    <span class="text-bold">Email (ใช้สำหรับการเข้าสู่งระบบ และ การแจ้งเตือนต่างๆ)</span>
                    <input class="form-control form-control-custom" type="text" placeholder="โปรดระบุ" name="email"> 
                </div>
                <div class="w-50 mt-1">
                    <span class="text-bold">ตำแหน่ง</span>
                    <select class="form-control form-control-custom " title="โปรดระบุ" name="position_id">
                        <option value="">โปรดระบุ</option>

                        @foreach ($data_position as $item)
                            <option value="{{$item['position_id']}}">{{$item['position_name']}}</option>
                        @endforeach
                    </select>
                </div>
             </div>  
             <div class="row-detail-2">
                <span class="text-bold">โครงการ</span>
                <label class="container-checkbox pl-25px"> 
                    <input type="checkbox" id="permission_all"  value="" >
                    <span class="checkmark"></span>
                  </label>
                <span class="">ทุกโครงการ</span>
                
             </div>  

             <div class="project-list-container">
                 @foreach ($data_projects as $item)
                 <div class="project-checkbox-layout">
                    <label class="container-checkbox pl-25px"> 
                        <input type="checkbox" id="permission_id_{{$item['projects_id']}}" name="permission_id[]"   value="{{$item['projects_id']}}"  >
                        <span class="checkmark"></span>
                      </label>

                    <span>{{$item['projects_name']}}</span>
               </div>
                 @endforeach
               
             </div>  

             <div class="users-status">
                 <span class="text-bold">สถานะผู้ใช้งาน</span>
                <div class="custom-control custom-control-add custom-switch ">
                    <input type="checkbox" class="custom-control-input" id="user_status" name="user_status" value="0">
                    <label class="custom-control-label" for="user_status">Inctive (ปิดใช้งาน)</label>
                  </div>
             </div>
        
             
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
    href="{{url('setting/setting_user')}}"
    >
        <div class="icon-btn-cancel">
            <img role="button" src="{{ asset('/img/icon_cancel_cycle.svg') }}" alt="" srcset="">
        </div>
     <span>ยกเลิก</span>   
    </a>
    </div>

<script>


$(`#user_status`).click(function(){

  

let userStatus = $(this).prop(`checked`)
let userStatusText = `Inactive (ปิดใช้งาน)` 
let userStatusColor = `` 
if(userStatus){
userStatusText = `Active (เปิดใช้งาน)`
userStatusColor = `#81D135`
}

$(`[for=user_status]`).html(userStatusText)
$(`[for=user_status]`).css(`color`,userStatusColor)
})

$(`[id^=permission_id]`).click(function(){
    let countPermissionAll = $(`[id^=permission_id]`).length
    let countPermissionCheck = $(`[id^=permission_id]:checked`).length
    let AllChecked = true 
    if(countPermissionAll !==  countPermissionCheck){
         AllChecked = false
    }
    $(`[id=permission_all]`).prop(`checked`,AllChecked)
})


$(`[id=permission_all]`).click(function(){
    let thisChecked = $(this).prop(`checked`)
    $(`[name^=permission_id]`).prop(`checked`,thisChecked)
})



</script>
<script>
 
 $(document).ready(function() {
var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(".file-upload").on('change', function(){
    readURL(this);
});

$(".upload-button").on('click', function() {
   $(".file-upload").click();
});
});

 
 

function validateEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}






const save_data = ()=>{
        let user_firstname = $(`[name=user_firstname]`).val() 
        let user_lastname = $(`[name=user_lastname]`).val() 
        let user_status = $(`[name=user_status]:checked`).val()
        let user_img =  document.getElementById('user_img').files[0]
        let position_id = $(`[name=position_id] option:selected`).val()
        let email = $(`[name=email]`).val() 

        
        console.log("🚀 ~ file: create.blade.php ~ line 162 ~ user_img", user_img)

        let project_link_users = $(`[name^=permission_id]:checked`).map(function(){
                                let obj ={
                                    'project_id':$(this).val(),
                                }
                                return obj
                              }).get()


            let data = new FormData();         
            data.append('user_firstname', user_firstname);
            data.append('user_lastname', user_lastname);
            data.append('user_status', user_status);
            data.append('project_link_users',JSON.stringify(project_link_users));
            data.append('user_img',user_img);
            data.append('position_id',position_id);
            data.append('email',email);
            
        Swal.fire({
            imageUrl: `{{ asset('/img/icon_alert_question.svg') }}`,
            html:`<span>คุณต้องการเพิ่มผู้ใช้งาน ?</span>`,
            showDenyButton: true,
            allowOutsideClick: false,
            confirmButtonText,
            denyButtonText,
            showCloseButton: true,
        }).then((res)=>{
            if(res.isConfirmed){
                Swal.showLoading()
                if(!validateEmail(email)){
                    Swal.fire({
                        imageUrl: `{{ asset('/img/icon_alert_warning.svg') }}`,
                        html:`กรุณาตรวจสอบรูปแบบ E-mail`,
                        showDenyButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: `ตกลง`,
                        denyButtonText: `ยกเลิก`,
                        }) 
                }
               
                $.ajax({
                    type: "POST",
                    url: `{{url('setting/setting_user')}}`,
                    data,
                    cache:false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    headers: {
                            'X-CSRF-TOKEN': `{{ csrf_token() }}`
                        },
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                        imageUrl: `{{ asset('/img/icon_alert_success.svg') }}`,
                        html:`<span>คุณได้ทำการเพิ่มผู้ใช้งานเรียบร้อยแล้ว</span>`,
                        showDenyButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: `ตกลง`,
                        denyButtonText: `ยกเลิก`,
                        }).then(function(res){
                            if(res.isConfirmed){
                                window.location.href = `{{url('setting/setting_user')}}`
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
