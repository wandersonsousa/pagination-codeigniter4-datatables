<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    private $postBuilder;

    public function __construct()
    {
        parent::__construct();
        $this->postBuilder = $this->db->table('TB_Posts');
    }

    public function getPosts( $limit,$start,$col,$dir ){
        return $this
                ->postBuilder
                ->limit($limit,$start)
                ->orderBy($col,$dir)
                ->get()
                ->getResultObject();
    }

    public function countPosts()
    {
        return $this->postBuilder->countAll();
    }

    public function search( $limit,$start,$search,$col,$dir ){
        return $this
                ->postBuilder
                ->like('id',$search)
                ->orLike('title',$search)
                ->orLike('body',$search)
                ->limit($limit,$start)
                ->orderBy($col,$dir)
                ->get()
                ->getResultObject();
    }

    public function searchCount( $search ){
        return $this
        ->postBuilder
        ->like('id',$search)
        ->orLike('title',$search)
        ->orLike('body',$search)
        ->countAllResults();
    }

   
}
