$(document).ready(function(){
    $(".cboChonHP").change(function(){
        var hocphan = $(".cboChonHP").val();
        $.post("loadLopHocPhan.php", {hocphan: hocphan}, function(data){
            $(".cboChonLHP").html(data);
        })
    })
})