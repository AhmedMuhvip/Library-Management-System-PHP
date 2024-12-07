<?php

require_once __DIR__.'/../Model/borrow_model.php';
require_once __DIR__.'/../Database.php';
if (isset($_GET['id'])) {
    session_start();
    $book_id                               = $_GET['id'];
    $conn_db                               = new Database();
    $borrow                                = new borrow_model();
    $result                                = $borrow->check_availability_bookQuantity($book_id);
    $br_result                             = $borrow->user_borrowed_books($_SESSION['id']);
    $_SESSION['br_result']                 = $br_result;
    $result_borrowed_same_book             = $borrow->same_book_borrowed($book_id);
    $_SESSION['result_borrowed_same_book'] = $result_borrowed_same_book;
    echo '<pre>';
    $book_quantity = $result['book_quantity']; //15
    echo $book_quantity;
    echo $_SESSION['id'];
    //Check If Availability is true so you can borrow
    if ($result['availability']) {
        if (($br_result < 3) && $result_borrowed_same_book < 1) {
            $borrow->borrow_book($_SESSION['id'], $book_id);
        }
        $borrows_count = $conn_db->db->prepare('SELECT count(*) from borrows where book_id=:id and status=:status');
        $borrows_count->execute([
                'id'     => $book_id,
                'status' => 'borrowed',
        ]);

        $borrow_result = $borrows_count->fetchColumn();
        echo '<br>';
        echo $borrow_result;
        echo '<br>';

        if ($borrow_result >= $book_quantity) {
            $availability = $conn_db->db->prepare('UPDATE books SET availability = 0 WHERE book_id = :id');
            $availability->execute([
                    'id' => $book_id,
            ]);
        }

        header('Location:/books');

    } else {
        echo "end";
        die();
    }
//    echo $number_books_br;

    // to can borrow you need user_id book_id
    // you might to make the book quantity decreased when anyone borrow the book
    //should make variable save quantity of books
    // you need to make Availability to false when quantity of books is zero
    //Make Session to can store the user id to use it when borrow system work


}

