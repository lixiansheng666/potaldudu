
<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <meta charset="utf-8">
    <meta name="description" content="">
    <title><?php wp_title('-', true, 'right'); ?></title>

    <!-- Bootstrap Core CSS -->
	<link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri(); ?>/css/404style.css">
		
		<script language="JavaScript">
			function dosearch() {
			var sf=document.searchform;
			var submitto = sf.sengine.value + escape(sf.searchterms.value);
			window.location.href = submitto;
			return false;
			}
		</script>
    <!-- Custom CSS -->
    
    <!-- Custom JS -->


    <!-- Custom Fonts -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />

</head>


