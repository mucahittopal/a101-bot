# PHP A101-bot
A101 zincir marketlerinin online ortamdaki ürünlerini JSON çıktısı alarak kullanabilirsiniz.


<h1>Başarılı Durum</h1>

Sonuç verisi <b>başarılı</b> olduğu taktirde oluşacak çıktı verisi şöyledir;

<h2>JSON</h2>

<pre> 
{"ok":
  [{
    "link":"/market/cafex-kahve-2-si-1-arada-12-g/",
    "title":"Cafex Kahve 2'si 1 Arada 12 G",
    "fiyat":"0,40 TL",
    "resim":"https://ayb.akinoncdn.com/products/2019/02/04/1835/37ad2e12-f082-4b8d-96d5-bd3f420d543e_size470x470_quality60_cropCenter.jpg",
    "hash_id":"d3e3a59b23bce0ee0bcc24c54e1551f1"
  }
]}
</pre>


<h2>Array</h2>

<pre> 
  Array
  (
      [ok] => Array
          (
              [0] => Array
                  (
                      [link] => /market/cafex-kahve-2-si-1-arada-12-g/
                      [title] => Cafex Kahve 2&#39;si 1 Arada 12 G
                      [fiyat] => 0,40   TL
                      [resim] => https://ayb.akinoncdn.com/products/2019/02/04/1835/37ad2e12-f082-4b8d-96d5-bd3f420d543e_size470x470_quality60_cropCenter.jpg
                      [hash_id] => d3e3a59b23bce0ee0bcc24c54e1551f1
                  )
          )
  )
</pre>


<h1>Başarısız Durum</h1>

Sonuç verisi <b>başarısız</b> olduğu taktirde oluşacak çıktı verisi şöyledir;

<h2>JSON</h2>

<pre> 
  {"error":"Ürünler Bulunamadı."}
</pre>


<h2>Array</h2>

<pre> 
  Array
  (
      [error] => Ürünler Bulunamadı.
  )
</pre>
