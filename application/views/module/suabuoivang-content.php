<div class="modal fade" id="suabuoivang" tabindex="-1" role="dialog" aria-labelledby="suabuoivang" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buổi vắng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <!-- table -->
                    <div class="table-responsive" id="print">
               
                    </div>
                      <script src="../application/assets/js/jquery.tabledit.js"></script>
                      <script>
         

                      function edit(){
                         
                        $('#edittable').Tabledit({
                            url: 'deletebuoivang',
                            editButton: false,
                            restoreButton: false,
                            buttons: {
                                delete: {
                                    class: 'btn btn-xoabuoi btn-danger',
                                    html: '<span class="glyphicon glyphicon-trash"></span> &nbsp Xóa',
                                    action: 'delete'
                                },
                                confirm: {
                                    class: 'btn  btn-default btn-xacnhan',
                                    html: 'Xác nhận ?'
                                }
                            },
                            columns: {
                                identifier: [0,'id'],
                                editable: [[1,'mssv']]
                            },
                            onDraw: function() {
                                
                            },
                            onSuccess: function(data, textStatus, jqXHR) {
                                // console.log(data)
                                 $('#example').DataTable().ajax.reload();
                                 thongbao('Thông báo','Đã xóa','success')

                                // console.log('onSuccess(data, textStatus, jqXHR)');
                                // console.log(data);
                                // console.log(textStatus);
                                // console.log(jqXHR);
                            },
                            onFail: function(jqXHR, textStatus, errorThrown) {
                               
                            },
                            onAlways: function() {
                               
                            },
                            onAjax: function(action, serialize) {
                                
                            }
                        });
                      }
                      
                      </script>
               <!-- table -->
      </div>
    </div>
  </div>
</div>
<div class="row control">
    <div class="chonmon col-md-6">
        <form action="http://localhost/superdiemdanh/" method="post">
            <div class="form-group">
                <label>Chọn lớp</label>
                <select id="lop" class="form-control">
                <?php foreach ($class as $value){ ?>
                    <option value="<?php echo $value['malop']; ?>"><?php echo $value['tenlop']; ?></option>
                <?php } ?>
                </select>
            </div>
        </form>
    </div>
    <div class="chonmon col-md-6">
        <form action="http://localhost/superdiemdanh/" method="post">
            <div class="form-group">
                <label>Chọn môn</label>
                <select id="mon" class="form-control tt">
                    <option>Hệ thống thông tin</option>
                    <option>Khoa học máy tính</option>
                    <option>Công nghệ phần mềm</option>
                
                </select>
            </div>
        </form>
    </div>
    <div class="col-md-12">
            <div class="nut float-right mb-3" >
                <button class="btn btn-primary btn-nhapdiem" id="diemdanh" ><span class="glyphicon glyphicon-edit"></span> Nhập điểm</button>
            </div>
    </div>
</div>
<DIV class="diemdanh">
    <table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Họ và Tên</th>
            <th>MSSV</th>
            <th>Giới Tính</th>
            <th>Lớp</th>
            <th>Buổi Vắng</th>
            <th>Thao tác</th>
        </tr>
    </thead>
</table>
</DIV>

<script>
function thongbao(title,text,info){
    toastr[info](title, text)
    toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "2000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}


}


 function sub(){
        var idclass= $('#lop').val()
       $.ajax({
           type: "post",
           url: "get_sub",
           data: {"id":idclass},
           success: function (response) {
               $('.tt').html(response)
           }
       });
    }
    $('#lop').on('change', function() {
         sub()
    });
    $( document ).ready(function() {
      sub()
    });


function diemdanh(id)
{
    var idclass=$('#lop').val()
       var idmon=$('#mon').val()
    if(id != "")
    {
        $.ajax({
            type: "POST",
            url: "diemdanh",
            data: {"mssv":id,
                    "idmon":idmon},
            success: function (response) {
                if($.trim(response) == 'ok')
                {
                    thongbao('Thông báo','Đã điểm danh','success')
                    $('#example').DataTable().ajax.reload('',false);
                     
                }
                else{
                    thongbao('Thông báo','Đã điểm danh hôm nay','error')
                }
                
            }
        });
    }
}
function get(){
       var malop=$('#lop').val()
       var mamon=$('#mon').val()
       $('#example').DataTable( {
        "language": {
            "url": "../application/assets/css/vietnam.json"
        },
        "ajax": 'suabuoivang',
        "type":"post",
        "data":{"malop":malop,"mamon":mamon
        },
        "columns": [
            { "data": "hoten" },
            { "data": "mssv" },
            { "data": "gioitinh" },
            { "data": "lop" },
            {"data": "bv"},
            { "data": "0" }
        ]
    } );

}


function get_table(idclass,idmon)
{

    $('#example').DataTable( {
        destroy: true,
        "language": {
            "url": "../application/assets/css/vietnam.json"
        },
        "ajax": {
            "url": "suabuoivang",
            "type": "POST",
            "data":{"malop":idclass,
                    "mamon":idmon
            }
        },
        "columns": [
            { "data": "hoten" },
            { "data": "mssv" },
            { "data": "gioitinh" },
            { "data": "tenlop" },
            {"data": "bv"},

            { "data": "0" }
        ]
    } );

    
}
$(document).ready(function() {
    var page_tab = 0;
    $("#diemdanh").click(function (e) {
        var lop = $("#lop").val();
        var mon = $("#mon").val();
        get_table(lop,mon)       
        e.preventDefault();        
    });
    
} )
function editbuoivang(e){
    var id =$('#mon').val()
    $.ajax({
        type: "post",
        url: "laygido",
        data: {
            "mssv":e,
            "idmonhoc":id

        
        },
        success: function (response) {
            $('#print').html(response)
            edit()
            $(".btn-toolbar").css("display","block");
        }
    });
}


</script>