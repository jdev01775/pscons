@extends('menu.menu_sub.index')
@section('content_sub') 
 
{{-- general --}}
<link rel="stylesheet" href="{{asset('css/setting/style.css')}}">
<link rel="stylesheet" href="{{ asset('/css/setting/form/style.css') }}">
{{-- {{$main_menu}} --}}

{{-- excel --}}
<script src="https://igniteui.com/js/modernizr.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script src="https://igniteui.com/js/external/FileSaver.js"></script>
<script src="https://igniteui.com/js/external/Blob.js"></script>
  

<div class="setting-header">
    <span class="setting-title text-bold">เพิ่มแบบฟอร์ม</span>
</div>

  

  
<div class="container-setting setting-create-container">
    <div class="contain-create form-container">
        
        <div class="row-create">
            <div class="w-50">
                <span class="text-bold">ประเภทแบบฟอร์ม</span>
                <select name="menu_id" id="menu_id" class="form-control">
                    <option value="">โปรดระบุ</option>
                    @foreach ($main_menu as $item)
                    <option value="{{$item['id']}}" >{{$item['main_menu_name']}}</option>
                        
                    @endforeach
                </select>
            </div>
            <div class="w-50">
                <span class="text-bold">ชื่อแบบฟอร์ม</span>
             <input class="form-control " name="forms_name"  placeholder="ชื่อแบบฟอร์ม"    />


            </div>
        </div>

        <div class="row-create mt-3">
           <span  class="text-bold">สถานะฟอร์ม</span>
        </div>
       
        <div class="row-create mt-1">
            <div class="custom-control custom-control-add custom-switch ">
                <input type="checkbox" class="custom-control-input" id="forms_status" name="forms_status" value="0">
                <label class="custom-control-label" for="forms_status">Inctive (ปิดใช้งาน)</label>
              </div>
         </div>


         <div class="project-all-layout">
            <span class="text-bold">เลือกโครงการที่ใช้แบบฟอร์ม</span>
            <label class="container-checkbox pl-25px"> 
                <input type="checkbox" id="permission_all"  value=""  >
                <span class="checkmark"></span>
              </label>
            <span class="">ทุกโครงการ</span>
            
         </div>  
         <div class="project-layout">
             @foreach ($project as $item)
             <div class="project-checkbox-layout">
                <label class="container-checkbox pl-25px"> 
                    <input type="checkbox" id="permission_id_{{$item['projects_id']}}" name="permission_id[]"   value="{{$item['projects_id']}}"  >
                    <span class="checkmark"></span>
                  </label>
                <span>{{$item['projects_name']}}</span>
           </div>
             @endforeach
           
         </div>  
        

    </div>
  
</div>
 

