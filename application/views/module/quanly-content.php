<div class="bangdiem">
    <div class="table-responsive">
        <table class="table" id="edittable">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Tên học phần</th>
                    <th>Số tính chỉ</th>
                    <th>Số tiết</th>                   
                </tr>
            </thead>
            <tbody id="print">
              
            </tbody>
        </table>
    </div>
    <script src="../application/assets/js/jquery.tabledit.js"></script>
    <script>
     function get(){
            $.ajax({
                type: "post",
                url: "quanlymon",
                data: {
                    "action":"gettable"
                },
                success: function (response) {
                    $('#print').html(response)
                    edit()
                    $(".btn-toolbar").css("display","block");
                }
            });
        }  
    $(document).ready(function () {
       get()
    });
  

    function edit(){
       
            $('#edittable').Tabledit({
            url: 'editmon',
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
                identifier: [0, 'id'],
                editable: [[1, 'tenmonhoc'], [2, 'sotinhchi'], [3, 'sotiet']]
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