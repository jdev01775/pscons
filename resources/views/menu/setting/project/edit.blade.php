@extends('menu.menu_sub.index')
@section('content_sub') 


{{-- general --}}
<link rel="stylesheet" href="{{asset('css/setting/style.css')}}">
<link rel="stylesheet" href="{{ asset('/css/setting/project/style.css') }}">


{{-- excel --}}
<script src="https://igniteui.com/js/modernizr.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script src="https://igniteui.com/js/external/FileSaver.js"></script>
<script src="https://igniteui.com/js/external/Blob.js"></script>
 
{{-- upload file --}}
<link rel="stylesheet" href="{{ asset('./assets/jquery-fancyfileuploader-master/fancy-file-uploader/fancy_fileupload.css') }}">
<script src="{{ asset('./assets/jquery-fancyfileuploader-master/fancy-file-uploader/jquery.fileupload.js') }}"></script>
<script src="{{ asset('./assets/jquery-fancyfileuploader-master/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('./assets/jquery-fancyfileuploader-master/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>

<script src="{{asset('./assets/import_excel/infragistics.core.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.lob.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.ext_core.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.ext_collections.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.ext_text.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.ext_io.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.ext_ui.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.documents.core_core.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.ext_collectionsextended.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.excel_core.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.ext_threading.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.ext_web.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.xml.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.documents.core_openxml.js')}}"></script>
<script src="{{asset('./assets/import_excel/infragistics.excel_serialization_openxml.js')}}"></script>
<link href="{{asset('./assets/import_excel/infragistics.theme.css')}}" rel="stylesheet"></link>
<link href="{{asset('./assets/import_excel/infragistics.css" rel="stylesheet')}}"></link>


<div class="setting-header">
    <span class="setting-title text-bold">เพิ่มโครงการใหม่</span>
</div>

  

   <form method="post" id="project_create_form" enctype="multipart/form-data">
<div class="container-setting setting-create-container">
    <div class="contain-create">
        
        <div class="row-create">
            <div class="w-50">
                <span class="text-bold">ชื่อโครงการ</span>
                <input class="form-control" name="projects_name" placeholder="โปรดระบุ" value="{{$data_projects[0]['projects_name']}}" />
            </div>
            <div class="w-50">
                <span class="text-bold">งบประมานโครงการ</span>
             <input class="form-control number" name="projects_budget" 
             pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency"  placeholder="0.00" value="{{number_format($data_projects[0]['projects_budget'],2)}}"    />


            </div>
        </div>

        <div class="row-create mt-3">
           <span  class="text-bold">สถานะโครงการ</span>
        </div>
       
        <div class="row-create mt-1">
            <div class="custom-control custom-control-add custom-switch ">
                <input type="checkbox" class="custom-control-input" id="projects_status" name="projects_status" value="0" 
                @if ($data_projects[0]['projects_status'] !='1')
                    checked
                @endif>
                <label class="custom-control-label" for="projects_status">Inctive (ปิดใช้งาน)</label>
              </div>
         </div>


         <div class="row-create project-detail mt-3">
            <div class="project-detail-excel-layout">
                <input class="d-none" type="file" id="upload_excel" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />

                <a role="button" class="btn btn-dowload" onclick="createTableWorkbook()">
                    <div class="icon-btn-accept">
                        <img role="button" src="{{ asset('/img/icon_dowload.svg') }}" alt="" srcset="">
                    </div>
                 <span class="text-bold">ดาวน์โหลด Excel</span>   
                </a>

                <a role="button" class="btn btn-upload" id="upload_excel_btn">
                    <div class="icon-btn-accept">
                        <img role="button" src="{{ asset('/img/icon_upload.svg') }}" alt="" srcset="">
                    </div>
                 <span class="text-bold">อัพโหลด</span>   
                </a>

            </div>
            <div class="project-detail-layout">
                <div>
                    <table class="table table-borderless">
                        <thead>
                          <tr class="text-bold">
                            <th scope="col">รายละเอียดการแบ่งแปลง</th>
                            <th scope="col">จำนวนยูนิต</th>
                            <th scope="col">Type บ้าน</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody class="table-body-project-detail">
                            
                         
                         @foreach ($data_projects_details as $item)
                          <tr>
                            <td>
                                <div class="d-flex col-gap-1">
                                    <input class="form-control number" name="project_details_plot_from[]" 
                                    pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$item['project_details_plot_from']}}" data-type="currency"  placeholder="แปลง"    />
                                    <span class="align-self-center">-</span>
                                    <input class="form-control number" name="project_details_plot_to[]" 
                                    pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$item['project_details_plot_to']}}" data-type="currency"  placeholder="แปลง"    />
                                </div>
                            </td>
                            <td>
                                <input class="form-control number" name="project_details_unit_amount[]" 
                                pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$item['project_details_unit_amount']}}" data-type="currency"  placeholder="0"    />
                            </td>
                            <td>
                                <input class="form-control" type="text"  name="project_details_type_home[]"   
                                value="{{$item['project_details_type_home']}}"   placeholder="โปรดระบุ">
                            </td>
                            <td >
                                <div class="d-flex col-gap-1 h-form-control">
                                    <img class="align-self-center minus-icon" role="button" src="{{ asset('/img/icon_minus.svg') }}" >
                                    <img class="align-self-center plus-icon" role="button" src="{{ asset('/img/icon_plus.svg') }}">
                                </div>
                               
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>  

          
         </div>
         <div class="upload-img mt-3">
            <input id="upload_img" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" multiple>

        </div>

    </div>
  
