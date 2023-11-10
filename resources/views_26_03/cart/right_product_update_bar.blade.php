<?php  $qty = 0;$price=0.00;  ?>
<table class="table table-borderless">
    <?php if($word_ranges) { ?>
    <tr>
        <td colspan="2">Word range:</td>
    </tr>
    <?php foreach($word_ranges as $word_range) { ?>
    <tr>
        <td>{{ $word_range->word_range_title }}</td>
        <td><b>AED {{ $word_range->price }}</b></td>
    </tr>
    <?php 
    $price +=$word_range->price;
    $qty++;}} ?>
    <?php if($addons) { ?>
    <tr>
        <td>Add Ons:</td>
        <td></td>
    </tr>
    <?php foreach($addons as $addon) { ?>
    <tr>
        <td>{{ $addon->addon_title }}</td>
        <td><b>AED {{ $addon->addon_price }}</b></td>
    </tr>
    <?php 
    $price +=$addon->addon_price;
    $qty++;
    }} ?>
    <tr>
        <td>Quantity:</td>
        <td>{{ $qty }}</td>
    </tr>
</table>


<hr>



<table class="table table-borderless">

    <tr>
        <td><b>Total:</b></td>
        <td class="text-right"><b class="orange-text">AED {{ number_format((float)$price, 2, '.', '') }}</b></td>
    </tr>
</table>


<div class="cart-btn-group">
       <a href="javascript:void(0)" class="btn btn-block add-cart-btn add-cart-btn-border" onclick="updateCart(this,0)">Update Cart <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></a>
</div>