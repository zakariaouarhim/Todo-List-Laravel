<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <title>To-Do List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        
            
        
        <div class="container">
            <h1>To-Do List</h1>
            @if(Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif

            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
            @endif

            
            @php
            
            // Retrieve 'name' value from the session
            $name = session('name');
            @endphp

            @if(isset($name))
                <p>Welcome, {{ $name }}!</p>
            @endif
            @php
                $value = request()->cookie('name');
            @endphp

            <p>Cookie Value: {{ $value }}</p>

            <form action="submit" method="POST">
            @csrf    
                <input type="hidden" name="name" value="{{ $name }}">
                <input type="text" id="new-item" name="task" placeholder="Add new item...">
                <button type="submit">Add</button>
                
                
            </form>
            <span style="color: red">@error('task'){{ $message }} @enderror</span>

            @if($t_data->isEmpty())
            <p>No tasks found.</p>
            @else
            <ul id="list">
                @foreach($t_data as $todo)
                <li>
                    <input type="text" name="name" value="{{ $value }}" readonly  type=”hidden” style="display: none;">
                    

                    <input type="checkbox" name="cheked" id="item-1"@if ($todo->checked)
                        checked
                    @endif >
                    <span>@if ($todo->checked)
                        <s> {{ $todo->task }} </s>
                     
                    @else
                    {{ $todo->task }}@endif</span>
                    <time datetime="2023-04-28">{{ $todo->time_created }}</time>
                    <a href="{{ route('delete',['id'=>$todo->id]) }}">Delete</a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
        <script ></script>
    </body>
</html>