<div class="container-setting setting-create-container mt-3 from-type-layout">
{{-- form การส่งค่างวด --}}
    <div class="installment-layout detail-layout d-none" data-form-type="2">
        <div class="form-amount-layout">
            <span class="text-bold">จำนวนการส่งค่างวดทั้งหมด</span>
            <div class="input-group ip-plus-minus">
                <span class="input-group-btn btn-left" 
                data-btn-minus="btn-minus-tag"
                role="button">
                    <div>
                        <img class="img-minus-icon" src="{{asset('img/icon_minus_gray.png')}}" style="width: 1.3rem;"  >
                    </div>
                </span>
                <input type="text" name="quant[1]" class="form-control input-number border-0 input-plus-minus" value="1" readonly >
                <span class="input-group-btn btn-right" role="button"
                data-btn-plus="true"
                data-btn-add-tag="true" >
                    <div>
                        <img src="{{asset('img/icon_plus2.png')}}" style="width: 1.3rem;"  >
                    </div>
                </span>
            </div>
          
        </div>
        <div class="form-detail-layout">
            <div class="form-installment-list">
                <div class="form-installment-no-list">
                    <button   class="btn btn-accept btn-form-detail-no"  data-no="1">
                        <span class="tag-no-name">งวด</span>   
                        <span class="tag-no">1</span>   
                    </button>
                </div>
            </div>
           

            <div class="form-detail-table" data-table-no="1">
                    <table class="table table-borderless">
                        <thead>
                          <tr class="text-bold">
                            <th scope="col">ข้อที่</th>
                            <th scope="col">รายละเอียดงวด</th>
                            <th scope="col">% รวม</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody class="table-body-project-detail">
                          <tr>
                            <td class="w-installment-no">
                                <div class="d-flex col-gap-1">
                                    <input class="form-control number"  value="1" disabled style="text-align: center;"  />
                                </div>
                            </td>
                            <td>
                                <input class="form-control" type="text" value=""  name="forms_detail[]" />
                            </td>
                            <td class="w-installment-percent">
                                <div class="input-group mb-3">
                                   <input class="form-control input-br-0" name="forms_percent[]" 
                                pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency"  />
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>
                                </div>
                            </td>
                            <td >
                                <div class="d-flex col-gap-1 h-form-control">
                                    
                                    <label class="container-checkbox pl-25px"> 
                                        <input type="checkbox"  name="forms_operation_cost[]" value="0"  >
                                        <span class="checkmark" style="margin-top: 0.4rem;"></span>
                                        <span class="" style="margin-top: 0.4rem;background: none;position: relative;width:auto">ค่าดำเนินการ 2 %</span>
                                        
                                      </label>
                                      
                                    <img class="align-self-center minus-icon" role="button" src="{{ asset('/img/icon_minus.svg') }}" >
                                    <img class="align-self-center plus-icon" role="button" src="{{ asset('/img/icon_plus.svg') }}">
                                </div>
                               
                            </td>
                          </tr>
                         
                        </tbody>
                      </table>
            </div>

        </div>
    </div>
{{-- form ตรวจส่งมอบบ้าน --}}
    <div class="cut-over-layout  detail-layout  d-none"  data-form-type="3">
        <div class="form-amount-layout">
            <span class="text-bold">จำนวนการส่งตรวจมอบบ้านทั้งหมด</span>
            <div class="input-group ip-plus-minus">
                <span class="input-group-btn btn-left" 
                data-btn-minus="btn-minus-tag"
                role="button">
                    <div>
                        <img class="img-minus-icon" src="{{asset('img/icon_minus_gray.png')}}" style="width: 1.3rem;"  >
                    </div>
                </span>
                <input type="text" name="quant[1]" class="form-control input-number border-0 input-plus-minus" value="1" readonly >
                <span class="input-group-btn btn-right" role="button"
                data-btn-plus="true"
                data-btn-add-tag="true"
                 >
                    <div>
                        <img src="{{asset('img/icon_plus2.png')}}" style="width: 1.3rem;"  >
                    </div>
                </span>
            </div>
            <span class="text-bold">ครั้ง</span>
          
        </div>
      
        <div class="form-detail-layout">
          
            <div class="form-installment-list">
                <div class="form-installment-no-list">
                    <button   class="btn btn-accept btn-form-detail-no" data-no="1" >
                        <span class="tag-no-name">ครั้งที่</span>   
                        <span class="tag-no">1</span>   
                    </button>
                </div>
            </div>

         
          
           

            <div class="form-detail-table"  data-table-no="1">
                <div class="mt-4 cut-over-cond-layout pl-3" style="display:none;">
                    <div>
                        <span class="text-bold">เงื่อนไขการตรวจงาน</span>
                    </div>
                    <div class="form-amount-layout mt-4">
                       
                        <span class="text-bold">หลังจากตรวจครั้ง</span>
                        <span class="text-bold affter-check-text">1</span>
                        <div class="input-group ip-plus-minus">
                            <span class="input-group-btn btn-left" role="button"
                            data-btn-minus2="true">
                                <div>
                                    <img class="img-minus-icon" src="{{asset('img/icon_minus_gray.png')}}" style="width: 1.3rem;"  >
                                </div>
                            </span>
                            <input type="text" name="amount_date_after_check[]" class="form-control input-number border-0 input-plus-minus" value="0" readonly >
                            <span class="input-group-btn btn-right btn-cut-over-plus" role="button"
                            data-btn-plus="true"
                            >
                                <div>
                                    <img src="{{asset('img/icon_plus2.png')}}" style="width: 1.3rem;"  >
                                </div>
                            </span>
                        </div>
                        <span class="text-bold">วัน</span>
                      
                    </div>
    
                </div>
                    <table class="table table-borderless">
                        <thead>
                          <tr class="text-bold">
                            <th scope="col">หัวข้อการตรวจ</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody class="table-body-project-detail">
                          <tr>
                            <td>
                                <input class="form-control number" type="text" name="forms_detail[]" value=""   />
                            </td>
                            <td >
                                <div class="d-flex col-gap-1 h-form-control">
                                    <img class="align-self-center minus-icon" role="button" src="{{ asset('/img/icon_minus.svg') }}" >
                                    <img class="align-self-center plus-icon" role="button" src="{{ asset('/img/icon_plus.svg') }}">
                                </div>
                               
                            </td>
                          </tr>
                         
                        </tbody>
                      </table>
            </div>
        </div>
    </div>
{{-- Cutoff --}}
    <div class="cut-off-layout detail-layout d-none" data-form-type="4">
        <div class="form-detail-layout cut-off-sub-layout">
            <div>
                <div class="d-flex justify-content-between">
                    <span class="text-bold">รายละเอียดงวดงาน</span>
                    <div role="button" class="remove-cut-off" style="display: none">
                        <img src="{{ asset('./img/icon_bin.svg') }}" alt="">
                        <span class="text-bold text-remove">ลบ</span>
                    </div>
                </div>
                <input class="form-control  mt-2"  value="" type="text"  name="forms_cut_offs_detail"   />
            </div>

            <div class="form-detail-table" data-table-no="1">
                <table class="table table-borderless">
                    <thead>
                      <tr class="text-bold">
                        <th scope="col">ข้อที่</th>
                        <th scope="col">รายละเอียดงวด</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody class="table-body-project-detail">
                      <tr>
                        <td class="w-cut-off-no">
                            <div class="d-flex col-gap-1">
                                <input class="form-control "  value="1" disabled style="text-align: center;"  />
                             
                            </div>
                        </td>
                        <td>
                            <input type="text" class="form-control "  value=""  name="forms_detail[]"  />
                        </td>
                        <td >
                            <div class="d-flex col-gap-1 h-form-control">
                                <img class="align-self-center minus-icon" role="button" src="{{ asset('/img/icon_minus.svg') }}" >
                                <img class="align-self-center plus-icon" role="button" src="{{ asset('/img/icon_plus.svg') }}">
                            </div>
                           
                        </td>
                      </tr>
                     
                    </tbody>
                  </table>
            </div>

           
        </div>
        <div class="d-flex justify-content-center">
            <button  class="btn btn-plus-cut-off" href="#"  >
                <div class="icon-btn-cancel">
                    <img role="button" src="{{ asset('/img/icon_cancel_cycle.svg') }}" alt="" srcset="">
                </div>
            <span>เพิ่มรายละเอียดงวดงาน</span>   
            </button>
        </div>

       
    </div>

