var msgBox = function(message,type,callback){
	const box = `<div class="weikibox">
	<div class="weikihead">
		${type}
	</div>
	<div class="weikicontent">
		<div id="weikipopup_message">${message}</div>
		<div id="weikipopup_panel">
		<input class="btn" style="*width:80px" type="button" value="&nbsp;&nbsp;确定&nbsp;&nbsp;" id="weikipopup_ok">
		</div>
	</div>
	</div>`;
	$(document).find("body").append(box);
	const width = $(document).width();
	const height = $(document).height();
	const positionX = (width - 380) / 2;
	const positionY = (height - 198) / 3; //在三分之一的高度
	$(".weikibox").css("left",positionX + "px");
	$(".weikibox").css("top",positionY + "px");
	$(".weikibox").css("z-index","99999");
	$("#weikipopup_ok").click(function(){
		$(".weikibox").remove();
		if (typeof(callback) == "function") {
			callback();
		}
	});
};

function parseTxt(data) {
	const length = data.data.length;
	const cols = 12;
	const rows = length % cols == 0? parseInt((length / cols)) : parseInt(length / cols) +1;
	for(var i =0;i<rows;i++) {
		var row = '<tr>';
		for (var j = i*cols;j<i*cols+cols;j++) {
			const fh = (j >= cols) ? j % cols : j
			if (data.data[j]) {
				if (fh % 2==1) {
					row +=`<td class="fh">${data.data[j]}</td>`;
				} else {
					row +=`<td>${data.data[j]}</td>`;
				}
			} else {
				if (fh % 2==1) {
					row +=`<td class="fh">--</td>`;
				}else {
					row +=`<td>--</td>`;
				}
			}
		}
		row += '</tr>';
		$("#fileDetail").append(row);
		const lastCols = `<tr><td colspan="1">合计笔数</td><td colspan="2">${length}</td>
		<td colspan="1">合计金额</td><td colspan="8"></td></tr>`;
		$("#fileDetail").append(lastCols);
		$(".bottomForm").css("display","block");
	}
}
function parseTxt2(data) {
	const length = data.data.length;
	const cols = 6;
	var totalMoney = 0;
	const rows = length % 6 ==0? parseInt(length / cols) : parseInt(length / cols) +1;
	for (var i=0;i<rows;i++) {
		var row = '<tr>';
		for (var j=i*cols;j<i*cols+cols;j++) {
			if (data.data[j]) {
				row += '<td>'+data.data[j].number+'</td>';
				row += '<td class="fh">'+data.data[j].money+'</td>';
				totalMoney += data.data[j].money * 1;
			} else {
				row += '<td>--</td>';
				row += '<td class="fh">--</td>';
			}
		}
		row += '</tr>';
		$("#fileDetail").append(row);
	}
	const lastCols = `<tr><td colspan="1">合计笔数</td><td colspan="2">${length}</td>
		<td colspan="1">合计金额</td><td>${totalMoney}</td><td colspan="7"></td></tr>`;
	$("#fileDetail").append(lastCols);
	$(".bottomForm").css("display","block");
}

function uploadFile(){
    $.getScript("./js/ajaxfileupload.js").done(function(){
        return "" == $("#fileinput").val() ? msgBox("请选择文件！", "提示框",
		function() {
			return false
		}) : ($("#fileinput_but").text("正在解析.."), $("#fileinput_but").attr("disabled", false), $.ajaxFileUpload({
			url: "ajax/ajax.php?action=memberinput",
			secureuri: false,
			fileElementId: "fileinput",
			dataType: "json",
			complete: function() {},
			success: function(data, status) {
				$("#fileinput").val(""),
				$("#fileinput_but").removeAttr("disabled"),
				$("#fileinput_but").text("提交")

				if (data.type == 1) {
					$("#fileDetail").append('<tr class="soon_head"><td width="8%">号码</td><td width="8%">号码</td>'+
					'<td width="8%">号码</td><td  width="8%">号码</td><td width="8%">'+
					'号码</td><td width="8%">号码</td><td  width="8%">号码</td><td  width="8%">'+
					'号码</td><td width="8%">号码</td><td width="8%">号码</td><td  width="8%">号码</td><td' +
					 'width="8%">号码</td><td>号码</td></tr>');
					
					parseTxt(data);
				} else {
					$("#fileDetail").append('<tr class="soon_head"><td>号码</td><td>金额</td><td>号码</td><td>金额</td>'+
					'<td>号码</td><td>金额</td><td>号码</td><td>金额</td><td>号码</td><td>金额</td><td>号码</td><td>金额</td></tr>');
					parseTxt2(data);
				}
			},
			error: function(data, status, e) {
				$("#fileinput_but").removeAttr("disabled"),
				$("#fileinput_but").text("提交")
			}
		})),false
    }).fail(function(){
        msgBox("加载文件失败，请重新提交！", "提示框",
        function() {
            return false;
        })
    });
}


