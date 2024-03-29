<?php

class Database
{
    private string $host = "bmyjigjmtjn6nwu6kuvi-mysql.services.clever-cloud.com";
    private string $port = "3306";
    private string $dbName = "bmyjigjmtjn6nwu6kuvi";
    private string $user = "ubqarzb7qyde2wx9";
    private string $password = "jk0IUxU77ncSG2Pg1aFS";
    private string $connection_uri = "mysql://ubqarzb7qyde2wx9:jk0IUxU77ncSG2Pg1aFS@bmyjigjmtjn6nwu6kuvi-mysql.services.clever-cloud.com:3306/bmyjigjmtjn6nwu6kuvi";
    private string $dsn;
    private PDO $pdo;

    public function __construct()
    {
        $this->dsn = "mysql:host=$this->host;dbname=$this->dbName";
        $this->pdo = new PDO($this->dsn, $this->user, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function checkUser(string $userEmail): bool
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ "SELECT id FROM user WHERE email = :email;");
        $stmt->execute(['email' => $userEmail]);

        return $stmt->rowCount() == 1;
    }

    public function getPassword(string $userEmail): string
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ "SELECT password FROM user WHERE email = :email;");
        $result = $stmt->execute(['email' => $userEmail]);

        if (!$result) return false;

        return $stmt->fetch()['password'];
    }

    public function createUser(string $fName, string $lName, string $email, string $password, DateTime $gdpr)
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'INSERT INTO user(first_name, last_name, email, password, gdpr) VALUE (:fName, :lName,:email,:password,:gdpr)');
//        $stmt->bindValue('gdpr', strtotime(date('Y-m-d',$gdpr->getTimestamp())), PDO::PARAM_INT);
        return $stmt->execute([
            'fName' => $fName,
            'lName' => $lName,
            'email' => $email,
            'password' => $password,
            'gdpr' => date('Y-m-d', $gdpr->getTimestamp()),
        ]);
    }

    public function getUser(string $email)
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ "SELECT * FROM user WHERE email = :email");
        $result = $stmt->execute(['email' => $email]);

        if (!$result) return false;

        return $stmt->fetch();
    }

    public function getProducts(int $category = 0): array|false
    {
        $stmt = null;
        $result = null;
        if ($category == 0) {
            $stmt = $this->pdo->prepare(/** @lang MySQL */ "SELECT id, title, price, unit, category, short_text FROM product WHERE available = TRUE");
            $result = $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare(/** @lang MySQL */ "SELECT id, title, price, unit, category, short_text FROM product WHERE category = :category AND available = TRUE");
            $result = $stmt->execute(['category' => $category]);
        }

        if (!$result) return false;

        return $stmt->fetchAll();
    }

    public function getProduct(int $productId)
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ "SELECT p.id             AS product_id,
       p.title          AS title,
       p.price          AS price,
       p.unit           AS unit,
       p.stock          AS stock,
       p.category       AS category_id,
       p.product_detail AS product_detail,
       c.name           AS category
FROM product p
         JOIN category c ON c.id = p.category
WHERE p.id = :id;");
        $result = $stmt->execute(['id' => $productId]);

        if ($stmt->rowCount() == 1)
            return $stmt->fetch();
        else
            return false;
    }

    public function getCategories()
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'SELECT * FROM category;');
        $result = $stmt->execute();
        if (!$result) return false;
        return $stmt->fetchAll();
    }
}
