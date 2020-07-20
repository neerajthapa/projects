					<tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
					
					<!--<tr>
						<td align="center">
							
							<table border="0" align="center" width="200" cellpadding="0" cellspacing="0" bgcolor="27abc9" style="border-radius: 7px;" class="cta-button main_color">
								
								<tr><td height="13" style="font-size: 13px; line-height: 13px;">&nbsp;</td></tr>
								
								<tr>
									
	                				<td align="center" style="color: #ffffff; font-size: 16px; font-family: 'Montserrat', sans-serif; font-weight: 700;" class="cta-text">
	                					<!-- ======= main section button ======= --
	                					
		                    			<div style="line-height: 24px;">
			                    			<a href="" style="color: #ffffff; text-decoration: none;">GET APP</a> 
		                    			</div>
		                    		</td>
		                    		
	                			</tr>
								
								<tr><td height="13" style="font-size: 13px; line-height: 13px;">&nbsp;</td></tr>
							
							</table>
						</td>
					</tr>
					
					<tr><td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td></tr>-->
														
				</table>
			</td>
		</tr>
		
		<tr>
			<td>
				<table  width="450" align="center" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="container590" style="border-top:3px solid #494949;">
					 
					<tr><td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td></tr>
					
					<tr>
						<td align="center" style="color: #66717d; font-size: 14px; font-family: 'Questrial', sans-serif; line-height: 14px;" class="text_color">
							<!-- ======= section subtitle ====== -->
							
							
							 <?php @$email = @\App\Setting::where('key_title','email')->first(['key_value'])->key_value; ?>
										 
										 <a href="#"><p><i>{{@$email}}</i></p></a>
										 
										 	© {{ env("APP_YEAR")}} by {{ env("APP_NAME")}}
											
											<p>Address : 9237 Washington Road Mortan Grove IL 60053</p>
											
											
							<!--<div style="line-height: 22px;">
	        					
	        						
										 Any Issue ? feel free to contact us at <span style="color:#2baac8">{{ env("APP_URL") }}</span>
            						
	        					
							</div>-->
        				</td>
					</tr>
					
					<tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
					
				</table>
			</td>
		</tr>
		
		<tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
		
		<tr>
			<td>
				<table border="0" width="420" align="center" cellpadding="0" cellspacing="0" class="container590">
					
					<tr>
						
						<td align="center" style="color: #2baac8; font-size: 14px; font-family: 'Questrial', sans-serif; mso-line-height-rule: exactly; line-height: 30px;" class="text_color">
							<div style="line-height: 30px">
								
								<!-- ======= section text ======= -->
								
	        					
	        					
	        					
							</div>
        				</td>	
					</tr>
					
				</table>
			</td>
		</tr>
		
		<tr><td height="90" style="font-size: 90px; line-height: 90px;">&nbsp;</td></tr>
		
	</table>
	<!-- ======= end header ======= -->
	
	
</body>
</html>