</div>

<div class="setting-create-footer">
    <a role="button" class="btn btn-accept"
           {{-- href="{{url('setting?page=project_create')}}" --}}
           onclick="save_data()"
           >
               <div class="icon-btn-accept">
                   <img role="button" src="{{ asset('/img/icon_plus_cycle.svg') }}" alt="" srcset="">
               </div>
            <span>บันทึก</span>   
    </a>

    <a role="button" class="btn btn-cancel"
    href="{{url('setting/setting_form')}}"
    >
        <div class="icon-btn-cancel">
            <img role="button" src="{{ asset('/img/icon_cancel_cycle.svg') }}" alt="" srcset="">
        </div>
     <span>ยกเลิก</span>   
    </a>

   
</div>
<script src="{{ asset('js/currency_format.js') }}"></script>
<script>

$(`#menu_id`).change(function (e) { 
    e.preventDefault();
    let containerType2 = $(`[name=menu_id] option:selected`).val()
    console.log("🚀 ~ file: create.blade.php ~ line 361 ~ containerType2", containerType2)
$(`.detail-layout`).addClass(`d-none`)
$(`.detail-layout[data-form-type="${containerType2}"]`).removeClass(`d-none`)

});


    $(`.btn-plus-cut-off`).click(function (e) { 
        e.preventDefault();
        let num = $(`.cut-off-sub-layout`).length
        let newCutOffLayout = $(`.cut-off-sub-layout:first`).clone()
        newCutOffLayout.find(`input[type=text]`).val(null)
        newCutOffLayout.find(`.form-detail-table`).attr(`data-table-no`,num+1)
        
        newCutOffLayout.find(`tbody >tr:not(:first)`).remove()
        $(`.cut-off-sub-layout:last`).after(newCutOffLayout)
        $(`.remove-cut-off:not(:first)`).show()
    });

    $(document).on(`click`,`.remove-cut-off`,function (e) { 
        e.preventDefault();
        if($(`.cut-off-sub-layout`).length <= 1){
            return
        }
        $(this).closest(`.cut-off-sub-layout`).remove()
    });

