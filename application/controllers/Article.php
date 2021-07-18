<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

/*
 * Class Article
 */
class Article extends CI_Controller {

    var $title      = 'Article';
    var $appName    = 'Management Article';
    var $uploadPath = './uploads/';

	function __construct() {

		parent::__construct();

		// Check session
		$this->session_lib->check_session();

        $this->load->model(array('article_model', 'attr_model'));
	}
	// End of function __construct

	public function index() {

        $data = array(
                        'title'     => $this->title,
                        'appName'   => $this->appName,
                        'category'  => $this->attr_model->get_category()
        );

        $this->layout_lib->default_template('article/index', $data);
	}
	// End of function index

    /**
     * @param post => $id
     */
    public function show_edit() {

        $id  = $this->input->post('id');

        $tags = $this->attr_model->get_all_tags();

        $tagsData = array();
        foreach  ($tags as $row)  {
            $tagsData['tag-' . $row->id] = $row->name;
        }
        
        $data = array(
                        'article'   => $this->article_model->get_by_id($id),
                        'tagsData'  => $tagsData,
                        'category'  => $this->attr_model->get_category()
        );

        $this->load->view('article/modal-edit-article', $data);
    }
    // End of function show_edit

	public function server_side_data() {

		// Set field order column
		$columnOrder = array();

		// Set field search column
	    $columnSearch = array();
    	
    	// Set field ordering
    	$order = array();

        // Query
        $query = "SELECT article.id,
                        title,
                        content,
                        thumbnail,
                        is_active,
                        tag_id,
                        category.name AS category,
                        JSON_UNQUOTE(JSON_EXTRACT(time_log, '$.updated_time')) AS updated_time
                        FROM article 
                        JOIN category ON category.id = article.category_id ";

        $tags = $this->attr_model->get_all_tags();

        $tagsData = array();
        foreach  ($tags as $row)  {
            $tagsData['tag-' . $row->id] = $row->name;
        }

   		// $query .= $this->server_side_lib->individual_column_filtering($columnSearch, 'sale');

   		// $query .= $this->server_side_lib->ordering($columnOrder, $order);

   		// $sales = $query . $this->server_side_lib->limit();

   		$results = $this->article_model->get_data_article($query);

		$data = array();

		foreach ($results as $rows) :
            $tagsDecode = json_decode($rows->tag_id, TRUE);

			$row = array();

            $row[] = date('d M Y H:i:s', strtotime($rows->updated_time));

            $row[] = $rows->title;

            $content = $rows->content;

            if (strlen($content) > 70) {

                $content = substr($rows->content, 0, 70);
                $content .= '<span id="dots' . $rows->id . '">...</span><span id="more' . $rows->id . '" class="more">';
                $content .= substr($rows->content, 70) . '</span><a onclick="readmore(' . $rows->id . ')" id="readmore' . $rows->id . '" class="">read more</a>';
            }

            $row[] = $content;

            $row[] = $rows->category;

            $tagsRow = '';
            foreach ($tagsDecode as $key => $value) {

                if (isset($tagsData[$key])) {
                    $tagsRow .= '<span class="badge bg-secondary">' . $tagsData[$key] . '</span> ';
                }
            }

            $row[] = $tagsRow;

            $row[] = '<img src="' . base_url() . substr($rows->thumbnail, 2) . '" class="thumbnail">';

            $isActive = '<span class="badge bg-danger">Not active</span>';
            if ($rows->is_active = 1) {
                $isActive = '<span class="badge bg-success">Active</span>';
            }

            $row[] = $isActive;

            $btnEdit = '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="edit_article(' . $rows->id . ')">Edit</button>';
            $btnDelete = '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="delete_article(' . $rows->id . ')">Delete</button>';

            $row[] = '<div class="btn-group" role="group">' . $btnEdit . $btnDelete . '</div>';

			$data[] = $row;

		endforeach;

		$output = array(
            			"recordsTotal" 		=> $this->article_model->get_num_rows(),
            			"recordsFiltered" 	=> $this->article_model->get_filtered_num_rows($query),
						"data" 				=> $data
					);

		echo json_encode($output);
	}
	// End of function server_side_data

