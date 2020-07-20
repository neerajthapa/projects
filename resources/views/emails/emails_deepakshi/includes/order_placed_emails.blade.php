			
 
<?php 
$order_details = @$details[0]['order_details'];
$currency_symbol = @\App\Setting::where('key_title','currency_symbol')->first(['key_value'])->key_value;
for($i=0;$i<sizeof($order_details);$i++)
 {
 	$type = $order_details[$i]['type'];
 	if($type == 'customer_details')
 	{
 		$customer_details = $order_details[$i]['data'];
 	}

 	if($type == 'items')
 	{
 		$items = $order_details[$i]['data'];
 		$items_sub_total = $order_details[$i]['sub_total'];
 	}

 	 	if($type == 'order_basic_details')
 	{
 		$order_basic_details = $order_details[$i]['data'];
 	 
 	}


 	if($type == 'payment_details')
 	{
 		$order_total = $order_details[$i]['order_total'];
 		$payment_details = $order_details[$i]['data'];
 	 
 	}

 	 if($type == 'store_details')
 	{
 		$store_details = $order_details[$i]['data'];
 	 
 	}


 	 if($type == 'delivery_address')
 	{
 		$delivery_address = $order_details[$i]['data'];
 	 
 	}

 } 
?> 
					
	
				<tr>
					
				 <td>
							<table border="0" width="360" align="center" cellpadding="0" cellspacing="0" class="container580" >				
		
					 
					  <tr>
						<td align="left" style="color: #293038; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 14px;" class="resize-text text_color">
						    <!-- ======= section header ======= -->
						  <br> 
                       
        				</td>
					  </tr>
					</table>
					</td>



					</tr>
					</table>
					
					<table  width="450" align="center" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="container590"style=" border-top:1px solid #e2e2e2;" >
				<tr bgcolor="#f7f7f7" > 
				 
				 
				 <td > 
   	  <h4 style="text-align: left;font-family: 'Open Sans', sans-serif;padding:0px 15px;color:#555454;line-height:8px;">Your Order Details </h4>
     <hr style="width:92%;border:1px solid #e2e2e2">
				 </td></tr>
					  
                 <tr  style="border-top:1px solid #cccc;padding:5px 10px;" bgcolor="#f7f7f7">
				   <td>
				     <table border="0" bgcolor="#f7f7f7" width="430" align="center" cellpadding="0" cellspacing="0" class="container580" style="font-family: 'Open Sans', sans-serif; font-size: 14px;padding: 0 10px;">
					    <tr>
						   <th align="left" height="40" valign="middle" style="border-bottom: solid 1px #ccc;" >Item</th>
						   <th align="center" height="40" valign="middle" style="border-bottom: solid 1px #ccc;" >Price</th>
						   <th align="center" height="40" valign="middle"  style="border-bottom: solid 1px #ccc;">Quantity</th>
						   <th align="right" height="40" valign="middle"  style="border-bottom: solid 1px #ccc;" >Amount</th>
						</tr>
						 
					   
					 <?php foreach($items as $item) { ?>
						<tr>
						   <td align="left" height="30" valign="middle" >{{ @$item['item_title'] }}</td>
						   <td align="center" height="30" valign="middle" ><?php echo $currency_symbol;?>16</td>
						   <td align="center" height="30" valign="middle" >{{ @$item['order_item_quantity'] }}</td>
						   <td align="right" height="30" valign="middle" ><?php echo $currency_symbol; ?>{{ @$item['item_price'] }}</td>
						</tr> 
					   <?php } ?>
					 </table>
				   </td>
				 </tr>
				 <tr bgcolor="#f7f7f7" style="padding:5px 10px;">
					 <td  >
										<table border="0" bgcolor="#f7f7f7"  align="center"  width="430" cellpadding="0" cellspacing="0"style="padding: 0 10px;" >

											 
											 
											 <?php 
                                              foreach($payment_details as $payment_detail)
                                              {
											?>
											<tr  >
												<td align="left" height="" valign="middle" style="color: #686b74; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 26px;border-top:1px solid #c5c5c5">
                                                   {{ @$payment_detail['title'] }}
                                                 												</td>
												<td align="right" height="" valign="middle" style="color: #686b74; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 26px;border-top:1px solid #c5c5c5">
													<?php echo $currency_symbol;?>{{ @$payment_detail['value'] }}
												</td>
											</tr> 
										<?php  } ?>
										
										
                                      
					 
										</table>
									</td>
								</tr>
								
								
								<tr bgcolor="#f7f7f7" style="padding:5px 10px;"><td height="10" style="font-size: 10px; line-height:10px; ">&nbsp;</td></tr>
				 
				</table>
				<table  width="450" align="center" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="container590" >
				
				
								<!--<tr   >
				<td>
				  <!--<table border="0"  align="center" width="380"cellpadding="0" cellspacing="0" class="container580">	
<tr >
				  <td style="font-family: 'Open Sans', sans-serif; font-size: 15px;" align="left">
				   <label style="color: #293038; font-family: 'Open Sans Semibold', sans-serif;  " > Pickup Address :</label>
		
		   {{ @$store_details[0]['address'] }}
				  </td>
			 
				  <td style="font-family: 'Open Sans', sans-serif; font-size: 15px;" align="right">
				   <label style="color: #293038; font-family: 'Open Sans Semibold', sans-serif;  " > Delivery Address :</label>
				{{ @$delivery_address[0]['address_line1'] }} {{ @$delivery_address[0]['address_line2'] }}
				{{ @$delivery_address[0]['city'] }} {{ @$delivery_address[0]['state'] }}
				{{ @$delivery_address[0]['country'] }} {{ @$delivery_address[0]['pincode'] }}
				  </td>
				</tr>
				</table>
				 </td>



					</tr>-->