</div>
</form>

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
    href="{{url('setting/setting_project')}}"
    >
        <div class="icon-btn-cancel">
            <img role="button" src="{{ asset('/img/icon_cancel_cycle.svg') }}" alt="" srcset="">
        </div>
     <span>ยกเลิก</span>   
    </a>

   
</div>
@foreach ($data_project_plot_imgs as $item)
    <input name="data_project_plot_imgs[]" type="hidden" value="{{asset($item['project_plot_imgs_path'])}}" data-img-name="{{asset($item['project_plot_imgs_name'])}}" >
@endforeach
<script src="{{ asset('js/currency_format.js') }}"></script>

<script type="text/javascript">
$(function(){
     
     let dataProjectPlotImgs = JSON.stringify(`{{$data_project_plot_imgs}}`)
     $(`[name^=data_project_plot_imgs]`).map(function(){
         let url = $(this).val()
         let ImgName = $(this).data(`imgName`)
        fetch(url)
                .then((res) => res.blob())
                .then((myBlob) => {
                    const myFile = new File([myBlob], ImgName, {
                    type: myBlob.type,
                    });
                    $('#upload_img').each(function() {
                        var $this = $(this);
                        var fileinput = $this.data('fancy-fileupload').form.find('input[type=file]');
                         fileinput.fileupload('add', { files: myFile });
                    });
        });
     })
   
 
    
})
   
    </script>
 


<script>
    // --------------------------   upload Img  --------------------------   
        /**
     * @params {File[]} files Array of files to add to the FileList
     * @return {FileList}
     */
     function FileListItems (files) { /// Set File List
    var b = new ClipboardEvent("").clipboardData || new DataTransfer()
    for (var i = 0, len = files.length; i<len; i++) b.items.add(files[i])
    return b.files
    }

    function convertBlobToFile(){ /// convert blob to file
        
    return new Promise(function (resolve, reject){ 
        let countData = $(`.ff_fileupload_preview_image_has_preview`).length
        let  file = []
           let dataFileList = $(`.ff_fileupload_preview_image_has_preview`).map(function(index,item,array){
                let url =  $(this).data(`src`)
                let imgName =  $(this).data(`fileName`)
                let blob = fetch( url)
                .then((res) => res.blob())
                .then((myBlob) => {
                    const myFile = new File([myBlob], imgName, {
                    type: myBlob.type,
                    });
                    file = [...file,myFile]
                    file = new FileListItems(file)
                    // console.log({index})
                    // console.log({countData})
                    if(index === countData-1){
                        resolve(file)
                    }
                });
            })
           
    });
    }


        $('#upload_img').FancyFileUpload({
        params : {
        action : 'fileuploader', 
        },
        showpreview:true,
        });
   

        
</script>
   