</script>

<script>
    
 


    $(`[data-btn-add-tag]`).click(function (e) { 
        e.preventDefault();
       
        
        let num =   $(this).closest(`.detail-layout`).find(`.form-installment-no-list >button`).length
        let tagNoNamge = $(this).closest(`.detail-layout`).find(`.tag-no-name:first`).html()

        num = num+1
        let btnInstNew = $(`.btn-form-detail-no:last`).clone()   
        btnInstNew.removeClass(`btn-accept`)
        btnInstNew.find(`.tag-no-name`).html(tagNoNamge)

        
        btnInstNew.find(`.tag-no`).html(num)
        btnInstNew.find(`.tag-no`).removeClass(`text-green`)
        btnInstNew.attr(`data-no`,num)

        $(this).closest(`.detail-layout`).find(`.form-installment-no-list`).append(btnInstNew)
        addNewTableDetail(num)
    });

 

    $(document).on(`click`,`.btn-form-detail-no`,function(){
       let num = $(this).data(`no`)
       let menu_id = $(`#menu_id option:selected`).val()
       console.log("🚀 ~ file: create.blade.php ~ line 420 ~ $ ~ num", num)
       $(`[data-form-type=${menu_id}]`).find(`.btn-form-detail-no`).removeClass(`btn-accept`)
      $(`[data-form-type=${menu_id}]`).find(`.btn-form-detail-no[data-no=${num}]`).addClass(`btn-accept`)


      $(`.form-detail-table`).addClass(`d-none`)
      $(`.form-detail-table[data-table-no=${num}]`).removeClass(`d-none`)

    })



    const addNewTableDetail = (num)=>{
        let menu_id = $(`[name=menu_id] option:selected`).val()
        console.log("🚀 ~ file: create.blade.php ~ line 442 ~ addNewTableDetail ~ menu_id", menu_id)

       let formDetailLayout =  $(`[data-form-type=${menu_id}]`).find(`.form-detail-table:first`).clone()
 

       
       formDetailLayout.attr(`data-table-no`,num)
       formDetailLayout.find(`input[type=text]`).val(null)
       formDetailLayout.find(`input[type=checkbox]`).prop(`checked`,false)
       formDetailLayout.find(`.cut-over-cond-layout`).show()
       formDetailLayout.find(`.cut-over-cond-layout input[type=text]`).val(0)
       formDetailLayout.find(`.cut-over-cond-layout .affter-check-text`).html(num-1)
       
      formDetailLayout.find(`tbody >tr:not(:first)`).remove() // remove row without firstrow
      formDetailLayout.addClass(`d-none`)
      
      $(`[data-form-type=${menu_id}]`).find(`.form-detail-layout`).append(formDetailLayout)
       return;
    }
    
    $(document).on(`click`,`[data-btn-plus]`,function(e){
        e.preventDefault();
        let num =  parseInt($(this).closest(`.ip-plus-minus`).find(`.input-plus-minus`).val()) 
        num = num+1
        $(this).closest(`.ip-plus-minus`).find(`.input-plus-minus`).val(num)
        $(this).closest(`.ip-plus-minus`).find(`.img-minus-icon`).attr(`src`,`{{asset('img/icon_minus2.png')}}`)
    })
 

    $(document).on(`click`,`[data-btn-minus]`,function(e){
        e.preventDefault();
        let num =  parseInt(  $(this).closest(`.ip-plus-minus`).find(`.input-plus-minus`).val()) 
        num = num-1
        if(num === 1){
            $(this).closest(`.ip-plus-minus`).find(`.img-minus-icon`).attr(`src`,`{{asset('img/icon_minus_gray.png')}}`)
        }else if(num <= 0){
            return
        }
        let menu_id = $(`[name=menu_id] option:selected`).val()
        $(`[data-form-type=${menu_id}]`).find(`.btn-form-detail-no:last`).remove()
        $(`[data-form-type=${menu_id}]`).find(`.form-detail-table:last`).remove()

        $(this).closest(`.ip-plus-minus`).find(`.input-plus-minus`).val(num)
    })

    $(`[data-btn-minus2]`).click(function(e){
        e.preventDefault();
        let num =  parseInt(  $(this).closest(`.ip-plus-minus`).find(`.input-plus-minus`).val()) 
        num = num-1
        if(num === 1){
            $(this).closest(`.ip-plus-minus`).find(`.img-minus-icon`).attr(`src`,`{{asset('img/icon_minus_gray.png')}}`)
        }else if(num <= 0){
            return
        }
        $(this).closest(`.ip-plus-minus`).find(`.input-plus-minus`).val(num)
    })

