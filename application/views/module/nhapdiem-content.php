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
    <div class="col-md-12">
            <div class="nut float-right mb-3" >
                <button class="btn btn-primary btn-nhapdiem" id="edit"><span class="glyphicon glyphicon-edit"></span> Nhập điểm</button>
            </div>
    </div>
</div>
<div class="bangdiem">
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Họ và Tên</th>
                    <th>MSSV</th>
                    <th>Giới Tính</th>
                    <th>Lớp</th>
                    <th>Buổi Vắng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td contenteditable="true">15C4801040069</td>
                    <td contenteditable="true">Nguyễn Trường Thuận</td>
                    <td contenteditable="true">Bê đê</td>
                    <td contenteditable="true">HTTT</td>
                    <td contenteditable="true">10</td>
                    <td>
                    <button class="table-remove btn btn-danger btn-diemdanh">Xóa</button>
                    </td>
                </tr>
                <!-- This is our clonable table line -->
                <tr class="hide">
                <td contenteditable="true">15C4801040069</td>
                    <td contenteditable="true">Nguyễn Trường Thuận</td>
                    <td contenteditable="true">Bê đê</td>
                    <td contenteditable="true">HTTT</td>
                    <td contenteditable="true">10</td>
                    <td>
                    <button class="table-remove btn btn-danger btn-diemdanh">Xóa</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            var $TABLE = $('#table');
            var $BTN = $('#export-btn');
            var $EXPORT = $('#export');

            $('.table-add').click(function () {
            var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
            $TABLE.find('table').append($clone);
            });

            $('.table-remove').click(function () {
            $(this).parents('tr').detach();
            });

            $('.table-up').click(function () {
            var $row = $(this).parents('tr');
            if ($row.index() === 1) return; // Don't go above the header
            $row.prev().before($row.get(0));
            });

            $('.table-down').click(function () {
            var $row = $(this).parents('tr');
            $row.next().after($row.get(0));
            });

            // A few jQuery helpers for exporting only
            jQuery.fn.pop = [].pop;
            jQuery.fn.shift = [].shift;

            $BTN.click(function () {
            var $rows = $TABLE.find('tr:not(:hidden)');
            var headers = [];
            var data = [];
            
            // Get the headers (add special header logic here)
            $($rows.shift()).find('th:not(:empty)').each(function () {
                headers.push($(this).text().toLowerCase());
            });
            
            // Turn all existing rows into a loopable array
            $rows.each(function () {
                var $td = $(this).find('td');
                var h = {};
                
                // Use the headers from earlier to name our hash keys
                headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();   
                });
                
                data.push(h);
            });
            
            // Output the result
            alert(data);
            }); 
        });
    </script>
</div>