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
       
                </select>
            </div>
        </form>
    </div>
    <div class="col-md-12">
            <div class="nut float-right mb-3" >
                <button class="btn btn-primary btn-nhapdiem" onclick="get()"><span class="glyphicon glyphicon-edit"></span> Nhập điểm</button>
            </div>
    </div>
</div>
<div class="bangdiem">
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
               
                </tr>
            </thead>
            <tbody id="print">
              
            </tbody>
        </table>
    </div>
    <script src="../application/assets/js/jquery.tabledit.js"></script>
    <script>
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
                    html: '<span class="glyphicon glyphicon-pencil"></span> &nbsp save',
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
</div>