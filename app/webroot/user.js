var User = {
    initIndex: function() {
        $('.action-delete').click(function(){
            var ans = confirm($(this).attr('title') + "?");
            if (ans) {
                $.post("/user/deleteUser", {id: $(this).attr('id')}, function(){
                    window.location = "/user/index";
                });
            }
        });

        $('.action-edit').click(function(){
            var ans = confirm($(this).attr('title') + "?");
            if (ans) {
                window.location = "/user/info?id=" + $(this).attr('id');
            }
        });
    }
};