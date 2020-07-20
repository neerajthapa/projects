<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns:v="urn:schemas-microsoft-com:vml">
<head>

	<!-- Define Charset -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<!-- Responsive Meta Tag -->
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

	<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
 

 
</head>

<body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	
	<!-- ======= main section ======= -->
	<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style=" background-size: 100% 100%; background-position: top center;" >
		
		<tr><td height="90" style="font-size: 90px; line-height: 90px;"></td></tr>
		
		<tr>
			<td>
				<table border="0" align="center" width="450" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="container590 bodybg_color">
					
					<tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
					
					<tr>
						<!-- ======= logo ======= -->
						<td align="center">
                            <?php @$business_logo = @\App\Setting::where('key_title','business_logo')->first(['key_value'])->key_value; ?>
						 
							<a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="114" border="0" style="display: block; width: 114px;" src="{{ env('APP_URL')}}/images/logo/{{ @$business_logo}}" alt="" /></a>
						</td>			
					</tr>
					
					<tr style=""><td height="35" style="font-size: 35px; line-height: 35px;border-bottom:3px solid #494949;">&nbsp;</td></tr>
					
					
					