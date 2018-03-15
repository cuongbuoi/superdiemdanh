
<div class="row control">
    <div class="chonmon col-md-6">
        <form action="http://localhost/superdiemdanh/" method="post">
            <div class="form-group">
                <label>Chọn môn</label>
                <select class="form-control">
                    <option>Lập trình Java</option>
                    <option>Lập trình C#</option>
                    <option>Lập trình Android</option>
                    <option>Lập trình hướng đối tượng</option>
                </select>
            </div>
        </form>
    </div>
    <div class="chonmon col-md-6">
        <form action="http://localhost/superdiemdanh/" method="post">
            <div class="form-group">
                <label>Chọn lớp</label>
                <select class="form-control">
                    <option>Hệ thống thông tin</option>
                    <option>Khoa học máy tính</option>
                    <option>Công nghệ phần mềm</option>
                
                </select>
            </div>
        </form>
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
    
$(document).ready(function() {
    
    $('#example').DataTable( {
        "language": {
            "url": "../application/assets/css/vietnam.json"
        },
        "ajax": 'get',
        "columns": [
            { "data": "hoten" },
            { "data": "mssv" },
            { "data": "gioitinh" },
            { "data": "lop" },
            {"data": "bv"},
            { "data": "0" }
           // { "data": "salary" }
        ]
    } );
} );
</script>