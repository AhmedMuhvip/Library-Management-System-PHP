<?php

class createbook_model
{
    protected Database $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function createBook($book_name, $author, $published_at, $category, $book_quantity)
    {
// Prepare the SQL statement
        $stmt = $this->conn->db->prepare('
INSERT INTO books(book_name, author, category, published_at,book_quantity)  
VALUES (:book_name, :author, :category, :published_at,:book_quantity)');

// Execute with bound parameters
        $row = $stmt->execute([
                'book_name'     => $book_name,
                'author'        => $author,
                'category'      => $category,
                'published_at'  => $published_at,
                'book_quantity' => $book_quantity,
        ]);

        return $row;
    }
}