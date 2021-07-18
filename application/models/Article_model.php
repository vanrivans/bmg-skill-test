<?php

class Article_model extends CI_Model {

    /**
     * @return integer
     */
    public function get_num_rows() {
        
        $numRows = $this->db->get("article")->num_rows();

        return $numRows;
    }
    // End of function get_num_rows

    /**
     * @param string $query
     * @return integer
     */
    public function get_filtered_num_rows($query = '') {

        $numRows = $this->db->query($query)->num_rows();

        return $numRows;
    }
    // End of function get_filtered_num_rows

    /**
     * @param integer $id
     * @return array
     */
    public function get_by_id($id) {

        $query = "SELECT article.id,
                title,
                content,
                thumbnail,
                is_active,
                tag_id,
                category_id,
                category.name AS category,
                JSON_UNQUOTE(JSON_EXTRACT(time_log, '$.updated_time')) AS updated_time
                FROM article 
                JOIN category ON category.id = article.category_id 
                WHERE article.id = " . $id;

        $result = $this->db->query($query)->row_array();
        return $result;
    }
    // End of function get_by_id

    /**
     * @param string $query
     * @return array
     */
    public function get_data_article($query = '') {

        $result = $this->db->query($query)->result();

        return $result;
    }
    // End of function get_data_article

    /**
     * @param array $data
     */
    public function insert_article($data)  {

        $this->db->insert('article', $data);
    }
    // End of function insert_article

    /**
     * @param array $data
     * @param integer $id
     */
    public function update_article($data, $id) {

        $this->db->where('id', $id);
        $this->db->update('article', $data);
    }
    // End of function update_article

    /**
     * @param integer $id
     */
    public function delete($id) {

        $this->db->where('id', $id);
        $this->db->delete('article');
    }
    // End of function delete

}
/* End of file Article_model.php */
/* Location: ./application/models/Article_model.php/ */

