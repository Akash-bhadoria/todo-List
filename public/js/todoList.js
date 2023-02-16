$(function () {
    showTodoListOnLoad();
});

let todoTable = $("#todoListTable").DataTable({
    searching: false,
    paging: false,
    ordering: false,
    info: false,
});

$("#showTask").click(() => {
    let show = $("#showTask").is(":checked");
    if (show) {
        $("#todoListTable").removeClass("d-none");
    } else {
        $("#todoListTable").addClass("d-none");
    }
});

function addTaskInList() {
    let taskValue = $("#taskValue").val();

    axios
        .post(link.add_task, { taskValue })
        .then((res) => {
            if (res.data.status == "success") {
                Swal.fire({
                    icon: "success",
                    title: res.data.message,
                    showConfirmButton: false,
                    timer: 1500,
                });
                showTodoListOnLoad();
            }
        })
        .catch((err) => {
            console.log(err);
        });
}

function showTodoListOnLoad() {
    axios
        .get(link.get_task)
        .then((res) => {
            showTodoListTable(res.data.data);
        })
        .catch((err) => {
            console.log(err);
        });
}

function showTodoListTable(data) {
    todoTable.clear().draw();
    data.forEach((item) => {
        let check =
            item.is_done == 0
                ? `<input type="checkbox"  id="completeTask" onclick="completeTask(${item.id})">`
                : `<input type="checkbox"  id="notCompleteTask" onclick="notCompleteTask(${item.id})" checked>`;
        let del = `<i class="bi bi-trash text-danger" onclick="deleteTask(${item.id})"></i>`;
        todoTable.row.add([
            check,
            item.todo_task,
            moment(moment(item.created_at)).fromNow(),
            del,
        ]);
    });
    todoTable.draw();
}

function deleteTask(id) {
    Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .post(link.delete_task, { id })
                .then((res) => {
                    Swal.fire({
                        icon: "success",
                        title: res.data.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    showTodoListOnLoad();
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
}

function completeTask(id) {
    axios
        .post(link.complete_task, { id })
        .then((res) => {
            Swal.fire({
                icon: "success",
                title: res.data.message,
                showConfirmButton: false,
                timer: 1500,
            });
            showTodoListOnLoad();
        })
        .catch((err) => {
            console.log(err);
        });
}

function notCompleteTask(id) {
    axios
        .post(link.not_complete_task, { id })
        .then((res) => {
            Swal.fire({
                icon: "success",
                title: res.data.message,
                showConfirmButton: false,
                timer: 1500,
            });
            showTodoListOnLoad();
        })
        .catch((err) => {
            console.log(err);
        });
}
