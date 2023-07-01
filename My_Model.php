<?php

namespace App\Models;

use CodeIgniter\Model;

class MY_Model extends Model
{
    protected $table = null;

    protected $primaryKey = null;

    protected $allowedFields = [];

    public function get($id = null, $order_by = null)
    {
        if (is_numeric($id)) {
            $this->where($this->primaryKey, $id);
        }
        if (is_array($id)) {
            $this->where($id);
        }

        $query = $this->getWhere($order_by);
        return $query->getResultArray();
    }

    public function insert($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function update($new_data, $where)
    {
        if (is_numeric($where)) {
            $this->where($this->primaryKey, $where);
        } elseif (is_array($where)) {
            $this->where($where);
        } else {
            die("You must pass the second Parameter to the update() method.");
        }

        $this->update($new_data);
        return $this->affectedRows();
    }

    public function delete($id)
    {
        if (is_numeric($id)) {
            $this->where($this->primaryKey, $id);
        } elseif (is_array($id)) {
            $this->where($id);
        } else {
            die("You must pass a parameter to the delete() method.");
        }

        $this->delete();
        return $this->affectedRows();
    }
}
