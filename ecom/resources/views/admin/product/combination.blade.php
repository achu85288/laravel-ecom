@if (isset($choice))
     <table class="table table-bordered aiz-table footable footable-10 breakpoint-xl" style="">
        <thead>
            <tr class="footable-header">
                <td class="text-center footable-first-visible" style="display: table-cell;">
                    Variant
                </td>
                <td class="text-center" style="display: table-cell;">
                    Variant Price
                </td>
                <td class="text-center" style="display: table-cell;">
                    Variant Mrp
                </td>
                <td class="text-center" data-breakpoints="lg" style="display: table-cell;">
                    SKU
                </td>
                <td class="text-center" data-breakpoints="lg" style="display: table-cell;">
                    Quantity
                </td>
                <td class="text-center footable-last-visible" data-breakpoints="lg" style="display: table-cell;">
                    Photo
                </td>
                <td class="text-center footable-last-visible" data-breakpoints="lg" style="display: table-cell;">
                    Action
                </td>
            </tr>
        </thead>
            <tbody>
                @php
                $counter =0;
                @endphp
                @foreach ($choice as $item)  
                @php
                $counter++;
                @endphp
                    <tr id="variation_row_{{$counter}}">
                        <td>
                          
                        @foreach ($item as $items)
                            @php
                                $itm = explode('~',$items);
                                if($itm[1] !='0'){
                                    echo $itm[1].'-';
                                }
                                
                                echo "<input type='hidden' value='$itm[2]' name='$itm[0][]' id='$itm[0]'>";
                            @endphp  
                            @endforeach 
                        </td>
                        <td style="display: table-cell;">
                            <input type="number"  name="attr_price[]"  min="0" step="0.01" class="form-control"  value="{{$price}}">
                        </td>
                        <td style="display: table-cell;">
                            <input type="number"  name="attr_mrp[]"  min="0" step="0.01" class="form-control"  value="{{$mrp}}">
                        </td>
                        <td style="display: table-cell;">
                            <input type="text" name="attr_sku[]" value="" class="form-control">
                        </td>
                        <td style="display: table-cell;">
                            <input type="number"  name="attr_qty[]" value="10" min="0" step="1" class="form-control" >
                        </td>
                        <td class="footable-last-visible" style="display: table-cell;">
                            <input type="file"  name="attr_image[]" class="form-control" >
                        </td>
                        <td class="footable-last-visible" style="display: table-cell;">
                            <button type="button" class="btn btn-danger btn-xs"  onclick ="remove_variation_div({{$counter}})" >Remove</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
    </table> 
@endif

<script>
    function remove_variation_div(id){
        $("#variation_row_"+id).remove();
    }
</script>