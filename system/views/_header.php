
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Geogram<?php if( isset( $title_append ) ): ?> - <?php echo $title_append ?><?php endif; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="/public/css/style.css">
  <link rel="stylesheet" href="/public/css/lightbox.css">
  <link rel="stylesheet" href="/public/css/jquery-ui.css">
</head>
<body<?php if( isset( $page ) ): ?> id="<?php echo $page ?>"<?php endif; ?><?php if( isset( $text_page ) ): ?> class="text_page"<?php endif; ?>>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

<div id="header">
  <a href="/"><img src="/public/images/logo.png"></a>
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="/me/">My Photos</a></li>
    <li><a href="/search/">Search</a></li>
  </ul>
</div>

<div id="content">

  <div id="loader">
      <p>Preloading Images</p>
  </div>
<?php if ( isset( $title ) ): ?><h1><?php echo $title ?></h1><?php endif; ?>