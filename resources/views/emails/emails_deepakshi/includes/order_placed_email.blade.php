			
 
<?php/*
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

 }*/
?>
                <tr><td height="10" style="font-size: 10px; line-height:10px;">&nbsp;</td></tr>
					
	
				<tr>
					
				 <td>
							<table border="0" width="360" align="center" cellpadding="0" cellspacing="0" class="container580">				
		
					 
					  <tr>
						<td align="left" style="color: #293038; font-size: 18px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 24px;" class="resize-text text_color">
						    <!-- ======= section header ======= -->
						  <br> 
                       
        				</td>
					  </tr>
					</table>
					</td>



					</tr>
					
				<tr><td height="10" style="font-size: 10px; line-height:10px;border-top:1px solid #ccc">&nbsp;</td></tr>
				 
					    <div>
   	  <h2 style="text-align: center;"><b> dd</h2>
   </div>
				<tr>
				<td>
				  <table border="0" width="360" align="center" cellpadding="0" cellspacing="0" class="container580">				
				   <tr>
				  <td style="font-family: 'Open Sans', sans-serif; font-size: 15px;">
				   <label style="color: #293038; font-family: 'Open Sans Semibold', sans-serif;  " > Customer Details:</label>
					<p> <?php echo @$customer_details[0]["first_name"]." ".@$customer_details[0]['last_name'];?><br>
                     {{ @$customer_details[0]['email'] }}<br>
                     {{ @$customer_details[0]['phone'] }}</p>
				  </td>
				</tr>
				</table>
				 </td>



					</tr>
				 
					 
					
                 <tr  style="border-top:1px solid #cccc">
				   <td>
				     <table border="0" bgcolor="#f7f7f7" width="380" align="center" cellpadding="0" cellspacing="0" class="container580" style="font-family: 'Open Sans', sans-serif; font-size: 14px;padding: 0 10px;">
					    <tr>
						   <th align="left" height="40" valign="middle" style="border-bottom: solid 1px #ccc;" >Item</th>
						   <th align="center" height="40" valign="middle" style="border-bottom: solid 1px #ccc;" >Price</th>
						   <th align="center" height="40" valign="middle"  style="border-bottom: solid 1px #ccc;">Quantity</th>
						   <th align="right" height="40" valign="middle"  style="border-bottom: solid 1px #ccc;" >Amount</th>
						</tr>
						 
					   
					   <tr>
						   <td align="left" height="30" valign="middle" >Meat</td>
						   <td align="center" height="30" valign="middle" >$23</td>
						   <td align="center" height="30" valign="middle" >2</td>
						   <td align="right" height="30" valign="middle" >$46</td>
						</tr> 
					 </table>
				   </td>
				 </tr>
				 <tr>
					 <td  >
										<table border="0" bgcolor="#f7f7f7"  align="center"  width="380" cellpadding="0" cellspacing="0"style="padding: 0 10px;" >

											<!--<?php 
                                             // foreach($payment_details as $payment_detail)
                                              //{
											?>
											<tr  >
												<td align="left" height="" valign="middle" style="color: #686b74; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 26px;border-top:1px solid #c5c5c5">
                                                   {{ @$payment_detail['title'] }}
                                                 												</td>
												<td align="right" height="" valign="middle" style="color: #686b74; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 26px;border-top:1px solid #c5c5c5">
													<?php echo //$currency_symbol;?>{{ @$payment_detail['value'] }}
												</td>
											</tr> 
										<?php //} ?>-->
                                           <tr  >
												<td align="left" height="" valign="middle" style="color: #686b74; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 26px;border-top:1px solid #c5c5c5">
                                                   Subtotal
                                                 												</td>
												<td align="right" height="" valign="middle" style="color: #686b74; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 26px;border-top:1px solid #c5c5c5">
													$46
												</td>
											</tr> 
											 <tr  >
												<td align="left" height="" valign="middle" style="color: #686b74; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 26px;border-top:1px solid #c5c5c5">
                                                   Tax
                                                 												</td>
												<td align="right" height="" valign="middle" style="color: #686b74; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 26px;border-top:1px solid #c5c5c5">
													10
												</td>
											</tr> 
										<tr  >
												<td align="left" height="" valign="middle" style="color: #686b74; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 26px;border-top:1px solid #c5c5c5">
                                                   <b>TOTAL</b>
                                                 												</td>
												<td align="right" height="" valign="middle" style="color: #686b74; font-size: 14px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 26px;border-top:1px solid #c5c5c5">
													<!--<?php //echo $currency_symbol;?>{{ @$order_total }}-->$50
												</td>
											</tr> 
					 
										</table>
									</td>
								</tr>
								
								
								<tr><td height="10" style="font-size: 10px; line-height:10px;border-top:1px solid #ccc">&nbsp;</td></tr>
				 
				
				
				
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