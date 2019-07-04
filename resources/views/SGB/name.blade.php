<style>
    .tdBarcode {
        text-align: center;
        min-width: 115px;
        max-width: 300px;

    }
</style>
<div id="divPs">
    <table id="tblSP" class="table-bordered table-striped table-hover table-responsive">
        @foreach($result as $p)
            <tr class="" style="">
                <td class="tdId"><a href="{{'https://www.bahook.com/product/'.$p->id}}" target="_blank"
                                    onclick="return addName(this.text)"> {{$p->id}} </a></td>
                <td class="tdBarcode"> ({{$p->barcode}})</td>
                <td class="tdName">{{$p->name}}</td>
            </tr>
        @endforeach
    </table>
</div>

