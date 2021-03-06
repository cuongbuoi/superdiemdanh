<nav id="sidebar">
    <div class="sidebar-header">
        <a href="#" role="button" id="tuychon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../application/assets/img/male-4.png" width="50" height="50" class="d-inline-block align-center" alt="">
            Xin chào, Sếp <i class="dropdown-toggle"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="tuychon">
            <a class="dropdown-item" href="http://localhost/superdiemdanh/control/logout"><i class="fa fa-power-off"></i> Đăng xuất </a>
        </div>
    </div>

    <ul class="list-unstyled components">
        <li <?php if($this->uri->segment(2)=="dashboard") echo  'class="active"'; ?>>
            <a href="<?php echo base_url().'superdiemdanh/control/dashboard'; ?>">Điểm danh</a>
        </li>
        <li <?php if($this->uri->segment(2)=="dashboard2") echo  'class="active"'; ?>>
            <a  href="<?php echo base_url().'superdiemdanh/control/dashboard2'; ?>">Nhập điểm</a>
        </li>
        <li <?php if($this->uri->segment(2)=="dashboard3") echo  'class="active"'; ?>>
            <a href="<?php echo base_url().'superdiemdanh/control/dashboard3'; ?>">Thống kê, báo cáo</a>
        </li>
        <li <?php if($this->uri->segment(2)=="dashboard4") echo  'class="active"'; ?>>
            <a href="#quanly" data-toggle="collapse" aria-expanded="false">Quản lý<i class="dropdown-toggle float-right"></i></a>
            <ul class="collapse list-unstyled" id="quanly">
                <li><a href="<?php echo base_url().'superdiemdanh/control/dashboard4'; ?>">Quản lý môn học</a></li>
                <li><a href="<?php echo base_url().'superdiemdanh/control/dashboard4/insert'; ?>">Thêm môn học</a></li>
                <li><a href="<?php echo base_url().'superdiemdanh/control/dashboard4'; ?>">Quản lý 3</a></li>
            </ul>
        </li>
        <li <?php if($this->uri->segment(2)=="insert") echo  'class="active"'; ?>>
            <a href="<?php echo base_url().'superdiemdanh/control/insert'; ?>">Thêm môn học</a>
        </li>
        <li <?php if($this->uri->segment(2)=="readexcel") echo  'class="active"'; ?>>
            <a href="<?php echo base_url().'superdiemdanh/control/readexcel'; ?>">Upload sinh viên</a>
        </li>
        <li <?php if($this->uri->segment(2)=="dashboard5") echo  'class="active"'; ?>>
            <a href="<?php echo base_url().'superdiemdanh/control/dashboard5'; ?>">Chi tiết buổi vắng</a>
        </li>
        <li <?php if($this->uri->segment(2)=="insertclass") echo  'class="active"'; ?>>
            <a href="<?php echo base_url().'superdiemdanh/control/insertclass'; ?>">Thêm lớp</a>
        </li>
    </ul>
</nav>