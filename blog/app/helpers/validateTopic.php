<?php

function validateTopic($topic)
{
  
    $errors = array();

    if (empty($topic['name'])) {
        array_push($errors, 'Konu adı gerekli!');
    }


    $existingTopic = selectOne('topics', ['name'=> $topic['name']]);
    if ($existingTopic) {
        array_push($errors, 'Konu adı daha önce kullanılmış.');
    }

    $existingTopic = selectOne('topics', ['name' => $topic['name']]);
    if ($existingTopic) {
        if (isset($post['update-topic']) && $existingTopic['id'] != $topic['id']) {
            array_push($errors, 'Konu daha önce kullanılmış.');
        }
        if (isset($post['add-topic'])) {
            array_push($errors, 'Konu daha önce kullanılmış.');
        }
    }

    return $errors;
}



