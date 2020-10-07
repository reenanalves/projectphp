<?php


interface Repository{

    function store($object);

    function loadAll();

    function findByPrimaryKey($id);

    function delete($id);

}