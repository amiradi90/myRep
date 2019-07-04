<head>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <script>
        $(document).ready(function () {
            $('.pagination a').on('click', function (e) {
                console.log('link clicked');
                e.preventDefault();
                var url = $(this).attr('href');
                $.get(url, function (data) {
                    $('#tblSP').html(data);
                });
            });
        });
    </script>
</head>
<html>

<div id="divPs">
    <table id="tblSP" class="table-bordered table-striped table-hover table-responsive">
        @foreach($result as $p)
            <tr class="" style="">
                <td class=""><a href="#" onclick="return addPartcode(this.text)"> {{$p->partcode}} </a></td>
                <td class="divPartPrice"> ({{$p->partname}})</td>
                <td class="price0">{{number_format($p->price,0)}}</td>
            </tr>
        @endforeach
    </table>
    {{ $result->links() }}
</div>
</html>

<script>

</script>


{{--<script>--}}
{{--$('.pagination a').on('click', function (e) {--}}
{{--e.preventDefault();--}}
{{--var url = $(this).attr('href');--}}
{{--$.get(url, function (data) {--}}
{{--$('#divPs').html(data);--}}
{{--});--}}
{{--});--}}
{{--</script>--}}

