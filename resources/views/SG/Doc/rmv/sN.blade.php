
<div id="divPs">
    <table id="tblSP" class="table-bordered table-striped table-hover table-responsive">
        @foreach($result as $p)
            <tr class="" style="">
                {{--<td class=""></td>--}}
                <td class=""><a href="#" onclick="return addName(this.text)"> {{$p->partcode}} </a></td>
                <td class="divPartPrice"> ({{$p->partname}})</td>
                {{--<td class="tedad form-control-sm">--}}
                {{--{{$p->cnt}}--}}
                {{--<input class="inpTedad" onfocusout="countSum()" style="max-width:50px"--}}
                {{--type="text" class="form-control-sm" value="">--}}
                {{--</td>--}}
                {{--<td class="grp0 form-control-sm"></td>--}}
                <td class="price0">{{number_format($p->price,0)}}</td>
                {{--<td class="rmv form-control-sm" style="color: red;max-width:10px"--}}
                {{--onclick="rmv(this),countSum()">X--}}
                {{--</td>--}}
                {{--<td class="radif">1</td>--}}
            </tr>
        @endforeach
    </table>
</div>

