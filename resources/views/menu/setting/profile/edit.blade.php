 
 @extends('menu.setting.index')
 @section('setting_content')
 <div class="w-100 d-flex">
    <div class="profile-1 d-flex flex-column align-items-center h-100  profile-edit-img ">
        <div class="profile-img-section d-flex justify-content-end ">
            <div class="profile-img">
                <img class="img-profile" src="{{ asset($users_link_img[0]['users_link_img_path']) }}" alt="" srcset="">
            </div>
            <div class="icon-upload-img-profile" role="button">
                <img class="img-camera upload-button" src="{{ asset('/img/icon_camera.svg') }}" alt="" srcset="">
                <input class="file-upload d-none" type="file" id="user_img" accept="image/*"/>
            </div>
        </div>
       
       
       
        <div class="profile-edit">
            <button type="button" class="btn btn-edit-profile" disabled>
                แก้ไขข้อมูล
            </button>
        </div>
        <div class="profile-change-password">
            <button type="button" class="btn btn-change-password">
                เปลี่ยนรหัสผ่าน
            </button>
        </div>
    </div>
    <div class="profile-2">
        <div class="profile-detail-1 ">
            <div class="d-flex w-100 profie-name-layout">
                <div class="w-50">
                    <span class="text-bold">ชื่อ : </span>
                    <span>
                        <input class="form-control form-control-custom" type="text" placeholder="โปรดระบุ" name="user_firstname" value="{{Auth::user()->user_firstname}}">
                       
                    </span>
                </div>
                <div class="w-50">
                    <span class="text-bold">นามสกุล : </span>
                    <span>
                        <input class="form-control form-control-custom" type="text" placeholder="โปรดระบุ" name="user_lastname" value="{{Auth::user()->user_lastname}}">
                    </span>
                </div>
            </div>
            <div class="d-flex w-100">
                <div class="w-100">
                    <span class="text-bold">Email : </span>
                    <span>
                        <input class="form-control form-control-custom" type="text" placeholder="โปรดระบุ" name="email" value="{{Auth::user()->email}}">
                </div>
            </div>
            <div class="d-flex flex-column w-100 settting-profile-project ">
                <div class="w-100 ">
                    <span class="text-bold">ตำแหน่ง : </span>
                    <span>{{$position[0]['position_name']}}</span>
                </div>
                <div class="w-100 d-flex detail-project">
                    <span class="text-bold">โครงการ : </span>
                    <div class="d-flex flex-column">
                        @foreach ($project_link_users as $key => $item)
                             <span>{{($key+1).' '.$item['projects_name']}}</span>
                        @endforeach
                     
                    </div>
                </div>
            </div>
        </div>
        

        <div class="setting-create-footer mb-3">
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
            href="{{url('setting')}}"
            >
                <div class="icon-btn-cancel">
                    <img role="button" src="{{ asset('/img/icon_cancel_cycle.svg') }}" alt="" srcset="">
                </div>
             <span>ยกเลิก</span>   
            </a>
        </div>
    </div>

    </div>

   
 
<script  >

function validateEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}


    $(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.img-profile').attr('src', e.target.result);
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
</script>

<script>
    const save_data = ()=>{
        let user_firstname = $(`[name=user_firstname]`).val() 
        let user_lastname = $(`[name=user_lastname]`).val() 
        let user_img =  document.getElementById('user_img').files[0]
        let email = $(`[name=email]`).val() 

            let data = new FormData();         
            data.append('user_firstname', user_firstname);
            data.append('user_lastname', user_lastname);
            data.append('user_img',user_img);
            data.append('email',email);
            data.append('user_id',`{{Auth::user()->id}}`);
        Swal.fire({
            imageUrl: `{{ asset('/img/icon_alert_question.svg') }}`,
            html:`<span>คุณต้องการแก้ไขข้อมูลส่วนตัว ?</span>`,
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
                    url: `{{url('setting/setting_profile_update')}}`,
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
                        html:`<span>คุณได้ทำการแก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว</span>`,
                        showDenyButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: `ตกลง`,
                        denyButtonText: `ยกเลิก`,
                        }).then(function(res){
                            if(res.isConfirmed){
                                window.location.href = `{{url('setting')}}`
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
