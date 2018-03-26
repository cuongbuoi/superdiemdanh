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
	<div class="row">
		<div class="col-md-6">
			     <div id="chart-area"></div>
		</div>
		<div class="col-md-6">
			
		<div id="chart-area-2"></div>
		</div>
	</div>
</div>

<script class='code-js' id='code-js'>
	var container = document.getElementById('chart-area');
var data = {
    categories: ['Tỉ lệ điểm'],
    series: [
        {
            name: 'Yếu',
            data: 46
        },
        {
            name: 'Trung Bình',
            data: 10
        },
         {
            name: 'Khá',
            data: 30
        },
         {
            name: 'Giỏi',
            data: 14
        }

    ]
};
var options = {
    chart: {
       	width: 500,
        height: 500,
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
            '#83b14e', '#458a3f', '#295ba0', '#2a4175', '#289399',
            '#289399', '#617178', '#8a9a9a', '#516f7d', '#dddddd'
        ]
    }
};

// For apply theme

// tui.chart.registerTheme('myTheme', theme);
// options.theme = 'myTheme';

tui.chart.pieChart(container, data, options);
</script>

<script class='code-js' id='code-js'>
	var container = document.getElementById('chart-area-2');
var data = {
    categories: ['Tỉ lệ vắng'],
    series: [
        {
            name: 'Không vắng',
            data: 46.02
        },
        {
            name: 'Vắng',
            data: 20.47
        }
    ]
};
var options = {
    chart: {
       	width: 500,
        height: 500,
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
        colors: [
            '#83b14e', '#458a3f', '#295ba0', '#2a4175', '#289399',
            '#289399', '#617178', '#8a9a9a', '#516f7d', '#dddddd'
        ]
    }
};

// For apply theme

// tui.chart.registerTheme('myTheme', theme);
// options.theme = 'myTheme';

tui.chart.pieChart(container, data, options);
</script>