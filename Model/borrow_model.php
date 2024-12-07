<?php

class borrow_model
{
    protected Database $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    function borrow_book($user_id, $book_id)
    {
        $st = $this->conn->db->prepare('INSERT INTO borrows (user_id,book_id) values (:user_id,:book_id)');
        $st->execute([
                'user_id' => $user_id,
                'book_id' => $book_id,
        ]);
    }

    function check_availability_bookQuantity($book_id)
    {
        $stmt = $this->conn->db->prepare('SELECT availability,book_quantity FROM books where book_id=:id');
        $stmt->execute(['id' => $book_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function user_borrowed_books($user_id)
    {
        $user_stmt = $this->conn->db->prepare('SELECT count(*) FROM borrows WHERE user_id=:user_id and status=:status');
        $user_stmt->execute(['user_id' => $user_id, 'status' => 'borrowed']);
        $br_result             = $user_stmt->fetchColumn();
        $_SESSION['br_result'] = $br_result;

        return $br_result;
    }


    function same_book_borrowed($book_id)
    {
        $count_borrowed_same_book = $this->conn->db->prepare('SELECT count(borrow_id) FROM borrows WHERE user_id=:id and book_id=:book_id and status=:status');
        $count_borrowed_same_book->execute(['id' => $_SESSION['id'], 'book_id' => $book_id, 'status' => 'borrowed']);
        $result_borrowed_same_book = $count_borrowed_same_book->fetchColumn();

        return $result_borrowed_same_book;
    }
}