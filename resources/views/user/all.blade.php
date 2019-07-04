<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
<script src="{{asset(url('js/jquery.min.js'))}}"></script>
<link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"/>--}}
<style>
    .tbl {
        text-align: center;
    }

    .tbl div {
        display: inline-block;
        margin: 20px auto;
    }

    .content {
        text-align: center;
        width: 60%;
        margin: 0 auto;
        /*height: 1000px;*/
    }

    .content li {
        display: inline-block;
        margin: 10px;
    }

    .box {
        width: 140px;
        height: 200px;
        /*max-height: 210px;*/
        background-color: navajowhite;
        overflow: auto;
    }

    input[type="text"] {
        font-size: 14px;
        /*width: 100px;*/
    }
</style>

<body>
<form id="user-form" method="post">
    @method('post')
    @csrf
    {{--@yield('table')--}}
    <div class="tbl">
        <div>
            <table border="1" class="table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>no</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <th></th>
                    <th><input id="name" type="text" class="form-control search"></th>
                    <th><input id="email" type="text" class="form-control search"></th>
                </tr>
                </thead>
                <tbody id="tbody">
                @foreach($users as $user)
                    <tr id="result">
                        <td>{{$user->id}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div id="paginate">
                {{ $users->links() }}

            </div>
        </div>
    </div>

</form>

</body>
</html>
<script>
    function func2(i,v) {

        console.log(i + ' ' + v);
        $.ajax({
            url: '/users/index2/search',
            method: 'get',
            // async: false,
            data: {clr: 0, p1: i, p2: v},
            // dataType:'json',
            success: function (data) {
                // $('#tbody').html(res);
                $("#tbody").replaceWith(data);
                $('#paginate').css('visibility', 'visible')

                // $('paginate').toggle();
                console.log(data);
            }
        });
    };
    $('.search').keypress(function (e) {

        if (e.keyCode == 13) {
            var i = this.id;
            var v = this.value;
            console.log(i + ' ' + v);
            if (v.length > 0) {
                $.ajax({
                    url: '/users/index2/search',
                    method: 'get',
                    // async: false,
                    data: {p1: i, p2: v},

                    success: function (res) {
                        // $('#tbody').html(res);
                        $("#tbody").replaceWith(res);
                        $('#paginate').css('visibility', 'hidden')
                        console.log(res);
                    }
                });
            }
            else {
                func2(i,v);
            }
        }
    });
</script>

{{--@yield('script')--}}
