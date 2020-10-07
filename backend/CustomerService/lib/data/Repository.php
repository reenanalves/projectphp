<?php


interface Repository{

    function store($object);

    function loadAll($limit, $offset);

    function findByPrimaryKey($id);

    function findLastId();

    function countAllRecords();

    function delete($id);

}