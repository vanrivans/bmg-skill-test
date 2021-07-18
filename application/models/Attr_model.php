<?php

class Attr_model extends CI_Model {

    /**
     * @return array
     */
    public function get_category() {

        $result = $this->db->query("SELECT id, name
                                        FROM category
                                        ORDER BY name ASC")->result();

        return $result;
    }
    // End of function get_category

    /**
     * @param array $data
     * @return integer
     */
    public function insert_category($data) {

        $this->db->insert('category', $data);
        return $this->db->insert_id();
    }
    // End of function insert_category

    /**
     * @param string $tag
     * @return integer
     */
    public function get_tag_by_name($tag)  {

        $query = $this->db->query("SELECT id FROM tag WHERE name = '" . strtolower($tag) . "'");

        if ($query->num_rows() > 0) {

            $result     = $query->row_array();
            $tag_id     = $result['id'];
            return $tag_id;
        } else {

            $this->db->insert('tag', array('name' => strtolower($tag)));
            return $this->db->insert_id();
        }
    }
    // End of function get_tag_by_name

    /**
     * @return array
     */
    public function get_all_tags() {

        $query = $this->db->query("SELECT id, name FROM tag")->result();

        return $query;
    }
    // End of function get_all_tags

}
/* End of file Attr_model.php */
/* Location: ./application/models/Attr_model.php/ */
