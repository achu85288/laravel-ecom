

@foreach($result as $attr)
    <div class='form-group row gutters-5'>
        <div class='col-md-3'>
            <input type='text' class='form-control' readonly value={{$attr->product_attribute_name}}>
        </div>   
        
        <div class='col-md-8'>
            <select class='form-control select-multi' onchange="{{$attr->product_attribute_name}}_attr();" multiple='multiple' id={{$attr->product_attribute_name}} data-placeholder='Select {{$attr->product_attribute_name}}' name=attr_{{$attr->product_attribute_name}}[]  style='width: 100%;'>

            @foreach ($result2 as $item)
                @if ($item->product_attribute_id == $attr->id)
                <option value={{$item->id}}>{{$item->product_attribute_value}}</option>
                @endif 
            @endforeach
             </select>
        </div>    
   
    </div>
@endforeach
<button type="button" class="btn btn-xs btn-info" onclick="call()">Make Combinations</button>
<script>
    
    function {{$attr->product_attribute_name}}_attr() {
        var selectedOptions = []; var opt_val;
            $('#{{$attr->product_attribute_name}} option:selected').each(function(){
                opt_val = '{{$attr->product_attribute_name}}'+'~'+$(this).text()+'~'+$(this).val();
            selectedOptions.push(opt_val);
        });
        return selectedOptions;
    }
    function call()
    {
        var price = $("#unit_price").val();
        var mrp = $("#unit_mrp").val();
        var output = [];
        //var color = color_attr();
        @foreach($all_attr as $attr)
        if (typeof {{$attr->product_attribute_name}}_attr !== "undefined") {
           var {{$attr->product_attribute_name}} = {{$attr->product_attribute_name}}_attr();
         }else{
                var {{$attr->product_attribute_name}} = ['{{$attr->product_attribute_name}}'+'~0~0']; 
         }
            
        @endforeach
        var arr =[
            //color,
            @foreach($all_attr as $attr)
                {{$attr->product_attribute_name}},
            @endforeach
        ]
        //arr.splice(-1)
        let lastElement = arr[0];
        if(lastElement == ''){
             arr.shift();
            arr.push(['color~0~0']);
        }
        console.log(arr)
        detectCombinations(arr, output);
        printArray(output,price,mrp);
    }

    function detectCombinations(input, output, position=0, path=[]) 
    {
        if (position < input.length) {
            var item = input[position];
            for (var i = 0; i < item.length; ++i) {
                var value = item[i];
                path.push(value);
                detectCombinations(input, output, position + 1, path);
                path.pop();
            }
        } else {
            output.push(path.slice());
        }
    };


    function printArray(array,price='',mrp='') 
    {
  	    for (var i = 0; i < array.length; ++i) {
  	  	    array[i].join(' - ');
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            }
        });
        $.ajax({            
            url: "{{ route('ajax.choice')}}",
            method: 'post',
            data: {
                name: "choice",
                choice: array,
                price:price,
                mrp:mrp
            },
            success: function(response){
                $("#choice").html(response.get_choice); 
              // console.log(response) 
        }});                     
  	}
</script>
