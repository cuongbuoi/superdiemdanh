<div class="row control">
    <div class="chonmon col-md-6 offset-md-3">
        <form action="<?php echo base_url().'superdiemdanh/control/insert'; ?>" method="post">
        <input type="hidden" name="action" value="insert">
            <div class="form-group">
                <label>Tên môn</label>
                <input type="text" class="form-control" name="tenmon">
                <?php echo form_error('tenmon'); ?></label>
            </div>
            <div class="form-group">
                <label>Số tín chỉ</label>
                <input type="number" class="form-control" name="sotinhchi">
                <label style="color:red"><?php echo form_error('sotinhchi'); ?></label>
            </div>
            <div class="form-group">
                <label>Số tiết</label>
                <input type="number" class="form-control" name="sotiet">
                <label style="color:red"><?php echo form_error('sotiet'); ?></label>
            </div>
            <div class="chonmon pull-right">
        <button type="submit" class="btn btn-primary btn-nhapdiem"><span class="glyphicon glyphicon-edit"></span> Lưu</button>
    </div>
       
    </div>
    
</div>
</form>
<div class="bangdiem">
    <script src="../application/assets/js/jquery.tabledit.js"></script>
    <!-- <script>
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
    function report()
    {
        var lop=$('#lop').val()
        var mon=$('#mon').val()
        location.href='report/'+lop+'/'+mon
    }
    
    </script> -->
</div>