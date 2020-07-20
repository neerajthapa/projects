@include('emails.email_header')				
 
 

 						<tr>
									<td align="left" style="color: #555454; font-size: 18px; font-family: 'Open Sans', sans-serif; mso-line-height-rule: exactly; line-height: 20px;text-align:center" class="resize-text text_color">
										
						 	<!-- ======= section header ======= -->
						 	   <?php echo $email_body;?> 
                            
							
					 
        				</td>
					</tr>
					 


 


                @include('emails.includes.order_placed_emails')	
 



 <tr><td height="10" style="font-size: 10px; line-height:10px;">&nbsp;</td></tr>
					 
					
@include('emails.email_footer')	