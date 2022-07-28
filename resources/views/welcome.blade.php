<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Project</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">


</head>
<body data-token="{{ csrf_token() }}">
<br />
<div class="container">
    <div class="row">
        <div class="col-6">
        <form action="/task" method="post">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Task:</label>
                    <textarea name="task" id="task" class="form-control" cols="10" rows="3" required placeholder="Enter Task"></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Deadline (Optional)</label>
                        <input type="input" class="form-control" name="deadline" id="deadline" placeholder="Enter Deadline">
                    </div>  
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>                  
                    <button type="submit" class="btn btn-primary" style="margin-top:10px;">Submit</button>
                </div>
            </div>            
        </form>        
        </div>
        <div class="col-6">
        <table id="tasks"  class="table table-bordered table-striped">
                <thead>
                    <td><b>TASK</b></td>
                    <td><b>Deadline</b></td>
                    <td><b>COMPLETE</b></td>
                </thead>
                <tbody>
                @if($task)
                @foreach($task as $l)
                <tr>
                    <td>
                        @if( $l->updated_at)
                        <input type="checkbox" name="complete" id="complete" value="{{$l->id}}" checked disabled>
                        @else
                        <input type="checkbox" name="complete" id="complete" value="{{$l->id}}">
                        @endif
                        {{$l->task}}                
                    </td>
                    <td>{{$l->Deadline}}</td>
                    <td>                        
                        @if($l->updated_at)
                            {{date('F d, Y h:i A', strtotime($l->updated_at))}}
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>

    </div>   
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-12" style="margin-top:400px; margin-bottom:20px;">
                <div class="text-center">
                    <a href="/privacypolicy">Privacy Policy</a> |
                    <a href="/tos">Term of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<script>
    $(document).on("click", "#complete", function() {       

        var id = $(this).val();
        var token = $("body").attr("data-token");

        $.ajax({
            url: "/complete",
            method: "POST",
            data: {
                _token: token,
                id: id
            },
            dataType: 'JSON',
            success: function(response) {
                location.reload();

            }
        });

    });

</script>

</body>
</html>