<div class="chonmon">
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
<div class="bangdiem">
    <table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Mssv</th>
                <th>Họ và Tên</th>
                <th>Giới Tính</th>
                <th>Lớp</th>
                <th>Thao tác</th>
            </tr>
        </thead>
    </table>

    <script>
        
    $(document).ready(function() {
        
        $('#example').DataTable( {
            "language": {
                "url": "../application/assets/css/vietnam.json"
            },
            "ajax": 'get',
            "columns": [
                { "data": "mssv" },
                { "data": "hoten" },
                { "data": "gioitinh" },
                { "data": "malop" },
                { "data": "0" }
            // { "data": "salary" }
            ]
        } );
    } );
    </script>
</div>