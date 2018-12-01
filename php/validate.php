<?php
// include 'sql.php';
function validateRequired(&$errors, $field_list)
{
    foreach ($field_list as $key => $value) {
        if (!isset($field_list[$key]) || empty($value)) {
            $errors[$key] = '<span class="err">wajib</span>';
        }
    }
}

function validateConfirmPassword(&$errors, $field_list, $field_name, $fieldpassword)
{
    if ($field_list[$field_name]!=$field_list[$fieldpassword]) {
        $errors[$fieldpassword] = '<span class="err">kata sandi tidak cocok</span>';
    }
}
function validateName(&$errors, $field_list, $field_name)
{
    $pattern = "/^[a-zA-Z'-]+$/"; // format surname (alfabet)
    if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = '<span class="err">hanya berisi abjad</span>';
}
function validateEmail(&$errors,$field_list, $field_name)
{
    $pattern = "/[a-z0-9._%+-]+@[a-z0-9-]+.[a-z]{2,3}$/";
    if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = '<span class="err">format email salah</span>';
}
function validateNumber(&$errors, $field_list, $field_name)
{
    $pattern = "/^[0-9]{1,}$/";
    $pattern2 = "/^[0-9]{10,}$/";
    if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = '<span class="err">hanya berisi numerik</span>';
    elseif (!preg_match($pattern2, $field_list[$field_name]))
        $errors[$field_name] = '<span class="err">nomor ponsel kurang dari 10 digit</span>';
}
function validatePassword(&$errors, $field_list, $field_name)
{
    $pattern = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{1,}$/";
    $pattern2 = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
    if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = '<span class="err">sebagian besar berisi abjad (baik huruf kecil & huruf besar) & numerik</span>';
    elseif (!preg_match($pattern2, $field_list[$field_name]))
        $errors[$field_name] = '<span class="err">kata sandi kurang dari 8 digit</span>';
}
function validateUsername(&$errors, $field_list, $field_name)
{
    if(getCol('CUSTOMER', 'USERNAME', 'USERNAME', $field_list[$field_name]))
        $errors[$field_name] = "<span class=\"err\">username {$field_list[$field_name]} telah tersedia</span>";
}
function validateNoRek(&$errors, $field_list, $field_name)
{
    $pattern = "/^[0-9]{1,}$/";
    $pattern2 = "/^[0-9]{10,}$/";
    if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = '<span class="err">hanya berisi numerik</span>';
    elseif (!preg_match($pattern2, $field_list[$field_name]))
        $errors[$field_name] = '<span class="err">nomor rekening kurang dari 10 digitk</span>';
}
function validatePIN(&$errors, $field_list, $field_name)
{
    $pattern = "/^[0-9]{1,}$/";
    if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = '<span class="err">hanya berisi numerik</span>';
}
 ?>
