<?PHP
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//setlocale(LC_ALL,"es_ES");
?>

<html>
<head>
<style type="text/css">
ul {
	width: 100%;
	color: black;
	list-style: none;
	padding-left: 0;
	text-align:center;
	font-family:verdana;
	margin:0;
}
li {
	padding: 10px;
	border-bottom: 1px solid black;
	border-top: 1px solid #3c3c3c;
	border-top-left-radius: 6px;
	border-top-right-radius: 6px;
	border-bottom-left-radius: 6px;
	border-bottom-right-radius: 6px;
}

h1 {	color:white;
	font-size:125%;
	}

a:link {
COLOR: white;
}
a:visited {
COLOR: white;
}
a:hover {
COLOR:#36FF3D ;
}
a:active {
COLOR: white;
}


</style>
</head>

<body>
<ul>
<li style='background: #292929;'><h1><img src='icon.png' width="90" height="90" style='vertical-align:middle;'/> Tu Consumo de Luz</h1></li>
</ul>
  <ul>
<?PHP

$fecha = date('Y-m-d H:i:s');
$nuevafecha = strtotime ( '+600 second' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );

$fecha=substr($nuevafecha,8,2)."/".substr($nuevafecha,5,2)."/".substr($nuevafecha,0,4);

$res=file_get_contents('data.txt');    
$res=explode('--',$res);
$media=0;
$max=0;
$min=500;

for ($i=0;$i<count($res);$i++){
	$media=$media+$res[$i];
	if ((float)$res[$i]>(float)$max) {
		$max=$res[$i];
	}
	
	if ((float)$res[$i]<(float)$min) {
		$min=$res[$i];
	}
}

$media=$media/24;
$media=round($media * 1000) / 1000;

echo "<li style='background:#292929;color:white'>$fecha - Precio m&aacute;ximo:".$max."&euro;<br> M&iacute;nimo:".$min."&euro; Media:".$media."&euro;</li>\n";



for ($i=0;$i<count($res);$i++){
        if ($res[$i]>($media+0.005)){
		//rojo
		$color="#ff3232";
	}else if ($res[$i]<($media-0.005)){
		//verde
		$color="#36FF3D";
	}else{
		//amarillo
		$color="#cece00";
	}
	if (strlen((String)$i)<=1) {
		$ho="0".$i.":00";
		if ($i!=9) $homas="0".($i+1).":00"; else $homas=($i+1).":00";
	}else{
		$ho=$i.":00";
		$homas=($i+1).":00";
	}
	echo "<li style='background:$color;'>Precio ".$ho." a ".$homas.": $res[$i] &euro;/kWh</li>\n";
}
?>
  </ul>
<ul>
<li style='background:#292929;color:white'><a href='http://www.omie.es/aplicaciones/resultados_mercado_moviles/ambito/ejecutaMovil.jsp?codigo=DiarioPrecMD'>Consultar otros d&iacute;as en la p&aacute;gina de OMIE</a></li>
<li style='background:#292929;color:white'><h1><a href='https://play.google.com/store/apps/details?id=com.apps.android.starblank'>Si te gusta esta App, no olvides votarla!<br><img src='googleplay.png' style='vertical-align:middle' width="60" height="60"/>  Haz Click aqu&iacute;</a></h1></li>
</ul>

</body>
</html>

