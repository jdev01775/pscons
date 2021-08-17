

@php
header('Content-Type: image/jpeg')
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   
</head>
<body>
   <div style="width: 100%;background: #F8F8F8;">
       <div style="border-radius: 12px 12px 0 0;
       padding: .5rem 1rem;
       font-family: 'Prompt-Bold','Nunito', sans-serif;
       color: #003927 ;
       display: flex;
       justify-content: space-between;
       align-items: flex-end;
       font-size: 18px;">
        <span style="margin-right:auto ">รหัสผ่านของคุณคือ</span>
        <img src="{{ asset('img/icon_main0.jpeg') }}"  width="120" style="margin-left:auto "  />

       </div>
       <div style="margin: 0rem 1rem 1rem 1rem;
       font-size: 14px;
       color: #636b6f;">
           <div style="background: #fff;
           border-radius: 8px;
           padding: 1rem;">
                    <div>
                        <span>Username :</span>
                        <span>{{$user[0]['email']}}</span>
                    </div>
                    <div>
                        <span>Password : </span>
                        <span>{{$password}}<</span>
                   </div>
           </div>


           <div style="display: flex; width: 100%; justify-content: center;">
            <a type="button" 
            style=" font-family: 'Prompt-Bold','Nunito', sans-serif;
            background: #4D7568;
            border-radius: 100px;
            align-items: center;
            display: flex;
            justify-content: center;
            color: #fff !important;
            padding: .50rem 1.5rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
            margin-left:auto;
            margin-right:auto;

            text-decoration:none;"
            href="{{url('/login')}}">
                ไปที่หน้าหลัก
                </a>
           </div>
         
       </div>
      
   </div>
       
  
</body>
</html>
