@include('layout')

<div class="py-1">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="form-check mb-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="showTask">Show All Task
                    </label>
                </div>
                <hr>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" id="taskValue">
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-dark" onclick="addTaskInList()">ADD</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered d-none" id="todoListTable">
                    <thead>
                        <tr>
                            <th><i class="bi bi-card-checklist"></i></th>
                            <th><i class="bi bi-list-task"></i></th>
                            <th><i class="bi bi-hourglass-split"></i></th>
                            <th><i class="bi bi-trash text-danger"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@yield('content')
<script src="js/todoList.js"></script>
<script>
    var link = {
        add_task : '{{route('add_task')}}',
        get_task : '{{route('get_task')}}',
        delete_task : '{{route('delete_task')}}',
        complete_task : '{{route('complete_task')}}',
        not_complete_task : '{{route('not_complete_task')}}',
    };
</script>
@yield('scripts')