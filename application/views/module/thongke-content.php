<!-- Cách đổi màu Widget: gắn class widget-màu     (màu: xanh, do, xanhdam, cam, vang, hong, tim) -->
<!-- <div class="widget-thongke row">
	<div class="col-md-3">
		<div class="card text-center widget-do">
			<div class="card-body">
				<h3 class="card-title">Thống kê 1</h3>
				<p class="card-title so">69</p>
				<p class="noidung">Nhập nội dung vào đây</p>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card text-center widget-xanhdam">
			<div class="card-body">
				<h3 class="card-title">Thống kê 2</h3>
				<p class="card-title so">69</p>
				<p class="noidung">Nhập nội dung vào đây</p>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card text-center widget-cam">
			<div class="card-body">
				<h3 class="card-title">Thống kê 3</h3>
				<p class="card-title so">69</p>
				<p class="noidung">Nhập nội dung vào đây</p>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card text-center widget-hong">
			<div class="card-body">
				<h3 class="card-title">Thống kê 4</h3>
				<p class="card-title so">69</p>
				<p class="noidung">Nhập nội dung vào đây</p>
			</div>
		</div>
	</div>
</div> -->

<div class="thongke">
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
                <option value="0"></option>
                </select>
            </div>
        </form>
    </div>
    
</div>
	<div class="row">
		<div class="col-md-6">
			     <div id="chart-area"></div>
		</div>
		<div class="col-md-6">
			
		<div id="chart-area-2"></div>
		</div>
	</div>
</div>
<script>
     
    function sub(){
        var idclass= $('#lop').val()
       $.ajax({
           type: "post",
           url: "get_sub",
           data: {"id":idclass},
           success: function (response) {
               $('.tt').append(response)

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

    
    
    </script>
</div>
<script class='code-js' id='code-js'>
     var width1 = 500;
        var height1 = 500;
jQuery(document).ready(function($) {

    $('.tt').on('change', function(event) {
        var idclass=$('#lop').val()
       var idmon=$('#mon').val()

      
    function detectmob() {
   return (/Mobile/i.test(navigator.userAgent))
}

if(detectmob())
{
    width1 = 320;
    height1 = 320;
}


    $.ajax({
        url: 'tylediem',
        type: 'POST',
        data:{'idclass': idclass ,'idmon' : idmon},
        success: function(res){
            data = $.parseJSON(res);
            chart1(data['diem_kem'],data['diem_tb'],data['diem_kha'],data['diem_gioi'])
        }
    })

    $.ajax({
        url: 'tylevang',
        type: 'POST',
        data:{'idclass': idclass ,'idmon' : idmon},
        success: function(res){
            data = $.parseJSON(res);
            chart2(data['ti_le_vang'],data['ko_vang'])
        }
    })

        event.preventDefault();
       
    });
});

function chart1(diemkem,diemtb,diemkha,diemgioi)
{
var container = document.getElementById('chart-area');
var data = {
    categories: ['Tỉ lệ điểm'],
    series: [
        {
            name: 'Khá',
            data: diemkha
           
        },
        {
            name: 'Trung Bình',
            data: diemtb
        },
         {
            name: 'Yếu',
            data: diemkem
        },
         {
            name: 'Giỏi',
            data: diemgioi
        }

    ]
};
var options = {
    chart: {
        width: width1,
        height: height1,
        title: 'Thống kê tỷ lệ điểm '
    },
    tooltip: {
        suffix: '%'
    },
      legend: {
        align: 'bottom'
    }
};
var theme = {
    series: {
        colors: [
            'red','orange','blue','green'
        ]
    }
};

// For apply theme

// tui.chart.registerTheme('myTheme', theme);
// options.theme = 'myTheme';

tui.chart.pieChart(container, data, options);
}


function chart2(tlv,tlkv){
        var container = document.getElementById('chart-area-2');
var data = {
    categories: ['Tỉ lệ vắng'],
    series: [
        {
            name: 'Không vắng',
            data: tlkv
        },
        {
            name: 'Vắng',
            data: tlv
        }
    ]
};
var options = {
    chart: {
        width: width1,
        height: height1,
        title: 'Thống kê tỷ lệ vắng '
    },
    tooltip: {
        suffix: '%'
    },
      legend: {
        align: 'bottom'
    }
};
var theme = {
    series: {
        column:{
            colors: [
            'green','red'
        ]
        }
        
    }
};

// For apply theme

// tui.chart.registerTheme('myTheme', theme);
// options.theme = 'myTheme';

tui.chart.pieChart(container, data, options);
    }
</script>

