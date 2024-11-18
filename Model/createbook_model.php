<?php

class createbook_model
{
    protected Database $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function createBook($book_name, $author, $published_at, $category)
    {
// Prepare the SQL statement
        $stmt = $this->conn->db->prepare('
INSERT INTO books(book_name, author, category, published_at)  
VALUES (:book_name, :author, :category, :published_at)');

// Execute with bound parameters
        $row = $stmt->execute([
                'book_name'    => $book_name,
                'author'       => $author,
                'category'     => $category,
                'published_at' => $published_at,
        ]);

        return $row;
    }
}