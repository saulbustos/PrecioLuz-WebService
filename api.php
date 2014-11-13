<?PHP

$fecha = date('Y-m-d H:i:s');
$nuevafecha = strtotime ( '+600 second' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );

$year=substr($nuevafecha,0,4);
$month=substr($nuevafecha,5,2);
$day=substr($nuevafecha,8,2);

$archivo="http://www.omie.es/informes_mercado/AGNO_".$year."/MES_".$month."/TXT/INT_PBC_EV_H_1_".$day."_".$month."_".$year."_".$day."_".$month."_".$year.".txt";

$url1="http://www.omie.es/aplicaciones/resultados_mercado_moviles/ambito/ejecutaMovil.jsp?codigo=DiarioPrecMD&fechaWeb=0&sesion=1";
$url2="http://www.omie.es/aplicaciones/resultados_mercado_moviles/ambito/ejecutaMovil.jsp?codigo=DiarioPrecMD&fechaWeb=-1&sesion=1";


$res=file_get_contents($archivo);

$precios=extrae($res,'Precio marginal en el sistema espa','\n');

$precios=explode(';',$precios);


$media=0;
$total="";

$fp = fopen('data.txt', 'w');
for ($i=1;$i<25;$i++){
	$precios[$i]=$precios[$i]/1000;
	if (strlen($precios[$i])<5) $precios[$i].="0";
	$media=$media+$precios[$i];
	$total.=str_replace(" ","",$precios[$i]."--");
}
$total=trim(substr($total,0,strlen($total)-2));
fwrite($fp,$total);
fclose($fp);


function extrae($cadena,$inicio,$fin){
    $tmp=explode($inicio,$cadena);
    $tmp2=explode($fin,$tmp[1]);
    return trim(str_replace("\r","",str_replace("\n","",$tmp2[0])));

}



?>

