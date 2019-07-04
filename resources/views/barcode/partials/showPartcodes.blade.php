@role('admin')
<style>
    .admin {
        opacity: 1 !important;
    }
</style>
@endrole
<div>
    ({{$query}})
</div>
<div id="divPs">
    <table id="tblSP" class="">
        <thead>
        <tr class="thSP">
            <td>کد کالا</td>
            <td onclick="fnSortByRemain()" style="color: red;">نام کالا</td>
            <td></td>
            <td>$</td>
            <td>ناشر</td>
            <td>گروه</td>
        </tr>
        </thead>
        <tbody id="tbodySP">
        @foreach($result as $p)
            <tr class="trSp" onclick="$('.trSp').css('background-color','');$(this).css('background-color','#9EFFEC')">
                <td class="divPartcode"><a href="#" onclick="return addPartcode1(this.text,{{$p->serial}})">{{$p->partcode}}</a></td>
                <td class="divPartname" style="text-align: right;
                @if($p->remain>0)
                        color:red;
                @endif
                        ">
                    {{--<span @if(isset($p->remain) && $p->remain>0)style="color: red;"@endif>--}}

                    ({{$p->partname}})


                    {{--</span> --}}
                </td>
                <td class="divRemain" style="color: #0310ff;">
                    {{--@hasanyrole('admin')--}}
                    {{--@if(isset($p->remain))--}}
                    <span class="admin" style="opacity: 0">
                        {{number_format($p->remain,0)}}
                    </span>
                    {{--@endif--}}
                    {{--@endhasanyrole--}}
                </td>
                <td class="price0">
                    {{number_format($p->price,0)}}
                </td>
                <td class="publisher0" style="font-size:10px;max-width:35px;overflow-x:hidden;text-align:right">
                    {{$p->publisher}}</td>
                <td >{{$p->grp}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{--{{ $result->links() }}--}}
</div>



