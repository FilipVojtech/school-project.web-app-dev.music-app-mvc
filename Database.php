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

    /**
     * Checks if database can be reached and read
     * @return bool TRUE if DB is reached and read, FALSE otherwise
     */
    public function healthCheck(): bool
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'SELECT * FROM coding_technology');
        $result = $stmt->execute();
        return !($result == false);
    }

    /**
     * Get names and IDs of all technologies
     * @return array|false Array of technologies
     */
    public function getTechnologies(): array|false
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'SELECT id, name FROM coding_technology;');
        $result = $stmt->execute();

        if (!$result) return false;
        return $stmt->fetchAll();
    }

    /**
     * Checks if database can be reached and read
     * @param int $id ID of the technology
     * @return array|false Associative array with the result. False on fail
     */
    public function getTechnology(int $id): array|false
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'SELECT id, name, age, short_text, description, video_link, homepage, logo FROM coding_technology WHERE id=:id;');
        $result = $stmt->execute(['id' => $id]);

        if (!$result) return false;
        return $stmt->fetch();
    }

    /**
     * Get the PDF from the database for a specific technology
     * @param int $id ID of the technology
     * @return mixed The PDF in base64 encoded string or false if not found
     */
    public function getTechnologyPdf(int $id): mixed
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'SELECT name, instructions FROM coding_technology WHERE id=:id;');
        $result = $stmt->execute(['id' => $id]);

        if (!$result) return false;

        return $stmt->fetch();
    }

    /**
     * Uploads a PDF associated with a technology to the DB
     * @param string $file Base64 encoded file
     * @return bool True if successful, false if not
     */
    public function uploadTechnologyPdf(int $id, string $file): bool
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'UPDATE coding_technology SET instructions = :file WHERE id = :id');
        return $stmt->execute(['id' => $id, 'file' => $file]);
    }

    /**
     * Uploads a technology logo for a specific technology
     * @param int $id ID of the technology
     * @param string $file Base64 encoded string of the file
     * @return bool Result of the upload
     */
    public function uploadTechnologyLogo(int $id, string $file): bool
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'UPDATE coding_technology SET logo = :file WHERE id = :id');
        return $stmt->execute(['id' => $id, 'file' => $file]);
    }

    /**
     * Retrieves sessions for a certain technology
     * @param int $id Technology ID
     * @return bool|array Ordered array of sessions
     */
    public function getSessions(int $id): false|array
    {
        // CONCAT(duration, ' min') AS 'Duration',
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'SELECT DATE(start_time)                                                      AS \'Date\',
       TIME_FORMAT(start_time, \'%H:%i\')                                      AS \'Start\',
       TIME_FORMAT(ADDTIME(start_time, SEC_TO_TIME(duration * 60)), \'%H:%i\') as \'End\',
       room                                                                  AS \'Room\'
FROM sessions
WHERE technology_id = :id
GROUP BY start_time
ORDER BY start_time;');
        $result = $stmt->execute(['id' => $id]);

        if (!$result) return false;
        return $stmt->fetchAll();
    }

    /**
     * Get images for technology
     * @param int $id ID of the technology
     * @return false|array Array of base64 encoded images
     */
    public function getTechnologyImages(int $id): false|array
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'SELECT i.image_data as image_data, i.alt as alt FROM coding_technology_images cti JOIN images i on i.id = cti.image_id WHERE cti.technology_id = :id;');
        $result = $stmt->execute(['id' => $id]);

        if (!$result) return false;

        return $stmt->fetchAll();
    }

    /**
     * Upload images for technology
     * @param int $id ID of the technology
     * @param array $images Array of base64 encoded image files
     * @return bool Returns true if operation was successful, false otherwise
     */
    public function uploadTechnologyImages(int $id, array $images): bool
    {
        foreach ($images as $image) {
            $stmt = $this->pdo->prepare(/** @lang MySQL */ 'INSERT INTO images(image_data) VALUE (:image);');
            $stmt->execute(['image' => $image]);
            $lastId = $this->pdo->lastInsertId();
            $stmt = $this->pdo->prepare(/** @lang MySQL */ 'INSERT INTO coding_technology_images(technology_id, image_id) VALUE (:tech_id, :img_id);');
            $stmt->execute(['tech_id' => $id, 'img_id' => $lastId]);
        }

        return true;
    }

    /**
     * Gets the FAQ page question and answers
     * @return array|false Array of questions and answers
     */
    public function getQA(): array|false
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'SELECT question, answer FROM faq;');
        $result = $stmt->execute();

        if (!$result) return false;
        return $stmt->fetchAll();
    }

    public function getHPTechnologies(): array|false
    {
        $stmt = $this->pdo->prepare(/** @lang MySQL */ 'SELECT id, name, short_text, logo FROM coding_technology;');
        $result = $stmt->execute();

        if (!$result) return false;
        return $stmt->fetchAll();
    }
}
