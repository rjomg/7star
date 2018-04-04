function uploadFile(){

    $.getScript("./js/ajaxfileupload.js").done(function(){
        return "" == $("#fileinput").val() ? jAlert("请选择文件！", "提示框",
		function() {
			return false
		}) : ($("#fileinput_but").text("正在解析.."), $("#fileinput_but").attr("disabled", false), $.ajaxFileUpload({
			url: "ajax/ajax.php?action=memberinput",
			secureuri: false,
			fileElementId: "fileinput",
			dataType: "json",
			complete: function() {},
			success: function(data, status) {
				cgImport.GetImport(data),
				$("#fileinput").val(""),
				$("#fileinput_but").removeAttr("disabled"),
				$("#fileinput_but").text("提交")
			},
			error: function(data, status, e) {
				$("#fileinput_but").removeAttr("disabled"),
				$("#fileinput_but").text("提交")
			}
		})),false
    }).fail(function(){
        jAlert("加载文件失败，请重新提交！", "提示框",
        function() {
            return false;
        })
    });
}