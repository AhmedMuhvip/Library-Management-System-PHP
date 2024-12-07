<?php

class bookmangement_model
{
    protected Database $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function get_pg_data($pageLimit, $offset)
    {
        $stmt = $this->conn->db->prepare("SELECT * FROM books LIMIT :pageLimit OFFSET :offset");
        $stmt->bindValue(':pageLimit', $pageLimit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public function count_book()
    {
        $records = $this->conn->db->query('SELECT count(*) FROM books');
        $count   = $records->fetchColumn();

        return $count;
    }
}