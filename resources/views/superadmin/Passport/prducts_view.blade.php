@if(isset($edit) && $edit == 'edit')
   @foreach($products as $k => $product)

      <tr>
         <td>
            <input type="hidden" name="product_id[]" value="{{$product->id}}">
            <input type="text" class="form-control" value="{{$product->title}}" placeholder="Product Name" readonly>
            <!-- <input type="text" name="product_name[]" class="form-control" value="" placeholder="Product Name" > -->
         </td>
         <td><input type="number" name="quantity[]" class="form-control" value="{{$quantitys[$k]}}" placeholder="Quantity" ></td>
         <td><label class="mt-1 ml-3"><a href="javascript:void(0);" class="text-danger" onclick="remove_products(this,'{{$product->id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></label></td>
      </tr>
   @endforeach
@else
   <tr>
      <td>
         <input type="hidden" name="product_id[]" value="{{$products->id}}">
         <input type="text" class="form-control" value="{{$products->title}}" placeholder="Product Name" readonly>
         <!-- <input type="text" name="product_name[]" class="form-control" value="" placeholder="Product Name" > -->
      </td>
      <td><input type="number" name="quantity[]" class="form-control" placeholder="Quantity" ></td>
      <td><label class="mt-1 ml-3"><a href="javascript:void(0);" class="text-danger" onclick="remove_products(this,'{{$products->id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></label></td>
   </tr>
      
@endif