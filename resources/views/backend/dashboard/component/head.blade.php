    <base href="http://localhost/app/public/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Dashboard v.2</title>

    <link href="backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="backend/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="backend/css/animate.css" rel="stylesheet">
    <link href="backend/css/style.css" rel="stylesheet">
    <link href="backend/css/customize.css" rel="stylesheet">

    @foreach ($config['css'] as $key=>$val)
     {!!'<link href="'.$val.'" rel="stylesheet">'!!} 
    @endforeach
    <script src="backend/js/jquery-3.1.1.min.js"></script>