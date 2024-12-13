<?php 
abstract class Model {
    public abstract function __construct();
    public abstract function get_all();
    public abstract function get($id);
    public abstract function delete($id);
    public abstract function create($data);
    public abstract function update($id, $data);
}
?>