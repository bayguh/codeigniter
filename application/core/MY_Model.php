<?php

class MY_Model extends CI_Model
{
    protected $table_name = null;

    public function __construct()
    {
        parent::__construct();

        if (is_null($this->table_name)) {
            $this->set_table_name($this->table_name);
        }
        $this->load->database();
    }

    /**
     * テーブル名を取得
     */
    public function get_table_name()
    {
        return $this->table_name;
    }

    /**
     * 対象テーブルを切り替えた場合にコネクションを再設定する
     */
    public function set_table_name($table_name)
    {
        if (is_null($table_name)) {
            $class = get_class($this);

            if ($class == "MY_Model") {
                $this->table_name = false;
            } else {
                $this->table_name = preg_replace("/_model$/", "", strtolower($class));
            }

        } else {
            $this->table_name = $table_name;
        }
    }

    /**
     * 取得
     */
    public function get($table = '', $limit = null, $offset = null)
    {
        return $this->db->get($table, $limit, $offset);
    }

    /**
     * レコードを1件取得する
     */
    public function get_record($where = null, $select = null, $limit = null, $offset = null)
    {
        if (empty($this->table_name)) {
            throw new Exception(__CLASS__ . ':行数:' . __LINE__ . " this Model doesn't use Database.");
        }

        $record = null;

        if (!is_null($where)) {
            $this->db->where($where);
        }
        if (!is_null($select)) {
            $this->db->select($select);
        }
        $query = $this->get($this->table_name, $limit, $offset);
        if ($query->num_rows()) {
            $record = $query->row_array();
            $record = $this->get_cast($record, false);
        }

        return $record;
    }

    /**
     * リストの取得
     */
    public function get_list($where = null, $select = null, $limit = null, $offset = null)
    {
        if (empty($this->table_name)) {
            throw new Exception(__CLASS__ . ':行数:' . __LINE__ . " this Model doesn't use Database.");
        }

        if (!is_null($where)) {
            $this->db->where($where);
        }
        if (!is_null($select)) {
            $this->db->select($select);
        }
        $query = $this->get($this->table_name, $limit, $offset);
        $records = $query->result_array();
        $records = $this->get_cast($records, true);

        return $records;
    }

        /**
     * modelに定義した型情報でキャストする
     *
     * @param 取得したレコードデータ
     * @param テーブル名
     * @return キャストされたレコードデータ
     */
    public function get_cast($result_data, $list_flag)
    {
        // 取得レコードがない場合
        if (is_null($result_data) || count($result_data) == 0) {
            return $result_data;
        } else {
            if (empty($this->column_list)) {
                return $result_data;
            }

            // 取得レコードが1件の場合
            if ($list_flag == false) {
                $result_data = $this->cast_execute($result_data, $this->column_list);
            } else {
                foreach ($result_data as $key => $value) {
                    $result_data[$key] = $this->cast_execute($value, $this->column_list);
                }
            }
            return $result_data;
        }
    }

    /**
     * キャストを実行する
     *
     * @param 取得したレコードデータ
     * @param カラムリスト
     * @return キャストされたレコードデータ
     */
    public function cast_execute($result_data, $column_list)
    {
        foreach ($result_data as $key => $value) {
            if (isset($column_list[$key])) {
                if (is_null($value)) {
                    $result_data[$key] = null;
                } else {
                    switch ($column_list[$key]) {
                        case 'int':
                        case 'integer':
                            if (PHP_INT_MAX < $value) {
                                $result_data[$key] = (string) $value;
                            } else {
                                $result_data[$key] = (int) $value;
                            }

                            break;

                        case 'double':
                        case 'float':
                            $result_data[$key] = (double) $value;
                            break;

                        case 'string':
                            $result_data[$key] = (string) $value;
                            break;

                        case 'bool':
                        case 'boolean':
                            $result_data[$key] = (bool) $value;
                            break;

                        default:
                            break;
                    }
                }
            }
        }
        return $result_data;
    }

    /**
     * 追加
     */
    public function insert($record)
    {
        if (empty($this->table_name)) {
            throw new Exception(__CLASS__ . ':行数:' . __LINE__ . " this Model doesn't use Database.");
        }

        return $this->db->insert($this->table_name, $record);
    }

    /**
     * 追加(複数)
     */
    public function insert_batch($record_list)
    {
        if (empty($this->table_name)) {
            throw new Exception(__CLASS__ . ':行数:' . __LINE__ . " this Model doesn't use Database.");
        }

        return $this->db->insert_batch($this->table_name, $record_list);
    }

    /**
     * 更新
     */
    public function update($data = null, $where = null)
    {
        if (empty($this->table_name)) {
            throw new Exception(__CLASS__ . ':行数:' . __LINE__ . " this Model doesn't use Database.");
        }

        if (!is_null($where)) {
            $this->db->where($where);
        }
        $this->db->update($this->table_name, $data);
        return $this->db->affected_rows();
    }

    /**
     * 件数取得
     */
    public function count_all_results($where = null)
    {
        if (empty($this->table_name)) {
            throw new Exception(__CLASS__ . ':行数:' . __LINE__ . " this Model doesn't use Database.");
        }

        if (!is_null($where)) {
            $this->db->where($where);
        }
        return (int) $this->db->count_all_results($this->table_name);
    }

    /**
     * 物理削除
     */
    public function physical_delete($where = '', $limit = null, $reset = true)
    {
        if (empty($this->table_name)) {
            throw new Exception(__CLASS__ . ':行数:' . __LINE__ . " this Model doesn't use Database.");
        }

        return $this->db->delete($this->table_name, $where, $limit, $reset);
    }
}
