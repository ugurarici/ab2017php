<?php

class Article
{

    public $title;
    public $content;

    //  tüm makalelelri getirmek
    public static function all()
    {
        $rawData = file_get_contents(__DIR__."/../articles.json");
        return json_decode($rawData, true);
    }

    //  bir makalenin detayını getirmek
    public static function get($id)
    {
        $yeniBirObje = new Article;
        $yeniBirObje->initById((int)$id);

        return $yeniBirObje;
    }

    private function initById($id)
    {
        $ilgiliArticle = self::all()[$id];
        $this->title = $ilgiliArticle['title'];
        $this->content = $ilgiliArticle['content'];
    }

    //  yeni bir makale eklemek
    public function save()
    {
        //  mevcut obje içindeki title ve contenti kullanarak yenisini kaydedecek


    }

    //  makale silmek
}




