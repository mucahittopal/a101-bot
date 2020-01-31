<?php
  ini_set( 'max_execution_time', 59 * 60);
  set_time_limit(59 * 60);

  $siteURL='https://www.a101.com.tr/';

  function siteConnect($site,$url,$kategorimi=false)
  {
  	$tablo=[];
  	$ch = curl_init();
  	$hc = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36";
  	curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
  	curl_setopt($ch, CURLOPT_URL, $site.$url);
  	curl_setopt($ch, CURLOPT_USERAGENT, $hc);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$siteFull= curl_exec ( $ch ); 
  	curl_close($ch);

  	if($kategorimi){
  		preg_match_all('@<li class="main(.*?)</li>@si',$siteFull,$data);
  		for($i = 0; $i<count($data[0]); $i++)
  		{
  			preg_match_all('/href="(.*?)"/s', $data[0][$i], $matches);
  			preg_match_all('/title="(.*?)"/s', $data[0][$i], $matches_title);

  			$link=$matches[1][0];
  			$title=$matches_title[1][0];
  			$tablo[]=array($link,$title);
  		}	
  		return $tablo;
  	}else{
  		preg_match_all('@<div class="col-md-4 col-sm-6 col-xs-6 set-product-item">(.*?)<input@si',$siteFull,$data);
  		for($i = 0; $i<count($data[0]); $i++)
  		{
  			preg_match_all('/href="(.*?)"/s', $data[0][$i], $matches);
  			preg_match_all('/title="(.*?)"/s', $data[0][$i], $matches_title);
  			preg_match_all('@<span class="current">(.*?)</span>@si', $data[0][$i], $matches_fiyat);
  			preg_match_all('@src="https://ayb.akinoncdn.com/products/(.*?)"@si', $data[0][$i], $matches_resim);
  			$link=$matches[1][0];
  			$title=$matches_title[1][0];
  			$fiyat=$matches_fiyat[1][0];
  			$resim='https://ayb.akinoncdn.com/products/'.$matches_resim[1][0];
	  		$hash_id=md5($link.$resim.$title);
	  		$tablo[]=array('link'=>$link,'title'=>$title,'fiyat'=>$fiyat,'resim'=>$resim,'hash_id'=>$hash_id);
  		}
  	}	
  	return $tablo;
  }




  $tablo=[];
  $kategoriler=siteConnect($siteURL,'market/',true);
  foreach($kategoriler as $kat)
  {
  	$link=$kat[0]?$kat[0]:'market';
  	for($i = 1; $i<100000; $i++){
  		$tabloYeni=siteConnect($siteURL,$link.'/?page='.$i);
  		if(empty($tabloYeni)){
  			break;
  		}
  		$tablo=array_merge($tablo,$tabloYeni);
  	}
  }

  if(!empty($tablo)){
	  $Sonuc['ok']=$tablo;
  }else{
	  $Sonuc['error']='Ürünler Bulunamadı.';
  }
	
  print_r(json_encode($Sonuc));

  ?>
