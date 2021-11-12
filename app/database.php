<?php

/**
 * Database Connection 
 */
function connect()
{
    return new mysqli(HOST, USER, PASS, DB);
}


/**
 * Create 
 */
function create($sql)
{
    connect()->query($sql);
}



/**
 * Get all data 
 */
function all($table, $order = 'ASC')
{
    return connect()->query("SELECT * FROM {$table} ORDER BY id {$order}");
}




/**
 * Delete 
 * 
 */
function delete($table, $id)
{
    connect()->query("DELETE FROM {$table} WHERE id='{$id}'");
}


/**
 * Data exists  check 
 */
function dataCheck($table, $col, $val)
{
    $data = connect()->query("SELECT {$col} FROM {$table} WHERE {$col}='$val'");

    if ($data->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}

/**
 * Edit Data 
 */
function update($sql){
    connect() -> query($sql);
}
