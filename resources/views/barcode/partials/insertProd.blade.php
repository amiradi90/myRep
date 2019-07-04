@foreach($result as $p)
    <tr class="trLast" style=";"
        onclick="$('.trLast').children().css('background-color','');
        // $(this).find('#rmv,#insCnt,#insPrice,#insBarcode,#insPartcode,.barcode0,#insPartname,#insRow').css('background-color','#5B89FF')
">
        {{--<td class="partref0" id="partref0" style="display: none">{{$p->partref}}</td>--}}
        <td id="insRow" class="radif example-screen"></td>
        <td id="insBarcode" class="barcode0" id="barcodebarcode0" style="text-align: center;margin:0 auto;padding:0"
        >
            <div id="barcodeTarget2" class="barcodeTarget example-screen" style="overflow: hidden !important;" ></div>
            <span>{{$p->partname}}</span>
{{--            <span>{{$p->partcode}}</span>--}}
        </td>
        {{--<td id="insPartcode" class="partcode0" style="">{{$p->partcode}}</td>--}}
        <td id="insPartname" class="partname0 example-screen" id="partname0" style="width: 50px !important;">{{$p->partname}}</td>
        <td id="insCnt" class=""><input type="number" min="1" style="width: 50px;text-align: center" class=""></td>
        <td id="insPrice" class="example-screen">{{number_format($p->price,0)}}</td>
        <td id="rmv" style="color: red;font-weight: bold;width: 20px" onclick="rmv(this)" class="example-screen" >X</td>
        {{--<td class="grp0 form-control-sm">{{$p->grp}}</td>--}}
        {{--<td class="price0 form-control-sm">--}}
            {{--{{number_format($p->price,0)}}--}}
        {{--</td>--}}
    </tr>
@endforeach