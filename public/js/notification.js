$(function () {
    Echo.channel("add-todo").listen("addNewTodo", function (e) {
        console.log(e);
    });
});
