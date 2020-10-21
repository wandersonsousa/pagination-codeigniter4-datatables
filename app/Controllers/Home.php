<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('show_table');
	}

	public function json(){
		$postModel = new \App\Models\PostModel();

        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'body',
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];

        $totalData = $postModel->countPosts();

        $totalFiltered = $totalData;

        if (empty($this->request->getPost('search')['value'])) {
            $posts = $postModel->getPosts($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value'];

            $posts =  $postModel->search($limit, $start, $search, $order, $dir);

            $totalFiltered = $postModel->searchCount($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['title'] = $post->title;
                $nestedData['body'] = $post->body;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->request->getPost('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return json_encode($json_data);
	}
}