    /**
     * @param post string => title
     * @param post text/html => content
     * @param post string => item_category
     * @param post integer => select_category
     * @param post string => tags
     * @param post file => thumbnail
     */
    public function save_data()  {

		$this->db->trans_start();

        $title              = strip_tags($this->input->post('title'));
        $content            = $this->input->post('content');
        $articleCategory    = strip_tags($this->input->post('article_category'));
        $selectCategory     = strip_tags($this->input->post('select_category'));
        $tags               = strip_tags($this->input->post('tags'));

        // get category
        if ($selectCategory != '')  {

            $categoryId = $selectCategory;
        } else {

            $categoryData['name'] = $articleCategory;
            $categoryId = $this->attr_model->insert_category($categoryData);
        }

        // get tags
        $tagData        = array();
        $tagsExplode    = explode(',', $tags);

        for ($i = 0; $i < count($tagsExplode); $i++) {

            $tag = $tagsExplode[$i];

            if ($tag != '' || $tag != ' ' || $tag != NULL) {

                $getTagId = $this->attr_model->get_tag_by_name($tag);

                $tagData['tag-' . $getTagId] =  1;
            }
        }

        // thumbnail
        $config['upload_path']          = $this->uploadPath;
        $config['allowed_types']        = 'gif|jpg|jpeg|png';

        $this->load->library('upload', $config);

        if (! $this->upload->do_upload('thumbnail')) {
            echo 'upload-error';
        } else {
            $thumbSrc = $this->uploadPath . $this->upload->data('file_name');
        }

        // time log
        $timeLog = array(
                            'created_time' => date('Y-m-d H:i:s'),
                            'updated_time' => date('Y-m-d H:i:s')
        );

        $data  = array(
                        'title'         => $title,
                        'content'       => $content,
                        'category_id'   => $categoryId,
                        'tag_id'        => json_encode($tagData),
                        'thumbnail'     => $thumbSrc,
                        'time_log'      => json_encode($timeLog),
                        'updated_by'    => $this->session->userdata('user_id')
        );

        $this->article_model->insert_article($data);

        if ($this->db->trans_status() === false) {

			$this->db->trans_rollback();
			echo 'error';
		} else {

			$this->db->trans_commit();
			echo 'success';
		}
    }
    // End of function save_data

    /**
     * @param post integer => id
     * @param post string => title_edit
     * @param post text/html => content_edit
     * @param post string => item_category_edit
     * @param post integer => select_category_edit
     * @param post string => tags_edit
     * @param post file => thumbnail_edit
     */
    public function update_data()  {

		$this->db->trans_start();

        $id                 = $this->input->post('id');
        $title              = strip_tags($this->input->post('title_edit'));
        $content            = $this->input->post('content_edit');
        $articleCategory    = strip_tags($this->input->post('article_category_edit'));
        $selectCategory     = strip_tags($this->input->post('select_category_edit'));
        $tags               = strip_tags($this->input->post('tags_edit'));

        // get category
        if ($selectCategory != '')  {

            $categoryId = $selectCategory;
        } else {

            $categoryData['name'] = $articleCategory;
            $categoryId = $this->attr_model->insert_category($categoryData);
        }

        // get tags
        $tagData        = array();
        $tagsExplode    = explode(',', $tags);

        for ($i = 0; $i < count($tagsExplode); $i++) {

            $tag = $tagsExplode[$i];

            if ($tag != '' || $tag != ' ' || $tag != NULL) {

                $getTagId = $this->attr_model->get_tag_by_name($tag);

                $tagData['tag-' . $getTagId] =  1;
            }
        }
        // time log
        $timeLog['updated_time'] = date('Y-m-d H:i:s');

        $data  = array(
                        'title'         => $title,
                        'content'       => $content,
                        'category_id'   => $categoryId,
                        'tag_id'        => json_encode($tagData),
                        'time_log'      => json_encode($timeLog),
                        'updated_by'    => $this->session->userdata('user_id')
        );

        // thumbnail
        if (! empty($_FILES['thumbnail_edit']['name'])) {

            $config['upload_path']          = $this->uploadPath;
            $config['allowed_types']        = 'gif|jpg|jpeg|png';

            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('thumbnail_edit')) {
                echo 'upload-error';
            } else {
                $thumbSrc = $this->uploadPath . $this->upload->data('file_name');
            }

            $data['thumbnail'] = $thumbSrc;

            // unlink
            $getArticle = $this->article_model->get_by_id($id);
            unlink($getArticle['thumbnail']);
        }

        $this->article_model->update_article($data, $id);

        if ($this->db->trans_status() === false) {

			$this->db->trans_rollback();
			echo 'error';
		} else {

			$this->db->trans_commit();
			echo 'success';
		}
    }
    // End of function update_data

    /**
     * @param post => $id
     */
    public function delete_data() {

        $id = $this->input->post('id');
        $article = $this->article_model->get_by_id($id);
        unlink($article['thumbnail']);
        $this->article_model->delete($id);
    }
    // End of function delete_data

}
/* End of file Article.php */
/* Location: ./application/controllers/Article.php/ */
