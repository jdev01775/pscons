 
 @extends('menu.setting.index')
 @section('setting_content')
 <div class="w-100 d-flex">
    <div class="profile-1 d-flex flex-column align-items-center h-100  justify-content-center">
        <div class="profile-img-section d-flex justify-content-end ">
            <div class="profile-img">
                <img class="img-profile" src="{{ asset($users_link_img[0]['users_link_img_path']) }}" alt="" srcset="">
            </div>
            <div class="icon-upload-img-profile" role="button">
                <img class="img-camera" src="{{ asset('/img/icon_camera.svg') }}" alt="" srcset="">
            </div>
        </div>
       
       
        <div class="profile-edit">
        <a type="button" class="btn btn-edit-profile"
        href="{{asset('setting/setting_profile/'.Auth::user()->id.'/edit')}}">
            แก้ไขข้อมูล
        </a>
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
                        {{Auth::user()->user_firstname}}
                    </span>
                </div>
                <div class="w-50">
                    <span class="text-bold">นามสกุล : </span>
                    <span>
                        {{Auth::user()->user_lastname}}
                    </span>
                </div>
            </div>
            <div class="d-flex w-100">
                <div class="w-100">
                    <span class="text-bold">Email : </span>
                    <span>
                        {{Auth::user()->email}}
                    </span>
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
        

    </div>
    </div>
 @endsection

 