<script>
    // --------------------------   Export Excel  --------------------------   
 
        function createTableWorkbook() {
            Swal.fire({
        title: 'กำลังโหลดข้อมูล...',
        html: 'กรุณารอสักครู่...',
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
            var workbook = new $.ig.excel.Workbook($.ig.excel.WorkbookFormat.excel2007);
                    var sheet = workbook.worksheets().add('Sheet1');
                    sheet.columns(0).setWidth(72, $.ig.excel.WorksheetColumnWidthUnit.pixel);
                    sheet.columns(1).setWidth(160, $.ig.excel.WorksheetColumnWidthUnit.pixel);
                    sheet.columns(2).setWidth(110, $.ig.excel.WorksheetColumnWidthUnit.pixel);
                    sheet.columns(3).setWidth(275, $.ig.excel.WorksheetColumnWidthUnit.pixel);

                    // Create a to-do list table with columns for tasks and their priorities.
                    sheet.getCell('A1').value('แปลง เริ่ม');
                    sheet.getCell('B1').value('แปลง หยุด');
                    sheet.getCell('C1').value('จำนวนยูนิต');
                    sheet.getCell('D1').value('Type บ้าน');
                    let countRow = $(`.table-body-project-detail tr`).length + 1
                    var table = sheet.tables().add(`A1:D${countRow}`, true);

                    // Specify the style to use in the table (this can also be specified as an optional 3rd argument to the 'add' call above).
                    table.style(workbook.standardTableStyles('TableStyleMedium2'))

                    // Populate the table with data
                    $(`.table-body-project-detail tr`).map( async function(index,item){
                        let rowNo = 2+index
                        let plotFrom = $(item).find(`[name^=project_details_plot_from]`).val()
                        let plotTo = $(item).find(`[name^=project_details_plot_to]`).val()
                        let unitAmount = $(item).find(`[name^=project_details_unit_amount]`).val()
                        let homeType =$(item).find(`[name^=project_details_type_home]`).val()
                        plotFrom ??= ``
                        plotTo ??= ``
                        unitAmount ??= ``
                        homeType ??= ``
                        sheet.getCell(`A${rowNo}`).value(plotFrom);
                        sheet.getCell(`B${rowNo}`).value(plotTo);
                        sheet.getCell(`C${rowNo}`).value(unitAmount);
                        sheet.getCell(`D${rowNo}`).value(homeType);
                    })
                let result =   saveWorkbook(workbook, "project_plot.xlsx");
                result && setTimeout(() => {
                    Swal.close()
                }, 1000);

                    // Sort the table by the Applicant column
                    //  table.columns('Applicant').sortCondition(new $.ig.excel.OrderedSortCondition());

                    // Filter out the Approved applicants
                    //  table.columns('Status').applyCustomFilter(new $.ig.excel.CustomFilterCondition($.ig.excel.ExcelComparisonOperator.notEqual, 'Approved'));

                    // Save the workbook
        },  }) 
        
        }
        

        function saveWorkbook(workbook, name) {
            workbook.save({ type: 'blob' }, function (data) {
                saveAs(data, name);
            }, function (error) {
            });
            return true
        }
 
</script>

<script>
    // --------------------------   import Excel  --------------------------   
    $(`#upload_excel_btn`).click(function(){
        $(`#upload_excel`).trigger(`click`)
    })

 
            $("#upload_excel").on("change", function () {
                var excelFile,
                    fileReader = new FileReader();

                $("#result").hide();
                Swal.fire({
  title: 'กำลังโหลดข้อมูล...',
  html: 'กรุณารอสักครู่...',
  allowEscapeKey: false,
  allowOutsideClick: false,
  didOpen: () => {
    Swal.showLoading()

    fileReader.onload = function (e) {
                    var buffer = new Uint8Array(fileReader.result);

                    $.ig.excel.Workbook.load(buffer, function (workbook) {
                        var column, row, newRow, cellValue, columnIndex, i,
                            worksheet = workbook.worksheets(0),
                            columnsNumber = 0,
                            gridColumns = [],
                            data = [],
                            worksheetRowsCount;

                        // Both the columns and rows in the worksheet are lazily created and because of this most of the time worksheet.columns().count() will return 0
                        // So to get the number of columns we read the values in the first row and count. When value is null we stop counting columns:
                        while (worksheet.rows(0).getCellValue(columnsNumber)) {
                            columnsNumber++;
                        }

                        // Iterating through cells in first row and use the cell text as key and header text for the grid columns
                        for (columnIndex = 0; columnIndex < columnsNumber; columnIndex++) {
                            column = worksheet.rows(0).getCellText(columnIndex);
                            gridColumns.push({ headerText: column, key: column });
                        }

                        // We start iterating from 1, because we already read the first row to build the gridColumns array above
                        // We use each cell value and add it to json array, which will be used as dataSource for the grid
                        for (i = 1, worksheetRowsCount = worksheet.rows().count() ; i < worksheetRowsCount; i++) {
                            newRow = {};
                            row = worksheet.rows(i);

                            for (columnIndex = 0; columnIndex < columnsNumber; columnIndex++) {
                                cellValue = row.getCellText(columnIndex);
                                newRow[gridColumns[columnIndex].key] = cellValue;
                            }

                            data.push(newRow);
                        }

                        // we can also skip passing the gridColumns use autoGenerateColumns = true, or modify the gridColumns array
                    let res =     createGrid(data, gridColumns);
                        $("#upload_excel").val(null)
                        res &&Swal.close()
                    }, function (error) {
                        $("#result").text("The excel file is corrupted.");
                        $("#result").show(1000);
                    });
                }

                if (this.files.length > 0) {
                    excelFile = this.files[0];
                    if (excelFile.type === "application/vnd.ms-excel" || excelFile.type === "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || (excelFile.type === "" && (excelFile.name.endsWith("xls") || excelFile.name.endsWith("xlsx")))) {
                        fileReader.readAsArrayBuffer(excelFile);
                    } else {
                        $("#result").text("The format of the file you have selected is not supported. Please select a valid Excel file ('.xls, *.xlsx').");
                        $("#result").show(1000);
                    }
                }
  }})
               

            })
        

        function createGrid(  data  , gridColumns) {
          let newData =    data.map(item=>{
              let objVal = Object.values(item)
              let plotFrom = objVal[0]
              let plotTo = objVal[1]
              let unitAmount = objVal[2]
              let homeType = objVal[3]
              
              let newRow = $(`.table-body-project-detail tr:eq(0)`).clone()
              newRow.addClass(`new-row`)
              newRow.find(`[name^=project_details_plot_from]`).val(plotFrom)
              newRow.find(`[name^=project_details_plot_to]`).val(plotTo)
              newRow.find(`[name^=project_details_unit_amount]`).val(unitAmount)
              newRow.find(`[name^=project_details_type_home]`).val(homeType)
              newRow.appendTo(`.table-body-project-detail`)
          })
          $(`.table-body-project-detail tr`).not(`.new-row`).remove()
          $(`.new-row`).removeClass(`new-row`)
          return true
        }
