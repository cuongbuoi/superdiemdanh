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