@extends('admin.layouts.master')
@section('title', '| Todos')
@section('css')
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h4>Todos</h4>
            </div>
            <div class="col-md-3">
                
            </div>
            <div class="col-md-3">
            
            </div>
        </div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li class="active">Todos</li>
        </ol>
    </section>
    <section class="content container-fluid">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>Success!</h4>
                {{ session()->get('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Todo List</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group" id="todos">
                            @if(count($todos) > 0)
                                @foreach($todos as $todo)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <p>{{ $todo->description }}</p>
                                    </label>
                                    <button type="button" class="btn btn-box-tool pull-right remove" data-id="{{ $todo->id }}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                @endforeach
                            @else
                            <div id="no-data">
                                <p class="text-danger">There is no task ...</p>
                            </div>  
                            @endif
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="description">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" id="add">Add</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </section>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $("#add").click(function(e) {
            e.preventDefault();
            var description = $("#description").val();
            $.ajax({
                url : "{{ route('todos.store') }}",
                method : "POST",
                data : {
                    "_token": "{{ csrf_token() }}",
                    "description": description,
                },
                success: function(data) {
                    var newTodo = "<div class='checkbox'>"
                                +"<label>"
                                    +"<input type='checkbox'>"
                                    +"<p>"+ data.description +"</p>"
                                +"</label>"
                                +"<button type='button' class='btn btn-box-tool pull-right remove' data-id='"+ data.id +"'>"
                                    +"<i class='fa fa-times'></i>"
                                +"</button>"
                            +"</div>";
                    $("#todos").prepend(newTodo);
                    $("#description").val("");
                    $("#no-data").remove();
                },
                error: function(jqXHR, exception) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        $(document).on("click", ".remove", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            $(this).closest(".checkbox").remove();
            $.ajax({
                url: "{{ url('admin/todos') }}/"+id,
                method: "POST",
                data: {
                    "_method": "delete",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data.msg);
                },
                error: function(jqXHR, exception) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        $(document).on("click", "input[type=checkbox]", function() {
            var id = $(this).closest(".checkbox").find('.remove').attr('data-id');
            if(this.checked) {
                $.ajax({
                    url: "{{ url('admin/todos') }}/"+id,
                    method: "PUT",
                    data: {
                        "_method": "put",
                        "_token": "{{ csrf_token() }}",
                        "status": 1
                    },
                    success: function(data) {
                        console.log(data.msg);
                    },
                    error: function(jqXHR, exception) {
                        console.log(jqXHR.responseText);
                    }
                });
                $(this).closest(".checkbox").find('p').css("text-decoration", "line-through");
                var doneList = $(this).closest(".checkbox");
                $("#todos").append(doneList);
            }else{
                $.ajax({
                    url: "{{ url('admin/todos') }}/"+id,
                    method: "PUT",
                    data: {
                        "_method": "put",
                        "_token": "{{ csrf_token() }}",
                        "status": 0
                    },
                    success: function(data) {
                        console.log(data.msg);
                    },
                    error: function(jqXHR, exception) {
                        console.log(jqXHR.responseText);
                    }
                });
                $(this).closest(".checkbox").find('p').css("text-decoration", "none");
                var doneList = $(this).closest(".checkbox");
                $("#todos").prepend(doneList);
            }
        });
    });
</script>
@endsection