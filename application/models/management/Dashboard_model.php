<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function count_record($table)
    {
        $result = $this->db->count_all($table);
        return $result;
    }

    public function memory_usage()
    {
        return memory_get_usage();
    }

    
}
