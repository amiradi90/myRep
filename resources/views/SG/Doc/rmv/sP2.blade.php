@foreach($result as $r)
    <div>
        <a id="partcode0">{{$r->partcode}}</a>
        <a id="partname0">*{{$r->partname}}</a>
        <br>
    </div>
@endforeach