</script>

<script>

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
 
    $(document).on(`click`,`.plus-icon`,function(e){
        e.preventDefault();

    let thisRow =  $(this).closest(`tr`)
    let newRow = thisRow.clone()
    newRow.find(`input[type=text]`).val(null)
    newRow.find(`input[type=checkbox]`).prop(`checked`,false)
    thisRow.after(newRow)
    })

    $(document).on(`click`,`.minus-icon`,function(e){
        e.preventDefault();
    let thisRow =  $(this).closest(`tr`)
    let countDataplot =  $(this).closest(`table`).find(`.minus-icon`).length
    countDataplot > 1 && thisRow.remove()
    })



    $(`#forms_status`).click(function(){

    let projectStatus = $(this).prop(`checked`)
    let projectStatusText = `Inactive (ปิดใช้งาน)` 
    let projectStatusColor = `` 
    if(projectStatus){
    projectStatusText = `Active (เปิดใช้งาน)`
    projectStatusColor = `#81D135`
    }

    $(`[for=forms_status]`).html(projectStatusText)
    $(`[for=forms_status]`).css(`color`,projectStatusColor)
    })



 
    const save_data =()=>{

        let menu_id = $(`[name=menu_id] option:selected`).val()
        let forms_name = $(`[name=forms_name]`).val()
        let forms_status = $(`[name=forms_status]:checked`).val()
        let project_id  = $(`[name^=permission_id]:checked`).map(function(){
            return $(this).val()
        }).get()

        let menuId = $(`[name=menu_id] option:selected`).val()
        let forms_page_no = $(`[data-form-type="${menuId}"]`).find(`.btn-form-detail-no`).length
        let date_affter_check =  $(`[name^=amount_date_after_check]`).map(function(){
            return $(this).val()
        }).get()

        let project_detail  = $(`[data-form-type="${menuId}"] table`).find(`[name^=forms_detail]`).map(function(){
                                    let obj = {}
                                    let forms_detail = $(this).val()
                                    let forms_percent = $(this).closest(`tr`).find(`[name^=forms_percent]`).val()
                                    let forms_operation_cost = $(this).closest(`tr`).find(`[name^=forms_operation_cost]:checked`).val()
                                    if(forms_operation_cost !== "0"){
                                    forms_operation_cost = "1"
                                    }
                                    let forms_page_no = $(this).closest(`.form-detail-table`).data(`tableNo`)
                                    

                                    obj.forms_detail = forms_detail
                                    obj.forms_percent = forms_percent
                                    obj.forms_operation_cost = forms_operation_cost
                                    obj.forms_page_no = forms_page_no
                                    return obj
                                }).get()
        
        let forms_cut_offs_detail = $(`[name^=forms_cut_offs_detail]`).map(function(){ return $(this).val()}).get()
        let     data ={
                    menu_id,
                    forms_name,
                    forms_status,
                    project_id,
                    project_detail,
                    forms_page_no,
                    date_affter_check,
                    forms_cut_offs_detail
                }
      
            
        Swal.fire({
            imageUrl: `{{ asset('/img/icon_alert_question.svg') }}`,
            html:`<span>คุณต้องการเพิ่มโครงการ ?</span>`,
            showDenyButton: true,
            allowOutsideClick: false,
            confirmButtonText,
            denyButtonText,
            showCloseButton: true,
        }).then((res)=>{
            if(res.isConfirmed){
                 Swal.showLoading()
                $.ajax({
                    type: "POST",
                    url: `{{url('setting/setting_form')}}`,
                    data,
                    dataType: 'json',
                    headers: {
                            'X-CSRF-TOKEN': `{{ csrf_token() }}`
                        },
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                        imageUrl: `{{ asset('/img/icon_alert_success.svg') }}`,
                        html:`<span>คุณได้ทำการเพิ่มโครงการเรียบร้อยแล้ว</span>`,
                        showDenyButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: `ตกลง`,
                        denyButtonText: `ยกเลิก`,
                        }).then(function(res){
                            if(res.isConfirmed){
                                window.location.href = `{{url('setting/setting_form')}}`
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
