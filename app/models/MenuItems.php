<?
namespace app\models;

require_once '../app/core/db.php';
use Core\DB;

class MenuItems
{
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function all()
    {
        $query = $this->db->query("SELECT * FROM menu_items");
        $menu_items = $query->fetchAll();
        return $menu_items;
    }

    public function find($id)
    {
        $query = $this->db->prepare("SELECT * FROM menu_items WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    public function create($data)
    {
        $query = $this->db->prepare("INSERT INTO menu_items (name, price, description, category_id) VALUES (:name, :price, :description, :category_id)");
        $query->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($data)
    {
        $query = $this->db->prepare("UPDATE menu_items SET name = :name, price = :price, description = :description, category_id = :category_id WHERE id = :id");
        $query->execute($data);
        return $query->rowCount();
    }

    public function delete($id)
    {
        $query = $this->db->prepare("DELETE FROM menu_items WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->rowCount();
    }

    public function getItemsByCategory($category_id)
    {
        $query = $this->db->prepare("SELECT * FROM menu_items WHERE category_id = :category_id");
        $query->execute(['category_id' => $category_id]);
        return $query->fetchAll();
    }
}
