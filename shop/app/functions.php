<?php

/**
 * Data create by create
 */
function create($sql)
{
    connect()->query($sql);
}

/**
 * Data create by create 
 */
function all($table, $order = 'DESC')
{
    return connect()->query("SELECT * FROM $table ORDER BY id $order");
}

/**
 * Data create by create
 */
function find($table, $id)
{
   $data= connect()->query("SELECT * FROM $table WHERE id='$id' ");
   return $data->fetch_object();
}

/**
 * Data create by create
 */
function delete($table, $id)
{
    connect()->query("DELETE FROM shop WHERE id='$id' ");
}
/**
 * Data check function
 */
function dataCheck($table, $column, $data)
{
    $data = connect()->query("SELECT $column FROM $table WHERE $column ='$data' ");

    if( $data->num_rows > 0){
        return true;
    }else{
        return false;
    }
}
/**
 * Data  for update
 */
function update($sql)
{
    connect()->query($sql);
}

// validate function
function validate($msg, $type='danger'){
    return "<p class='alert alert-$type'>$msg !<button class='close' data-dismiss='alert'>&times;</button></p>";
}
// Upload file  functio
function move($file, $location='/' , array $type=['jpg','png','gif','jpeg'])
{
// file name
// File manegment

$file_name = $file['name'];
$file_name_tmp = $file['tmp_name'];
$file_arr =  explode('.', $file_name);
$file_ext = end($file_arr);

$unique_name = md5(time() . rand()). '.' .  $file_ext;

if(in_array($file_ext, $type) ==false){
    $msg = validate('Invalid file formate');
}else{
// Upload file
move_uploaded_file($file_name_tmp, 'photos/' . $unique_name);

}
return[ 
    'unique_name' => $unique_name,
    'err_msg' => $msg
];
}

?>