<div class="modal fade" id="suabuoivang" tabindex="-1" role="dialog" aria-labelledby="suabuoivang" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buổi vắng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <!-- table -->
                    <div class="table-responsive">
                          <table class="table" id="edittable">
                              <thead class="thead-light">
                                  <tr>
                                      <th>Họ và Tên</th>
                                      <th>MSSV</th>
                                      <th>Lớp</th>
                                      <th>Môn</th>
                                      <th>Điểm 1</th>
                                      <th>Điểm 2</th>
                                      <th>Điểm 3</th>
                                      <th>Điểm TB</th>
                                 
                                  </tr>
                              </thead>
                              <tbody id="print">
                                
                              </tbody>
                          </table>
                      </div>
                      <script src="../application/assets/js/jquery.tabledit.js"></script>
                      <script>
                        jQuery(document).ready(function($) {
                          $('#sidebar').toggleClass('active');
                        });
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
                      $( document ).ready(function() {
                        sub()
                      });
                      $('#lop').on('change', function() {
                           sub()
                      })
                     function get(){
                         var idclass=$('#lop').val()
                         var idmon=$('#mon').val()
                         $.ajax({
                             type: "post",
                             url: "get_table",
                             data: {
                                 "class":idclass,
                                 "mon":idmon
                             },
                             success: function (response) {
                                 $('#print').html(response)
                                 edit()
                                 $(".btn-toolbar").css("display","block");
                             }
                         });
                     }

                      function edit(){
                         
                              $('#edittable').Tabledit({
                              url: 'edit_mark',
                              deleteButton: false,
                              saveButton: true,
                              autoFocus: false,
                              buttons: {
                                  edit: {
                                      class: 'btn btn-primary',
                                      html: '<span class="glyphicon glyphicon-pencil"></span> &nbsp EDIT',
                                      action:'edit'
                                  },
                                  save:{
                                      class: 'btn btn-success',
                                      html: '<span class="glyphicon glyphicon-pencil"></span> &nbsp SAVE',
                                      action:'save'
                                  }
                              },
                              columns: {
                                  identifier: [1, 'mssv'],
                                  editable: [[5, 'diem2'], [6, 'diem3']]
                              },
                              onSuccess: function(data, textStatus, jqXHR) {
                                      get()
                                 
                                  },
                              onFail: function(jqXHR, textStatus, errorThrown) {
                                  console.log('onFail(jqXHR, textStatus, errorThrown)');
                                  console.log(jqXHR);
                                  console.log(textStatus);
                                  console.log(errorThrown);
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
        "ajax": 'get',
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
            "url": "get",
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
 

</script>