</script>

 
<script>
 
    $(document).on(`click`,`.plus-icon`,function(e){
        e.preventDefault();

    let thisRow =  $(this).closest(`tr`)
    let newRow = thisRow.clone()
    newRow.find(`input`).val(null)
    thisRow.after(newRow)
    })

    $(document).on(`click`,`.minus-icon`,function(e){
        e.preventDefault();
    let thisRow =  $(this).closest(`tr`)
    let countDataplot = $(`.minus-icon`).length
    countDataplot > 1 && thisRow.remove()
    })



    $(`#projects_status`).click(function(){

    let projectStatus = $(this).prop(`checked`)
    let projectStatusText = `Inactive (ปิดใช้งาน)` 
    let projectStatusColor = `` 
    if(projectStatus){
    projectStatusText = `Active (เปิดใช้งาน)`
    projectStatusColor = `#81D135`
    }

    $(`[for=projects_status]`).html(projectStatusText)
    $(`[for=projects_status]`).css(`color`,projectStatusColor)
    })



 
    const save_data =()=>{
    

 
    
        let projects_name = $(`[name=projects_name]`).val()
        let projects_budget = $(`[name=projects_budget]`).val().replaceAll(",", "")
        let projects_status = $(`[name=projects_status]:checked`).val()
        let projects_detail = $(`.table-body-project-detail tr`).map(function(){
                                let obj ={
                                    'project_details_plot_from':$(this).find(`[name^=project_details_plot_from]`).val().replaceAll(`,`,``),
                                    'project_details_plot_to':$(this).find(`[name^=project_details_plot_to]`).val().replaceAll(`,`,``),
                                    'project_details_unit_amount':$(this).find(`[name^=project_details_unit_amount]`).val().replaceAll(`,`,``),
                                    'project_details_type_home':$(this).find(`[name^=project_details_type_home]`).val(),
                                }
                                return obj
                              }).get()

            let data = new FormData();         
            data.append('projects_name', projects_name);
            data.append('projects_budget', projects_budget);
            data.append('projects_status', projects_status);
            data.append('projects_detail', JSON.stringify(projects_detail));
            data.append('projects_id', `{{$data_projects[0]['projects_id']}}`);
        
        //! set file image for upload
          let  file = []
           let dataFileList = $(`.ff_fileupload_preview_image_has_preview`).map(function(index,item,array){
                let url =  $(this).data(`src`)
                let imgName =  $(this).data(`fileName`)
                console.log("🚀 ~ file: edit.blade.php ~ line 508 ~ dataFileList ~ imgName", imgName)
                let blob = fetch( url)
                .then((res) => res.blob())
                .then((myBlob) => {
                    const myFile = new File([myBlob], imgName, {
                    type: myBlob.type,
                    });
                    imgUpload = new FileListItems(myFile)
                    data.append(`file_${index}`, myFile);
                });
            })
  


            
        Swal.fire({
            imageUrl: `{{ asset('/img/icon_alert_question.svg') }}`,
            html:`<span>คุณต้องการแก้ไขโครงการ ?</span>`,
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
                    url: `{{url('setting/setting_project_update')}}`,
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
                        html:`<span>คุณได้ทำการแก้ไขโครงการเรียบร้อยแล้ว</span>`,
                        showDenyButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: `ตกลง`,
                        denyButtonText: `ยกเลิก`,
                        }).then(function(res){
                            if(res.isConfirmed){
                                window.location.href = `{{url('setting/setting_project')}}`
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
