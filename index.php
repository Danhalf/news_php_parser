<?php
      include_once('lib/curl_query.php');
      include_once('lib/simple_html_dom.php');

      $html = curl_get('https://www.ruptela.ua/novini/');
      $dom = str_get_html($html);

      $news = $dom->find(".news-item-wrap");
      

      foreach ($news as $new) {
         $link = $new->find('a.news-item', 0)->href;
         $img = $new->find('img', 0);
         $full_new = curl_get($link);
         $full_new_dom = str_get_html($full_new);
         $full_new_title = $full_new_dom->find('h1', 0);
         $full_new_text = $full_new_dom->find('.main-content p');
         $text = implode('', $full_new_text);
 
         echo "<h2 class='news-title'>" . $full_new_title . "</h2>" . "<div class='news-content'><img align='left' src='" . $img->src . "'>" . $text ."</div>";
      }
