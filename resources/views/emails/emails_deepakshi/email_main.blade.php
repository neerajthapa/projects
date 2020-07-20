@include('emails.email_header')				
 
 

 						<tr>
									<td align="left" style="color: #555454; font-size: 18px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 20px;text-align:center" class="resize-text text_color">
										
						 	<!-- ======= section header ======= -->
							<p style="line-height: 25px;text-align: center;font-size: 15px;">
	        					   <?php echo $email_body;?> 
                            </p>
							
							 <h3>Hi, Yugal Kishore</h3>
							 <h3>Order Received</h3> 
							 <p style="font-size: 16px;">Order No #123 date 09/29/2018 Time 09:00 AM</p>
        				</td>
					</tr>
					 


 


                @include('emails.includes.order_placed_emails')	
 



 <tr><td height="10" style="font-size: 10px; line-height:10px;">&nbsp;</td></tr>
					 
					
@include('emails.email_footer')	