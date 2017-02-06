<?php

class BlogPost{

	//	Obje değerleri
	public $id;
	public $title;
	public $content;
	public $created_at;

	//	veritabanı bağlantısı için gerekli bilgiler
	//	@todo : ileride bu bilgileri ve bağlantıyı buradan alıp tüm sınıfların kullanabileceği ortak bir zemine taşımak gerekecektir
	protected $con;
	private $host = "localhost";
	private $dbname = "oop-blog";
	private $username = "root";
	private $password = "root";

	/*
		__construct ()

		Obje ayağa kaldırılırken çalıştırılan metod. Şu anda veritabanı bağlantısının açılıp sınıf içine atanması için kullanılıyor.
	*/
	public function __construct(){
		try{
			$this->con = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname.";charset=UTF8;", $this->username, $this->password);
		}catch (PDOException $e){
			die("Veritabani baglanti hatasi: ".$e->getMessage());
		}
	}

	/*
		__destruct ()

		Objenin işi bittiği zaman bağlantı objesini de silerek bağlantıyı kapatıyoruz
	*/
	public function __destruct(){
		$this->con = null;
	}

	/*
		initById (integer $id)

		Gönderilen $id değerli satırı veritabanından okur, yakaladığı satırın ilgili alanlarını, objenin ilgili alanlarına atar

		Bu sayede elimizdeki objeyi, veritabanından okuduğumuz satırın içerikleriyle doldurmuş ve kullanabilir duruma getirmiş oluruz
	*/
	public function initById($id){
		//	verilen ID'ye ait satırı veritabanından oku
		//	gelen bilgileri, şu anda içinde bulunduğumuz örneğin ilgili alanlarına yaz

		$postById = $this->con->query("SELECT * FROM posts WHERE id = ". $id)->fetchObject();

		$this->id = $postById->id;
		$this->title = $postById->title;
		$this->content = $postById->content;
		$this->created_at = $postById->created_at;
	}

	/*
		insert ( string $title, string $content )

		Belirtilen başlık ve içerik metinleri kullanılarak yeni bir kayıt eklenir.

		Ekleme yapıldıktan sonra yeni satırın id değeri obje içindeki id değerine eşitlenir ve kullanıma hazır hale getirilir

		@todo : $title ve $content dışarıdan verilmesi yerine direkt obje değerlerinden okunabilir, ayrıca kayıt işleminden sonra sadece id değerini güncellemek yerine initById ile tüm değerlerin alınması sağlanabilir. Şu anda created_at değeri objeye yansımıyor mesela.
	*/
	private function insert($title, $content){
		$add = $this->con->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
		$isAdded = $add->execute(array($title, $content));

		if($isAdded){
			$this->id = $this->con->lastInsertId();
			return true;
		}

		return false;
	}

	/*
		update ()

		Mevcut objenin güncel halindeki bilgileri kullanılarak veritabanının da güncellenmesi sağlanır

		Objenin kendi içindeki değerler kullanılır
	*/
	private function update(){
		$update = $this->con->prepare("UPDATE posts SET title = :titleRef, content = :contentRef WHERE id = :idRef");

		$isUpdated = $update->execute([
			"titleRef" => $this->title,
			"contentRef" => $this->content,
			"idRef" => $this->id,
			]);

		if($isUpdated)
			return true;

		return false;
	}


	/*
		save ( )

		Mevcut objenin içine atanan değerlerle kayıt edilmesi sağlanır.

		Obje normalde kayıtlı yani id değerine sahip bir objeyse güncelleme işlemi, id değerine sahip olmayan yani yeni oluşturulan boş bir objeyse yeni kayıt işlemi uygulanır
	*/
	public function save(){
		//	öncelikle obje içindeki id atanmış mı diye bakalım
		//	id atandıysa güncelleme, atanmadıysa yeni ekleme yapmamız gerekiyor
		if(!is_null($this->id) && !empty($this->id)){
			return $this->update();
		}
		else{
			return $this->insert($this->title, $this->content);
		}
	}

	/*
		getPosts ( string $orderBy, integer $count, integer $startFrom )

		Belirtilen sıralama (ekleme zamanına göre), adet ve kaçıncıdan itibaren olduğu (LIMIT için) bilgisiyle veritabanından ilgili satırlar okunur. Her post bir PDO objesi olacak şekilde, bir dizi içinde geri döndürülür.

		@todo : aslında burada geriye PDO objesini direkt döndürmek yerine, buradaki BlogPost sınıfından üretilmiş objeleri, id ile doldurup bir diziye atamak daha doğru olacaktır.
	*/
	public function getPosts($orderBy = "LAST", $count = 10, $startFrom = 0){
		// db tarafına bu bilgileri kullanarak sorgu göndereceğiz, gelen sonucu dışarı döndüreceğiz
		if($orderBy==="FIRST") $orderByAtQuery = "ASC";
		elseif($orderBy==="LAST") $orderByAtQuery = "DESC";
		else $orderByAtQuery = "DESC";

		$count = (int)$count;
		$startFrom = (int)$startFrom;

		//$posts = $this->con->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);;
		$posts = $this->con->query("SELECT * FROM posts ORDER BY created_at ".$orderByAtQuery." LIMIT ".$startFrom.", ".$count)->fetchAll(PDO::FETCH_OBJ);

		return $posts;
	}

	/*
		getAllPosts ( string $orderBy )

		Belirtilen sıralama (ekleme zamanına göre) bilgisiyle tüm satırları birer PDO objesi olarak dizi içinde döndürür

		@todo : buradaki objeler direkt PDO objesi yerine BlogPost objesine çevrilip döndürülse daha iyi olur.
	*/
	public function getAllPosts($orderBy = "FIRST"){
		// db tarafına bu bilgileri kullanarak sorgu göndereceğiz, gelen sonucu dışarı döndüreceğiz
		if($orderBy==="FIRST") $orderByAtQuery = "ASC";
		elseif($orderBy==="LAST") $orderByAtQuery = "DESC";
		else $orderByAtQuery = "DESC";

		$posts = $this->con->query("SELECT * FROM posts ORDER BY created_at ".$orderByAtQuery)->fetchAll(PDO::FETCH_OBJ);

		return $posts;
	}


	//	sınıf üstünden direkt çağırılabilecek, objeden bağımsız çalışmasını ya da sonuç üretmesini istediğimiz metodları static (sabit) olarak tanımlarız


	/*
		::find( integer $id )

		Sınıf adıyla direkt ilgili id değerine sahip satırla hazırlanmış bir obje döndürülebilmesi için oluşturulan statik fonksiyondur.

		Bu sayede herhangi bir değişkene BlogPost::find(1); ataması yapılarak 1 id'li satırın bir BlogPost objesine atanmış hali kullanıma hazır olarak geri döndürülür
	*/
	public static function find($id){
		$returnObj = new self;
		$returnObj->initById($id);
		return $returnObj;
	}


	/*
		::all ( string $orderBy[ "FIRST" || "LAST" ] )

		Dışarıdan sınıf adıyla doğrudan çağırıldığında, bir obje oluşturulup onun üstünden getAllPost metodu ile tüm kayıtların döndürülmesi sağlanır.
	*/
	public static function all($orderBy = "FIRST"){
		$selfObj = new self;
		return $selfObj->getAllPosts($orderBy);
	}

	/*
		::get ( string $orderBy, integer $count, integer $startFrom )

		Dışarıdan doğrudan sınıf adıyla çağırıldığında belirtilen aralıktaki kayıtların dizi olarak döndürülmesi sağlanır.
	*/
	public static function get($orderBy = "FIRST", $count = 10, $startFrom = 0){
		$selfObj = new self;
		return $selfObj->getPosts($orderBy, $count, $startFrom);
	}

}